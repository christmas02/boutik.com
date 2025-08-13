<?php
namespace App\Repositories;

use App\Models\Command;
use App\Services\GeneratePdf;
use App\Services\SendMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommandRepository
{
    protected $sendmail;
    protected $generatepdf;

    public function __construct(SendMail $sendMail, GeneratePdf $generatePdf){
        $this->sendmail = $sendMail;
        $this->generatepdf = $generatePdf;
    }

    public  function saveNewCommand($infoCustomer, $identification_commande, $panier, $amountTotal){
        try {
            DB::beginTransaction();
            //code...
            //dd($infoCustomer);
            // Augmenter la limite de temps d'exécution à 120 secondes
            set_time_limit(1200);
            $command = new Command;
            $user = $infoCustomer['username'].' '.$infoCustomer['firstname'];

            $command->identifiant_commande = $identification_commande;
            $command->username = $infoCustomer['username'];
            $command->firstname = $infoCustomer['firstname'];
            $command->message = 'commande valider';
            $command->lieuxdelivraison = $infoCustomer['livraison'];
            $command->phone = $infoCustomer['phone'];
            $command->email = $infoCustomer['email'];
            $command->products = $panier;
            $command->amount = $amountTotal;
            $command->invoice = '00000_ASP_COMMAND';
            $command->statut = 0;
            $command->send_mail = 0;
            //$command->save();

            $data = [
                "boncommandID" => $identification_commande,
                "amount_ttc" => $amountTotal,
                "date" => Carbon::now()->format('d/m/Y H:i:s'),
                "name_customer" => $user,
                "phone_customer" => $infoCustomer['phone'],
                "email_customer" => $infoCustomer['email'],
                "panier" => json_decode($panier),
            ];

            // appel service generate pdf
            $invoicePdf = $this->generatepdf->generatePdf($data);
            // send mail au customer
            $sendMail = $this->sendmail->sendMailAfterSaveCommande($infoCustomer['email'], $invoicePdf, $user, $identification_commande, $data);
            // update status send mail commande
            $command = Command::where('identifiant_commande', $identification_commande)->first();
            $command->invoice = $identification_commande.'.pdf';
            $command->send_mail = 1; // mail send
            $command->type = "commande sur le site web -- livraison a domicile";
            $command->statut = 1; // commande valider
            $command->save();

            DB::commit();
            return $command;

        } catch (\Throwable $th) {
            Log::error('commandeRepository '.$th->getMessage());
            DB::rollback();
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }




}
