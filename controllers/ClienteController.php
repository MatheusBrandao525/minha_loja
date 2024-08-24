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

    public function cadastrarCliente()
    {
        try {
            $cpf = $_POST['cpf'] ?? null;
            $nome = $_POST['nome'] ?? null;
            $sobrenome = $_POST['sobrenome'] ?? null;
            $telefone = $_POST['telefone'] ?? null;
            $cep = $_POST['cep'] ?? null;
            $endereco = $_POST['endereco'] ?? null;
            $numero = isset($_POST['semNumero']) ? null : $_POST['numero'];
            $semNumero = isset($_POST['semNumero']) ? 1 : 0;
            $bairro = $_POST['bairro'] ?? null;
            $complemento = $_POST['complemento'] ?? null;
            $cidade = $_POST['cidade'] ?? null;
            $estado = $_POST['estado'] ?? null;
            $pais = $_POST['pais'] ?? null;
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;
            $confirmarSenha = $_POST['confirmarSenha'] ?? null;

            if (
                empty($cpf) || empty($nome) || empty($sobrenome) || empty($telefone) || empty($cep) ||
                empty($endereco) || empty($bairro) || empty($cidade) || empty($estado) || empty($pais) ||
                empty($email) || empty($senha) || empty($confirmarSenha)
            ) {
                echo "Todos os campos obrigatórios devem ser preenchidos.";
                return;
            }

            if ($senha !== $confirmarSenha) {
                echo "As senhas não coincidem.";
                return;
            }

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $dadosCliente = [
                'cpf' => $cpf,
                'nome' => $nome,
                'sobrenome' => $sobrenome,
                'telefone' => $telefone,
                'cep' => $cep,
                'endereco' => $endereco,
                'numero' => $numero,
                'sem_numero' => $semNumero,
                'bairro' => $bairro,
                'complemento' => $complemento,
                'cidade' => $cidade,
                'estado' => $estado,
                'pais' => $pais,
                'email' => $email,
                'senha' => $senhaHash
            ];

            $clienteModel = new ClienteModel();
            // Salvar os dados no banco de dados e obter o cliente_id
            $clienteId = $clienteModel->salvarDadosClienteDatabase($dadosCliente);

            // Iniciar a sessão e armazenar o cliente_id
            session_start();
            $_SESSION['ID'] = $clienteId;

            // Redirecionar o cliente para a tela home
            header('Location: home');
            exit();
        } catch (PDOException $e) {
            // Iniciar a sessão caso não esteja iniciada
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Armazenar a mensagem de erro na sessão
            $_SESSION['erro_cadastro'] = $e->getMessage();

            // Redirecionar o usuário para a tela de erro
            header('Location: erro_cadastro');
            exit();
        }
    }
}
