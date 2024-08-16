<?php
require 'components/header.php';
require_once 'controllers/CarrinhoController.php';

$carrinhoController = new CarrinhoController();
$produtosCarrinho = $carrinhoController->exibirProdutosNoCarrinho(1);
$totalCarrinho = 0;
$valorFrete = 0;

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
                <div class="header_item">Quantidade</div>
                <div class="header_item">V. Unitário</div>
                <div class="header_item header_total">Total</div>
            </div>
            <?php foreach ($produtosCarrinho as $produto): ?>
                <div class="carrinho_item">
                    <img src="public/assets/img/placeholder.jpg" alt="Nome do Produto" class="produto_imagem">
                    <span class="produto_nome"><?php echo $produto['nome_produto']; ?></span>
                    <div class="quantidade_controle">
                        <form action="alterar_quantidade" method="post">
                            <input type="hidden" value="1" name="quantidade">
                            <input type="hidden" value="menos" name="alterar">
                            <input type="hidden" value="<?php echo $produto['produto_id']; ?>" name="produto_id">
                            <button class="quantidade_menos">-</button>
                        </form>
                        <span class="quantidade"><?php echo $produto['quantidade']; ?></span>
                        <form action="alterar_quantidade" method="post">
                            <input type="hidden" value="mais" name="alterar">
                            <input type="hidden" value="1" name="quantidade">
                            <input type="hidden" value="<?php echo $produto['produto_id']; ?>" name="produto_id">
                            <button class="quantidade_mais">+</button>
                        </form>
                    </div>
                    <span class="valor_unitario">R$ <?php echo number_format($produto['preco_unitario'], 2, ',', '.'); ?></span>
                    <span class="valor_total">R$ <?php echo number_format($valorTotalProduto, 2, ',', '.'); ?></span>
                    <span>
                        <button class="excluir_produto_carrinho">X</button>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="info_carrinho">
            <div class="cupom_desconto">
                <input type="text" placeholder="Código do cupom" id="codigo_cupom">
                <button id="aplicar_cupom">Usar</button>
            </div>

            <form action="checkout" method="post">
                <div class="detalhes_carrinho">
                    <div class="linha_carrinho"><span>Total Produtos:</span> <span>R$ <?php echo number_format($totalCarrinho, 2, ',', '.'); ?></span></div>
                    <div class="linha_carrinho"><span>Desconto:</span> <span>R$ 00,00</span></div>
                    <div class="linha_carrinho"><span>Frete:</span> <span>R$ <?php echo number_format($valorFrete, 2, ',', '.'); ?></span></div>
                    <div class="linha_carrinho total"><span>Total:</span> <span>R$ <?php echo number_format($totalCarrinho + $valorFrete, 2, ',', '.'); ?></span></div>
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