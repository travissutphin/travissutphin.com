<!DOCTYPE html>
<html lang="en">
<head>
    <?php render_partial('meta', [
        'title' => $title ?? SITE_NAME,
        'meta_description' => $meta_description ?? DEFAULT_META_DESCRIPTION,
        'og_image' => $og_image ?? DEFAULT_OG_IMAGE,
        'is_blog_post' => $is_blog_post ?? false,
        'og_type' => $og_type ?? 'website',
        'date' => $date ?? null,
        'tags' => $tags ?? [],
        'excerpt' => $excerpt ?? null,
        'html_content' => $html_content ?? null,
        'content' => $content ?? null,
        'readingTime' => $readingTime ?? null,
        'reading_time' => $reading_time ?? null,
        'image' => $image ?? null
    ]); ?>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-46PTMWC8QF"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-46PTMWC8QF');
    </script>

    <!-- Tailwind CSS (pre-built for optimal performance) -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/css/tailwind.css">

    <!-- Font Awesome for social icons (deferred for non-blocking load) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>

    <!-- Lucide Icons (deferred for non-blocking load) -->
    <script src="https://unpkg.com/lucide@latest" defer></script>

    <!-- Theme CSS Variables -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/css/theme-variables.css">

    <!-- Page-Specific Styles (conditional loading for performance) -->
    <?php
    // Determine which CSS to load based on current URL path
    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    $css_file = null;

    // Check URL path to determine page type
    if (strpos($request_uri, '/blog/') !== false && strpos($request_uri, '/blog/category/') === false) {
        // Individual blog post
        $css_file = 'blog-post-sections.css';
    } elseif (strpos($request_uri, '/blog') !== false || strpos($request_uri, '/blog/category/') !== false) {
        // Blog list page or category
        $css_file = 'blog-sections.css';
    } elseif (strpos($request_uri, '/services') !== false) {
        $css_file = 'services-sections.css';
    } elseif (strpos($request_uri, '/projects') !== false) {
        $css_file = 'projects-sections.css';
    } elseif (strpos($request_uri, '/team') !== false) {
        $css_file = 'team-sections.css';
    } elseif (strpos($request_uri, '/contact') !== false) {
        $css_file = 'contact-sections.css';
    } elseif (strpos($request_uri, '/home') !== false || $request_uri === '' || $request_uri === '/' || $request_uri === '/home') {
        $css_file = 'home-sections.css';
    }

    // Load the determined CSS file
    if ($css_file !== null) {
        echo '<link rel="stylesheet" href="' . BASE_PATH . '/css/' . $css_file . '">' . "\n";
    }
    ?>

    <!-- Set dark theme immediately to prevent FOUC -->
    <script>
        (function() {
            try {
                // Check for saved theme preference
                const savedTheme = localStorage.getItem('preferred-theme');
                // Default to dark mode if no preference is saved
                const theme = savedTheme || 'dark';

                if (theme === 'dark') {
                    document.documentElement.setAttribute('data-theme', 'dark');
                }
            } catch (e) {
                // Fallback to dark mode if localStorage fails
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>

    <!-- Theme Switcher (deferred - theme is already set by inline script above) -->
    <script src="<?php echo BASE_PATH; ?>/js/theme-switcher.js" defer></script>

    <!-- Lazy Loading (deferred - runs after page load) -->
    <script src="<?php echo BASE_PATH; ?>/js/lazy-loading.js" defer></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/style.css">
</head>
<body class="min-h-screen flex flex-col bg-theme-primary text-theme-primary">
    <?php render_partial('header'); ?>

    <main class="flex-grow">
        <?php echo $content; ?>
    </main>

    <?php render_partial('footer'); ?>

    <?php render_partial('bottom-nav'); ?>

    <!-- Initialize scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Initialize Lucide icons
            lucide.createIcons();

            // Simple scroll animations
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                        }
                    });
                }, {
                    threshold: 0.1
                });

                // Add animate-on-scroll class to elements we want to animate
                document.querySelectorAll('section').forEach((el, index) => {
                    // Skip the first hero section
                    if (index > 0) {
                        el.classList.add('animate-on-scroll');
                    }
                });

                // Also add to cards and articles (but skip blog post article-section)
                document.querySelectorAll('.card-hover, article:not(.article-section)').forEach(el => {
                    el.classList.add('animate-on-scroll');
                });

                // Observe all elements with animate-on-scroll class
                document.querySelectorAll('.animate-on-scroll').forEach(el => {
                    observer.observe(el);
                });
            }

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
        });
    </script>
</body>
</html>