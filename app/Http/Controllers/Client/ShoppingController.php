<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Jobs\SaveNewCommandJob;
use App\Models\Categorie;
use App\Models\Product;
use App\Repositories\CommandRepository;
use App\Repositories\ProductRepository;
use Cart as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class ShoppingController extends Controller
{
    protected $productRepository;
    protected $commandRepository;

    public function __construct(ProductRepository $productRepository, CommandRepository $commandRepository){
        $this->productRepository = $productRepository;
        $this->commandRepository = $commandRepository;
    }
    //

    //
    public function home(){
        $allProducts = $this->productRepository->productBycategorie(3);
        $featuredProducts = array_slice((array) $allProducts, 0, 3);
        $categories = Categorie::all();
        return view('shop.home', [
            'featuredProducts' => $featuredProducts,
            'categories' => $categories,
        ]);
    }

    public function index(){
        $cartCount = Cart::getTotalQuantity();
        $content = Cart::getContent();
        $total = Cart::getTotal();
        return view('shop.index', [
            'cartCount' => $cartCount,
            'content' => $content,
            'prixTotal' => $total
            ]);
    }
    //
    public function productCategory($idCategorie, $nameCategorie)
    {
        try{
            $cartCount = Cart::getTotalQuantity();
            $content = Cart::getContent();
            $total = Cart::getTotal();
            $products = $this->productRepository->productBycategorie($idCategorie);
            $sousCategory = $this->productRepository->getSouscategorybyCategory($idCategorie);
            return view('shop.categorie', [
                'products' => $products,
                'categorie' => $nameCategorie,
                'categorie_id' => $idCategorie,
                'cartCount' => $cartCount,
                'content' => $content,
                'prixTotal' => $total,
                'sousCategory' => $sousCategory
            ]);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return back()->with('error', 'Une erreur est survenus !');

        }
    }

    public function productSubcategory($id, $name)
    {
        try{
            $cartCount = Cart::getTotalQuantity();
            $content = Cart::getContent();
            $total = Cart::getTotal();
            $products = $this->productRepository->productBysouscategorie($id);

            // Récupérer la sous-catégorie pour obtenir son catégorie parent
            $subCategory = \App\Models\Souscategorie::find($id);
            $categoryId = $subCategory ? $subCategory->categorie_id : null;

            // Récupérer toutes les sous-catégories de la catégorie parent
            $sousCategory = $categoryId ? $this->productRepository->getSouscategorybyCategory($categoryId) : [];

            return view('shop.categorie', [
                'products' => $products,
                'categorie' => $name,
                'categorie_id' => $categoryId,
                'cartCount' => $cartCount,
                'content' => $content,
                'prixTotal' => $total,
                'sousCategory' => $sousCategory
            ]);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return back()->with('error', 'Une erreur est survenus !');

        }
    }
    //
    public function showProduct($codeProduct)
    {
        try{
            $product = $this->productRepository->findProduct($codeProduct);
            return view('shop.produit', [
                'product' => $product,
            ]);

        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return back()->with('error', 'Une erreur est survenus !');
        }
    }
    //
    public function validePanier()
    {
        try{
            $cartCount = Cart::getTotalQuantity();
            $content = Cart::getContent();
            $total = Cart::getTotal();

            return  view('shop.valide_panier', [
                'cartCount' => $cartCount,
                'content' => $content,
                'total' => $total
            ]);
        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return back()->with('error', 'Une erreur est survenus !');
        }

    }

    public function priceXqty(float $price, int $quantity){
        return $price * $quantity;
    }

    public function saveCommande(Request $request)
    {
        try{
            // information de la commande
            $infoClient = $request->all();
            //dd($request->all());
            //code...

            $identification_commande = "ACP".time();
            // enregistrement du panier
            $panier = Cart::getContent();
            $total = Cart::getTotal();
            $dataPanier = [];
            $i = 0;
            // le panier
            foreach ($panier as $produit){
                $product = Product::where('id',$produit->id)->first();
                $dataPanier[$i]['id_product'] = $produit->id;
                $dataPanier[$i]['picture'] = $product->image;
                $dataPanier[$i]['name_product'] = $produit->name;
                $dataPanier[$i]['quantity'] = $produit->quantity;
                $dataPanier[$i]['priceUnit'] = $produit->price;
                $dataPanier[$i]['prices'] = $this->priceXqty($produit->price , $produit->quantity);
                $i ++;
            }
            // enregistrement de la commande
            // Dispatch du job
            SaveNewCommandJob::dispatch($infoClient, $identification_commande, $dataPanier, $total);

            Cart::clear();
            return view('shop.message')->with('success', 'Votre commande à bien été enregistré, vous recevez un mail de confirmation !');

        }catch(\Throwable $th){
            Log::error('methode saveCommand '.$th->getMessage());
            return back()->with('error', 'Une erreur est survenus !');
        }
    }

}
