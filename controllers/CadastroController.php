<?php
class CadastroController
{
    public function redirecionaParaTelaDeCadastro()
    {
        include ROOT_PATH . '/views/cadastro.php';
    }

    public function cadastrarCliente()
    {
        require_once 'models/UsuarioModel.php';
        require_once 'utils/Validacoes.php';
    
        $usuarioModel = new UsuarioModel();
        $validar = new Validacoes();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;
    
            $erros = $validar->validarDadosFormCadastro($dados);
    
            if (empty($erros)) {
                $resultado = $usuarioModel->salvarUsuario($dados);
                if ($resultado === true) {
                    echo json_encode(['sucesso' => 'Cadastro realizado com sucesso!']);
                } else {
                    echo json_encode(['erro' => $resultado['mensagem']]);
                }
            } else {
                echo json_encode(['erros' => $erros]);
            }
        } else {
            $this->redirecionaParaTelaDeCadastro();
        }
    }
    
}
