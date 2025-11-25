<?php
// Include konfigurasi dan functions dengan path yang benar
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

$page_title = "Home";
ob_start();

// Dapatkan data yang sudah difilter
$published_apps = getPublishedApplications();
$open_jobs = getOpenJobs();
?>

<!-- Add inline CSS untuk immediate fix -->
<style>
/* Immediate fixes for showcase grid */
.showcase-grid-fix {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
    width: 100%;
}

.app-card-fix {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.app-image-fix {
    height: 220px;
    overflow: hidden;
    flex-shrink: 0;
}

.app-image-fix img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.app-info-fix {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.app-info-fix h3 {
    color: #2c3e50;
    margin-bottom: 0.8rem;
    font-size: 1.3rem;
}

.app-info-fix p {
    color: #7f8c8d;
    margin-bottom: 1.2rem;
    line-height: 1.5;
    flex-grow: 1;
}

.app-tags-fix {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1.2rem;
}

.app-tag-fix {
    background: #ecf0f1;
    color: #7f8c8d;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
}

@media (max-width: 768px) {
    .showcase-grid-fix {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}
</style>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Leading Local App & Game Developer</h1>
        <p>We create extraordinary digital experiences with authentic local touch. Explore our best works and join our passionate team.</p>
        <a href="#showcase" class="btn">View Our Works</a>
    </div>
</section>

<!-- Showcase Section -->
<section id="showcase">
    <div class="container">
        <div class="section-title">
            <h2>App & Game Showcase</h2>
            <p>Explore our collection of apps and games developed with full dedication and creativity.</p>
        </div>
        
        <?php if (empty($published_apps)): ?>
        <div class="no-apps">
            <h3>No Apps Available</h3>
            <p>Coming soon! We're working on some amazing apps and games.</p>
        </div>
        <?php else: ?>
        <!-- Using fixed CSS classes -->
        <div class="showcase-grid showcase-grid-fix">
            <?php foreach ($published_apps as $app): ?>
            <?php
                $main_image = getSafeImage($app['images']['main'], 'app');
            ?>
            <div class="app-card app-card-fix">
                <div class="app-image app-image-fix">
                    <img src="<?php echo $main_image; ?>" 
                         alt="<?php echo htmlspecialchars($app['name']); ?>" 
                         loading="lazy"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="app-image-placeholder" style="display: none;">
                        <?php echo htmlspecialchars($app['name']); ?>
                    </div>
                </div>
                <div class="app-info app-info-fix">
                    <h3><?php echo htmlspecialchars($app['name']); ?></h3>
                    <p><?php echo htmlspecialchars($app['description']); ?></p>
                    <div class="app-tags app-tags-fix">
                        <?php displayAppTags($app['tags']); ?>
                    </div>
                    <a href="app-details.php?id=<?php echo $app['id']; ?>" class="btn">View Details</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Career Section -->
<section id="career" class="career-section">
    <div class="container">
        <div class="section-title">
            <h2>Career & Recruitment</h2>
            <p>Join our dynamic team and contribute to creating impactful digital products.</p>
        </div>
        
        <?php if (empty($open_jobs)): ?>
        <div class="no-jobs">
            <h3>No Open Positions</h3>
            <p>Currently we don't have any open positions. Please check back later!</p>
            <a href="contact.php" class="btn">Contact Us</a>
        </div>
        <?php else: ?>
        <div class="career-grid">
            <?php displayJobOpenings($open_jobs); ?>
        </div>
        <div style="text-align: center; margin-top: 2rem;">
            <a href="career.php" class="btn">View All Career Opportunities</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
// JavaScript untuk handle image errors
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.app-image img');
    images.forEach(img => {
        img.addEventListener('error', function() {
            this.style.display = 'none';
            const placeholder = this.nextElementSibling;
            if (placeholder && placeholder.classList.contains('app-image-placeholder')) {
                placeholder.style.display = 'flex';
            }
        });
        
        // Check if image loaded successfully
        img.addEventListener('load', function() {
            const placeholder = this.nextElementSibling;
            if (placeholder && placeholder.classList.contains('app-image-placeholder')) {
                placeholder.style.display = 'none';
            }
        });
    });
});
</script>

<?php
$content = ob_get_clean();
include 'includes/header.php';
echo $content;
include 'includes/footer.php';
?>