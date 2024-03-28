<?php
include 'components/header.php';
?>

<div class="conteiner-formulario-cadastro">
    <div class="coluna-formulario-cadastro">
        <div class="form-group-cadastro">
            <label>Tipo da Conta</label>
            <select id="tipoCadastro">
                <option value="fisica">Pessoa Física</option>
                <option value="juridica">Pessoa Jurídica</option>
            </select>
        </div>

        <!-- Formulário Pessoa Física -->
        <div id="formFisica" style="display:none;">
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
        </div>

        <!-- Formulário Pessoa Jurídica -->
        <div id="formJuridica" style="display:none;">
            <div class="titulo-form-cadastro">
                <h3>Informações da Empresa</h3>
            </div>
            <div class="form-group-cadastro">
                <label for="cnpj">CNPJ:</label>
                <input type="text" name="cnpj"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="nomeEmpresa">Nome da Empresa:</label>
                <input type="text" name="nomeEmpresa"><br>
            </div>
            <div class="form-group-cadastro">
                <div class="numero-ie-cadastro">
                    <div class="numero-ie">
                        <label for="inscricaoEstadual">Inscrição Estadual:</label>
                        <input type="text" name="inscricaoEstadual">
                    </div>
                    <div class="opcao-sem-numero-ie">
                        <input type="checkbox" name="insento">
                        <label for="insento">Isento</label><br>
                    </div>
                </div>
            </div>
            <div class="form-group-cadastro">
                <label for="nomeResponsavel">Nome Responsável:</label>
                <input type="text" name="nomeResponsavel"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="sobrenomeResponsavel">Sobrenome Responsável:</label>
                <input type="text" name="sobrenomeResponsavel"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="telefoneEmpresa">Número de telefone:</label>
                <input type="text" name="telefoneEmpresa"><br>
            </div>

            <div class="titulo-form-cadastro">
                <h3>Informações de Endereço</h3>
            </div>
            <div class="form-group-cadastro">
                <label for="cepEmpresa">CEP:</label>
                <input type="text" name="cepEmpresa"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="enderecoEmpresa">Endereço:</label>
                <input type="text" name="enderecoEmpresa"><br>
            </div>
            <div class="form-group-cadastro">
                <div class="numero-endereco-cadastro">
                    <div class="numero-endereco">
                        <label for="numeroEmpresa">Número:</label>
                        <input type="text" name="numeroEmpresa">
                    </div>
                    <div class="opcao-sem-numero-cadastro">
                        <input type="checkbox" name="semNumeroEmpresa">
                        <label for="semNumeroEmpresa">Sem número</label>
                    </div>
                </div>
            </div>
            <div class="form-group-cadastro">
                <label for="bairroEmpresa">Bairro:</label>
                <input type="text" name="bairroEmpresa"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="complementoEmpresa">Complemento:</label>
                <input type="text" name="complementoEmpresa"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="cidadeEmpresa">Cidade:</label>
                <input type="text" name="cidadeEmpresa"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="estadoEmpresa">Estado:</label>
                <input type="text" name="estadoEmpresa"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="paisEmpresa">País:</label>
                <input type="text" name="paisEmpresa"><br>
            </div>

            <div class="titulo-form-cadastro">
                <h3>Informações de Acesso</h3>
            </div>
            <div class="form-group-cadastro">
                <label for="emailEmpresa">E-mail:</label>
                <input type="email" name="emailEmpresa"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="senhaEmpresa">Senha:</label>
                <input type="password" name="senhaEmpresa"><br>
            </div>
            <div class="form-group-cadastro">
                <label for="confirmarSenhaEmpresa">Confirmar Senha:</label>
                <input type="password" name="confirmarSenhaEmpresa"><br>
            </div>
            <div class="container-botoes-cadastro">
                <div class="botoes-cadastro">
                    <button type="button" class="botao-voltar-cadastro">Voltar</button>
                    <button type="submit" class="botaoCadastrarPessoaJuridica">Cadastrar</button>
                </div>
            </div>
        </div>

    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Função para alternar a exibição dos formulários
        function toggleForm(value) {
            if (value === 'juridica') {
                document.getElementById('formFisica').style.display = 'none';
                document.getElementById('formJuridica').style.display = 'block';
            } else {
                // A exibição do formulário de pessoa física é o padrão
                document.getElementById('formFisica').style.display = 'block';
                document.getElementById('formJuridica').style.display = 'none';
            }
        }

        // Adiciona o evento de mudança ao campo select e exibe o formulário de pessoa física por padrão
        const tipoCadastroSelect = document.getElementById('tipoCadastro');
        tipoCadastroSelect.addEventListener('change', function() {
            toggleForm(this.value);
        });

        // Chama a função toggleForm no carregamento da página para configurar o estado inicial dos formulários
        // Isso assegura que o formulário de pessoa física esteja visível por padrão
        toggleForm(tipoCadastroSelect.value);
    });
</script>




<?php
include 'components/footer.php';
?>