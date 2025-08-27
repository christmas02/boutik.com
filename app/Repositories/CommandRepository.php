<?php
namespace App\Repositories;

use App\Models\Command;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommandRepository
{
    public function getCommand() { return Command::all(); }

    public function firstCommand($identification_commande)
    {
        try{
            $command = Command::where('identifiant_commande',$identification_commande)->first();
            $products = json_decode($command->products);
            $data_product = [];
            $i = 0;
            //dd($products);
            foreach ($products as $items){
                $product = Product::find($items->id_product);
                $data_product[$i]["id_product"] = $product->id;
                $data_product[$i]["name_product"] = $product->nom;
                $data_product[$i]["picture"] = $product->image;
                $data_product[$i]["priceUnit"] = $items->priceUnit;
                $data_product[$i]["prices"] = $items->prices;
                $data_product[$i]["code_product"] = $product->code_product;
                $data_product[$i]["quantity"] = $items->quantity;
                $i++;
            }

            return $data = [
                'command' => $command,
                'products' => $data_product,
            ];

        }catch(\Throwable $th){
            Log::error('commandRepository-save '.$th->getMessage());
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function saveNewCommand($infoClient, $identification_commande, $panier, $amountTotal){
        try {
            DB::beginTransaction();
            // code...
            // dd($infoCustomer);
            // Augmenter la limite de temps d'exécution à 120 secondes
            // set_time_limit(1200);
            $command = new Command;

            $command->identifiant_commande = $identification_commande;
            $command->username = $infoClient['username'];
            $command->firstname = $infoClient['firstname'];
            $command->message = 'commande valider';
            $command->lieuxdelivraison = $infoClient['livraison'];
            $command->phone = $infoClient['phone'];
            $command->email = $infoClient['email'];
            $command->products = $panier;
            $command->amount = $amountTotal;
            $command->invoice = '00000_ASP_COMMAND';
            $command->statut = 0;
            $command->send_mail = 0;
            $command->save();

            DB::commit();
            return $command;

        } catch (\Throwable $th) {
            Log::error('commandRepository-save '.$th->getMessage());
            DB::rollback();
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function updateCommandAfterSendMail($identification_commande)
    {
        try{
            DB::beginTransaction();
            // code...
            $command = Command::where('identifiant_commande', $identification_commande)->first();
            $command->invoice = $identification_commande.'.pdf';
            $command->send_mail = 1; // mail send
            $command->type = "commande sur le site web -- livraison a domicile";
            $command->statut = 1; // commande valider
            $command->save();

            DB::commit();
            return $command;

        }catch(\Throwable $th){
            Log::error('commandRepository-update '.$th->getMessage());
            DB::rollback();
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }




}
