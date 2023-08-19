<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/register', function () {
    abort(403);
});


Route::group(['middleware' => ['authorization', 'admin']], function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
    Route::get('file-manager', function () {
        return view('admin.file-manager.index');
    });
    Route::resource('languages', App\Http\Controllers\Admin\LanguageController::class);
    Route::resource('translations', App\Http\Controllers\Admin\TranslationController::class);
    Route::post('translations/import', [App\Http\Controllers\Admin\TranslationController::class, 'import'])->name('translations.import');
    Route::resource('sentences', App\Http\Controllers\Admin\SentenceController::class);
    Route::resource('users', App\Http\Controllers\Admin\UsersController::class);
    Route::post('sentences/import', [App\Http\Controllers\Admin\SentenceController::class, 'import'])->name('sentences.import');
    Route::get('sentence/return/{id}', [App\Http\Controllers\Admin\SentenceController::class, 'return'])->name('sentence.return');
    Route::get('answers', [App\Http\Controllers\Admin\AnswersController::class, 'index'])->name('answers.index');
    Route::get('answersDetails/{id}', [App\Http\Controllers\Admin\AnswersController::class, 'answerDetails'])->name('answers.details');
    Route::get('answers/export', [App\Http\Controllers\Admin\AnswersController::class, 'export'])->name('answers.export');
    Route::resource('admins', App\Http\Controllers\Admin\AdminUsersController::class);
    Route::resource('scores', App\Http\Controllers\Admin\ScoreController::class);
    Route::resource('settings', App\Http\Controllers\Admin\SettingsController::class);
    Route::resource('badges', App\Http\Controllers\Admin\BadgesController::class);
});
