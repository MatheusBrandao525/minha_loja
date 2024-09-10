<?php
session_start();
require_once 'core/Conexao.php';
require_once 'models/CarrinhoModel.php';
class CarrinhoController
{

    public function apresentarTelaDeCarrinho()
    {
        $sessao = $_SESSION['ID'];

        if (isset($sessao) && !empty($sessao)) {
            include ROOT_PATH . '/views/carrinho.php';
        } else {
            header("Location: login");
        }
        exit();
    }

    public function alterarQuantidadeCarrinho()
    {
        if (isset($_POST['produto_id']) && isset($_POST['quantidade'])) {
            echo '<pre>';
            var_dump($_POST);
            $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
            $produtoId = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
        } else {
        }
    }

    public function adicionarAoCarrinho()
    {

        if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])) {
            header("Location: login");
            exit();
        }
        try {

            if (isset($_POST['produtoid'], $_POST['tamanhosmodelos'], $_POST['qty'], $_POST['nomeproduto'], $_POST['vlrunitario'], $_POST['vlrcusto'], $_POST['vlrfrete'], $_POST['usuarioid'])) {
                $frete = $_POST['vlrfrete'];
                $usuarioId = $_POST['usuarioid'];
                $produtoId = $_POST['produtoid'];
                $tamanhoModelo = $_POST['tamanhosmodelos'];
                $quantidade = (int)$_POST['qty'];
                $nomeProduto = $_POST['nomeproduto'];
                $vlrUnitario = (float)$_POST['vlrunitario'];
                $vlrCusto = (float)$_POST['vlrcusto'];

                $conexao = Conexao::getInstance()->getConexao();

                $sql = "SELECT * FROM carrinho WHERE usuario_id = :usuario_id AND produto_id = :produto_id AND tamanho_modelo = :tamanho_modelo";
                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
                $stmt->bindParam(':produto_id', $produtoId, PDO::PARAM_INT);
                $stmt->bindParam(':tamanho_modelo', $tamanhoModelo, PDO::PARAM_STR);
                $stmt->execute();
                $produtoExistente = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($produtoExistente) {
                    $novaQuantidade = $produtoExistente['quantidade'] + $quantidade;
                    $sqlUpdate = "UPDATE carrinho SET quantidade = :quantidade WHERE id_carrinhocupom_desconto = :id";
                    $stmtUpdate = $conexao->prepare($sqlUpdate);
                    $stmtUpdate->bindParam(':quantidade', $novaQuantidade, PDO::PARAM_INT);
                    $stmtUpdate->bindParam(':id', $produtoExistente['id_carrinhocupom_desconto'], PDO::PARAM_INT);
                    $stmtUpdate->execute();
                } else {
                    $sqlInsert = "INSERT INTO carrinho (usuario_id, produto_id, frete, nome_produto, vlr_unitario, vlr_custo, quantidade, tamanho_modelo) VALUES (:usuario_id, :produto_id, :frete, :nome_produto, :vlr_unitario, :vlr_custo, :quantidade, :tamanho_modelo)";
                    $stmtInsert = $conexao->prepare($sqlInsert);
                    $stmtInsert->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
                    $stmtInsert->bindParam(':produto_id', $produtoId, PDO::PARAM_INT);
                    $stmtInsert->bindParam(':frete', $frete, PDO::PARAM_STR);
                    $stmtInsert->bindParam(':nome_produto', $nomeProduto, PDO::PARAM_STR);
                    $stmtInsert->bindParam(':vlr_unitario', $vlrUnitario, PDO::PARAM_STR);
                    $stmtInsert->bindParam(':vlr_custo', $vlrCusto, PDO::PARAM_STR);
                    $stmtInsert->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
                    $stmtInsert->bindParam(':tamanho_modelo', $tamanhoModelo, PDO::PARAM_STR);
                    $stmtInsert->execute();
                }

                header("Location: carrinho");
                exit;
            } else {
                throw new Exception("Erro: Dados do produto não foram recebidos corretamente.");
            }
        } catch (PDOException $e) {
            echo "Erro de banco de dados: " . $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function exibirProdutosNoCarrinho($usuarioId)
    {
        $carrinhoModel = new CarrinhoModel();
        $produtosCarrinho = $carrinhoModel->buscarProdutosNoCarrinhoDoUsuario($usuarioId);
        return $produtosCarrinho;
    }

    public function valorTotalCarrinhoClienteLogado($clienteId)
    {
        $carrinhoModel = new CarrinhoModel();

        $valorTotalCarrinhoClienteLogado = $carrinhoModel->somarValorTotalCarrinhoClienteLogado($clienteId);
        return $valorTotalCarrinhoClienteLogado;
    }
}
