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
                        <input type="hidden" name="produto-id" value="<?php echo htmlspecialchars($produtoDestaque['produto_id']); ?>">
                        <button type="submit">
                            <img src="<?php echo htmlspecialchars($produtoDestaque['imagem1']); ?>" alt="<?php echo htmlspecialchars($produtoDestaque['nome']); ?>">
                            <p class="product-name"><?php echo htmlspecialchars($produtoDestaque['nome']); ?></p>
                        </button>
                        <div class="precos">
                            <div class="old-price">De <?php echo htmlspecialchars($produtoDestaque['preco_unitario']); ?></div>
                            <div class="price">Por: <?php echo htmlspecialchars($produtoDestaque['preco_promocao']); ?></div>
                            <div class="installments">10x de sem juros</div>
                        </div>
                    </form>
                <?php } ?>

            </div>
        </div>
    </div>
</section>