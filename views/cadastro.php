<?php
include 'components/header.php';
?>
<style>
    .botaoCadastrarPessoaFisica {
        background-color: #36802d;
    }

    .botaoCadastrarPessoaFisica:hover {
        background-color: #77ab59;
    }
</style>
<div class="conteiner-formulario-cadastro">
    <div class="coluna-formulario-cadastro">

        <form action="cadastrar" id="formFisica" method="post">
            <div class="titulo-form-cadastro">
                <h3>Informações Pessoais</h3>
            </div>
            <div class="form-group-cadastro">
                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" required><br>
            </div>
            <div class="form-group-cadastro">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required><br>
            </div>
            <div class="form-group-cadastro">
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" name="sobrenome" required><br>
            </div>
            <div class="form-group-cadastro">
                <label for="telefone">Número de telefone:</label>
                <input type="text" name="telefone" required><br>
            </div>

            <div class="titulo-form-cadastro">
                <h3>Informações de Endereço</h3>
            </div>
            <div class="form-group-cadastro">
                <label for="cep">CEP:</label>
                <input type="text" name="cep" required><br>
            </div>
            <div class="form-group-cadastro">
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" required><br>
            </div>
            <div class="form-group-cadastro">
                <div class="numero-endereco-cadastro">
                    <div class="numero-endereco">
                        <label for="numero">Número:</label>
                        <input type="text" name="numero" id="numeroEndereco" required>
                    </div>
                    <div class="opcao-sem-numero-cadastro">
                        <input type="checkbox" name="semNumero" id="semNumeroCheckbox">
                        <label for="sem">Sem número</label>
                    </div>
                </div>
            </div>
            <div class="form-group-cadastro">
                <label for="bairro">Bairro:</label>
                <input type="text" name="bairro" required><br>
            </div>
            <div class="form-group-cadastro">
                <label for="complemento">Complemento:</label>
                <input type="text" name="complemento"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="cidade">Cidade:</label>
                <input type="text" name="cidade" required><br>
            </div>
            <div class="form-group-cadastro">
                <label for="estado">Estado:</label>
                <input type="text" name="estado" required><br>
            </div>
            <div class="form-group-cadastro">
                <label for="pais">País:</label>
                <input type="text" name="pais" required><br>
            </div>

            <div class="titulo-form-cadastro">
                <h3>Informações de Acesso</h3>
            </div>
            <div class="form-group-cadastro">
                <label for="email">E-mail:</label>
                <input type="email" name="email" required><br>
            </div>
            <div class="form-group-cadastro">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" required><br>
            </div>
            <div class="form-group-cadastro">
                <label for="confirmar">Confirmar Senha:</label>
                <input type="password" name="confirmarSenha" required><br>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const semNumeroCheckbox = document.getElementById('semNumeroCheckbox');
        const numeroEndereco = document.getElementById('numeroEndereco');

        // Função para habilitar/desabilitar o campo "Número"
        function toggleNumeroEndereco() {
            if (semNumeroCheckbox.checked) {
                numeroEndereco.value = ''; // Limpa o valor do campo "Número"
                numeroEndereco.disabled = true; // Desabilita o campo "Número"
                numeroEndereco.removeAttribute('required'); // Remove o atributo "required"
            } else {
                numeroEndereco.disabled = false; // Habilita o campo "Número"
                numeroEndereco.setAttribute('required', 'required'); // Adiciona o atributo "required"
            }
        }

        // Chama a função quando o estado da checkbox mudar
        semNumeroCheckbox.addEventListener('change', toggleNumeroEndereco);

        // Chama a função na inicialização para garantir o estado correto
        toggleNumeroEndereco();
    });
</script>


<?php
include 'components/footer.php';
?>