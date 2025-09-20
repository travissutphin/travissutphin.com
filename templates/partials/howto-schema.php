<?php
// HowTo Schema Generator
// Usage: render_partial('howto-schema', ['howto' => $howto_data]);

if (!isset($howto) || empty($howto)) {
    return;
}
?>

<!-- HowTo Schema Markup -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "HowTo",
    "name": "<?php echo addslashes($howto['name']); ?>",
    "description": "<?php echo addslashes($howto['description']); ?>",
    "image": "<?php echo SITE_URL . '/images/howto-' . $howto['slug'] . '.jpg'; ?>",
    "totalTime": "<?php echo $howto['totalTime'] ?? 'PT30D'; ?>",
    "estimatedCost": {
        "@type": "MonetaryAmount",
        "currency": "USD",
        "value": "<?php echo $howto['cost'] ?? '0'; ?>"
    },
    "supply": [
        <?php if (isset($howto['supplies'])): ?>
        <?php foreach ($howto['supplies'] as $index => $supply): ?>
        {
            "@type": "HowToSupply",
            "name": "<?php echo addslashes($supply); ?>"
        }<?php echo $index < count($howto['supplies']) - 1 ? ',' : ''; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    ],
    "tool": [
        <?php if (isset($howto['tools'])): ?>
        <?php foreach ($howto['tools'] as $index => $tool): ?>
        {
            "@type": "HowToTool",
            "name": "<?php echo addslashes($tool); ?>"
        }<?php echo $index < count($howto['tools']) - 1 ? ',' : ''; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    ],
    "step": [
        <?php if (isset($howto['steps'])): ?>
        <?php foreach ($howto['steps'] as $index => $step): ?>
        {
            "@type": "HowToStep",
            "name": "<?php echo addslashes($step['name']); ?>",
            "text": "<?php echo addslashes($step['text']); ?>",
            "image": "<?php echo isset($step['image']) ? SITE_URL . $step['image'] : ''; ?>",
            "url": "<?php echo SITE_URL . $_SERVER['REQUEST_URI'] . '#step' . ($index + 1); ?>"
        }<?php echo $index < count($howto['steps']) - 1 ? ',' : ''; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    ]
}
</script>