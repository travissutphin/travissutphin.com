<?php
// Site configuration
define('SITE_NAME', 'Travis Sutphin');
define('SITE_URL', 'https://travissutphin.com');
define('SITE_EMAIL', 'contact@travissutphin.com');
define('BASE_PATH', '/myPersonalSite/public');

// Admin password hash (password: changeme - MUST be changed in production)
define('ADMIN_PASSWORD_HASH', '$2y$10$YourHashHere');

// Session configuration
define('SESSION_NAME', 'ts_admin_session');
define('SESSION_TIMEOUT', 3600); // 1 hour

// Rate limiting for login attempts
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_TIME', 900); // 15 minutes

// Site metadata defaults
define('DEFAULT_META_DESCRIPTION', 'Your Half-Built App Deserves a Full Launch. As your Fractional CTO, I\'ll finish what you started—fast—with AI and automation baked in.');
define('DEFAULT_OG_IMAGE', '/images/og-default.png');

// Blog configuration
define('POSTS_PER_PAGE', 10);

// Environment
define('DEBUG_MODE', false);

// Initialize session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_start();
}