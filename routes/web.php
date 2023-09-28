<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Webs\Home\Index::class)->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->get('/dashboard', App\Livewire\Dashboard\Index::class)->name('dashboard');

//Audit
//Route::middleware(['auth:sanctum', 'verified'])->group(function () {
////    Route::get('clients', App\Livewire\Master\Client\Index::class)->name('clients');
//});
//
////Admin
//Route::middleware(['auth:sanctum', 'verified'])->group(function () {
////
//});
