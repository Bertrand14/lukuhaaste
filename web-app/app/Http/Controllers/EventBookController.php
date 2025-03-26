<?php

namespace App\Http\Controllers;

use App\Models\EventBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;

class EventBookController extends Controller{
    
    public function store(Request $request){
        
        $validated = $request->validate([
            'bookID' => 'required|integer',
            'bookName' => 'required|string',
            'pagesReadNumber' => 'required|integer',
            'typeID' => 'required|integer',
        ]);

        $event = (new EventController())->getCurrent();

        $eventBook = new EventBook();
        $eventBook->userID = Auth::id();;
        $eventBook->bookID = $validated['bookID'];
        $eventBook->typeID = $validated['typeID'];
        $eventBook->pageNb = $validated['pagesReadNumber'];
        $eventBook->eventID = $event['id'];

        if ($eventBook->save()) {
            
            return redirect()->route('dashboard')->with('success', 'Livre enregistré avec succès');
        } else {
            
            return back()->with('error', 'Erreur lors de l\'enregistrement');
        }
    }
}

?>