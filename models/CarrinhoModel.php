<?php

require_once 'core/Conexao.php';
require_once 'controllers/ProdutoController.php';

class CarrinhoModel
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function buscarProdutosNoCarrinhoDoUsuario($usuarioId)
    {
        $sql = "SELECT * FROM carrinho WHERE usuario_id = :usuario_id";
        $produtoController = new ProdutoController();
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->execute();

            $produtosCarrinhoUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $dadosCompletos = [];

            foreach ($produtosCarrinhoUsuario as $produtoCarrinho) {
                $produtoId = $produtoCarrinho['produto_id'];

                // Aqui você chama a função exibeDadosProdutoPorId para buscar os detalhes do produto
                $dadosProduto = $produtoController->exibeDadosProdutoPorId($produtoId);

                // Mesclando os dados do carrinho com os dados atualizados do produto
                $dadosCompletos[] = array_merge($produtoCarrinho, $dadosProduto);
            }

            return $dadosCompletos;
        } catch (PDOException $e) {
            header('Location: home');
            exit;
        }
    }

    public function somarValorTotalCarrinhoClienteLogado($clienteId)
    {
        $sql = "SELECT SUM(vlr_unitario * quantidade) AS total FROM carrinho WHERE usuario_id = :usuario_id";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':usuario_id', $clienteId, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['total'] ? $result['total'] : 0.00;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return 0.00;
        }
    }
}
