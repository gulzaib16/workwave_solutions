document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript Loaded");

    let loginToggle = document.getElementById("login-toggle");
    let dropdownMenu = document.getElementById("dropdown-menu");

    if (!loginToggle || !dropdownMenu) {
        console.error("Dropdown elements not found! Make sure IDs exist in index.html.");
        return;
    }

    loginToggle.addEventListener("click", function () {
        dropdownMenu.classList.toggle("show");
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function (event) {
        if (!loginToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.remove("show");
        }
    });

    let username = sessionStorage.getItem("username");

    if (username) {
        loginToggle.innerHTML = `<i class="fas fa-user"></i> ${username} ▼`;
        dropdownMenu.innerHTML = `<li><a href="#" id="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a></li>`;

        document.getElementById("logout-button").addEventListener("click", function () {
            sessionStorage.removeItem("username");
            window.location.href = "index.html";
        });
    }
});

// Hamburger Menu Toggle
window.onload = function() {
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('nav-links');

    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    } else {
        console.error('Hamburger or navLinks element not found.');
    }
};

// Gallery Slider
let currentIndex = 0;

function moveSlide(step) {
    const slides = document.querySelectorAll('.gallery-slide');
    const wrapper = document.querySelector('.gallery-wrapper');
    const totalSlides = slides.length;

    currentIndex += step;

    if (currentIndex < 0) {
        currentIndex = totalSlides - 3;
    } else if (currentIndex >= totalSlides - 2) {
        currentIndex = 0;
    }

    const offset = -currentIndex * (slides[0].clientWidth + 20);
    wrapper.style.transform = `translateX(${offset}px)`;
}

// Automatic Slide Transition
let autoSlide = setInterval(() => {
    moveSlide(1);
}, 4000);

// Error Handling
function getQueryParam(param) {
    let params = new URLSearchParams(window.location.search);
    return params.get(param);
}

function showErrors() {
    if (document.getElementById('username')) {
        document.getElementById('username').value = getQueryParam('username') || '';
    }
    if (document.getElementById('email')) {
        document.getElementById('email').value = getQueryParam('email') || '';
    }

    if (getQueryParam('error') === 'username_exists') {
        document.getElementById('username-error').textContent = "Username already exists!";
    }
    if (getQueryParam('error') === 'email_exists') {
        document.getElementById('email-error').textContent = "Email already exists!";
    }
    if (getQueryParam('error') === 'weak_password') {
        document.getElementById('password-error').textContent = "Password must be at least 8 characters.";
    }
    if (getQueryParam('error') === 'invalid_username') {
        document.getElementById('username-error').textContent = "Username must contain only letters and numbers.";
    }
}

// Form Validation
function setupFormValidation() {
    let form = document.querySelector("form");

    if (!form) {
        console.log("No form found. Skipping form validation.");
        return;
    }

    form.addEventListener("submit", function(event) {
        let username = document.getElementById("username").value;
        let usernamePattern = /^[a-zA-Z0-9]+$/;
        let usernameError = document.getElementById("username-error");

        if (!usernamePattern.test(username)) {
            usernameError.textContent = "Username must contain only letters and numbers.";
            event.preventDefault();
        } else {
            usernameError.textContent = "";
        }
    });
}

showErrors();
setupFormValidation();