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
    return view('welcome');
});

//view shop
Route::view('shopping', 'shop.index')->name('shopping');
Route::view('categorie', 'shop.categorie')->name('categorie');
Route::view('produit', 'shop.produit')->name('produit');
Route::view('panier', 'shop.panier')->name('panier');
Route::view('valide_panier', 'shop.valide_panier')->name('valide_panier');



