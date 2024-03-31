<?php

$routes = [
    '/minha_loja/' => 'LoginController@redirecionaParaTelaDeLogin',
    '/minha_loja/login' => 'LoginController@redirecionaParaTelaDeLogin',
    '/minha_loja/validarLogin' => 'LoginController@autenticarUsuario',
    '/minha_loja/sair' => 'LoginController@deslogarUsuario',
    '/minha_loja/home' => 'HomeController@apresentarTelaDeHome',
    '/minha_loja/cadastro' => 'CadastroController@redirecionaParaTelaDeCadastro',
    '/minha_loja/categoria' => 'CategoriaController@redirecionarParaTelaCategoria',
    '/minha_loja/detalhes' => 'ProdutoController@redirecionaParaTelaDetalhes',
    '/minha_loja/conta' => 'PerfilController@apresentarTelaPerfil',
    '/minha_loja/carrinho' => 'CarrinhoController@apresentarTelaDeCarrinho',
    '/minha_loja/checkout' => 'CheckoutController@apresentarTelaCheckout',
    '/minha_loja/subCategoria' => 'CategoriaController@redirecionarParaSubCategorias',
    '/minha_loja/detalhesPedido' => 'PerfilController@redirecionaParaDetalhesPedido',
    '/minha_loja/pesquisa' => 'PesquisaController@redirecionaParaTelaDePesquisa',
    '/minha_loja/sucesso' => 'CheckoutController@redirecionaParaTelaDeSucesso',
    '/minha_loja/erro_404' => 'ErroController@redirecionarParaTelaDeErro404',
    '/minha_loja/usuario_nao_encontrado' => 'ErroController@redirecionartelaUsuarioNaoEncontrado'
];

if (isset($_GET['url'])) {
    $urlSolicitada = '/minha_loja/' . $_GET['url'];
    if (array_key_exists($urlSolicitada, $routes)) {
        list($controller, $method) = explode('@', $routes[$urlSolicitada]);
    } else {
        header("Location: /minha_loja/erro_404");
        exit;
    }
}
