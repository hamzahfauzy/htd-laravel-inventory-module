<?php

use Illuminate\Support\Facades\Route;

Route::name('items.')->prefix('items')->group(function(){
    Route::get('/', [\App\Modules\Inventory\Controllers\ItemController::class, 'index'])->name('index');
    Route::get('{id}/get-units', [\App\Modules\Inventory\Controllers\ItemController::class, 'getUnit'])->name('get-unit');
    Route::get('{id}', [\App\Modules\Inventory\Controllers\ItemController::class, 'show'])->name('show');
});