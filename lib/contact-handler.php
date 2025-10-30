<?php
/**
 * Contact Form Handler with Local Storage
 * Security features: CSRF, rate limiting, input sanitization, honeypot
 */

// Security constants
define('SUBMISSIONS_DIR', dirname(__DIR__) . '/data/contact-submissions/');
define('RATE_LIMIT_DIR', dirname(__DIR__) . '/data/rate-limits/');
define('MAX_SUBMISSIONS_PER_IP', 3);
define('RATE_LIMIT_WINDOW', 3600); // 1 hour

/**
 * Initialize data directories
 */
function init_contact_directories() {
    $dirs = [SUBMISSIONS_DIR, RATE_LIMIT_DIR];
    foreach ($dirs as $dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
            // Create .htaccess to prevent direct access
            file_put_contents($dir . '.htaccess', 'Deny from all');
        }
    }
}

/**
 * Check rate limiting for IP address
 */
function check_rate_limit($ip) {
    $ip_file = RATE_LIMIT_DIR . md5($ip) . '.json';

    if (file_exists($ip_file)) {
        $data = json_decode(file_get_contents($ip_file), true);
        $current_time = time();

        // Clean old entries
        $data['attempts'] = array_filter($data['attempts'], function($timestamp) use ($current_time) {
            return ($current_time - $timestamp) < RATE_LIMIT_WINDOW;
        });

        if (count($data['attempts']) >= MAX_SUBMISSIONS_PER_IP) {
            return false;
        }

        $data['attempts'][] = $current_time;
    } else {
        $data = ['ip' => $ip, 'attempts' => [time()]];
    }

    file_put_contents($ip_file, json_encode($data));
    return true;
}

/**
 * Sanitize and validate form input
 */
function sanitize_contact_input($data) {
    $clean = [];

    // Name validation
    $clean['name'] = strip_tags(trim($data['name'] ?? ''));
    if (strlen($clean['name']) < 2 || strlen($clean['name']) > 100) {
        throw new Exception('Invalid name length');
    }

    // Email validation
    $clean['email'] = filter_var(trim($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    if (!filter_var($clean['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email address');
    }

    // Message validation
    $clean['message'] = strip_tags(trim($data['message'] ?? ''));
    if (strlen($clean['message']) < 10 || strlen($clean['message']) > 5000) {
        throw new Exception('Message must be between 10 and 5000 characters');
    }

    // Phone (optional)
    $clean['phone'] = preg_replace('/[^0-9\-\+\(\) ]/', '', $data['phone'] ?? '');

    // Subject (optional)
    $clean['subject'] = strip_tags(trim($data['subject'] ?? 'General Inquiry'));

    return $clean;
}

/**
 * Check honeypot field (spam prevention)
 */
function check_honeypot($data) {
    // If honeypot field is filled, it's likely a bot
    if (!empty($data['website_url'])) {
        return false;
    }
    return true;
}

/**
 * Save submission to local file
 */
function save_submission($data, $ip) {
    init_contact_directories();

    $submission = [
        'id' => uniqid('contact_', true),
        'timestamp' => date('Y-m-d H:i:s'),
        'ip' => $ip,
        'name' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'] ?? '',
        'subject' => $data['subject'] ?? 'General Inquiry',
        'message' => $data['message'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        'referrer' => $_SERVER['HTTP_REFERER'] ?? ''
    ];

    // Save as individual JSON file
    $filename = SUBMISSIONS_DIR . date('Y-m-d') . '_' . $submission['id'] . '.json';
    file_put_contents($filename, json_encode($submission, JSON_PRETTY_PRINT));

    // Also append to daily log CSV for easy viewing
    $csv_file = SUBMISSIONS_DIR . 'submissions_' . date('Y-m') . '.csv';
    $is_new_file = !file_exists($csv_file);

    $fp = fopen($csv_file, 'a');
    if ($is_new_file) {
        fputcsv($fp, array_keys($submission));
    }
    fputcsv($fp, array_values($submission));
    fclose($fp);

    return $submission['id'];
}

/**
 * Send thank you email to submitter
 */
function send_thank_you_email($data) {
    $to = $data['email'];
    $subject = 'Thank you for contacting Travis Sutphin';

    $message = "
    <html>
    <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
        <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
            <h2 style='color: #005a00; border-bottom: 2px solid #2be256; padding-bottom: 10px;'>
                Thank You for Reaching Out!
            </h2>

            <p>Hi {$data['name']},</p>

            <p>I've received your message and appreciate you taking the time to contact me.</p>

            <div style='background: #f8f9fa; padding: 15px; border-left: 4px solid #2be256; margin: 20px 0;'>
                <p style='margin: 0;'><strong>Your message:</strong></p>
                <p style='margin: 10px 0 0 0; color: #666;'>" . nl2br(htmlspecialchars($data['message'])) . "</p>
            </div>

            <p>I typically respond within 24 hours during business days. If your request is urgent,
            feel free to follow up at <a href='mailto:" . SITE_EMAIL . "'>" . SITE_EMAIL . "</a>.</p>

            <p>Looking forward to discussing how I can help with your technical needs!</p>

            <p>Best regards,<br>
            <strong>Travis Sutphin</strong><br>
            Fractional CTO | Technical Solutions</p>

            <hr style='margin: 30px 0; border: none; border-top: 1px solid #e0e0e0;'>

            <p style='font-size: 12px; color: #999;'>
                This is an automated response confirming receipt of your message.
                Please do not reply to this email.
            </p>
        </div>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . SITE_NAME . " <noreply@" . $_SERVER['HTTP_HOST'] . ">\r\n";

    return mail($to, $subject, $message, $headers);
}

/**
 * Send notification to site owner
 */
function send_admin_notification($data, $submission_id) {
    $to = SITE_EMAIL;
    $subject = "[Contact Form] New submission from {$data['name']}";

    $message = "
    <html>
    <body style='font-family: Arial, sans-serif;'>
        <h2 style='color: #005a00;'>New Contact Form Submission</h2>

        <table style='width: 100%; border-collapse: collapse;'>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Submission ID:</strong></td>
                <td style='padding: 10px; border: 1px solid #ddd;'>{$submission_id}</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Name:</strong></td>
                <td style='padding: 10px; border: 1px solid #ddd;'>{$data['name']}</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Email:</strong></td>
                <td style='padding: 10px; border: 1px solid #ddd;'><a href='mailto:{$data['email']}'>{$data['email']}</a></td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Phone:</strong></td>
                <td style='padding: 10px; border: 1px solid #ddd;'>{$data['phone']}</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd; background: #f8f9fa;'><strong>Subject:</strong></td>
                <td style='padding: 10px; border: 1px solid #ddd;'>{$data['subject']}</td>
            </tr>
            <tr>
                <td style='padding: 10px; border: 1px solid #ddd; background: #f8f9fa;' valign='top'><strong>Message:</strong></td>
                <td style='padding: 10px; border: 1px solid #ddd;'>" . nl2br(htmlspecialchars($data['message'])) . "</td>
            </tr>
        </table>

        <p style='margin-top: 20px; color: #666; font-size: 12px;'>
            Submission stored locally at: data/contact-submissions/<br>
            Timestamp: " . date('Y-m-d H:i:s') . "
        </p>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: Contact Form <noreply@" . $_SERVER['HTTP_HOST'] . ">\r\n";
    $headers .= "Reply-To: {$data['email']}\r\n";

    return mail($to, $subject, $message, $headers);
}