<?php

namespace App\Jobs;

use App\Repositories\CommandRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveNewCommandJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $commandRepository->saveNewCommand(
            $this->infoClient,
            $this->identification_commande,
            json_encode($this->dataPanier),
            $this->total
        );
    }
}
