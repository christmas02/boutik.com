<?php

namespace App\Jobs;

use App\Repositories\CommandRepository;
use App\Services\GeneratePdf;
use App\Services\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendCommandEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 120; // 2 minutes max
    public $tries = 5; // 5 tentatives

    protected $infoClient;
    protected $identification_commande;
    protected $dataPanier;
    protected $total;

    public function __construct($infoClient, $identification_commande, $dataPanier, $total)
    {
        $this->infoClient = $infoClient;
        $this->identification_commande = $identification_commande;
        $this->dataPanier = $dataPanier;
        $this->total = $total;
    }

    public function handle(CommandRepository $commandRepository, GeneratePdf $generatePdf, SendMail $sendMail)
    {
        try{
            $user = $this->infoClient['username'] . ' ' . $this->infoClient['firstname'];
            // S'assurer que $panier est un tableau
            $panierData = is_array($this->dataPanier) ? $this->dataPanier : json_decode($this->dataPanier, true);
            $data = [
                "boncommandID" => $this->identification_commande,
                "amount_ttc" => $this->total,
                "date" => now()->format('d/m/Y H:i:s'),
                "name_customer" => $user,
                "phone_customer" => $this->infoClient['phone'],
                "email_customer" => $this->infoClient['email'],
                "panier" => $panierData,
            ];

            // appel service generate pdf
            $invoicePdf = $generatePdf->generatePdf($data);
            Log::info("Generation du pdf avec succès", [
                'identifiant' => $this->identification_commande
            ]);

            // send mail au customer
            $reponseSendMail = $sendMail->sendMailAfterSaveCommande($this->infoClient['email'], $invoicePdf, $user, $this->identification_commande, $data);
            if($reponseSendMail == true) {
                Log::info("Envoie du mail avec succès", [
                    'identifiant' => $this->identification_commande
                ]);
                // update status send mail commande
                $commandRepository->updateCommandAfterSendMail($this->identification_commande);
                Log::info("Mise a jour de la commande avec succès", [
                    'identifiant' => $this->identification_commande
                ]);
            }else{
                Log::info("Erreur envoie de mail", [
                    'identifiant' => $this->identification_commande
                ]);
            }

        }catch(\Throwable $e){
            Log::error("Erreur dans SendCommandEmailJob : " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            // Stoppe les retries si c’est une erreur non récupérable
            $this->fail($e);
        }

    }
}
