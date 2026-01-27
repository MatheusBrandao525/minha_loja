<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Armazena os valores recebidos via POST em variáveis PHP
  $idUsuario = isset($_POST['idusuario']) ? (int) $_POST['idusuario'] : 0;
  $totalPedidoSemDesconto = isset($_POST['totalpedidosemdesconto']) ? (float) str_replace(',', '.', $_POST['totalpedidosemdesconto']) : 0.00;
  $idCarrinho = isset($_POST['idcarrinho']) ? (int) $_POST['idcarrinho'] : 0;
  $valorComDesconto = isset($_POST['valorcomdesconto']) ? (float) str_replace(',', '.', $_POST['valorcomdesconto']) : 0.00;
  $cupomValor = isset($_POST['cupomValor']) ? (float) str_replace(',', '.', $_POST['cupomValor']) : 0.00;
}
?>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!-- Incluindo o FontAwesome da pasta local -->
<link rel="stylesheet" href="/fontawesome/css/all.min.css">

<style>
  /* Estilos Gerais */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body,
  html {
    width: 100%;
    height: 100%;
    font-family: 'Montserrat', sans-serif;
    background-color: #ffffff; 
  }

  /* Container principal que limita a largura máxima da página */
  .container {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: none;
    /* Remove a sombra */
  }

  /* ===================== Barra de Progresso ===================== */
  .progress-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    padding: 0 20px;
  }

  .progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    flex: 1;
    text-align: center;
  }

  .progress-step::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 2px;
    background-color: #e0e0e0;
    z-index: 0;
    transform: translateX(-50%);
    z-index: -1;
  }

  .progress-step:first-child::before {
    content: none;
  }

  .progress-bullet {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #e0e0e0;
    border: 2px solid #e0e0e0;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 1;
  }

  .progress-bullet.active {
    background-color: #333;
    border-color: #333;
  }

  .progress-label {
    margin-top: 8px;
    font-size: 10px;
    color: #333;
  }

  /* ===================== Seção de Forma de Pagamento ===================== */
  .tabs {
    display: flex;
    justify-content: flex-start;
    margin-bottom: 20px;
    gap: 8px;
    padding-left: 15px;
  }

  .tab {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 6px 10px;
    width: 120px;
    height: 49px;
    border: 1px solid #ddd;
    border-radius: 10px;
    cursor: pointer;
    background-color: #f0f0f0;
    transition: all 0.3s ease;
    box-shadow: none;
    position: relative;
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);
    /* Adiciona uma leve sombra inferior */
  }

  .tab i {
    font-size: 18px;
  }

  #credit-card-tab i {
    margin-right: 6px;
  }

  #pix-tab img {
    width: 130px;
    height: auto;
    max-height: 50px;
  }

  .tab span {
    font-size: 11px;
    margin-left: 6px;
    font-weight: normal;
  }

  .tab.active {
    border: 1px solid #009846;
    background-color: #fff;
    box-shadow: none;
  }

  .tab:hover {
    background-color: #fff;
    border-color: #009846;
    box-shadow: none;
    transform: translateY(-2px);
  }

  .tab-content {
    display: none;
  }

  .tab-content.active {
    display: block;
  }

  /* ===================== Formularios de Pagamento ===================== */
  .form-group {
    margin-bottom: 15px;
    padding: 0 15px;
  }

  .form-group input,
  .form-group select,
  .form-group div {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
    display: flex;
    align-items: center;
    height: 44px;
  }

  .form-group input:focus,
  .form-group select:focus {
    border-color: #009846;
    outline: none;
    background-color: #eef7ee;
  }

  /* Estilização para a seção "Processado por" */
  .inline-block.mb10.mt20 {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    margin-top: 20px;
    padding: 0 15px;
  }

  .inline-block.mb10.mt20 span {
    font-size: 14px;
    color: #666;
    margin-right: 6px;
  }

  /* Ajuste do tamanho da imagem */
  .inline-block.mb10.mt20 img {
    width: 100px;
    /* Ajustado para um tamanho menor, mais proporcional */
    height: 40px;
    margin-left: 4px;
    /* Ajusta a margem para alinhar melhor com o texto */
    vertical-align: middle;
    /* Garante o alinhamento com o texto */
  }

  /* Contêiner de imagem adicional (formas de pagamento) */
  .-payment-list {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 30px;
    padding-bottom: 10px;
  }

  .-payment-list p {
    font-size: 14px;
    font-weight: normal;
    color: #666;
    margin-bottom: 15px;
    text-align: center;
    font-family: 'Montserrat', sans-serif;
    width: 100%;
  }

  .-payment-list img {
    width: 30px;
    height: 20px;
    object-fit: contain;
    transition: transform 0.3s ease;
  }

  .-payment-list img:hover {
    transform: scale(1.1);
  }

  /* ===================== Botões ===================== */
  .btn {
    display: block;
    width: 100%;
    padding: 15px;
    font-size: 18px;
    background-color: #009846;
    color: white;
    text-align: center;
    border: none;
    cursor: pointer;
    margin-top: 20px;
    border-radius: 5px;
    font-weight: bold;
    letter-spacing: 0.05em;
    position: relative;
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    background-color: #007b33;
  }

  .btn-back {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    padding: 15px;
    font-size: 16px;
    font-weight: bold;
    color: #333;
    background-color: #fff;
    border: 1px solid #333;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 10px;
  }

  .btn-back i {
    margin-right: 8px;
    font-size: 18px;
  }

  .btn-back:hover {
    background-color: #f0f0f0;
  }

  /* ===================== Detalhes do Produto ===================== */
  #product-details {
    display: flex;
    align-items: center;
    padding: 15px;
    border-radius: 8px;
    background-color: #fff;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Sombra suave */
  }

  #product-details img {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    margin-right: 15px;
  }

  #product-details h2 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
  }

  #product-details p {
    font-size: 14px;
    margin-bottom: 5px;
  }

  #product-price {
    font-size: 16px;
    font-weight: bold;
    color: #009846;
  }

  #product-discount {
    font-size: 12px;
    text-decoration: line-through;
    color: #888;
  }

  /* ===================== Resumo do Pedido ===================== */
  .resumo-pedido h3 {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
  }

  .resumo-pedido ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }

  .resumo-pedido li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    font-size: 14px;
    color: #333;
    border-bottom: 1px dashed #ddd;
  }

  .product-name {
    font-weight: normal;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 75%;
  }

  .product-price {
    font-weight: bold;
    font-size: 14px;
    color: #333;
    white-space: nowrap;
  }

  /* ===================== Valor Total ===================== */
  .total-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    border-top: 1px solid #ddd;
    margin-top: 20px;
    width: calc(100% - 30px);
    margin-left: 15px;
  }

  .total-container p {
    font-weight: normal;
  }

  .total-pedido {
    font-size: 18px;
    font-weight: bold;
    color: #009846;
  }

  /* ===================== Informações do PIX ===================== */
  .pix-info-container {
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #f9f9f9;
    margin-top: 20px;
    margin-bottom: 20px;
    width: calc(100% - 30px);
    margin-left: 15px;
  }

  .pix-info-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
  }

  .pix-info-header i {
    font-size: 20px;
    margin-right: 10px;
    color: #009846;
  }

  .pix-info-title {
    font-size: 15px;
    color: #009846;
    font-weight: bold;
  }

  .pix-info-content {
    font-size: 14px;
    color: #333;
    line-height: 1.5;
  }

  .pix-offer-highlight {
    font-size: 16px;
    font-weight: bold;
    color: #e53935;
    margin-top: 10px;
  }

  /* ===================== Produtos Adicionais (Bump) ===================== */
  .adicionais-info {
    text-align: center;
    padding-top: 5px;
    padding-bottom: 10px;
    margin-top: 65px;
    font-size: 14px;
    /* Define o tamanho do texto da mensagem para 14px */
    color: #666;
    animation: bounce 5s;
  }

  @keyframes bounce {

    0%,
    100% {
      transform: translateX(-5px);
    }

    50% {
      transform: translateX(5px);
    }
  }

  .order-bump {
    width: calc(100% - 30px);
    margin-left: 15px;
    margin-right: 15px;
    padding: 0;
    background-color: #fffbe9;
    max-width: 600px;
    margin: 1rem auto;
    border-radius: 10px;
    box-sizing: border-box;
    border-left: 2px dashed #d22;
    border-bottom: 2px dashed #d22;
    border-right: 2px dashed #d22;
    padding-bottom: 10px;
    border-width: 3px;
    position: relative;
    font-size: 14px;
    /* Define o tamanho do texto de todo conteúdo do order bump para 14px */
    color: #666;
  }

  .order-bump h1 {
    background: #d22;
    color: #fff;
    padding: 1rem;
    border-radius: 10px 10px 0 0;
    font-size: 1.1rem;
    text-align: left;
    margin: 0;
    line-height: 1.2;
    width: calc(100% + 6px);
    margin-left: -3px;
    box-sizing: border-box;
    position: relative;
    z-index: 1;
  }

  .offer-details {
    padding: 1rem;
    background: #fffbe9;
  }

  .offer-label {
    display: flex;
    align-items: center;
    margin-top: 1rem;
    background: #fff;
    padding: 0.5rem;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
  }

  /* Animação de aumento e movimentação da seta */
  .order-bump:hover .offer-label,
  .order-bump .offer-checkbox:checked+.offer-label {
    transform: scale(1.02);
    /* Efeito de leve aumento */
  }

  .product-arrow {
    color: red;
    font-size: 18px;
    margin-right: 10px;
    align-self: center;
    transition: transform 0.3s ease;
    /* Transição para suavizar a animação */
  }

  .offer-label:hover .product-arrow,
  .offer-checkbox:checked+.offer-label .product-arrow {
    transform: translateX(5px) scale(1.2);
    /* Mover a seta para a direita e aumentar */
  }

  .offer-label img {
    width: 5rem;
    height: auto;
    margin-right: 1rem;
    border-radius: 5px;
  }

  .checkbox-container {
    display: flex;
    align-items: center;
    margin-left: 10px;
  }

  .offer-checkbox {
    margin-left: 6px;
    margin-right: 6px;
  }

  .offer-label div {
    flex: 1;
  }

  /* Mantém o preço original e promocional em negrito e com as cores originais */
  .original-price {
    text-decoration: line-through;
    color: #d22;
    font-size: 14px;
    font-weight: bold;
  }

  .discount-price {
    color: #27ae60;
    font-size: 14px;
    font-weight: bold;
  }

  /* ===================== Popup de Carregamento ===================== */
  .popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }

  .popup-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: none;
  }

  .popup-content p {
    font-size: 18px;
    margin-bottom: 20px;
  }

  .loading-gif {
    width: 50px;
    height: 50px;
  }

  /* ===================== Divisor ===================== */
  .divisor {
    margin: 40px 0;
    border: none;
    border-top: 1px solid #ddd;
    width: 100%;
  }

  /* ===================== Títulos e Subtítulos ===================== */
  .title,
  .section-title {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
    padding-left: 15px;
  }

  .subtitle {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
    padding-left: 15px;
  }

  /* ===================== Título e Subtítulo da Oferta ===================== */
  .offer-title,
  .offer-subtitle {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
    padding-left: 15px;
  }

  .offer-subtitle {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
    padding-left: 15px;
  }
