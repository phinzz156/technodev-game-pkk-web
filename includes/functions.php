<?php
// Fungsi helper untuk website

function getCurrentPage() {
    $current_page = basename($_SERVER['PHP_SELF']);
    return $current_page;
}

function isActivePage($page_name) {
    $current_page = getCurrentPage();
    return ($current_page == $page_name) ? 'active' : '';
}

function displayAppTags($tags) {
    if (is_array($tags) && !empty($tags)) {
        foreach ($tags as $tag) {
            echo '<span class="app-tag">' . htmlspecialchars($tag) . '</span>';
        }
    }
}

function displayJobDetails($job) {
    if (is_array($job)) {
        echo '
        <div class="job-detail">
            <i>📍</i> <span>' . htmlspecialchars($job['location']) . '</span>
        </div>
        <div class="job-detail">
            <i>⏱️</i> <span>' . htmlspecialchars($job['type']) . '</span>
        </div>
        <div class="job-detail">
            <i>💼</i> <span>' . htmlspecialchars($job['experience']) . '</span>
        </div>';
    }
}

// Fungsi untuk mendapatkan tahun copyright dinamis
function getCopyrightYear() {
    return date('Y');
}

// Fungsi untuk mendapatkan gambar dengan fallback
function getSafeImage($image_url, $default_type = 'app') {
    $default_images = [
        'app' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800&h=600&fit=crop',
        'game' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=800&h=600&fit=crop',
        'web' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop'
    ];
    
    return !empty($image_url) ? $image_url : $default_images[$default_type];
}

// Fungsi untuk mendapatkan published applications
function getPublishedApplications() {
    global $applications;
    return array_filter($applications, function($app) {
        return $app['status'] === 'Published';
    });
}

// Fungsi untuk mendapatkan open jobs
function getOpenJobs() {
    global $job_openings;
    return array_filter($job_openings, function($job) {
        return $job['status'] === 'open';
    });
}

// Fungsi untuk menampilkan aplikasi dengan gambar external - IMPROVED
function displayApplications($applications) {
    if (empty($applications)) {
        echo '<div class="no-apps">
                <h3>No Apps Available</h3>
                <p>Coming soon! We\'re working on some amazing apps and games.</p>
              </div>';
        return;
    }
    
    foreach ($applications as $app) {
        $main_image = getSafeImage($app['images']['main'], 'app');
        
        echo '
        <div class="app-card">
            <div class="app-image">
                <img src="' . $main_image . '" 
                     alt="' . htmlspecialchars($app['name']) . '" 
                     loading="lazy"
                     onerror="handleImageError(this)">
                <div class="app-image-placeholder" style="display: none;">
                    ' . htmlspecialchars($app['name']) . '
                </div>
            </div>
            <div class="app-info">
                <h3>' . htmlspecialchars($app['name']) . '</h3>
                <p>' . htmlspecialchars($app['description']) . '</p>
                <div class="app-tags">';
        
        displayAppTags($app['tags']);
        
        echo '</div>
                <a href="app-details.php?id=' . $app['id'] . '" class="btn">View Details</a>
            </div>
        </div>';
    }
    
    // Add JavaScript for image error handling
    echo '
    <script>
    function handleImageError(img) {
        img.style.display = "none";
        const placeholder = img.nextElementSibling;
        if (placeholder && placeholder.classList.contains("app-image-placeholder")) {
            placeholder.style.display = "flex";
        }
    }
    </script>';
}

// Fungsi untuk menampilkan lowongan kerja
function displayJobOpenings($jobs) {
    if (empty($jobs)) {
        echo '<div class="no-jobs">
                <p>No job openings available.</p>
              </div>';
        return;
    }
    
    foreach ($jobs as $job) {
        echo '
        <div class="job-card">
            <h3>' . htmlspecialchars($job['title']) . '</h3>
            <div class="job-details">';
        
        displayJobDetails($job);
        
        echo '</div>
            <div class="job-description">
                <p>' . htmlspecialchars($job['description']) . '</p>
            </div>
            <button class="apply-btn" data-job="' . htmlspecialchars($job['title']) . '">Apply for this Position</button>
        </div>';
    }
}

// Fungsi untuk menyimpan application ke JSON
function saveApplication($application_data) {
    $file_path = DATA_PATH . 'applications.json';
    
    // Baca data existing
    $applications = [];
    if (file_exists($file_path)) {
        $json_data = file_get_contents($file_path);
        $applications = json_decode($json_data, true) ?: [];
    }
    
    // Add new application
    $application_data['id'] = uniqid();
    $application_data['submitted_at'] = date('Y-m-d H:i:s');
    $application_data['status'] = 'new';
    
    $applications[] = $application_data;
    
    // Simpan ke file
    $result = file_put_contents($file_path, json_encode($applications, JSON_PRETTY_PRINT));
    return $result !== false;
}

// Fungsi untuk membaca semua applications
function getAllApplications() {
    $file_path = DATA_PATH . 'applications.json';
    
    if (!file_exists($file_path)) {
        return [];
    }
    
    $json_data = file_get_contents($file_path);
    return json_decode($json_data, true) ?: [];
}

// Fungsi untuk mendapatkan applications by status
function getApplicationsByStatus($status) {
    $applications = getAllApplications();
    return array_filter($applications, function($app) use ($status) {
        return $app['status'] === $status;
    });
}

// Fungsi untuk update application status
function updateApplicationStatus($application_id, $status) {
    $file_path = DATA_PATH . 'applications.json';
    $applications = getAllApplications();
    
    foreach ($applications as &$app) {
        if ($app['id'] === $application_id) {
            $app['status'] = $status;
            $app['updated_at'] = date('Y-m-d H:i:s');
            break;
        }
    }
    
    return file_put_contents($file_path, json_encode($applications, JSON_PRETTY_PRINT)) !== false;
}

// Fungsi untuk menghapus application
function deleteApplication($application_id) {
    $file_path = DATA_PATH . 'applications.json';
    $applications = getAllApplications();
    
    $applications = array_filter($applications, function($app) use ($application_id) {
        return $app['id'] !== $application_id;
    });
    
    return file_put_contents($file_path, json_encode(array_values($applications), JSON_PRETTY_PRINT)) !== false;
}
?>