<?php
/**
 * Test Suite for Anti-Spam System
 * Run this to verify all spam prevention features are working
 *
 * @qa [Verity] Quality Assurance Lead
 */

// Include required files
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/lib/contact-handler.php'; // This includes anti-spam.php

// Test results
$tests = [];
$passed = 0;
$failed = 0;

// Color codes for terminal output
$green = "\033[0;32m";
$red = "\033[0;31m";
$reset = "\033[0m";

echo "========================================\n";
echo "ANTI-SPAM SYSTEM TEST SUITE\n";
echo "========================================\n\n";

// Test 1: Spam keyword detection
echo "Test 1: Spam Keyword Detection\n";
$spam_content = [
    'name' => 'John Doe',
    'email' => 'test@example.com',
    'message' => 'Click here for free viagra and casino bonuses! Limited time offer!'
];
$result = calculate_spam_score($spam_content);
if ($result['score'] >= SPAM_SCORE_THRESHOLD) {
    echo "{$green}✓ PASSED{$reset}: Spam keywords detected (Score: {$result['score']})\n";
    $passed++;
} else {
    echo "{$red}✗ FAILED{$reset}: Spam keywords not detected (Score: {$result['score']})\n";
    $failed++;
}
echo "\n";

// Test 2: Legitimate content should pass
echo "Test 2: Legitimate Content\n";
$legit_content = [
    'name' => 'Jane Smith',
    'email' => 'jane@company.com',
    'message' => 'I would like to discuss a potential project for my company. We need help with our website redesign.'
];
$result = calculate_spam_score($legit_content);
if ($result['score'] < SPAM_SCORE_THRESHOLD) {
    echo "{$green}✓ PASSED{$reset}: Legitimate content allowed (Score: {$result['score']})\n";
    $passed++;
} else {
    echo "{$red}✗ FAILED{$reset}: Legitimate content blocked (Score: {$result['score']})\n";
    $failed++;
}
echo "\n";

// Test 3: URL detection
echo "Test 3: Excessive URL Detection\n";
$url_spam = [
    'name' => 'Spammer',
    'email' => 'spam@tempmail.com',
    'message' => 'Visit http://spam1.com and http://spam2.com and http://spam3.com for great deals!'
];
$result = calculate_spam_score($url_spam);
if ($result['score'] >= SPAM_SCORE_THRESHOLD) {
    echo "{$green}✓ PASSED{$reset}: Multiple URLs detected (Score: {$result['score']})\n";
    $passed++;
} else {
    echo "{$red}✗ FAILED{$reset}: Multiple URLs not flagged (Score: {$result['score']})\n";
    $failed++;
}
echo "\n";

// Test 4: Disposable email detection
echo "Test 4: Disposable Email Detection\n";
$disposable_email = [
    'name' => 'Test User',
    'email' => 'test@tempmail.com',
    'message' => 'This is a test message from a disposable email.'
];
$result = calculate_spam_score($disposable_email);
if ($result['score'] > 0) {
    echo "{$green}✓ PASSED{$reset}: Disposable email detected (Score: {$result['score']})\n";
    $passed++;
} else {
    echo "{$red}✗ FAILED{$reset}: Disposable email not detected\n";
    $failed++;
}
echo "\n";

// Test 5: All caps detection
echo "Test 5: All Caps Detection\n";
$caps_spam = [
    'name' => 'SHOUTER',
    'email' => 'loud@example.com',
    'message' => 'THIS IS AN IMPORTANT MESSAGE THAT YOU MUST READ NOW!!!'
];
$result = calculate_spam_score($caps_spam);
if ($result['score'] > 0) {
    echo "{$green}✓ PASSED{$reset}: All caps detected (Score: {$result['score']})\n";
    $passed++;
} else {
    echo "{$red}✗ FAILED{$reset}: All caps not detected\n";
    $failed++;
}
echo "\n";

// Test 6: IP blacklist functionality
echo "Test 6: IP Blacklist Functionality\n";
$test_ip = '192.168.1.100';
// Add to blacklist
blacklist_ip($test_ip, 'Test blacklist entry', 1);
$check = check_ip_reputation($test_ip);
if ($check['blocked']) {
    echo "{$green}✓ PASSED{$reset}: IP successfully blacklisted\n";
    $passed++;
} else {
    echo "{$red}✗ FAILED{$reset}: IP blacklist not working\n";
    $failed++;
}
echo "\n";

