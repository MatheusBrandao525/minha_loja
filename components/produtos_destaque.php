<?php
    require_once 'controllers/RedesSociaisController.php';
    require_once 'controllers/ProdutoController.php';
    $produtoController = new ProdutoController();
    $produtosDestaques = $produtoController->exibirTodosProdutosDestaques();

    $redesSociaisController = new RedesSociaisController();
    $linkWhatsapp = $redesSociaisController->exibirLinkWhatsapp();
?>
<div class="container-block-title">
    <div class="block-title"><strong> Destaques </strong> <a href="produtos" class="vermais">Ver +</a> </div>
</div>
<section class="produtos">
    <div class="container">
        <?php foreach ($produtosDestaques as $produto): ?>
        <div class="product-card">
            <form method="post" action="detalhes" class="product-image">
                <input type="hidden" name="produtoId" value="<?php echo $produto['produto_id'];?>">
                <button type="submit" href="/minha_loja/detalhes/1">
                    <img src="<?php echo $produto['imagem1'];?>" alt="Nome do Produto">
                </button>

            </form>
            <div class="product-info">
                <h3 class="product-title"><?php echo htmlspecialchars($produto['nome']);?></h3>
                <p class="product-old-price">R$ <?php echo number_format($produto['preco_unitario'],2,'.',',');?></p>
                <p class="product-new-price">R$ <?php echo number_format($produto['preco_promocao'],2,'.',',');?> À
                    Vista</p>
                <p class="product-description"><?php echo htmlspecialchars($produto['descricao']);?></p>
                <div class="product-action">
                    <?php
                        // Gerar o link do WhatsApp para o produto atual
                        $produtoNomeOuCodigo = $produto['codigo'];
                        $linkWhatsapp = $redesSociaisController->exibirLinkWhatsapp($produtoNomeOuCodigo);
                    ?>
                    <a href="<?php echo $linkWhatsapp; ?>" class="product-button" target="_blank">
                        <i class="fab fa-whatsapp"></i> Whatsapp
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</section>


<script>
function increaseQuantity(button) {
    const productCard = button.closest('.product-card');
    const quantityInput = productCard.querySelector('.product-quantity');
    let currentValue = parseInt(quantityInput.value, 10);
    quantityInput.value = currentValue + 1;
}

function decreaseQuantity(button) {
    const productCard = button.closest('.product-card');
    const quantityInput = productCard.querySelector('.product-quantity');
    let currentValue = parseInt(quantityInput.value, 10);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}

document.querySelectorAll('.increase-quantity').forEach(button => {
    button.addEventListener('click', function() {
        increaseQuantity(this);
    });
});

document.querySelectorAll('.decrease-quantity').forEach(button => {
    button.addEventListener('click', function() {
        decreaseQuantity(this);
    });
});
</script>