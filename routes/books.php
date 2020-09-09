<?php

use Illuminate\Support\Facades\Route;

Route::get('/books', 'BooksController@index')->name('books.index');
Route::post('books', 'BooksController@store')->name('books.store');
Route::put('books/{book}', 'BooksController@update')->name('books.update');
Route::delete('books/{book}', 'BooksController@destroy')->name('books.destroy');
