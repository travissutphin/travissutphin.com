<?php
// Calculate reading time
function calculate_reading_time_cs($content) {
    $word_count = str_word_count(strip_tags($content));
    return ceil($word_count / 200);
}

$reading_time = isset($readingTime) ? intval($readingTime) : calculate_reading_time_cs($html_content ?? $content ?? '');

// Get all case studies for related section
$all_case_studies = get_case_studies();
$current_slug = $slug ?? '';
$related_case_studies = array_filter($all_case_studies, function($cs) use ($current_slug, $industry) {
    if ($cs['slug'] === $current_slug) return false;
    if (empty($industry)) return true;
    return isset($cs['industry']) && $cs['industry'] === $industry;
});
$related_case_studies = array_slice($related_case_studies, 0, 3);
?>

<!-- Breadcrumb -->
<section class="gradient-green-blue px-4 py-3">
    <div class="max-w-6xl mx-auto">
        <nav aria-label="Breadcrumb">
            <ol class="flex items-center space-x-1 text-xs text-white/80">
                <li><a href="<?php echo BASE_PATH; ?>/" class="hover:text-white transition-colors">Home</a></li>
                <li><span class="mx-1.5 text-white/60">›</span></li>
                <li><a href="<?php echo BASE_PATH; ?>/case-studies" class="hover:text-white transition-colors">Case Studies</a></li>
                <?php if (isset($industry)): ?>
                <li><span class="mx-1.5 text-white/60">›</span></li>
                <li><span class="text-white"><?php echo e($industry); ?></span></li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
</section>

<!-- Hero Section with Key Metrics -->
<section class="gradient-green-blue px-4 py-12">
    <div class="max-w-6xl mx-auto">
        <!-- Case Study Badge -->
        <div class="text-center mb-6">
            <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur text-white rounded-full text-sm font-semibold">
                <?php echo isset($caseStudyType) ? '📊 ' . ucwords(str_replace('-', ' ', $caseStudyType)) : 'Case Study'; ?>
            </span>
        </div>

        <!-- Title -->
        <h1 class="text-3xl md:text-5xl font-bold text-white text-center mb-6">
            <?php echo e($title ?? 'Case Study'); ?>
        </h1>

        <!-- Excerpt -->
        <?php if (!empty($excerpt)): ?>
        <p class="text-lg md:text-xl text-white/90 text-center max-w-4xl mx-auto mb-8">
            <?php echo e($excerpt); ?>
        </p>
        <?php endif; ?>

        <!-- Featured Image -->
        <?php if (!empty($image)): ?>
        <div class="max-w-4xl mx-auto mb-8">
            <div class="relative overflow-hidden rounded-lg shadow-2xl">
                <?php
                // Prepare image paths for WebP and PNG with responsive sizes
                $image_path = trim(trim($image), '"');
                $webp_path = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $image_path);
                $full_image_path = BASE_PATH . $image_path;
                $full_webp_path = BASE_PATH . $webp_path;

                // Generate responsive image paths
                $path_info = pathinfo($webp_path);
                $base_name = $path_info['dirname'] . '/' . $path_info['filename'];
                $webp_600 = BASE_PATH . $base_name . '-600w.webp';
                $webp_900 = BASE_PATH . $base_name . '-900w.webp';

                $alt_text = htmlspecialchars(strip_tags($title ?? 'Case study image'));
                ?>
                <picture>
                    <!-- WebP version with responsive sizes for modern browsers -->
                    <source
                        srcset="<?php echo $webp_600; ?> 600w,
                                <?php echo $webp_900; ?> 900w,
                                <?php echo $full_webp_path; ?> 1200w"
                        sizes="(max-width: 768px) 600px,
                               (max-width: 1024px) 900px,
                               1200px"
                        type="image/webp">
                    <!-- PNG fallback for older browsers -->
                    <img src="<?php echo $full_image_path; ?>"
                         alt="<?php echo $alt_text; ?>"
                         class="w-full h-64 md:h-96 object-cover"
                         loading="eager"
                         width="1200"
                         height="630">
                </picture>
            </div>
        </div>
        <?php endif; ?>

        <!-- Key Metrics Callout (if results are available) -->
        <?php if (!empty($results) && is_array($results)): ?>
        <div class="grid md:grid-cols-3 gap-6 mt-8">
            <?php foreach ($results as $result): ?>
            <div class="bg-white/10 backdrop-blur rounded-lg p-6 text-center">
                <div class="text-white/80 text-sm font-semibold mb-2">
                    <?php echo e($result['metric'] ?? ''); ?>
                </div>
                <div class="text-white text-2xl font-bold mb-2">
                    <?php echo e($result['improvement'] ?? ''); ?>
                </div>
                <div class="text-white/60 text-xs">
                    <?php echo e($result['before'] ?? ''); ?> → <?php echo e($result['after'] ?? ''); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Meta Info -->
        <div class="flex flex-wrap items-center justify-center gap-4 text-white/90 text-sm mt-8">
            <?php if (!empty($client)): ?>
            <div class="flex items-center gap-2">
                <i data-lucide="briefcase" class="w-4 h-4"></i>
                <span><?php echo e($client); ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($industry)): ?>
            <span class="text-white/60">•</span>
            <div class="flex items-center gap-2">
                <i data-lucide="building" class="w-4 h-4"></i>
                <span><?php echo e($industry); ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($projectDuration)): ?>
            <span class="text-white/60">•</span>
            <div class="flex items-center gap-2">
                <i data-lucide="clock" class="w-4 h-4"></i>
                <span><?php echo e($projectDuration); ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($date)): ?>
            <span class="text-white/60">•</span>
            <time datetime="<?php echo $date; ?>">
                <?php echo date('M j, Y', strtotime($date)); ?>
            </time>
            <?php endif; ?>
            <span class="text-white/60">•</span>
            <span><?php echo $reading_time; ?> min read</span>
        </div>

        <!-- Services Tags -->
        <?php if (!empty($services) && is_array($services)): ?>
        <div class="flex flex-wrap justify-center gap-2 mt-6">
            <?php foreach ($services as $service): ?>
            <span class="px-3 py-1 bg-white/20 backdrop-blur text-white text-sm rounded-full">
                <?php echo e($service); ?>
            </span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Main Content Area -->
