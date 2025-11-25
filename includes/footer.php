    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3><?php echo $company_info['name']; ?></h3>
                    <p>Local app and game developer focused on innovation and quality.</p>
                </div>
                <div class="footer-column">
                    <h3>Products</h3>
                    <ul>
                        <li><a href="index.php#showcase">Mobile Apps</a></li>
                        <li><a href="index.php#showcase">Games</a></li>
                        <li><a href="index.php#showcase">Web Apps</a></li>
                        <li><a href="index.php#showcase">Business Solutions</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Company</h3>
                    <ul>
                        <li><a href="index.php#about">About Us</a></li>
                        <li><a href="index.php#career">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact</h3>
                    <ul>
                        <li>Email: <?php echo $company_info['email']; ?></li>
                        <li>Phone: <?php echo $company_info['phone']; ?></li>
                        <li>Address: <?php echo $company_info['address']; ?></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; <?php echo getCopyrightYear(); ?> <?php echo $company_info['name']; ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Tambahkan di footer.php sebelum </body> -->
    <script src="js/script.js"></script>
    <?php if (getCurrentPage() == 'contact.php'): ?>
    <script src="js/contact.js"></script>
    <?php endif; ?>
    <?php if (getCurrentPage() == 'app-details.php'): ?>
    <script src="js/app-details.js"></script>
    <?php endif; ?>
    <?php if (getCurrentPage() == 'career.php'): ?>
    <script src="js/career.js"></script>
    <?php endif; ?>
</body>
</html>