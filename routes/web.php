<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('questions','QuestionsController')->except('show');

//Route::post('/questions/{question}/answers','AnswerController@store')->name('answers.store');
Route::resource('questions.answers', 'AnswerController')->only(['store', 'edit', 'update', 'destroy']);
Route::get('/questions/{slug}','QuestionsController@show')->name('questions.show');

//single action controller will call __invoke
Route::post('/answers/{answer}/accept','AcceptAnswerController')->name('answers.accept');

/*Route::post('/favorites/{question}','FavoriteController@store');//->name('favorites.store');
Route::delete('/favorites/{question}','FavoriteController@destroy');//->name('favorites.destroy');*/

Route::post('/questions/{question}/favorite','FavoriteController@store')->name('favorites.store');
Route::delete('/questions/{question}/favorite','FavoriteController@destroy')->name('favorites.destroy');
