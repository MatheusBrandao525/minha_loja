<?php
require_once 'controllers/ProdutoController.php';
$produtoController = new ProdutoController();
$produtosNovidade = $produtoController->exibirProdutosNovidade();
?>
<section class="special-offer">
    <div class="container-produto-destaque">
        <h2>Novidades</h2>
        <div class="centro">
            <div class="offer-products">
                <?php foreach ($produtosNovidade as $produto): ?>
                    <form method="post" action="detalhes" class="product">
                        <input type="hidden" name="produto-id" value="<?php echo htmlspecialchars($produto['produto_id']); ?>">
                        <button type="submit">
                            <img src="<?php echo htmlspecialchars($produto['imagem1']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                            <p class="product-name"><?php echo htmlspecialchars($produto['nome']); ?></p>
                        </button>
                        <div class="precos">
                            <div class="old-price">De <?php echo htmlspecialchars($produto['preco_unitario']); ?></div>
                            <div class="price">Por: <?php echo htmlspecialchars($produto['preco_promocao']); ?></div>
                            <div class="installments">10x de sem juros</div>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>