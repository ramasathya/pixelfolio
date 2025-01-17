let currentSlide = 0;

// Select carousel container and slides
const carousel = document.querySelector('.carousel');
const totalSlides = document.querySelectorAll('.carousel-slide').length;

// Function to move to the next slide
function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides; // Loop kembali ke slide pertama setelah slide terakhir
    updateCarousel();
}

// Function to update carousel position
function updateCarousel() {
    const offset = currentSlide * -100; // Geser slide ke kiri sebesar 100% untuk setiap slide
    carousel.style.transform = `translateX(${offset}%)`;
}

// Automatically change slides every 5 seconds
setInterval(nextSlide, 3000);
