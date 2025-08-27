<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Jobs\SaveNewCommandJob;
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
        return redirect('produits_de_categorie/3/Parfumerie');
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
            $sousCategory = $this->productRepository->getSouscategorybyCategory($id);

            return view('shop.categorie', [
                'products' => $products,
                'categorie' => $name,
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
            return view('shop.message')->with('success', 'Votre commande à bien été enregistrer !');

        }catch(\Throwable $th){
            Log::error('methode saveCommand '.$th->getMessage());
            return back()->with('error', 'Une erreur est survenus !');
        }
    }

}
