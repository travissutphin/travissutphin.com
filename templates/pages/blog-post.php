<?php
// Calculate reading time
function calculate_post_reading_time($content) {
    $word_count = str_word_count(strip_tags($content));
    return ceil($word_count / 200);
}

$reading_time = isset($readingTime) ? intval($readingTime) : calculate_post_reading_time($html_content ?? $content ?? '');

// Get all posts for related posts section
$all_posts = get_blog_posts();
$current_slug = $slug ?? '';
$related_posts = array_filter($all_posts, function($post) use ($current_slug, $tags) {
    if ($post['slug'] === $current_slug) return false;
    if (empty($tags)) return true;
    foreach ($tags as $tag) {
        if (isset($post['tags']) && in_array($tag, $post['tags'])) {
            return true;
        }
    }
    return false;
});
$related_posts = array_slice($related_posts, 0, 3);
?>

<!-- Reading Progress Bar -->
<div id="reading-progress" class="reading-progress-bar">
    <div id="progress-bar" class="progress-bar-fill" style="width: 0%"></div>
</div>

<!-- Hero Section with Gradient -->
<section class="gradient-green-blue px-4 py-12 mb-0">
    <div class="max-w-4xl mx-auto text-white">
        <!-- Breadcrumbs -->
        <nav aria-label="Breadcrumb" class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-white/80">
                <li><a href="<?php echo BASE_PATH; ?>/" class="hover:text-white">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="<?php echo BASE_PATH; ?>/blog" class="hover:text-white">Blog</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-white font-semibold truncate max-w-xs"><?php echo e($title ?? 'Post'); ?></li>
            </ol>
        </nav>

	<!-- Meta Info -->
        <div class="flex flex-wrap items-center gap-4 text-white/90">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center">
                    <span class="text-white font-semibold">TS</span>
                </div>
                <div>
                    <p class="font-semibold">Travis Sutphin</p>
                    <p class="text-xs opacity-80">AI-Tech-Solutions</p>
                </div>
            </div>
            <span class="text-white/60">•</span>
            <time class="flex items-center gap-2">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                <?php echo date('F d, Y', strtotime($date ?? 'now')); ?>
            </time>
            <span class="text-white/60">•</span>
            <span class="flex items-center gap-2">
                <i data-lucide="clock" class="w-4 h-4"></i>
                <?php echo $reading_time; ?> min read
            </span>
        </div>
		
		<!-- Tags -->
        <?php if (!empty($tags)): ?>
            <div class="flex flex-wrap gap-2 mt-4">
                <?php foreach ($tags as $tag): ?>
                    <a href="<?php echo BASE_PATH; ?>/blog?tag=<?php echo urlencode($tag); ?>"
                       class="px-3 py-1 bg-white/20 backdrop-blur text-white text-sm rounded-full hover:bg-white/30 transition-colors">
                        <?php echo e($tag); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>      
		
    </div>
</section>

<!-- Featured Image -->
<?php if (!empty($image)): ?>
    <section class="px-4 -mt-8 mb-8">
        <div class="max-w-4xl mx-auto">
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

                $alt_text = htmlspecialchars(strip_tags($title ?? 'Blog post image'));
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
                         loading="lazy"
                         width="1200"
                         height="630">
                </picture>
            </div>
        </div>
    </section>
<?php endif; ?>



		
<!-- Engagement Bar -->
<section class="engagement-bar shadow-sm">
    <div class="max-w-4xl mx-auto px-4 pt-1 pb-3 sm:py-3">
	
		
	
	
	
        <div class="flex items-center justify-between">
            <a href="<?php echo BASE_PATH; ?>/blog" class="back-link flex items-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span class="hidden sm:inline">Back to Blog</span>
                <span class="sm:hidden">Back</span>
            </a>

            <div class="flex items-center gap-3">
                <!-- Share Buttons (Placeholder) -->
                <button onclick="alert('Sharing coming soon!')"
                        class="share-button p-2 rounded-lg"
                        title="Share on Twitter"
                        aria-label="Share on Twitter">
                    <i data-lucide="twitter" class="w-5 h-5"></i>
                </button>
                <button onclick="alert('Sharing coming soon!')"
                        class="share-button p-2 rounded-lg"
                        title="Share on LinkedIn"
                        aria-label="Share on LinkedIn">
                    <i data-lucide="linkedin" class="w-5 h-5"></i>
                </button>
                <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!');"
                        class="share-button p-2 rounded-lg"
                        title="Copy link"
                        aria-label="Copy link to clipboard">
                    <i data-lucide="link" class="w-5 h-5"></i>
                </button>
                <span class="text-gray-400">|</span>
                <button onclick="alert('Comments coming soon!')"
                        class="share-button flex items-center gap-2 px-3 py-1 rounded-lg"
                        aria-label="Join discussion">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span class="hidden sm:inline">Join Discussion</span>
                    <span class="sm:hidden">💬</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Area -->
