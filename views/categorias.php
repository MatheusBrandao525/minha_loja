<?php
require 'components/header.php';
if ($_SERVER['REQUEST_METHOD'] === 'post' && !empty($_POST['categoriaid'])) {
    $categoriaId = $_POST['categoriaid'];

    $produtoController = new produtoController();
    $produtosCategoria = $produtoController->exibeProdutosPorCategoria($categoriaId);
}

if (!empty($produtosCategoria)) {
?>
    <div class="categoria-container">
        <div class="container-categorias">

            <div class="titulo-categoria">
                <h2>Titulo da Categoria</h2>
            </div>

            <div class="conteudo">
                <aside class="sidebar">
                    <!-- Filtro de Categoria -->
                    <div class="filtro">
                        <div class="filtro-titulo">Categoria</div>
                        <div class="filtro-opcoes">
                            <label><input type="checkbox" name="categoria" value="categoria1"> Opção 1</label>
                            <label><input type="checkbox" name="categoria" value="categoria2"> Opção 2</label>
                            <label><input type="checkbox" name="categoria" value="categoria3"> Opção 3</label>
                        </div>
                    </div>

                    <!-- Filtro de Preço -->
                    <div class="filtro">
                        <div class="filtro-titulo">Preço</div>
                        <div class="filtro-opcoes">
                            <label><input type="checkbox" name="preco" value="preco1"> Opção 1</label>
                            <label><input type="checkbox" name="preco" value="preco2"> Opção 2</label>
                            <label><input type="checkbox" name="preco" value="preco3"> Opção 3</label>
                        </div>
                    </div>

                    <!-- Filtro de Cor -->
                    <div class="filtro">
                        <div class="filtro-titulo">Cor</div>
                        <div class="filtro-opcoes">
                            <label><input type="checkbox" name="cor" value="cor1"> Opção 1</label>
                            <label><input type="checkbox" name="cor" value="cor2"> Opção 2</label>
                            <label><input type="checkbox" name="cor" value="cor3"> Opção 3</label>
                        </div>
                    </div>
                </aside>


                <div class="produtos-categoria">
                    <div class="imagem-categoria">
                        <!-- Imagem relacionada à categoria -->
                        <img src="public/assets/img/placeholder.jpg" alt="Categoria">
                    </div>
                    <div class="toolbar toolbar-products">
                        <div class="modes"> <strong class="modes-label" id="modes-label">Ver como</strong> <strong title="Grade" class="modes-mode active mode-grid" data-value="grid"><span>Grade</span></strong> <a class="modes-mode mode-list" title="Lista" href="#" data-role="mode-switcher" data-value="list" id="mode-list" aria-labelledby="modes-label mode-list"><span>Lista</span></a> </div>
                        <p class="toolbar-amount" id="toolbar-amount"> Itens encontrados <span class="toolbar-number">1</span>-<span class="toolbar-number">20</span> of <span class="toolbar-number">782</span> </p>
                        <div class="toolbar-sorter sorter"><label class="sorter-label" for="sorter">Ordenar por:</label>
                            <div class="styleSelect"><select id="sorter" data-role="sorter" class="sorter-options">
                                    <option value="position" selected="">Posição</option>
                                    <option value="name">Nome do produto</option>
                                    <option value="price">Preço</option>
                                </select></div> <a title="Definir Direção Decrescente" href="#" class="action sorter-action sort-asc" data-role="direction-switcher" data-value="desc"><span>Definir Direção Decrescente</span></a>
                        </div>
                        <div class="field limiter"><label class="label" for="limiter"><span>Exibir:</span></label>
                            <div class="control">
                                <div class="styleSelect"><select id="limiter" data-role="limiter" class="limiter-options">
                                        <option value="20" selected="">20</option>
                                        <option value="40">40</option>
                                        <option value="60">60</option>
                                    </select></div>
                            </div>
                        </div>
                        <div class="pages"><strong class="label pages-label" id="paging-label">Página</strong>
                            <ul class="items pages-items" aria-labelledby="paging-label">
                                <li class="item current"><strong class="page"><span class="label">Você esta lendo a pagina</span> <span>1</span></strong></li>
                                <li class="item"><a href="" class="page"><span class="label">Página</span> <span>2</span></a></li>
                                <li class="item"><a href="" class="page"><span class="label">Página</span> <span>3</span></a></li>
                                <li class="item"><a href="" class="page"><span class="label">Página</span> <span>4</span></a></li>
                                <li class="item"><a href="" class="page"><span class="label">Página</span> <span>5</span></a></li>
                                <li class="item pages-item-next"> <a class="link  next-page" href="" title="PRÓXIMA PÁGINA"><span class="label">Página</span> <span>PRÓXIMA PÁGINA</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="produtos">
                        <?php foreach ($produtosCategoria as $produto) : ?>
                            <div class="product-card">
                                <form method="post" action="detalhes" class="product-image">
                                    <button type="submit" href="/minha_loja/detalhes/<?php echo $i; ?>">
                                        <img src="public/assets/img/fonte.jpg" alt="Nome do Produto">
                                    </button>
                                </form>
                                <div class="product-info">
                                    <h3 class="product-title"><?php echo $produto['nome']; ?></h3>
                                    <p class="product-old-price">R$ <?php echo number_format($produto['preco_unitario'], 2, ',', '.'); ?></p>
                                    <p class="product-new-price">R$ <?php echo number_format($produto['preco_promocao'], 2, ',', '.'); ?> À Vista</p>
                                    <p class="product-description">Descrição curta do produto...</p>
                                    <div class="product-action">
                                        <div class="qtywrap">
                                            <button class="quantity-btn decrease-quantity"><i class="fas fa-minus"></i></button>
                                            <input type="number" id="product-quantity-<?php echo $i; ?>" class="product-quantity" name="quantity" value="1" min="1" step="1">
                                            <button class="quantity-btn increase-quantity"><i class="fas fa-plus"></i></button>
                                        </div>
                                        <button class="product-button">Comprar</button>
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
} else {
?>
    <div style="text-align: center;padding: 2rem 0;">
        <h3>Nenhum produto disponível no momento.</h3>
    </div>

<?php
}
require 'components/footer.php';

?>