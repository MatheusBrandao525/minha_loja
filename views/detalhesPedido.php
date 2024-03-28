<?php

require 'components/header.php';

?>

<style>
    .container-detalhes-pedido {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .container-detalhes-pedido>.container {
        width: 80%;
        margin: 20px auto;
    }

    .status-bar {
        width: 100%;
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        font-family: "Saira Extra Condensed", sans-serif;
    }

    .status {
        flex: 1;
        padding: 10px;
        text-align: center;
        color: white;
        font-weight: bold;
    }

    .pendente {
        background-color: #FFD700;
    }

    /* Gold */
    .enviado {
        background-color: #B0C4DE;
    }

    /* LightSteelBlue */
    .acaminho {
        background-color: #FFA500;
    }

    /* Orange */
    .entregue {
        background-color: #32CD32;
    }

    /* LimeGreen */

    .info {
        width: 100%;
        display: flex;
        justify-content: space-between;
    }

    .endereco,
    .historico {
        flex: 1;
        padding: 20px;
        border: 1px solid #ddd;
        margin: 0 10px;
    }

    .codigo-rastreio {
        font-weight: bold;
    }

    .h2-detalhes-pedido {
        margin-top: 0;
        font-family: "Saira Extra Condensed", sans-serif;
        font-weight: bold;
    }

    .produtos-pedido {
        margin-top: 1rem;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card-produto-pedido {
        padding: 0 5px;
        margin: 5px 0;
        box-shadow: 0 0 0 1px #000;
        height: 120px;
        width: 100%;
        display: flex;
        justify-content: left;
        align-items: center;
    }

    .card-produto-pedido img {
        width: 100px;
        height: 100px;
        margin-right: 2rem;
    }

    .card-produto-pedido span {
        margin-right: 2rem;
        font-family: "Saira Extra Condensed", sans-serif;
    }

    .nome-produto-pedido {
        width: 300px;
    }
</style>
<div class="container-detalhes-pedido">
    <div class="container">
        <div class="status-bar">
            <div class="status pendente">Pendente</div>
            <div class="status enviado">Enviado</div>
            <div class="status acaminho">A Caminho</div>
            <div class="status entregue">Entregue</div>
        </div>
        <div class="info">
            <div class="endereco">
                <h2 class="h2-detalhes-pedido">Endereço de Entrega</h2>
                <p>Rua Exemplo, 123</p>
                <p>Bairro Exemplo, Cidade, UF</p>
                <p>CEP 12345-678</p>
            </div>
            <div class="historico">
                <h2 class="h2-detalhes-pedido">Histórico de Status</h2>
                <p class="codigo-rastreio">Código de rastreamento: 054sdf0fe80005</p>
                <p>01/01: Pedido Recebido</p>
                <p>02/01: Pedido em Processamento</p>
                <p>03/01: Pedido Enviado</p>
                <p>05/01: Pedido a Caminho</p>
                <p>07/01: Pedido Entregue</p>
            </div>
        </div>
        <div class="produtos-pedido">
            <div class="card-produto-pedido">
                <img src="public/assets/img/placeholder.jpg" alt="">
                <span class="nome-produto-pedido">Nome produto</span>
                <span>Quantidade</span>
            </div>
            <div class="card-produto-pedido">
                <img src="public/assets/img/placeholder.jpg" alt="">
                <span class="nome-produto-pedido">Nome produto</span>
                <span>Quantidade</span>
            </div>
            <div class="card-produto-pedido">
                <img src="public/assets/img/placeholder.jpg" alt="">
                <span class="nome-produto-pedido">Nome produto</span>
                <span>Quantidade</span>
            </div>
        </div>
    </div>
</div>
<?php

require 'components/footer.php';

?>