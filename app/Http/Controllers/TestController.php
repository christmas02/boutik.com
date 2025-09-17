<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    //
    public static function testSendMail()
    {
        try{
            Mail::raw('Test mail', function($m) {
                $m->to('christian.dev.alexis@gmail.com')
                    ->subject('Test SMTP');
            });
            return 'mail send';
        }catch(\Throwable $th){
            dd($th->getMessage());
        }
    }

    public static function encryptPin()
    {
        $pin = "3451";

// Ta clé publique reformatée en PEM
        $publicKeyPem = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCkq3XbDI1s8Lu7SpUBP+bqOs/MC6PKWz6n/0UkqTiOZqKqaoZClI3BUDTrSIJsrN1Qx7ivBzsaAYfsB0CygSSWay4iyUcnMVEDrNVOJwtWvHxpyWJC5RfKBrweW9b8klFa/CfKRtkK730apy0Kxjg+7fF0tB4O3Ic9Gxuv4pFkbQIDAQAB
-----END PUBLIC KEY-----
EOD;

// Charger la clé publique
        $publicKey = openssl_pkey_get_public($publicKeyPem);

        if (!$publicKey) {
            die("❌ Erreur : Clé publique invalide");
        }


// Chiffrement RSA avec padding PKCS1
        if (openssl_public_encrypt($pin, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING)) {
            $encryptedBase64 = base64_encode($encrypted);
            echo $encryptedBase64 . PHP_EOL;
        } else {
            echo "❌ Erreur lors du chiffrement.";
        }

    }

}
