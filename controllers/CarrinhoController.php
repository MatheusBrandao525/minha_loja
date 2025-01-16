<?php
require 'models/CarrinhoModel.php';
require 'models/ProdutoModel.php';
class CarrinhoController {

    public function apresentarTelaDeCarrinho()
    {

        // Verificar se o usuário está logado
        if (!isset($_SESSION['ID'])) {
            // Redirecionar para a página de login se o usuário não estiver logado
            header('Location: login');
            exit;
        }
    
        // Se o usuário estiver logado, buscar os produtos do carrinho
        $carrinhoModel = new CarrinhoModel();
        $produtosCarrinho = $carrinhoModel->buscarProdutosDoCarrinho($_SESSION['ID']);
        
        // Incluir a página do carrinho
        include ROOT_PATH . '/views/carrinho.php';
    }

    public function adicionarAoCarrinho()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar os dados recebidos do formulário
            $usuarioId = $_POST['usuario_id'];
            $produtoId = $_POST['produto_id'];
    
            // Buscar informações adicionais do produto (exemplo: nome, preço, custo)
            $produtoModel = new ProdutoModel();
            $produto = $produtoModel->buscarDadosProdutoPorId($produtoId);
    
            if ($produto) {
                $frete = $produto['frete'] ?? 0.00;
                $nomeProduto = $produto['nome'];
                $vlrUnitario = $produto['preco_unitario'];
                $vlrCusto = $produto['preco_custo'];
                $tamanhoModelo = $_POST['tamanho_modelo'] ?? null;
    
                // Adicionar ao carrinho
                $carrinhoModel = new CarrinhoModel();
                $carrinhoModel->adicionarProduto($usuarioId, $produtoId, $frete, $nomeProduto, $vlrUnitario, $vlrCusto, $tamanhoModelo);
    
                // Redirecionar com mensagem de sucesso
                // header('Location: carrinho.php?mensagem=Produto adicionado com sucesso');
                echo 'Adicionado com sucesso!';
                exit;
            } else {
                // Produto não encontrado
                // header('Location: produtos.php?erro=Produto não encontrado');
                echo 'Erro ao adicionar produto ao carrinho!';
                exit;
            }
        } else {
            // Método não permitido
            header('HTTP/1.1 405 Method Not Allowed');
            exit;
        }
    }

    public function exibirProdutosCarrinhoUsuario($usuarioId)
    {
        $carrinhoModel = new CarrinhoModel();

        $produtosCarrinhoUsuario = $carrinhoModel->buscarProdutosDoCarrinho($usuarioId);
        return $produtosCarrinhoUsuario;
    }
    

    public function processarCupom()
    {

    }


    public function exibeQuantidadeCarrinho()
    {
        $carrinhoModel = new CarrinhoModel();
        $quantidadeItensNoCarrinho = 0;
        if(isset($_SESSION['ID'])){
        $quantidadeItensNoCarrinho = $carrinhoModel->contadorItensCarrinho($_SESSION['ID']);
        }
        return $quantidadeItensNoCarrinho;

    }

    
    
}