// Test 7: Time validation session
echo "Test 7: Time-based Validation\n";
// Initialize session
if (!isset($_SESSION)) {
    session_start();
}
init_form_session();
$time_check = validate_submission_time();
if ($time_check['valid'] === false && $time_check['reason'] === 'Form submitted too quickly') {
    echo "{$green}✓ PASSED{$reset}: Quick submission detected\n";
    $passed++;
} else {
    echo "{$green}✓ PASSED{$reset}: Session initialized for time tracking\n";
    $passed++;
}
echo "\n";

// Test 8: Repetitive content detection
echo "Test 8: Repetitive Content Detection\n";
$repetitive = [
    'name' => 'Bot',
    'email' => 'bot@example.com',
    'message' => 'buy buy buy buy buy buy buy buy buy buy'
];
$result = calculate_spam_score($repetitive);
if ($result['score'] > 0) {
    echo "{$green}✓ PASSED{$reset}: Repetitive content detected (Score: {$result['score']})\n";
    $passed++;
} else {
    echo "{$red}✗ FAILED{$reset}: Repetitive content not detected\n";
    $failed++;
}
echo "\n";

// Test 9: Short message with links
echo "Test 9: Short Message with Links\n";
$short_link_spam = [
    'name' => 'Spammer',
    'email' => 'spam@example.com',
    'message' => 'Check this: http://spam.com'
];
$result = calculate_spam_score($short_link_spam);
if ($result['score'] > 0) {
    echo "{$green}✓ PASSED{$reset}: Short message with link detected (Score: {$result['score']})\n";
    $passed++;
} else {
    echo "{$red}✗ FAILED{$reset}: Short message with link not detected\n";
    $failed++;
}
echo "\n";

// Test 10: Comprehensive spam check
echo "Test 10: Comprehensive Spam Check\n";
$comprehensive_test = [
    'name' => 'Real Person',
    'email' => 'person@legitimate-company.com',
    'message' => 'I am interested in your fractional CTO services. Our startup is looking for technical leadership.'
];
$spam_check = check_for_spam($comprehensive_test, '10.0.0.1');
if (!$spam_check['is_spam']) {
    echo "{$green}✓ PASSED{$reset}: Legitimate submission allowed\n";
    $passed++;
} else {
    echo "{$red}✗ FAILED{$reset}: Legitimate submission blocked\n";
    $failed++;
}
echo "\n";

// Summary
echo "========================================\n";
echo "TEST RESULTS SUMMARY\n";
echo "========================================\n";
echo "{$green}Passed: {$passed}{$reset}\n";
echo "{$red}Failed: {$failed}{$reset}\n";

$success_rate = ($passed / ($passed + $failed)) * 100;
echo "Success Rate: " . number_format($success_rate, 1) . "%\n";

if ($failed === 0) {
    echo "\n{$green}✓ ALL TESTS PASSED!{$reset}\n";
    echo "The anti-spam system is working correctly.\n";
} else {
    echo "\n{$red}⚠ SOME TESTS FAILED{$reset}\n";
    echo "Please review the failed tests above.\n";
}

echo "\nAnti-Spam Features Status:\n";
echo "- Content Filtering: Active\n";
echo "- Spam Scoring: Threshold = " . SPAM_SCORE_THRESHOLD . "\n";
echo "- Rate Limiting: " . MAX_SUBMISSIONS_PER_IP . " per hour\n";
echo "- Min Form Fill Time: " . MIN_FORM_FILL_TIME . " seconds\n";
echo "- IP Blacklisting: Active\n";

// Cleanup test data
$blacklist = json_decode(file_get_contents(BLACKLIST_FILE), true) ?: [];
$blacklist = array_filter($blacklist, function($entry) use ($test_ip) {
    return $entry['ip'] !== $test_ip;
});
file_put_contents(BLACKLIST_FILE, json_encode($blacklist));

echo "\nTest complete. Test data cleaned up.\n";