<?php
require_once 'models/AvaliacaoModel.php';
class AvaliacaoController
{
    public function exibirAvaliacoesDoProduto()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produtoId'])) {
            $produtoId = filter_input(INPUT_POST, 'produtoId', FILTER_SANITIZE_STRING);
    
            $avaliacaoModel = new AvaliacaoModel();
            return $avaliacaoModel->buscarAvaliacoesDoProduto($produtoId);
        } else {
            include ROOT_PATH . '/views/erro404.php';
            die;
        }
    }    
}