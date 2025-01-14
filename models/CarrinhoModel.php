<?php

require 'core/Conexao.php';

class CarrinhoModel
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function adicionarProduto($usuarioId, $produtoId)
    {
        // Verificar se o produto já está no carrinho
        $sqlVerificar = 'SELECT quantidade FROM carrinho WHERE usuario_id = :usuario_id AND produto_id = :produto_id';
        $stmtVerificar = $this->conexao->prepare($sqlVerificar);
        $stmtVerificar->execute([
            ':usuario_id' => $usuarioId,
            ':produto_id' => $produtoId
        ]);

        $produtoExistente = $stmtVerificar->fetch(PDO::FETCH_ASSOC);

        if ($produtoExistente) {
            // Atualizar quantidade do produto
            $sqlAtualizar = 'UPDATE carrinho SET quantidade = quantidade + 1 WHERE usuario_id = :usuario_id AND produto_id = :produto_id';
            $stmtAtualizar = $this->conexao->prepare($sqlAtualizar);
            $stmtAtualizar->execute([
                ':usuario_id' => $usuarioId,
                ':produto_id' => $produtoId
            ]);
        } else {
            // Inserir novo produto no carrinho
            $sqlInserir = 'INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES (:usuario_id, :produto_id, 1)';
            $stmtInserir = $this->conexao->prepare($sqlInserir);
            $stmtInserir->execute([
                ':usuario_id' => $usuarioId,
                ':produto_id' => $produtoId
            ]);
        }
    }

    public function buscarProdutosDoCarrinho($usuarioId)
    {
        $sql = 'SELECT c.produto_id, c.quantidade, p.nome, p.preco_unitario 
            FROM carrinho AS c 
            INNER JOIN produtos AS p ON c.produto_id = p.produto_id 
            WHERE c.usuario_id = :usuario_id';
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
