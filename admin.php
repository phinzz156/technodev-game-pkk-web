<?php
// Start session di paling atas
session_start();

// Include konfigurasi dan functions
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

// Simple authentication (in real app, use proper authentication)
$admin_password = 'admin123'; // Change this in production
$is_authenticated = false;

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    $is_authenticated = true;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if ($_POST['password'] === $admin_password) {
        $is_authenticated = true;
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_login_time'] = time();
    } else {
        $login_error = 'Invalid password!';
    }
}

// Handle actions (only if authenticated)
if ($is_authenticated && isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'update_status':
            if (isset($_GET['id']) && isset($_GET['status'])) {
                updateApplicationStatus($_GET['id'], $_GET['status']);
            }
            header('Location: admin.php');
            exit;
            
        case 'delete':
            if (isset($_GET['id'])) {
                deleteApplication($_GET['id']);
            }
            header('Location: admin.php');
            exit;
            
        case 'logout':
            session_destroy();
            header('Location: admin.php');
            exit;
    }
}

$page_title = "Admin - Career Applications";
ob_start();
?>

<?php if (!$is_authenticated): ?>
<!-- Login Form -->
<section class="hero">
    <div class="container">
        <div class="admin-login">
            <h1>Admin Login</h1>
            
            <?php if (isset($login_error)): ?>
            <div class="form-error" style="margin-bottom: 1rem;">
                <?php echo $login_error; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" class="admin-login-form">
                <div class="form-group">
                    <label for="password">Admin Password</label>
                    <input type="password" id="password" name="password" required 
                           placeholder="Enter admin password">
                </div>
                <button type="submit" class="btn">Login</button>
                
                <div style="margin-top: 1rem; font-size: 0.9rem; color: #666;">
                    <strong>Default password:</strong> admin123
                </div>
            </form>
        </div>
    </div>
</section>
<?php else: ?>
<!-- Admin Dashboard -->
<section class="hero admin-hero">
    <div class="container">
        <div class="admin-header">
            <h1>Career Applications Management</h1>
            <div class="admin-actions">
                <span style="margin-right: 1rem; color: white;">
                    Logged in as Admin
                </span>
                <a href="admin.php?action=logout" class="btn secondary" 
                   onclick="return confirm('Are you sure you want to logout?')">
                    Logout
                </a>
            </div>
        </div>
    </div>
</section>

