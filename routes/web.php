<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Webs\Home\Index::class)->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->get('/dashboard', App\Livewire\Dashboard\Index::class)->name('dashboard');

//Erp
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('orders', App\Livewire\Erp\Order\Index::class)->name('orders');
    Route::get('orders/{id}/show', App\Livewire\Erp\Order\Style::class)->name('orders.show');

    Route::get('styles', App\Livewire\Erp\Style\Index::class)->name('styles');
    Route::get('fabriclots', App\Livewire\Erp\Fabrication\FabricLot\Index::class)->name('fabriclots');

    Route::get('jobcards', App\Livewire\Erp\Production\Jobcard\Index::class)->name('jobcards');
    Route::get('jobcards/{id}/upsert', App\Livewire\Erp\Production\Jobcard\Upsert::class)->name('jobcards.upsert');

    Route::get('cuttings', App\Livewire\Erp\Production\Cutting\Index::class)->name('cuttings');
    Route::get('cuttings/{id}/upsert', App\Livewire\Erp\Production\Cutting\Upsert::class)->name('cuttings.upsert');

    Route::get('peoutwards', App\Livewire\Erp\Production\PeOutward\Index::class)->name('peoutwards');
    Route::get('peoutwards/{id}/upsert', App\Livewire\Erp\Production\PeOutward\Upsert::class)->name('peoutwards.upsert');

    Route::get('peinwards', App\Livewire\Erp\Production\PeInward\Index::class)->name('peinwards');
    Route::get('peinwards/{id}/upsert', App\Livewire\Erp\Production\PeInward\Upsert::class)->name('peinwards.upsert');

    Route::get('sectionoutwards', App\Livewire\Erp\Production\SectionOutward\Index::class)->name('sectionoutwards');
    Route::get('sectionoutwards/{id}/upsert', App\Livewire\Erp\Production\SectionOutward\Upsert::class)->name('sectionoutwards.upsert');

    Route::get('sectioninwards', App\Livewire\Erp\Production\SectionInward\Index::class)->name('sectioninwards');
    Route::get('sectioninwards/{id}/upsert', App\Livewire\Erp\Production\SectionInward\Upsert::class)->name('sectioninwards.upsert');
});

////Admin
//Route::middleware(['auth:sanctum', 'verified'])->group(function () {
////
//});
