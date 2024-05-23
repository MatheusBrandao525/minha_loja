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
    <!-- <link rel="stylesheet" href="public/assets/css/style_banner-02.css"> -->
    <!-- <link rel="stylesheet" href="public/assets/css/style_banner-03.css"> -->
    <link rel="stylesheet" href="public/assets/css/style_produtos.css">
    <!-- <link rel="stylesheet" href="public/assets/css/style_detalhes.css"> -->
    <!-- <link rel="stylesheet" href="public/assets/css/style_login.css"> -->
    <!-- <link rel="stylesheet" href="public/assets/css/style_cadastro_usuario.css"> -->
    <!-- <link rel="stylesheet" href="public/assets/css/style_perfil_usuario.css"> -->
    <!-- <link rel="stylesheet" href="public/assets/css/style_carrinho.css"> -->
    <?php if ($urlAtual === 'http://localhost/topMotos/categoria' || $urlAtual === 'http://localhost/topMotos/produtos' || $urlAtual === 'http://localhost/topMotos/pesquisa') { ?>
    <!-- Este estilo serve para a tela de Categorias, SubCategorias e Pesquisa -->
    <link rel="stylesheet" href="public/assets/css/style_categoria.css">
    <?php } ?>
    <link rel="stylesheet" href="public/assets/css/style_footer.css">
    <title>NomeLoja</title>
</head>

<body>
    <div class="overlay"></div>

    <header>
        <div class="top-bar">
            <div class="container">
                <img src="public/assets/img/site/exemplo-banner-top.jpeg" alt="">
            </div>
        </div>
        <nav class="nav-top-bar">

            <ul class="ul-nav-top-bar">
                <li>
                    <h3>Colt</h3>
                </li>
                <li>
                    <h3>Bella</h3>
                </li>
            </ul>
            <ul class="ul-nav-top-bar">
                <li class="">
                    <a href="" title="Meus Pedidos">Meus Pedidos</a>
                </li>
                <li class="">
                    <a href="" title="Nossas Lojas">Nossas Lojas</a>
                </li>
                <li class="">
                    <a href="" class="">
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
            <div class="container">
                <img src="public/assets/img/site/logo_colt_bella.png" alt="Logo" class="logo">
                <nav class="main-nav">
                    <div class="block block-search">
                        <!-- <div class="block block-title"><strong>Pesquisa</strong></div> -->
                        <div class="block block-content">
                            <form class="form minisearch" id="search_mini_form" action="" method="get">
                                <div class="field search">
                                    <!-- <label class="label" for="search" data-role="minisearch-label"><span>Pesquisa</span></label> -->
                                    <div class="control has-icon">
                                        <input id="search" type="text" name="q" value=""
                                            placeholder="Digite o que está buscando..." class="input-text"
                                            maxlength="128" role="combobox" aria-haspopup="false"
                                            aria-autocomplete="both" autocomplete="off" aria-expanded="false">
                                        <button type="submit" class="search-btn"><i
                                                class="fas fa-search search-icon"></i></button>
                                        <div id="search_autocomplete" class="search-autocomplete"></div>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </nav>
                <div class="user-actions">
                    <a href="#" style="margin-right:20px;">
                        <div style="display:flex; flex-direction:row; text-align:left; align-items:center;">
                            <i class="fas fa-user" style="margin-right:10px;"></i> Entre ou cadastrar-se
                        </div>
                    </a>
                    <a href="#">
                        <div style="display:flex; flex-direction:row; text-align:left; align-items:center;">
                            <i class="fas fa-shopping-bag" style="margin-right:10px;"></i> Minhas compras
                            </br>R$ 0,00 (Subtotal)
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="categorias">
            <div class="category-icons">
                <a href="#">Feminino</a>
                <a href="#">Masculino</a>
                <a href="#">Calçados</a>
                <a href="#">Infantil</a>
                <a href="#">Lingerie</a>
                <a href="#">Plus Size</a>
                <a href="#">Acessórios</a>
                <a href="#">Casa</a>
            </div>
        </div>
        <div class="promo-bar">
            <div class="container">
                <img src="public/assets/img/site/exemplo-banner-whatsapp.jpeg" alt="">
            </div>
        </div>
    </header>
    <main>