<?php

use Illuminate\Support\Facades\Route;
use Modules\Menu\Pages\MenusPage;
use Modules\Menu\Vilt\Resources\MenuResource;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Route::get('menus', [MenusPage::class, 'index'])->name('menus.index');
    Route::post('menus/update', [MenusPage::class, 'move'])->name('menus.move');
});