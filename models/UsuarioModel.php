<?php
class UsuarioModel
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function buscarDadosUsuarioLogado($idUsuarioLogado)
    {
        $sql = "SELECT * FROM clientes WHERE cliente_id = :usuarioID";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':usuarioID', $idUsuarioLogado);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verificarEmailOuCpfExistente($email, $cpf)
    {
        $sql = "SELECT * FROM clientes WHERE email = :email OR cpf = :cpf";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvarUsuario($dados)
    {
        if ($this->verificarEmailOuCpfExistente($dados['email'], $dados['cpf'])) {
            return [
                'status' => 'erro',
                'mensagem' => 'Email ou CPF já cadastrado.'
            ];
        }

        $sql = "INSERT INTO clientes (tipo_pessoa, cpf, nome, sobrenome, telefone, cep, endereco, numero, bairro, complemento, cidade, estado, pais, email, senha)
                VALUES (:tipoPessoa, :cpf, :nome, :sobrenome, :telefone, :cep, :endereco, :numero, :bairro, :complemento, :cidade, :estado, :pais, :email, :senha)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':tipoPessoa', $dados['tipoPessoa']);
        $stmt->bindParam(':cpf', $dados['cpf']);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':sobrenome', $dados['sobrenome']);
        $stmt->bindParam(':telefone', $dados['telefone']);
        $stmt->bindParam(':cep', $dados['cep']);
        $stmt->bindParam(':endereco', $dados['endereco']);
        $stmt->bindParam(':numero', $dados['numero']);
        $stmt->bindParam(':bairro', $dados['bairro']);
        $stmt->bindParam(':complemento', $dados['complemento']);
        $stmt->bindParam(':cidade', $dados['cidade']);
        $stmt->bindParam(':estado', $dados['estado']);
        $stmt->bindParam(':pais', $dados['pais']);
        $stmt->bindParam(':email', $dados['email']);

        $hashedPassword = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $stmt->bindParam(':senha', $hashedPassword);

        return $stmt->execute();
    }
}
