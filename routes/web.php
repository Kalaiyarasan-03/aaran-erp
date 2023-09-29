<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Webs\Home\Index::class)->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->get('/dashboard', App\Livewire\Dashboard\Index::class)->name('dashboard');

//Erp
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('orders', App\Livewire\Erp\Order\Index::class)->name('orders');
    Route::get('orders/{id}/show', App\Livewire\Erp\Order\Index::class)->name('orders.show');

    Route::get('styles', App\Livewire\Erp\Style\Index::class)->name('styles');
});

////Admin
//Route::middleware(['auth:sanctum', 'verified'])->group(function () {
////
//});
