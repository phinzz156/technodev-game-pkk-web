<?php
// Cek apakah sudah di-include untuk avoid duplicate declaration
if (!defined('DEVLOCAL_CONFIG_LOADED')) {
    define('DEVLOCAL_CONFIG_LOADED', true);
    
    // Include konfigurasi dan functions dengan include_once
    include_once __DIR__ . '/config.php';
    include_once __DIR__ . '/functions.php';
}

// Set default page title jika tidak ada
if (!isset($page_title)) {
    $page_title = SITE_NAME . ' - ' . SITE_DESCRIPTION;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="styles/style.css">
    <?php if (getCurrentPage() == 'contact.php'): ?>
    <link rel="stylesheet" href="styles/contact.css">
    <?php endif; ?>
    <?php if (getCurrentPage() == 'app-details.php'): ?>
    <link rel="stylesheet" href="styles/app-details.css">
    <?php endif; ?>
    <?php if (getCurrentPage() == 'career.php'): ?>
    <link rel="stylesheet" href="styles/career.css">
    <?php endif; ?>
    <?php if (getCurrentPage() == 'admin.php'): ?>
    <link rel="stylesheet" href="styles/admin.css">
    <?php endif; ?>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container nav-container">
            <a href="index.php" class="logo">Game<span>Stum</span></a>
            <button class="mobile-menu-btn">☰</button>
            <nav>
                <ul id="nav-menu">
                    <li><a href="index.php" class="<?php echo isActivePage('index.php'); ?>">Home</a></li>
                    <li><a href="index.php#showcase" class="<?php echo (getCurrentPage() == 'index.php') ? '' : ''; ?>">Showcase</a></li>
                    <li><a href="career.php" class="<?php echo isActivePage('career.php'); ?>">Careers</a></li>
                    <li><a href="contact.php" class="<?php echo isActivePage('contact.php'); ?>">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>