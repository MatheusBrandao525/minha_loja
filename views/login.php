<?php
include 'components/header.php';
?>
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
                <form class="formulario-login" id="formulario-login">
                    <div class="form-group">
                        <label for="email">E-mail<strong>*</strong></label>
                        <input type="email" name="txtemail">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha<strong>*</strong></label>
                        <input type="password" name="txtsenha">
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
                    <strong>Ainda não é registrado?</strong>
                </div>
                <div class="aviso-form-login">
                    <span>Criar uma nova conta tem muitos benefícios: fechar pedidos rapidamente, registrar mais endereços, acompanhar pedidos e muito mais.</span>
                </div>
                <div class="exibe-botao-cadastrar">
                    <a href="cadastro">Cadastre-se</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
$(document).ready(function() {
    var modal = $("#modal");
    var modalContent = $("#modal .modal-content p"); // Ajuste o seletor conforme sua estrutura HTML
    $(".close-button, .ok-button").click(function() {
        modal.hide();
    });

    $(window).click(function(event) {
        if (event.target.id === "modal") {
            modal.hide();
        }
    });

    $("#formulario-login").submit(function(event) {
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: "validarLogin",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.status === "sucesso") {
                    window.location.href = "home";
                } else {
                    modalContent.text(response.mensagem);
                    modal.show();
                }
            },
            error: function(xhr, status, error) {

                modalContent.text(error);
                modal.show();
            }
        });
    });
});
</script>


<?php
include 'components/footer.php';
