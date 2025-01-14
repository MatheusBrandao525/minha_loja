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
        // Valida se o e-mail é válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                'status' => 'erro',
                'mensagem' => 'E-mail inválido.'
            ];
        }
    
        // Valida a senha
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
    
        // Verifica as credenciais no banco de dados
        return $this->verificarCredenciaisNoBanco($email, $senha);
    }
    
    public function verificarCredenciaisNoBanco($email, $senha)
    {
        // Consulta para buscar o usuário pelo e-mail
        $query = "SELECT cliente_id, senha FROM clientes WHERE email = :email";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        // Verifica se encontrou o usuário
        if ($stmt->rowCount() === 0) {
            return [
                'status' => 'erro',
                'mensagem' => 'E-mail ou senha inválidos.'
            ];
        }
    
        // Obtém a senha armazenada no banco
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $senhaHash = $usuario['senha'];
    
        // Verifica a senha fornecida com a senha hash armazenada
        if (!password_verify($senha, $senhaHash)) {
            return [
                'status' => 'erro',
                'mensagem' => 'E-mail ou senha inválidos.'
            ];
        }
    
    // Verifica se a sessão não está iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();  // Inicia a sessão apenas se necessário
    }
        $_SESSION['ID'] = $usuario['cliente_id'];  // Armazena o ID do usuário na sessão
    
        // Retorna sucesso
        return [
            'status' => 'sucesso',
            'mensagem' => 'Login realizado com sucesso.'
        ];
    }
    

    public function validarDadosFormCadastro($dados)
    {
        $erros = [];
    
        // Normalizar campos removendo pontuações
        $dados['cpf'] = preg_replace('/\D/', '', $dados['cpf']); // Remove tudo que não for número
        $dados['telefone'] = preg_replace('/\D/', '', $dados['telefone']);
        $dados['cep'] = preg_replace('/\D/', '', $dados['cep']);
    
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
        if (empty($dados['telefone']) || !preg_match('/^\d{11}$/', $dados['telefone'])) {
            $erros['telefone'] = 'Telefone inválido. Deve conter 11 dígitos (DDD + número).';
        }
        if (empty($dados['cep']) || !preg_match('/^\d{8}$/', $dados['cep'])) {
            $erros['cep'] = 'CEP inválido. Deve conter 8 dígitos.';
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
