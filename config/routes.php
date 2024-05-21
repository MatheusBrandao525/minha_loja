<?php
session_start();

$routes = [
    '/minha_loja/' => 'HomeController@apresentarTelaDeHome', //✅ 768px
    '/minha_loja/login' => 'LoginController@redirecionaParaTelaDeLogin', //✅ 768px
    '/minha_loja/validarLogin' => 'LoginController@autenticarUsuario',
    '/minha_loja/sair' => 'LoginController@deslogarUsuario',
    '/minha_loja/home' => 'HomeController@apresentarTelaDeHome', //✅ 768px 
    '/minha_loja/cadastro' => 'CadastroController@redirecionaParaTelaDeCadastro', //✅ 768px
    '/minha_loja/processarCadastro' => 'CadastroController@cadastrarCliente', //✅ 768px
    '/minha_loja/categoria' => 'CategoriaController@redirecionarParaTelaCategoria', //✅ 768px
    '/minha_loja/detalhes' => 'ProdutoController@redirecionaParaTelaDetalhes', //✅ 768px
    '/minha_loja/conta' => 'PerfilController@apresentarTelaPerfil',
    '/minha_loja/pesquisa' => 'PesquisaController@redirecionaParaTelaDePesquisa', //✅ 768px
    '/minha_loja/erro_404' => 'ErroController@redirecionarParaTelaDeErro404',
    '/minha_loja/produtos' => 'ProdutoController@apresentarTodosOsProdutos', //✅ 768px
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
    // rotas que podem ser usadas futuramente.
    // '/minha_loja/carrinho' => 'CarrinhoController@apresentarTelaDeCarrinho',
    // '/minha_loja/checkout' => 'CheckoutController@apresentarTelaCheckout',
    // '/minha_loja/subCategoria' => 'CategoriaController@redirecionarParaSubCategorias',
    // '/minha_loja/detalhesPedido' => 'PerfilController@redirecionaParaDetalhesPedido',
    
    // '/minha_loja/sucesso' => 'CheckoutController@redirecionaParaTelaDeSucesso',