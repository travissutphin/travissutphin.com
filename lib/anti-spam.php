<?php
/**
 * Enhanced Anti-Spam Module for Contact Form
 * Features: Content filtering, spam scoring, IP reputation, time-based validation
 *
 * @author [Syntax] Principal Engineer
 * @security [Sentinal] Security Operations
 */

// Configuration constants
define('SPAM_SCORE_THRESHOLD', 5.0); // Score above this is likely spam
define('MIN_FORM_FILL_TIME', 3); // Minimum seconds to fill form (bots are fast)
define('MAX_LINKS_ALLOWED', 2); // Maximum URLs allowed in message
define('BLACKLIST_FILE', dirname(__DIR__) . '/data/security/blacklist.json');
define('SPAM_LOG_FILE', dirname(__DIR__) . '/data/security/spam-log.json');

/**
 * Common spam keywords and phrases with weighted scores
 * Higher score = more likely to be spam
 */
function get_spam_patterns() {
    return [
        // High-risk patterns (score: 3.0)
        '/\b(viagra|cialis|levitra|pharmacy|pills|medication)\b/i' => 3.0,
        '/\b(casino|poker|blackjack|slots|betting|gambl)\b/i' => 3.0,
        '/\b(loan|mortgage|credit|debt|forex|trading)\b/i' => 3.0,
        '/\b(bitcoin|crypto|nft|blockchain|investment)\b/i' => 2.5,

        // Medium-risk patterns (score: 2.0)
        '/\b(click here|act now|limited time|urgent|winner)\b/i' => 2.0,
        '/\b(100% free|risk free|no cost|guarantee|refund)\b/i' => 2.0,
        '/\b(make money|work from home|passive income|mlm)\b/i' => 2.0,
        '/\b(dear (sir|madam|friend)|congratulations)\b/i' => 2.0,

        // Low-risk patterns (score: 1.0)
        '/\b(unsubscribe|opt.?out|remove me|stop email)\b/i' => 1.0,
        '/\$\d{3,}[\.,]?\d*/' => 1.0, // Dollar amounts
        '/!!+|CAPS{10,}/' => 1.0, // Excessive punctuation or caps

        // URL patterns
        '/https?:\/\/[^\s]{50,}/i' => 2.0, // Very long URLs
        '/(bit\.ly|tinyurl|short\.link|goo\.gl)/i' => 1.5, // URL shorteners
    ];
}

/**
 * Calculate spam score based on content analysis
 */
function calculate_spam_score($data) {
    $score = 0.0;
    $reasons = [];

    // Combine all text fields for analysis
    $content = implode(' ', [
        $data['name'] ?? '',
        $data['email'] ?? '',
        $data['message'] ?? '',
        $data['subject'] ?? ''
    ]);

    // Check against spam patterns
    foreach (get_spam_patterns() as $pattern => $weight) {
        if (preg_match($pattern, $content)) {
            $score += $weight;
            $reasons[] = "Matched pattern: " . $pattern;
        }
    }

    // Check for excessive links
    $link_count = preg_match_all('/https?:\/\//i', $data['message'] ?? '', $matches);
    if ($link_count > MAX_LINKS_ALLOWED) {
        $score += ($link_count - MAX_LINKS_ALLOWED) * 1.5;
        $reasons[] = "Too many links: {$link_count}";
    }

    // Check for suspicious email patterns
    if (isset($data['email'])) {
        // Disposable email domains
        $disposable_domains = ['tempmail', 'throwaway', 'guerrillamail', '10minutemail', 'mailinator'];
        foreach ($disposable_domains as $domain) {
            if (stripos($data['email'], $domain) !== false) {
                $score += 2.0;
                $reasons[] = "Disposable email domain";
                break;
            }
        }

        // Suspicious email patterns
        if (preg_match('/^[a-z0-9]{20,}@/i', $data['email'])) {
            $score += 1.0;
            $reasons[] = "Suspicious email pattern (random string)";
        }
    }

    // Check message characteristics
    if (isset($data['message'])) {
        $msg_length = strlen($data['message']);
        $word_count = str_word_count($data['message']);

        // Very short messages with links are suspicious
        if ($msg_length < 50 && $link_count > 0) {
            $score += 2.0;
            $reasons[] = "Short message with links";
        }

        // Repetitive content
        if ($word_count > 0) {
            $words = str_word_count(strtolower($data['message']), 1);
            $unique_words = array_unique($words);
            $repetition_ratio = 1 - (count($unique_words) / count($words));

            if ($repetition_ratio > 0.7) {
                $score += 2.0;
                $reasons[] = "Highly repetitive content";
            }
        }

        // All caps detection
        if ($msg_length > 20 && strtoupper($data['message']) === $data['message']) {
            $score += 1.5;
            $reasons[] = "Message in all caps";
        }
    }

    // Check name field for spam patterns
    if (isset($data['name'])) {
        // Single word names are suspicious
        if (!preg_match('/\s/', trim($data['name']))) {
            $score += 0.5;
            $reasons[] = "Single word name";
        }

        // Random character names
        if (preg_match('/^[a-z]{15,}$/i', $data['name'])) {
            $score += 1.5;
            $reasons[] = "Random character name";
        }
    }

    return [
        'score' => $score,
        'reasons' => $reasons,
        'is_spam' => $score >= SPAM_SCORE_THRESHOLD
    ];
}

