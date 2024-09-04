<?php

$routes = [
    '/minha_loja/' => 'HomeController@apresentarTelaDeHome',
    '/minha_loja/login' => 'LoginController@redirecionaParaTelaDeLogin',
    '/minha_loja/validarlogin' => 'LoginController@autenticarCliente',
    '/minha_loja/logout' => 'LoginController@deslogarUsuario',
    '/minha_loja/home' => 'HomeController@apresentarTelaDeHome',
    '/minha_loja/cadastro' => 'CadastroController@redirecionaParaTelaDeCadastro',
    '/minha_loja/cadastrar' => 'ClienteController@cadastrarCliente',
    '/minha_loja/categoria' => 'CategoriaController@redirecionarParaTelaCategoria',
    '/minha_loja/detalhes' => 'ProdutoController@redirecionaParaTelaDetalhes',
    '/minha_loja/detalhesproduto' => 'ProdutoController@detalhesProduto',
    '/minha_loja/minhaconta' => 'PerfilController@apresentarTelaPerfil',
    '/minha_loja/carrinho' => 'CarrinhoController@apresentarTelaDeCarrinho',
    '/minha_loja/adicionar-carrinho' => 'CarrinhoController@adicionarAoCarrinho',
    '/minha_loja/pagamento' => 'CheckoutController@apresentarTelaCheckout',
    '/minha_loja/alteraendereco' => 'ClienteController@alterarEnderecoCliente',
    '/minha_loja/detalhesPedido' => 'PerfilController@redirecionaParaDetalhesPedido',
    '/minha_loja/pesquisa' => 'PesquisaController@redirecionaParaTelaDePesquisa',
    '/minha_loja/resultados' => 'PesquisaController@redirecionarParaTelaResultados',
    '/minha_loja/sucesso' => 'CheckoutController@redirecionaParaTelaDeSucesso',
    '/minha_loja/erro_404' => 'ErroController@redirecionarParaTelaDeErro404',
    '/minha_loja/erro_cadastro' => 'ErroController@redirecionarParaTelaDeErroCadastro',
    '/minha_loja/produtos' => 'ProdutoController@apresentarTodosOsProdutos',
    '/minha_loja/alterar_quantidade' => 'CarrinhoController@alterarQuantidadeCarrinho',
    '/minha_loja/usuario_nao_encontrado' => 'ErroController@redirecionartelaUsuarioNaoEncontrado',
    '/minha_loja/teste-produto' => 'ProdutoController@exibirProdutosEmDestaque',
    '/minha_loja/detalhespedido' => 'PedidoController@telaDetalhesPedido',
    '/minha_loja/alterarsenha' => 'ClienteController@alterarSenha',
    '/minha_loja/localizacao' => 'LocalizacaoController@redirecionarTelaLocalizacao',
    '/minha_loja/contato' => 'ContatoController@redirecionarParaTelaContato'
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
