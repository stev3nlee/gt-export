<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

/* PRODUCT */
Route::get('/product-listing', function () {
    return view('product/product-listing');
});

Route::get('/product-listing-detail', function () {
    return view('product/product-listing-detail');
});

Route::get('/search', function () {
    return view('product/search');
});

Route::get('/search-empty', function () {
    return view('product/search-empty');
});

/* INFORMATION */
Route::get('/contact-us', function () {
    return view('information/contact-us');
});

Route::get('/about-us', function () {
    return view('information/about-us');
});

Route::get('/faq', function () {
    return view('information/faq');
});

Route::get('/privacy', function () {
    return view('information/privacy');
});

Route::get('/disclaimers', function () {
    return view('information/disclaimers');
});

Route::get('/faq', function () {
    return view('information/faq');
});

Route::get('/regulation-details', function () {
    return view('information/regulation-details');
});

Route::get('/procurement-flow', function () {
    return view('information/procurement-flow');
});

/* AUTH */
Route::get('/login', function () {
    return view('auth/login');
});
Route::get('/register', function () {
    return view('auth/register');
});
Route::get('/guest', function () {
    return view('auth/guest');
});
Route::get('/forgot-password', function () {
    return view('auth/forgot-password');
});
Route::get('/recovery', function () {
    return view('auth/recovery');
});

/* MEMBER AREA */
Route::get('/personal-info', function () {
    return view('member/personal-info');
});

Route::get('/transaction-history', function () {
    return view('member/transaction-history');
});

Route::get('/quotation-history', function () {
    return view('member/quotation-history');
});

Route::get('/shipment-documentation', function () {
    return view('member/shipment-documentation');
});

Route::get('/invoice', function () {
    return view('invoice');
});

