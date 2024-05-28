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

    public function buscarProdutosPorCategoria($categoriaId)
    {
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
        
        $sql = 'SELECT * FROM produtos WHERE nome LIKE :pesquisa OR descricao LIKE :pesquisa';
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

    public function buscarProdutosSemelhantes($produtoId)
    {
        // Primeiro, obtemos o produto selecionado para obter seu nome e categoria
        $query = "SELECT nome, categoria_id FROM produtos WHERE produto_id = :produto_id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':produto_id', $produtoId, PDO::PARAM_INT);
        $stmt->execute();
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produto) {
            $categoriaId = $produto['categoria_id'];
            $nome = $produto['nome'];

            // Buscar produtos na mesma categoria
            $queryCategoria = "SELECT * FROM produtos WHERE categoria_id = :categoria_id AND produto_id != :produto_id LIMIT 10";
            $stmtCategoria = $this->conexao->prepare($queryCategoria);
            $stmtCategoria->bindParam(':categoria_id', $categoriaId, PDO::PARAM_INT);
            $stmtCategoria->bindParam(':produto_id', $produtoId, PDO::PARAM_INT);
            $stmtCategoria->execute();
            $produtosCategoria = $stmtCategoria->fetchAll(PDO::FETCH_ASSOC);

            // Se a busca por categoria não retornar suficientes resultados, buscar por nome com LIKE
            if (count($produtosCategoria) < 10) {
                $palavrasChave = explode(' ', $nome);
                $likeClause = "%" . implode('%', $palavrasChave) . "%";
                $queryNome = "SELECT * FROM produtos WHERE nome LIKE :nome AND produto_id != :produto_id LIMIT 10";
                $stmtNome = $this->conexao->prepare($queryNome);
                $stmtNome->bindParam(':nome', $likeClause, PDO::PARAM_STR);
                $stmtNome->bindParam(':produto_id', $produtoId, PDO::PARAM_INT);
                $stmtNome->execute();
                $produtosNome = $stmtNome->fetchAll(PDO::FETCH_ASSOC);

                // Combine resultados das duas buscas, evitando duplicados
                $produtosSemelhantes = array_merge($produtosCategoria, $produtosNome);
                $produtosSemelhantes = array_unique($produtosSemelhantes, SORT_REGULAR);

                return array_slice($produtosSemelhantes, 0, 10);
            }

            return $produtosCategoria;
        }

        return [];
    }
}
