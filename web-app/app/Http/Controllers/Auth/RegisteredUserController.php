<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'username' => ['required', 'string', 'max:50', 'unique:' . User::class],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()->min(12)->letters()->numbers(),
                'regex:/^(?=.*[a-z])(?=.*[A-Z])/', // at least one uppercase and one lowercase character ; use regex because for some reason mixedCase() does not apply
                function ($attribute, $value, $fail) use ($request) {
                    $forbiddenWords = [
                        strtolower($request->username),
                        strtolower($request->first_name),
                        strtolower($request->last_name),
                        'password',
                        'salasana'
                    ];
                    foreach ($forbiddenWords as $word) {
                        if (!empty($word) && str_contains(strtolower($value), $word)) {
                            $fail('The password should not contain your username, name, or easy-to-guess words like "password".');
                        }
                    }
                }
            ],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'typeID' => "2",
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Edit account information
     */

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'username' => ['required', 'string', 'max:50', 'unique:users,username,' . $user->id],
        ]);

        User::where('id', '=', $user->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'email' => $request->email,
            'username' => $request->username,
        ]);

        return redirect()->route('dashboard')->with('success', 'Account information updated successfully.');
    }

    public function delete()
    {
        $user = Auth::user();
        Auth::logout();

        User::where('id', $user->id)->delete();
        return redirect(route('homepage', absolute: false))->with('success', 'Tilisi on poistettu. Toivomme, että sinulla oli silti hauskaa kanssamme.');
    }
}
