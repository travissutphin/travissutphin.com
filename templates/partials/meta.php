<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo e($title); ?></title>
<meta name="description" content="<?php echo e(isset($excerpt) ? $excerpt : $meta_description); ?>">
<?php if (isset($keywords)): ?>
<meta name="keywords" content="<?php echo e($keywords); ?>">
<?php endif; ?>
<meta name="author" content="Travis Sutphin">
<?php if (isset($noindex) && $noindex === true): ?>
<meta name="robots" content="noindex, nofollow">
<?php endif; ?>

<!-- Open Graph -->
<meta property="og:title" content="<?php echo e(isset($og_title) ? $og_title : $title); ?>">
<meta property="og:description" content="<?php echo e(isset($og_description) ? $og_description : (isset($excerpt) ? $excerpt : $meta_description)); ?>">
<meta property="og:image" content="<?php echo (isset($og_image) && strpos($og_image, 'http') === 0) ? e($og_image) : SITE_URL . e($og_image); ?>">
<meta property="og:url" content="<?php echo isset($canonical) ? e($canonical) : SITE_URL . $_SERVER['REQUEST_URI']; ?>">
<meta property="og:type" content="<?php echo isset($og_type) ? e($og_type) : 'website'; ?>">
<meta property="og:site_name" content="<?php echo SITE_NAME; ?>">

<!-- Twitter Card -->
<meta name="twitter:card" content="<?php echo isset($twitter_card) ? e($twitter_card) : 'summary_large_image'; ?>">
<meta name="twitter:title" content="<?php echo e(isset($twitter_title) ? $twitter_title : $title); ?>">
<meta name="twitter:description" content="<?php echo e(isset($twitter_description) ? $twitter_description : (isset($excerpt) ? $excerpt : $meta_description)); ?>">
<meta name="twitter:image" content="<?php echo (isset($og_image) && strpos($og_image, 'http') === 0) ? e($og_image) : SITE_URL . e($og_image); ?>">
<meta name="twitter:creator" content="@travissutphin">

<!-- Canonical URL -->
<link rel="canonical" href="<?php echo isset($canonical) ? e($canonical) : SITE_URL . $_SERVER['REQUEST_URI']; ?>">

<!-- Favicons -->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_PATH; ?>/favicon_io/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_PATH; ?>/favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_PATH; ?>/favicon_io/favicon-16x16.png">
<link rel="manifest" href="<?php echo BASE_PATH; ?>/favicon_io/site.webmanifest">
<link rel="icon" href="<?php echo BASE_PATH; ?>/favicon_io/favicon.ico" type="image/x-icon">

<!-- Schema.org JSON-LD -->
<script type="application/ld+json">
<?php
$schema = [
    "@context" => "https://schema.org",
    "@type" => ["WebSite", "ProfessionalService"],
    "name" => SITE_NAME,
    "url" => SITE_URL,
    "description" => DEFAULT_META_DESCRIPTION,
    "serviceType" => "AI Project Completion and Technical Consulting",
    "provider" => [
        "@type" => "Person",
        "name" => "Travis Sutphin",
        "jobTitle" => "AI-Tech-Solutions Consultant",
        "url" => SITE_URL,
        "sameAs" => [
            "https://linkedin.com/in/travissutphin",
            "https://github.com/travissutphin",
            "https://twitter.com/travissutphin"
        ]
    ],
    "hasOfferCatalog" => [
        "@type" => "OfferCatalog",
        "name" => "AI Project Completion Services",
        "itemListElement" => [
            [
                "@type" => "Offer",
                "itemOffered" => [
                    "@type" => "Service",
                    "name" => "AI Project Completion",
                    "description" => "Complete stuck AI projects and deploy them to production"
                ]
            ],
            [
                "@type" => "Offer",
                "itemOffered" => [
                    "@type" => "Service",
                    "name" => "AI Integration",
                    "description" => "Add AI automation and intelligent features to existing applications"
                ]
            ],
            [
                "@type" => "Offer",
                "itemOffered" => [
                    "@type" => "Service",
                    "name" => "AI-Tech-Solutions",
                    "description" => "Strategic technical leadership for AI and automation projects"
                ]
            ]
        ]
    ],
    "areaServed" => "Worldwide",
    "author" => [
        "@type" => "Person",
        "name" => "Travis Sutphin",
        "url" => SITE_URL
    ]
];

// Add Article schema for blog posts
if (isset($is_blog_post) && $is_blog_post) {
    // Use excerpt for description if available, otherwise use meta_description
    $blog_description = isset($excerpt) ? $excerpt : $meta_description;

    // Get article body text for Read Aloud feature
    $article_text = '';
    if (isset($html_content)) {
        $article_text = strip_tags($html_content);
    } elseif (isset($content)) {
        $article_text = strip_tags(parse_markdown($content));
    }

    // Calculate accurate word count
    $actual_word_count = !empty($article_text) ? str_word_count($article_text) : 500;

    $schema = [
        "@context" => "https://schema.org",
        "@type" => "BlogPosting",
        "headline" => $title ?? '',
        "description" => $blog_description,
        "articleBody" => $article_text, // Required for Chrome Read Aloud
        "datePublished" => isset($date) ? date('c', strtotime($date . ' 09:00:00')) : '',
        "dateModified" => isset($date) ? date('c', strtotime($date . ' 09:00:00')) : '',
        "author" => [
            "@type" => "Person",
            "name" => "Travis Sutphin",
            "url" => SITE_URL,
            "sameAs" => [
                "https://linkedin.com/in/travissutphin",
                "https://twitter.com/travissutphin"
            ]
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => SITE_NAME,
            "url" => SITE_URL,
            "logo" => [
                "@type" => "ImageObject",
                "url" => SITE_URL . "/favicon_io/apple-touch-icon.png",
                "width" => 180,
                "height" => 180
            ]
        ],
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => SITE_URL . $_SERVER['REQUEST_URI']
        ],
        "wordCount" => $actual_word_count,
        "timeRequired" => "PT" . (isset($readingTime) ? intval($readingTime) : (isset($reading_time) ? intval($reading_time) : ceil($actual_word_count / 200))) . "M",
        "articleSection" => isset($tags) && !empty($tags) ? $tags[0] : "Technology",
        "inLanguage" => "en-US"
    ];

    if (!empty($tags)) {
        $schema["keywords"] = implode(", ", $tags);
    }

    // Add image if available
    if (!empty($image)) {
        $schema["image"] = [
            "@type" => "ImageObject",
            "url" => SITE_URL . trim(trim($image), '"'),
            "width" => 1200,
            "height" => 630
        ];
    }
}

echo json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>
</script>