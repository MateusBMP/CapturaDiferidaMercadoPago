<?php

    require_once __DIR__  . '/vendor/autoload.php';
    require_once __DIR__  . '/load-dotenv.php';

    $accessToken = $_ENV['ACCESS_TOKEN'];

    MercadoPago\SDK::setAccessToken("{$accessToken}");

    //Gera o access token manualmente 
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.mercadopago.com/v1/card_tokens?access_token={$accessToken}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>"{\n\t\"card_number\": \"4235647728025682\",\n\t\"expiration_year\": 2023,\n\t\"expiration_month\": 06,\n\t\"security_code\": \"313\",\n\t\"cardholder\": {\n\t  \"identification\":{\n\t    \"type\": \"CPF\",\n\t    \"number\": \"12345678909\"\n\t  },\n\t  \"name\": \"APRO APRO\"\n\t}\n}\n\n\n",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
    ),
    ));

    $response = curl_exec($curl);

    $responseArray = json_decode($response, true);
    $token = $responseArray['id'];

    curl_close($curl);


    //echo $token.PHP_EOL;



    //Cria o pagamento com apenas autorização, sem captura
    $payment = new MercadoPago\Payment();
    $payment->transaction_amount = 5;
    $payment->capture = false;
    $payment->token = $token;
    $payment->description = "Produto teste";
    $payment->installments = 1;
    $payment->payment_method_id = "visa";
    $payment->external_reference = 1234;
    $payment->payer = array(
    "email" => "test_user_84140351@testuser.com"
    );  

    $payment->save();     
    echo 'Pagamento: '.$payment->id.PHP_EOL;
    echo 'Status: '.$payment->status.PHP_EOL;
    echo 'Status Detail: '.$payment->status_detail.PHP_EOL;


    //Captura o pagamento

    $payment = MercadoPago\Payment::find_by_id($payment->id);
    $payment->capture = true;
    $payment->update();

    echo 'Pagamento: '.$payment->id.PHP_EOL;
    echo 'Status: '.$payment->status.PHP_EOL;
    echo 'Status Detail: '.$payment->status_detail.PHP_EOL;
