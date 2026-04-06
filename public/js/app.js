import './bootstrap';

// Custom JS for gurgaoncab Tour & Travel
document.addEventListener('DOMContentLoaded', function() {
	// Example: Highlight active nav link
	const navLinks = document.querySelectorAll('.gurgaoncab-nav .nav-link');
	navLinks.forEach(link => {
		if (link.href === window.location.href) {
			link.classList.add('active');
		}
	});

	// Example: Smooth scroll for footer links
	document.querySelectorAll('.gurgaoncab-footer-links a').forEach(link => {
		link.addEventListener('click', function(e) {
			if (this.hash) {
				e.preventDefault();
				document.querySelector(this.hash)?.scrollIntoView({ behavior: 'smooth' });
			}
		});
	});

	// Ensure Bootstrap carousels are initialized (for custom carousels)
	if (window.bootstrap && window.bootstrap.Carousel) {
		document.querySelectorAll('.carousel').forEach(function(carouselEl) {
			new window.bootstrap.Carousel(carouselEl, {
				interval: 4000,
				ride: 'carousel',
				pause: false,
				wrap: true
			});
		});
	}
});

// Owl Carousel initialization for vehicles
$(document).ready(function() {
    $('#vehiclesOwlCarousel').owlCarousel({
        loop: true,
        margin: 24,
        nav: true,
        dots: true,
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            992: { items: 3 }
        }
    });
});
