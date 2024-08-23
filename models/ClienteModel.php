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
}
