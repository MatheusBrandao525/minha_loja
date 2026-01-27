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
            $usuarioId = $_POST['usuario_id'];
            $produtoId = $_POST['produto_id'];
    
            // Buscar informações do produto
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
    
                // Retornar quantidade total de itens no carrinho
                $quantidadeTotal = $carrinhoModel->contadorItensCarrinho($usuarioId);
                echo json_encode(['quantidade' => $quantidadeTotal]);
                exit;
            } else {
                http_response_code(400);
                echo json_encode(['erro' => 'Produto não encontrado']);
                exit;
            }
        } else {
            http_response_code(405);
            echo json_encode(['erro' => 'Método não permitido']);
            exit;
        }
    }
    
    public function atualizarQuantidade()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $produtoId = $_POST['produto_id'];
        $tamanhoModelo = $_POST['tamanho_modelo'];
        $acao = $_POST['acao'];
        $usuarioId = $_SESSION['ID']; // Pegando o usuário logado

        $carrinhoModel = new CarrinhoModel();

        if ($acao === "aumentar") {
            $carrinhoModel->incrementarQuantidade($usuarioId, $produtoId, $tamanhoModelo);
        } elseif ($acao === "diminuir") {
            $carrinhoModel->diminuirQuantidade($usuarioId, $produtoId, $tamanhoModelo);
        }

        echo json_encode(['sucesso' => true]);
        exit;
    } else {
        http_response_code(405);
        echo json_encode(['erro' => 'Método não permitido']);
        exit;
    }
}


    public function exibirProdutosCarrinhoUsuario($usuarioId)
    {
        $carrinhoModel = new CarrinhoModel();

        $produtosCarrinhoUsuario = $carrinhoModel->buscarProdutosDoCarrinho($usuarioId);
        return $produtosCarrinhoUsuario;
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
    
    
    public function processarCupom()
    {

    }
    
}