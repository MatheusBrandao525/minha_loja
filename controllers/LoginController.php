<?php

require 'utils/Validacoes.php';

class LoginController {

    public function redirecionaParaTelaDeLogin()
    {
        include ROOT_PATH . '/views/login.php';
    }

    public function autenticarUsuario() 
    {
        $emailUsuario = $_POST['txtemail'];
        $senhaUsuario = $_POST['txtsenha'];
    
        $validarCredenciais = new Validacoes();
    
        // Faz a validação das credenciais
        $autenticacao = $validarCredenciais->validarCredenciaisLogin($emailUsuario, $senhaUsuario);
    
        // Se as credenciais forem válidas, iniciamos a sessão
        if ($autenticacao['status'] === 'sucesso') {
            $_SESSION['email'] = $emailUsuario;  // Armazena o e-mail do usuário na sessão (ou outro identificador que preferir)
        }
    
        // Retorna a resposta em formato JSON para o AJAX
        header('Content-Type: application/json');
        echo json_encode($autenticacao);
        exit; 
    }
    
    
    function deslogarUsuario()
    {
        $sessaoUsuarioLogado = $_POST['idsessaousuario'];

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (isset($_SESSION['ID']) && $_SESSION['ID'] == $sessaoUsuarioLogado) {
            $_SESSION = array();

            session_destroy();

            header('Location:home');
            exit();
        }
    }
    
}