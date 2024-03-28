<?php

class ErroController {

    public function redirecionarParaTelaDeErro404() 
    {
        include ROOT_PATH . '/views/erro404.php';
    }

    public function redirecionartelaUsuarioNaoEncontrado()
    {
        include ROOT_PATH . '/views/erroUsuarioNaoEncontrado.php';
    }
}