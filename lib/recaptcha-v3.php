<?php
/**
 * Google reCAPTCHA v3 Integration
 * Provides invisible bot detection with score-based verification
 *
 * @author [Syntax] Principal Engineer
 * @security [Sentinal] Security Operations
 */

// reCAPTCHA Configuration
// You'll need to get these keys from: https://www.google.com/recaptcha/admin
define('RECAPTCHA_SITE_KEY', ''); // Add your site key here
define('RECAPTCHA_SECRET_KEY', ''); // Add your secret key here
define('RECAPTCHA_THRESHOLD', 0.5); // Score threshold (0.0 = bot, 1.0 = human)
define('RECAPTCHA_ENABLED', false); // Set to true when keys are configured

/**
 * Verify reCAPTCHA v3 token
 *
 * @param string $token The reCAPTCHA token from the client
 * @param string $action The action name (e.g., 'contact_form')
 * @return array Verification result with score and success status
 */
function verify_recaptcha($token, $action = 'contact_form') {
    // If reCAPTCHA is not configured, return success
    if (!RECAPTCHA_ENABLED || empty(RECAPTCHA_SECRET_KEY)) {
        return [
            'success' => true,
            'score' => 1.0,
            'action' => $action,
            'hostname' => $_SERVER['SERVER_NAME'],
            'challenge_ts' => date('c'),
            'error' => 'reCAPTCHA not configured'
        ];
    }

    // Validate token exists
    if (empty($token)) {
        return [
            'success' => false,
            'score' => 0,
            'error' => 'Missing reCAPTCHA token'
        ];
    }

    // Prepare the verification request
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => RECAPTCHA_SECRET_KEY,
        'response' => $token,
        'remoteip' => $_SERVER['REMOTE_ADDR'] ?? ''
    ];

    // Make the verification request
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
            'timeout' => 10
        ]
    ];

    $context = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);

    if ($result === false) {
        // Network error or timeout
        error_log('reCAPTCHA verification failed: Network error');
        return [
            'success' => false,
            'score' => 0,
            'error' => 'Network error during verification'
        ];
    }

    $response = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('reCAPTCHA verification failed: Invalid JSON response');
        return [
            'success' => false,
            'score' => 0,
            'error' => 'Invalid response from reCAPTCHA'
        ];
    }

    // Log the verification for debugging
    error_log('reCAPTCHA verification - Score: ' . ($response['score'] ?? 'N/A') .
              ', Action: ' . ($response['action'] ?? 'N/A') .
              ', Success: ' . ($response['success'] ? 'true' : 'false'));

    // Validate the response
    if (!$response['success']) {
        $error_codes = implode(', ', $response['error-codes'] ?? ['Unknown error']);
        error_log('reCAPTCHA error codes: ' . $error_codes);
        return [
            'success' => false,
            'score' => 0,
            'error' => 'reCAPTCHA verification failed: ' . $error_codes
        ];
    }

    // Verify the action matches
    if (isset($response['action']) && $response['action'] !== $action) {
        return [
            'success' => false,
            'score' => $response['score'] ?? 0,
            'error' => 'Action mismatch'
        ];
    }

    // Check if score meets threshold
    $score = $response['score'] ?? 0;
    $passed = $score >= RECAPTCHA_THRESHOLD;

    return [
        'success' => $passed,
        'score' => $score,
        'action' => $response['action'] ?? $action,
        'hostname' => $response['hostname'] ?? '',
        'challenge_ts' => $response['challenge_ts'] ?? '',
        'threshold' => RECAPTCHA_THRESHOLD
    ];
}

/**
 * Generate reCAPTCHA v3 JavaScript code for the frontend
 *
 * @param string $action The action name for this form
 * @return string HTML/JavaScript code to include in the page
 */
