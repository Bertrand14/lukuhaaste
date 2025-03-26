<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // to format date

class BookController extends Controller
{

  public static function getAll(){
      return Book::with(['authors', 'genres'])->get(); // All joints are made in the model
  }
  

  public function get(int $id, string $title)
  {
    $title = urldecode(str_replace('_', ' ', $title));

    $book = Book::with(['authors', 'genres'])->findOrFail($id);

    if ($title !== $book->title) {
      abort(404, 'Page not found');
    }

    $reviews = Book::findOrFail($id)->reviews()->with('user')->get();

    $noteAvg = $reviews->avg('note');
    $noteCount = $reviews->whereNotNull('note')->count();
    $recommend = $reviews->where('recommend', 1)->count();
    $recommendCount = $reviews->whereNotNull('recommend')->count();
    $recommendPrct = $recommend > 0 ? ($recommend / $recommendCount) * 100 : 0;

    $dateFormat = 'd M Y, H:i';
    $reviews = $reviews->map(function ($review) use ($dateFormat) {
      $createdAt = $review->created_at ? Carbon::parse($review->created_at)->format($dateFormat) : null;
      $updatedAt = $review->updated_at ? Carbon::parse($review->updated_at)->format($dateFormat) : null;

      if ($updatedAt && $updatedAt !== $createdAt) {
        $review->date = $updatedAt . ' (edited)';
      } else {
        $review->date = $createdAt;
      }

      return $review;
    });


    return view('book', compact('book', 'noteAvg', 'noteCount', 'recommend', 'recommendPrct', 'reviews'));
  }

  public function searchBooks(Request $request)
  {
    $bookName = $request->input('search');

    $books = Book::where('title', 'LIKE', "%{$bookName}%")
      ->orderByRaw(
        "
        CASE 
                WHEN title LIKE ? THEN 1
                WHEN title LIKE ? THEN 2
                WHEN title LIKE ? THEN 3
                ELSE 4
        END",
        ["{$bookName}", "{$bookName}%", "%{$bookName}%"]
      )
      ->limit(5)
      ->get();

    return response()->json($books);
  }

  public static function allBooksFormats()
  {
    $types = DB::table('book_types')
      ->select('title', 'id')
      ->get();
    View::share('booksFormats', $types);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'bookName' => 'required|string|max:255',
      'bookGenre' => 'required|array',
      'bookPageNumber' => 'required|integer',
      'bookCover' => 'nullable|image|mimes:jpeg,png,jpg,gif',
      'bookSynopsis' => 'required|string',
    ]);

    $book = new Book();
    $book->name = $validated['bookName'];
    $book->page_number = $validated['bookPageNumber'];
    $book->synopsis = $validated['bookSynopsis'];

    if ($request->hasFile('bookCover')) {
      $cover = $request->file('bookCover');
      $coverName = uniqid() . '.' . $cover->getClientOriginalExtension();
      $cover->move(public_path('assets/images/covers'), $coverName);
      $book->cover = $coverName;
    }

    $book->save();
    $book->genres()->sync($validated['bookGenre']);
    return redirect()->route('book.show', $book->id)->with('success', 'Kirjan lisäys onnistui.');
  }

  public function delete(Request $request)
  {
    $book = Book::find($request->id); // Change to findOrFail / firstOrFail?

    if (!$book) {
      return response()->json(['success' => false, 'message' => 'Ei kirjaa tällä tunnuksella.']);
    }

    $book->delete();
    return response()->json(['success' => true]);
  }
}
