<<<<<<< HEAD
<?php
require_once 'core/Conexao.php';

/* error_reporting(E_ALL ^ E_DEPRECATED);
require_once '../../vendor/autoload.php'; // Caminho para o autoload do Composer


$idUsuarioLogado = $_POST['idusuario'];

if($_POST['valorcomdesconto'] != 0 && $_POST['valorcomdesconto'] >= 0){
  $valorComDesconto = $_POST['valorcomdesconto'];
  $valorTotal = (float)$valorComDesconto;
}else {
  $valorTotal = (float)$_POST['totalpedidosemdesconto'];
}

if(!empty($_POST['cupomValor'])){
$codigoCupom = $_POST['cupomValor'];
}else {
    $codigoCupom = 'vazio';
} */
/* 
require '../database/consultas/consultar_cupom_por_codigo.php';
require '../database/consultas/consulta_carrinho.php';
require '../database/consultas/consulta_cliente_logado.php';

$nomeUsuario = $dadosUsuario['nome'];
$dotenv = Dotenv\Dotenv::createImmutable('../../'); // Caminho para o diretório do seu arquivo .env
$dotenv->load(); // Carrega as variáveis de ambiente

MercadoPago\SDK::setAccessToken($_ENV['MP_ACCESS_TOKEN']);

// Cria um objeto de preferência
$preference = new MercadoPago\Preference();


$payer = [];
$notify = [];
$item = new MercadoPago\Item();
$item->title = "PEDIDO $nomeUsuario";
$item->quantity = 1;
$item->unit_price = $valorTotal;
$item->description = $codigoCupom;
$preference->items = array($item);

$preference->payer = (object) [
  "name" => $nomeUsuario,
  "email" => $dadosUsuario['email'],
  "phone" => [
    "area_code" => "55",
    "number" => $dadosUsuario['telefone']
  ],
  "identification" => [
    "type" => "CPF",
    "number" => $dadosUsuario['cpf']
  ],
  "address" => [
    "street_name" => $dadosUsuario['rua'],
    "street_number" => $dadosUsuario['numero'],
    "zip_code" => $dadosUsuario['cep']
  ],


];

$preference->payment_methods = array(
  "installments" => 12
);

$preference->notification_url = "https://lizziimports.com.br/config/notificacoesMP/webhook.php";
$preference->statement_descriptor = "LIZZIIMPORTS";
$preference->external_reference = $idUsuarioLogado;
$preference->save(); */

/* echo $preference->id; */

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Confirmação de Pagamento</title>
  <script src="https://sdk.mercadopago.com/js/v2">
    </script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.row-container{
    background-color: #f1b5b8;
    border-radius: 20px;
    padding: 4rem;
}

.cho-container button{
    width:100%;
}

.bg-dark {
    background-color: #333333;
    color: white;
  }
  </style>
</head>
<body style="background-color: #f1b5b8;">
  <div class="container mt-5" style="background-color: #fff; padding:2rem;border-radius:20px;">
  <table class="table table-bordered">
      <tbody>
        <tr class="bg-dark">
          <td colspan="2">
            <h2>Dados do Usuário</h2>
          </td>
          <td colspan="2">
            <h2>Detalhes do Pedido</h2>
          </td>
        </tr>
        <tr>
          <td><strong>Nome:</strong></td>
          <td><?php echo $dadosUsuario['nome']; ?></td>
          <td><strong>Total Produtos:</strong></td>
          <td>R$ <?php echo number_format($subtotal,2,',','.');?></td>
        </tr>
        <tr>
          <td><strong>Email:</strong></td>
          <td><?php echo $dadosUsuario['email'];?></td>
          <td><strong>Frete:</strong></td>
          <td>R$ <?php echo number_format($frete,2,',','.');?></td>
        </tr>
        <?php if(isset($dadosCupom['porcentagem'])){ ?>
        <tr>
          <td><strong>CPF:</strong></td>
          <td><?php echo $dadosUsuario['cpf'];?></td>
          <td><strong>Desconto cupom:</strong></td>
          <td><?php echo $dadosCupom['porcentagem'];?></td>
        </tr>
                <tr>
          <td><strong>Endereço:</strong></td>
          <td><?php echo $dadosUsuario['rua'] . ', ' . $dadosUsuario['numero'];?></td>
          <td><strong>Total Pedido:</strong></td>
          <td>R$ <?php echo number_format($valorTotal,2,',','.');?></td>
        </tr>
        <?php } else { ?>
        <tr>
          <td><strong>CPF:</strong></td>
          <td><?php echo $dadosUsuario['cpf'];?></td>
          <td><strong>Total Pedido:</strong></td>
          <td>R$ <?php echo number_format($valorTotal,2,',','.');?></td>
        </tr>
        <tr>
          <td><strong>Endereço:</strong></td>
          <td><?php echo $dadosUsuario['rua'] . ', ' . $dadosUsuario['numero'];?></td>
          <td></td>
          <td></td>
        </tr>
        <?php } ?>
        <tr>
          <td><strong>CEP:</strong></td>
          <td><?php echo $dadosUsuario['cep'];?></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Telefone:</strong></td>
          <td><?php echo $dadosUsuario['telefone'];?></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
    <div class="cho-container"></div>
    <span style="font-size:10px !important; text-align:center; display:flex; justify-content:center;">Pague com segurança!</span>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://sdk.mercadopago.com/js/v2"></script>
  <script>
    const mp = new MercadoPago("<?= $_ENV['MP_PUBLIC']; ?>", {
      locale: 'pt-BR'
    });

    mp.checkout({
      preference: {
        id: '<?= $preference->id; ?>'
      },
      render: {
        container: '.cho-container',
        label: 'Pagar com Mercado Pago',
      }
    });
  </script>
