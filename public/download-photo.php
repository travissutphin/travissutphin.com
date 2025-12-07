<?php
// Stock photo download handler with tracking
require_once '../config.php';

// Get photo ID from query string
$photo_id = $_GET['id'] ?? '';

// Validate photo ID (alphanumeric and hyphens only)
if (empty($photo_id) || !preg_match('/^[a-z0-9-]+$/', $photo_id)) {
    http_response_code(400);
    die('Invalid photo ID');
}

// Load photos data to get file path
$photos_json = file_get_contents(__DIR__ . '/../content/data/free-stock-photos.json');
$photos_data = json_decode($photos_json, true);
$photos = $photos_data['photos'] ?? [];

// Find the photo
$photo = null;
foreach ($photos as $p) {
    if ($p['id'] === $photo_id) {
        $photo = $p;
        break;
    }
}

if (!$photo) {
    http_response_code(404);
    die('Photo not found');
}

// Build file path
$file_path = __DIR__ . $photo['download'];

// Verify file exists
if (!file_exists($file_path)) {
    http_response_code(404);
    die('File not found');
}

// Track the download
$stats_file = __DIR__ . '/../content/data/download-stats.json';

// Load existing stats
if (file_exists($stats_file)) {
    $stats = json_decode(file_get_contents($stats_file), true);
} else {
    $stats = ['downloads' => []];
}

// Initialize photos section if not exists
if (!isset($stats['photo_downloads'])) {
    $stats['photo_downloads'] = [];
}

// Add download record
if (!isset($stats['photo_downloads'][$photo_id])) {
    $stats['photo_downloads'][$photo_id] = [
        'total' => 0,
        'first_download' => date('c'),
        'last_download' => date('c')
    ];
}

$stats['photo_downloads'][$photo_id]['total']++;
$stats['photo_downloads'][$photo_id]['last_download'] = date('c');

// Save stats
file_put_contents($stats_file, json_encode($stats, JSON_PRETTY_PRINT));

// Determine content type based on format
$content_type = 'image/png';
if (strtolower($photo['format']) === 'jpg' || strtolower($photo['format']) === 'jpeg') {
    $content_type = 'image/jpeg';
}

// Serve the file
header('Content-Type: ' . $content_type);
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
header('Content-Length: ' . filesize($file_path));
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');

// Output file
readfile($file_path);
exit;
