// contact.js - JavaScript for contact page

document.addEventListener('DOMContentLoaded', function() {
    // Contact Form Handling
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            subject: document.getElementById('subject').value,
            message: document.getElementById('message').value
        };
        
        // Basic validation
        if (!formData.name || !formData.email || !formData.subject || !formData.message) {
            showNotification('Please fill in all required fields.', 'error');
            return;
        }
        
        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(formData.email)) {
            showNotification('Invalid email format.', 'error');
            return;
        }
        
        // Simulate form submission
        const submitBtn = document.querySelector('.submit-btn');
        const originalText = submitBtn.textContent;
        
        submitBtn.textContent = 'Sending...';
        submitBtn.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            showNotification('Your message has been sent successfully! We will contact you within 1-2 business days.', 'success');
            document.getElementById('contactForm').reset();
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
            
            // Log form data (in real app, this would be sent to server)
            console.log('Form submitted:', formData);
        }, 2000);
    });

    // FAQ Toggle Functionality
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', () => {
            const faqItem = question.parentElement;
            faqItem.classList.toggle('active');
        });
    });

    // Notification System
    function showNotification(message, type = 'info') {
        // Remove existing notification
        const existingNotification = document.querySelector('.notification');
        if (existingNotification) {
            existingNotification.remove();
        }
        
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `;
        
        // Add styles
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: ${type === 'error' ? '#e74c3c' : type === 'success' ? '#27ae60' : '#3498db'};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 1000;
            max-width: 400px;
            animation: slideIn 0.3s ease;
        `;
        
        // Add close button functionality
        notification.querySelector('.notification-close').addEventListener('click', () => {
            notification.remove();
        });
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }
        }, 5000);
        
        document.body.appendChild(notification);
    }

    // Map Actions
    document.querySelectorAll('.map-actions .btn').forEach(button => {
        button.addEventListener('click', function() {
            const action = this.textContent.trim();
            if (action === 'Get Directions') {
                showNotification('Opening maps application...', 'info');
                // In real implementation, this would open maps with coordinates
            } else if (action === 'View Street View') {
                showNotification('Opening street view...', 'info');
                // In real implementation, this would open street view
            }
        });
    });

    // Phone number click handler
    document.querySelectorAll('.contact-details p').forEach(element => {
        if (element.textContent.includes('+62')) {
            element.style.cursor = 'pointer';
            element.addEventListener('click', function() {
                const phoneNumber = this.textContent.trim();
                showNotification(`Calling ${phoneNumber}...`, 'info');
                // In real implementation, this would initiate a phone call
            });
        }
    });

    console.log('Contact Page Loaded');
});