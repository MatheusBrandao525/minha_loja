<?php

class CheckoutController{

    public function exibeCheckout()
    {
        include ROOT_PATH . '/views/checkout.php';
    }

    public function redirecionaParaTelaDeSucesso()
    {
        include ROOT_PATH . '/views/sucesso.php';
    }
}