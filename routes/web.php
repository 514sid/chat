<?php

use Illuminate\Support\Facades\Route;

Route::get('{all}', function() {
    return view('app');
})->where(['all' => '^(?!api/).*'])->name('app');