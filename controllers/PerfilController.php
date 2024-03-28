<?php

class PerfilController
{
    public function apresentarTelaPerfil()
    {
        include ROOT_PATH . '/views/perfil.php';
    }

    public function redirecionaParaDetalhesPedido()
    {
        include ROOT_PATH . '/views/detalhesPedido.php';
    }
}
