<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group
(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('project', ProjectController::class);
});

Route::resource('project', ProjectController::class)->names([
    'index' => 'admin.projects.index',
    'create' => 'admin.projects.create',
    'store' => 'admin.projects.store',
    'show' => 'admin.projects.show',
    'edit' => 'admin.projects.edit',
    'update' => 'admin.projects.update',
    'destroy' => 'admin.projects.destroy',
]);



require __DIR__.'/auth.php';
