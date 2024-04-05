<?php

class ProdutoModel
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function buscarProdutosEmDestaque()
    {
        $sql = 'SELECT * FROM produtos WHERE destaque = 1';
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarProdutosPorCategoria()
    {
        $categoriaId = $_POST['idCategoria'];

        $sql = 'SELECT * FROM produtos WHERE categoria_id = :idCategoria';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':idCategoria', $categoriaId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarProdutosPorPreco()
    {
        $precoUm = floatval($_POST['precoum']);
        $precoDois = floatval($_POST['precodois']);

        $sql = 'SELECT * FROM produtos WHERE preco_unitario BETWEEN :precoUm AND :precoDois';
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':precoUm', $precoUm);
        $stmt->bindParam(':precoDois', $precoDois);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarProdutosPorPrecoECategoria()
    {
        $precoUm = floatval($_POST['precoum']);
        $precoDois = floatval($_POST['precodois']);
        $categoriaId = $_POST['idcategoria'];

        $sql = 'SELECT * FROM produtos WHERE preco_unitario BETWEEN :precoUm AND :precoDois AND categoria_id = :idCategoria';
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':precoUm', $precoUm);
        $stmt->bindParam(':precoDois', $precoDois);
        $stmt->bindParam(':idCategoria', $categoriaId);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarTodosOsProdutos()
    {
        $sql = 'SELECT * FROM produtos';

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarProdutosPorPesquisa($pesquisa)
    {
        $pesquisaComCuringa = "%$pesquisa%";
        
        $sql = 'SELECT * FROM produtos WHERE nome_produto LIKE :pesquisa OR descricao LIKE :pesquisa';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':pesquisa', $pesquisaComCuringa);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarDadosProdutoPorId($id)
    {
        $sql = 'SELECT * FROM produtos WHERE produto_id = :produtoId';

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':produtoId', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
