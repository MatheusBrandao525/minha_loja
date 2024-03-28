<?php
include 'components/header.php';
?>

<div class="container">
    <div class="container-centro">
        <nav class="menu-lateral">
            <ul>
                <li><a href="#dadosPessoais">Dados Pessoais</a></li>
                <li><a href="#meusPedidos">Meus Pedidos</a></li>
                <li><a href="#meusFavoritos">Meus Favoritos</a></li>
                <div class="linha-bottom"></div>
                <li><a href="#endereco">Endereço</a></li>
                <li><a href="#metodoPagamento">Metodos de Pagamento</a></li>
                <li><a href="#minhasAvaliacoes">Minhas Avaliações</a></li>
                <li><a href="#pontosEReconpensas">Historico de Pontos e Recompensas</a></li>
            </ul>
        </nav>
        <div class="conteudo">
            <div class="dados-usuario" id="dadosPessoais">
                <h2>Dados Pessoais</h2>
                <div class="card-dados-perfil">
                    <p>Matheus Felipe Brandao Silva</p>
                    <p>brandao.matheus.dev@gmail.com</p>
                    <p>(69) 9 9357-6137</p>
                    <p>Documento: 03600717243</p>
                    <p><a href="">Alterar senha</a></p>
                </div>
                <h2>Dados Endereço</h2>
                <div class="card-dados-perfil">
                    <p>Rua Princesa Isabel</p>
                    <p>Nº 4762</p>
                    <p>Cidade Alta</p>
                    <p>Rondonia</p>
                    <p>76935-000</p>
                    <p>Complemento</p>
                </div>

                <!-- Adicione os dados do usuário aqui -->
            </div>

            <div class="dados-usuario" id="meusPedidos" style="display:none;">
                <h4 class="titulo-aba-pedidos">Pedidos</h4>
                <div class="exibicao-produtos-pedidos">
                    <div class="pedido-cabecalho">
                        <span>Imagem</span>
                        <span>Nome</span>
                        <span>Data</span>
                        <span>Opções</span>
                    </div>
                    <div class="pedido-item">
                        <img src="public/assets/img/placeholder.jpg" alt="Nome do Produto" class="pedido-imagem">
                        <span class="pedido-nome">Nome do Produto</span>
                        <span class="pedido-data">10/10/2023</span>
                        <button class="pedido-detalhes">Detalhes</button>
                    </div>

                    <!-- Repita a div pedido-item para cada pedido -->
                </div>
            </div>

            <div class="dados-usuario" id="meusFavoritos" style="display:none;">
                <h4 class="titulo-aba-favoritos">Favoritos</h4>
                <div class="exibicao-produtos-favoritos">
                    <div class="favoritos-cabecalho">
                        <span>Imagem</span>
                        <span>Nome</span>
                        <span>Data</span>
                        <span>Opções</span>
                    </div>
                    <div class="favorito-item">
                        <img src="public/assets/img/placeholder.jpg" alt="Nome do Produto" class="favorito-imagem">
                        <span class="favorito-nome">Nome do Produto</span>
                        <span class="favorito-data">10/10/2023</span>
                        <button class="favorito-detalhes">Detalhes</button>
                    </div>
                    <!-- Repita a div favorito-item para cada favorito -->
                </div>
            </div>

            <div class="dados-usuario" id="endereco" style="display:none;">
                <!-- Dados dos Favoritos aqui -->
                <h4>Endereço de entrega</h4>
            </div>
            <div class="dados-usuario" id="metodoPagamento" style="display:none;">
                <!-- Dados dos Favoritos aqui -->
                <h4>Metodos de pagamento</h4>
            </div>
            <div class="dados-usuario" id="minhasAvaliacoes" style="display:none;">
                <!-- Dados dos Favoritos aqui -->
                <h4>Minhas avaliações</h4>
            </div>
            <div class="dados-usuario" id="pontosEReconpensas" style="display:none;">
                <!-- Dados dos Favoritos aqui -->
                <h4>Meus pontos e recompensas</h4>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuLinks = document.querySelectorAll('.menu-lateral a');

        menuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Ocultar todos os elementos
                document.querySelectorAll('.conteudo .dados-usuario').forEach(el => {
                    el.style.display = 'none';
                });

                // Obter o id do elemento a ser mostrado
                const targetId = link.getAttribute('href').replace('#', '');
                const targetElement = document.getElementById(targetId);

                // Mostrar o elemento clicado
                if (targetElement) {
                    targetElement.style.display = 'block';
                }
            });
        });
    });
</script>

<?php
include 'components/footer.php';
?>