</body>
=======
<?php
require 'core/Conexao.php';

error_reporting(E_ALL ^ E_DEPRECATED);
require_once 'vendor/autoload.php'; // Caminho para o autoload do Composer


$idUsuarioLogado = $_POST['idusuario'];

if ($_POST['valorcomdesconto'] != 0 && $_POST['valorcomdesconto'] >= 0) {
    $valorComDesconto = $_POST['valorcomdesconto'];
    $valorTotal = (float)$valorComDesconto;
} else {
    $valorTotal = (float)$_POST['totalpedidosemdesconto'];
}

if (!empty($_POST['cupomValor'])) {
    $codigoCupom = $_POST['cupomValor'];
} else {
    $codigoCupom = 'vazio';
}

require '../database/consultas/consultar_cupom_por_codigo.php';
require '../database/consultas/consulta_carrinho.php';
require '../database/consultas/consulta_cliente_logado.php';

$nomeUsuario = $dadosUsuario['nome'];
/* $dotenv = Dotenv\Dotenv::createImmutable('../../'); // Caminho para o diretório do seu arquivo .env
$dotenv->load(); // Carrega as variáveis de ambiente
 */
MercadoPago\SDK::setAccessToken($_ENV['MP_ACCESS_TOKEN']);

// Cria um objeto de preferência
$preference = new MercadoPago\Preference();


$payer = [];
$notify = [];
$item = new MercadoPago\Item();
$item->title = "PEDIDO $nomeUsuario";
$item->quantity = 1;
$item->unit_price = $valorTotal;
$item->description = $codigoCupom;
$preference->items = array($item);

$preference->payer = (object) [
    "name" => $nomeUsuario,
    "email" => $dadosUsuario['email'],
    "phone" => [
        "area_code" => "55",
        "number" => $dadosUsuario['telefone']
    ],
    "identification" => [
        "type" => "CPF",
        "number" => $dadosUsuario['cpf']
    ],
    "address" => [
        "street_name" => $dadosUsuario['rua'],
        "street_number" => $dadosUsuario['numero'],
        "zip_code" => $dadosUsuario['cep']
    ],


];

$preference->payment_methods = array(
    "installments" => 12
);

$preference->notification_url = "https://lizziimports.com.br/config/notificacoesMP/webhook.php";
$preference->statement_descriptor = "LIZZIIMPORTS";
$preference->external_reference = $idUsuarioLogado;
$preference->save();

/* echo $preference->id; */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Confirmação de Pagamento</title>
    <script src="https://sdk.mercadopago.com/js/v2">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .row-container {
            background-color: #f1b5b8;
            border-radius: 20px;
            padding: 4rem;
        }

        .cho-container button {
            width: 100%;
        }

        .bg-dark {
            background-color: #333333;
            color: white;
        }
    </style>
</head>

<body style="background-color: #f1b5b8;">
    <div class="container mt-5" style="background-color: #fff; padding:2rem;border-radius:20px;">
        <table class="table table-bordered">
            <tbody>
                <tr class="bg-dark">
                    <td colspan="2">
                        <h2>Dados do Usuário</h2>
                    </td>
                    <td colspan="2">
                        <h2>Detalhes do Pedido</h2>
                    </td>
                </tr>
                <tr>
                    <td><strong>Nome:</strong></td>
                    <td><?php echo $dadosUsuario['nome']; ?></td>
                    <td><strong>Total Produtos:</strong></td>
                    <td>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td><?php echo $dadosUsuario['email']; ?></td>
                    <td><strong>Frete:</strong></td>
                    <td>R$ <?php echo number_format($frete, 2, ',', '.'); ?></td>
                </tr>
                <?php if (isset($dadosCupom['porcentagem'])) { ?>
                    <tr>
                        <td><strong>CPF:</strong></td>
                        <td><?php echo $dadosUsuario['cpf']; ?></td>
                        <td><strong>Desconto cupom:</strong></td>
                        <td><?php echo $dadosCupom['porcentagem']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Endereço:</strong></td>
                        <td><?php echo $dadosUsuario['rua'] . ', ' . $dadosUsuario['numero']; ?></td>
                        <td><strong>Total Pedido:</strong></td>
                        <td>R$ <?php echo number_format($valorTotal, 2, ',', '.'); ?></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td><strong>CPF:</strong></td>
                        <td><?php echo $dadosUsuario['cpf']; ?></td>
                        <td><strong>Total Pedido:</strong></td>
                        <td>R$ <?php echo number_format($valorTotal, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Endereço:</strong></td>
                        <td><?php echo $dadosUsuario['rua'] . ', ' . $dadosUsuario['numero']; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td><strong>CEP:</strong></td>
                    <td><?php echo $dadosUsuario['cep']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>Telefone:</strong></td>
                    <td><?php echo $dadosUsuario['telefone']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="cho-container"></div>
        <span style="font-size:10px !important; text-align:center; display:flex; justify-content:center;">Pague com segurança!</span>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("<?= $_ENV['MP_PUBLIC']; ?>", {
            locale: 'pt-BR'
        });

        mp.checkout({
            preference: {
                id: '<?= $preference->id; ?>'
            },
            render: {
                container: '.cho-container',
                label: 'Pagar com Mercado Pago',
            }
        });
    </script>
</body>

>>>>>>> 3f58b7443b82f34f018001cd67114bef507ec8ad
</html>