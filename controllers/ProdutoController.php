<?php
require 'models/ProdutoModel.php';
class ProdutoController
{
    public function redirecionaParaTelaDetalhes()
    {
        session_start();
        // Captura o ID do produto a partir do POST
        if (isset($_POST['produto-id'])) {
            $produtoId = $_POST['produto-id'];


            // Busca os detalhes do produto
            $produtoModel = new ProdutoModel();
            $detalhesProduto = $produtoModel->buscarDadosProdutoPorId($produtoId);

            // Armazena os detalhes em uma sessão
            $_SESSION['detalhesProduto'] = $detalhesProduto;
            // Redireciona para a página de detalhes
            header('location:detalhesproduto');
            exit;
        } else {
            // Se não houver produto ID, redireciona para a página de produtos
            echo 'erro esta aqui!';
            exit;
        }
    }

    public function detalhesProduto()
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
        return $produtosEmDestaque;
    }

    public function exibeDadosProdutoPorId($produtoId)
    {
        $produtoModel = new ProdutoModel();
        $dadosProdutoPorId = $produtoModel->buscarDadosProdutoPorId($produtoId);
        return $dadosProdutoPorId;
    }

    public function exibirProdutosNovidade()
    {
        $produtoModel = new ProdutoModel();
        $produtosNovidade = $produtoModel->buscarProdutosNovidade();
        return $produtosNovidade;
    }
}
