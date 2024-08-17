<?php
require 'core/Conexao.php';

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
}