</style>

<body>
  <div class="container">
    <!-- Título e subtítulo da página -->
    <h2 class="title">Pagamento</h2>
    <p class="subtitle">Selecione a forma de pagamento desejada</p>

    <!-- Containers para selecionar o tipo de pagamento -->
    <div class="tabs">
      <div id="credit-card-tab" class="tab active" onclick="showTab('credit-card')">
        <i class="fas fa-credit-card"></i>
        <span>Cartão de Crédito</span>
      </div>
      <div id="pix-tab" class="tab" onclick="showTab('pix')">
        <img src="public/assets/img/checkout/pix.svg" alt="Pix">
      </div>
    </div>

    <!-- Conteúdo da aba de Cartão de Crédito -->
    <div id="credit-card" class="tab-content active">

      <div class="inline-block mb10 mt20">
        <span class="text mr5 f12 black-80">Processado por</span>
        <img src="public/assets/img/checkout/mercadopago.svg" alt="Mercado Pago" />
      </div>
      <form id="form-checkout-credit-card">
        <div class="form-group">
          <div id="form-checkout__cardNumber"></div>
        </div>
        <div class="form-group">
          <div id="form-checkout__expirationDate"></div>
        </div>
        <div class="form-group">
          <div id="form-checkout__securityCode"></div>
        </div>
        <div class="form-group">
          <input type="text" id="form-checkout__cardholderName" placeholder="Nome do Titular do Cartão" />
        </div>
        <div class="form-group" style="display: none;">
          <select id="form-checkout__issuer"></select>
        </div>
        <div class="form-group">
          <select id="form-checkout__installments"></select>
        </div>
        <div class="form-group" style="display: none;">
          <select id="form-checkout__identificationType"></select>
        </div>
        <div class="form-group" style="display: none;">
          <input type="text" id="form-checkout__identificationNumber" placeholder="Número do documento" />
        </div>
        <div class="form-group">
          <input type="email" id="form-checkout__cardholderEmail" />
        </div>

        <!-- Exibição do Total -->
        <div class="total-container" id="total-container">
          <div id="resumo-pedido" class="resumo-pedido">
            <h3>Resumo do Pedido</h3>
            <ul id="resumo-lista"></ul>
          </div>
          <p>Valor total: <span class="total-pedido">R$ <?= number_format($valorComDesconto, 2, ',', '.'); ?></span></p>
        </div>

        <button type="submit" id="form-checkout__submit" class="btn">PAGAR AGORA <i class="fas fa-check"></i></button>
        <progress value="0" class="progress-bar">Carregando...</progress>
      </form>
      <button class="btn-back" onclick="voltarParaCarrinho()">
        <i class="fas fa-angle-double-left"></i> CONTINUAR COMPRANDO
      </button>
      <div class="divisor"></div>
      <!-- Seção de Formas de Pagamento -->
      <div class="-payment-list">
        <p style="text-align: center; width: 100%;">Formas de pagamento</p>
        <img loading="lazy" alt="billet" width="39" height="26" src="public/assets/img/checkout/card-billet.svg">
        <img loading="lazy" alt="amex" width="39" height="26" src="public/assets/img/checkout/card-amex.svg">
        <img loading="lazy" alt="visa" width="39" height="26" src="public/assets/img/checkout/card-visa.svg">
        <img loading="lazy" alt="diners" width="39" height="26" src="public/assets/img/checkout/card-diners.svg">
        <img loading="lazy" alt="mastercard" width="39" height="26" src="public/assets/img/checkout/card-mastercard.svg">
        <img loading="lazy" alt="discover" width="39" height="26" src="public/assets/img/checkout/card-discover.svg">
        <img loading="lazy" alt="aura" width="39" height="26" src="public/assets/img/checkout/card-aura.svg">
        <img loading="lazy" alt="hipercard" width="39" height="26" src="public/assets/img/checkout/card-hipercard.svg">
        <img loading="lazy" alt="elo" width="39" height="26" src="public/assets/img/checkout/card-elo.svg">
        <img loading="lazy" alt="hiper" width="39" height="26" src="public/assets/img/checkout/card-hiper.svg">
        <img loading="lazy" alt="pix" width="39" height="26" src="public/assets/img/checkout/card-pix.svg">
      </div>
    </div>

    <!-- Conteúdo da aba de Pix -->
    <div id="pix" class="tab-content">
      <div class="pix-info-container">
        <div class="pix-info-header">
          <i class="fas fa-qrcode pix-icon"></i>
          <div class="pix-info-title">Copie os dados de pagamento</div>
        </div>
        <div class="pix-info-content">
          Após apertar no botão verde abaixo, você poderá escanear o QR CODE ou copiar o nosso código.
        </div>
      </div>

      <div class="pix-info-container">
        <div class="pix-info-header">
          <i class="fas fa-university pix-icon"></i>
          <div class="pix-info-title">Faça o Pagamento</div>
        </div>
        <div class="pix-info-content">
          Abra o aplicativo do seu banco, escolha a opção PIX copia e cola e cole o código.
        </div>
      </div>
      <div class="total-container" id="total-container-pix">
        <div id="resumo-pedido" class="resumo-pedido">
          <h3>Resumo do Pedido</h3>
          <ul id="resumo-lista-pix"></ul>
        </div>
        <p>Valor total: <span class="total-pedido">R$ <?= number_format($valorComDesconto, 2, ',', '.'); ?></span></p>
      </div>

      <form id="form-checkout-pix">
        <button type="submit" class="btn">PAGAR AGORA <i class="fas fa-check"></i></button>
      </form>

      <button class="btn-back" onclick="voltarParaCarrinho()">
        <i class="fas fa-angle-double-left"></i> CONTINUAR COMPRANDO
      </button>
      <div class="divisor"></div>
      <!-- Seção de Formas de Pagamento -->
      <div class="-payment-list">
        <p style="text-align: center; width: 100%;">Formas de pagamento</p>
        <img loading="lazy" alt="billet" width="39" height="26" src="public/assets/img/checkout/card-billet.svg">
        <img loading="lazy" alt="amex" width="39" height="26" src="public/assets/img/checkout/card-amex.svg">
        <img loading="lazy" alt="visa" width="39" height="26" src="public/assets/img/checkout/card-visa.svg">
        <img loading="lazy" alt="diners" width="39" height="26" src="public/assets/img/checkout/card-diners.svg">
        <img loading="lazy" alt="mastercard" width="39" height="26" src="public/assets/img/checkout/card-mastercard.svg">
        <img loading="lazy" alt="discover" width="39" height="26" src="public/assets/img/checkout/card-discover.svg">
        <img loading="lazy" alt="aura" width="39" height="26" src="public/assets/img/checkout/card-aura.svg">
        <img loading="lazy" alt="hipercard" width="39" height="26" src="public/assets/img/checkout/card-hipercard.svg">
        <img loading="lazy" alt="elo" width="39" height="26" src="public/assets/img/checkout/card-elo.svg">
        <img loading="lazy" alt="hiper" width="39" height="26" src="public/assets/img/checkout/card-hiper.svg">
        <img loading="lazy" alt="pix" width="39" height="26" src="public/assets/img/checkout/card-pix.svg">
      </div>
    </div>
  </div>
  <script src="https://sdk.mercadopago.com/js/v2"></script>
  <script>
    const idUsuario = <?= json_encode($idUsuario); ?>;

    const mp = new MercadoPago("<?= getenv("MP_PUBLIC_KEY"); ?>");
    const cardForm = mp.cardForm({
      amount: "100.5",
      iframe: true,
      form: {
        id: "form-checkout-credit-card",
        cardNumber: {
          id: "form-checkout__cardNumber",
          placeholder: "Número do cartão",
        },
        expirationDate: {
          id: "form-checkout__expirationDate",
          placeholder: "MM/YY",
        },
        securityCode: {
          id: "form-checkout__securityCode",
          placeholder: "Código de segurança",
        },
        cardholderName: {
          id: "form-checkout__cardholderName",
          placeholder: "Titular do cartão",
        },
        issuer: {
          id: "form-checkout__issuer",
          placeholder: "Banco emissor",
        },
        installments: {
          id: "form-checkout__installments",
          placeholder: "Parcelas",
        },
        identificationType: {
          id: "form-checkout__identificationType",
          placeholder: "Tipo de documento",
        },
        identificationNumber: {
          id: "form-checkout__identificationNumber",
          placeholder: "Número do documento",
        },
        cardholderEmail: {
          id: "form-checkout__cardholderEmail",
          placeholder: "E-mail",
        },
      },
      callbacks: {
        onFormMounted: error => {
          if (error) return console.warn("Form Mounted handling error: ", error);
          console.log("Form mounted");
        },
        onSubmit: event => {
          event.preventDefault();

          const {
            paymentMethodId: payment_method_id,
            issuerId: issuer_id,
            cardholderEmail: email,
            amount,
            token,
            installments,
            identificationNumber,
            identificationType,
          } = cardForm.getCardFormData();

          fetch("/process_payment", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              token,
              issuer_id,
              payment_method_id,
              transaction_amount: Number(amount),
              installments: Number(installments),
              description: "Descrição do produto",
              payer: {
                email,
                identification: {
                  type: identificationType,
                  number: identificationNumber,
                },
              },
              external_reference: idUsuario // <-- Aqui passamos o idUsuario
            }),
          });
        },
        onFetching: (resource) => {
          console.log("Fetching resource: ", resource);

          // Animate progress bar
          const progressBar = document.querySelector(".progress-bar");
          progressBar.removeAttribute("value");

          return () => {
            progressBar.setAttribute("value", "0");
          };
        }
      },
    });

    // Função para alternar entre as abas de pagamento (cartão de crédito e Pix)
    function showTab(tab) {
      document.querySelectorAll('.tab-content').forEach(function(content) {
        content.classList.remove('active');
      });

      document.querySelectorAll('.tabs .tab').forEach(function(tabElement) {
        tabElement.classList.remove('active');
      });

      document.getElementById(tab).classList.add('active');
      document.getElementById(tab + '-tab').classList.add('active');
    }

    function voltarParaCarrinho() {
      window.location.href = "carrinho";
    }
  </script>
</body>