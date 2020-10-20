<?php

use Illuminate\Support\Facades\Route;
use Bagoesz21\ConsoleBrowser\Http\Controllers\ConsoleController;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'as' => 'console.',
    'namespace' => 'Bagoesz21\ConsoleBrowser',
    'middleware' => config('console-browser.middleware')
], function ($router) {
    Route::get('console',  [ConsoleController::class, 'index'])->name('index');
    Route::post('console', [ConsoleController::class, 'execute'])->name('execute');
});
