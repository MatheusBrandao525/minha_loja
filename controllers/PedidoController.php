<?php
session_start();
require 'models/PedidoModel.php';
class PedidoController
{

    public function telaDetalhesPedido()
    {
        if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])) {
            header("Location: login");
            exit();
        }
        include ROOT_PATH . '/views/detalhesPedido.php';
    }

    public function exibirPedidosDoCliente($clienteId)
    {
        $pedidoModel = new PedidoModel();

        $pedidosCliente = $pedidoModel->buscarPedidosDoCliente($clienteId);

        return $pedidosCliente;
    }

    public function exibirDetalhesPedido($pedidoId, $usuarioId, $ticketPedido)
    {
        $pedidoModel = new PedidoModel();

        $dadosPedido = $pedidoModel->buscarDadosPedido($pedidoId, $usuarioId, $ticketPedido);

        return $dadosPedido;
    }

    public function exibirProdutosDoPedido($pedidoId, $ticketPedido)
    {
        $pedidoModel = new PedidoModel();

        $produtosPedido = $pedidoModel->buscarProdutosPedido($pedidoId, $ticketPedido);

        return $produtosPedido;
    }
}