<section class="admin-content">
    <div class="container">
        <!-- Statistics -->
        <div class="admin-stats">
            <?php
            $all_applications = getAllApplications();
            $new_applications = getApplicationsByStatus('new');
            $reviewed_applications = getApplicationsByStatus('reviewed');
            $accepted_applications = getApplicationsByStatus('accepted');
            $rejected_applications = getApplicationsByStatus('rejected');
            ?>
            <div class="stat-cards">
                <div class="stat-card total">
                    <div class="stat-number"><?php echo count($all_applications); ?></div>
                    <div class="stat-label">Total Applications</div>
                </div>
                <div class="stat-card new">
                    <div class="stat-number"><?php echo count($new_applications); ?></div>
                    <div class="stat-label">New</div>
                </div>
                <div class="stat-card reviewed">
                    <div class="stat-number"><?php echo count($reviewed_applications); ?></div>
                    <div class="stat-label">Reviewed</div>
                </div>
                <div class="stat-card accepted">
                    <div class="stat-number"><?php echo count($accepted_applications); ?></div>
                    <div class="stat-label">Accepted</div>
                </div>
                <div class="stat-card rejected">
                    <div class="stat-number"><?php echo count($rejected_applications); ?></div>
                    <div class="stat-label">Rejected</div>
                </div>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="applications-table-container">
            <?php if (empty($all_applications)): ?>
            <div class="no-data">
                <h3>No Applications Yet</h3>
                <p>No career applications have been submitted yet.</p>
            </div>
            <?php else: ?>
            <table class="applications-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Contact</th>
                        <th>Experience</th>
                        <th>Submitted</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_reverse($all_applications) as $application): ?>
                    <tr class="status-<?php echo $application['status']; ?>">
                        <td>
                            <strong><?php echo htmlspecialchars($application['name']); ?></strong>
                            <?php if (!empty($application['portfolio'])): ?>
                            <br>
                            <small>
                                <a href="<?php echo htmlspecialchars($application['portfolio']); ?>" 
                                   target="_blank" style="color: #666;">
                                   📁 Portfolio
                                </a>
                            </small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($application['position']); ?></td>
                        <td>
                            <div>
                                <a href="mailto:<?php echo htmlspecialchars($application['email']); ?>">
                                    📧 <?php echo htmlspecialchars($application['email']); ?>
                                </a>
                            </div>
                            <?php if (!empty($application['phone'])): ?>
                            <div>
                                <small>📞 <?php echo htmlspecialchars($application['phone']); ?></small>
                            </div>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($application['experience']); ?></td>
                        <td>
                            <div><?php echo date('M j, Y', strtotime($application['submitted_at'])); ?></div>
                            <small><?php echo date('H:i', strtotime($application['submitted_at'])); ?></small>
                        </td>
                        <td>
                            <span class="status-badge status-<?php echo $application['status']; ?>">
                                <?php echo ucfirst($application['status']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <!-- View Details -->
                                <button class="btn-small view-details" 
                                        data-app-id="<?php echo $application['id']; ?>"
                                        data-app-name="<?php echo htmlspecialchars($application['name']); ?>"
                                        data-app-email="<?php echo htmlspecialchars($application['email']); ?>"
                                        data-app-phone="<?php echo htmlspecialchars($application['phone']); ?>"
                                        data-app-position="<?php echo htmlspecialchars($application['position']); ?>"
                                        data-app-experience="<?php echo htmlspecialchars($application['experience']); ?>"
                                        data-app-portfolio="<?php echo htmlspecialchars($application['portfolio']); ?>"
                                        data-app-message="<?php echo htmlspecialchars($application['message']); ?>"
                                        data-app-submitted="<?php echo $application['submitted_at']; ?>"
                                        data-app-status="<?php echo $application['status']; ?>">
                                    👁️ View
                                </button>
                                
                                <!-- Status Actions -->
                                <?php if ($application['status'] === 'new'): ?>
                                <a href="admin.php?action=update_status&id=<?php echo $application['id']; ?>&status=reviewed" 
                                   class="btn-small btn-warning">
                                    📋 Review
                                </a>
                                <?php endif; ?>
                                
                                <?php if ($application['status'] === 'reviewed'): ?>
                                <a href="admin.php?action=update_status&id=<?php echo $application['id']; ?>&status=accepted" 
                                   class="btn-small btn-success">
                                    ✅ Accept
                                </a>
                                <a href="admin.php?action=update_status&id=<?php echo $application['id']; ?>&status=rejected" 
                                   class="btn-small btn-danger">
                                    ❌ Reject
                                </a>
                                <?php endif; ?>
                                
                                <!-- Download Resume -->
                                <?php if (!empty($application['resume_filename'])): ?>
                                <a href="download-resume.php?file=<?php echo urlencode($application['resume_filename']); ?>" 
                                   class="btn-small btn-info" 
                                   target="_blank">
                                    📄 CV
                                </a>
                                <?php endif; ?>
                                
                                <!-- Delete -->
                                <a href="admin.php?action=delete&id=<?php echo $application['id']; ?>" 
                                   class="btn-small btn-danger" 
                                   onclick="return confirm('Are you sure you want to delete <?php echo htmlspecialchars($application['name']); ?>\'s application?')">
                                    🗑️ Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Application Details Modal -->
<div id="applicationModal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <div id="applicationDetails">
            <!-- Details will be loaded here -->
        </div>
    </div>
</div>

<!-- Include JavaScript -->
<script src="js/admin.js"></script>

<?php endif; ?>

<?php
$content = ob_get_clean();
include 'includes/header.php';
echo $content;
include 'includes/footer.php';
?>