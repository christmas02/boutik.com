<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }
    //
    public function index(){
        return view('backoffice.pages.index');
    }
    //

    // Category methode
    public function listCategory()
    {
        $category = $this->productRepository->getCategorie();
        return view('backoffice.pages.listCategory', ['categories' => $category]);
    }
    public function saveCategory(Request $request)
    {
        try{
            $data = [
                'name' => $request->get('nom_categ'),
                'code' => $request->get('code_categ'),
                'statut' => '1'
            ];
            $newCategorie = $this->productRepository->saveNewCategorie($data);

            return redirect('/list/categorie')->with('success', 'La nouvelle catégorie a été bien eregistre');

        }catch(\Throwable $th){
            //dd($th);
            Log::error($th->getMessage());
            return redirect('/list/categorie')->with('error', $th->getMessage());
        }
    }
    public function updateCategory(Request $request)
    {
        try{
            $data = [
                'nom' => $request->get('nom_category'),
                'id' => $request->get('id_category')
            ];
            $oldCategorie = $this->productRepository->upadatOldCategorie($data);
            return redirect('/list/categorie')->with('success', 'La nouvelle sous catégorie a été bien eregistre');
        }catch(\Throwable $th){
            //dd($th);
            Log::error($th->getMessage());
            return redirect('/list/categorie')->with('error', $th->getMessage());
        }
    }
    public function deletCategory($identifiant)
    {
        try{
            $categorie = Categorie::where('id',$identifiant)->first();
            $categorie->statut = 0;
            $categorie->save();
            return back()->with('success', 'Opération éffectuer avec succcess !');
        }catch(\Throwable $th){
            dd($th);
        }

    }
    //

    // Product methode

    public function createProduct(){
        $category = $this->productRepository->getCategorie();
        return view('backoffice.pages.creatProduct', ['categories' => $category]);
    }
    public function listProduct()
    {
        $produits = $this->productRepository->getProduct();
        return view('backoffice.pages.listProduct', ['produits' => $produits]);
    }

    public function saveProduct(Request $request)
    {
        //dd($request->all());
        try{
            // Traitement des images
            if($files = $request->file('images')){
                if(count($files)<= 4){
                    $galerie = $files;
                }else{
                    $cotaValide = count($files) - 1;
                    return redirect()->back()->with('error', "Enregistrement impossible, vous disposez d'un quota de 4 images");
                }
            }
            // slug du produit
            $slug = str_replace(' ','_',$request->name);
            // data new product
            $data = [
                'name' => $request->name,
                'amount' => $request->amount,
                'description' => $request->description,
                'categorie' => $request->categorie,
                'type_achat' => $request->typeachat,
                'quantity' => $request->quantity,
                'image' => $request->picture,
                'galerie' => $request->file('images'),
                'slug' => $slug
            ];

           // dd($data);

            $newProduct = $this->productRepository->saveNewProduct($data);

            if($newProduct->getStatusCode() == 200){
                return redirect('/list/product')->with('success', 'La nouvelle catégorie a été bien eregistre');
            } else {
                return back()->with('error', 'Une erreur est survenus !');
            }

        }catch(\Throwable $th){
            dd($th);
            return back()->with('error', 'Une erreur est survenus !');
        }
    }

    public function detailProduct($code_product)
    {
        try{
            $category = $this->productRepository->getCategorie();
            $product =  $this->productRepository->findProduct($code_product);
           // dd($product);

            return view('backoffice.pages.detailProduct',['categories' => $category,'product'=> $product]);

        }catch (\Throwable $th){
            dd($th);
            Log::error($th->getMessage());
            return back()->with('danger', 'Une erreur est survenus !');
        }
    }

    public function saveApprovisionnement(Request $request)
    {
        try{
            //dd($request->all());
            $code_product = $request->code_product;
            $new_quantity = $request->new_quantity;
            $old_quantity = $request->old_quantity;

            DB::beginTransaction();
            $product = Produit::where('code_product',$code_product)->first();
            $product->stock = ($old_quantity + $new_quantity);
            $product->save();

            $this->historiqStockProduct($code_product,($old_quantity + $new_quantity));
            DB::commit();

            return back()->with('success', 'La nouvelle catégorie a été bien eregistre');

        }catch (\Throwable $th){
            Log::error($th->getMessage());
            DB::rollback();
            return back()->with('error', 'Une erreur est survenus !');
        }
    }
    public function updateProduct(Request $request)
    {
        try{
            ///dd($request->all());
            $code_product = $request->code_product;

            $name = $request->name;
            $amount = $request->amount;
            $description = $request->description;
            $category = $request->categorie;
            $subcategory = $request->souscategorie;

            $product = Produit::where('code_product',$code_product)->first();
            $product->nom = $name;
            $product->montant = $amount;
            $product->description = $description;
            $product->souscategorie = $subcategory;
            $product->categorie = $category;
            $product->save();

            return back()->with('success', 'La mise a jour du produit a été bien éffèctuer');

        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return back()->with('error', 'Une erreur est survenus !');        }

    }
    public function updatePicture(Request $request)
    {
        try{
            //dd($request->all());
            $code_product = $request->code_product;
            $image = self::uploadFile($request->picture);
            $product = Produit::where('code_product',$code_product)->first();
            $product->image = $image;
            $product->save();

            return back()->with('success', 'La mise a jour du produit a été bien éffèctuer');

        }catch(\Throwable $th){
            Log::error($th->getMessage());
            return back()->with('error', 'Une erreur est survenus !');
        }
    }
    public function saveValueArchive(Request $request)
    {
        try{
            // dd($request->all());
            $code_product = $request->code_product;
            $archive = $request->archive;
            $product = Produit::where('code_product',$code_product)->first();
            $product->archive = $archive;
            $product->save();

            return redirect('/list/product')->with('success', 'La mise a jour du produit a été bien éffèctuer');

        }catch(\Throwable $th){
            Log::error($th->getMessage());
            dd($th->getMessage());
        }

    }





}
