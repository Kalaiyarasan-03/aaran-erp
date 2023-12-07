<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Webs\Home\Index::class)->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->get('/dashboard', App\Livewire\Dashboard\Index::class)->name('dashboard');

//Erp
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('orders', App\Livewire\Erp\Order\Index::class)->name('orders');
    Route::get('orders/{id}/style', App\Livewire\Erp\Order\Style::class)->name('orders.style');
    Route::get('orders/{id}/job-details', App\Livewire\Erp\Order\JobDetails::class)->name('orders.job-details');

    Route::get('styles', App\Livewire\Erp\Style\Index::class)->name('styles');
    Route::get('fabriclots', App\Livewire\Erp\Fabrication\FabricLot\Index::class)->name('fabriclots');

    Route::get('jobcards', App\Livewire\Erp\Production\Jobcard\Index::class)->name('jobcards');
    Route::get('jobcards/{id}/upsert', App\Livewire\Erp\Production\Jobcard\Upsert::class)->name('jobcards.upsert');

    Route::get('cuttings', App\Livewire\Erp\Production\Cutting\Index::class)->name('cuttings');
    Route::get('cuttings/{id}/upsert', App\Livewire\Erp\Production\Cutting\Upsert::class)->name('cuttings.upsert');

    Route::get('peoutwards', App\Livewire\Erp\Production\PeOutward\Index::class)->name('peoutwards');
    Route::get('peoutwards/{id}/upsert', App\Livewire\Erp\Production\PeOutward\Upsert::class)->name('peoutwards.upsert');
    Route::get('peoutwards/{id}/print', App\Http\Controllers\Erp\Production\PeOutwardPrintController::class)->name('peoutwards.print');

    Route::get('peinwards', App\Livewire\Erp\Production\PeInward\Index::class)->name('peinwards');
    Route::get('peinwards/{id}/upsert', App\Livewire\Erp\Production\PeInward\Upsert::class)->name('peinwards.upsert');

    Route::get('sectionoutwards', App\Livewire\Erp\Production\SectionOutward\Index::class)->name('sectionoutwards');
    Route::get('sectionoutwards/{id}/upsert', App\Livewire\Erp\Production\SectionOutward\Upsert::class)->name('sectionoutwards.upsert');
    Route::get('sectionoutwards/{id}/print', App\Http\Controllers\Erp\Production\SectionOutwardPrintController::class)->name('sectionoutwards.print');

    Route::get('sectioninwards', App\Livewire\Erp\Production\SectionInward\Index::class)->name('sectioninwards');
    Route::get('sectioninwards/{id}/upsert', App\Livewire\Erp\Production\SectionInward\Upsert::class)->name('sectioninwards.upsert');
});


//Master
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('contacts', App\Livewire\Master\Contact\Index::class)->name('contacts');
    Route::get('products', App\Livewire\Master\Product\Index::class)->name('products');
    Route::get('companies', App\Livewire\Master\Tenant\Index::class)->name('companies');
});

//Common
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('cities', App\Livewire\Common\CityList::class)->name('cities');
    Route::get('states', App\Livewire\Common\StateList::class)->name('states');
    Route::get('pincodes', App\Livewire\Common\PincodeList::class)->name('pincodes');
    Route::get('categories', App\Livewire\Common\CategoryList::class)->name('categories');
    Route::get('hsncodes', App\Livewire\Common\HsncodeList::class)->name('hsncodes');
    Route::get('departments', App\Livewire\Common\DepartmentList::class)->name('departments');
    Route::get('colours', App\Livewire\Common\ColourList::class)->name('colours');
    Route::get('sizes', App\Livewire\Common\SizeList::class)->name('sizes');
    Route::get('transports', App\Livewire\Common\TransportList::class)->name('transports');
});
