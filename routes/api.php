<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\EpisodeWatchingController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmWatchingController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\MatchWatchingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionDetailsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//Auth
Route::prefix('Auth')->group(function () {
    Route::post('/Register', [AuthController::class, 'Register']);
    Route::post('/Login', [AuthController::class, 'Login']);
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/logout_all', [AuthController::class, 'logout_all'])->middleware('auth:sanctum');
    Route::post('forgot_password', [AuthController::class, 'forgot_password']);
    Route::post('reset_password', [AuthController::class, 'reset_password'])->name('password.reset');
});

//user
Route::prefix('Users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{user}', [UserController::class, 'show'])->middleware('auth:sanctum');
    Route::post('/update', [UserController::class, 'update'])->middleware('auth:sanctum');
});
//country
Route::prefix('Countries')->group(function () {
    Route::get('/deleted', [CountryController::class, 'deleted'])->middleware('auth:sanctum');
    Route::post('/store', [CountryController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/update', [CountryController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/', [CountryController::class, 'index']);
    Route::get('/{country}', [CountryController::class, 'show'])->middleware('auth:sanctum');
    Route::get('restore/{country}', [CountryController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{country}', [CountryController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{country}', [CountryController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});

//Episode
Route::prefix('Episodes')->group(function () {
    Route::get('/deleted', [EpisodeController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [EpisodeController::class, 'index']);
    Route::post('/store', [EpisodeController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/update', [EpisodeController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/{episode}', [EpisodeController::class, 'show'])->middleware('auth:sanctum');
    Route::get('restore/{episode}', [EpisodeController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{episode}', [EpisodeController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{episode}', [EpisodeController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});

//Episode_watchings
Route::prefix('EpisodeWatchings')->group(function () {
    Route::get('/deleted', [EpisodeWatchingController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [EpisodeWatchingController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/store', [EpisodeWatchingController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/{episodeWatching}', [EpisodeWatchingController::class, 'show'])->middleware('auth:sanctum');
    Route::get('restore/{episodeWatching}', [EpisodeWatchingController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{episodeWatching}', [EpisodeWatchingController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{episodeWatching}', [EpisodeWatchingController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});

//genre
Route::prefix('Genres')->group(function () {
    Route::get('/deleted',  [GenreController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [GenreController::class, 'index']);
    Route::get('/{genre}', [GenreController::class, 'show']);
    Route::put('/update', [GenreController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/store', [GenreController::class, 'store'])->middleware('auth:sanctum');
    Route::get('restore/{genre}',  [GenreController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{genre}', [GenreController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{genre}', [GenreController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});

//series
Route::prefix('Series')->group(function () {
    Route::get('top_10', [SeriesController::class, 'top_10']);
    Route::get('new',  [SeriesController::class, 'new']);
    Route::get('rate', [SeriesController::class, 'rate']);
    Route::get('genre/{genre}', [SeriesController::class, 'genre']);
    Route::get('/deleted', [SeriesController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [SeriesController::class, 'index']);
    Route::post('/store', [SeriesController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/update', [SeriesController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/{series}', [SeriesController::class, 'show'])->middleware('auth:sanctum');
    Route::get('restore/{series}', [SeriesController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{series}', [SeriesController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{series}', [SeriesController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});

//Seasons
Route::prefix('Seasons')->group(function () {
    Route::get('/deleted', [SeasonController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [SeasonController::class, 'index']);
    Route::post('/store', [SeasonController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/{season}', [SeasonController::class, 'show'])->middleware('auth:sanctum');
    Route::get('restore/{season}', [SeasonController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{season}', [SeasonController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{season}', [SeasonController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});

//message
Route::prefix('Messages')->group(function () {
    Route::get('/deleted', [MessageController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [MessageController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/store', [MessageController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/{message}', [MessageController::class, 'show'])->middleware('auth:sanctum');
    Route::get('restore/{message}', [MessageController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{message}', [MessageController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{message}', [MessageController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});

//films
Route::prefix('Films')->group(function () {
    Route::get('new', [FilmController::class, 'new']);
    Route::get('top_10', [FilmController::class, 'top_10']);
    Route::get('rate', [FilmController::class, 'rate']);
    Route::get('genre/{genre}', [FilmController::class, 'genre']);
    Route::get('/deleted', [FilmController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [FilmController::class, 'index']);
    Route::post('/store', [FilmController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/update', [FilmController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/{film}', [FilmController::class, 'show'])->middleware('auth:sanctum');
    Route::get('restore/{film}', [FilmController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{film}', [FilmController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{film}', [FilmController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});

//filmWatchings
Route::prefix('FilmWatchings')->group(function () {
    Route::get('/deleted', [FilmWatchingController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [FilmWatchingController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/store', [FilmWatchingController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/{filmWatching}', [FilmWatchingController::class, 'show'])->middleware('auth:sanctum');
    Route::get('restore/{filmWatching}',  [FilmWatchingController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{filmWatching}', [FilmWatchingController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{filmWatching}', [FilmWatchingController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});

//matches
Route::prefix('Matches')->group(function () {
    Route::get('top_10',  [MatchesController::class, 'top_10']);
    Route::get('new',  [MatchesController::class, 'new']);
    Route::get('rate',  [MatchesController::class, 'rate']);
    Route::get('champion/{champion}',  [MatchesController::class, 'champion']);
    Route::get('/deleted',  [MatchesController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [MatchesController::class, 'index']);
    Route::put('/update', [MatchesController::class, 'update'])->middleware('auth:sanctum');
    Route::post('/store', [MatchesController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/{matches}', [MatchesController::class, 'show'])->middleware('auth:sanctum');
    Route::get('restore/{matches}',  [MatchesController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{matches}', [MatchesController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{matches}', [MatchesController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});

//matchwatching
Route::prefix('MatchWatchings')->group(function () {
    Route::get('/deleted',  [MatchWatchingController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [MatchWatchingController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/store', [MatchWatchingController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/{matchWatching}', [MatchWatchingController::class, 'show'])->middleware('auth:sanctum');
    Route::get('restore/{matchWatching}',  [MatchWatchingController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{matchWatching}', [MatchWatchingController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{matchWatching}', [MatchWatchingController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});

//Subscriptions
Route::prefix('Subscriptions')->group(function () {
    Route::get('/deleted',  [SubscriptionController::class, 'deleted'])->middleware('auth:sanctum');
    Route::get('/', [SubscriptionController::class, 'index']);
    Route::post('/store', [SubscriptionController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/update', [SubscriptionController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/{subscription}', [SubscriptionController::class, 'show'])->middleware('auth:sanctum');
    Route::get('restore/{subscription}',  [SubscriptionController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{subscription}', [SubscriptionController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{subscription}', [SubscriptionController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});

//subscriptiondetails
Route::prefix('SubscriptionDetails')->group(function () {
    Route::get('/deleted',  [SubscriptionDetailsController::class, 'deleted'])->middleware('auth:sanctum');
    Route::post('/pay',   [SubscriptionDetailsController::class, 'pay'])->middleware('auth:sanctum');
    Route::post('/store', [SubscriptionDetailsController::class, 'store'])->middleware('auth:sanctum')->name('success');
    Route::post('/cancel', [SubscriptionDetailsController::class, 'cancel'])->middleware('auth:sanctum')->name('cancel');
    Route::get('/', [SubscriptionDetailsController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/{subscriptionDetails}', [SubscriptionDetailsController::class, 'show'])->middleware('auth:sanctum');
    Route::get('restore/{subscriptionDetails}',  [SubscriptionDetailsController::class, 'restore'])->middleware('auth:sanctum');
    Route::delete('delete/{subscriptionDetails}', [SubscriptionDetailsController::class, 'delete'])->middleware('auth:sanctum');
    Route::get('delete_from_trash/{subscriptionDetails}', [SubscriptionDetailsController::class, 'delete_from_trash'])->middleware('auth:sanctum');
});