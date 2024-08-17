<?php
require 'models/ClienteModel.php';

class ClienteController
{

    public function exibirDadosClienteLogado($clienteId)
    {
        $clienteModel = new ClienteModel();

        $dadosCliente = $clienteModel->buscarDadosDoClienteLogado($clienteId);

        return $dadosCliente;
    }
}
