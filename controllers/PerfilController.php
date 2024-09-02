<?php
session_start();
class PerfilController
{
    public function apresentarTelaPerfil()
    {
        if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])) {
            header("Location: login");
            exit();
        }
        include ROOT_PATH . '/views/perfil.php';
    }

    public function redirecionaParaDetalhesPedido()
    {
        if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])) {
            header("Location: login");
            exit();
        }
        include ROOT_PATH . '/views/detalhesPedido.php';
    }

    public function exibirDadosUsuarioLogado($idUsuario)
    {
        $usuarioModel = new UsuarioModel();

        $dadosUsuario = $usuarioModel->buscarDadosUsuarioLogado($idUsuario);

        return $dadosUsuario;
    }
}
