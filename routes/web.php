<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('language/{id}/{code}', [App\Http\Controllers\HomeController::class, 'languageIndex'])->name('languageIndex');
Route::get('{code}/gameIntro', [App\Http\Controllers\GameController::class, 'gameIntro'])->name('gameIntro');
Route::post('{code}/startGame', [App\Http\Controllers\GameController::class, 'startGame'])->name('startGame');
Route::post('{code}/answer-level-1/{level}', [App\Http\Controllers\GameController::class, 'answerLevel1'])->name('answerLevel1');
Route::post('{code}/answer-level-2/{level}', [App\Http\Controllers\GameController::class, 'answerLevel2'])->name('answerLevel2');
Route::post('{code}/answer-level-3/{level}', [App\Http\Controllers\GameController::class, 'answerLevel3'])->name('answerLevel3');
Route::get('no-games', function () {
    return view('web.no-games');
})->name('noGames');


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
