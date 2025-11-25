<?php
// Include konfigurasi dan functions dengan path yang benar
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

// Get ID from URL
$app_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Find application by ID
$selected_app = null;
foreach ($applications as $app) {
    if ($app['id'] === $app_id) {
        $selected_app = $app;
        break;
    }
}

// If application not found, redirect to home
if (!$selected_app) {
    header('Location: index.php');
    exit;
}

$page_title = $selected_app['name'];
ob_start();

// Get images for this app
$main_image = getSafeImage($selected_app['images']['main'], 'app');
$thumbnail_images = $selected_app['images']['thumbnails'];

// Check if app has video
$has_video = isset($selected_app['video']) && !empty($selected_app['video']['url']);
$video_type = $has_video ? $selected_app['video']['type'] : '';
$video_url = $has_video ? $selected_app['video']['url'] : '';
$video_thumbnail = $has_video && isset($selected_app['video']['thumbnail']) ? $selected_app['video']['thumbnail'] : '';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1><?php echo htmlspecialchars($selected_app['name']); ?></h1>
        <p><?php echo htmlspecialchars($selected_app['description']); ?></p>
    </div>
</section>

<!-- Breadcrumb -->
<section class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-content">
            <a href="index.php">Home</a>
            <span>></span>
            <a href="index.php#showcase">Showcase</a>
            <span>></span>
            <span><?php echo htmlspecialchars($selected_app['name']); ?></span>
        </div>
    </div>
</section>