<article class="article-section py-12 px-4">
    <div class="max-w-6xl mx-auto">
        <div class="article-content p-8 md:p-12">
            <!-- Article Content -->
            <div class="blog-content">
                <?php
                if (!empty($html_content)) {
                    echo $html_content;
                } elseif (!empty($content)) {
                    echo parse_markdown($content);
                } else {
                    echo '<p>Case study content is currently unavailable.</p>';
                }
                ?>
            </div>

            <!-- Author Bio Card -->
            <div class="author-bio mt-12 p-6">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white text-xl font-bold">TS</span>
                    </div>
                    <div class="flex-grow">
                        <h3 class="author-name text-lg font-bold mb-1">By <?php echo e($author ?? 'Travis Sutphin'); ?></h3>
                        <p class="author-description text-sm mb-3">
                            Fractional CTO helping founders complete stuck AI projects and ship products faster.
                        </p>
                        <a href="<?php echo BASE_PATH; ?>/contact"
                           class="text-primary-blue hover:text-primary-green transition-colors text-sm font-semibold">
                            Need help with your project? Let's talk →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Related Case Studies Section -->
<?php if (!empty($related_case_studies)): ?>
<section class="related-section py-12 px-4 bg-light-bg dark:bg-gray-900">
    <div class="max-w-6xl mx-auto">
        <h2 class="related-title text-3xl font-bold text-center mb-8 text-theme-primary">More Success Stories</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($related_case_studies as $related): ?>
                <?php
                // Pass case study data to partial
                render_partial('case-study-card', ['case_study' => $related]);
                ?>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-8">
            <a href="<?php echo BASE_PATH; ?>/case-studies"
               class="inline-block px-6 py-3 bg-gradient-to-r from-primary-green to-primary-blue text-white rounded-lg font-semibold hover:shadow-lg transition-all">
                View All Case Studies →
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-16 px-4 gradient-green-blue">
    <div class="max-w-4xl mx-auto text-center text-white">
        <h2 class="text-3xl font-bold mb-4">Ready to Transform Your Project?</h2>
        <p class="text-xl mb-8 opacity-95">
            Let's discuss how we can help you achieve similar results. No sales pitch—just a conversation about your needs.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo BASE_PATH; ?>/contact"
               class="inline-block bg-white text-dark-green px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Schedule a Consultation →
            </a>
            <a href="<?php echo BASE_PATH; ?>/services"
               class="inline-block bg-white/20 backdrop-blur text-white px-8 py-3 rounded-lg font-semibold hover:bg-white/30 transition-colors">
                View Services
            </a>
        </div>
    </div>
</section>

<!-- Scroll to Top Button -->
<button id="scroll-to-top"
        class="scroll-to-top fixed bottom-20 right-6 w-12 h-12 text-white rounded-full opacity-0 pointer-events-none transition-all z-40 flex items-center justify-center"
        aria-label="Scroll to top of page">
    <i data-lucide="arrow-up" class="w-6 h-6"></i>
</button>

<!-- Breadcrumb Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "<?php echo SITE_URL; ?>"
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": "Case Studies",
            "item": "<?php echo SITE_URL; ?>/case-studies"
        },
        {
            "@type": "ListItem",
            "position": 3,
            "name": "<?php echo e($title ?? ''); ?>"
        }
    ]
}
</script>

