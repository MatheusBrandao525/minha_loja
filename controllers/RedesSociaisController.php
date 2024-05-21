<?php
require_once 'models/RedesSociaisModel.php';

class RedesSociaisController
{
    public function exibirLinkWhatsapp($produtoNomeOuCodigo = '') {
        $redesSociaisModel = new RedesSociaisModel();
        $whatsapp = $redesSociaisModel->buscarLinkWhatsapp();
        if (!empty($whatsapp['link'])) {
            $numeroWhatsappFormatado = preg_replace('/\D/', '', $whatsapp['link']); // Remove qualquer caractere que não seja número
            $mensagem = !empty($produtoNomeOuCodigo) ? "Olá, gostaria de saber mais sobre o produto código: $produtoNomeOuCodigo" : "Olá";
            $mensagemFormatada = urlencode($mensagem);
            return "https://wa.me/$numeroWhatsappFormatado?text=$mensagemFormatada";
        }
        return '';
    }
}