function get_recaptcha_script($action = 'contact_form') {
    if (!RECAPTCHA_ENABLED || empty(RECAPTCHA_SITE_KEY)) {
        return '<!-- reCAPTCHA not configured -->';
    }

    $site_key = htmlspecialchars(RECAPTCHA_SITE_KEY);
    $action_safe = htmlspecialchars($action);

    return <<<HTML
<!-- Google reCAPTCHA v3 -->
<script src="https://www.google.com/recaptcha/api.js?render={$site_key}"></script>
<script>
    // Initialize reCAPTCHA when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Add reCAPTCHA to contact form
        const contactForm = document.getElementById('contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Show loading state
                const submitBtn = document.getElementById('submit-btn');
                const btnText = document.getElementById('btn-text');
                const btnLoading = document.getElementById('btn-loading');

                submitBtn.disabled = true;
                btnText.classList.add('hidden');
                btnLoading.classList.remove('hidden');

                // Execute reCAPTCHA
                grecaptcha.ready(function() {
                    grecaptcha.execute('{$site_key}', {action: '{$action_safe}'}).then(function(token) {
                        // Add token to form
                        let tokenInput = contactForm.querySelector('input[name="g-recaptcha-response"]');
                        if (!tokenInput) {
                            tokenInput = document.createElement('input');
                            tokenInput.type = 'hidden';
                            tokenInput.name = 'g-recaptcha-response';
                            contactForm.appendChild(tokenInput);
                        }
                        tokenInput.value = token;

                        // Submit the form
                        contactForm.submit();
                    }).catch(function(error) {
                        console.error('reCAPTCHA error:', error);
                        // Allow form submission even if reCAPTCHA fails
                        contactForm.submit();
                    });
                });
            });
        }
    });

    // Refresh token every 90 seconds (tokens expire after 2 minutes)
    setInterval(function() {
        if (typeof grecaptcha !== 'undefined' && grecaptcha.ready) {
            grecaptcha.ready(function() {
                grecaptcha.execute('{$site_key}', {action: '{$action_safe}'}).then(function(token) {
                    // Update token if form exists
                    const tokenInput = document.querySelector('input[name="g-recaptcha-response"]');
                    if (tokenInput) {
                        tokenInput.value = token;
                    }
                });
            });
        }
    }, 90000);
</script>
<style>
    /* Hide reCAPTCHA badge - Google allows this with attribution */
    .grecaptcha-badge {
        visibility: hidden !important;
    }
</style>
HTML;
}

/**
 * Get reCAPTCHA attribution text (required when hiding the badge)
 *
 * @return string HTML for the attribution
 */
function get_recaptcha_attribution() {
    if (!RECAPTCHA_ENABLED) {
        return '';
    }

    return <<<HTML
<div class="text-xs text-gray-500 dark:text-gray-400 mt-4 text-center">
    This site is protected by reCAPTCHA and the Google
    <a href="https://policies.google.com/privacy" target="_blank" class="underline hover:text-primary-green">Privacy Policy</a> and
    <a href="https://policies.google.com/terms" target="_blank" class="underline hover:text-primary-green">Terms of Service</a> apply.
</div>
HTML;
}

/**
 * Log reCAPTCHA verification results for analysis
 *
 * @param array $result The verification result
 * @param string $ip The client IP address
 */
function log_recaptcha_result($result, $ip) {
    $log_dir = dirname(__DIR__) . '/data/security/';
    if (!file_exists($log_dir)) {
        mkdir($log_dir, 0755, true);
    }

    $log_file = $log_dir . 'recaptcha-log-' . date('Y-m') . '.json';
    $log_entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'ip' => $ip,
        'score' => $result['score'] ?? 0,
        'success' => $result['success'] ?? false,
        'action' => $result['action'] ?? '',
        'error' => $result['error'] ?? null
    ];

    $existing_log = [];
    if (file_exists($log_file)) {
        $existing_log = json_decode(file_get_contents($log_file), true) ?: [];
    }

    $existing_log[] = $log_entry;

    // Keep only last 500 entries per file
    if (count($existing_log) > 500) {
        $existing_log = array_slice($existing_log, -500);
    }

    file_put_contents($log_file, json_encode($existing_log, JSON_PRETTY_PRINT));
}

/**
 * Check if the user's reCAPTCHA score indicates suspicious activity
 *
 * @param float $score The reCAPTCHA score
 * @return array Analysis of the score
 */
function analyze_recaptcha_score($score) {
    if ($score >= 0.9) {
        return [
            'risk' => 'very_low',
            'description' => 'Highly likely to be a legitimate user',
            'action' => 'allow'
        ];
    } elseif ($score >= 0.7) {
        return [
            'risk' => 'low',
            'description' => 'Likely a legitimate user',
            'action' => 'allow'
        ];
    } elseif ($score >= 0.5) {
        return [
            'risk' => 'medium',
            'description' => 'Uncertain - could be bot or human',
            'action' => 'review'
        ];
    } elseif ($score >= 0.3) {
        return [
            'risk' => 'high',
            'description' => 'Likely a bot',
            'action' => 'challenge'
        ];
    } else {
        return [
            'risk' => 'very_high',
            'description' => 'Almost certainly a bot',
            'action' => 'block'
        ];
    }
}