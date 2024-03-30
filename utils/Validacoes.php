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
        $stmt = $this->conexao->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($senha == $user['senha']) {
                session_start();
                $_SESSION['ID'] = $user['id'];
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
}
