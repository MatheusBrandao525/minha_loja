<?php
include 'components/header.php';
?>

<div class="conteiner-formulario-cadastro">
    <div class="coluna-formulario-cadastro">
        <!-- Formulário Pessoa Física -->
        <form id="formFisica" action="processarCadastro" method="post">
            <input type="hidden" name="tipoPessoa" value="Prssoa Física">
            <div class="titulo-form-cadastro">
                <h3>Informações Pessoais</h3>
            </div>
            <div class="form-group-cadastro">
                <label for="cpf">CPF:</label>
                <input type="text" name="cpf"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="nome">Nome:</label>
                <input type="text" name="nome"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" name="sobrenome"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="telefone">Número de telefone:</label>
                <input type="text" name="telefone"><br>
            </div>

            <div class="titulo-form-cadastro">
                <h3>Informações de Endereço</h3>
            </div>
            <div class="form-group-cadastro">
                <label for="cep">CEP:</label>
                <input type="text" name="cep"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco"><br>
            </div>
            <div class="form-group-cadastro">
                <div class="numero-endereco-cadastro">
                    <div class="numero-endereco">
                        <label for="numero">Número:</label>
                        <input type="text" name="numero">
                    </div>
                    <div class="opcao-sem-numero-cadastro">
                        <input type="checkbox" name="semNumero">
                        <label for="sem">Sem número</label>
                    </div>
                </div>
            </div>
            <div class="form-group-cadastro">
                <label for="bairro">Bairro:</label>
                <input type="text" name="bairro"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="complemento">Complemento:</label>
                <input type="text" name="complemento"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="cidade">Cidade:</label>
                <input type="text" name="cidade"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="estado">Estado:</label>
                <input type="text" name="estado"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="pais">País:</label>
                <input type="text" name="pais"><br>
            </div>

            <div class="titulo-form-cadastro">
                <h3>Informações de Acesso</h3>
            </div>
            <div class="form-group-cadastro">
                <label for="email">E-mail:</label>
                <input type="email" name="email"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="senha">Senha:</label>
                <input type="password" name="senha"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="confirmar">Confirmar Senha:</label>
                <input type="password" name="confirmarSenha"><br>
            </div>
            <div class="container-botoes-cadastro">
                <div class="botoes-cadastro">
                    <button type="button" class="botao-voltar-cadastro">Voltar</button>
                    <button type="submit" class="botaoCadastrarPessoaFisica">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
    $(document).ready(function() {
        $('#formFisica').on('submit', function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: 'processarCadastro',
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert(response);
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    alert('Erro ao processar o cadastro.');
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script> -->

<script>
    $(document).ready(function() {
        $('#formFisica').on('submit', function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: 'processarCadastro',
                type: 'POST',
                data: formData,
                success: function(response) {
                    try {
                        // Parseia a resposta JSON
                        var jsonResponse = JSON.parse(response);

                        // Verifica se a resposta contém sucesso
                        if (jsonResponse.sucesso) {
                            alert('Cadastro realizado com sucesso! Você já pode fazer login.');
                            window.location.href = 'login'; // Redireciona para a tela de login
                        } else {
                            // Formata as mensagens de erro para exibição amigável
                            var mensagensDeErro = '';
                            if (jsonResponse.erros) {
                                for (var campo in jsonResponse.erros) {
                                    if (jsonResponse.erros.hasOwnProperty(campo)) {
                                        mensagensDeErro += jsonResponse.erros[campo] + '\n';
                                    }
                                }
                            } else if (jsonResponse.erro) {
                                mensagensDeErro = jsonResponse.erro;
                            }
                            alert('Erro ao processar o cadastro:\n' + mensagensDeErro);
                        }
                    } catch (e) {
                        alert('Erro inesperado ao processar a resposta do servidor.');
                        console.error('Erro de parsing JSON:', e);
                        console.error('Resposta do servidor:', response);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Erro ao processar o cadastro.');
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>




<?php
include 'components/footer.php';
?>