<div id="carouselBanner02" class="carousel">
    <div class="slides">
        <div class="slide" id="slide1">Slide 1</div>
        <div class="slide" id="slide2">Slide 2</div>
        <div class="slide" id="slide3">Slide 3</div>
        <!-- Adicione mais slides conforme necessário -->
    </div>
    <a class="prev" onclick="moveSlide(-1)">❮</a>
    <a class="next" onclick="moveSlide(1)">❯</a>
</div>

<section class="categories">
    <div class="container">
        <h2>Navegue por categoria</h2>
        <div class="category-icons">
            <a href="#">Feminino</a>
            <a href="#">Masculino</a>
            <a href="#">Calçados</a>
            <a href="#">Infantil</a>
            <a href="#">Lingerie</a>
            <a href="#">Plus Size</a>
            <a href="#">Acessórios</a>
            <a href="#">Casa</a>
        </div>
    </div>
</section>

<script>
let slideIndex = 0;
let touchStartX = 0;
let touchEndX = 0;

function moveSlide(step) {
    const slides = document.querySelectorAll('.carousel .slide');
    slideIndex += step;

    if (slideIndex >= slides.length) {
        slideIndex = 0;
    } else if (slideIndex < 0) {
        slideIndex = slides.length - 1;
    }

    const offset = slideIndex * -100; // Assume que a largura de cada slide é 100% do container
    const slidesContainer = document.querySelector('.carousel .slides');
    slidesContainer.style.transform = `translateX(${offset}%)`;
}

// Função para mover o carrossel automaticamente
function autoMoveSlide() {
    moveSlide(1);
}

// Configura o carrossel para se mover a cada 3 segundos
setInterval(autoMoveSlide, 3000);

// Adiciona suporte para gestos de toque
const slidesContainer = document.querySelector('.carousel .slides');

slidesContainer.addEventListener('touchstart', e => {
    touchStartX = e.touches[0].clientX;
});

slidesContainer.addEventListener('touchend', e => {
    touchEndX = e.changedTouches[0].clientX;
    handleGesture();
});

function handleGesture() {
    if (touchEndX < touchStartX) {
        moveSlide(1);
    }
    if (touchEndX > touchStartX) {
        moveSlide(-1);
    }
}

// Inicializa o carrossel mostrando o primeiro slide
moveSlide(0);

</script>