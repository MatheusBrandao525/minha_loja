<?php
require 'components/header.php';
require_once 'controllers/ProdutoController.php';

if (isset($_SESSION['pesquisa']) && !empty($_SESSION['pesquisa'])) {
    $pesquisa = $_SESSION['pesquisa'];

    $produtoController = new ProdutoController();
    $produtosPesquisados = $produtoController->exibeProdutosPorBusca($pesquisa);

    if (!empty($produtosPesquisados)) { ?>

        <section class="special-offer">
            <div class="container-produto-destaque">
                <h2>Resultados para: "<?php echo htmlspecialchars($pesquisa); ?>"</h2>
                <div class="centro">
                    <div class="offer-products">
                        <?php foreach ($produtosPesquisados as $produto) { ?>
                            <form method="post" action="detalhes" class="product">
                                <input type="hidden" name="produto-id" value="<?php echo htmlspecialchars($produto['produto_id']); ?>">
                                <button type="submit">
                                    <img src="<?php echo htmlspecialchars($produto['imagem1']); ?>" alt="<?php echo htmlspecialchars($produto['nome_produto']); ?>">
                                    <p class="product-name"><?php echo htmlspecialchars($produto['nome']); ?></p>
                                </button>
                                <div class="precos">
                                    <div class="old-price">De: R$<?php echo number_format($produto['preco_unitario'], 2, ',', '.'); ?></div>
                                    <div class="price">Por: R$<?php echo number_format($produto['preco_promocao'], 2, ',', '.'); ?></div>
                                    <div class="installments">10x sem juros</div>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>

    <?php } else { ?>
        <p>Não foram encontrados resultados para sua pesquisa.</p>
    <?php }
} else { ?>
    <p>Nenhuma pesquisa realizada.</p>
<?php }

require 'components/footer.php';
?>