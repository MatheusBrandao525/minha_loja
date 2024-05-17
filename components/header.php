<?php
session_start();
require_once 'core/Conexao.php';
require 'models/UsuarioModel.php';

if (isset($_SESSION['ID'])) {
    $usuarioModel = new UsuarioModel();
    $dadosUsuario = $usuarioModel->buscarDadosUsuarioLogado($_SESSION['ID']);
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
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="public/assets/css/style_header.css">
    <link rel="stylesheet" href="public/assets/css/style_banner.css">
    <link rel="stylesheet" href="public/assets/css/style_banner-02.css">
    <link rel="stylesheet" href="public/assets/css/style_banner-03.css">
    <link rel="stylesheet" href="public/assets/css/style_produtos.css">
    <link rel="stylesheet" href="public/assets/css/style_detalhes.css">
    <link rel="stylesheet" href="public/assets/css/style_login.css">
    <link rel="stylesheet" href="public/assets/css/style_cadastro_usuario.css">
    <link rel="stylesheet" href="public/assets/css/style_perfil_usuario.css">
    <link rel="stylesheet" href="public/assets/css/style_carrinho.css">
    <?php if ($urlAtual === 'http://localhost/topMotos/categoria' || $urlAtual === 'http://localhost/topMotos/produtos' || $urlAtual === 'http://localhost/topMotos/pesquisa') { ?>
    <!-- Este estilo serve para a tela de Categorias, SubCategorias e Pesquisa -->
    <link rel="stylesheet" href="public/assets/css/style_categoria.css">
    <?php } ?>
    <link rel="stylesheet" href="public/assets/css/style_footer.css">
    <title>NomeLoja</title>
</head>

<body>
    <div class="overlay"></div>

    <header class="page-header">

        <section class="topHeader">
            <div class="container-wrapper">
                <ul class="topLinks">
                    <li class="borda-direita">
                        <a href="tel:+551129432050" rel="nofollow">
                            <span>
                                <i class="fas fa-phone-alt"></i>
                                <small>11</small> 2943-2050
                            </span>
                        </a>
                    </li>

                    <li class="borda-direita">
                        <a href="" target="_blank" rel="nofollow">
                            <span>
                                <i class="fab fa-whatsapp"></i>
                                <small>11</small> 98146-6079
                            </span>
                        </a>
                    </li>

                    <li class="borda-direita">
                        <a href="" target="_blank" rel="nofollow">
                            <span>
                                <i class="fas fa-envelope"></i>
                                atendimento@mirao.com.br
                            </span>
                        </a>
                    </li>
                </ul>
                <ul class="topLinks topLinks-responsivo">
                    <li class="borda-direita">
                        <a class="topHeader_link mconta" href="conta">
                            <i class="fa fa-user" aria-hidden="true"></i> Minha Conta
                        </a>
                    </li>
                    <li>
                        <a class="topHeader_link mpedidos" href="">
                            <i class="fa fa-box-open" aria-hidden="true"></i> Meus Pedidos
                        </a>
                    </li>
                </ul>

            </div>
        </section>
        <div id="headerStarter" class="header container-wrapper">
            <a class="logo" href="" title="" aria-label="store logo">
                <img src="public/assets/img/site/tm_plus.png" title="" alt="" width="170">
            </a>

            <div class="block block-search">
                <div class="block block-content">
                    <form class="form minisearch" id="search_mini_form" action="" method="get">
                        <div class="field search">
                            <div class="control has-icon">
                                <input id="search" type="text" name="q" value=""
                                    placeholder="Digite o que está buscando..." class="input-text" maxlength="128"
                                    role="combobox" aria-haspopup="false" aria-autocomplete="both" autocomplete="off"
                                    aria-expanded="false">
                                <button type="submit" class="search-btn"><i
                                        class="fas fa-search search-icon"></i></button>
                                <div id="search_autocomplete" class="search-autocomplete"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <ul class="linksCustomer">
                <li class="header_account_link_list">
                    <i class="fas fa-sign-in-alt"></i>
                    <?php if (!isset($_SESSION['ID'])) {  ?>
                    <div>
                        <span>Faça <a class="header_account_link login" href="login"
                                class="login"><strong>Login</strong></a> ou </span>
                        <a class="header_account_link cadastro strong" href="cadastro"><strong>Cadastre-se</strong></a>
                    </div>
                    <?php } else { ?>
                    <div>
                        <a class="header_account_link login" href="conta" class="login"
                            style="margin-left: 0 !important;"><strong>Minha Conta</strong></a>
                        <form action="sair" method="post">
                            <input type="hidden" name="idsessaousuario" value="<?php echo $_SESSION['ID']; ?>">
                            <button type="submit" class="header_account_link sair strong"><strong>Sair</strong></button>
                        </form>
                    </div>
                    <?php } ?>
                </li>
            </ul>

            <!-- Segundo logo substituindo a seção do carrinho -->
            <a class="logo" href="" title="" aria-label="second store logo">
                <img src="public/assets/img/site/top_motos.png" title="" alt="" width="170">
            </a>
        </div>

        <nav class="navigation">
            <div class="menu-toggle">
                <span>Categorias</span>
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-links">
                <li>
                    <form action="categorias" method="post">
                        <input type="hidden" value="" name="">
                        <button type="submit"><i class="fas fa-tools"></i> Categoria01</button>
                    </form>
                </li>
                <li>
                    <form action="categorias" method="post">
                        <input type="hidden" value="" name="">
                        <button type="submit"><i class="fas fa-motorcycle"></i> Categoria02</button>
                    </form>
                </li>
                <li>
                    <form action="categorias" method="post">
                        <input type="hidden" value="" name="">
                        <button type="submit"><i class="fas fa-cog"></i> Categoria03</button>
                    </form>
                </li>
                <li>
                    <form action="categorias" method="post">
                        <input type="hidden" value="" name="">
                        <button type="submit"><i class="fas fa-toolbox"></i> Categoria04</button>
                    </form>
                </li>
                <li>
                    <form action="categorias" method="post">
                        <input type="hidden" value="" name="">
                        <button type="submit"><i class="fas fa-car"></i> Categoria05</button>
                    </form>
                </li>
                <li>
                    <form action="categorias" method="post">
                        <input type="hidden" value="" name="">
                        <button type="submit"><i class="fas fa-lightbulb"></i> Categoria06</button>
                    </form>
                </li>
                <li>
                    <form action="categorias" method="post">
                        <input type="hidden" value="" name="">
                        <button type="submit"><i class="fas fa-plug"></i> Categoria07</button>
                    </form>
                </li>
                <li>
                    <form action="categorias" method="post">
                        <input type="hidden" value="" name="">
                        <button type="submit"><i class="fas fa-shield-alt"></i> Categoria08</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>