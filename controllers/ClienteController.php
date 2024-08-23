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

    public function alterarEnderecoCliente()
    {
        if (
            isset($_POST['direccion']) && isset($_POST['numero']) &&
            isset($_POST['bairro']) && isset($_POST['cep']) &&
            isset($_POST['complemento'])
        ) {

            $novoEndereco = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
            $novoNumero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
            $novoBairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
            $novoCEP = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
            $novoComplemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);

            session_start();
            $clienteId = $_SESSION['ID'];

            $clienteModel = new ClienteModel();
            $dadosCliente = $clienteModel->buscarDadosDoClienteLogado($clienteId);

            if (
                $novoEndereco !== $dadosCliente['endereco'] ||
                $novoNumero !== $dadosCliente['numero'] ||
                $novoBairro !== $dadosCliente['bairro'] ||
                $novoCEP !== $dadosCliente['cep'] ||
                $novoComplemento !== $dadosCliente['complemento']
            ) {

                $atualizado = $clienteModel->atualizarEnderecoCliente($clienteId, $novoEndereco, $novoNumero, $novoBairro, $novoCEP, $novoComplemento);

                if ($atualizado) {
                    echo "Dados de endereço atualizados com sucesso!";
                } else {
                    echo "Erro ao tentar atualizar os dados de endereço no banco de dados.";
                }
            } else {
                echo "Os dados já estão atualizados.";
            }
        } else {
            echo "Erro ao tentar alterar dados de endereço.";
        }
    }
}
