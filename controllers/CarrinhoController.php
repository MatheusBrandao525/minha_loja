<?php

class CarrinhoController {

    public function apresentarTelaDeCarrinho()
    {
        include ROOT_PATH . '/views/carrinho.php';
    }

    public function alterarQuantidadeCarrinho()
    {
        if (isset($_POST['produto_id']) && isset($_POST['quantidade'])) {
            echo '<pre>';
            var_dump($_POST);
            $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
            $produtoId = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
        }else {
            
        }
    }
}