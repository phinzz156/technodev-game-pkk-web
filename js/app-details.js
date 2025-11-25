// app-details.js - JavaScript for app details page with external images

document.addEventListener('DOMContentLoaded', function() {
    // Screenshot thumbnail functionality
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainScreenshot = document.getElementById('mainScreenshot');
    
    if (thumbnails.length > 0 && mainScreenshot) {
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Remove active class from all thumbnails
                thumbnails.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked thumbnail
                this.classList.add('active');
                
                // Change main screenshot
                const newImageUrl = this.getAttribute('data-screenshot');
                changeScreenshot(newImageUrl);
            });
        });
    }
    
    // Function to change main screenshot
    function changeScreenshot(newImageUrl) {
        if (mainScreenshot && newImageUrl) {
            // Add loading class
            mainScreenshot.classList.add('loading');
            
            // Create new image for preloading
            const newImage = new Image();
            newImage.src = newImageUrl;
            
            newImage.onload = function() {
                // Replace image source
                mainScreenshot.src = newImageUrl;
                mainScreenshot.alt = mainScreenshot.alt; // Keep same alt text
                mainScreenshot.classList.remove('loading');
            };
            
            newImage.onerror = function() {
                // If image fails to load, keep current one
                console.error('Failed to load image:', newImageUrl);
                mainScreenshot.classList.remove('loading');
            };
        }
    }
    
    // Download button functionality
    const downloadBtn = document.querySelector('.btn-primary');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const appName = document.querySelector('h1')?.textContent || 'application';
            alert(`Thank you! Download for ${appName} will start shortly.`);
            simulateDownload();
        });
    }
    
    // Simulate download progress
    function simulateDownload() {
        const originalText = downloadBtn.textContent;
        downloadBtn.textContent = 'Downloading...';
        downloadBtn.disabled = true;
        
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            downloadBtn.textContent = `Downloading... ${progress}%`;
            
            if (progress >= 100) {
                clearInterval(interval);
                downloadBtn.textContent = '✓ Downloaded';
                setTimeout(() => {
                    downloadBtn.textContent = originalText;
                    downloadBtn.disabled = false;
                }, 2000);
            }
        }, 200);
    }
    
    // Image error handling
    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('error', function() {
            console.error('Image failed to load:', this.src);
            // You can set a default image here if needed
            // this.src = 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800&h=600&fit=crop';
        });
    });
    
    console.log('App Details Page Loaded with External Images');
});

// app-details.js - JavaScript for app details page with video features

