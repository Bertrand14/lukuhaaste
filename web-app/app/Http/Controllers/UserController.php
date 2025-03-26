<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public static function getUsersList()
    {
        $user = Auth::user();
        return User::select('users.*', 'users.username as name', 'user_types.name_type as right_name')
            ->join('user_types', 'users.typeID', '=', 'user_types.id')
            ->where('users.id', '<>', $user->id)
            ->get();
    }

    public function getUser(User $user)
    {
        // Return user data as JSON
        return response()->json([
            'username' => $user->username,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'address' => $user->address,
        ]);
    }

    public function updateUser(User $user, Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'username' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        // Update the user model with the new data
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->save();

        // Return the updated user data
        return response()->json([
            'success' => true,
            'username' => $user->username,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'address' => $user->address,
        ]);
    }


    public function updateRole(Request $request, User $user)
    {

        $validated = $request->validate([
            'roleId' => 'required|exists:user_types,id',
        ]);

        $user->typeID = $validated['roleId'];
        $user->save();

        return response()->json(['message' => 'Roolin päivitys onnistui.']);
    }

    public function userTypes()
    {
        $users = User::with('userType')->get();
        $userTypes = UserType::all();
        dd($userTypes->all());
        return view('components.dashboard.admin.users', compact('users', 'userTypes'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }
}
