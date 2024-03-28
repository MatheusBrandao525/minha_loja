<?php

class CheckoutController{

    public function apresentarTelaCheckout()
    {
        include ROOT_PATH . '/views/checkout.php';
    }

    public function redirecionaParaTelaDeSucesso()
    {
        include ROOT_PATH . '/views/sucesso.php';
    }
}