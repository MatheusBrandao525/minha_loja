<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
require_once 'core/Conexao.php';
require 'controllers/ClienteController.php';
require_once 'controllers/CarrinhoController.php';
require_once 'controllers/CategoriaController.php';
require_once 'controllers/PedidoController.php';

$categforiaContoller = new CategoriaController();
$categoriasPrincipais = $categforiaContoller->exibirCategoriasPrincipais();

$totalCarrinho = 0;

if (isset($_SESSION['ID'])) {
    $clienteController = new ClienteController();
    $dadosUsuario = $clienteController->exibirDadosClienteLogado($_SESSION['ID']);

    $carrinhoController = new CarrinhoController();
    $produtosCarrinho = $carrinhoController->exibirProdutosNoCarrinho($_SESSION['ID']);

    $totalCarrinho = $carrinhoController->valorTotalCarrinhoClienteLogado($_SESSION['ID']);

    $pedidoController = new PedidoController();
    $pedidosCliente = $pedidoController->exibirPedidosDoCliente($_SESSION['ID']);
}

$urlAtual = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="public/assets/css/style_header.css">
    <link rel="stylesheet" href="public/assets/css/style_banner.css">
    <link rel="stylesheet" href="public/assets/css/style_banner-03.css">
    <link rel="stylesheet" href="public/assets/css/style_produtos.css">
    <link rel="stylesheet" href="public/assets/css/style_login.css">
    <link rel="stylesheet" href="public/assets/css/style_cadastro_usuario.css">
    <link rel="stylesheet" href="public/assets/css/style_carrinho.css">
    <?php if ($urlAtual === 'http://localhost/minha_loja/categoria') { ?>
        <link rel="stylesheet" href="public/assets/css/style_categoria.css"> <?php } ?>
    <?php if ($urlAtual === 'http://localhost/minha_loja/produtos') { ?> <?php } ?>
    <?php if ($urlAtual === 'http://localhost/minha_loja/pesquisa') { ?> <?php } ?>
    <?php if ($urlAtual === 'http://localhost/minha_loja/detalhesproduto') { ?>
        <link rel="stylesheet" href="public/assets/css/style_detalhes.css">
        <link rel="stylesheet" href="public/assets/css/style_categoria.css"> <?php } ?>
    <link rel="stylesheet" href="public/assets/css/style_footer.css">
    <title>Colt Bella</title>

    <style>
        .minhaconta div {
            color: #caad5f;
        }

        .container-header {
            overflow: visible;
            /* Certifique-se de que o contêiner permita que o dropdown seja exibido completamente */
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            min-width: 120px;
            border-radius: 4px;
        }

        .dropdown-content a {
            padding: 10px 5px;
            text-decoration: none;
            border-radius: 4px;
            margin-left: 0 !important;
            display: block;
            color: black;
            background-color: white;
        }

        .dropdown-content form button {
            border: none;
            width: 100%;
            background-color: #fff;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Certifique-se de que o contêiner permita a exibição completa do dropdown */
        .container-header {
            position: relative;
        }
    </style>

</head>

<body>
    <div class="overlay"></div>

    <header>
        <!--         <div class="top-bar">
            <div class="container">
                <img src="public/assets/img/site/exemplo-banner-top.jpeg" alt="">
            </div>
        </div> -->
        <nav class="nav-top-bar">

            <a href="home" style="text-decoration: none;">
                <ul class="ul-nav-top-bar">
                    <li>
                        <h3>Colt</h3>
                    </li>
                    <li>
                        <h3>Bella</h3>
                    </li>
                </ul>
            </a>
            <ul class="ul-nav-top-bar">
                <li class="">
                    <a href="minhaconta" title="Meus Pedidos">Meus Pedidos</a>
                </li>
                <li class="">
                    <a href="localizacao" title="Nossas Lojas">Nossas Lojas</a>
                </li>
                <li class="">
                    <a href="contato" class="">
                        Atendimento<i class="ion-chevron-down hide"></i>
                    </a>

                    <!-- <ul class="">
                            <li class="">
                                <a href="" title="Como comprar">Como comprar</a>
                            </li>
                            <li class="">
                                <a href="" title="Fale conosco">Fale conosco</a>
                            </li>
                        </ul> -->
                </li>

                <li class="">
                    <a href="" class="">
                        <span class="">
                            Cartões e Serviços</span>
                    </a>
                </li>
            </ul>

        </nav>
        <div class="logo-bar">
            <div class="container-header">
                <a href="home">
                    <img src="public/assets/img/site/logo_colt_bella.png" alt="Logo" class="logo">
                </a>
                <nav class="main-nav">
                    <div class="block block-search">
                        <!-- <div class="block block-title"><strong>Pesquisa</strong></div> -->
                        <div class="block block-content">
                            <form class="form minisearch" id="search_mini_form" action="pesquisa" method="post">
                                <div class="field search">
                                    <!-- <label class="label" for="search" data-role="minisearch-label"><span>Pesquisa</span></label> -->
                                    <div class="control has-icon">
                                        <input id="search" type="text" name="pesquisa" value="" placeholder="Digite o que está buscando..." class="input-text" maxlength="128" role="combobox" aria-haspopup="false" aria-autocomplete="both" autocomplete="off" aria-expanded="false">
                                        <button type="submit" class="search-btn"><i class="fas fa-search search-icon"></i></button>
                                        <div id="search_autocomplete" class="search-autocomplete"></div>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </nav>
                <div class="user-actions">
                    <?php if (isset($_SESSION['ID'])): ?>
                        <!-- Se a variável $_SESSION['ID'] estiver definida, exibe o nome do usuário com um dropdown -->
                        <div class="dropdown" style="position: relative;">
                            <div class="minhaconta" style="margin-right:20px;">
                                <div style="display:flex; flex-direction:row; text-align:left; align-items:center; cursor:pointer;">
                                    <i class="fas fa-user" style="margin-right:10px;"></i> <?php echo $dadosUsuario['nome']; ?>
                                </div>
                            </div>
                            <!-- Dropdown content -->
                            <div class="dropdown-content">
                                <a href="minhaconta">Minha Conta</a>
                                <form action="logout" method="post">
                                    <input type="hidden" value="<?php echo $dadosUsuario['cliente_id']; ?>" name="idsessaousuario">
                                    <button>Sair</button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Caso contrário, exibe o link para 'Login' -->
                        <a href="login" style="margin-right:20px;">
                            <div style="display:flex; flex-direction:row; text-align:left; align-items:center;">
                                <i class="fas fa-user" style="margin-right:10px;"></i> Entre ou cadastrar-se
                            </div>
                        </a>
                    <?php endif; ?>

                    <!-- Link para 'Minhas compras' -->
                    <a href="carrinho">
                        <div style="display:flex; flex-direction:row; text-align:left; align-items:center;">
                            <i class="fas fa-shopping-bag" style="margin-right:10px;"></i> Minhas compras
                            <br>R$ <?php echo isset($_SESSION['ID']) ? number_format($totalCarrinho, 2, ',', '.') : '0,00'; ?> (Subtotal)
                        </div>
                    </a>
                </div>


            </div>
        </div>
        <div class="categorias">
            <div class="category-icons">
                <?php
                foreach ($categoriasPrincipais as $categoria): ?>
                    <form action="categoria" method="post">
                        <input type="hidden" name="categoriaid" value="<?php echo $categoria['categoria_id']; ?>">
                        <button type="submit" style="border: none; background-color:transparent">
                            <a href="#"><?php echo $categoria['nome_categoria']; ?></a>
                        </button>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="promo-bar">
            <div class="container">
                <img src="public/assets/img/site/exemplo-banner-whatsapp.jpeg" alt="">
            </div>
        </div>
    </header>
    <main>