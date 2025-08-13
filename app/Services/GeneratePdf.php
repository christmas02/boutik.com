<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Log;

class GeneratePdf
{
    public function generatePdf($data)
    {
        try{
            // Augmenter la limite de temps d'exécution à 120 secondes
            // set_time_limit(1200);
            // Configure Dompdf
            //dd($data);
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);

            // HTML template for your PDF
            $html = view('pdf.boncommande', compact('data'))->render();
            // Load HTML content
            $dompdf->loadHtml($html);
            // Set paper size and orientation
            $dompdf->setPaper('A4', 'portrait');
            // Render the PDF
            $dompdf->render();

            // Get the generated PDF content as a string
            $pdfContent = $dompdf->output();
            // Define the path and file name where the PDF will be saved

            $name_file = $data['boncommandID'] . '.pdf';
            $filePath = public_path('invoices/' . $name_file);
            // Save the PDF to the server
            file_put_contents($filePath, $pdfContent);

            return $pdfContent;

        }catch(\Throwable $th){
            dd($th);
            Log::error($th->getMessage());
        }

    }
}
