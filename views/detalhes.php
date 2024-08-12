<?php
include 'components/header.php';
if (isset($_SESSION['detalhesProduto'])) {
    $detalhesProduto = $_SESSION['detalhesProduto'];
} else {
    header("Location:produtos");
    exit;
}
?>
<style>
    .container {
        display: flex;
        flex-direction: row !important;
    }

    .conteiner-titulo-detalhes {
        padding-top: 1.3rem;
    }

    .radio-group {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        /* max-width: 600px; */
        user-select: none;

        &>* {
            margin: .5rem 0.5rem;
        }
    }

    .radio-group-legend {
        font-size: 1.5rem;
        font-weight: 700;
        color: #9c9c9c;
        text-align: center;
        line-height: 1.125;
        margin-bottom: 1.25rem;
    }

    .radio {
        width: 50px;
        height: 50px;
    }

    .radio-input {
        clip: rect(0 0 0 0);
        clip-path: inset(100%);
        height: 1px;
        overflow: hidden;
        position: absolute;
        white-space: nowrap;
        width: 1px;

        &:checked+.radio-tile {
            border-color: #f1b5b8;
            box-shadow: 0 5px 10px rgba(#000, 0.1);
            color: #f1b5b8;

            &:before {
                transform: scale(1);
                opacity: 1;
                background-color: #f1b5b8;
                border-color: #f1b5b8;
            }

            .radio-icon,
            .radio-label {
                color: #f1b5b8;
            }
        }

        &:focus+.radio-tile {
            border-color: #f1b5b8;
            box-shadow: 0 5px 10px rgba(#000, 0.1), 0 0 0 4px #f1b5b8;

            &:before {
                transform: scale(1);
                opacity: 1;
            }
        }
    }

    .radio-tile {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        /* width: 1rem; */
        padding: 10px;
        /* min-height: ; */
        border-radius: 50%;
        border: 2px solid #333333;
        background-color: #fff;
        box-shadow: 0 5px 10px rgba(#000, 0.1);
        transition: 0.15s ease;
        cursor: pointer;
        position: relative;

        &:before {
            content: "";
            position: absolute;
            display: block;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #f1b5b8;
            background-color: #fff;
            border-radius: 50%;
            top: 0.25rem;
            left: 0.25rem;
            opacity: 0;
            transform: scale(0);
            transition: 0.25s ease;
            /* background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E"); */
            background-size: 12px;
            background-repeat: no-repeat;
            background-position: 50% 50%;
        }

        &:hover {
            border-color: #f1b5b8;

            &:before {
                transform: scale(1);
                opacity: 1;
            }
        }
    }

    .radio-icon {
        transition: .375s ease;
        color: #f1b5b8;

        svg {
            width: 1.5rem;
            height: 1.5rem;
        }
    }

    .radio-label {
        color: #707070;
        transition: .375s ease;
        text-align: center;
    }
</style>
<div class="conteiner-titulo-detalhes">
    <!-- Título do Produto -->
    <div class="titulo-produto-detalhes">
        <h2><i class="fas fa-home"></i> Início / Smartphone Modelo XYZ</h2>
    </div>
</div>

<!-- Detalhes do Produto -->
<div class="container-info-produto">
    <div class="detalhes-produto">
        <div class="imagem-produto">
            <img src="public/assets/img/placeholder.jpg" alt="Produto XYZ">
        </div>
        <form method="post" action="adicionar-carrinho" class="info-produto">
            <input type="hidden" value="10" name="vlrfrete">
            <input type="hidden" value="<?php echo $detalhesProduto['nome']; ?>" name="nomeproduto">
            <input type="hidden" value="<?php echo $detalhesProduto['preco_unitario']; ?>" name="vlrunitario">
            <input type="hidden" value="<?php echo $detalhesProduto['preco_custo']; ?>" name="vlrcusto">
            <input type="hidden" value="1" name="usuarioid">
            <input type="hidden" value="<?php echo $detalhesProduto['produto_id']; ?>" name="produtoid">
            <h2 class="nome-produto-detalhes">Smartphone Modelo XYZ</h2>
            <div class="flex-alinhado">
                <div class="coluna-pequena">
                    <h4>Cod: 235345</h4>
                </div>

                <div class="coluna-pequena">
                    <h4>Disponível para compra!</h4>
                </div>

                <div class="coluna-pequena">
                    <h4>
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
            <div>
                <p class="info-valor-antigo">R$999,00 <strong class="info-novo-valor"> R$990,00 À vista</strong></p>
            </div>
            <p class="info-descricao-valor">No PIX ou até <span class="valor-com-destaque">12x</span> de <span class="valor-com-destaque">R$83,25</span> sem juros!</p>
            <div class="container-opcoes">
                <span><i class="fas fa-share"></i> Compartilhar</span>
                <span><i class="fas fa-heart"></i> Adicionar aos favoritos </span>
            </div>

            <div class="mt-3 radio-group" style="display: flex; flex-direction: row;">
                <div class="radio">
                    <label class="radio-wrapper">
                        <input type="radio" name="tamanhosmodelos" value="XL" class="radio-input" />
                        <span class="radio-tile">
                            <span class="radio-label">XL</span>
                        </span>
                    </label>
                </div>
                <div class="radio">
                    <label class="radio-wrapper">
                        <input type="radio" name="tamanhosmodelos" value="M" class="radio-input" />
                        <span class="radio-tile">
                            <span class="radio-label">M</span>
                        </span>
                    </label>
                </div>
                <div class="radio">
                    <label class="radio-wrapper">
                        <input type="radio" name="tamanhosmodelos" value="P" class="radio-input" />
                        <span class="radio-tile">
                            <span class="radio-label">P</span>
                        </span>
                    </label>
                </div>
                <div class="radio">
                    <label class="radio-wrapper">
                        <input type="radio" name="tamanhosmodelos" value="G" class="radio-input" />
                        <span class="radio-tile">
                            <span class="radio-label">G</span>
                        </span>
                    </label>
                </div>
                <div class="radio">
                    <label class="radio-wrapper">
                        <input type="radio" name="tamanhosmodelos" value="GG" class="radio-input" />
                        <span class="radio-tile">
                            <span class="radio-label">GG</span>
                        </span>
                    </label>
                </div>
            </div>


            <div class="quantidade-add-carrinho">
                <div class="field qty">
                    <div class="control-qty">
                        <div class="control">
                            <input type="number" name="qty" id="qty" min="1" value="1" title="Qtd" class="input-text qty" data-validate="{&quot;required-number&quot;:true,&quot;validate-item-quantity&quot;:{&quot;minAllowed&quot;:1,&quot;maxAllowed&quot;:10000}}">
                        </div>
                        <span class="plus" title="Increase the quantity"><i class="fa-solid fa-caret-up"></i></span>
                        <span class="minus" title="Reduce the quantity"><i class="fa-solid fa-caret-down"></i></span>

                    </div>
                </div>
                <button type="submit" id="btnAdicionarCarrinho" style="background-color: #359a29;"><i class="fa-solid fa-cart-shopping"></i> Adicionar ao Carrinho</button>
            </div>

        </form>
    </div>
</div>


<div class="sessao-especificacoes">
    <div class="especificacoes-produto">
        <div class="especificacoes-bloco-img imagem-especificacao">
            <img src="public/assets/img/placeholder.jpg" alt="Especificação do Produto">
        </div>
        <div class="especificacoes-bloco-info texto-especificacao">
            <h3 class="especificacoes-title">Especificações do Produto:</h3>
            <ul>
                <li>Processador: Octa-core 2.0 GHz</li>
                <li>Memória RAM: 4 GB</li>
                <li>Armazenamento: 64 GB</li>
                <li>Câmera: 12 MP + 8 MP</li>
            </ul>
        </div>
    </div>
</div>




<div class="sessaoAvaliacoes">
    <div class="container-avaliacoes">
        <div class="avaliacoes">
            <h3>Avaliações</h3>
            <p>Avaliação média: 4.5 estrelas</p>
            <div class="avaliacao">
                <p>Usuário: Cliente Exemplo</p>
                <p>Estrelas: ★★★★☆</p>
                <p>Comentário: Excelente produto, estou satisfeito!</p>
            </div>
        </div>

        <div class="formulario-avaliacao">
            <h3>Avaliar o Produto</h3>
            <ul class="avaliacao-estrelas">
                <li class=" icone-estrela-avaliacao" data-avaliacao="1"><i class="fas fa-star"></i></li>
                <li class=" icone-estrela-avaliacao" data-avaliacao="2"><i class="fas fa-star"></i></li>
                <li class=" icone-estrela-avaliacao" data-avaliacao="3"><i class="fas fa-star"></i></li>
                <li class=" icone-estrela-avaliacao" data-avaliacao="4"><i class="fas fa-star"></i></li>
                <li class=" icone-estrela-avaliacao" data-avaliacao="5"><i class="fas fa-star"></i></li>

            </ul>

            <textarea rows="7" id="comentario" placeholder="Deixe seu comentário"></textarea>
            <button id="btnEnviarAvaliacao">Enviar</button>
        </div>

    </div>

</div>


<!-- Produtos Semelhantes -->

<div class="container-produtos-semelhantes">


    <div class="produtos-semelhantes">
        <h3>Produtos Semelhantes</h3>
        <!-- Carousel de Produtos Semelhantes -->
        <div class="carousel">
            <!-- Adicione produtos relacionados conforme necessário -->
            <div class="produto-relacionado">
                <img src="public/assets/img/placeholder.jpg" alt="Produto Relacionado 1">

                <div class="detalhes-produto-semelhante">
                    <p class="nome-produto-semelhante">Nome do Produto Relacionado 1 Nome do Produto Relacionado 1</p>
                    <div class="precos">
                        <span class="preco-antigo">R$ 1.000,00</span>
                        <span class="preco-atual">R$ 909,90 À vista</span>
                    </div>
                    <span class="descricao-produto-semelhante">No <strong>PIX</strong> ou <strong>12X</strong> sem juros</span>
                    <button class="botao-comprar" style="display: none;">Comprar</button>
                </div>
            </div>

            <div class="produto-relacionado">
                <img src="public/assets/img/placeholder.jpg" alt="Produto Relacionado 1">

                <div class="detalhes-produto-semelhante">
                    <p class="nome-produto-semelhante">Nome do Produto Relacionado 1 Nome do Produto Relacionado 1</p>
                    <div class="precos">
                        <span class="preco-antigo">R$ 1.000,00</span>
                        <span class="preco-atual">R$ 909,90 À vista</span>
                    </div>
                    <span class="descricao-produto-semelhante">No <strong>PIX</strong> ou <strong>12X</strong> sem juros</span>
                    <button class="botao-comprar" style="display: none;">Comprar</button>
                </div>
            </div>
            <div class="produto-relacionado">
                <img src="public/assets/img/placeholder.jpg" alt="Produto Relacionado 1">

                <div class="detalhes-produto-semelhante">
                    <p class="nome-produto-semelhante">Nome do Produto Relacionado 1 Nome do Produto Relacionado 1</p>
                    <div class="precos">
                        <span class="preco-antigo">R$ 1.000,00</span>
                        <span class="preco-atual">R$ 909,90 À vista</span>
                    </div>
                    <span class="descricao-produto-semelhante">No <strong>PIX</strong> ou <strong>12X</strong> sem juros</span>
                    <button class="botao-comprar" style="display: none;">Comprar</button>
                </div>
            </div>
            <div class="produto-relacionado">
                <img src="public/assets/img/placeholder.jpg" alt="Produto Relacionado 1">

                <div class="detalhes-produto-semelhante">
                    <p class="nome-produto-semelhante">Nome do Produto Relacionado 1 Nome do Produto Relacionado 1</p>
                    <div class="precos">
                        <span class="preco-antigo">R$ 1.000,00</span>
                        <span class="preco-atual">R$ 909,90 À vista</span>
                    </div>
                    <span class="descricao-produto-semelhante">No <strong>PIX</strong> ou <strong>12X</strong> sem juros</span>
                    <button class="botao-comprar" style="display: none;">Comprar</button>
                </div>
            </div>
            <div class="produto-relacionado">
                <img src="public/assets/img/placeholder.jpg" alt="Produto Relacionado 1">

                <div class="detalhes-produto-semelhante">
                    <p class="nome-produto-semelhante">Nome do Produto Relacionado 1 Nome do Produto Relacionado 1</p>
                    <div class="precos">
                        <span class="preco-antigo">R$ 1.000,00</span>
                        <span class="preco-atual">R$ 909,90 À vista</span>
                    </div>
                    <span class="descricao-produto-semelhante">No <strong>PIX</strong> ou <strong>12X</strong> sem juros</span>
                    <button class="botao-comprar" style="display: none;">Comprar</button>
                </div>
            </div>
            <div class="produto-relacionado">
                <img src="public/assets/img/placeholder.jpg" alt="Produto Relacionado 1">

                <div class="detalhes-produto-semelhante">
                    <p class="nome-produto-semelhante">Nome do Produto Relacionado 1 Nome do Produto Relacionado 1</p>
                    <div class="precos">
                        <span class="preco-antigo">R$ 1.000,00</span>
                        <span class="preco-atual">R$ 909,90 À vista</span>
                    </div>
                    <span class="descricao-produto-semelhante">No <strong>PIX</strong> ou <strong>12X</strong> sem juros</span>
                    <button class="botao-comprar" style="display: none;">Comprar</button>
                </div>
            </div>
            <div class="produto-relacionado">
                <img src="public/assets/img/placeholder.jpg" alt="Produto Relacionado 1">

                <div class="detalhes-produto-semelhante">
                    <p class="nome-produto-semelhante">Nome do Produto Relacionado 1 Nome do Produto Relacionado 1</p>
                    <div class="precos">
                        <span class="preco-antigo">R$ 1.000,00</span>
                        <span class="preco-atual">R$ 909,90 À vista</span>
                    </div>
                    <span class="descricao-produto-semelhante">No <strong>PIX</strong> ou <strong>12X</strong> sem juros</span>
                    <button class="botao-comprar" style="display: none;">Comprar</button>
                </div>
            </div>
            <div class="produto-relacionado">
                <img src="public/assets/img/placeholder.jpg" alt="Produto Relacionado 1">

                <div class="detalhes-produto-semelhante">
                    <p class="nome-produto-semelhante">Nome do Produto Relacionado 1 Nome do Produto Relacionado 1</p>
                    <div class="precos">
                        <span class="preco-antigo">R$ 1.000,00</span>
                        <span class="preco-atual">R$ 909,90 À vista</span>
                    </div>
                    <span class="descricao-produto-semelhante">No <strong>PIX</strong> ou <strong>12X</strong> sem juros</span>
                    <button class="botao-comprar" style="display: none;">Comprar</button>
                </div>
            </div>
            <div class="produto-relacionado">
                <img src="public/assets/img/placeholder.jpg" alt="Produto Relacionado 1">

                <div class="detalhes-produto-semelhante">
                    <p class="nome-produto-semelhante">Nome do Produto Relacionado 1 Nome do Produto Relacionado 1</p>
                    <div class="precos">
                        <span class="preco-antigo">R$ 1.000,00</span>
                        <span class="preco-atual">R$ 909,90 À vista</span>
                    </div>
                    <span class="descricao-produto-semelhante">No <strong>PIX</strong> ou <strong>12X</strong> sem juros</span>
                    <button class="botao-comprar" style="display: none;">Comprar</button>
                </div>
            </div>
            <div class="produto-relacionado">
                <img src="public/assets/img/placeholder.jpg" alt="Produto Relacionado 1">

                <div class="detalhes-produto-semelhante">
                    <p class="nome-produto-semelhante">Nome do Produto Relacionado 1 Nome do Produto Relacionado 1</p>
                    <div class="precos">
                        <span class="preco-antigo">R$ 1.000,00</span>
                        <span class="preco-atual">R$ 909,90 À vista</span>
                    </div>
                    <span class="descricao-produto-semelhante">No <strong>PIX</strong> ou <strong>12X</strong> sem juros</span>
                    <button class="botao-comprar" style="display: none;">Comprar</button>
                </div>
            </div>
            <div class="produto-relacionado">
                <img src="public/assets/img/placeholder.jpg" alt="Produto Relacionado 1">

                <div class="detalhes-produto-semelhante">
                    <p class="nome-produto-semelhante">Nome do Produto Relacionado 1 Nome do Produto Relacionado 1</p>
                    <div class="precos">
                        <span class="preco-antigo">R$ 1.000,00</span>
                        <span class="preco-atual">R$ 909,90 À vista</span>
                    </div>
                    <span class="descricao-produto-semelhante">No <strong>PIX</strong> ou <strong>12X</strong> sem juros</span>
                    <button class="botao-comprar" style="display: none;">Comprar</button>
                </div>
            </div>
            <!-- Repita conforme necessário -->
        </div>
    </div>
</div>
</div>

<?php
include 'components/footer.php';

?>

<!-- JavaScript -->
<script src="script.js"></script>

<style>


</style>

<!-- Adicione isso antes do fechamento da tag </body> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(document).ready(function() {
        $('.carousel').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4000,
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicialmente marca a primeira estrela como ativa ao carregar a página
        const stars = document.querySelectorAll('.icone-estrela-avaliacao');
        stars[0].classList.add('ativo'); // Certifique-se de que a primeira estrela esteja ativa por padrão

        stars.forEach(function(star, index) {
            star.addEventListener('click', function() {
                // Remove a classe 'ativo' de todas as estrelas
                stars.forEach(function(innerStar) {
                    innerStar.classList.remove('ativo');
                });

                // Adiciona a classe 'ativo' para a estrela clicada e todas as anteriores a ela
                for (let i = 0; i <= index; i++) {
                    stars[i].classList.add('ativo');
                }

                console.log("Avaliação: " + (index + 1)); // Log da avaliação selecionada
            });
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var produtosRelacionados = document.querySelectorAll('.produto-relacionado');

        produtosRelacionados.forEach(function(produtoRelacionado) {
            produtoRelacionado.addEventListener('mouseenter', function() {
                var botaoComprar = this.querySelector('.botao-comprar');
                botaoComprar.style.display = 'block';
            });

            produtoRelacionado.addEventListener('mouseleave', function() {
                var botaoComprar = this.querySelector('.botao-comprar');
                botaoComprar.style.display = 'none';
            });
        });
    });
</script>

<script>
    document.querySelector('.plus').addEventListener('click', function() {
        var qtyInput = document.getElementById('qty');
        var currentValue = parseInt(qtyInput.value);
        qtyInput.value = currentValue + 1;
    });

    document.querySelector('.minus').addEventListener('click', function() {
        var qtyInput = document.getElementById('qty');
        var currentValue = parseInt(qtyInput.value);
        if (currentValue > 1) {
            qtyInput.value = currentValue - 1;
        }
    });
</script>

</body>

</html>