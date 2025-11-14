<?php
// Main router file
require_once '../config.php';
require_once '../lib/functions.php';

// Enforce HTTPS in production
enforce_https();

// Get the request URI
$request_uri = $_SERVER['REQUEST_URI'];
$request_uri = strtok($request_uri, '?'); // Remove query string

// Remove the base path dynamically
if (defined('BASE_PATH') && !empty(BASE_PATH)) {
    if (strpos($request_uri, BASE_PATH) === 0) {
        $request_uri = substr($request_uri, strlen(BASE_PATH));
    }
}

$request_uri = rtrim($request_uri, '/'); // Remove trailing slash

// Default to home if empty
if (empty($request_uri) || $request_uri === '/') {
    $request_uri = '/home';
}

// Remove leading slash for route matching
$route = ltrim($request_uri, '/');

// Handle URL redirects (301 permanent redirects for SEO)
$redirects = [
    'how-we-do-anything-is-how-we-do-everything' => '/blog/2025-06-26-how-we-do-anything-is-how-we-do-everything',
    'travis-sutphin-resume' => '/resume',
    'learn-by-reading-master-by-doing' => '/blog/2025-01-25-learn-by-reading-master-by-doing',
    'standard-naming-conventions-stop-file-chaos' => '/blog/2025-04-22-standard-naming-conventions-stop-file-chaos',
    'ai-and-tech' => '/resume',
];

if (isset($redirects[$route])) {
    header('Location: ' . SITE_URL . $redirects[$route], true, 301);
    exit;
}

// Define available routes
$routes = [
    'home' => 'home.php',
    'services' => 'services.php',
    'get-time-back' => 'get-time-back.php',
    'projects' => 'projects.php',
    'team' => 'team.php',
    'contact' => 'contact.php',
    'resume' => 'resume.php',
    'blog' => 'blog-list.php',
    'blog-demo' => 'blog-demo.php',
    'case-studies' => 'case-study-list.php'
];

// Check for blog category routes: /blog/category/[category-slug]
if (preg_match('#^blog/category/([a-z0-9-]+)$#', $route, $matches)) {
    $category_slug = $matches[1];

    // Map category slugs to display names
    $category_map = [
        'ai-automation' => 'AI & Automation',
        'project-management' => 'Project Management',
        'productivity-systems' => 'Productivity & Systems',
        'technical-leadership' => 'Technical Leadership',
        'business-strategy' => 'Business & Strategy',
        'learning-development' => 'Learning & Development'
    ];

    if (isset($category_map[$category_slug])) {
        // Render blog list filtered by category
        $_GET['category'] = $category_map[$category_slug];
        render_page('blog-list.php', [
            'title' => $category_map[$category_slug] . ' - Blog',
            'category_filter' => $category_map[$category_slug]
        ]);
        exit;
    } else {
        // Invalid category - redirect to resume
        header('Location: ' . SITE_URL . '/resume', true, 301);
        exit;
    }
}

// Check if route starts with 'blog/' for individual blog posts
if (strpos($route, 'blog/') === 0) {
    $slug = substr($route, 5); // Remove 'blog/' prefix
    render_blog_post($slug);
    exit;
}

// Check if route starts with 'case-studies/' for individual case studies
if (strpos($route, 'case-studies/') === 0) {
    $slug = substr($route, 13); // Remove 'case-studies/' prefix
    render_case_study($slug);
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
    // 404 page - redirect to resume
    header('Location: ' . SITE_URL . '/resume', true, 301);
    exit;
}