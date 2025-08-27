<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Commande;
use App\Models\Transaction;
use App\Repositories\CommandRepository;
use App\Repositories\ProductRepository;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CommandController extends Controller
{
    protected $commandRepository;

    public function __construct(CommandRepository $commandRepository){
        $this->commandRepository = $commandRepository;
    }

    public function listCommand()
    {
        try {
            $commands = $this->commandRepository->getCommand();
            return view('backoffice.command.listCommand', ['commands' => $commands]);
        } catch (\Throwable $th) {
            dd($th);
            Log::error($th->getMessage());
            return redirect()->back()->with('danger', 'Veille ressayez svp');
        }
    }

    public function detailCommand($identification_commande)
    {
        try {
            $command = $this->commandRepository->firstCommand($identification_commande);
            //$status = Command::statusExectutionCommande();
            //$transaction = Transaction::where('command_id', $command['command']->identifiant_commande )->first();
            $product = $command['products'];
            //dd($product, $status, $command);
            return view('backoffice.command.detailCommand', ['command' => $command, 'products' => $product, ]);
        } catch (\Throwable $th) {
            dd($th);
            Log::error($th->getMessage());
            return redirect()->back()->with('danger', 'Veille ressayez svp');
        }
    }
}
