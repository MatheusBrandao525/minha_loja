<?php

class CategoriaController {

    public function redirecionarParaTelaCategoria()
    {
        include ROOT_PATH . '/views/categorias.php';
    }

    public function redirecionarParaSubCategorias()
    {
        include ROOT_PATH . '/views/subCategoria.php';
    }
}