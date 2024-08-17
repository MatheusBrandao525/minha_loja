<?php
require 'models/UsuarioModel.php';
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

    public function exibirDadosUsuarioLogado($idUsuario)
    {
        $usuarioModel = new UsuarioModel();

        $dadosUsuario = $usuarioModel->buscarDadosUsuarioLogado($idUsuario);

        return $dadosUsuario;
    }
}
