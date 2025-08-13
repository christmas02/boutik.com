<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Cart as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        try{
            //dd($content);
            // point sur le panier
            $total = Cart::getTotal();
            $cartCount = Cart::getTotalQuantity();
            $content = Cart::getContent();

            //dd($content, $total, $cartCount);
            return view('shop.panier', [
                'cartCount' => $cartCount,
                'content' => $content,
                'prixTotal' => $total
            ]);

        }catch(\Throwable $th){
            Log::error('Erreur ajout au panier : ' . $th->getMessage());

            return response()->json([
                'error' => true,
                'message' => 'Une erreur est survenue : ' . $th
            ], 500);
        }
    }

    public function addCart(Request $request)
    {
        try{
            //dd($request->all());
            $product = Product::where('id',$request->id)->first();
            // add cart
            $cart = Cart::add([
                'id' => $request->id,
                'name' => $product->nom,
                'price' => $product->montant,
                'picture' => $product->image,
                'quantity' => $request->quantity,
                'metaData' => $product
            ]);
            //dd($cart->getContent());
            return response()->json(['message' => 'Vous avez ajouté '.$product->nom. 'dans votre panier !']);
            //return response()->json(['message' => 'Produit ajouté avec succès - '.$product->nom], 200);

        }catch(\Throwable $th){
            Log::error('Erreur ajout au panier : ' . $th->getMessage());

            return response()->json([
                'error' => true,
                'message' => 'Une erreur est survenue : ' . $th
            ], 500);
        }
    }

    public function update(Request $request)
    {
        //dd($request->all());
        Cart::update($request->productId, [
            'quantity' => ['relative' => false, 'value' => $request->quantity],
        ]);
        $content = Cart::getContent();
        return redirect()->back()->with('cart', 'Votre produit a bien ete ajouter au panier');
    }

    public function updateQuantity(Request $request, $id)
    {
        // Vérifie si la quantité est un nombre valide et positif
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        // Trouver le produit dans le panier (exemple avec un modèle Cart)
        $cartItem = Cart::get($id); // ✅ Correct
        if (!$cartItem) {
            return response()->json(['error' => 'Produit non trouvé'], 404);
        }
        // Mettre à jour la quantité
        $cartItem->quantity = $request->quantity;
        //$cartItem->save();
        $content = Cart::getContent();
        // Recalculer le sous-total
        $newSubtotal = number_format($cartItem->price * $cartItem->quantity, 0, ',', ' ');

        return response()->json([
            'message' => 'Quantité mise à jour avec succès',
            'newSubtotal' => $newSubtotal
        ]);
    }

    public function deleteProduct(Request $request)
    {
        try{
            Cart::remove($request->id);
            return response()->json(['message' => 'Vous avez retiré le produit de votre panier !']);

        }catch(\Throwable $th){
            Log::error('Erreur ajout au panier : ' . $th->getMessage());

            return response()->json([
                'error' => true,
                'message' => 'Une erreur est survenue : ' . $th
            ], 500);
        }
    }

}
