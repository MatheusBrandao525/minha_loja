<?php
session_start();
class PesquisaController
{

    public function redirecionaParaTelaDePesquisa()
    {
        // Captura o termo de pesquisa via POST
        $pesquisa = filter_input(INPUT_POST, 'pesquisa', FILTER_SANITIZE_STRING);


        if (!empty($pesquisa)) {
            // Armazena o termo de pesquisa na sessão
            $_SESSION['pesquisa'] = $pesquisa;
        } else {
            // Limpa a sessão se o campo de pesquisa estiver vazio
            unset($_SESSION['pesquisa']);
        }
        // Inclui a página de exibição dos resultados
        header("Location: resultados");
    }

    public function redirecionarParaTelaResultados()
    {
        include ROOT_PATH . '/views/pesquisa.php';
    }
}
