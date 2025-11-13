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
    $noindex = isset($data['noindex']) ? $data['noindex'] : false;

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
 * Get blog posts with optional filtering
 */
function get_blog_posts($limit = null, $filters = []) {
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

        // Apply filters
        $include_post = true;

        // Filter by category
        if (isset($filters['category']) && !empty($filters['category'])) {
            if (!isset($post['category']) || $post['category'] !== $filters['category']) {
                $include_post = false;
            }
        }

        // Filter by topic
        if ($include_post && isset($filters['topic']) && !empty($filters['topic'])) {
            if (!isset($post['topics']) || !in_array($filters['topic'], $post['topics'])) {
                $include_post = false;
            }
        }

        // Filter by tag (existing functionality)
        if ($include_post && isset($filters['tag']) && !empty($filters['tag'])) {
            if (!isset($post['tags']) || !in_array($filters['tag'], $post['tags'])) {
                $include_post = false;
            }
        }

        if ($include_post) {
            $posts[] = $post;

            if ($limit && count($posts) >= $limit) {
                break;
            }
        }
    }

    return $posts;
}

/**
 * Get all unique categories from blog posts
 */
function get_all_categories() {
    $all_posts = get_blog_posts();
    $categories = [];

    foreach ($all_posts as $post) {
        if (isset($post['category']) && !in_array($post['category'], $categories)) {
            $categories[] = $post['category'];
        }
    }

    sort($categories);
    return $categories;
}

/**
 * Get all unique topics from blog posts
 */
