<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Confirmedcommand extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfContent;
    public $identification_boncommande;
    public $user;
    public $data;

    /**
     * Create a new message instance.
     *
     * @param string $pdf
     * @param int $IdBoncommande
     */
    public function __construct($pdfContent, $user, $identification_boncommande, $data)
    {
        $this->pdfContent = $pdfContent;
        $this->identification_boncommande = $identification_boncommande;
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //var_dump($this->user);
        return $this->from('no_reply@boutik17.com', 'Boutik17')
            ->cc('noreply@boutik17.com') // Remplacez par votre adresse email
            ->subject('Validation de Commande')
            ->markdown('mail.confirmedcommande')
            ->attachData($this->pdfContent, $this->identification_boncommande . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
