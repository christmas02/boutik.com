<?php

namespace App\Services;

use App\Models\categorie;
use App\Models\Historicproduct;
use Illuminate\Support\Facades\Log;

class Service
{
    public static function codeProduct($category)
    {
        try{
            $categoryInfo = Categorie::find($category);
            $code_category = $categoryInfo->code;
            // Générer un nombre aléatoire entre 0 et 9999
            $randomNumber = mt_rand(0, 9999);
            // Formatter le nombre avec des zéros à gauche pour qu'il ait toujours 4 chiffres
            $formattedNumber = str_pad($randomNumber, 4, '0', STR_PAD_LEFT);

            return $code_category.$formattedNumber;


        }catch(\Throwable $th){
            dd($th->getMessage());
        }
    }

    public static function uploadFile($image): string
    {
        $fichier_name = time() . '.' . $image->getClientOriginalName();
        $image->move(public_path('uploads'), $fichier_name);
        return $fichier_name;
    }

    public function historiqStockProduct($code_product, $quantity)
    {
        try{
            // status operation 1 = Approvisionement
            $historic = new Historicproduct;
            $historic->code_product = $code_product;
            $historic->quantity = $quantity;
            $historic->operation = 1;
            $historic->description = 'Approvisionement du stock';
            $historic->save();

        }catch(\Throwable $th){
            Log::error($th->getMessage());
            dd($th->getMessage());
        }
    }

    public static function uploadMultipleFile($files)
    {
        $liste_file = [];
        foreach ($files as $file) {
            $file_name_clean = preg_replace('/[^A-Za-z0-9\-\.]/', '-', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $fichier_name = $file_name_clean . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fichier_name);
            array_push($liste_file, $fichier_name);
        }

        return json_encode($liste_file);
    }

}