/**
 * Check IP reputation and blacklist
 */
function check_ip_reputation($ip) {
    // Initialize security directory
    $security_dir = dirname(__DIR__) . '/data/security/';
    if (!file_exists($security_dir)) {
        mkdir($security_dir, 0755, true);
        file_put_contents($security_dir . '.htaccess', 'Deny from all');
    }

    // Load blacklist
    $blacklist = [];
    if (file_exists(BLACKLIST_FILE)) {
        $blacklist = json_decode(file_get_contents(BLACKLIST_FILE), true) ?: [];
    }

    // Check if IP is blacklisted
    foreach ($blacklist as $entry) {
        if ($entry['ip'] === $ip && $entry['expires'] > time()) {
            return [
                'blocked' => true,
                'reason' => $entry['reason'],
                'expires' => $entry['expires']
            ];
        }
    }

    // Clean expired entries
    $blacklist = array_filter($blacklist, function($entry) {
        return $entry['expires'] > time();
    });
    file_put_contents(BLACKLIST_FILE, json_encode($blacklist, JSON_PRETTY_PRINT));

    return ['blocked' => false];
}

/**
 * Add IP to blacklist
 */
function blacklist_ip($ip, $reason, $duration_hours = 24) {
    $blacklist = [];
    if (file_exists(BLACKLIST_FILE)) {
        $blacklist = json_decode(file_get_contents(BLACKLIST_FILE), true) ?: [];
    }

    $blacklist[] = [
        'ip' => $ip,
        'reason' => $reason,
        'added' => time(),
        'expires' => time() + ($duration_hours * 3600)
    ];

    file_put_contents(BLACKLIST_FILE, json_encode($blacklist, JSON_PRETTY_PRINT));
}

/**
 * Time-based validation using session
 */
function validate_submission_time() {
    if (!isset($_SESSION)) {
        session_start();
    }

    // Check if form load time was set
    if (!isset($_SESSION['contact_form_loaded'])) {
        return ['valid' => false, 'reason' => 'Form not properly loaded'];
    }

    $form_load_time = $_SESSION['contact_form_loaded'];
    $submission_time = time();
    $time_diff = $submission_time - $form_load_time;

    // Too fast submission (likely a bot)
    if ($time_diff < MIN_FORM_FILL_TIME) {
        return [
            'valid' => false,
            'reason' => 'Form submitted too quickly',
            'time' => $time_diff
        ];
    }

    // Too slow (session might be hijacked or form left open too long)
    if ($time_diff > 3600) { // 1 hour
        return [
            'valid' => false,
            'reason' => 'Form submission expired',
            'time' => $time_diff
        ];
    }

    return ['valid' => true, 'time' => $time_diff];
}

/**
 * Initialize form load time in session
 */
function init_form_session() {
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION['contact_form_loaded'] = time();
}

/**
 * Log spam attempts for analysis
 */
