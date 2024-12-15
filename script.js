window.onload = function() {
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('nav-links');

    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            console.log('Hamburger clicked!'); // Debug message
            navLinks.classList.toggle('active'); // 🟢 Toggle the active class
        });
    } else {
        console.error('Hamburger or navLinks element not found.');
    }
}

let currentIndex = 0;

function moveSlide(step) {
    const slides = document.querySelectorAll('.gallery-slide');
    const wrapper = document.querySelector('.gallery-wrapper');
    const totalSlides = slides.length;

    currentIndex += step;

    if (currentIndex < 0) {
        currentIndex = totalSlides - 3; // Go to last 3 images if trying to go back
    } else if (currentIndex >= totalSlides - 2) {
        currentIndex = 0; // Go back to the first set of images
    }

    // Move the wrapper by a calculated offset to display the next set of images
    const offset = -currentIndex * (slides[0].clientWidth + 20); // Adjust based on image width and margin
    wrapper.style.transform = `translateX(${offset}px)`;
}

// Automatic Slide Transition (Optional)
let autoSlide = setInterval(() => {
    moveSlide(1);
}, 4000); // Change slide every 4 seconds (adjust as needed)
