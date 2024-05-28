<?php
include 'components/header.php';
require_once 'controllers/ProdutoController.php';
require_once 'controllers/AvaliacaoController.php';
$produtoController = new ProdutoController();
$avaliacaoController = new AvaliacaoController();
$produtoData = $produtoController->exibirDadosProdutoPorId();
$exibePreco = $produtoData['exibe_preco'];
$imagensAdicionais = $produtoController->verificaSeProdutoTemMaisDeUmaImagem($produtoData);
$produtosSemelhantes = $produtoController->exibirProdutosSemelhantes($produtoData['produto_id']);
?>
<div class="conteiner-titulo-detalhes">
    <!-- Título do Produto -->
    <div class="titulo-produto-detalhes">
        <h2><i class="fas fa-home"></i> Detalhes / <?php echo htmlspecialchars($produtoData['nome']);?></h2>
    </div>
</div>

<!-- Detalhes do Produto -->
<div class="container-info-produto">
    <div class="detalhes-produto">
        <div class="imagem-produto">
            <img src="<?php echo $produtoData['imagem1'];?>" alt="<?php echo htmlspecialchars($produtoData['nome']);?>">
        </div>
        <div class="info-produto">
            <h2 class="nome-produto-detalhes"><?php echo htmlspecialchars($produtoData['nome']);?></h2>
            <div class="flex-alinhado">
                <div class="coluna-pequena">
                    <h4>Cod: <?php echo htmlspecialchars($produtoData['codigo']);?></h4>
                </div>

                <div class="coluna-pequena">
                    <h4>Disponível para compra!</h4>
                </div>

                <div class="coluna-pequena">
                    <h4 style="color: yellow;">
                        <?php
                        // Aqui você pode utilizar um loop para exibir as estrelas, dependendo da classificação do produto
                        $quantidadeEstrelas = 5; // Substitua isso pela classificação real do produto
                        for ($i = 0; $i < $quantidadeEstrelas; $i++) {
                            echo '<i class="fas fa-star"></i>';
                        }
                        ?>
                    </h4>
                </div>

            </div>
            <div class="valor-produto-detalhes">
                <?php if($exibePreco === 1){ ?>
                <p class="info-valor-antigo"><strong class="info-novo-valor"> R$
                        <?php echo number_format($produtoData['preco_promocao']);?> À vista</strong></p>
                <?php }else { ?>
                <p class="info-descricao-valor">Para saber o valor deste produto entre em contato pelo whatspp</p>
                <?php } ?>
            </div>
            <p class="info-descricao-valor">No PIX ou até <span class="valor-com-destaque">12x</span> no <span
                    class="valor-com-destaque">Cartão</span> sem juros!</p>
            <div class="container-opcoes">
                <span><i class="fas fa-share"></i> Compartilhar</span>
                <span><i class="fas fa-heart"></i> Adicionar aos favoritos </span>
            </div>
            <div class="quantidade-add-carrinho">
                <a href="" id="btnEntrarEmContato"><i class="fab fa-whatsapp"></i> Entar em contato!</a>
            </div>

        </div>
    </div>
</div>


<div class="sessao-especificacoes">
    <div class="especificacoes-produto">
        <div class="especificacoes-bloco-img imagem-especificacao">
            <?php if (!empty($imagensAdicionais['imagem2'])): ?>
            <img src="<?php echo $imagensAdicionais['imagem2']; ?>" alt="Especificação do Produto">
            <?php endif; ?>
            <?php if (!empty($imagensAdicionais['imagem3'])): ?>
            <img src="<?php echo $imagensAdicionais['imagem3']; ?>" alt="Especificação do Produto">
            <?php endif; ?>
        </div>
        <div class="especificacoes-bloco-info texto-especificacao">
            <h3 class="especificacoes-title">Especificações do Produto:</h3>
            <p style="color: #333;"><?php echo htmlspecialchars($produtoData['descricao']);?></p>
        </div>
    </div>
</div>