function log_spam_attempt($data, $ip, $spam_result) {
    $security_dir = dirname(__DIR__) . '/data/security/';
    if (!file_exists($security_dir)) {
        mkdir($security_dir, 0755, true);
    }

    $log_entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'ip' => $ip,
        'score' => $spam_result['score'],
        'reasons' => $spam_result['reasons'],
        'data' => [
            'name' => substr($data['name'] ?? '', 0, 50),
            'email' => $data['email'] ?? '',
            'subject' => $data['subject'] ?? '',
            'message_preview' => substr($data['message'] ?? '', 0, 100)
        ]
    ];

    $log_file = $security_dir . 'spam-log-' . date('Y-m') . '.json';
    $existing_log = [];

    if (file_exists($log_file)) {
        $existing_log = json_decode(file_get_contents($log_file), true) ?: [];
    }

    $existing_log[] = $log_entry;

    // Keep only last 1000 entries per file
    if (count($existing_log) > 1000) {
        $existing_log = array_slice($existing_log, -1000);
    }

    file_put_contents($log_file, json_encode($existing_log, JSON_PRETTY_PRINT));
}

/**
 * Main spam check function
 */
function check_for_spam($data, $ip) {
    $results = [
        'is_spam' => false,
        'score' => 0,
        'reasons' => [],
        'action' => 'allow'
    ];

    // Check IP reputation
    $ip_check = check_ip_reputation($ip);
    if ($ip_check['blocked']) {
        $results['is_spam'] = true;
        $results['reasons'][] = "IP blacklisted: " . $ip_check['reason'];
        $results['action'] = 'block';
        return $results;
    }

    // Check submission timing
    $time_check = validate_submission_time();
    if (!$time_check['valid']) {
        $results['is_spam'] = true;
        $results['score'] += 5.0;
        $results['reasons'][] = $time_check['reason'];

        // Auto-blacklist very fast submissions
        if (isset($time_check['time']) && $time_check['time'] < 1) {
            blacklist_ip($ip, 'Bot-like behavior (instant submission)', 72);
            $results['action'] = 'block';
        }
    }

    // Calculate spam score
    $spam_analysis = calculate_spam_score($data);
    $results['score'] += $spam_analysis['score'];
    $results['reasons'] = array_merge($results['reasons'], $spam_analysis['reasons']);

    // Determine final action
    if ($results['score'] >= SPAM_SCORE_THRESHOLD) {
        $results['is_spam'] = true;

        if ($results['score'] >= 10) {
            // Very high spam score - blacklist
            blacklist_ip($ip, 'High spam score: ' . $results['score'], 48);
            $results['action'] = 'block';
        } else {
            // Moderate spam - silent reject
            $results['action'] = 'silent_reject';
        }

        // Log spam attempt
        log_spam_attempt($data, $ip, $results);
    }

    return $results;
}

/**
 * Get spam statistics for monitoring
 */
function get_spam_stats() {
    $security_dir = dirname(__DIR__) . '/data/security/';
    $current_month_file = $security_dir . 'spam-log-' . date('Y-m') . '.json';

    $stats = [
        'total_spam_attempts' => 0,
        'blocked_ips' => 0,
        'top_spam_reasons' => [],
        'recent_attempts' => []
    ];

    // Count current month spam attempts
    if (file_exists($current_month_file)) {
        $log = json_decode(file_get_contents($current_month_file), true) ?: [];
        $stats['total_spam_attempts'] = count($log);

        // Get recent attempts (last 10)
        $stats['recent_attempts'] = array_slice($log, -10);

        // Analyze top spam reasons
        $reason_counts = [];
        foreach ($log as $entry) {
            foreach ($entry['reasons'] as $reason) {
                $reason_key = explode(':', $reason)[0];
                $reason_counts[$reason_key] = ($reason_counts[$reason_key] ?? 0) + 1;
            }
        }
        arsort($reason_counts);
        $stats['top_spam_reasons'] = array_slice($reason_counts, 0, 5, true);
    }

    // Count active blacklisted IPs
    if (file_exists(BLACKLIST_FILE)) {
        $blacklist = json_decode(file_get_contents(BLACKLIST_FILE), true) ?: [];
        $stats['blocked_ips'] = count(array_filter($blacklist, function($entry) {
            return $entry['expires'] > time();
        }));
    }

    return $stats;
}