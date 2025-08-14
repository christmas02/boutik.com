<?php

namespace App\Jobs;

use App\Repositories\CommandRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SaveNewCommandJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 120; // 2 minutes max
    public $tries = 5; // 5 tentatives

    protected $infoClient;
    protected $identification_commande;
    protected $dataPanier;
    protected $total;

    /**
     * Crée une nouvelle instance du job.
     */
    public function __construct($infoClient, $identification_commande, $dataPanier, $total)
    {
        $this->infoClient = $infoClient;
        $this->identification_commande = $identification_commande;
        $this->dataPanier = $dataPanier;
        $this->total = $total;
    }

    /**
     * Exécution du job.
     */
    public function handle(CommandRepository $commandRepository)
    {
        try {
            // Reconnexion MySQL pour éviter "server has gone away"
            // Sauvegarde de la commande
            $commande = $commandRepository->saveNewCommand(
                $this->infoClient,
                $this->identification_commande,
                json_encode($this->dataPanier),
                $this->total
            );

            Log::info("Commande enregistrée avec succès", [
                'identifiant' => $this->identification_commande
            ]);

            // Lancer l’envoi d’email dans un autre job
            SendCommandEmailJob::dispatch(
                $this->infoClient,
                $this->identification_commande,
                $this->dataPanier,
                $this->total
            );

            Log::info("Execution de l'envoie de mail", [
                'identifiant' => $this->identification_commande
            ]);

        } catch (Throwable $e) {
            Log::error("Erreur dans SaveNewCommandJob : " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            // Stoppe les retries si c’est une erreur non récupérable
            $this->fail($e);
        }
    }
}