<!-- Article Schema (Primary) -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "<?php echo str_replace('"', '\"', $title ?? ''); ?>",
    "description": "<?php echo str_replace('"', '\"', $excerpt ?? ''); ?>",
    "image": "<?php echo SITE_URL . ($image ?? '/assets/images/og-default.png'); ?>",
    "datePublished": "<?php echo $date ?? date('Y-m-d'); ?>",
    "dateModified": "<?php echo $date ?? date('Y-m-d'); ?>",
    "author": {
        "@type": "Person",
        "name": "<?php echo str_replace('"', '\"', $author ?? 'Travis Sutphin'); ?>",
        "jobTitle": "Fractional CTO",
        "url": "<?php echo SITE_URL; ?>/about"
    },
    "publisher": {
        "@type": "Organization",
        "name": "<?php echo SITE_NAME; ?>",
        "logo": {
            "@type": "ImageObject",
            "url": "<?php echo SITE_URL; ?>/assets/images/logo.png"
        }
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?php echo SITE_URL . '/case-studies/' . ($slug ?? ''); ?>"
    },
    "articleSection": "Case Studies",
    "keywords": "<?php echo isset($primaryKeyword) ? $primaryKeyword : ''; ?><?php echo isset($secondaryKeywords) && is_array($secondaryKeywords) ? ', ' . implode(', ', $secondaryKeywords) : ''; ?>",
    "wordCount": "<?php echo str_word_count(strip_tags($html_content ?? $content ?? '')); ?>",
    "about": {
        "@type": "Thing",
        "name": "<?php echo isset($industry) ? e($industry) : 'Technology'; ?>"
    }<?php if (!empty($services) && is_array($services)): ?>,
    "mentions": [
        <?php foreach ($services as $index => $service): ?>
        {
            "@type": "Service",
            "name": "<?php echo str_replace('"', '\"', $service); ?>"
        }<?php echo $index < count($services) - 1 ? ',' : ''; ?>
        <?php endforeach; ?>
    ]
    <?php endif; ?>
}
</script>

<?php if (isset($includeFAQ) && $includeFAQ === true): ?>
<?php
// Parse FAQ content from the case study
$faq_items = [];
if (isset($html_content)) {
    // Look for FAQ section with ## heading
    if (preg_match('/<h2[^>]*>Frequently Asked Questions<\/h2>(.*?)(?=<h2|$)/is', $html_content, $faq_section)) {
        // Extract Q&A pairs - looking for **Q: question** A: answer pattern
        if (preg_match_all('/<p><strong>Q:\s*(.*?)<\/strong><\/p>\s*<p>A:\s*(.*?)<\/p>/is', $faq_section[1], $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $faq_items[] = [
                    'question' => strip_tags($match[1]),
                    'answer' => strip_tags($match[2])
                ];
            }
        }
    }
}
?>
<?php if (!empty($faq_items)): ?>
<!-- FAQPage Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        <?php foreach ($faq_items as $index => $item): ?>
        {
            "@type": "Question",
            "name": "<?php echo str_replace('"', '\"', $item['question']); ?>",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "<?php echo str_replace('"', '\"', $item['answer']); ?>"
            }
        }<?php echo $index < count($faq_items) - 1 ? ',' : ''; ?>
        <?php endforeach; ?>
    ]
}
</script>
<?php endif; ?>
<?php endif; ?>

<?php if (isset($includeReview) && $includeReview === true && isset($aggregateRating)): ?>
<!-- Review Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Review",
    "itemReviewed": {
        "@type": "Service",
        "name": "<?php echo isset($services) && is_array($services) ? implode(', ', $services) : 'Consulting Services'; ?>",
        "provider": {
            "@type": "Organization",
            "name": "<?php echo SITE_NAME; ?>"
        }
    },
    "reviewRating": {
        "@type": "Rating",
        "ratingValue": "<?php echo $aggregateRating['ratingValue'] ?? '5'; ?>",
        "bestRating": "5"
    },
    "author": {
        "@type": "<?php echo isset($client) && $client !== 'Internal' ? 'Organization' : 'Person'; ?>",
        "name": "<?php echo isset($client) ? e($client) : 'Client'; ?>"
    },
    "reviewBody": "<?php echo str_replace('"', '\"', substr($excerpt ?? '', 0, 200)); ?>"
}
</script>
<?php endif; ?>

<!-- Custom JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll to top functionality
    const scrollToTop = document.getElementById('scroll-to-top');

    window.addEventListener('scroll', () => {
        const scrollPosition = window.scrollY;

        // Show/hide scroll to top button
        if (scrollToTop) {
            if (scrollPosition > 500) {
                scrollToTop.classList.remove('opacity-0', 'pointer-events-none');
                scrollToTop.classList.add('opacity-100');
            } else {
                scrollToTop.classList.add('opacity-0', 'pointer-events-none');
                scrollToTop.classList.remove('opacity-100');
            }
        }
    });

    if (scrollToTop) {
        scrollToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offset = 80;
                const targetPosition = target.offsetTop - offset;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>