<div class="sessaoAvaliacoes">
    <div class="container-avaliacoes">
        <div class="avaliacoes">
            <h3>Avaliações</h3>
            <p>Avaliação média: 4.5 estrelas</p>
            <?php 
                $avaliacoesData = $avaliacaoController->exibirAvaliacoesDoProduto();
            
                if (is_array($avaliacoesData)) {
                    foreach ($avaliacoesData as $avaliacao):
            ?>
            <div class="avaliacao">
                <p>Usuário: <?php echo htmlspecialchars($avaliacao['usuario']); ?></p>
                <p>Estrelas:
                    <?php echo str_repeat('★', $avaliacao['estrelas']) . str_repeat('☆', 5 - $avaliacao['estrelas']); ?>
                </p>
                <p>Comentário: <?php echo htmlspecialchars($avaliacao['comentario']); ?></p>
            </div>
            <?php 
                    endforeach;
                } else {
                    echo $avaliacoesData;
                }
            ?>
        </div>


        <form method="post" action="salvarAvaliacao" class="formulario-avaliacao" id="formAvaliacao">
            <h3>Avaliar o Produto</h3>
            <ul class="avaliacao-estrelas">
                <li class="icone-estrela-avaliacao" data-avaliacao="1"><i class="fas fa-star"></i></li>
                <li class="icone-estrela-avaliacao" data-avaliacao="2"><i class="fas fa-star"></i></li>
                <li class="icone-estrela-avaliacao" data-avaliacao="3"><i class="fas fa-star"></i></li>
                <li class="icone-estrela-avaliacao" data-avaliacao="4"><i class="fas fa-star"></i></li>
                <li class="icone-estrela-avaliacao" data-avaliacao="5"><i class="fas fa-star"></i></li>
            </ul>

            <input type="hidden" name="avaliacao" id="inputAvaliacao">
            <input type="hidden" name="usuarioId" value="<?php if(isset($_SESSION['ID'])){echo $_SESSION['ID'];}?>">
            <input type="hidden" name="produtoId" value="<?php echo $produtoData['produto_id'];?>">
            <textarea rows="7" id="comentario" name="comentario" placeholder="Deixe seu comentário"></textarea>
            <button type="submit" id="btnEnviarAvaliacao">Enviar</button>
        </form>

    </div>

</div>

<div class="container-produtos-semelhantes">


    <div class="produtos-semelhantes">
        <h3>Produtos Semelhantes</h3>
        <div class="carousel">

            <?php 
                if (!empty($produtosSemelhantes)) {
                    foreach ($produtosSemelhantes as $produto):
            ?>
            <div class="produto-relacionado">
                <form action="detalhes" method="post">
                    <input type="hidden" name="produtoId" value="<?php echo $produto['produto_id'];?>">
                    <button type="submit">
                    <img src="<?php echo $produto['imagem1'];?>" alt="<?php echo htmlspecialchars($produto['nome']);?>">
                    </button>
                </form>

                <div class="detalhes-produto-semelhante">
                    <p class="nome-produto-semelhante"><?php echo htmlspecialchars($produto['nome']); ?></p>
                    <div class="precos">
                        <?php if($exibePreco === 1){ ?>
                        <span class="preco-atual">R$ <?php echo number_format($produto['preco_promocao']);?> À
                            vista</span>
                        <?php }else { ?>
                        <span class="info-descricao-valor">Para saber o valor deste produto entre em contato pelo
                            whatspp</span>
                        <?php } ?>
                    </div>
                    <span class="descricao-produto-semelhante">No <strong>PIX</strong> ou <strong>12X</strong> sem
                        juros</span>
                    <a class="product-button"><i class="fab fa-whatsapp"></i>
                        Contato</a>
                </div>
            </div>
            <?php
                    endforeach;
                } else {
                    echo "<h5 style='color: #333 !important; font-size: 1.2rem;'>Nenhum produto semelhante encontrado.</h5>";
                }
            ?>
        </div>
    </div>
</div>

<?php
include 'components/footer.php';

?>
<style>


</style>

<!-- Adicione isso antes do fechamento da tag </body> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>

</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.icone-estrela-avaliacao');
    const inputAvaliacao = document.getElementById('inputAvaliacao');
    const formAvaliacao = document.getElementById('formAvaliacao');

    stars[0].classList.add('ativo');
    inputAvaliacao.value = stars[0].getAttribute('data-avaliacao');

    stars.forEach(function(star, index) {
        star.addEventListener('click', function() {

            stars.forEach(function(innerStar) {
                innerStar.classList.remove('ativo');
            });

            for (let i = 0; i <= index; i++) {
                stars[i].classList.add('ativo');
            }

            inputAvaliacao.value = index + 1;

            console.log("Avaliação: " + (index + 1));
        });
    });

    formAvaliacao.addEventListener('submit', function(event) {
        if (!inputAvaliacao.value) {
            alert('Por favor, selecione uma avaliação.');
            event.preventDefault();
        }
    });
});
</script>

<style>
.icone-estrela-avaliacao.ativo i {
    color: gold;
}
</style>


</body>

</html>