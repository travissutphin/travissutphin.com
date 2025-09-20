<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo e($title); ?></title>
<meta name="description" content="<?php echo e($meta_description); ?>">
<meta name="author" content="Travis Sutphin">

<!-- Open Graph -->
<meta property="og:title" content="<?php echo e($title); ?>">
<meta property="og:description" content="<?php echo e($meta_description); ?>">
<meta property="og:image" content="<?php echo SITE_URL . e($og_image); ?>">
<meta property="og:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
<meta property="og:type" content="<?php echo isset($og_type) ? e($og_type) : 'website'; ?>">
<meta property="og:site_name" content="<?php echo SITE_NAME; ?>">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo e($title); ?>">
<meta name="twitter:description" content="<?php echo e($meta_description); ?>">
<meta name="twitter:image" content="<?php echo SITE_URL . e($og_image); ?>">
<meta name="twitter:creator" content="@travissutphin">

<!-- Canonical URL -->
<link rel="canonical" href="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">

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
    "@type" => "WebSite",
    "name" => SITE_NAME,
    "url" => SITE_URL,
    "description" => DEFAULT_META_DESCRIPTION,
    "author" => [
        "@type" => "Person",
        "name" => "Travis Sutphin",
        "url" => SITE_URL,
        "sameAs" => [
            "https://linkedin.com/in/travissutphin",
            "https://github.com/travissutphin",
            "https://twitter.com/travissutphin"
        ]
    ]
];

// Add Article schema for blog posts
if (isset($is_blog_post) && $is_blog_post) {
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "BlogPosting",
        "headline" => $title ?? '',
        "description" => $meta_description ?? '',
        "datePublished" => $date ?? '',
        "dateModified" => $date ?? '',
        "author" => [
            "@type" => "Person",
            "name" => "Travis Sutphin",
            "url" => SITE_URL
        ],
        "publisher" => [
            "@type" => "Person",
            "name" => "Travis Sutphin",
            "url" => SITE_URL
        ],
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => SITE_URL . $_SERVER['REQUEST_URI']
        ]
    ];

    if (!empty($tags)) {
        $schema["keywords"] = implode(", ", $tags);
    }
}

echo json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>
</script>