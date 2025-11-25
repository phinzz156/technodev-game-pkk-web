// Mobile menu toggle
document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
    document.getElementById('nav-menu').classList.toggle('show');
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
            
            // Close mobile menu if open
            document.getElementById('nav-menu').classList.remove('show');
        }
    });
});

// Apply button functionality
document.querySelectorAll('.apply-btn').forEach(button => {
    button.addEventListener('click', function() {
        const jobTitle = this.getAttribute('data-job');
        alert(`Terima kasih! Anda akan diarahkan ke formulir lamaran untuk posisi: ${jobTitle}`);
        // In a real implementation, this would redirect to an application form
        // window.location.href = `career-apply.php?job=${encodeURIComponent(jobTitle)}`;
    });
});

// Add active class to navigation links based on scroll position
window.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('nav ul li a');
    
    let current = '';
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        
        if (pageYOffset >= sectionTop - 100) {
            current = section.getAttribute('id');
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href').includes(`#${current}`)) {
            link.classList.add('active');
        }
    });
});

// Mobile menu toggle
document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
    const navMenu = document.getElementById('nav-menu');
    if (navMenu) {
        navMenu.classList.toggle('show');
    }
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
            
            // Close mobile menu if open
            const navMenu = document.getElementById('nav-menu');
            if (navMenu) {
                navMenu.classList.remove('show');
            }
        }
    });
});

// Apply button functionality
document.querySelectorAll('.apply-btn').forEach(button => {
    button.addEventListener('click', function() {
        const jobTitle = this.getAttribute('data-job') || 'Posisi ini';
        alert(`Terima kasih! Anda akan diarahkan ke formulir lamaran untuk posisi: ${jobTitle}`);
    });
});

// Add active class to navigation links based on scroll position
window.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('nav ul li a');
    
    let current = '';
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        
        if (pageYOffset >= sectionTop - 100) {
            current = section.getAttribute('id');
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        const href = link.getAttribute('href');
        if (href && href.includes(`#${current}`)) {
            link.classList.add('active');
        }
    });
});

// script.js - JavaScript for main page with image handling

// Mobile menu toggle
document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
    const navMenu = document.getElementById('nav-menu');
    if (navMenu) {
        navMenu.classList.toggle('show');
    }
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
            
            // Close mobile menu if open
            const navMenu = document.getElementById('nav-menu');
            if (navMenu) {
                navMenu.classList.remove('show');
            }
        }
    });
});

// Apply button functionality
document.querySelectorAll('.apply-btn').forEach(button => {
    button.addEventListener('click', function() {
        const jobTitle = this.getAttribute('data-job') || 'This Position';
        alert(`Thank you! You will be redirected to the application form for: ${jobTitle}`);
    });
});

// Image error handling for homepage
document.addEventListener('DOMContentLoaded', function() {
    // Handle broken images
    document.querySelectorAll('.app-image img').forEach(img => {
        img.addEventListener('error', function() {
            console.log('Image failed to load:', this.src);
            this.style.display = 'none';
            const placeholder = this.nextElementSibling;
            if (placeholder && placeholder.classList.contains('app-image-placeholder')) {
                placeholder.style.display = 'flex';
            }
        });
        
        img.addEventListener('load', function() {
            console.log('Image loaded successfully:', this.src);
            const placeholder = this.nextElementSibling;
            if (placeholder && placeholder.classList.contains('app-image-placeholder')) {
                placeholder.style.display = 'none';
            }
        });
    });
});

// Add active class to navigation links based on scroll position
window.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('nav ul li a');
    
    let current = '';
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        
        if (pageYOffset >= sectionTop - 100) {
            current = section.getAttribute('id');
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        const href = link.getAttribute('href');
        if (href && href.includes(`#${current}`)) {
            link.classList.add('active');
        }
    });
});

console.log('DevLokal Website Loaded Successfully');