function get_all_topics() {
    $all_posts = get_blog_posts();
    $topics = [];

    foreach ($all_posts as $post) {
        if (isset($post['topics']) && is_array($post['topics'])) {
            $topics = array_merge($topics, $post['topics']);
        }
    }

    $topics = array_unique($topics);
    sort($topics);
    return $topics;
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

        // Simple YAML parsing (for basic key: value pairs and arrays)
        $lines = explode("\n", $frontmatter);
        foreach ($lines as $line) {
            // Remove any carriage returns (Windows line endings)
            $line = trim($line, "\r");
            if (preg_match('/^([^:]+):\s*(.+)$/', $line, $line_matches)) {
                $key = trim($line_matches[1]);
                $value = trim($line_matches[2], " \"\'\r\n");

                // Handle array fields (tags, topics)
                if (in_array($key, ['tags', 'topics']) && preg_match('/\[(.*)\]/', $value, $array_matches)) {
                    $array_str = $array_matches[1];
                    $array_values = array_map(function($item) {
                        return trim($item, " \"\'\r\n");
                    }, explode(',', $array_str));
                    $data[$key] = $array_values;
                }
                // Handle boolean fields
                elseif ($key === 'faq' && in_array(strtolower($value), ['true', 'false'])) {
                    $data[$key] = strtolower($value) === 'true';
                }
                // Handle all other fields as strings
                else {
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

/**
 * Get case studies with optional filtering
 */
function get_case_studies($limit = null, $filters = []) {
    $case_studies_dir = __DIR__ . '/../content/case-studies/';
    $case_studies = [];

    if (!is_dir($case_studies_dir)) {
        return $case_studies;
    }

    $files = scandir($case_studies_dir);
    $markdown_files = array_filter($files, function($file) {
        return pathinfo($file, PATHINFO_EXTENSION) === 'md';
    });

    // Sort by filename (which includes date) in reverse order
    rsort($markdown_files);

    foreach ($markdown_files as $file) {
        $content = file_get_contents($case_studies_dir . $file);
        $case_study = parse_case_study_frontmatter($content);

        // Add slug from filename
        $slug = pathinfo($file, PATHINFO_FILENAME);
        $case_study['slug'] = $slug;

        // Extract date from filename if not in frontmatter
        if (!isset($case_study['date'])) {
            if (preg_match('/^(\d{4}-\d{2}-\d{2})/', $slug, $matches)) {
                $case_study['date'] = $matches[1];
            }
        }

        // Apply filters
        $include_case_study = true;

        // Filter by industry
        if (isset($filters['industry']) && !empty($filters['industry'])) {
            if (!isset($case_study['industry']) || $case_study['industry'] !== $filters['industry']) {
                $include_case_study = false;
            }
        }

        // Filter by service
        if ($include_case_study && isset($filters['service']) && !empty($filters['service'])) {
            if (!isset($case_study['services']) || !in_array($filters['service'], $case_study['services'])) {
                $include_case_study = false;
            }
        }

        // Filter by case study type
        if ($include_case_study && isset($filters['type']) && !empty($filters['type'])) {
            if (!isset($case_study['caseStudyType']) || $case_study['caseStudyType'] !== $filters['type']) {
                $include_case_study = false;
            }
        }

        if ($include_case_study) {
            $case_studies[] = $case_study;

            if ($limit && count($case_studies) >= $limit) {
                break;
            }
        }
    }

    return $case_studies;
}

/**
 * Parse case study frontmatter (enhanced version for nested structures)
 */
function parse_case_study_frontmatter($content) {
    $data = [];

    if (preg_match('/^---\s*\n(.*?)\n---\s*\n(.*)$/s', $content, $matches)) {
        $frontmatter = $matches[1];
        $markdown_content = $matches[2];

        // Parse YAML-like frontmatter with support for nested structures
        $lines = explode("\n", $frontmatter);
        $current_key = null;
        $current_array = null;
        $in_results = false;
        $current_result = [];

        foreach ($lines as $line) {
            $line = rtrim($line, "\r");
            $trimmed = trim($line);

            // Check for array field that starts a list
            if (preg_match('/^([^:]+):\s*$/', $trimmed, $matches)) {
                $key = trim($matches[1]);
                // If we have results field, prepare to collect array items
                if ($key === 'results') {
                    $in_results = true;
                    $data['results'] = [];
                    continue;
                } elseif (in_array($key, ['services', 'secondaryKeywords'])) {
                    $current_key = $key;
                    $data[$key] = [];
                    continue;
                }
            }

            // Handle results array items (nested structure)
            if ($in_results && preg_match('/^\s*-\s+([^:]+):\s*(.+)$/', $line, $matches)) {
                $field = trim($matches[1]);
                $value = trim($matches[2], " \"\'\r\n");

                if ($field === 'metric') {
                    // If we have a previous result, save it
                    if (!empty($current_result)) {
                        $data['results'][] = $current_result;
                    }
                    // Start new result
                    $current_result = ['metric' => $value];
                } else {
                    $current_result[$field] = $value;
                }
                continue;
            } elseif ($in_results && !preg_match('/^\s*-/', $line) && !empty($trimmed)) {
                // End of results section
                if (!empty($current_result)) {
                    $data['results'][] = $current_result;
                    $current_result = [];
                }
                $in_results = false;
            }

            // Handle simple array items (services, keywords, etc.)
            if ($current_key && preg_match('/^\s*-\s+["\']?([^"\']+)["\']?\s*$/', $line, $matches)) {
                $data[$current_key][] = trim($matches[1]);
                continue;
            } elseif ($current_key && !preg_match('/^\s*-/', $line) && !empty($trimmed)) {
                // End of current array
                $current_key = null;
            }

            // Handle key-value pairs
            if (preg_match('/^([^:]+):\s*(.+)$/', $trimmed, $matches)) {
                $key = trim($matches[1]);
                $value = trim($matches[2], " \"\'\r\n");

                // Handle array fields in bracket notation
                if (in_array($key, ['tags', 'topics', 'services', 'secondaryKeywords']) && preg_match('/\[(.*)\]/', $value, $array_matches)) {
                    $array_str = $array_matches[1];
                    $array_values = array_map(function($item) {
                        return trim($item, " \"\'\r\n");
                    }, explode(',', $array_str));
                    $data[$key] = $array_values;
                }
                // Handle boolean fields
                elseif (in_array($key, ['includeQA', 'includeFAQ', 'includeReview']) && in_array(strtolower($value), ['true', 'false'])) {
                    $data[$key] = strtolower($value) === 'true';
                }
                // Handle all other fields as strings
                else {
                    $data[$key] = $value;
                }
            }
        }

        // Save final result if exists
        if ($in_results && !empty($current_result)) {
            $data['results'][] = $current_result;
        }

        $data['content'] = $markdown_content;

        // Generate excerpt if not provided
        if (!isset($data['excerpt'])) {
            $data['excerpt'] = generate_excerpt($markdown_content);
        }
    } else {
        // No frontmatter, use fallback parsing
        $data['content'] = $content;
        $data['excerpt'] = generate_excerpt($content);
    }

    return $data;
}

/**
 * Get all unique industries from case studies
 */
function get_all_industries() {
    $all_case_studies = get_case_studies();
    $industries = [];

    foreach ($all_case_studies as $case_study) {
        if (isset($case_study['industry']) && !in_array($case_study['industry'], $industries)) {
            $industries[] = $case_study['industry'];
        }
    }

    sort($industries);
    return $industries;
}

/**
 * Get all unique services from case studies
 */
function get_all_services() {
    $all_case_studies = get_case_studies();
    $services = [];

    foreach ($all_case_studies as $case_study) {
        if (isset($case_study['services']) && is_array($case_study['services'])) {
            $services = array_merge($services, $case_study['services']);
        }
    }

    $services = array_unique($services);
    sort($services);
    return $services;
}

/**
 * Render individual case study
 */
function render_case_study($slug) {
    $case_study_dir = __DIR__ . '/../content/case-studies/';
    $files = glob($case_study_dir . '*' . $slug . '.md');

    if (empty($files)) {
        http_response_code(404);
        render_page('404.php', ['title' => 'Case Study Not Found']);
        return;
    }

    $file = $files[0];
    $content = file_get_contents($file);
    $case_study = parse_case_study_frontmatter($content);
    $case_study['slug'] = $slug;
    $case_study['html_content'] = parse_markdown($case_study['content']);
    $case_study['is_case_study'] = true;
    $case_study['og_type'] = 'article';

    // Set page title from case study title
    if (isset($case_study['title'])) {
        $case_study['title'] = $case_study['title'];
    }

    // Set meta description from excerpt
    if (isset($case_study['excerpt'])) {
        $case_study['meta_description'] = $case_study['excerpt'];
    }

    render_page('case-study-single.php', $case_study);
}