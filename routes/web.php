<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\OrderController;



Route::get('/', function () {
    return view('welcome');
});


//product

Route::get('/product/all', [ProductController :: class, 'index'])->name('product.index');
Route::get('/product/add', [ProductController :: class, 'add'])->name('product.add');
Route::post('/product/store', [ProductController :: class, 'store'])->name('product.store');
Route::get('/product/{product_id}', [ProductController ::class, 'edit']) ->name('product.edit');
Route::put('/product/{product_id}', [ProductController :: class, 'update'])->name('product.update');
Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');

//customer
Route::get('/customer/all', [CustomerController :: class, 'index'])-> name('customer.index');
Route::get('/customer/add', [CustomerController :: class, 'add'])-> name('customer.add');
Route::post('/customer/store', [CustomerController :: class, 'store'])-> name('customer.store');
Route::get('/customer/{customer_id}', [CustomerController :: class, 'edit'])-> name('customer.edit');
Route::put('/customer/{customer_id}', [CustomerController :: class, 'update'])->name('customer.update');
Route::get('/customer/show/{id}', [CustomerController :: class, 'show'])-> name('customer.show');




//isssue
Route::get('/issue/all', [IssueController :: class, 'index'])-> name('issue.index');
Route::get('/issue/add', [IssueController :: class, 'add'])-> name('issue.add');
Route::post('/issue/store', [IssueController :: class, 'store'])-> name('issue.store');
Route::get('/issue/{issue_id}', [IssueController:: class, 'edit'])->name('issue.edit');
Route::put('/issue/update/{issue_id}', [IssueController:: class, 'update'])->name('issue.update');
Route::get('/issue/show/{issue_id}', [IssueController :: class, 'show'])-> name('issue.show');


//order
Route::get('/order/add', [OrderController ::class, 'addOrder']) ->name('order.add');
Route::post('/order/save', [OrderController ::class, 'save']) ->name('order.save');
Route::get('/order/all', [OrderController ::class, 'allorders']) ->name('order.allorders');
Route::get('/order/show/{order_number}', [OrderController::class, 'show'])->name('order.show');
Route::get('/order/print/{order_number}', [OrderController::class, 'print']) ->name('order.print');
Route::get('/order/csv/{order_number}', [OrderController::class, 'csv'])->name('order.csv');
Route::post('/order/export', [OrderController::class, 'exportCsv'])->name('order.export');





