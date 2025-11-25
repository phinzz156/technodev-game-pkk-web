// admin.js - JavaScript for admin page
document.addEventListener('DOMContentLoaded', function() {
    // View application details
    const viewButtons = document.querySelectorAll('.view-details');
    const modal = document.getElementById('applicationModal');
    const modalContent = document.getElementById('applicationDetails');
    const modalClose = document.querySelector('.modal-close');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const appData = {
                id: this.getAttribute('data-app-id'),
                name: this.getAttribute('data-app-name'),
                email: this.getAttribute('data-app-email'),
                phone: this.getAttribute('data-app-phone'),
                position: this.getAttribute('data-app-position'),
                experience: this.getAttribute('data-app-experience'),
                portfolio: this.getAttribute('data-app-portfolio'),
                message: this.getAttribute('data-app-message'),
                submitted: this.getAttribute('data-app-submitted'),
                status: this.getAttribute('data-app-status')
            };
            showApplicationDetails(appData);
        });
    });
    
    // Close modal
    if (modalClose) {
        modalClose.addEventListener('click', closeModal);
    }
    
    // Close modal when clicking outside
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
    
    function showApplicationDetails(appData) {
        const details = `
            <div class="application-details">
                <h3>Application Details - ${appData.name}</h3>
                
                <div class="application-detail">
                    <strong>Personal Information</strong>
                    <div><strong>Name:</strong> ${appData.name}</div>
                    <div><strong>Email:</strong> <a href="mailto:${appData.email}">${appData.email}</a></div>
                    <div><strong>Phone:</strong> ${appData.phone || 'Not provided'}</div>
                </div>
                
                <div class="application-detail">
                    <strong>Position Information</strong>
                    <div><strong>Position Applied:</strong> ${appData.position}</div>
                    <div><strong>Experience Level:</strong> ${appData.experience}</div>
                    <div><strong>Portfolio:</strong> ${appData.portfolio && appData.portfolio !== 'N/A' ? 
                        `<a href="${appData.portfolio}" target="_blank">${appData.portfolio}</a>` : 
                        'Not provided'}</div>
                </div>
                
                <div class="application-detail">
                    <strong>Application Status</strong>
                    <div><strong>Status:</strong> <span class="status-badge status-${appData.status}">${appData.status}</span></div>
                    <div><strong>Submitted:</strong> ${new Date(appData.submitted).toLocaleString()}</div>
                </div>
                
                <div class="application-detail">
                    <strong>Cover Letter / Message</strong>
                    <p>${appData.message || 'No cover letter provided.'}</p>
                </div>
                
                <div class="application-detail">
                    <strong>Quick Actions</strong>
                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 0.5rem;">
                        <a href="mailto:${appData.email}?subject=Regarding your application for ${appData.position}" 
                           class="btn-small btn-info" target="_blank">
                            📧 Send Email
                        </a>
                        ${appData.phone && appData.phone !== 'N/A' ? `
                        <a href="tel:${appData.phone}" class="btn-small btn-success">
                            📞 Call Candidate
                        </a>
                        ` : ''}
                    </div>
                </div>
            </div>
        `;
        
        if (modalContent) {
            modalContent.innerHTML = details;
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    }
    
    function closeModal() {
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }
    
    console.log('Admin page loaded successfully');
});