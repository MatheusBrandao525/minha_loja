<?php

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\MercadoPagoConfig;

class CheckoutController
{

    public function exibeCheckout()
    {
        include ROOT_PATH . '/views/checkout.php';
    }

    public function processarPagamento()
    {
        $input = file_get_contents('php://input');
        $inputArray = json_decode($input, true);
 
        MercadoPagoConfig::setAccessToken(getenv("MP_SECRET_KEY"));

        $client = new PaymentClient();
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["X-Idempotency-Key: payment192839qw8sd7db-2xx2s-23wdh"]);


        // $payment = $client->create($inputArray, $request_options);

        $payment = $client->create([
            "transaction_amount" => (float) $inputArray['transaction_amount'],
            "token" => $inputArray['token'],
            "description" => $inputArray['description'],
            "installments" => $inputArray['installments'],
            "payment_method_id" => $inputArray['payment_method_id'],
            "issuer_id" => $inputArray['issuer_id'],
            "payer" => [
                "email" => $inputArray['payer']['email'],
                "identification" => [
                    "type" => $inputArray['payer']['identification']['type'],
                    "number" => $inputArray['payer']['identification']['number']
                ]
                ],
            "external_reference" => $inputArray['external_reference']
        ], $request_options);
        echo json_encode($payment, JSON_PRETTY_PRINT);
    }

    public function redirecionaParaTelaDeSucesso()
    {
        include ROOT_PATH . '/views/sucesso.php';
    }
}
