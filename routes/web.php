<?php

use App\Livewire\Sendmail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mailsend', Sendmail::class)->name('sendmail');
