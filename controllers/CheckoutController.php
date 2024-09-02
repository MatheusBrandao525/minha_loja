<?php
session_start();
class CheckoutController
{

    public function apresentarTelaCheckout()
    {
        if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])) {
            header("Location: login");
            exit();
        }
        include ROOT_PATH . '/views/checkout.php';
    }

    public function redirecionaParaTelaDeSucesso()
    {
        include ROOT_PATH . '/views/sucesso.php';
    }
}
