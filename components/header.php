<?php
require_once 'core/Conexao.php';
require 'models/UsuarioModel.php';
require_once 'controllers/CategoriaController.php';
require_once 'controllers/CarrinhoController.php';

$carrinhoController = new CarrinhoController();
$categoriaController = new CategoriaController();
$categoriaData = $categoriaController->exibirCategorias();

if (isset($_SESSION['ID'])) {
    $usuarioModel = new UsuarioModel();
    $dadosUsuario = $usuarioModel->buscarDadosUsuarioLogado($_SESSION['ID']);
}
$urlAtual = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$quantidadeItens = $carrinhoController->exibeQuantidadeCarrinho();
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
    <?php if ($urlAtual === 'http://localhost/minha_loja/categoria' || $urlAtual === 'http://localhost/minha_loja/produtos' || $urlAtual === 'http://localhost/minha_loja/pesquisa') { ?>
        <!-- Este estilo serve para a tela de Categorias, SubCategorias e Pesquisa -->
        <link rel="stylesheet" href="public/assets/css/style_categoria.css">
    <?php } ?>
    <style>
        /* Estilo do contador */
        .cart-counter {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: red;
            color: white;
            font-size: 0.8rem;
            font-weight: bold;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }
    </style>
    <link rel="stylesheet" href="public/assets/css/style_footer.css">
    <title>Brandao Makers</title>
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
                                <small>69</small> 99357-6137
                            </span>
                        </a>
                    </li>

                    <li class="borda-direita">
                        <a href="" target="_blank" rel="nofollow">
                            <span>
                                <i class="fab fa-whatsapp"></i>
                                <small>69</small> 99357-6137
                            </span>
                        </a>
                    </li>

                    <li class="borda-direita">
                        <a href="" target="_blank" rel="nofollow">
                            <span>
                                <i class="fas fa-envelope"></i>
                                brandaomakers@gmail.com
                            </span>
                        </a>
                    </li>
                </ul>
                <ul class="topLinks topLinks-responsivo">
                    <li class="borda-direita">
                        <?php if (isset($_SESSION['ID'])) { ?>
                            <a class="topHeader_link mconta" href="conta">
                                <i class="fa fa-user" aria-hidden="true"></i> Minha Conta
                            </a>
                        <?php } else { ?>
                            <a class="topHeader_link mconta" href="login">
                                <i class="fa fa-user" aria-hidden="true"></i> Minha Conta
                            </a>
                        <?php } ?>
                    </li>
                    <li>
                        <a class="topHeader_link mpedidos" href="">
                            <i class="fa fa-box-open" aria-hidden="true"></i> Meus Pedidos
                        </a>
                    </li>
                </ul>

            </div>
        </section>
        <div id="headerStarter" class="header container-wrapper" style="max-width:100% !important; margin: 0 !important; justify-content:center;">
            <div style="display: flex; justify-content:space-around;width:90%; max-width:95% !important; align-items:center;">
                <a class="logo" href="home" title="" aria-label="store logo">
                    <img src="public/assets/img/site/logo_loja_brandao_makers.png" title="" alt="" width="170">
                </a>

                <div class="block block-search">
                    <div class="block block-content">
                        <form class="form minisearch" id="search_mini_form" action="pesquisa" method="post">
                            <div class="field search">
                                <div class="control has-icon">
                                    <input id="search" type="text" name="pesquisa" value="" placeholder="Digite o que está buscando..." class="input-text" maxlength="128" role="combobox" aria-haspopup="false" aria-autocomplete="both" autocomplete="off" aria-expanded="false">
                                    <button type="submit" class="search-btn"><i class="fas fa-search search-icon"></i></button>
                                    <div id="search_autocomplete" class="search-autocomplete"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <ul class="linksCustomer">
                    <a href="carrinho" style="color: #f3f3f3;">
                    <li style="margin-right: 3rem; position: relative;">
                            <i class="fa fa-shopping-cart" style="font-size: 2rem;"></i>
                            <span class="cart-counter"><?php echo $quantidadeItens;?></span>
                        </li>
                    </a>
                    <li class="header_account_link_list">
                        <i class="fas fa-sign-in-alt"></i>
                        <?php if (!isset($_SESSION['ID'])) {  ?>
                            <div>
                                <span>Faça <a class="header_account_link login" href="login" class="login"><strong>Login</strong></a> ou </span>
                                <a class="header_account_link cadastro strong" href="cadastro"><strong>Cadastre-se</strong></a>
                            </div>
                        <?php } else { ?>
                            <div>
                                <a class="header_account_link login" href="conta" class="login" style="margin-left: 0 !important;"><strong>Minha Conta</strong></a>
                                <form action="sair" method="post">
                                    <input type="hidden" name="idsessaousuario" value="<?php echo $_SESSION['ID']; ?>">
                                    <button type="submit" class="header_account_link sair strong"><strong>Sair</strong></button>
                                </form>
                            </div>
                        <?php } ?>
                    </li>
                </ul>


            </div>

            <!-- Segundo logo substituindo a seção do carrinho -->
            <!--             <a class="logo" href="home" title="" aria-label="second store logo">
                <img src="public/assets/img/site/top_motos.png" title="" alt="" width="170">
            </a> -->
        </div>

        <nav class="navigation">
            <div class="menu-toggle">
                <span>Categorias</span>
                <i class="fas fa-bars"></i>
            </div>
            <ul class="linksCustomer linksCustomer-responsivo">
                <li class="header_account_link_list">
                    <i class="fas fa-sign-in-alt"></i>
                    <?php if (!isset($_SESSION['ID'])) {  ?>
                        <div>
                            <span>Faça <a class="header_account_link login" href="login" class="login"><strong>Login</strong></a> ou </span>
                            <a class="header_account_link cadastro strong" href="cadastro"><strong>Cadastre-se</strong></a>
                        </div>
                    <?php } else { ?>
                        <div>
                            <a class="header_account_link login" href="conta" class="login" style="margin-left: 0 !important;"><strong>Minha Conta</strong></a>
                            <form action="sair" method="post">
                                <input type="hidden" name="idsessaousuario" value="<?php echo $_SESSION['ID']; ?>">
                                <button type="submit" class="header_account_link sair strong"><strong>Sair</strong></button>
                            </form>
                        </div>
                    <?php } ?>
                </li>
            </ul>
            <ul class="nav-links">
                <?php foreach ($categoriaData as $categoria): ?>
                    <li>
                        <form action="categoria" method="post">
                            <input type="hidden" value="<?php echo $categoria['categoria_id']; ?>" name="categoriaId">
                            <button type="submit"><?php echo htmlspecialchars($categoria['nome_categoria']); ?></button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>