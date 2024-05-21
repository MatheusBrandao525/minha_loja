<?php
require_once 'models/CategoriaModel.php';

class CategoriaController {

    public function redirecionarParaTelaCategoria()
    {
        include ROOT_PATH . '/views/categorias.php';
    }

    public function redirecionarParaSubCategorias()
    {
        include ROOT_PATH . '/views/subCategoria.php';
    }

    public function exibirCategorias()
    {
        $categoriaModel = new CategoriaModel();
        
        return $categoriaModel->buscarCategorias();
    }
}