<article class="article-section py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="lg:flex lg:gap-8">
            <!-- Content Column -->
            <div class="lg:w-3/4">
                <div class="article-content p-8 md:p-12">
                    <!-- Article Content -->
                    <div class="blog-content">
                        <?php
                        if (!empty($html_content)) {
                            echo $html_content;
                        } elseif (!empty($content)) {
                            echo parse_markdown($content);
                        } else {
                            echo '<p>Blog post content is currently unavailable.</p>';
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
                                <h3 class="author-name text-lg font-bold mb-1">Written by Travis Sutphin</h3>
                                <p class="author-description text-sm mb-3">
                                    AI-Tech-Solutions helping founders ship their products.
                                    I turn half-built apps into launched businesses.
                                </p>
                                <a href="<?php echo BASE_PATH; ?>/contact"
                                   class="text-primary-blue hover:text-primary-green transition-colors text-sm font-semibold">
                                    Got a project that needs finishing? Let's chat →
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Comments Placeholder -->
                    <div class="comments-placeholder mt-12 p-8 text-center">
                        <i data-lucide="message-square" class="w-12 h-12 text-gray-400 mx-auto mb-3"></i>
                        <h3 class="text-lg font-semibold text-theme-primary mb-2">Comments Coming Soon!</h3>
                        <p class="text-theme-secondary text-sm">
                            We're building a space for builders to share insights.
                            <br>For now, reach out directly with your thoughts!
                        </p>
                        <a href="<?php echo BASE_PATH; ?>/contact"
                           class="inline-block mt-4 text-primary-blue hover:text-primary-green transition-colors text-sm font-semibold">
                            Start a Conversation →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Desktop Only) -->
            <aside class="hidden lg:block lg:w-1/4">
                <div class="sticky top-20 space-y-6">
                    <!-- Table of Contents -->
                    <div class="toc-widget p-6">
                        <h3 class="toc-title text-lg font-bold mb-4 flex items-center gap-2">
                            <i data-lucide="list" class="w-5 h-5"></i>
                            In This Article
                        </h3>
                        <nav id="table-of-contents" class="space-y-2 text-sm">
                            <!-- TOC will be generated by JavaScript -->
                            <div class="text-theme-secondary">Loading contents...</div>
                        </nav>
                    </div>

                    <!-- Quick Win Tip -->
                    <div class="tip-widget text-white rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-3">💡 Quick Win</h3>
                        <p class="text-sm opacity-95 mb-4">
                            Start with the smallest feature that delivers value. Ship it. Get feedback. Iterate.
                        </p>
                        <p class="text-xs opacity-75">
                            Remember: Done > Perfect
                        </p>
                    </div>

                    <!-- Newsletter Card -->
                    <div class="newsletter-widget p-6">
                        <h3 class="newsletter-title text-lg font-bold mb-3">Get Weekly Insights</h3>
                        <p class="newsletter-text text-sm mb-4">
                            One actionable tip every Thursday to move your project forward.
                        </p>
                        <input type="email"
                               placeholder="Your email..."
                               class="newsletter-input w-full px-3 py-2 rounded-lg text-sm mb-3"
                               onclick="alert('Newsletter launching soon!')">
                        <button class="w-full bg-dark-green text-white py-2 rounded-lg text-sm font-semibold hover:bg-primary-green transition-colors">
                            Save My Spot
                        </button>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</article>

