<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function ($canteen) {
    return view('layouts.customer', [
        'canteen' => $canteen,
    ]);
})->name('home');
