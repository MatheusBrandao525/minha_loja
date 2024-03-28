<?php
include 'components/header.php';
?>
<style>
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 0;
        border: 1px solid #888;
        width: 80%;
        max-width: 450px;
        /* Maximum width */
        border-radius: 5px;
        /* Rounded corners */
    }

    .modal-header {
        background-color: red;
        color: white;
        padding: 10px 15px;
        border-top-left-radius: 5px;
        /* Rounded corners */
        border-top-right-radius: 5px;
        /* Rounded corners */
    }

    .modal-header .close-button {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .modal-body {
        padding: 20px;
        text-align: center;
        /* Center the text */
    }

    .modal-body h2 {
        margin-top: 0;
    }

    .modal-footer {
        padding: 10px 20px;
        text-align: center;
        /* Center the button */
    }

    .ok-button {
        padding: 10px 20px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 5px;
        /* Rounded corners */
        cursor: pointer;
        font-size: 16px;
    }

    .ok-button:hover {
        background-color: darkred;
    }
</style>
<div class="container-login">
    <div class="sessao-formulario-login">
        <h3>Login do cliente</h3>
        <div class="colunas">
            <div class="coluna-fomulario">
                <div class="titulo-coluna-formulario">
                    <strong>Clientes registrados</strong>
                </div>
                <div class="aviso-form-login">
                    <span>Se você tiver uma conta, acesse com seu endereço de e-mail e senha.</span>
                </div>
                <form action="" class="formulario-login" id="formulario-login">
                    <div class="form-group">
                        <label for="email">E-mail<strong>*</strong></label>
                        <input type="email">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha<strong>*</strong></label>
                        <input type="password">
                    </div>
                    <div class="form-group enviar-formulario-login">
                        <button type="submit">Entrar</button>
                        <a href="">Esqueceu a sua senha?</a>
                    </div>
                    <div class="form-group avisoCamposObrigatorios">
                        <span>* Campos Obrigatórios</span>
                    </div>
                </form>

                <!-- Modal -->
                <div id="modal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close-button">&times;</span>
                        </div>
                        <div class="modal-body">
                            <h2>Ops!</h2>
                            <p>O usuário não possui cadastro.</p>
                        </div>
                        <div class="modal-footer">
                            <button class="ok-button">OK</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="coluna-fomulario">
                <div class="titulo-coluna-formulario">
                    <strong>Clientes registrados</strong>
                </div>
                <div class="aviso-form-login">
                    <span>Criar uma nova conta tem muitos benefícios: fechar pedidos rapidamente, registrar mais endereços, acompanhar pedidos e muito mais.</span>
                </div>
                <div class="exibe-botao-cadastrar">
                    <a href="">Cadastre-se</a>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("modal");
    var closeButton = document.querySelector(".close-button");
    var okButton = document.querySelector(".ok-button");

    function toggleModal() {
        modal.style.display = "block";
    }

    function closeModal() {
        modal.style.display = "none";
    }

    function windowOnClick(event) {
        if (event.target === modal) {
            closeModal();
        }
    }

    closeButton.addEventListener("click", closeModal);
    okButton.addEventListener("click", closeModal);
    
    window.addEventListener("click", windowOnClick);

    document.getElementById("formulario-login").addEventListener("submit", function(event) {
        event.preventDefault(); // Impede o envio do formulário
        toggleModal(); // Exibe a modal
    });
});

</script>

<?php
include 'components/footer.php';
