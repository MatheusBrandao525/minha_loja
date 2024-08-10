<?php
require 'models/ProdutoModel.php';
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

    public function exibirProdutosEmDestaque()
    {
        $produtoModel = new ProdutoModel();
        $produtosEmDestaque = $produtoModel->buscarProdutosEmDestaque();
    }
}
