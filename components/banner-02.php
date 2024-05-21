<div id="carouselBanner02" class="carousel">
    <div class="slides">
        <div class="slide" id="slide1"></div>
        <div class="slide" id="slide2">Slide 2</div>
        <div class="slide" id="slide3">Slide 3</div>
    </div>
    <a class="prev" onclick="moveSlide(-1)">❮</a>
    <a class="next" onclick="moveSlide(1)">❯</a>
</div>


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

    const offset = slideIndex * -100;
    const slidesContainer = document.querySelector('.carousel .slides');
    slidesContainer.style.transform = `translateX(${offset}%)`;
}

function autoMoveSlide() {
    moveSlide(1);
}

setInterval(autoMoveSlide, 5000);

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

moveSlide(0);

</script>