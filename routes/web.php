<?php

use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ShoppingController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CommandController;


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

Route::controller(TestController::class)->group(function () {
    Route::get('/pin_encrypte','encryptPin');
    Route::get('/test_send_mail','testSendMail');
});

//view shop
Route::view('shopping', 'shop.index')->name('shopping');
Route::view('categorie', 'shop.categorie')->name('categorie');
Route::view('produit', 'shop.produit')->name('produit');
Route::view('panier', 'shop.panier')->name('panier');
Route::view('valide_panier', 'shop.valide_panier')->name('valide_panier');
Route::view('model_mail_commande', 'mail.template');


Route::controller(TestController::class)->group(function () {
    Route::get('authentification','loginScreen')->name('login');
    Route::get('mot_de_passe_oublier','forgetpasswordScreen')->name('forgetpassword');
    Route::post('connexion','connexion');
    Route::post('change_password','changePassword');
    Route::post('page/error','pageError');
});

Route::controller(ShoppingController::class)->group(function () {
    Route::get('/','home')->name('home.page');
    Route::get('/produits_de_categorie/{id}/{categorie}', 'productCategory')->name('productCat');
    Route::get('/produits_de_sous_categorie/{id}/{name}', 'productSubcategory')->name('productScat');

    Route::get('/produit/{code_produit}', 'showProduct')->name('showProduct');
    Route::get('/valide_panier', 'validePanier')->name('checkout');
    Route::post('/valide_commande', 'saveCommande');
});

Route::controller(CartController::class)->group(function () {
    Route::post('/ajouter_au_panier', 'addCart')->name('add.cart');
    Route::get('/mon_panier', 'index')->name('cart');
    Route::post('/update_quantity/{id}', 'updateQuantity');
    Route::post('/delet_produit', 'deleteProduct')->name('delete.product');

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
    Route::controller(CommandController::class)->group(function () {
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

    Route::controller(TestController::class)->group(function () {
        Route::get('/nouveau/administrateur','createAdministrator');
        Route::get('/liste/administrateur','listAdministrator');
        Route::post('/save/administrateur','saveAdministrator');
        Route::post('/update/profiluser','updateProfilUser');
        Route::post('/update/changePasswordUser','changePasswordUser');
        Route::post('/update/administrateur','updateInfoAdmin');
    });
});



