<?php
require 'components/header.php';
require_once 'controllers/RedesSociaisController.php';
require_once 'controllers/ProdutoController.php';
$produtoController = new ProdutoController();
$produtosData = $produtoController->exibirProdutosPorCategoria();
$redesSociaisController = new RedesSociaisController();
$linkWhatsapp = $redesSociaisController->exibirLinkWhatsapp();
?>
<div class="categoria-container">
    <div class="container">

        <div class="titulo-categoria">
            <h2>Titulo da Categoria</h2>
        </div>

        <div class="conteudo">
            <!--             <aside class="sidebar">
                <div class="filtro">
                    <div class="filtro-titulo">Categoria</div>
                    <div class="filtro-opcoes">
                        <label><input type="checkbox" name="categoria" value="categoria1"> Opção 1</label>
                        <label><input type="checkbox" name="categoria" value="categoria2"> Opção 2</label>
                        <label><input type="checkbox" name="categoria" value="categoria3"> Opção 3</label>
                    </div>
                </div>

                <div class="filtro">
                    <div class="filtro-titulo">Preço</div>
                    <div class="filtro-opcoes">
                        <label><input type="checkbox" name="preco" value="preco1"> Opção 1</label>
                        <label><input type="checkbox" name="preco" value="preco2"> Opção 2</label>
                        <label><input type="checkbox" name="preco" value="preco3"> Opção 3</label>
                    </div>
                </div>

                <div class="filtro">
                    <div class="filtro-titulo">Cor</div>
                    <div class="filtro-opcoes">
                        <label><input type="checkbox" name="cor" value="cor1"> Opção 1</label>
                        <label><input type="checkbox" name="cor" value="cor2"> Opção 2</label>
                        <label><input type="checkbox" name="cor" value="cor3"> Opção 3</label>
                    </div>
                </div>
            </aside> -->


            <div class="produtos-categoria">
                <!--                 <div class="imagem-categoria">
                    <img src="public/assets/img/placeholder.jpg" alt="Categoria">
                </div> -->
<!--                 <div class="toolbar toolbar-products">
                    <div class="modes"> <strong class="modes-label" id="modes-label">Ver como</strong> <strong
                            title="Grade" class="modes-mode active mode-grid"
                            data-value="grid"><span>Grade</span></strong> <a class="modes-mode mode-list" title="Lista"
                            href="#" data-role="mode-switcher" data-value="list" id="mode-list"
                            aria-labelledby="modes-label mode-list"><span>Lista</span></a> </div>
                    <p class="toolbar-amount" id="toolbar-amount"> Itens encontrados <span
                            class="toolbar-number">1</span>-<span class="toolbar-number">20</span> of <span
                            class="toolbar-number">782</span> </p>
                    <div class="toolbar-sorter sorter">
                        <label class="sorter-label" for="sorter">Ordenar por:</label>
                        <div class="styleSelect"><select id="sorter" data-role="sorter" class="sorter-options">
                                <option value="position" selected="">Posição</option>
                                <option value="name">Nome do produto</option>
                                <option value="price">Preço</option>
                            </select>
                        </div>
                        <a title="Definir Direção Decrescente" href="#" class="action sorter-action sort-asc"
                            data-role="direction-switcher" data-value="desc"><span>Definir Direção
                                Decrescente</span></a>
                    </div>
                    <div class="field limiter">
                        <label class="label" for="limiter"><span>Exibir:</span></label>
                        <div class="control">
                            <div class="styleSelect"><select id="limiter" data-role="limiter" class="limiter-options">
                                    <option value="20" selected="">20</option>
                                    <option value="40">40</option>
                                    <option value="60">60</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="pages">
                        <strong class="label pages-label" id="paging-label">Página</strong>
                        <ul class="items pages-items" aria-labelledby="paging-label">
                            <li class="item current"><strong class="page"><span class="label">Você esta lendo a
                                        pagina</span> <span>1</span></strong></li>
                            <li class="item"><a href="" class="page"><span class="label">Página</span>
                                    <span>2</span></a></li>
                            <li class="item"><a href="" class="page"><span class="label">Página</span>
                                    <span>3</span></a></li>
                            <li class="item"><a href="" class="page"><span class="label">Página</span>
                                    <span>4</span></a></li>
                            <li class="item"><a href="" class="page"><span class="label">Página</span>
                                    <span>5</span></a></li>
                            <li class="item pages-item-next"> <a class="link  next-page" href=""
                                    title="PRÓXIMA PÁGINA"><span class="label">Página</span> <span>PRÓXIMA
                                        PÁGINA</span></a></li>
                        </ul>
                    </div>
                </div> -->
                <div class="produtos">
                    <?php foreach ($produtosData as $produto): ?>
                    <div class="product-card">
                        <form method="post" action="detalhes" class="product-image">
                        <input type="hidden" name="produtoId" value="<?php echo $produto['produto_id'];?>">
                            <button type="submit">
                                <img src="<?php echo $produto['imagem1']; ?>"
                                    alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                            </button>
                        </form>
                        <div class="product-info">
                            <h3 class="product-title"><?php echo htmlspecialchars($produto['nome']); ?></h3>
                            <p class="product-old-price">R$
                                <?php echo number_format($produto['preco_unitario'], 2, '.', ','); ?></p>
                            <p class="product-new-price">R$
                                <?php echo number_format($produto['preco_promocao'], 2, '.', ','); ?> À Vista</p>
                            <p class="product-description"><?php echo htmlspecialchars($produto['descricao']); ?></p>
                            <div class="product-action">
                                <?php
                                    // Gerar o link do WhatsApp para o produto atual
                                    $produtoNomeOuCodigo = $produto['codigo'];
                                    $linkWhatsapp = $redesSociaisController->exibirLinkWhatsapp($produtoNomeOuCodigo);
                                ?>
                                <a href="<?php echo $linkWhatsapp; ?>" class="product-button" target="_blank">
                                    <i class="fab fa-whatsapp"></i> Contato
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>

    </div>
</div>

<?php

require 'components/footer.php';

?>