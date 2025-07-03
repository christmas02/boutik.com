<?php

use App\Http\Controllers\Client\ShoppingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

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


Route::controller(UserController::class)->group(function () {
    Route::get('authentification','loginScreen')->name('login');
    Route::get('mot_de_passe_oublier','forgetpasswordScreen')->name('forgetpassword');
    Route::post('connexion','connexion');
    Route::post('change_password','changePassword');
    Route::post('page/error','pageError');
});

Route::controller(ShoppingController::class)->group(function () {
    Route::get('/','index')->name('home.page');
});



Route::group(['middleware' => 'auth'], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/espace/administrateur', 'index')->name('espace.administrateur');
        // product
        Route::get('/create/product', 'createProduct')->name('createProduct');
        Route::get('/list/product', 'listProduct')->name('listProduct');
        Route::get('/ajax_souscategorie', 'ajaxSouscategorie')->name('ajaxSouscategorie');
        Route::get('/list/categorie', 'listCategory')->name('listCategory');
        Route::post('/saveProduct', 'saveProduct')->name('saveProduct');
        Route::get('/detail/product/{codeProduct}', 'detailProduct')->name('detailProduct');
        Route::post('/saveApprovisionnement', 'saveApprovisionnement')->name('saveApprovisionnement');
        Route::post('/updateProduct', 'updateProduct')->name('updateProduct');
        Route::post('/updatePicture', 'updatePicture')->name('updatePicture');
        Route::post('/saveValueArchive', 'saveValueArchive')->name('saveValueArchive');

        // category and sub categ ory
        Route::get('/list/categorie', 'listCategory')->name('listCategory');
        Route::get('/list/sous/categorie', 'listSubcatgory')->name('listSubcatgory');
        Route::post('/saveCategory', 'saveCategory')->name('saveCategory');
        Route::post('/updateCategory', 'updateCategory')->name('updateCategory');
        Route::post('/saveSouscategory', 'saveSouscategory')->name('saveSouscategory');
        Route::post('/updateSouscategory', 'updateSouscategory')->name('updateSouscategory');
        Route::get('/supprimer/categorie/{identifiant}', 'deletCategory')->name('deletCategory');
        Route::get('/supprimer/sous_categorie/{identifiant}', 'deletSousCategory')->name('deletSousCategory');


    });
    Route::controller(CommandeController::class)->group(function () {
        // Commande
        Route::get('/list/command', 'listCommand')->name('listCommand');
        Route::get('/detail/commande/{identifiant_commande}', 'detailCommand')->name('detailCommand');
        Route::get('/edite/boncommande/{identifiant_boncommande}', 'editBoncommand')->name('editBoncommand');
        Route::get('/download/boncommande/{identifiant_boncommande}', 'downloadBoncommand')->name('downloadBoncommand');
        Route::get('/send/boncommande/{identifiant_boncommande}', 'sendBoncommand')->name('sendBoncommand');

        Route::post('/save/command', 'saveBonCommand')->name('saveBonCommand');
        Route::post('/save/boncommandbycommand', 'saveBoncommandbyCommand')->name('BoncommandbyCommand');
        Route::post('/update/command', 'updateBonCommand')->name('updateBonCommand');
        Route::post('/save/statucommande', 'saveStatuCommande')->name('updateBonCommand');
    });
    Route::controller(CustomerController::class)->group(function () {
        // Clients
        Route::get('/list/client', 'index')->name('listCustomers');
        Route::post('/saveCustomer', 'saveCustomer')->name('saveCustomer');
        Route::post('/updateCustomer', 'updateCustomer')->name('updateCustomer');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/nouveau/administrateur','createAdministrator');
        Route::get('/liste/administrateur','listAdministrator');
        Route::post('/save/administrateur','saveAdministrator');
        Route::post('/update/profiluser','updateProfilUser');
        Route::post('/update/changePasswordUser','changePasswordUser');
        Route::post('/update/administrateur','updateInfoAdmin');
    });
});



