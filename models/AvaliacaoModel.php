<?php
require_once 'core/Conexao.php';
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

    public function salvarAvaliacaoDeProduto($estrelas, $comentario, $usuarioId, $produtoId)
    {
        $query = "INSERT INTO avaliacoes (comentario, estrelas, usuario_id, produto_id) VALUES (:comentario, :estrelas, :usuario_id, :produto_id)";

        try {
            $stmt = $this->conexao->prepare($query);

            $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
            $stmt->bindParam(':estrelas', $estrelas, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->bindParam(':produto_id', $produtoId, PDO::PARAM_INT);

            $stmt->execute();
            header('Location: obrigadoPorAvaliar');
            exit;
        } catch (Exception $e) {
            header('Location: erroNaAvaliacao');
            exit;
        }
    }
    
}