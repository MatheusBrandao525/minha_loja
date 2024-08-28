<?php
require_once 'models/CategoriaModel.php';
class CategoriaController
{

    public function redirecionarParaTelaCategoria()
    {
        include ROOT_PATH . '/views/categorias.php';
    }

    public function redirecionarParaSubCategorias()
    {
        include ROOT_PATH . '/views/subCategoria.php';
    }

    public function exibirTodasCategorias()
    {
        $categoriaModel = new CategoriaModel();
        $todasAsCategorias = $categoriaModel->buscarTodasAsCategorias();

        return $todasAsCategorias;
    }

    public function exibirCategoriasPrincipais()
    {
        $categoriaModel = new CategoriaModel();
        $categoriasPrincipais = $categoriaModel->buscarCategoriasPrinpais();

        return $categoriasPrincipais;
    }
}
