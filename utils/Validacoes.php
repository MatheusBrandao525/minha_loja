<?php

require 'core/Conexao.php';

class Validacoes
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function validarCredenciaisLogin($email, $senha)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                'status' => 'erro',
                'mensagem' => 'E-mail inválido.'
            ];
        }

        if (strlen($senha) < 8) {
            return [
                'status' => 'erro',
                'mensagem' => 'Sua senha deve conter pelo menos 8 caracteres.'
            ];
        }

        if (strlen($senha) > 16) {
            return [
                'status' => 'erro',
                'mensagem' => 'Sua senha deve conter no máximo 16 caracteres.'
            ];
        }

        return $this->verificarCredenciaisNoBanco($email, $senha);
    }

    private function verificarCredenciaisNoBanco($email, $senha)
    {
        $stmt = $this->conexao->prepare("SELECT * FROM clientes WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($senha == $user['senha']) {
                $_SESSION['ID'] = $user['cliente_id'];
                return [
                    'status' => 'sucesso',
                    'mensagem' => 'Credenciais validadas com sucesso.'
                ];
            } else {
                return [
                    'status' => 'erro',
                    'mensagem' => 'Senha incorreta.'
                ];
            }
        } else {
            return [
                'status' => 'erro',
                'mensagem' => 'Usuário não encontrado.'
            ];
        }
    }

    public function validarDadosFormCadastro($dados)
    {
        $erros = [];
    
        // Validação de cada campo
        if (empty($dados['tipoPessoa'])) {
            $erros['tipoPessoa'] = 'Tipo de pessoa é obrigatório.';
        }
        if (empty($dados['cpf']) || !preg_match('/^\d{11}$/', $dados['cpf'])) {
            $erros['cpf'] = 'CPF inválido.';
        }
        if (empty($dados['nome'])) {
            $erros['nome'] = 'Nome é obrigatório.';
        }
        if (empty($dados['sobrenome'])) {
            $erros['sobrenome'] = 'Sobrenome é obrigatório.';
        }
        if (empty($dados['telefone']) || !preg_match('/^\(\d{2}\) \d{5}-\d{4}$/', $dados['telefone'])) {
            $erros['telefone'] = 'Telefone inválido.';
        }
        if (empty($dados['cep']) || !preg_match('/^\d{5}-\d{3}$/', $dados['cep'])) {
            $erros['cep'] = 'CEP inválido.';
        }
        if (empty($dados['endereco'])) {
            $erros['endereco'] = 'Endereço é obrigatório.';
        }
        // Verifica se número está vazio e sem número está desmarcado
        if (empty($dados['numero']) && empty($dados['semNumero'])) {
            $erros['numero'] = 'Número é obrigatório.';
        } else if (!empty($dados['numero']) && !empty($dados['semNumero'])) {
            $erros['numero'] = 'Marque apenas uma opção: Número ou Sem número.';
        } else if (empty($dados['numero']) && !empty($dados['semNumero'])) {
            $dados['numero'] = null; // Define número como null se "Sem número" está marcado
        }
        if (empty($dados['bairro'])) {
            $erros['bairro'] = 'Bairro é obrigatório.';
        }
        if (empty($dados['cidade'])) {
            $erros['cidade'] = 'Cidade é obrigatória.';
        }
        if (empty($dados['estado'])) {
            $erros['estado'] = 'Estado é obrigatório.';
        }
        if (empty($dados['pais'])) {
            $erros['pais'] = 'País é obrigatório.';
        }
        if (empty($dados['email']) || !filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $erros['email'] = 'E-mail inválido.';
        }
        if (empty($dados['senha']) || strlen($dados['senha']) < 8) {
            $erros['senha'] = 'A senha deve ter pelo menos 8 caracteres.';
        }
        if ($dados['senha'] !== $dados['confirmarSenha']) {
            $erros['confirmarSenha'] = 'As senhas não coincidem.';
        }
    
        // Verificar se o email ou CPF já existem
        $usuarioModel = new UsuarioModel();
        if ($usuarioModel->verificarEmailOuCpfExistente($dados['email'], $dados['cpf'])) {
            $erros['emailCpf'] = 'Email ou CPF já cadastrado.';
        }
    
        return $erros;
    }
}
