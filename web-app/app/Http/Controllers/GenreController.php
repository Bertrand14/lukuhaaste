<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class GenreController extends Controller{
    public static function getAll(){
        $genres = Genre::all();
        View::share('genres', $genres);
    }

    public function get($id){
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['success' => false, 'message' => 'Genre non trouvé.'], 404);
        }

        return response()->json(['success' => true, 'genre' => $genre]);
    }

    public function store(Request $request){
        $request->validate([
        'name' => 'required|string|unique:genres,name|max:100'
        ]);

        $genre = Genre::create([ 'name' => $request->name ]);
        return response()->json(['success' => true, 'genre' => $genre], 201);
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required|exists:genres,id',
            'name' => 'required|string|unique:genres,name|max:100'
        ]);

        $genre = Genre::findOrFail($request->id);
        $genre->update(['name' => $request->name]);

        return response()->json(['success' => true, 'genre' => $genre]);
    }

    public function delete(Request $request){
        $request->validate([
            'id' => 'required|exists:genres,id'
        ]);

        Genre::findOrFail($request->id)->delete();

        return response()->json(['success' => true]);
    }
}
