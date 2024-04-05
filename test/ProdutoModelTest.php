<?php
use PHPUnit\Framework\TestCase;
require 'core/Conexao.php';
require 'models/ProdutoModel.php';

class ProdutoModelTest extends TestCase
{
    private $produtoModel;

    protected function setUp(): void
    {
        $this->produtoModel = new ProdutoModel();
    }

    public function testBuscarProdutosEmDestaque()
    {
        $produtosEmDestaque = $this->produtoModel->buscarProdutosEmDestaque();
        $this->assertNotEmpty($produtosEmDestaque);
    }
}
