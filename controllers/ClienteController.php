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
            // Recuperar os dados enviados via POST
            $novoEndereco = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
            $novoNumero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
            $novoBairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
            $novoCEP = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
            $novoComplemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);

            // Recuperar o ID do cliente logado (supondo que você tenha isso armazenado na sessão)
            session_start();
            $clienteId = $_SESSION['cliente_id'];

            // Recuperar os dados atuais do cliente no banco de dados
            $clienteModel = new ClienteModel();
            $dadosCliente = $clienteModel->buscarDadosDoClienteLogado($clienteId);

            // Verificar se há mudanças nos dados
            if (
                $novoEndereco !== $dadosCliente['endereco'] ||
                $novoNumero !== $dadosCliente['numero'] ||
                $novoBairro !== $dadosCliente['bairro'] ||
                $novoCEP !== $dadosCliente['cep'] ||
                $novoComplemento !== $dadosCliente['complemento']
            ) {
                // Atualizar os dados no banco de dados
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
