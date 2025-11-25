<?php
// Include konfigurasi dan functions dengan path yang benar
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

$page_title = "Careers";
ob_start();

// Get open jobs
$open_jobs = getOpenJobs();

// Handle form submission
$form_success = false;
$form_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $position = htmlspecialchars($_POST['position'] ?? '');
    $experience = htmlspecialchars($_POST['experience'] ?? '');
    $portfolio = htmlspecialchars($_POST['portfolio'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    
    // Handle file upload
    $resume_filename = '';
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $file_type = $_FILES['resume']['type'];
        $file_size = $_FILES['resume']['size'];
        $max_size = 5 * 1024 * 1024; // 5MB
        
        if (in_array($file_type, $allowed_types) && $file_size <= $max_size) {
            $file_extension = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
            $resume_filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $name) . '.' . $file_extension;
            $upload_path = DATA_PATH . 'resumes/' . $resume_filename;
            
            // Create resumes directory if not exists
            if (!is_dir(DATA_PATH . 'resumes')) {
                mkdir(DATA_PATH . 'resumes', 0755, true);
            }
            
            move_uploaded_file($_FILES['resume']['tmp_name'], $upload_path);
        }
    }
    
    // Basic validation
    if (empty($name) || empty($email) || empty($position) || empty($experience) || empty($message)) {
        $form_error = 'Please fill in all required fields.';
    } elseif (empty($resume_filename)) {
        $form_error = 'Please upload a valid resume file (PDF, DOC, DOCX, max 5MB).';
    } else {
        // Prepare application data
        $application_data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'position' => $position,
            'experience' => $experience,
            'portfolio' => $portfolio,
            'message' => $message,
            'resume_filename' => $resume_filename,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ];
        
        // Save to JSON file
        if (saveApplication($application_data)) {
            $form_success = true;
            
            // In real application, you might want to send email notification here
            // sendEmailNotification($application_data);
        } else {
            $form_error = 'Sorry, there was an error submitting your application. Please try again.';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulate form processing
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $position = htmlspecialchars($_POST['position'] ?? '');
    $experience = htmlspecialchars($_POST['experience'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    
    // Basic validation
    if (empty($name) || empty($email) || empty($position)) {
        $form_error = 'Please fill in all required fields.';
    } else {
        // Simulate successful submission
        $form_success = true;
        
        // In real application, you would:
        // 1. Save to database
        // 2. Send email notification
        // 3. Process uploaded files
    }
}
?>

<!-- Hero Section -->
<section class="hero career-hero">
    <div class="container">
        <h1>Join Our Team</h1>
        <p>Build amazing digital products with talented people. Grow your career and make an impact with DevLokal.</p>
    </div>
</section>

<!-- Breadcrumb -->
<section class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-content">
            <a href="index.php">Home</a>
            <span>></span>
            <span>Careers</span>
        </div>
    </div>
</section>

<!-- Career Content -->
<section class="career-content">
    <div class="container">
        <div class="career-layout">
            <!-- Job Listings -->
            <div class="job-listings">
                <div class="section-title">
                    <h2>Open Positions</h2>
                    <p>Explore our current job openings and find the perfect role for you.</p>
                </div>

                <?php if (empty($open_jobs)): ?>
                <div class="no-jobs">
                    <h3>No Open Positions</h3>
                    <p>We don't have any open positions at the moment. Please check back later or send us your resume for future opportunities.</p>
                    <a href="#application-form" class="btn">Submit General Application</a>
                </div>
                <?php else: ?>
                <div class="jobs-grid">
                    <?php foreach ($open_jobs as $job): ?>
                    <div class="job-listing-card" data-position="<?php echo htmlspecialchars($job['title']); ?>">
                        <div class="job-header">
                            <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                            <span class="job-type"><?php echo htmlspecialchars($job['type']); ?></span>
                        </div>
                        
                        <div class="job-details">
                            <div class="job-detail">
                                <span class="detail-icon">📍</span>
                                <span><?php echo htmlspecialchars($job['location']); ?></span>
                            </div>
                            <div class="job-detail">
                                <span class="detail-icon">💼</span>
                                <span><?php echo htmlspecialchars($job['experience']); ?></span>
                            </div>
                        </div>
                        
                        <div class="job-description">
                            <p><?php echo htmlspecialchars($job['description']); ?></p>
                        </div>
                        
                        <div class="job-actions">
                            <button class="btn apply-now-btn" data-job="<?php echo htmlspecialchars($job['title']); ?>">
                                Apply Now
                            </button>
                            <button class="btn-secondary view-details-btn" data-job-id="<?php echo $job['id']; ?>">
                                View Details
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Why Join Us Section -->
                <div class="why-join-section">
                    <div class="section-title">
                        <h2>Why Join DevLokal?</h2>
                        <p>We offer more than just a job - we offer a career path and a great work environment.</p>
                    </div>
                    
                    <div class="benefits-grid">
                        <div class="benefit-card">
                            <div class="benefit-icon">💼</div>
                            <h4>Competitive Salary</h4>
                            <p>We offer competitive compensation packages with performance bonuses.</p>
                        </div>
                        
                        <div class="benefit-card">
                            <div class="benefit-icon">🏠</div>
                            <h4>Flexible Work</h4>
                            <p>Hybrid work model with remote options and flexible working hours.</p>
                        </div>
                        
                        <div class="benefit-card">
                            <div class="benefit-icon">📚</div>
                            <h4>Learning & Growth</h4>
                            <p>Regular training, workshops, and conference attendance opportunities.</p>
                        </div>
                        
                        <div class="benefit-card">
                            <div class="benefit-icon">🏥</div>
                            <h4>Health Benefits</h4>
                            <p>Comprehensive health insurance and wellness programs.</p>
                        </div>
                        
                        <div class="benefit-card">
                            <div class="benefit-icon">🎯</div>
                            <h4>Career Path</h4>
                            <p>Clear career progression and promotion opportunities.</p>
                        </div>
                        
                        <div class="benefit-card">
                            <div class="benefit-icon">👥</div>
                            <h4>Great Team</h4>
                            <p>Work with talented, passionate people in a collaborative environment.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Form -->
            <div class="application-sidebar" id="application-form">
                <div class="application-form-container">
                    <h2>Apply Now</h2>
                    
                    <?php if ($form_success): ?>
                    <div class="form-success">
                        <div class="success-icon">✓</div>
                        <h3>Application Submitted!</h3>
                        <p>Thank you for your interest in joining DevLokal. We've received your application and will review it shortly.</p>
                        <a href="career.php" class="btn">Apply for Another Position</a>
                    </div>
                    <?php else: ?>
                    
                    <?php if ($form_error): ?>
                    <div class="form-error">
                        <?php echo $form_error; ?>
                    </div>
                    <?php endif; ?>

                    <form class="application-form" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="position">Position Applied For *</label>
                            <select id="position" name="position" required>
                                <option value="">Select a position...</option>
                                <?php foreach ($open_jobs as $job): ?>
                                <option value="<?php echo htmlspecialchars($job['title']); ?>">
                                    <?php echo htmlspecialchars($job['title']); ?>
                                </option>
                                <?php endforeach; ?>
                                <option value="Other">Other (Specify in message)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="experience">Years of Experience *</label>
                            <select id="experience" name="experience" required>
                                <option value="">Select experience...</option>
                                <option value="0-1">0-1 years</option>
                                <option value="1-3">1-3 years</option>
                                <option value="3-5">3-5 years</option>
                                <option value="5-8">5-8 years</option>
                                <option value="8+">8+ years</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="resume">Upload Resume (PDF, DOC, DOCX) *</label>
                            <div class="file-upload">
                                <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                                <label for="resume" class="file-upload-label">
                                    <span class="file-upload-icon">📄</span>
                                    <span class="file-upload-text">Choose file</span>
                                </label>
                                <span class="file-name">No file chosen</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="portfolio">Portfolio Link (Optional)</label>
                            <input type="url" id="portfolio" name="portfolio" placeholder="https://">
                        </div>

                        <div class="form-group">
                            <label for="message">Cover Letter *</label>
                            <textarea id="message" name="message" rows="5" placeholder="Tell us why you're interested in this position and what makes you a great fit..." required></textarea>
                        </div>

                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="agree" name="agree" required>
                            <label for="agree">
                                I agree to the processing of my personal data according to the 
                                <a href="#" target="_blank">Privacy Policy</a> *
                            </label>
                        </div>

                        <button type="submit" class="btn submit-btn">Submit Application</button>
                    </form>
                    <?php endif; ?>
                </div>

                <!-- Quick Info -->
                <div class application-sidebar-info">
                    <h3>Application Process</h3>
                    <div class="process-steps">
                        <div class="process-step">
                            <span class="step-number">1</span>
                            <div class="step-content">
                                <h4>Submit Application</h4>
                                <p>Fill out the form and upload your resume</p>
                            </div>
                        </div>
                        <div class="process-step">
                            <span class="step-number">2</span>
                            <div class="step-content">
                                <h4>Review</h4>
                                <p>Our team will review your application</p>
                            </div>
                        </div>
                        <div class="process-step">
                            <span class="step-number">3</span>
                            <div class="step-content">
                                <h4>Interview</h4>
                                <p>Phone screening and technical interview</p>
                            </div>
                        </div>
                        <div class="process-step">
                            <span class="step-number">4</span>
                            <div class="step-content">
                                <h4>Offer</h4>
                                <p>Job offer and onboarding process</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-info">
                        <h3>Questions?</h3>
                        <p>Contact our HR team:</p>
                        <div class="contact-detail">
                            <span class="contact-icon">📧</span>
                            <span>careers@devlokal.id</span>
                        </div>
                        <div class="contact-detail">
                            <span class="contact-icon">📞</span>
                            <span>+62 21 1234 5678</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Job Modal -->
<div id="jobModal" class="job-modal">
    <div class="job-modal-content">
        <span class="job-modal-close">&times;</span>
        <div id="jobModalContent">
            <!-- Job details will be loaded here -->
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'includes/header.php';
echo $content;
include 'includes/footer.php';
?>