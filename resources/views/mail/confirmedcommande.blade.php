<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style type="text/css">
        body{
            font-family: 'Montserrat', sans-serif;
            background-color: #f6f7fb;
            display: block;
            width: 650px;
            padding: 0 12px;
        }
        a{
            text-decoration: none;
        }
        span {
            font-size: 14px;
        }
        p {
            font-size: 13px;
            line-height: 1.7;
            letter-spacing: 0.7px;
            margin-top: 0;
        }
        .text-center{
            text-align: center
        }
        h6 {
            font-size: 16px;
            margin: 0 0 18px 0;
        }
        @media only screen and (max-width: 767px){
            body{
                width: auto;
                margin: 20px auto;
            }
            .logo-sec{
                width: 500px !important;
            }
        }
        @media only screen and (max-width: 575px){
            .logo-sec{
                width: 400px !important;
            }
        }
        @media only screen and (max-width: 480px){
            .logo-sec{
                width: 300px !important;
            }
        }
        @media only screen and (max-width: 360px){
            .logo-sec{
                width: 250px !important;
            }
        }
    </style>
</head>
<body style="margin: 30px auto;">
<table style="width: 100%; background-color: #fff;">
    <tbody>
    <tr>
        <td>
            <table style="background-color: #fff; width: 100%">
                <tbody>
                <tr>
                    <td>
                        <table style="padding: 30px">
                            <tbody>
                            <tr class="logo-sec" style="display: flex; align-items: center; justify-content: space-between; width: 650px;">
                                <td><h2>BOUTIKCOM</h2></td>
                                <td style="text-align: right; color:#999">
                                    <span>Commande n. : {{ $identification_boncommande }} <br> Passée le : {{ $data['date'] }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table style="margin: 0 auto; background-color: #fff; border-radius: 8px">
                <tbody>
                <tr>
                    <td style="padding: 30px">
                        <h6 style="font-weight: 600">Merci pour votre commande {{ $identification_boncommande }}.</h6>
                        <p>
                            Nous commençons à la traîter. Nous vérifierons rapidement la disponibilité des produits que
                            vous avez sélectionnés et si tout est bon, nous vous informerons de l'expédition du colis.
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
            <table style="width:100%;margin:0px 0 10px 0;padding:0px 30px">
                <thead>
                <tr>
                    <th colspan="4" style="padding:5px 0;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:bold;text-align:left;border-bottom:1px solid #000000;color:#000000">Récapitulatif de la commande</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['panier'] as $item)
                <tr>
                    <td style="padding:20px 25px 20px 0" width="80">
                        <a href="#" style="color:#000000;text-decoration:none" ><img alt="" src="{{ env('IMAGES_PATH_MAIL') }}/{{ $item['picture'] }}" style="display:block" width="80" ></a>
                    </td>
                    <td style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#000000;line-height:20px;padding:25px 20px 15px 0" valign="top">
                        <a href="#" style="color:#000000;text-decoration:none" > {{ $item['name_product'] }} </a>
                        <br>
                    </td>
                    <td style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#000000;text-align:right;padding:25px 0 0 0" valign="top" width="60">{{ $item['quantity']  }} &nbsp;pcs</td>
                    <td style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#000000;text-align:right;padding:25px 0 0 0" valign="top" width="105">{{ number_format($item['prices'] ) }} &nbsp; XOF</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="border-bottom:1px solid #000000;padding:15px 0 0 0"></td>
                </tr>
                <tr>
                    <td colspan="3" style="padding:15px 0 5px 0;font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#000000">Montant total de la commande</td>
                    <td style="padding:15px 0 5px 0;font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#000000;text-align:right" valign="top" width="105">{{ number_format($data['amount_ttc']) }}&nbsp;XOF</td>
                </tr>
                </tbody>
            </table>


            <table style="width:100%; padding:0px 30px">
                <tbody>
                <tr>
                    <td style="font-family:Arial,Helvetica,sans-serif;font-size:14px;line-height:22px;color:#000000">
                        <p style="margin:20px 0"><a style="color:#000000; font-weight: bold"> BOUTIKCOM</a></p>
                        <p style="margin:20px 0">Nous sommes disponibles pour vous aider via notre Service clients. Vous pouvez nous&nbsp;contacter par e-mail à l'adresse <a style="color:#000000" href="mailto:info@notino.fr" target="_blank">
                                info@notino.fr</a> ou par téléphone au 0033 (0)1 81 22 12 88 de lun-ven 9h-17h.</p>
                        <p style="margin:20px 0"><span style="font-size:8pt"><strong><a style="color:#000000">NTN Beauté SAS</a></strong>, 10 rue du Colisée, 75008 Paris, France, N° de TVA intracommunautaire : FR48&nbsp;824560346</span></p></td>
                </tr>
                </tbody>
            </table>
            <table style="margin: 0 auto; margin-top: 30px">
                <tbody>
                <tr style="text-align: center">
                    <td>
                        <p style="color: #999; margin-bottom: 0">Cocody, Abidjan Côte d'Ivoire</p>
                        <p style="color: #999; margin-bottom: 0"><a href="#" style="color: #006666"> </a></p>
                        <p style="color: #999; margin-bottom: 0"> </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
