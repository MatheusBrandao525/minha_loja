<?php
require_once 'models/ProdutoModel.php';

class ProdutoController
{
    public function redirecionaParaTelaDetalhes()
    {
        include ROOT_PATH . '/views/detalhes.php';
    }

    public function apresentarTodosOsProdutos()
    {
        include ROOT_PATH . '/views/produtos.php';
    }

    public function exibirTodosProdutosDestaques()
    {
        $produtoModel = new ProdutoModel();
        return $produtoModel->buscarProdutosEmDestaque();
    }

    public function exibirTodosOsProdutos()
    {
        $produtoModel = new ProdutoModel();
        return $produtoModel->buscarTodosOsProdutos();
    }

    public function exibirProdutosPorCategoria()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoriaId'])) {
            $categoriaId = intval($_POST['categoriaId']);

            $produtoModel = new ProdutoModel();
            return $produtoModel->buscarProdutosPorCategoria($categoriaId);
        }else{
            include ROOT_PATH . '/views/erro404.php';
            die;
        }
    }

    public function exibirProdutosPesquisados()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pesquisa'])) {
            $pesquisa = filter_input(INPUT_POST, 'pesquisa', FILTER_SANITIZE_SPECIAL_CHARS);
            $produtoModel = new ProdutoModel();

            return $produtoModel->buscarProdutosPorPesquisa($pesquisa);
        }else{
            include ROOT_PATH . '/views/erro404.php';
            die;
        }
    }
}
