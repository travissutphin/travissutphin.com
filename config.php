<?php
// Site configuration
define('SITE_NAME', 'Travis Sutphin');

// Environment detection and BASE_PATH configuration
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$is_production = ($host === 'travissutphin.com' || $host === 'www.travissutphin.com');

if ($is_production) {
    define('SITE_URL', 'https://travissutphin.com');
    define('BASE_PATH', '');
} else {
    // Local development - detect if running from subfolder or root
    $script_name = $_SERVER['SCRIPT_NAME'] ?? '';
    $public_pos = strpos($script_name, '/public/');

    if ($public_pos !== false) {
        // Running from subfolder (e.g., /myPersonalSite/public)
        define('BASE_PATH', substr($script_name, 0, $public_pos + 7));
    } else {
        // Running from root (e.g., localhost:8080)
        define('BASE_PATH', '');
    }

    $port = $_SERVER['SERVER_PORT'] ?? '80';
    $port_suffix = ($port != '80' && $port != '443') ? ':' . $port : '';
    define('SITE_URL', 'http://' . $host . $port_suffix . BASE_PATH);
}

define('SITE_EMAIL', 'info@travissutphin.com');

// Email service configuration (Resend.com)
// Railway injects as $_ENV, some servers use getenv()
$resend_key = $_ENV['RESEND_API_KEY'] ?? getenv('RESEND_API_KEY') ?: null;
if (empty($resend_key)) {
    error_log('ERROR: RESEND_API_KEY not found in environment');
}
define('RESEND_API_KEY', $resend_key);

// Site metadata defaults
define('DEFAULT_META_DESCRIPTION', 'Your Half-Built App Deserves a Full Launch. As your AI-Tech-Solutions partner, I finish stuck AI projects and incomplete apps—fast—with proven deployment automation.');
define('DEFAULT_OG_IMAGE', '/images/og-default.png');

// Blog configuration
define('POSTS_PER_PAGE', 20);

// Environment
define('DEBUG_MODE', false);

// Initialize session if not already started
if (session_status() === PHP_SESSION_NONE) {
    // Configure session for production security
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_lifetime', 0); // Until browser closes

    // Set SameSite attribute for CSRF protection
    if (PHP_VERSION_ID >= 70300) {
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'] ?? '',
            'secure' => $is_production, // HTTPS only in production
            'httponly' => true,
            'samesite' => 'Lax' // Allow navigation from external sites
        ]);
    }

    session_name('ts_session');
    session_start();

    // Regenerate session ID periodically for security
    if (!isset($_SESSION['created'])) {
        $_SESSION['created'] = time();
    } else if (time() - $_SESSION['created'] > 1800) {
        // Regenerate session ID every 30 minutes
        session_regenerate_id(true);
        $_SESSION['created'] = time();
    }
}