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

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome for social icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Theme CSS Variables -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/css/theme-variables.css">

    <!-- Home Page Section Styles -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/css/home-sections.css">

    <!-- Services Page Section Styles -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/css/services-sections.css">

    <!-- Projects Page Section Styles -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/css/projects-sections.css">

    <!-- Team Page Section Styles -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/css/team-sections.css">

    <!-- Blog Page Section Styles -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/css/blog-sections.css">

    <!-- Blog Post Page Section Styles -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/css/blog-post-sections.css">

    <!-- Contact Page Section Styles -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/css/contact-sections.css">

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

    <!-- Theme Switcher (Load early to prevent FOUC) -->
    <script src="<?php echo BASE_PATH; ?>/js/theme-switcher.js"></script>

    <!-- Lazy Loading (Load early for performance) -->
    <script src="<?php echo BASE_PATH; ?>/js/lazy-loading.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-green': '#2be256',
                        'dark-green': '#005a00',
                        'primary-blue': '#3d608f',
                        'light-blue': '#8dace1',
                        'dark': '#1a1a1a',
                        'gray-dark': '#4a4a4a',
                        'gray-light': '#f8f9fa'
                    }
                }
            }
        }
    </script>

    <!-- Theme Variables CSS -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/css/theme-variables.css">

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