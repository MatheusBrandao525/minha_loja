<?php
require 'models/CarrinhoModel.php';
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
    
    
}