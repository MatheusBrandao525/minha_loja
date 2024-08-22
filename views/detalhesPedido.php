<?php
require 'components/header.php';
require_once 'controllers/PedidoController.php';
$pedidoController = new PedidoController();

if (isset($_POST['clienteid']) && isset($_POST['pedidoid']) && isset($_POST['ticketpedido'])) {
    $usuarioId = filter_input(INPUT_POST, 'clienteid', FILTER_VALIDATE_INT);
    $pedidoId = filter_input(INPUT_POST, 'pedidoid', FILTER_VALIDATE_INT);
    $ticketPedido = filter_input(INPUT_POST, 'ticketpedido', FILTER_VALIDATE_INT);

    $dadosPedido = $pedidoController->exibirDetalhesPedido($pedidoId, $usuarioId, $ticketPedido);

    $produtos = $pedidoController->exibirProdutosDoPedido($pedidoId, $ticketPedido);
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
                <div class="status pendente <?= $dadosPedido['status_pedido'] == 'PENDENTE' ? 'active' : '' ?>">Pendente</div>
                <div class="status enviado <?= $dadosPedido['status_pedido'] == 'DESPACHADO' ? 'active' : '' ?>">Enviado</div>
                <div class="status acaminho <?= $dadosPedido['status_pedido'] == 'A CAMINHO' ? 'active' : '' ?>">A Caminho</div>
                <div class="status entregue <?= $dadosPedido['status_pedido'] == 'ENTREGUE' ? 'active' : '' ?>">Entregue</div>
            </div>
            <div class="info">
                <div class="endereco">
                    <h2 class="h2-detalhes-pedido">Endereço de Entrega</h2>
                    <p><?= $dadosPedido['logradouro'] ?>, <?= $dadosPedido['num_casa'] ?></p>
                    <p><?= $dadosPedido['nome_bairro'] ?>, <?= $dadosPedido['cidade'] ?>, <?= $dadosPedido['estado'] ?></p>
                    <p>CEP <?= $dadosPedido['num_cep'] ?></p>
                    <p><?= $dadosPedido['pais'] ?></p>
                </div>
                <div class="historico">
                    <h2 class="h2-detalhes-pedido">Histórico de Status</h2>
                    <p class="codigo-rastreio">Código de rastreamento: <?= $dadosPedido['codigo_rastreio'] ?></p>
                    <!-- Aqui você pode adicionar mais histórico de status -->
                </div>
            </div>
            <div class="produtos-pedido">
                <?php foreach ($produtos as $produto) { ?>
                    <div class="card-produto-pedido">
                        <img src="public/assets/img/placeholder.jpg" alt="">
                        <span class="nome-produto-pedido"><?php echo $produto['nome_produto']; ?></span>
                        <span>Quantidade: <?php echo $produto['quantidade']; ?></span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

<?php
} else {
?>
    <div style="text-align: center; height:50vh; padding-top:4rem;">
        <h3>Algo deu errado! Tente novamente mais tarde.</h3>
    </div>
<?php
}
require 'components/footer.php';

?>