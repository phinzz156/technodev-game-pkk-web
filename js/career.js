// career.js - JavaScript for career page

document.addEventListener('DOMContentLoaded', function() {
    // File upload functionality
    const fileInput = document.getElementById('resume');
    const fileName = document.querySelector('.file-name');
    
    if (fileInput && fileName) {
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = 'No file chosen';
            }
        });
    }
    
    // Apply Now buttons
    const applyButtons = document.querySelectorAll('.apply-now-btn');
    const positionSelect = document.getElementById('position');
    
    applyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const jobTitle = this.getAttribute('data-job');
            
            // Set the position in the form
            if (positionSelect) {
                for (let i = 0; i < positionSelect.options.length; i++) {
                    if (positionSelect.options[i].text === jobTitle) {
                        positionSelect.selectedIndex = i;
                        break;
                    }
                }
            }
            
            // Scroll to application form
            document.getElementById('application-form').scrollIntoView({
                behavior: 'smooth'
            });
            
            // Highlight the form
            const formContainer = document.querySelector('.application-form-container');
            formContainer.style.animation = 'highlight 2s ease';
        });
    });
    
    // View Details buttons
    const viewDetailsButtons = document.querySelectorAll('.view-details-btn');
    const jobModal = document.getElementById('jobModal');
    const jobModalContent = document.getElementById('jobModalContent');
    const jobModalClose = document.querySelector('.job-modal-close');
    
    viewDetailsButtons.forEach(button => {
        button.addEventListener('click', function() {
            const jobId = this.getAttribute('data-job-id');
            showJobDetails(jobId);
        });
    });
    
    // Close modal
    if (jobModalClose) {
        jobModalClose.addEventListener('click', closeJobModal);
    }
    
    // Close modal when clicking outside
    if (jobModal) {
        jobModal.addEventListener('click', function(e) {
            if (e.target === jobModal) {
                closeJobModal();
            }
        });
    }
    
    // Show job details in modal
    function showJobDetails(jobId) {
        // In real application, you would fetch job details from server
        // For now, we'll use the data from the job card
        
        const jobCard = document.querySelector(`.view-details-btn[data-job-id="${jobId}"]`).closest('.job-listing-card');
        const jobTitle = jobCard.querySelector('h3').textContent;
        const jobType = jobCard.querySelector('.job-type').textContent;
        const jobLocation = jobCard.querySelector('.job-detail:nth-child(1) span:last-child').textContent;
        const jobExperience = jobCard.querySelector('.job-detail:nth-child(2) span:last-child').textContent;
        const jobDescription = jobCard.querySelector('.job-description p').textContent;
        
        const modalContent = `
            <h2>${jobTitle}</h2>
            <div class="job-meta">
                <span class="job-type-large">${jobType}</span>
                <div class="job-details-modal">
                    <div class="job-detail">
                        <span class="detail-icon">📍</span>
                        <span><strong>Location:</strong> ${jobLocation}</span>
                    </div>
                    <div class="job-detail">
                        <span class="detail-icon">💼</span>
                        <span><strong>Experience:</strong> ${jobExperience}</span>
                    </div>
                </div>
            </div>
            
            <div class="job-description-detailed">
                <h3>Job Description</h3>
                <p>${jobDescription}</p>
                
                <h3>Responsibilities</h3>
                <ul>
                    <li>Develop and maintain high-quality web applications</li>
                    <li>Collaborate with cross-functional teams</li>
                    <li>Write clean, maintainable code</li>
                    <li>Participate in code reviews</li>
                    <li>Stay up-to-date with emerging technologies</li>
                </ul>
                
                <h3>Requirements</h3>
                <ul>
                    <li>Bachelor's degree in Computer Science or related field</li>
                    <li>${jobExperience} in relevant position</li>
                    <li>Strong problem-solving skills</li>
                    <li>Excellent communication skills</li>
                    <li>Ability to work in a team environment</li>
                </ul>
                
                <h3>What We Offer</h3>
                <ul>
                    <li>Competitive salary and benefits</li>
                    <li>Flexible working hours</li>
                    <li>Professional development opportunities</li>
                    <li>Great work environment</li>
                    <li>Career growth path</li>
                </ul>
            </div>
            
            <div class="modal-actions">
                <button class="btn apply-from-modal" data-job="${jobTitle}">Apply Now</button>
                <button class="btn-secondary" onclick="closeJobModal()">Close</button>
            </div>
        `;
        
        if (jobModalContent) {
            jobModalContent.innerHTML = modalContent;
            jobModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
            
            // Add event listener to apply button in modal
            const applyFromModal = document.querySelector('.apply-from-modal');
            if (applyFromModal) {
                applyFromModal.addEventListener('click', function() {
                    const jobTitle = this.getAttribute('data-job');
                    
                    // Set the position in the form
                    if (positionSelect) {
                        for (let i = 0; i < positionSelect.options.length; i++) {
                            if (positionSelect.options[i].text === jobTitle) {
                                positionSelect.selectedIndex = i;
                                break;
                            }
                        }
                    }
                    
                    closeJobModal();
                    
                    // Scroll to application form
                    document.getElementById('application-form').scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            }
        }
    }
    
    // Close job modal
    function closeJobModal() {
        if (jobModal) {
            jobModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }
    
    // Form validation
    const applicationForm = document.querySelector('.application-form');
    if (applicationForm) {
        applicationForm.addEventListener('submit', function(e) {
            const fileInput = document.getElementById('resume');
            const agreeCheckbox = document.getElementById('agree');
            
            // Check file type
            if (fileInput.files.length > 0) {
                const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                const fileType = fileInput.files[0].type;
                
                if (!allowedTypes.includes(fileType)) {
                    e.preventDefault();
                    alert('Please upload a PDF, DOC, or DOCX file.');
                    return;
                }
                
                // Check file size (5MB max)
                const fileSize = fileInput.files[0].size;
                const maxSize = 5 * 1024 * 1024; // 5MB
                
                if (fileSize > maxSize) {
                    e.preventDefault();
                    alert('File size must be less than 5MB.');
                    return;
                }
            }
            
            if (!agreeCheckbox.checked) {
                e.preventDefault();
                alert('Please agree to the privacy policy.');
                return;
            }
        });
    }
    
    // Add highlight animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes highlight {
            0% { box-shadow: 0 0 0 0 rgba(52, 152, 219, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(52, 152, 219, 0); }
            100% { box-shadow: 0 0 0 0 rgba(52, 152, 219, 0); }
        }
    `;
    document.head.appendChild(style);
    
    console.log('Career Page Loaded');
});

// Global function for modal close
function closeJobModal() {
    const jobModal = document.getElementById('jobModal');
    if (jobModal) {
        jobModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}