<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Webs\Home\Index::class)->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->get('/dashboard', App\Livewire\Dashboard\Index::class)->name('dashboard');

//Audit
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('clients', App\Livewire\Master\Client\Index::class)->name('clients');
    Route::get('clients/{id}/show', App\Livewire\Master\Client\Show::class)->name('clients.show');
    Route::get('fees', App\Livewire\Master\Client\Fee::class)->name('fees');
    Route::get('banks', App\Livewire\Master\Client\Bank::class)->name('banks');
    Route::get('gstfillings', App\Livewire\Master\Client\Gstfilling::class)->name('gstfillings');
    Route::get('bankBalances', App\Livewire\Master\Client\Balance::class)->name('bankBalances');
});

//Admin
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('creditbooks', App\Livewire\Admin\Creditbook\Index::class)->name('creditbooks');
    Route::get('creditbooks/{id}/items', App\Livewire\Admin\Creditbook\Item::class)->name('creditbooks.items');
});
