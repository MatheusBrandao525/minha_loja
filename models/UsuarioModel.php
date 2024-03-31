<?php
class UsuarioModel {
    
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function buscarDadosUsuarioLogado($idUsuarioLogado)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :usuarioID";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':usuarioID', $idUsuarioLogado);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}