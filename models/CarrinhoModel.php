<?php
require_once 'core/Conexao.php';

class CarrinhoModel
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function obterCarrinhoAberto($usuarioId)
    {
        // Verifica se o usuário tem um carrinho com status 'ABERTO'
        $sql = 'SELECT id_carrinho FROM carrinho WHERE cliente_id = :cliente_id AND status_carrinho = "ABERTO" LIMIT 1';
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([':cliente_id' => $usuarioId]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $resultado ? $resultado['id_carrinho'] : null;
    }
    

    private function criarNovoCarrinho($usuarioId)
    {
        $sql = 'INSERT INTO carrinho (cliente_id, status_carrinho) VALUES (:cliente_id, "ABERTO")';
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([':cliente_id' => $usuarioId]);
        return $this->conexao->lastInsertId();
    }


    public function adicionarProduto($usuarioId, $produtoId, $frete, $nomeProduto, $vlrUnitario, $vlrCusto, $tamanhoModelo = null)
    {
        // Obtém o ID do carrinho aberto ou cria um novo carrinho
        $carrinhoId = $this->obterCarrinhoAberto($usuarioId);

        // Se não houver carrinho aberto, cria um novo
        if (!$carrinhoId) {
            $carrinhoId = $this->criarNovoCarrinho($usuarioId);
        }

        // Verifica se o produto já está no carrinho
        $sqlVerificar = 'SELECT quantidade FROM produtos_carrinho WHERE id_carrinho = :id_carrinho AND produto_id = :produto_id AND tamanho_modelo = :tamanho_modelo AND cliente_id = :cliente_id';
        $stmtVerificar = $this->conexao->prepare($sqlVerificar);
        $stmtVerificar->execute([
            ':id_carrinho' => $carrinhoId,
            ':produto_id' => $produtoId,
            ':tamanho_modelo' => $tamanhoModelo,
            ':cliente_id' => $usuarioId // Adicionado o cliente_id
        ]);

        $produtoExistente = $stmtVerificar->fetch(PDO::FETCH_ASSOC);

        if ($produtoExistente) {
            // Se o produto já existe no carrinho, atualiza a quantidade
            $sqlAtualizar = 'UPDATE produtos_carrinho SET quantidade = quantidade + 1 WHERE id_carrinho = :id_carrinho AND produto_id = :produto_id AND tamanho_modelo = :tamanho_modelo AND cliente_id = :cliente_id';
            $stmtAtualizar = $this->conexao->prepare($sqlAtualizar);
            $stmtAtualizar->execute([
                ':id_carrinho' => $carrinhoId,
                ':produto_id' => $produtoId,
                ':tamanho_modelo' => $tamanhoModelo,
                ':cliente_id' => $usuarioId // Adicionado o cliente_id
            ]);
        } else {
            // Se o produto não existe no carrinho, insere um novo
            $sqlInserir = 'INSERT INTO produtos_carrinho (id_carrinho, produto_id, nome_produto, vlr_unitario, vlr_custo, quantidade, tamanho_modelo, cliente_id) 
                       VALUES (:id_carrinho, :produto_id, :nome_produto, :vlr_unitario, :vlr_custo, 1, :tamanho_modelo, :cliente_id)';
            $stmtInserir = $this->conexao->prepare($sqlInserir);
            $stmtInserir->execute([
                ':id_carrinho' => $carrinhoId,
                ':produto_id' => $produtoId,
                ':nome_produto' => $nomeProduto,
                ':vlr_unitario' => $vlrUnitario,
                ':vlr_custo' => $vlrCusto,
                ':tamanho_modelo' => $tamanhoModelo,
                ':cliente_id' => $usuarioId // Adicionado o cliente_id
            ]);
        }
    }




    public function buscarProdutosDoCarrinho($usuarioId)
    {
        // Obtém o ID do carrinho aberto do usuário
        $carrinhoId = $this->obterCarrinhoAberto($usuarioId);
        if (!$carrinhoId) return []; // Se não houver carrinho, retorna um array vazio
        
        // Busca os produtos do carrinho com status 'ABERTO', incluindo o id_carrinho
        $sql = 'SELECT 
                    pc.id_produto_carrinho, 
                    pc.produto_id, 
                    pc.quantidade, 
                    pc.nome_produto, 
                    pc.vlr_unitario, 
                    pi.imagem_url,
                    pc.id_carrinho  -- Inclui o id_carrinho
                FROM 
                    produtos_carrinho AS pc
                INNER JOIN 
                    produtos AS p ON pc.produto_id = p.produto_id
                LEFT JOIN 
                    produtos_imagens AS pi ON p.produto_id = pi.produto_id AND pi.principal = TRUE
                WHERE 
                    pc.id_carrinho = :id_carrinho';
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([':id_carrinho' => $carrinhoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function contadorItensCarrinho($usuarioId)
    {
        $carrinhoId = $this->obterCarrinhoAberto($usuarioId);
        if (!$carrinhoId) return 0;

        $sql = "SELECT COUNT(*) AS total_registros FROM produtos_carrinho WHERE id_carrinho = :id_carrinho";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([':id_carrinho' => $carrinhoId]);

        return (int) $stmt->fetchColumn();
    }
}
