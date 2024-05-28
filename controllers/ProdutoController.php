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

    public function exibirDadosProdutoPorId()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produtoId'])) {
            $produtoId = filter_input(INPUT_POST, 'produtoId', FILTER_SANITIZE_STRING);

            $produtoModel = new ProdutoModel();
            return $produtoModel->buscarDadosProdutoPorId($produtoId);
        }else {
            include ROOT_PATH . '/views/erro404.php';
            die;
        }
    }

    public function verificaSeProdutoTemMaisDeUmaImagem($produtoData)
    {
        $imagem2 = '';
        $imagem3 = '';
    
        if (!empty($produtoData['imagem2']) && $produtoData['imagem2'] != null) {
            $imagem2 = $produtoData['imagem2'];
        }
    
        if (!empty($produtoData['imagem3']) && $produtoData['imagem3'] != null) {
            $imagem3 = $produtoData['imagem3'];
        }
    
        return ['imagem2' => $imagem2, 'imagem3' => $imagem3];
    }

    public function exibirProdutosSemelhantes($produtoId)
    {
        $produtoModel = new ProdutoModel();

        return $produtoModel->buscarProdutosSemelhantes($produtoId);
    }
    
}