document.addEventListener('DOMContentLoaded', function() {
    // Screenshot thumbnail functionality
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainScreenshot = document.getElementById('mainScreenshot');
    
    if (thumbnails.length > 0 && mainScreenshot) {
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Remove active class from all thumbnails
                thumbnails.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked thumbnail
                this.classList.add('active');
                
                // Change main screenshot
                const newImageUrl = this.getAttribute('data-screenshot');
                changeScreenshot(newImageUrl);
            });
        });
    }
    
    // Function to change main screenshot
    function changeScreenshot(newImageUrl) {
        if (mainScreenshot && newImageUrl) {
            // Add loading class
            mainScreenshot.classList.add('loading');
            
            // Create new image for preloading
            const newImage = new Image();
            newImage.src = newImageUrl;
            
            newImage.onload = function() {
                // Replace image source
                mainScreenshot.src = newImageUrl;
                mainScreenshot.alt = mainScreenshot.alt; // Keep same alt text
                mainScreenshot.classList.remove('loading');
            };
            
            newImage.onerror = function() {
                // If image fails to load, keep current one
                console.error('Failed to load image:', newImageUrl);
                mainScreenshot.classList.remove('loading');
            };
        }
    }
    
    // Video Modal Functionality
    const videoModal = document.getElementById('videoModal');
    const videoModalIframe = document.getElementById('videoModalIframe');
    const videoModalClose = document.querySelector('.video-modal-close');
    const videoButtons = document.querySelectorAll('.video-btn');
    
    // Open video in modal
    if (videoButtons.length > 0) {
        videoButtons.forEach(button => {
            button.addEventListener('click', function() {
                const videoUrl = this.getAttribute('data-video-url');
                openVideoModal(videoUrl);
            });
        });
    }
    
    // Close modal
    if (videoModalClose) {
        videoModalClose.addEventListener('click', closeVideoModal);
    }
    
    // Close modal when clicking outside
    if (videoModal) {
        videoModal.addEventListener('click', function(e) {
            if (e.target === videoModal) {
                closeVideoModal();
            }
        });
    }
    
    // Open video modal function
    function openVideoModal(videoUrl) {
        if (videoModal && videoModalIframe) {
            videoModalIframe.src = videoUrl + '?autoplay=1&rel=0&modestbranding=1';
            videoModal.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }
    }
    
    // Close video modal function
    function closeVideoModal() {
        if (videoModal && videoModalIframe) {
            videoModal.style.display = 'none';
            videoModalIframe.src = '';
            document.body.style.overflow = 'auto'; // Enable scrolling
        }
    }
    
    // Open video in new tab
    window.openVideoInNewTab = function(videoUrl) {
        // Convert embed URL to watch URL
        const watchUrl = videoUrl.replace('embed/', 'watch?v=');
        window.open(watchUrl, '_blank');
    };
    
    // Share video functionality
    const shareVideoButtons = document.querySelectorAll('.share-video-btn');
    if (shareVideoButtons.length > 0) {
        shareVideoButtons.forEach(button => {
            button.addEventListener('click', function() {
                const videoUrl = this.getAttribute('data-video-url');
                const watchUrl = videoUrl.replace('embed/', 'watch?v=');
                shareVideo(watchUrl);
            });
        });
    }
    
    function shareVideo(videoUrl) {
        if (navigator.share) {
            // Use Web Share API if available
            navigator.share({
                title: document.querySelector('h1').textContent + ' - App Demo',
                text: 'Check out this app demo video!',
                url: videoUrl
            })
            .then(() => console.log('Successful share'))
            .catch((error) => console.log('Error sharing:', error));
        } else {
            // Fallback: copy to clipboard
            navigator.clipboard.writeText(videoUrl).then(() => {
                alert('Video link copied to clipboard!');
            }).catch(() => {
                // Final fallback: prompt
                prompt('Copy this link to share:', videoUrl);
            });
        }
    }
    
    // Download button functionality
    const downloadBtn = document.querySelector('.btn-primary');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const appName = document.querySelector('h1')?.textContent || 'application';
            alert(`Thank you! Download for ${appName} will start shortly.`);
            simulateDownload();
        });
    }
    
    // Simulate download progress
    function simulateDownload() {
        const originalText = downloadBtn.textContent;
        downloadBtn.textContent = 'Downloading...';
        downloadBtn.disabled = true;
        
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            downloadBtn.textContent = `Downloading... ${progress}%`;
            
            if (progress >= 100) {
                clearInterval(interval);
                downloadBtn.textContent = '✓ Downloaded';
                setTimeout(() => {
                    downloadBtn.textContent = originalText;
                    downloadBtn.disabled = false;
                }, 2000);
            }
        }, 200);
    }
    
    // Image error handling
    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('error', function() {
            console.error('Image failed to load:', this.src);
        });
    });
    
    console.log('App Details Page Loaded with Video Features');
});

// app-details.js - JavaScript for app details page with video/image switching

