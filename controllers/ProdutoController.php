<?php

class ProdutoController {
    public function redirecionaParaTelaDetalhes()
    {
        include ROOT_PATH . '/views/detalhes.php';
    }

    public function apresentarTodosOsProdutos()
    {
        include ROOT_PATH . '/views/produtos.php';
    }
}