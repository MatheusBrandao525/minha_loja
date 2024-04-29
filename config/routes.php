<?php

$routes = [
    '/topMotos/' => 'HomeController@apresentarTelaDeHome',
    '/topMotos/login' => 'LoginController@redirecionaParaTelaDeLogin',
    '/topMotos/validarLogin' => 'LoginController@autenticarUsuario',
    '/topMotos/sair' => 'LoginController@deslogarUsuario',
    '/topMotos/home' => 'HomeController@apresentarTelaDeHome',
    '/topMotos/cadastro' => 'CadastroController@redirecionaParaTelaDeCadastro',
    '/topMotos/categoria' => 'CategoriaController@redirecionarParaTelaCategoria',
    '/topMotos/detalhes' => 'ProdutoController@redirecionaParaTelaDetalhes',
    '/topMotos/conta' => 'PerfilController@apresentarTelaPerfil',
    '/topMotos/carrinho' => 'CarrinhoController@apresentarTelaDeCarrinho',
    '/topMotos/checkout' => 'CheckoutController@apresentarTelaCheckout',
    '/topMotos/subCategoria' => 'CategoriaController@redirecionarParaSubCategorias',
    '/topMotos/detalhesPedido' => 'PerfilController@redirecionaParaDetalhesPedido',
    '/topMotos/pesquisa' => 'PesquisaController@redirecionaParaTelaDePesquisa',
    '/topMotos/sucesso' => 'CheckoutController@redirecionaParaTelaDeSucesso',
    '/topMotos/erro_404' => 'ErroController@redirecionarParaTelaDeErro404',
    '/topMotos/produtos' => 'ProdutoController@apresentarTodosOsProdutos',
    '/topMotos/usuario_nao_encontrado' => 'ErroController@redirecionartelaUsuarioNaoEncontrado'
];

if (isset($_GET['url'])) {
    $urlSolicitada = '/topMotos/' . $_GET['url'];
    if (array_key_exists($urlSolicitada, $routes)) {
        list($controller, $method) = explode('@', $routes[$urlSolicitada]);
    } else {
        header("Location: /topMotos/erro_404");
        exit;
    }
}
