<?php

Route::get('/books', 'BooksController@index');
Route::post('/books', 'BooksController@create');
Route::post('/books/{id}', 'BooksController@update');
Route::delete('/books/{id}', 'BooksController@delete');

Route::get('/categories', 'CategoryController@index');
