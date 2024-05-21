<?php

class RedesSociaisModel
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance()->getConexao();
    }

    public function buscarLinkWhatsapp()
    {
        $query = "SELECT * FROM redes_sociais WHERE nome = 'Whatsapp'";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarLinkFacebook()
    {
        $query = "SELECT * FROM redes_sociais WHERE nome = 'Facebook'";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarLinkInstagram()
    {
        $query = "SELECT * FROM redes_sociais WHERE nome = 'Instagram'";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarLinkTikTok()
    {
        $query = "SELECT * FROM redes_sociais WHERE nome = 'TikTok'";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}