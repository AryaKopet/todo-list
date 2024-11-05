<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/todo-list', function () {
    return view('/todo-list/index');
});