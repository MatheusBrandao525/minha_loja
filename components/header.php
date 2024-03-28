<?php
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
    <link rel="stylesheet" href="public/assets/css/style_banner-02.css">
    <link rel="stylesheet" href="public/assets/css/style_banner-03.css">
    <link rel="stylesheet" href="public/assets/css/style_produtos.css">
    <link rel="stylesheet" href="public/assets/css/style_detalhes.css">
    <link rel="stylesheet" href="public/assets/css/style_login.css">
    <link rel="stylesheet" href="public/assets/css/style_cadastro_usuario.css">
    <link rel="stylesheet" href="public/assets/css/style_perfil_usuario.css">
    <link rel="stylesheet" href="public/assets/css/style_carrinho.css">
    <?php if ($urlAtual === 'http://localhost/minha_loja/categoria') { ?>
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
                                <i class="fas fa-phone-alt"></i> <!-- Ícone de telefone adicionado aqui -->
                                <small>11</small> 2943-2050
                            </span>
                        </a>
                    </li>

                    <li class="borda-direita">
                        <a href="" target="_blank" rel="nofollow">
                            <span>
                                <i class="fab fa-whatsapp"></i> <!-- Ícone do WhatsApp adicionado aqui -->
                                <small>11</small> 98146-6079
                            </span>
                        </a>
                    </li>

                    <li class="borda-direita">
                        <a href="" target="_blank" rel="nofollow">
                            <span>
                                <i class="fas fa-envelope"></i> <!-- Ícone de e-mail adicionado aqui -->
                                atendimento@mirao.com.br
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fas fa-rss"></i> Blog
                        </a>
                    </li>

                </ul>
                <ul class="topLinks">
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
        <div id="headerStarter" class="header container-wrapper"> <a class="logo" href="" title="" aria-label="store logo"><img src="public/assets/img/image.png" title="" alt="" width="170"></a>
            <div class="block block-search">
                <!-- <div class="block block-title"><strong>Pesquisa</strong></div> -->
                <div class="block block-content">
                    <form class="form minisearch" id="search_mini_form" action="" method="get">
                        <div class="field search">
                            <!-- <label class="label" for="search" data-role="minisearch-label"><span>Pesquisa</span></label> -->
                            <div class="control has-icon">
                                <input id="search" type="text" name="q" value="" placeholder="Digite o que está buscando..." class="input-text" maxlength="128" role="combobox" aria-haspopup="false" aria-autocomplete="both" autocomplete="off" aria-expanded="false">
                                <button type="submit" class="search-btn"><i class="fas fa-search search-icon"></i></button>
                                <div id="search_autocomplete" class="search-autocomplete"></div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
            <ul class="linksCustomer">
                <li class="header_account_link_list">
                    <i class="fas fa-sign-in-alt"></i> <!-- Ícone de entrar -->
                    <div>
                        <span>Faça <a class="header_account_link login" href="login" class="login"><strong>Login</strong></a> ou </span>
                        <a class="header_account_link cadastro strong" href="cadastro"><strong>Cadastre-se</strong></a>
                    </div>
                </li>
            </ul>

            <div id="custom-sliding-cart">
                <div data-block="minicart" class="minicart-wrapper">
                    <a class="action showcart" href="#" onclick="toggleCartVisibility()">
                        <span class="text">
                            <i class="fas fa-shopping-cart"></i> Carrinho
                        </span>
                        <span class="counter qty empty">
                            <span class="counter-label"></span>
                            <span class="counter-number">Itens | 0</span>
                        </span>
                    </a>
                </div>
            </div>

            <div id="cart-sidebar" class="cart-sidebar">
                <div class="cart-header">
                    <span class="cart-title">Seu Carrinho</span>
                    <button class="close-cart" onclick="toggleCartVisibility()"><i class="fas fa-times"></i></button>
                </div>
                <div class="cart-items">
                    <div class="carrinho-item">
                        <img src="public/assets/img/placeholder.jpg" alt="Nome do Produto">
                        <div class="descricao">
                            <div class="topo-carrinho-item">
                                <strong>Nome do Produto</strong>
                                <button class="excluir-btn"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="centraliza-carrinho-item">
                                <div class="quantidade-control">
                                    <button>-</button>
                                    <input type="text" class="quantidade" value="1">
                                    <button>+</button>
                                </div>
                                <div class="precos-carrinho-item">
                                    <span class="valor-unitario-item">
                                        R$ 00,00
                                    </span>
                                    <span class="subtotal">
                                        SUBTOTAL R$ 00,00
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="carrinho-item">
                        <img src="public/assets/img/placeholder.jpg" alt="Nome do Produto">
                        <div class="descricao">
                            <div class="topo-carrinho-item">
                                <strong>Nome do Produto</strong>
                                <button class="excluir-btn"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="centraliza-carrinho-item">
                                <div class="quantidade-control">
                                    <button>-</button>
                                    <input type="text" class="quantidade" value="1">
                                    <button>+</button>
                                </div>
                                <div class="precos-carrinho-item">
                                    <span class="valor-unitario-item">
                                        R$ 00,00
                                    </span>
                                    <span class="subtotal">
                                        SUBTOTAL R$ 00,00
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="carrinho-item">
                        <img src="public/assets/img/placeholder.jpg" alt="Nome do Produto">
                        <div class="descricao">
                            <div class="topo-carrinho-item">
                                <strong>Nome do Produto</strong>
                                <button class="excluir-btn"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="centraliza-carrinho-item">
                                <div class="quantidade-control">
                                    <button>-</button>
                                    <input type="text" class="quantidade" value="1">
                                    <button>+</button>
                                </div>
                                <div class="precos-carrinho-item">
                                    <span class="valor-unitario-item">
                                        R$ 00,00
                                    </span>
                                    <span class="subtotal">
                                        SUBTOTAL R$ 00,00
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="carrinho-item">
                        <img src="public/assets/img/placeholder.jpg" alt="Nome do Produto">
                        <div class="descricao">
                            <div class="topo-carrinho-item">
                                <strong>Nome do Produto</strong>
                                <button class="excluir-btn"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="centraliza-carrinho-item">
                                <div class="quantidade-control">
                                    <button>-</button>
                                    <input type="text" class="quantidade" value="1">
                                    <button>+</button>
                                </div>
                                <div class="precos-carrinho-item">
                                    <span class="valor-unitario-item">
                                        R$ 00,00
                                    </span>
                                    <span class="subtotal">
                                        SUBTOTAL R$ 00,00
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="carrinho-item">
                        <img src="public/assets/img/placeholder.jpg" alt="Nome do Produto">
                        <div class="descricao">
                            <div class="topo-carrinho-item">
                                <strong>Nome do Produto</strong>
                                <button class="excluir-btn"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="centraliza-carrinho-item">
                                <div class="quantidade-control">
                                    <button>-</button>
                                    <input type="text" class="quantidade" value="1">
                                    <button>+</button>
                                </div>
                                <div class="precos-carrinho-item">
                                    <span class="valor-unitario-item">
                                        R$ 00,00
                                    </span>
                                    <span class="subtotal">
                                        SUBTOTAL R$ 00,00
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="cart-form-cupom">
                    <input type="text" placeholder="Insira um cupom de desconto...">
                    <button>Usar</button>
                </div>
                <div class="cart-info">
                    <table>
                        <tr>
                            <td>Total Items</td>
                            <td class="cart-info-valor">R$ 590,00</td>
                        </tr>
                        <tr>
                            <td>Frete</td>
                            <td class="cart-info-valor">R$ 90,00</td>
                        </tr>
                        <tr>
                            <td>Imposto</td>
                            <td class="cart-info-valor">R$ 40,00</td>
                        </tr>
                        <tr>
                            <td>Desconto</td>
                            <td class="cart-info-valor">- R$ 52,90</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td class="cart-info-valor">R$ 900,00</td>
                        </tr>
                    </table>
                    <button class="checkout-btn">Fechar Pedido</button>
                </div>

            </div>
        </div>
        <nav class="navigation">
            <ul class="nav-links">
                <li><i class="fas fa-microchip"></i> Hardware</li>
                <li><i class="fas fa-keyboard"></i> Periféricos</li>
                <li><i class="fas fa-mobile-alt"></i> Smartphones</li>
                <li><i class="fas fa-briefcase"></i> Escritório</li>
                <li><i class="fas fa-blender"></i> Casa & Cozinha</li>
                <li><i class="fas fa-shoe-prints"></i> Calçados</li>
                <li><i class="fas fa-toolbox"></i> Ferramentas</li>
                <li><i class="fas fa-puzzle-piece"></i> Brinquedos</li>
            </ul>
        </nav>
    </header>