document.addEventListener('DOMContentLoaded', function() {
    // Thumbnail functionality - both images and video
    const thumbnails = document.querySelectorAll('.thumbnail');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            
            // Remove active class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked thumbnail
            this.classList.add('active');
            
            if (type === 'image') {
                // Handle image thumbnail click
                const newImageUrl = this.getAttribute('data-screenshot');
                switchToImageDisplay();
                changeScreenshot(newImageUrl);
            } else if (type === 'video') {
                // Handle video thumbnail click
                const videoUrl = this.getAttribute('data-video-url');
                switchToVideoDisplay(videoUrl);
            }
        });
    });
    
    // Video button in sidebar
    const videoSidebarBtn = document.querySelector('.video-sidebar-btn');
    if (videoSidebarBtn) {
        videoSidebarBtn.addEventListener('click', function() {
            const videoThumbnail = document.querySelector('.video-thumbnail-btn');
            if (videoThumbnail) {
                const videoUrl = videoThumbnail.getAttribute('data-video-url');
                switchToVideoDisplay(videoUrl);
                
                // Update active thumbnail
                thumbnails.forEach(thumb => thumb.classList.remove('active'));
                videoThumbnail.classList.add('active');
            }
        });
    }
    
    // Function to switch to video display
    function switchToVideoDisplay(videoUrl) {
        const imageDisplay = document.getElementById('imageDisplay');
        const videoDisplay = document.getElementById('videoDisplay');
        
        if (imageDisplay && videoDisplay) {
            imageDisplay.classList.remove('active');
            videoDisplay.classList.add('active');
            
            // Update iframe src dengan autoplay
            const iframe = videoDisplay.querySelector('iframe');
            if (iframe) {
                iframe.src = videoUrl + '?autoplay=1&rel=0&modestbranding=1';
            }
        }
    }
    
    // Function to switch to image display
    function switchToImageDisplay() {
        const imageDisplay = document.getElementById('imageDisplay');
        const videoDisplay = document.getElementById('videoDisplay');
        
        if (imageDisplay && videoDisplay) {
            videoDisplay.classList.remove('active');
            imageDisplay.classList.add('active');
            
            // Pause video
            const iframe = videoDisplay.querySelector('iframe');
            if (iframe) {
                // Remove autoplay parameter
                iframe.src = iframe.src.replace('autoplay=1', 'autoplay=0');
            }
        }
    }
    
    // Function to change screenshot
    function changeScreenshot(newImageUrl) {
        const mainScreenshot = document.querySelector('.screenshot-img');
        if (mainScreenshot && newImageUrl) {
            // Add loading class
            mainScreenshot.classList.add('loading');
            
            // Create new image for preloading
            const newImage = new Image();
            newImage.src = newImageUrl;
            
            newImage.onload = function() {
                // Replace image source
                mainScreenshot.src = newImageUrl;
                mainScreenshot.alt = mainScreenshot.alt;
                mainScreenshot.classList.remove('loading');
            };
            
            newImage.onerror = function() {
                console.error('Failed to load image:', newImageUrl);
                mainScreenshot.classList.remove('loading');
            };
        }
    }
    
    // Global functions untuk accessibility dari HTML
    window.switchToVideo = switchToVideoDisplay;
    window.switchToImage = switchToImageDisplay;
    
    window.openVideoInNewTab = function(videoUrl) {
        const watchUrl = videoUrl.replace('embed/', 'watch?v=');
        window.open(watchUrl, '_blank');
    };
    
    // Download button functionality
    const downloadBtn = document.querySelector('.btn-primary');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const appName = document.querySelector('h1')?.textContent || 'application';
            alert(`Thank you! Download for ${appName} will start shortly.`);
            simulateDownload();
        });
    }
    
    // Simulate download progress
    function simulateDownload() {
        const originalText = downloadBtn.textContent;
        downloadBtn.textContent = 'Downloading...';
        downloadBtn.disabled = true;
        
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            downloadBtn.textContent = `Downloading... ${progress}%`;
            
            if (progress >= 100) {
                clearInterval(interval);
                downloadBtn.textContent = '✓ Downloaded';
                setTimeout(() => {
                    downloadBtn.textContent = originalText;
                    downloadBtn.disabled = false;
                }, 2000);
            }
        }, 200);
    }
    
    // Image error handling
    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('error', function() {
            console.error('Image failed to load:', this.src);
        });
    });
    
    console.log('App Details Page Loaded with Video/Image Switching');
});