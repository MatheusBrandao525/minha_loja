<?php

require 'utils/Validacoes.php';

class LoginController {

    public function redirecionaParaTelaDeLogin()
    {
        include ROOT_PATH . '/views/login.php';
    }

    public function autenticarUsuario()
    {
        $emailUsuario = $_POST['txtemail'];
        $senhaUsuario = $_POST['txtsenha'];

        $validarCredenciais = new Validacoes();

        $autenticacao = $validarCredenciais->validarCredenciaisLogin($emailUsuario, $senhaUsuario);

        header('Content-Type: application/json');
        echo json_encode($autenticacao);
        exit; 
    }
}