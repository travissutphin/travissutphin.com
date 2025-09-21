<?php
// Helper functions

/**
 * Enforce HTTPS in production
 */
function enforce_https() {
    // Only enforce in production
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $is_production = ($host === 'travissutphin.com' || $host === 'www.travissutphin.com');

    if ($is_production && !is_https()) {
        $redirect_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('Location: ' . $redirect_url, true, 301);
        exit;
    }
}

/**
 * Check if the current request is over HTTPS
 */
function is_https() {
    return (
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
        $_SERVER['SERVER_PORT'] == 443 ||
        (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
        (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on')
    );
}

/**
 * Render a partial template with data
 */
function render_partial($name, $data = []) {
    extract($data);
    $partial_path = __DIR__ . "/../templates/partials/{$name}.php";

    if (file_exists($partial_path)) {
        include $partial_path;
    } else {
        if (DEBUG_MODE) {
            echo "<!-- Partial not found: {$name} -->";
        }
    }
}

/**
 * Render a full page with layout
 */
function render_page($template, $data = []) {
    extract($data);

    // Set default title if not provided
    if (!isset($title)) {
        $title = SITE_NAME;
    } else {
        // Don't append site name if it's a blog post (they already have complete titles)
        $is_blog_post_flag = isset($data['is_blog_post']) ? $data['is_blog_post'] : false;
        if (!$is_blog_post_flag) {
            $title = $title . ' - ' . SITE_NAME;
        }
    }

    // Set default meta description
    if (!isset($meta_description)) {
        $meta_description = DEFAULT_META_DESCRIPTION;
    }

    // Pass through important flags
    $is_blog_post = isset($data['is_blog_post']) ? $data['is_blog_post'] : false;
    $og_type = isset($data['og_type']) ? $data['og_type'] : 'website';
    $date = isset($data['date']) ? $data['date'] : null;
    $tags = isset($data['tags']) ? $data['tags'] : [];
    $html_content = isset($data['html_content']) ? $data['html_content'] : null;

    // Start output buffering for content
    ob_start();

    $template_path = __DIR__ . "/../templates/pages/{$template}";
    if (file_exists($template_path)) {
        include $template_path;
    } else {
        echo "<h1>Page template not found</h1>";
        if (DEBUG_MODE) {
            echo "<p>Template: {$template}</p>";
        }
    }

    $content = ob_get_clean();

    // Include the base layout
    include __DIR__ . '/../templates/layouts/base.php';
}

/**
 * Get blog posts
 */
function get_blog_posts($limit = null) {
    $blog_dir = __DIR__ . '/../content/blog/';
    $posts = [];

    if (!is_dir($blog_dir)) {
        return $posts;
    }

    $files = scandir($blog_dir);
    $markdown_files = array_filter($files, function($file) {
        return pathinfo($file, PATHINFO_EXTENSION) === 'md';
    });

    // Sort by filename (which includes date) in reverse order
    rsort($markdown_files);

    foreach ($markdown_files as $file) {
        $content = file_get_contents($blog_dir . $file);
        $post = parse_markdown_frontmatter($content);

        // Add slug from filename
        $slug = pathinfo($file, PATHINFO_FILENAME);
        $post['slug'] = $slug;

        // Extract date from filename if not in frontmatter
        if (!isset($post['date'])) {
            if (preg_match('/^(\d{4}-\d{2}-\d{2})/', $slug, $matches)) {
                $post['date'] = $matches[1];
            }
        }

        $posts[] = $post;

        if ($limit && count($posts) >= $limit) {
            break;
        }
    }

    return $posts;
}

/**
 * Parse markdown frontmatter
 */
function parse_markdown_frontmatter($content) {
    $data = [];

    if (preg_match('/^---\s*\n(.*?)\n---\s*\n(.*)$/s', $content, $matches)) {
        // Parse YAML-like frontmatter
        $frontmatter = $matches[1];
        $markdown_content = $matches[2];

        // Simple YAML parsing (for basic key: value pairs)
        $lines = explode("\n", $frontmatter);
        foreach ($lines as $line) {
            if (preg_match('/^([^:]+):\s*(.+)$/', $line, $line_matches)) {
                $key = trim($line_matches[1]);
                $value = trim($line_matches[2], ' "\'');

                // Handle tags array
                if ($key === 'tags' && preg_match('/\[(.*)\]/', $value, $tag_matches)) {
                    $tags_str = $tag_matches[1];
                    $tags = array_map(function($tag) {
                        return trim($tag, ' "\'');
                    }, explode(',', $tags_str));
                    $data[$key] = $tags;
                } else {
                    $data[$key] = $value;
                }
            }
        }

        $data['content'] = $markdown_content;

        // Generate excerpt if not provided
        if (!isset($data['excerpt'])) {
            $data['excerpt'] = generate_excerpt($markdown_content);
        }
    } else {
        // No frontmatter, entire content is markdown
        $data['content'] = $content;
        $data['excerpt'] = generate_excerpt($content);
    }

    return $data;
}

/**
 * Generate excerpt from markdown content
 */
function generate_excerpt($content, $length = 150) {
    // Remove markdown formatting
    $text = strip_tags(parse_markdown($content));
    $text = trim($text);

    if (strlen($text) <= $length) {
        return $text;
    }

    // Cut at last word boundary
    $excerpt = substr($text, 0, $length);
    $last_space = strrpos($excerpt, ' ');
    if ($last_space !== false) {
        $excerpt = substr($excerpt, 0, $last_space);
    }

    return $excerpt . '...';
}

/**
 * Parse markdown to HTML (using Parsedown)
 */
function parse_markdown($content) {
    require_once __DIR__ . '/Parsedown.php';
    $parsedown = new Parsedown();
    $parsedown->setSafeMode(true);
    $parsedown->setBreaksEnabled(true);
    return $parsedown->text($content);
}

/**
 * Create URL-friendly slug
 */
function create_slug($title) {
    $slug = strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

/**
 * Check if user is authenticated
 */
function is_authenticated() {
    if (!isset($_SESSION['admin_authenticated'])) {
        return false;
    }

    // Check timeout
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT)) {
        session_destroy();
        return false;
    }

    $_SESSION['last_activity'] = time();
    return $_SESSION['admin_authenticated'] === true;
}

/**
 * Render individual blog post
 */
function render_blog_post($slug) {
    $blog_dir = __DIR__ . '/../content/blog/';
    $files = glob($blog_dir . '*' . $slug . '.md');

    if (empty($files)) {
        http_response_code(404);
        render_page('404.php', ['title' => 'Post Not Found']);
        return;
    }

    $file = $files[0];
    $content = file_get_contents($file);
    $post = parse_markdown_frontmatter($content);
    $post['slug'] = $slug;
    $post['html_content'] = parse_markdown($post['content']);
    $post['is_blog_post'] = true;
    $post['og_type'] = 'article';

    render_page('blog-post.php', $post);
}

/**
 * Sanitize output to prevent XSS
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Get CSRF token
 */
function get_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}