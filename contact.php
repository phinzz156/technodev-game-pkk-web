<?php
// Di SEMUA file (index.php, contact.php, app-details.php) gunakan:
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

$page_title = "Contact";
ob_start();
?>

<!-- Hero Section -->
<section class="hero contact-hero">
    <div class="container">
        <h1>Contact Us</h1>
        <p>We're happy to hear from you. Let's collaborate and bring your digital ideas to life with us.</p>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="contact-container">
            <!-- Contact Info -->
            <div class="contact-info">
                <h2>Contact Information</h2>
                <p>Feel free to contact us through various available channels.</p>
                
                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="contact-icon">📧</div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p><?php echo htmlspecialchars($company_info['email']); ?></p>
                            <p>support@devlokal.id</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">📞</div>
                        <div class="contact-details">
                            <h3>Phone</h3>
                            <p><?php echo htmlspecialchars($company_info['phone']); ?></p>
                            <p>+62 812 3456 7890</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">📍</div>
                        <div class="contact-details">
                            <h3>Address</h3>
                            <p>Digital Street No. 123</p>
                            <p>South Jakarta, 12345</p>
                            <p>Indonesia</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">🕒</div>
                        <div class="contact-details">
                            <h3>Business Hours</h3>
                            <p><?php echo htmlspecialchars($company_info['working_hours']); ?></p>
                            <p>Saturday: 09:00 - 14:00</p>
                        </div>
                    </div>
                </div>
                
                <div class="social-links">
                    <h3>Follow Us</h3>
                    <div class="social-icons">
                        <a href="#" class="social-icon">📘</a>
                        <a href="#" class="social-icon">🐦</a>
                        <a href="#" class="social-icon">📷</a>
                        <a href="#" class="social-icon">💼</a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="contact-form-container">
                <h2>Send Message</h2>
                <form class="contact-form" id="contactForm" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject" required>
                            <option value="">Select subject...</option>
                            <option value="development">App/Game Development</option>
                            <option value="partnership">Business Partnership</option>
                            <option value="career">Job Opportunity</option>
                            <option value="support">Technical Support</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn submit-btn">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="section-title">
            <h2>Frequently Asked Questions</h2>
            <p>Here are some questions frequently asked to us.</p>
        </div>
        
        <div class="faq-container">
            <?php
            $faqs = [
                [
                    'question' => 'How long does app development take?',
                    'answer' => 'Development time varies depending on project complexity. For simple apps usually 2-3 months, while complex apps can take 6-12 months.'
                ],
                [
                    'question' => 'Do you accept custom projects?',
                    'answer' => 'Yes, we specialize in custom development. We will analyze your needs and provide the right solution.'
                ],
                [
                    'question' => 'What is the maintenance process after launch?',
                    'answer' => 'We provide maintenance packages with various options, including regular updates, bug fixes, and 24/7 technical support.'
                ],
                [
                    'question' => 'Do you work remotely?',
                    'answer' => 'Yes, we have an experienced team that works remotely and can collaborate effectively with clients from various locations.'
                ]
            ];
            
            foreach ($faqs as $index => $faq):
            ?>
            <div class="faq-item">
                <div class="faq-question">
                    <h3><?php echo htmlspecialchars($faq['question']); ?></h3>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">
                    <p><?php echo htmlspecialchars($faq['answer']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <h2>Our Location</h2>
        <div class="map-placeholder">
            <div class="map-content">
                <h3>DevLokal Office</h3>
                <p>Digital Street No. 123, South Jakarta</p>
                <p>Indonesia, 12345</p>
                <div class="map-actions">
                    <button class="btn">Get Directions</button>
                    <button class="btn secondary">View Street View</button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
include 'includes/header.php';
echo $content;
include 'includes/footer.php';
?>