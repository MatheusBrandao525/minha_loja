<?php
require_once 'core/Conexao.php';

class CarrinhoModel
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function adicionarProduto($usuarioId, $produtoId, $frete, $nomeProduto, $vlrUnitario, $vlrCusto, $tamanhoModelo = null)
    {
        // Verificar se o produto já está no carrinho
        $sqlVerificar = 'SELECT quantidade FROM carrinho WHERE usuario_id = :usuario_id AND produto_id = :produto_id AND tamanho_modelo = :tamanho_modelo';
        $stmtVerificar = $this->conexao->prepare($sqlVerificar);
        $stmtVerificar->execute([
            ':usuario_id' => $usuarioId,
            ':produto_id' => $produtoId,
            ':tamanho_modelo' => $tamanhoModelo
        ]);

        $produtoExistente = $stmtVerificar->fetch(PDO::FETCH_ASSOC);

        if ($produtoExistente) {
            // Atualizar quantidade do produto
            $sqlAtualizar = 'UPDATE carrinho SET quantidade = quantidade + 1 WHERE usuario_id = :usuario_id AND produto_id = :produto_id AND tamanho_modelo = :tamanho_modelo';
            $stmtAtualizar = $this->conexao->prepare($sqlAtualizar);
            $stmtAtualizar->execute([
                ':usuario_id' => $usuarioId,
                ':produto_id' => $produtoId,
                ':tamanho_modelo' => $tamanhoModelo
            ]);
        } else {
            // Inserir novo produto no carrinho
            $sqlInserir = 'INSERT INTO carrinho (usuario_id, produto_id, frete, nome_produto, vlr_unitario, vlr_custo, quantidade, tamanho_modelo) 
                           VALUES (:usuario_id, :produto_id, :frete, :nome_produto, :vlr_unitario, :vlr_custo, 1, :tamanho_modelo)';
            $stmtInserir = $this->conexao->prepare($sqlInserir);
            $stmtInserir->execute([
                ':usuario_id' => $usuarioId,
                ':produto_id' => $produtoId,
                ':frete' => $frete,
                ':nome_produto' => $nomeProduto,
                ':vlr_unitario' => $vlrUnitario,
                ':vlr_custo' => $vlrCusto,
                ':tamanho_modelo' => $tamanhoModelo
            ]);
        }
    }

    public function buscarProdutosDoCarrinho($usuarioId)
    {
        $sql = 'SELECT 
            c.produto_id, 
            c.quantidade, 
            c.nome_produto, 
            c.vlr_unitario, 
            pi.imagem_url 
        FROM 
            carrinho AS c
        INNER JOIN 
            produtos AS p ON c.produto_id = p.produto_id
        LEFT JOIN 
            produtos_imagens AS pi ON p.produto_id = pi.produto_id AND pi.principal = TRUE
        WHERE 
            c.usuario_id = :usuario_id';

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contadorItensCarrinho($idUsuarioLogado)
    {
        if (isset($idUsuarioLogado)) {

            // Consulta SQL para contar os registros
            $sql = "SELECT COUNT(*) AS total_registros FROM carrinho WHERE usuario_id = :id_usuario";
            $stmt_qnt = $this->conexao->prepare($sql);
            $stmt_qnt->bindValue(":id_usuario", $idUsuarioLogado, PDO::PARAM_INT);
            $stmt_qnt->execute();

            // Recupera o total de registros
            $totalRegistros = (int) $stmt_qnt->fetchColumn();

            return $totalRegistros;
        } else {
            return $quantidade_produtos = 0;
        }
    }
}