<!-- Related Posts Section -->
<?php if (!empty($related_posts)): ?>
<section class="related-section py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <h2 class="related-title text-3xl font-bold text-center mb-8">Keep the Momentum Going</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($related_posts as $related): ?>
                <article class="related-card">
                    <!-- Thumbnail Placeholder -->
                    <div class="related-thumbnail h-40 rounded-t-lg flex items-center justify-center">
                        <i data-lucide="file-text" class="w-12 h-12 text-gray-400"></i>
                    </div>

                    <div class="p-6">
                        <?php if (!empty($related['tags'])): ?>
                            <span class="inline-block px-2 py-1 bg-light-blue text-primary-blue text-xs font-semibold rounded mb-3">
                                <?php echo e($related['tags'][0]); ?>
                            </span>
                        <?php endif; ?>

                        <h3 class="related-card-title text-lg font-bold mb-2 line-clamp-2">
                            <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($related['slug']); ?>"
                               class="hover:text-primary-blue transition-colors">
                                <?php echo e($related['title'] ?? 'Untitled'); ?>
                            </a>
                        </h3>

                        <p class="related-card-excerpt text-sm line-clamp-3 mb-4">
                            <?php echo e($related['excerpt'] ?? ''); ?>
                        </p>

                        <div class="related-meta flex items-center justify-between text-xs">
                            <span><?php echo date('M d, Y', strtotime($related['date'] ?? 'now')); ?></span>
                            <span><?php
                                $related_reading_time = isset($related['readingTime'])
                                    ? intval($related['readingTime'])
                                    : calculate_post_reading_time($related['content'] ?? '');
                                echo $related_reading_time . ' min read';
                            ?></span>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Newsletter Section -->
<section class="py-12 px-4 gradient-green-blue">
    <div class="max-w-4xl mx-auto text-center text-white">
        <h2 class="text-3xl font-bold mb-4">Enjoying These Insights?</h2>
        <p class="text-xl mb-8 opacity-95">
            Get one actionable tip every week to help you ship faster.
        </p>
        <div class="max-w-md mx-auto">
            <div class="newsletter-backdrop rounded-lg p-6">
                <input type="email"
                       placeholder="Your best email..."
                       class="newsletter-input w-full px-4 py-3 rounded-lg mb-4"
                       onclick="alert('Newsletter launching soon! We\'ll notify you when it\'s ready.')">
                <button class="w-full bg-white text-dark-green py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Join 2,000+ Builders →
                </button>
                <p class="text-xs mt-3 opacity-75">
                    No spam. Unsubscribe anytime.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Community CTA -->
<section class="community-cta-section py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="community-cta-card rounded-lg p-8 text-center">
            <h3 class="community-title text-2xl font-bold mb-4">
                Got Questions? I've Got Answers
            </h3>
            <p class="community-text mb-6 max-w-2xl mx-auto">
                Whether you're stuck on a technical decision or need a fresh perspective on your project,
                I'm here to help. No sales pitch—just builder to builder.
            </p>
            <a href="<?php echo BASE_PATH; ?>/contact"
               class="inline-block bg-gradient-to-r from-primary-green to-primary-blue text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition-all transform hover:scale-105">
                Let's Talk About Your Project →
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

<!-- Structured Data (Schema.org) -->
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
            "name": "Blog",
            "item": "<?php echo SITE_URL; ?>/blog"
        },
        {
            "@type": "ListItem",
            "position": 3,
            "name": "<?php echo e($title ?? ''); ?>"
        }
    ]
}
</script>

<!-- BlogPosting Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": "<?php echo e($title ?? ''); ?>",
    "description": "<?php echo e($excerpt ?? ''); ?>",
    "image": "<?php echo SITE_URL . ($image ?? '/assets/images/og-default.png'); ?>",
    "datePublished": "<?php echo $date ?? date('Y-m-d'); ?>",
    "dateModified": "<?php echo $date ?? date('Y-m-d'); ?>",
    "author": {
        "@type": "Person",
        "name": "<?php echo e($author ?? 'Travis Sutphin'); ?>",
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
        "@id": "<?php echo SITE_URL . '/blog/' . ($slug ?? ''); ?>"
    },
    "keywords": "<?php echo isset($tags) ? implode(', ', $tags) : ''; ?>",
    "articleSection": "<?php echo e($category ?? 'General'); ?>",
    "wordCount": "<?php echo str_word_count(strip_tags($html_content ?? $content ?? '')); ?>"
}
</script>

