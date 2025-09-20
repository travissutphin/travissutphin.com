<?php
// FAQ Schema Generator Partial
// Usage: render_partial('faq-schema', ['faqs' => $faqs]);

if (!isset($faqs) || empty($faqs)) {
    return;
}
?>

<!-- FAQ Section -->
<section class="my-12 py-8 bg-gray-light rounded-lg">
    <h2 class="text-2xl font-bold text-dark-green mb-6 px-8">Frequently Asked Questions</h2>
    <div class="space-y-6 px-8">
        <?php foreach ($faqs as $index => $faq): ?>
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-dark-green mb-3">
                    <?php echo e($faq['question']); ?>
                </h3>
                <div class="text-gray-dark prose">
                    <?php echo $faq['answer']; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- FAQ Schema Markup -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        <?php foreach ($faqs as $index => $faq): ?>
        {
            "@type": "Question",
            "name": "<?php echo addslashes($faq['question']); ?>",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "<?php echo addslashes(strip_tags($faq['answer'])); ?>"
            }
        }<?php echo $index < count($faqs) - 1 ? ',' : ''; ?>
        <?php endforeach; ?>
    ]
}
</script>