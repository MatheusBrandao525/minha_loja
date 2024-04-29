<?php
use PHPUnit\Framework\TestCase;
require 'core/Conexao.php';
require 'models/ProdutoModel.php';

class ProdutoModelTest extends TestCase
{
    private $produtoModel;

    protected function setUp(): void
    {
        // Mock da conexão para evitar operações reais de banco de dados
        $conexaoMock = $this->createMock(PDO::class);

        // Configurando o comportamento esperado do mock
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute');
        $stmtMock->method('fetchAll')->willReturn([]);

        $conexaoMock->method('prepare')->willReturn($stmtMock);

        // Injetar a conexão mock no seu ProdutoModel
        $this->produtoModel = new ProdutoModel($conexaoMock);
    }

    public function testBuscarProdutosEmDestaque()
    {
        $produtosEmDestaque = $this->produtoModel->buscarProdutosEmDestaque();
        $this->assertNotEmpty($produtosEmDestaque);
    }

    public function testBuscarProdutosPorCategoria()
    {
        $_POST['idCategoria'] = 'teste';

        $produtos = $this->produtoModel->buscarProdutosPorCategoria();
        $this->assertIsArray($produtos);

        unset($_POST['idCategoria']);
    }
    
}
