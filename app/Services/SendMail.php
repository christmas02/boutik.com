<?php

namespace App\Services;


use App\Mail\Confirmedcommand;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMail
{
    public function sendMailAfterSaveCommande($email, $pdfContent, $user, $identification_commande, $data)
    {
        try{
            Log::info('methode SendMail - Enter in send mail service');
            Mail::to($email)->send(new Confirmedcommand($pdfContent, $user, $identification_commande, $data));
            return true;
        }catch(\Throwable $th){
            Log::error($th->getMessage());
        }
    }
}
