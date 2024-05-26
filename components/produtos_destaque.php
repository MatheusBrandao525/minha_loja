<?php
require_once 'models/ProdutoModel.php';
$produtoModel = new ProdutoModel();
$produtosEmDestaque = $produtoModel->buscarProdutosEmDestaque();
?>
<section class="special-offer">
    <div class="container">
        <h2>Especial Lingerie</h2>
        <div class="offer-products">
            <div class="product">
                <img src="product1.png" alt="Produto 1">
                <p>A partir de R$ 9,99</p>
            </div>
            <div class="product">
                <img src="product2.png" alt="Produto 2">
                <p>A partir de R$ 9,99</p>
            </div>
        </div>
    </div>
</section>