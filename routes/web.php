<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

// List Contacts
Route::get('/', [ContactController::class, 'index'])->name('contacts.index');

// Add Cantact
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');


// Edit Contact
Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');

// Save Conatact
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

// Delete Contact
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

// Import Contact
Route::get('/contacts/import', [ContactController::class, 'showImportForm'])->name('contacts.import');
Route::post('/contacts/import', [ContactController::class, 'import'])->name('contacts.import.store');