<!-- App Details -->
<section class="app-details">
    <div class="container">
        <div class="app-details-container">
            <!-- Screenshots & Video Area -->
            <div class="app-screenshots">
                <!-- Main Display Area -->
                <div class="main-display">
                    <!-- Image Display (Default) -->
                    <div class="image-display active" id="imageDisplay">
                        <img src="<?php echo $main_image; ?>" alt="<?php echo htmlspecialchars($selected_app['name']); ?>" class="screenshot-img">
                    </div>
                    
                    <!-- Video Display (Hidden by default) -->
                    <?php if ($has_video && $video_type === 'youtube'): ?>
                    <div class="video-display" id="videoDisplay">
                        <div class="video-wrapper">
                            <iframe 
                                src="<?php echo htmlspecialchars($video_url); ?>?rel=0&modestbranding=1" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="display-actions">
                            <button class="btn secondary" onclick="switchToImage()">
                                📷 View Screenshots
                            </button>
                            <button class="btn" onclick="openVideoInNewTab('<?php echo htmlspecialchars($video_url); ?>')">
                                📺 Open in YouTube
                            </button>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Thumbnails Navigation -->
                <div class="screenshot-thumbnails">
                    <!-- Screenshot Thumbnails -->
                    <?php foreach ($thumbnail_images as $index => $thumbnail): ?>
                    <div class="thumbnail <?php echo $index === 0 ? 'active' : ''; ?>" 
                         data-screenshot="<?php echo $thumbnail; ?>"
                         data-type="image">
                        <img src="<?php echo $thumbnail; ?>" alt="Thumbnail <?php echo $index + 1; ?>">
                        <div class="thumbnail-overlay">📷</div>
                    </div>
                    <?php endforeach; ?>
                    
                    <!-- Video Thumbnail -->
                    <?php if ($has_video && $video_type === 'youtube'): ?>
                    <div class="thumbnail video-thumbnail-btn" 
                         data-video-url="<?php echo htmlspecialchars($video_url); ?>"
                         data-type="video">
                        <?php if ($video_thumbnail): ?>
                            <img src="<?php echo $video_thumbnail; ?>" alt="Video Thumbnail">
                        <?php else: ?>
                            <div class="video-thumbnail-placeholder">
                                <span class="play-icon">▶</span>
                                <span class="video-label">Video</span>
                            </div>
                        <?php endif; ?>
                        <div class="thumbnail-overlay">🎬</div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- App Info Sidebar -->
            <div class="app-info-sidebar">
                <div class="app-meta">
                    <h3>App Information</h3>
                    <div class="meta-item">
                        <strong>Category:</strong>
                        <div class="app-tags">
                            <?php displayAppTags($selected_app['tags']); ?>
                        </div>
                    </div>
                    <div class="meta-item">
                        <strong>Status:</strong>
                        <span class="status-published">Published</span>
                    </div>
                    <div class="meta-item">
                        <strong>Release Date:</strong>
                        <span>January 2024</span>
                    </div>
                    <div class="meta-item">
                        <strong>Version:</strong>
                        <span>1.0.0</span>
                    </div>
                    <div class="meta-item">
                        <strong>Size:</strong>
                        <span>85 MB</span>
                    </div>
                    <div class="meta-item">
                        <strong>Platform:</strong>
                        <span>Android, iOS, Web</span>
                    </div>
                </div>
                
                <div class="app-actions">
                    <a href="#" class="btn-primary">📥 Download App</a>
                    <a href="#" class="btn-secondary">🎮 Try Demo</a>
                    <a href="#" class="btn-secondary">⭐ Rate App</a>
                    
                    <!-- Video Button in Sidebar -->
                    <?php if ($has_video && $video_type === 'youtube'): ?>
                        <button class="btn-secondary video-sidebar-btn">
                            🎬 Watch Video Demo
                        </button>
                    <?php elseif ($has_video): ?>
                        <a href="<?php echo htmlspecialchars($video_url); ?>" class="btn-secondary" target="_blank">
                            🎬 Watch Trailer
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Download Stats -->
        <div class="download-stats">
            <h3>Download Statistics</h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">50K+</span>
                    <span class="stat-label">Total Downloads</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">4.8</span>
                    <span class="stat-label">Average Rating</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">95%</span>
                    <span class="stat-label">User Satisfaction</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1.2M</span>
                    <span class="stat-label">Active Users</span>
                </div>
            </div>
        </div>
        
        <!-- App Description -->
        <div class="app-description">
            <h3>About the App</h3>
            <p><?php echo htmlspecialchars($selected_app['description']); ?></p>
            <p>This app is developed with the latest technology to provide the best experience for users. Focusing on local needs, we present practical and easy-to-use solutions.</p>
            
            <h3>Key Features</h3>
            <ul>
                <li><strong>Intuitive Interface:</strong> User-friendly design that is easy to understand for all users</li>
                <li><strong>Performance Optimized:</strong> Runs fast and stable on various devices</li>
                <li><strong>Multi-Platform:</strong> Available for Android, iOS, and web version</li>
                <li><strong>Regular Updates:</strong> Routine updates with new features and improvements</li>
                <li><strong>Offline Support:</strong> Can be used without internet connection for certain functions</li>
                <li><strong>Guaranteed Security:</strong> User data protected with latest encryption</li>
            </ul>
            
            <h3>Technical Specifications</h3>
            <div class="tech-specs">
                <div class="tech-spec">
                    <h4>🛠️ Technology</h4>
                    <p>React Native, Node.js, MongoDB</p>
                </div>
                <div class="tech-spec">
                    <h4>📱 Minimum OS</h4>
                    <p>Android 8.0 / iOS 12.0</p>
                </div>
                <div class="tech-spec">
                    <h4>💾 Storage</h4>
                    <p>100 MB free space</p>
                </div>
                <div class="tech-spec">
                    <h4>🌐 Language</h4>
                    <p>Indonesian, English</p>
                </div>
            </div>
            
            <h3>Advantages</h3>
            <ul>
                <li>Free with no hidden costs</li>
                <li>No annoying ads</li>
                <li>24/7 customer support</li>
                <li>Active user community</li>
                <li>Complete documentation and tutorials</li>
            </ul>
        </div>
        
        <!-- Related Apps -->
        <div class="section-title" style="margin-top: 4rem;">
            <h2>Related Apps</h2>
            <p>Explore other apps from DevLokal</p>
        </div>
        <div class="showcase-grid">
            <?php 
            // Show 3 random apps except the current one
            $related_apps = array_filter($applications, function($app) use ($selected_app) {
                return $app['id'] !== $selected_app['id'] && $app['status'] === 'Published';
            });
            $related_apps = array_slice($related_apps, 0, 3);
            
            foreach ($related_apps as $app): 
                $related_image = getSafeImage($app['images']['main'], 'app');
            ?>
            <div class="app-card">
                <div class="app-image">
                    <img src="<?php echo $related_image; ?>" alt="<?php echo htmlspecialchars($app['name']); ?>">
                </div>
                <div class="app-info">
                    <h3><?php echo htmlspecialchars($app['name']); ?></h3>
                    <p><?php echo htmlspecialchars($app['description']); ?></p>
                    <div class="app-tags">
                        <?php displayAppTags($app['tags']); ?>
                    </div>
                    <a href="app-details.php?id=<?php echo $app['id']; ?>" class="btn">Details</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
// Global functions untuk switch antara image dan video
function switchToVideo(videoUrl) {
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
        
        // Update active thumbnail
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        document.querySelector('.video-thumbnail-btn').classList.add('active');
    }
}

function switchToImage() {
    const imageDisplay = document.getElementById('imageDisplay');
    const videoDisplay = document.getElementById('videoDisplay');
    
    if (imageDisplay && videoDisplay) {
        videoDisplay.classList.remove('active');
        imageDisplay.classList.add('active');
        
        // Pause video
        const iframe = videoDisplay.querySelector('iframe');
        if (iframe) {
            iframe.src = iframe.src.replace('autoplay=1', 'autoplay=0');
        }
        
        // Reset to first image thumbnail
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        document.querySelector('.thumbnail[data-type="image"]').classList.add('active');
    }
}

function openVideoInNewTab(videoUrl) {
    const watchUrl = videoUrl.replace('embed/', 'watch?v=');
    window.open(watchUrl, '_blank');
}
</script>

<?php
$content = ob_get_clean();
include 'includes/header.php';
echo $content;
include 'includes/footer.php';
?>