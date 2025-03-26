<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EventBookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $current = EventController::getCurrent();
    $future = EventController::getNext();
    $stats = new EventController();
    $reviews = new ReviewController();
    return view(
        'welcome',
        [
            'current' => $current,
            'future' => $future,
            'stats' => $stats->getAllStatistics(),
            'bestBooks' => $reviews->mostReadBooks(),
            'lovedBooks' => $reviews->mostLovedBooks(),
        ]
    );
})->name('homepage');

Route::get('dashboard', function () {
    $user = Auth::user();
    $users = UserController::getUsersList();
    $books = BookController::getAll();
    $genres = GenreController::getAll();
    $events = EventController::getAll();
    $reviews = ReviewController::getAll();
    $booksFormats = BookController::allBooksFormats();
    $userTypes = \App\Models\UserType::all();
    return view(
        'dashboard',
        [
            'user' => $user,
            'users' => $users,
            'books' => $books,
            'genres' => $genres,
            'events' => $events,
            'reviews' => $reviews,
            'booksFormats' => $booksFormats,
            'userTypes' => $userTypes,
        ]
    );
})->middleware(['auth', 'verified'])->name('dashboard');

// Books
Route::get('/books/search', [BookController::class, 'searchBooks']);
Route::get('/books', [BookController::class, 'getAll'])->name('book.getAll');
Route::get('/books/{id}_{title}', [BookController::class, 'get'])->name('book.get');
Route::get('/book/{book}', [UserController::class, 'getBook']);

// Requires that the user is logged in:
Route::middleware('auth')->group(function () {

    // User:
    Route::delete('/delete-user/{user}', [UserController::class, 'deleteUser']);
    Route::get('/user/{user}', [UserController::class, 'getUser']);
    Route::put('/update-user/{user}', [UserController::class, 'updateUser']);
    //   --- account
    Route::put('/account/update', [RegisteredUserController::class, 'update'])->name('account.update');
    Route::delete('/account/delete', [RegisteredUserController::class, 'delete'])->name('account.delete'); // TOOD isn't this the same as /users/delete and profile.delete?
    //   --- profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'delete'])->name('profile.delete'); // TOOD isn't this the same as /users/delete and /account/delete?
    //   --- role
    Route::put('/update-role/{user}', [UserController::class, 'updateRole']);


    // Books:
    //   --- entries
    Route::post('/books', [BookController::class, 'store'])->name('book.store');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::put('/update-book/{book}', [UserController::class, 'updateBook']);
    Route::delete('/books/delete', [BookController::class, 'delete'])->name('books.delete');
    Route::post('/books/to-event', [EventBookController::class, 'store'])->name('book.toEvent');

    //   --- genres
    Route::get('/genres', [GenreController::class, 'getAll'])->name('genres.getAll');
    Route::get('/genre/{id}', [GenreController::class, 'get'])->name('genre.get');
    Route::post('/genre', [GenreController::class, 'store'])->name('genre.store');
    Route::put('/genre/{id}', [GenreController::class, 'update'])->name('genre.update');
    Route::delete('/genre/{id}', [GenreController::class, 'delete'])->name('genre.delete');


    // Events
    Route::get('/dashboard/new-event', [EventController::class, 'getAllConditons'])->name('new-event');
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
    Route::put('/event/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/{id}', [EventController::class, 'delete'])->name('event.delete');
    Route::post('/event/join', [EventController::class, 'joinToEvent'])->name('event.join');
    Route::delete('/event/exit', [EventController::class, 'exit'])->name('event.exit');


    // Reviews
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
    Route::put('/review/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/{id}', [ReviewController::class, 'delete'])->name('review.delete');
    Route::delete('/reviews/deleteFromUser', [ReviewController::class, 'deleteAllReviewFromUser'])->name('reviews.deleteFromUser');
    Route::delete('/delete-review/{review}', [ReviewController::class, 'deleteReview']);
});

require __DIR__ . '/auth.php';
