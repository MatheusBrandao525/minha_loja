<?php
require 'components/header.php';
$carrinhoController = new CarrinhoController();
$dadosCarrinhoUsuario = $carrinhoController->exibirProdutosCarrinhoUsuario($_SESSION['ID']);
$idCarrinho = !empty($dadosCarrinhoUsuario) ? $dadosCarrinhoUsuario[0]['id_carrinho'] : null;
$idUsuarioLogado = $_SESSION['ID'];
$subTotalCarrinho = 0;
$valorTotalCarrinho = 0;
$frete = 10;
$desconto = 5;
$totalPedido = 0;
?>
<div class="row-carrinho">
    <div class="header_carrinho">
        <span>Carrinho</span>
    </div>
    <div class="container_carrinho">
        <?php if (!empty($dadosCarrinhoUsuario)) : ?>
            <div class="produtos_carrinho">
                <div class="carrinho_header">
                    <div class="header_item imagem_item_carrinho">Imagem</div>
                    <div class="header_item nome_item_carrinho">Nome</div>
                    <div class="header_item">Quantidade</div>
                    <div class="header_item">V. Unitário</div>
                    <div class="header_item">Total</div>
                </div>
                <?php 
                foreach ($dadosCarrinhoUsuario as $carrinho) : 
                    $valorTotalProduto = $carrinho['quantidade'] * $carrinho['vlr_unitario'];    
                ?>
                <div class="carrinho_item">
                    <img src="<?php echo $carrinho['imagem_url']; ?>" alt="<?php echo htmlspecialchars($carrinho['nome_produto']); ?>" class="produto_imagem">
                    <span class="produto_nome"><?php echo htmlspecialchars($carrinho['nome_produto']); ?></span>
                    <div class="quantidade_controle">
                        <button class="quantidade_menos">-</button>
                        <span class="quantidade"><?php echo $carrinho['quantidade']; ?></span>
                        <button class="quantidade_mais">+</button>
                    </div>
                    <span class="valor_unitario">R$ <?php echo number_format($carrinho['vlr_unitario'], 2, ',', '.'); ?></span>
                    <span class="valor_total">R$ <?php echo number_format($valorTotalProduto, 2, ',', '.'); ?></span>
                </div>
                <?php 
                    $subTotalCarrinho += $valorTotalProduto;
                endforeach; 
                ?>
            </div>

            <div class="info_carrinho">
                <div class="cupom_desconto">
                    <input type="text" placeholder="Código do cupom" id="codigo_cupom">
                    <button id="aplicar_cupom">Usar</button>
                </div>
                <form action="checkout" method="post">
                    <input type="hidden" value="<?php echo $idUsuarioLogado; ?>" name="idusuario">
                    <input type="hidden" name="idcarrinho" value="<?php echo !empty($idCarrinho) ? $idCarrinho : 0; ?>">
                    <input type="hidden" id="cupomValor" name="cupomValor">
                    <div class="detalhes_carrinho">
                        <div class="linha_carrinho"><span>Total Produtos:</span> <span>R$ <?php echo number_format($subTotalCarrinho, 2, ',', '.'); ?></span></div>
                        <div class="linha_carrinho"><span>Desconto:</span> <span>R$ <?php echo number_format($desconto, 2, ',', '.'); ?></span></div>
                        <div class="linha_carrinho"><span>Frete:</span> <span>R$ <?php echo number_format($frete, 2, ',', '.'); ?></span></div>
                        <div class="linha_carrinho total"><span>Total:</span> <span>R$ <?php $valorTotalCarrinho = $subTotalCarrinho + $frete - $desconto; echo number_format($valorTotalCarrinho, 2, ',', '.'); ?></span></div>
                    </div>
                    <input type="hidden" id="valorcomdesconto" value="<?php echo $valorTotalCarrinho;?>" name="valorcomdesconto">
                    <input type="hidden" name="totalpedidosemdesconto" value="<?php $totalPedidoSemDesconto = $subTotalCarrinho + $frete; echo $totalPedidoSemDesconto; ?>">
                    <div class="acao_carrinho">
                        <button type="submit" class="btn btn-block btn-primary" style="display: flex; justify-content:center;">Finalizar Pedido</button>
                    </div>
                </form>
            </div>
        <?php else : ?>
            <p class="alert alert-warning text-center">Seu carrinho está vazio.</p>
        <?php endif; ?>
    </div>
</div>
<?php
require 'components/footer.php';
?>
