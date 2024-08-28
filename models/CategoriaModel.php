<?php
require_once 'core/Conexao.php';
class CategoriaModel
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function buscarTodasAsCategorias()
    {
        $sql = "SELECT * FROM categorias";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function buscarCategoriasPrinpais()
    {
        $statusPrincipal = 1;
        $sql = "SELECT * FROM categorias WHERE principal = :statusPrincipal";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':statusPrincipal', $statusPrincipal);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
