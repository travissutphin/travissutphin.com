<?php
// Main router file
require_once '../config.php';
require_once '../lib/functions.php';

// Get the request URI
$request_uri = $_SERVER['REQUEST_URI'];
$request_uri = strtok($request_uri, '?'); // Remove query string

// Remove the base path (/myPersonalSite/public)
$base_path = '/myPersonalSite/public';
if (strpos($request_uri, $base_path) === 0) {
    $request_uri = substr($request_uri, strlen($base_path));
}

$request_uri = rtrim($request_uri, '/'); // Remove trailing slash

// Default to home if empty
if (empty($request_uri) || $request_uri === '/') {
    $request_uri = '/home';
}

// Remove leading slash for route matching
$route = ltrim($request_uri, '/');

// Define available routes
$routes = [
    'home' => 'home.php',
    'services' => 'services.php',
    'projects' => 'projects.php',
    'team' => 'team.php',
    'contact' => 'contact.php',
    'blog' => 'blog-list.php',
    'admin' => '../admin.php'
];

// Check if route starts with 'blog/' for individual blog posts
if (strpos($route, 'blog/') === 0) {
    $slug = substr($route, 5); // Remove 'blog/' prefix
    render_blog_post($slug);
    exit;
}

// Handle admin route specially
if ($route === 'admin') {
    require_once '../admin.php';
    exit;
}

// Check if route exists
if (array_key_exists($route, $routes)) {
    $template = $routes[$route];

    // Load page data if JSON exists
    $json_file = "../content/pages/{$route}.json";
    $page_data = [];

    if (file_exists($json_file)) {
        $page_data = json_decode(file_get_contents($json_file), true);
    }

    // Render the page
    render_page($template, $page_data);
} else {
    // 404 page
    http_response_code(404);
    render_page('404.php', ['title' => 'Page Not Found']);
}