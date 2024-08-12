<?php
require_once 'controllers/ProdutoController.php';
$produtoController = new ProdutoController();
$produtosEmDestaque = $produtoController->exibirProdutosEmDestaque();
?>
<section class="special-offer">
    <div class="container-produto-destaque">
        <h2>Ofertas</h2>
        <div class="centro">
            <div class="offer-products">
                <?php foreach ($produtosEmDestaque as $produtoDestaque) { ?>
                    <form method="post" action="detalhes" class="product">
                        <input type="hidden" name="produto-id" value="<?php echo $produtoDestaque['produto_id']; ?>">
                        <button type="submit">
                            <img src="public/assets/img/produto-exemplo.jpeg" alt="<?php echo htmlspecialchars($produtoDestaque['nome']); ?>">
                            <p class="product-name"><?php echo htmlspecialchars($produtoDestaque['nome']); ?></p>
                            <div class="precos">
                                <div class="old-price">De <?php echo number_format($produtoDestaque['preco_unitario'], 2, ',', '.'); ?></div>
                                <div class="price">Por: <?php echo number_format($produtoDestaque['preco_promocao'], 2, ',', '.'); ?></div>
                                <div class="installments">5x de <?php echo number_format($produtoDestaque['preco_promocao'] / 5, 2, ',', '.'); ?> sem juros</div>
                            </div>
                        </button>
                    </form>
                <?php } ?>

            </div>
        </div>
    </div>
</section>