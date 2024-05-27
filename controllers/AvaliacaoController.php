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
    
    public function avaliarProduto()
    {
        $loginController = $this->verificarSeSessaoIdExiste();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $quantidadeDeEstrelas = filter_input(INPUT_POST, 'avaliacao', FILTER_SANITIZE_NUMBER_INT);
            $comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_STRING);
            $produtoId = filter_input(INPUT_POST, 'produtoId', FILTER_SANITIZE_NUMBER_INT);
            $usuarioId = filter_input(INPUT_POST, 'usuarioId', FILTER_SANITIZE_NUMBER_INT);

            $avaliacaoModel = new AvaliacaoModel();

            $avaliacaoModel->salvarAvaliacaoDeProduto($quantidadeDeEstrelas, $comentario, $usuarioId, $produtoId);

        }else {
            include ROOT_PATH . '/views/erro404.php';
            die;
        }
    }

    public function verificarSeSessaoIdExiste()
    {
    
        if (!isset($_SESSION['ID'])) {
            header("Location: login");
            exit;
        }
    
        return true;
    }
}