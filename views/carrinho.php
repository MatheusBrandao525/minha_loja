<?php
require 'components/header.php';
require_once 'controllers/CarrinhoController.php';

$carrinhoController = new CarrinhoController();
$produtosCarrinho = $carrinhoController->exibirProdutosNoCarrinho($_SESSION['ID']);

$totalCarrinho = 0;
$desconto = 0;
$valorFrete = 0;

if (isset($_SESSION['ID'])) {
    $idUsuarioLogado = $_SESSION['ID'];
} else {
    header('Location: login');
}

// Verificando se o cupom de desconto foi aplicado
if (isset($_POST['codigo_cupom']) && $_POST['codigo_cupom'] == 'DESCONTO10') {
    $desconto = 0.10; // 10% de desconto
}

// Somando o valor total dos produtos no carrinho
foreach ($produtosCarrinho as $produto) {
    $totalCarrinho += $produto['vlr_unitario'] * $produto['quantidade'];
}

$descontoTotal = $totalCarrinho * $desconto;
$totalFinal = $totalCarrinho - $descontoTotal + $valorFrete;
?>

<style>
    .excluir_produto_carrinho {
        height: 40px;
        width: 40px;
        background-color: red;
        border: none;
        color: white;
        border-radius: 3px;
        cursor: pointer;
        font-weight: bold;
    }

    .excluir_produto_carrinho:hover {
        background-color: #d11709;
    }

    .header_total {
        padding-right: 65px;
    }
</style>

<div class="row-carrinho">
    <div class="header_carrinho">
        <span>Carrinho</span>
    </div>
    <div class="container_carrinho">
        <div class="produtos_carrinho">
            <div class="carrinho_header">
                <div class="header_item imagem_item_carrinho">Imagem</div>
                <div class="header_item nome_item_carrinho">Nome</div>
                <div class="header_item tamanho_item_carrinho">Tamanho</div>
                <div class="header_item quantidade_carrinho">Quantidade</div>
                <div class="header_item valor_unitario_carrinho">V. Unitário</div>
                <div class="header_item header_total">Total</div>
            </div>
            <?php foreach ($produtosCarrinho as $produto): ?>
                <div class="carrinho_item">
                    <img src="public/assets/img/placeholder.jpg" alt="<?php echo $produto['nome_produto']; ?>" class="produto_imagem">

                    <span class="produto_nome"><?php echo $produto['nome_produto']; ?></span>

                    <span class="produto_tamanho"><?php echo $produto['tamanho_modelo']; ?></span>

                    <div class="quantidade_controle">
                        <form action="alterar_quantidade.php" method="post">
                            <input type="hidden" value="menos" name="alterar">
                            <input type="hidden" value="<?php echo $produto['produto_id']; ?>" name="produto_id">
                            <input type="hidden" value="1" name="quantidade">
                            <button class="quantidade_menos">-</button>
                        </form>
                        <span class="quantidade"><?php echo $produto['quantidade']; ?></span>
                        <form action="alterar_quantidade.php" method="post">
                            <input type="hidden" value="mais" name="alterar">
                            <input type="hidden" value="<?php echo $produto['produto_id']; ?>" name="produto_id">
                            <input type="hidden" value="1" name="quantidade">
                            <button class="quantidade_mais">+</button>
                        </form>
                    </div>

                    <span class="valor_unitario">R$ <?php echo number_format($produto['vlr_unitario'], 2, ',', '.'); ?></span>

                    <?php $valorTotalProduto = $produto['vlr_unitario'] * $produto['quantidade']; ?>
                    <span class="valor_total">R$ <?php echo number_format($valorTotalProduto, 2, ',', '.'); ?></span>

                    <span>
                        <form action="remover_produto.php" method="post">
                            <input type="hidden" name="produto_id" value="<?php echo $produto['produto_id']; ?>">
                            <button class="excluir_produto_carrinho">X</button>
                        </form>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="info_carrinho">
            <div class="cupom_desconto">
                <input type="text" placeholder="Código do cupom" id="codigo_cupom" name="codigo_cupom">
                <button id="aplicar_cupom">Usar</button>
            </div>

            <form action="pagamento" method="post">
                <input type="hidden" name="idusuario" value="<?php echo $idUsuarioLogado; ?>">
                <input type="hidden" name="valorcomdesconto" value="<?php echo number_format($totalFinal, 2, '.', ''); ?>">
                <input type="hidden" name="totalpedidosemdesconto" value="<?php echo number_format($totalCarrinho, 2, '.', ''); ?>">
                <input type="hidden" name="cupomValor" value="<?php echo isset($codigoCupom) ? $codigoCupom : ''; ?>">
                <input type="hidden" name="valorFrete" value="<?php echo number_format($valorFrete, 2, '.', ''); ?>">

                <div class="detalhes_carrinho">
                    <div class="linha_carrinho"><span>Total Produtos:</span> <span>R$ <?php echo number_format($totalCarrinho, 2, ',', '.'); ?></span></div>
                    <div class="linha_carrinho"><span>Desconto:</span> <span>R$ <?php echo number_format($desconto, 2, ',', '.'); ?></span></div>
                    <div class="linha_carrinho"><span>Frete:</span> <span>R$ <?php echo number_format($valorFrete, 2, ',', '.'); ?></span></div>
                    <div class="linha_carrinho total"><span>Total:</span> <span>R$ <?php echo number_format($totalFinal, 2, ',', '.'); ?></span></div>
                </div>
                <div class="acao_carrinho">
                    <button id="finalizar_pedido">Finalizar Pedido</button>
                </div>
            </form>

        </div>

    </div>
</div>


<?php
require 'components/footer.php';
?>