<?php
namespace App\Repositories;

use App\Models\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommandRepository
{

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
