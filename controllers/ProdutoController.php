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
}
