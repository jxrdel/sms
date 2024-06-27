<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/Login', [LoginController::class, 'index'])->name('login');
Route::get('/Logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/', [Controller::class, 'index'])->name('/');
    Route::get('/Suppliers', [SupplierController::class, 'index'])->name('suppliers');
    Route::get('/SearchSuppliers', [SupplierController::class, 'search'])->name('searchsuppliers');
    Route::get('/Services', [ServiceController::class, 'index'])->name('services');
    Route::get('/Contacts', [ContactController::class, 'index'])->name('contacts');
    Route::get('/getcontacts', [ContactController::class, 'getContacts'])->name('getcontacts');
    Route::get('/Users', [UserController::class, 'index'])->name('users');
    Route::get('/getusers', [UserController::class, 'getUsers'])->name('getusers');
    Route::get('/getsuppliers', [SupplierController::class, 'getSuppliers'])->name('getsuppliers');
    Route::get('/getactivesuppliers', [SupplierController::class, 'getActiveSuppliers'])->name('getactivesuppliers');
    Route::get('/getinactivesuppliers', [SupplierController::class, 'getInactiveSuppliers'])->name('getinactivesuppliers');
    Route::get('/getindividuals', [SupplierController::class, 'getIndividuals'])->name('getindividuals');
    Route::get('/getservices', [ServiceController::class, 'getServices'])->name('getservices');
    Route::get('/Categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/getcategories', [CategoryController::class, 'getCategories'])->name('getcategories');
    Route::get('/getsubcategories', [CategoryController::class, 'getSubcategories'])->name('getsubcategories');
    Route::get('/Manual', [Controller::class, 'manual'])->name('manual');
});