<?php if (isset($faq) && $faq === true): ?>
<?php
// Parse FAQ content from the blog post
$faq_items = [];
if (isset($html_content)) {
    // Look for FAQ section
    if (preg_match('/<h2[^>]*>FAQ<\/h2>(.*?)(?=<h2|<hr|$)/is', $html_content, $faq_section)) {
        // Extract Q&A pairs
        if (preg_match_all('/<strong>Q: (.*?)<\/strong>\s*(?:<br\s*\/?>)?\s*A: (.*?)(?=<strong>Q:|$)/is', $faq_section[1], $matches)) {
            for ($i = 0; $i < count($matches[1]); $i++) {
                $faq_items[] = [
                    'question' => strip_tags($matches[1][$i]),
                    'answer' => strip_tags($matches[2][$i])
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

<!-- Custom Styles for Blog Content -->
<style>
/* Blog content styles are now in blog-post-sections.css */
</style>

<!-- Enhanced JavaScript for Interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Reading Progress Bar
    const progressBar = document.getElementById('progress-bar');
    const scrollToTop = document.getElementById('scroll-to-top');

    window.addEventListener('scroll', () => {
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPosition = window.scrollY;
        const progress = (scrollPosition / scrollHeight) * 100;

        if (progressBar) {
            progressBar.style.width = progress + '%';
        }

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

    // Scroll to top functionality
    if (scrollToTop) {
        scrollToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Generate Table of Contents
    const tocContainer = document.getElementById('table-of-contents');
    const headings = document.querySelectorAll('.blog-content h2, .blog-content h3');

    if (tocContainer && headings.length > 0) {
        let tocHTML = '<ul class="space-y-2">';
        let currentH2 = null;

        headings.forEach((heading, index) => {
            const id = 'heading-' + index;
            heading.id = id;

            if (heading.tagName === 'H2') {
                if (currentH2) tocHTML += '</ul></li>';
                tocHTML += `<li>
                    <a href="#${id}" class="block py-1 toc-link">
                        ${heading.textContent}
                    </a>`;
                currentH2 = heading;
                tocHTML += '<ul class="ml-4 mt-1 space-y-1">';
            } else if (heading.tagName === 'H3') {
                tocHTML += `<li>
                    <a href="#${id}" class="block py-0.5 text-sm toc-link">
                        ${heading.textContent}
                    </a>
                </li>`;
            }
        });

        if (currentH2) tocHTML += '</ul></li>';
        tocHTML += '</ul>';

        tocContainer.innerHTML = tocHTML;

        // Smooth scroll for TOC links
        document.querySelectorAll('.toc-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(link.getAttribute('href'));
                if (target) {
                    const offset = 80; // Account for sticky header
                    const targetPosition = target.offsetTop - offset;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Highlight current section in TOC
        const observerOptions = {
            rootMargin: '-100px 0px -70% 0px',
            threshold: 0
        };

        const observerCallback = (entries) => {
            entries.forEach(entry => {
                const link = document.querySelector(`.toc-link[href="#${entry.target.id}"]`);
                if (link) {
                    if (entry.isIntersecting) {
                        document.querySelectorAll('.toc-link').forEach(l =>
                            l.classList.remove('text-primary-green', 'font-semibold'));
                        link.classList.add('text-primary-green', 'font-semibold');
                    }
                }
            });
        };

        const observer = new IntersectionObserver(observerCallback, observerOptions);
        headings.forEach(heading => observer.observe(heading));
    } else if (tocContainer) {
        tocContainer.innerHTML = '<p class="text-gray-500 text-sm">No sections found</p>';
    }

    // Add copy button to code blocks
    document.querySelectorAll('pre').forEach((pre) => {
        const wrapper = document.createElement('div');
        wrapper.className = 'relative group';
        pre.parentNode.insertBefore(wrapper, pre);
        wrapper.appendChild(pre);

        const button = document.createElement('button');
        button.className = 'absolute top-2 right-2 px-3 py-1 bg-gray-700 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity';
        button.textContent = 'Copy';
        button.onclick = () => {
            navigator.clipboard.writeText(pre.textContent);
            button.textContent = 'Copied!';
            setTimeout(() => button.textContent = 'Copy', 2000);
        };
        wrapper.appendChild(button);
    });

    // Animate content on scroll - DISABLED due to visibility issues
    // Commenting out animation until we can debug why some posts show blank
    /*
    const animateElements = document.querySelectorAll('.prose > *');

    if ('IntersectionObserver' in window && animateElements.length > 0) {
        const animateObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.transition = 'all 0.6s ease';
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    animateObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        animateElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            animateObserver.observe(el);
        });
    }
    */
});
</script>