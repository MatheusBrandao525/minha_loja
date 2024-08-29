<?php
require_once 'core/Conexao.php';

class ClienteModel
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function buscarDadosDoClienteLogado($clienteId)
    {
        $sql = "SELECT * FROM clientes WHERE cliente_id = :clienteId";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':clienteId', $clienteId);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarEnderecoCliente($clienteId, $endereco, $numero, $bairro, $cep, $complemento)
    {
        $sql = "UPDATE clientes SET endereco = :endereco, numero = :numero, bairro = :bairro, cep = :cep, complemento = :complemento WHERE cliente_id = :clienteId";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':endereco', $endereco);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':complemento', $complemento);
            $stmt->bindParam(':clienteId', $clienteId);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
            exit;
        }
    }

    public function salvarDadosClienteDatabase($dadosCliente)
    {
        // SQL para inserir os dados
        $sql = "INSERT INTO clientes (cpf, nome, sobrenome, telefone, cep, endereco, numero, sem_numero, bairro, complemento, cidade, estado, pais, email, senha)
       VALUES (:cpf, :nome, :sobrenome, :telefone, :cep, :endereco, :numero, :sem_numero, :bairro, :complemento, :cidade, :estado, :pais, :email, :senha)";

        // Preparar a declaração
        $stmt = $this->conexao->prepare($sql);

        // Fazer o bind de cada parâmetro
        $stmt->bindParam(':cpf', $dadosCliente['cpf']);
        $stmt->bindParam(':nome', $dadosCliente['nome']);
        $stmt->bindParam(':sobrenome', $dadosCliente['sobrenome']);
        $stmt->bindParam(':telefone', $dadosCliente['telefone']);
        $stmt->bindParam(':cep', $dadosCliente['cep']);
        $stmt->bindParam(':endereco', $dadosCliente['endereco']);
        $stmt->bindParam(':numero', $dadosCliente['numero']);
        $stmt->bindParam(':sem_numero', $dadosCliente['sem_numero']);
        $stmt->bindParam(':bairro', $dadosCliente['bairro']);
        $stmt->bindParam(':complemento', $dadosCliente['complemento']);
        $stmt->bindParam(':cidade', $dadosCliente['cidade']);
        $stmt->bindParam(':estado', $dadosCliente['estado']);
        $stmt->bindParam(':pais', $dadosCliente['pais']);
        $stmt->bindParam(':email', $dadosCliente['email']);
        $stmt->bindParam(':senha', $dadosCliente['senha']);

        // Executar a declaração
        $stmt->execute();

        // Retornar o cliente_id gerado
        return $this->conexao->lastInsertId();
    }

    public function alterarSenhaCliente($clienteId, $senhaAtual, $novaSenha)
    {
        // Busca a senha atual no banco de dados
        $sql = "SELECT senha FROM clientes WHERE cliente_id = :clienteId";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':clienteId', $clienteId);
        $stmt->execute();
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        session_start();

        if ($cliente && password_verify($senhaAtual, $cliente['senha'])) {
            // Se a senha atual estiver correta, atualiza para a nova senha
            $novaSenhaHash = password_hash($novaSenha, PASSWORD_BCRYPT);

            $sqlUpdate = "UPDATE clientes SET senha = :novaSenha WHERE cliente_id = :clienteId";
            $stmtUpdate = $this->conexao->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':novaSenha', $novaSenhaHash);
            $stmtUpdate->bindParam(':clienteId', $clienteId);

            if ($stmtUpdate->execute()) {
                $_SESSION['mensagem'] = 'Senha alterada com sucesso!';
                $_SESSION['tipo_mensagem'] = 'sucesso';
            } else {
                $_SESSION['mensagem'] = 'Erro ao atualizar a senha. Tente novamente.';
                $_SESSION['tipo_mensagem'] = 'erro';
            }
        } else {
            $_SESSION['mensagem'] = 'Senha atual incorreta.';
            $_SESSION['tipo_mensagem'] = 'erro';
        }
    }
}
