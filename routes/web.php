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
Route::get('{code}/no-games', [App\Http\Controllers\GameController::class, 'noGames'])->name('noGames');

Route::get('user-profile', [App\Http\Controllers\HomeController::class, 'userProfile'])->name('userProfile');
Route::post('update-profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//Route::get('/test', function () {
//    app()->setLocale('sl');
//    return trans('home.greeting');
//});

Route::get('redirect/{driver}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('{driver}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);
Route::post('additional-user-info/{userId}', [App\Http\Controllers\Auth\RegisterController::class, 'additionUserInfo'])->name('additional-user-info');
Route::get('additional-info-data/{field}/{value}', [App\Http\Controllers\HomeController::class, 'additionalInfoData'])->name('additional.info.data');
Route::get('badges', [App\Http\Controllers\HomeController::class, 'badges'])->name('badges');
