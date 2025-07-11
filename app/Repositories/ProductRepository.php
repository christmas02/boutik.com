<?php
namespace App\Repositories;

use App\Models\categorie;
use App\Models\Galerie;
use App\Models\Historicproduct;
use App\Models\product;
use App\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductRepository
{
    protected $service;

    public function __construct(Service $service){
        $this->service = $service;
    }

    // METHOD CATEGORIE ---- MODEL CATEGORIE
    Public function getCategorie(){
        $categorie = Categorie::where('statut', 1)->get();
        return $categorie;
    }

    public function saveNewCategorie($data)
    {
        try{
            return $data;
        }catch(\Throwable $th){
        }
    }

    public function upadatOldCategorie($data)
    {
        try{
            $category = Categorie::find($data['id']);
            $category->name = $data['nom'];
            $category->save();
            return $category;

        }catch(\Throwable $th){

        }
    }


    // METHOD PRODUCTS ---- MODEL PRODUCTS
    public function getProduct()
    {
        try{
            $products = Product::where('archive',null)->get();
            $i = 0;
            $product = [];

            foreach ($products as $value){
                $categoryProduct = Categorie::find($value->categorie);

                // data products
                $product[$i]["id"] = $value->id;
                $product[$i]["name"] = $value->nom;
                $product[$i]["amount"] = $value->montant;
                $product[$i]["quantity"] = $value->stock;
                $product[$i]["description"] = $value->description;
                $product[$i]["type_achat"] = $value->type_achat;
                $product[$i]["category"] = $categoryProduct->name;
                $product[$i]["picture"] = $value->image;
                $product[$i]["code_product"] = $value->code_product;
                $product[$i]["slug"] = $value->slug;
                $product[$i]["date_publication"] = $value->created_at;
                $product[$i]["code_product"] = $value->code_product;
                $i++;
            }
            return $product;
        }catch(\Throwable $th){
        }
    }

    public function findProduct($code_product){
        try{
            $getProduct = Product::where('code_product',$code_product)->where('archive',null)->first();
            $galerie = Galerie::where('code_product',$code_product)->get();
            $categoryProduct = Categorie::find($getProduct->categorie);
            $historic = Historicproduct::where('code_product',$code_product)->get();


            $product = [
                "id" => $getProduct->id,
                "name" => $getProduct->nom,
                "amount" => $getProduct->montant,
                "quantity" => $getProduct->stock,
                "description" => $getProduct->description,
                "category" => $categoryProduct->name,
                "idcategory" => $getProduct->categorie,
                "typeachat" => $getProduct->typeachat,
                "picture" => $getProduct->image,
                "slug" => $getProduct->slug,
                "archive" => $getProduct->archive,
                "date_publication" => $getProduct->created_at,
                "code_product" => $getProduct->code_product,
                "galerie" => $galerie,
                "historic" => $historic
            ];
            return $product;

        }catch(\Throwable $th){
            Log::error($th->getMessage());
            DB::rollback();
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function saveNewProduct($data)
    {
        try{
            $image = $this->service->uploadFile($data['image']);
            $codeProduct = $this->service->codeProduct($data['categorie']);

            DB::beginTransaction();
            $product = new Product;
            $product->nom = $data['name'];
            $product->montant = $data['amount'];
            $product->description = $data['description'];
            $product->categorie = $data['categorie'];
            $product->image = $image;
            $product->type_achat = $data['type_achat'];
            $product->stock = $data['quantity'];
            $product->code_product = $codeProduct;
            $product->nbrvente = 0;
            $product->slug = $codeProduct.'_'.$data['slug'];

            //dd($product);
            $product->save();

            // traitement de la galerie and save
            foreach ($data['galerie'] as $itemFile) {
                if ($itemFile->isValid()) {
                    $name = $this->service->uploadFile($itemFile);
                    Galerie::create([
                        'image' => $name,
                        'code_product' => $codeProduct
                    ]);
                }
            }
            // gestion de l'historique
            $this->service->historiqStockProduct($codeProduct,$data['quantity']);
            DB::commit();
            // reslute
            return response()->json([
                'data' => $product
            ], 200);

        }catch(\Throwable $th){
            Log::error($th->getMessage());
            DB::rollback();
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
