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

Route::get('/','QuestionController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('questions','QuestionController')->except('show');
Route::get('/questions/{slug}','QuestionController@show')->name('questions.show');

Route::post('/questions/{question}/answers','AnswersController@store')->name('answers.store');
Route::get('/questions/{question}/answers/{answer}/edit','AnswersController@edit')->name('answers.edit');
Route::patch('/questions/{question}/answers/{answer}/','AnswersController@update')->name('answers.update');
Route::delete('/questions/{question}/answers/{answer}','AnswersController@destroy')->name('answers.destroy');
Route::post('/answers/{answer}/accept','AcceptAnswerController')->name('answers.accept');
Route::post('/questions/{question}/favourites','FavouritesController@store')->name('questions.favourite');
Route::delete('/questions/{question}/favourites','FavouritesController@destroy')->name('questions.favourite');
Route::post('/questions/{question}/vote', 'VoteQuestionController');
Route::post('/answers/{answer}/vote','VoteAnswerController');