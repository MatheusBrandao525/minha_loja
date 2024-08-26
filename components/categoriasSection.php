<?php
$categforiaContoller = new CategoriaController();

$todasAsCategorias = $categforiaContoller->exibirTodasCategorias();
?>
<section class="categorias-circulos">
    <h3>Navegue por categoria</h3>
    <div class="categories-scroll">

        <?php foreach ($todasAsCategorias as $categoria): ?>
            <form action="categoria" method="post">
                <div class="category-item">
                    <input type="hidden" name="categoriaid" value="<?php echo $categoria['categoria_id']; ?>">
                    <button type="submit" style="border: none; background-color:transparent">
                        <img src="public/assets/img/placeholder.jpg" alt="Hardware">
                        <span class="category-label"><?php echo $categoria['nome_categoria']; ?></span>
                    </button>
                </div>
            </form>
        <?php endforeach; ?>
    </div>
</section>