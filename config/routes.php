<?php

$routes = [
    '/minha_loja/' => 'LoginController@redirecionaParaTelaDeLogin',
    '/minha_loja/login' => 'LoginController@redirecionaParaTelaDeLogin',
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

// Obtém a URL da solicitação
if(isset($_GET['url'])){
$urlSolicitada = '/minha_loja/' . $_GET['url'];
/* echo $urlSolicitada;

die();
 */
// Verifica se a rota existe
if (array_key_exists($urlSolicitada, $routes)) {
    // Lógica para chamar o controlador e o método adequados
    list($controller, $method) = explode('@', $routes[$urlSolicitada]);


    // Aqui você instanciaria seu controlador e chamaria o método
} else {
    // Rota não encontrada, redirecionar para a página de erro 404
    header("Location: /minha_loja/erro_404");
    exit;
}
}