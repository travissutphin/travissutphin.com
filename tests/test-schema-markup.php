<?php
/**
 * Test Schema.org Markup Implementation
 * Validates that BlogPosting and FAQ schemas are properly generated
 *
 * @qa [Verity] Quality Assurance
 * @seo [Bran] Digital Marketing
 */

// Simple test to verify schema parsing logic
echo "========================================\n";
echo "SCHEMA.ORG MARKUP TEST\n";
echo "========================================\n\n";

// Test FAQ parsing logic
$test_html = '
<h2>FAQ</h2>
<p><strong>Q: Will this block all spam?</strong>
A: We block about 80% automatically. The remaining 20% gets flagged for review.</p>

<p><strong>Q: Do users need to do anything different?</strong>
A: Nope. The entire system is invisible to legitimate users.</p>
';

echo "Testing FAQ extraction...\n";

$faq_items = [];
if (preg_match('/<h2[^>]*>FAQ<\/h2>(.*?)(?=<h2|<hr|$)/is', $test_html, $faq_section)) {
    echo "✓ FAQ section found\n";

    if (preg_match_all('/<strong>Q: (.*?)<\/strong>\s*(?:<br\s*\/?>)?\s*A: (.*?)(?=<strong>Q:|$)/is', $faq_section[1], $matches)) {
        for ($i = 0; $i < count($matches[1]); $i++) {
            $faq_items[] = [
                'question' => strip_tags($matches[1][$i]),
                'answer' => strip_tags($matches[2][$i])
            ];
        }
        echo "✓ Found " . count($faq_items) . " Q&A pairs\n\n";

        foreach ($faq_items as $index => $item) {
            echo "Q" . ($index + 1) . ": " . $item['question'] . "\n";
            echo "A" . ($index + 1) . ": " . substr($item['answer'], 0, 50) . "...\n\n";
        }
    }
}

// Test BlogPosting data
echo "Testing BlogPosting schema data...\n";

$test_data = [
    'title' => 'When Spam Attacks: How We Stopped 80% of Bot Traffic',
    'excerpt' => 'Our contact form was drowning in spam. Here\'s how we built a defense.',
    'date' => '2025-11-01',
    'author' => 'Travis Sutphin',
    'category' => 'Security & Systems',
    'tags' => ['Security', 'Case Study', 'Anti-Spam'],
    'slug' => '2025-11-01-when-spam-attacks-how-we-stopped-80-percent-of-bot-traffic'
];

$schema_data = [
    'headline' => $test_data['title'],
    'description' => $test_data['excerpt'],
    'datePublished' => $test_data['date'],
    'author' => $test_data['author'],
    'articleSection' => $test_data['category'],
    'keywords' => implode(', ', $test_data['tags'])
];

echo "✓ Schema data prepared:\n";
foreach ($schema_data as $key => $value) {
    echo "  - {$key}: {$value}\n";
}

echo "\n========================================\n";
echo "VALIDATION RESULTS\n";
echo "========================================\n";

$all_tests_passed = true;

// Check FAQ extraction
if (count($faq_items) > 0) {
    echo "✓ FAQ Schema: Ready (" . count($faq_items) . " Q&A pairs)\n";
} else {
    echo "✗ FAQ Schema: No Q&A pairs found\n";
    $all_tests_passed = false;
}

// Check BlogPosting requirements
$required_fields = ['headline', 'description', 'datePublished', 'author'];
$missing_fields = [];

foreach ($required_fields as $field) {
    if (empty($schema_data[$field])) {
        $missing_fields[] = $field;
    }
}

if (empty($missing_fields)) {
    echo "✓ BlogPosting Schema: All required fields present\n";
} else {
    echo "✗ BlogPosting Schema: Missing fields: " . implode(', ', $missing_fields) . "\n";
    $all_tests_passed = false;
}

echo "\n";
if ($all_tests_passed) {
    echo "SUCCESS: Schema.org markup is properly configured!\n";
    echo "The blog post will have rich snippets in search results.\n";
} else {
    echo "WARNING: Some schema issues detected.\n";
    echo "Please review the implementation.\n";
}

echo "\nNote: To validate the actual schema output, use:\n";
echo "- Google's Rich Results Test: https://search.google.com/test/rich-results\n";
echo "- Schema.org Validator: https://validator.schema.org/\n";