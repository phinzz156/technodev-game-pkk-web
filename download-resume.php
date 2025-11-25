<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

if (isset($_GET['file'])) {
    $filename = basename($_GET['file']);
    $file_path = DATA_PATH . 'resumes/' . $filename;
    
    if (file_exists($file_path)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    }
}

header('HTTP/1.0 404 Not Found');
echo 'File not found.';
?>