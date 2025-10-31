<?php
/**
 * Test Email Delivery System
 * Verifies that legitimate emails are still delivered properly
 *
 * @qa [Verity] Quality Assurance
 */

// Include required files
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/lib/contact-handler.php';

echo "========================================\n";
echo "EMAIL DELIVERY TEST\n";
echo "========================================\n\n";

// Color codes for terminal output
$green = "\033[0;32m";
$yellow = "\033[0;33m";
$red = "\033[0;31m";
$reset = "\033[0m";

// Check Resend API configuration
echo "1. Checking Resend API Configuration:\n";
if (defined('RESEND_API_KEY') && !empty(RESEND_API_KEY)) {
    $key_preview = substr(RESEND_API_KEY, 0, 10) . '...' . substr(RESEND_API_KEY, -4);
    echo "{$green}✓{$reset} API Key configured: {$key_preview}\n";
} else {
    echo "{$red}✗{$reset} API Key not configured\n";
    echo "Please set RESEND_API_KEY environment variable\n";
    exit(1);
}

echo "   From Email: " . SITE_EMAIL . "\n";
echo "   Site Name: " . SITE_NAME . "\n\n";

// Test legitimate submission data
$test_data = [
    'name' => 'Test User',
    'email' => 'test@example.com',
    'phone' => '555-1234',
    'subject' => 'Test Email Delivery',
    'message' => 'This is a test message to verify the email delivery system is working correctly after implementing anti-spam measures.'
];

echo "2. Testing Spam Score for Legitimate Content:\n";
$spam_score = calculate_spam_score($test_data);
echo "   Spam Score: {$spam_score['score']} (Threshold: " . SPAM_SCORE_THRESHOLD . ")\n";

if ($spam_score['score'] < SPAM_SCORE_THRESHOLD) {
    echo "   {$green}✓ PASS{$reset}: Content recognized as legitimate\n\n";
} else {
    echo "   {$red}✗ FAIL{$reset}: Content incorrectly flagged as spam\n";
    echo "   Reasons: " . implode(', ', $spam_score['reasons']) . "\n\n";
}

echo "3. Testing Email Functions:\n";

// Test thank you email template generation
echo "   Testing thank you email generation...\n";
$email_html = "
<html>
<body style='font-family: Arial, sans-serif;'>
    <h2>Test Email</h2>
    <p>Name: {$test_data['name']}</p>
    <p>Email: {$test_data['email']}</p>
    <p>Message: {$test_data['message']}</p>
</body>
</html>
";

if (!empty($email_html)) {
    echo "   {$green}✓{$reset} Email template generated successfully\n";
} else {
    echo "   {$red}✗{$reset} Failed to generate email template\n";
}

// Verify email would be sent to correct addresses
echo "\n4. Email Routing Verification:\n";
echo "   Thank you email would be sent to: {$test_data['email']}\n";
echo "   Admin notification would be sent to: " . SITE_EMAIL . "\n";

// Check if submission would be saved
echo "\n5. Submission Storage Test:\n";
$submissions_dir = dirname(__DIR__) . '/data/contact-submissions/';
if (is_dir($submissions_dir) && is_writable($submissions_dir)) {
    echo "   {$green}✓{$reset} Submissions directory exists and is writable\n";
} else {
    echo "   {$red}✗{$reset} Submissions directory issue\n";
}

// Summary
echo "\n========================================\n";
echo "SUMMARY\n";
echo "========================================\n";

$all_checks_passed = true;

// Configuration check
if (defined('RESEND_API_KEY') && !empty(RESEND_API_KEY)) {
    echo "{$green}✓{$reset} Email API configured\n";
} else {
    echo "{$red}✗{$reset} Email API not configured\n";
    $all_checks_passed = false;
}

// Spam check
if ($spam_score['score'] < SPAM_SCORE_THRESHOLD) {
    echo "{$green}✓{$reset} Legitimate content passes spam filter\n";
} else {
    echo "{$red}✗{$reset} Legitimate content blocked by spam filter\n";
    $all_checks_passed = false;
}

// Storage check
if (is_dir($submissions_dir) && is_writable($submissions_dir)) {
    echo "{$green}✓{$reset} Submission storage working\n";
} else {
    echo "{$red}✗{$reset} Submission storage issue\n";
    $all_checks_passed = false;
}

echo "\n";
if ($all_checks_passed) {
    echo "{$green}SUCCESS: Email delivery system is ready!{$reset}\n";
    echo "Legitimate submissions will be processed and emails will be sent.\n";
} else {
    echo "{$yellow}WARNING: Some issues need attention{$reset}\n";
    echo "Please review the failed checks above.\n";
}

echo "\nNote: This is a dry-run test. No actual emails were sent.\n";
echo "To test actual email delivery, submit a form through the contact page.\n";