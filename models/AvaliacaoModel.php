<?php
class AvaliacaoModel
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function buscarAvaliacoesDoProduto($produtoId)
    {
        $query = "SELECT * FROM avaliacoes WHERE produto_id = :produtoId";
    
        try {
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam('produtoId', $produtoId);
            $stmt->execute();
    
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($result)) {
                return [];
            }
    
            return $result;
        } catch (Exception $e) {
            return "<h4 style='margin-top:1rem;'>Ainda não há avaliações para este produto.</h4>";
        }
    }
    
}