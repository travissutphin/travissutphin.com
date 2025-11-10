<?php
// Template download handler with tracking
require_once '../config.php';

// Get template ID from query string
$template_id = $_GET['id'] ?? '';

// Validate template ID (alphanumeric and hyphens only)
if (empty($template_id) || !preg_match('/^[a-z0-9-]+$/', $template_id)) {
    http_response_code(400);
    die('Invalid template ID');
}

// Load templates data to get file path
$templates_json = file_get_contents(__DIR__ . '/../content/data/free-templates.json');
$templates_data = json_decode($templates_json, true);
$templates = $templates_data['templates'] ?? [];

// Find the template
$template = null;
foreach ($templates as $t) {
    if ($t['id'] === $template_id) {
        $template = $t;
        break;
    }
}

if (!$template) {
    http_response_code(404);
    die('Template not found');
}

// Build file path
$file_path = __DIR__ . $template['download_url'];

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

// Add download record
if (!isset($stats['downloads'][$template_id])) {
    $stats['downloads'][$template_id] = [
        'total' => 0,
        'first_download' => date('c'),
        'last_download' => date('c')
    ];
}

$stats['downloads'][$template_id]['total']++;
$stats['downloads'][$template_id]['last_download'] = date('c');

// Save stats
file_put_contents($stats_file, json_encode($stats, JSON_PRETTY_PRINT));

// Serve the file
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
header('Content-Length: ' . filesize($file_path));
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');

// Output file
readfile($file_path);
exit;
