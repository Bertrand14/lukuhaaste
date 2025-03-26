<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{

        public static function getAll()
        {
                return Review::with(['user', 'book'])->get();
        }

        /*
        public static function getAll()
        {
                return Review::join('users', 'reviews.userID', '=', 'users.id')
                        ->join('books', 'reviews.bookID', '=', 'books.id')
                        ->join('types', 'reviews.typeID', '=', 'types.id')
                        ->join('events', 'reviews.eventID', '=', 'events.id')
                        ->get();
        }
                        */


        public function store(Request $request)
        {
                $validated = $request->validate([
                        'reviewUserID' => 'required|integer',
                        'reviewBookID' => 'required|integer',
                        'reviewNote' => 'required|integer|min:0|max:5',
                        'reviewRecommend' => 'sometimes|boolean',
                        'reviewContent' => 'required|string|max:255',
                ], [], [
                        // Map data to match database fields names - only for error messages
                        'reviewUserID' => 'userID',
                        'reviewBookID' => 'bookID',
                        'reviewNote' => 'note',
                        'reviewRecommend' => 'recommend',
                        'reviewContent' => 'content',
                ]);

                // Convert checkbox to 0 (unchecked) or 1 (checked) 
                $recommend = $request->has('reviewRecommend') ? 1 : 0;

                // Map and save into database
                Review::create([
                        'userID' => $validated['reviewUserID'],
                        'bookID' => $validated['reviewBookID'],
                        'note' => $validated['reviewNote'],
                        'content' => $validated['reviewContent'],
                        'recommend' => $recommend,
                ]);

                return redirect()->back()->with('success', 'Review added successfully!');
        }

        public function update(Request $request, $id)
        {
                $validated = $request->validate([
                        'reviewUserID' => 'required|integer',
                        'reviewBookID' => 'required|integer',
                        'reviewNote' => 'required|integer|min:0|max:5',
                        'reviewRecommend' => 'sometimes|boolean',
                        'reviewContent' => 'required|string|max:255',
                ], [], [
                        // Map data to match database fields names - only for error messages
                        'reviewUserID' => 'userID',
                        'reviewBookID' => 'bookID',
                        'reviewNote' => 'note',
                        'reviewRecommend' => 'recommend',
                        'reviewContent' => 'content',
                ]);

                $review = Review::findOrFail($id);

                // Convert checkbox to 0 (unchecked) or 1 (checked) 
                $review->recommend = $request->has('reviewRecommend') ? 1 : 0;
                $review->content = $validated['reviewContent'];
                $review->note = $validated['reviewNote'];

                // Save to database
                $review->save();

                if ($request->expectsJson()) {
                        return response()->json([
                                'message' => 'Review updated successfully!',
                                'review' => $review
                        ]);
                }

                return redirect()->back()->with('success', 'Review updated successfully!');
        }

        public function delete($id)
        {
                // Find the review by ID and delete it
                $review = Review::findOrFail($id);
                $review->delete();

                // Redirect with success message
                return redirect()->back()->with('success', 'Review deleted successfully.');
        }


        public function deleteReview(Review $review)
        {
                $review->delete();
                return response()->json(['success' => true, 'message' => 'Review deleted successfully']);
        }



        public function deleteAllReviewFromUser()
        {
                $user = Auth::user();
                Review::where('userID', $user->id)
                        ->delete();
                return redirect(route('dashboard', absolute: false))->with('success', 'Kaikki tähän mennessä tekemäsi arvostelut on poistettu.');
        }

        public function mostReadBooks()
        {
                return Review::select('reviews.bookID', DB::raw('COUNT(*) as qty'), 'books.title', 'books.cover') // Ajoute les colonnes de books
                        ->join('books', 'reviews.bookID', '=', 'books.id') // Effectue la jointure
                        ->groupBy('reviews.bookID', 'books.title', 'books.cover') // Ajoute les colonnes de books au regroupement
                        ->orderByDesc('qty')
                        ->limit(20)
                        ->get();
        }
        public function mostLovedBooks()
        {
                return Review::select('reviews.bookID', DB::raw('SUM(reviews.recommend) as qty'), 'books.title', 'books.cover') // Ajoute les colonnes de books
                        ->join('books', 'reviews.bookID', '=', 'books.id') // Effectue la jointure
                        ->groupBy('reviews.bookID', 'books.title', 'books.cover') // Ajoute les colonnes de books au regroupement
                        ->orderByDesc('qty')
                        ->limit(10)
                        ->get();
        }
}
