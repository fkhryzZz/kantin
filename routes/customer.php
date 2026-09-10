<?php

use Illuminate\facades\Route;
 Route::get('/{canteen:slug}', function ($canteen) {
    return "KATALOG: " . $canteen;
 })->name('home');