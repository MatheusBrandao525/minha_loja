<?php
require 'components/header.php';
?>
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
                <div class="header_item">Total</div>
            </div>
            <div class="carrinho_item">
                <img src="public/assets/img/placeholder.jpg" alt="Nome do Produto" class="produto_imagem">
                <span class="produto_nome">Nome do Produto</span>
                <div class="quantidade_controle">
                    <button class="quantidade_menos">-</button>
                    <span class="quantidade">1</span>
                    <button class="quantidade_mais">+</button>
                </div>
                <span class="valor_unitario">R$ 00,00</span>
                <span class="valor_total">R$ 00,00</span>
            </div>
            <div class="carrinho_item">
                <img src="public/assets/img/placeholder.jpg" alt="Nome do Produto" class="produto_imagem">
                <span class="produto_nome">Nome do Produto</span>
                <div class="quantidade_controle">
                    <button class="quantidade_menos">-</button>
                    <span class="quantidade">1</span>
                    <button class="quantidade_mais">+</button>
                </div>
                <span class="valor_unitario">R$ 00,00</span>
                <span class="valor_total">R$ 00,00</span>
            </div>
            <div class="carrinho_item">
                <img src="public/assets/img/placeholder.jpg" alt="Nome do Produto" class="produto_imagem">
                <span class="produto_nome">Nome do Produto</span>
                <div class="quantidade_controle">
                    <button class="quantidade_menos">-</button>
                    <span class="quantidade">1</span>
                    <button class="quantidade_mais">+</button>
                </div>
                <span class="valor_unitario">R$ 00,00</span>
                <span class="valor_total">R$ 00,00</span>
            </div>
            <!-- Repita .carrinho_item para cada produto no carrinho -->
        </div>

        <div class="info_carrinho">
            <div class="cupom_desconto">
                <input type="text" placeholder="Código do cupom" id="codigo_cupom">
                <button id="aplicar_cupom">Usar</button>
            </div>
            <div class="detalhes_carrinho">
                <div class="linha_carrinho"><span>Total Produtos:</span> <span>R$ 00,00</span></div>
                <div class="linha_carrinho"><span>Desconto:</span> <span>R$ 00,00</span></div>
                <div class="linha_carrinho"><span>Frete:</span> <span>R$ 00,00</span></div>
                <div class="linha_carrinho total"><span>Total:</span> <span>R$ 00,00</span></div>
            </div>
            <div class="acao_carrinho">
                <button id="finalizar_pedido">Finalizar Pedido</button>
            </div>
        </div>

    </div>
</div>
<?php
require 'components/footer.php';
?>