document.addEventListener('DOMContentLoaded', function() {
    // Mobile Navigation
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    const links = document.querySelectorAll('.nav-links li a');
    
    hamburger.addEventListener('click', function() {
        navLinks.classList.toggle('active');
        hamburger.classList.toggle('active');
    });
    
    links.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.classList.remove('active');
            hamburger.classList.remove('active');
        });
    });
    
    // Sticky Header
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        header.classList.toggle('scrolled', window.scrollY > 0);
    });
    
    // Typing Animation
    const typed = new Typed('.typing', {
        strings: ['Developer', 'Designer', 'Freelancer'],
        typeSpeed: 100,
        backSpeed: 60,
        loop: true
    });
    
    // Smooth Scrolling for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
        });
    });
    
    // Active Link on Scroll
    const sections = document.querySelectorAll('section');
    
    window.addEventListener('scroll', function() {
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            
            if (pageYOffset >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });
        
        links.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
    
    // Portfolio Filter
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            portfolioItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Review Slider
    const reviewSlides = document.querySelectorAll('.review-slide');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const indicators = document.querySelectorAll('.indicator');
    let currentSlide = 0;
    
    function showSlide(index) {
        reviewSlides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        reviewSlides[index].classList.add('active');
        indicators[index].classList.add('active');
        currentSlide = index;
    }
    
    prevBtn.addEventListener('click', function() {
        currentSlide = (currentSlide - 1 + reviewSlides.length) % reviewSlides.length;
        showSlide(currentSlide);
    });
    
    nextBtn.addEventListener('click', function() {
        currentSlide = (currentSlide + 1) % reviewSlides.length;
        showSlide(currentSlide);
    });
    
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function() {
            showSlide(index);
        });
    });
    
    // Auto slide change
    setInterval(function() {
        currentSlide = (currentSlide + 1) % reviewSlides.length;
        showSlide(currentSlide);
    }, 5000);
    
    // Back to Top Button
    const backToTopBtn = document.querySelector('.back-to-top');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('active');
        } else {
            backToTopBtn.classList.remove('active');
        }
    });
    
    // Current Year in Footer
    document.getElementById('year').textContent = new Date().getFullYear();
    
    // Form Submission
    const contactForm = document.getElementById('contactForm');
    
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value;
        
        // Here you would typically send the form data to a server
        // For this example, we'll just show an alert
        alert(`Thank you, ${name}! Your message has been sent. We'll get back to you soon.`);
        
        // Reset the form
        contactForm.reset();
    });
    
    // Animation on Scroll
    function animateOnScroll() {
        const elements = document.querySelectorAll('.about-content, .skills-content, .portfolio-item, .contact-content');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;
            
            if (elementPosition < screenPosition) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    }
    
    // Set initial state for animated elements
    document.querySelectorAll('.about-content, .skills-content, .portfolio-item, .contact-content').forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'all 0.5s ease';
    });
    
    window.addEventListener('scroll', animateOnScroll);
    window.addEventListener('load', animateOnScroll);
});

// Review System
document.addEventListener('DOMContentLoaded', function() {
    // Initialize star ratings display
    initializeStarRatings();
    
    // Set up interactive rating input
    setupRatingInput();
    
    // Handle review form submission
    setupReviewForm();
    
    // Set up pagination
    setupPagination();
});

// Initialize star ratings display
function initializeStarRatings() {
    const starContainers = document.querySelectorAll('.stars[data-rating]');
    
    starContainers.forEach(container => {
        const rating = parseFloat(container.getAttribute('data-rating'));
        container.innerHTML = '';
        
        // Add full stars
        for (let i = 1; i <= 5; i++) {
            const star = document.createElement('span');
            star.className = 'star';
            star.innerHTML = '★';
            
            if (i <= Math.floor(rating)) {
                star.classList.add('filled');
            } else if (i === Math.ceil(rating) && rating % 1 >= 0.5) {
                star.classList.add('half-filled');
            }
            
            container.appendChild(star);
        }
    });
}


