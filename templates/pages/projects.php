<!-- Hero Section - Matching Site Style -->
<section class="min-h-hero flex items-center gradient-green-blue px-4 py-16">
    <div class="max-w-7xl mx-auto">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                Free Resources & Portfolio Projects
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                Production-ready templates, free stock photos, and real client work that shipped and scaled.
            </p>
        </div>
    </div>
</section>

<!-- Free HTML Templates Section -->
<section id="free-templates" class="free-templates-section py-16 px-4 bg-theme-secondary">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4 text-theme-primary">Free HTML Templates</h2>
            <p class="text-xl max-w-3xl mx-auto text-theme-secondary mb-4">
                Production-ready templates built with Bootstrap & Tailwind. Download, customize, launch. No strings attached.
            </p>
            <p class="text-sm max-w-2xl mx-auto text-theme-tertiary">
                Why free? I built these for client projects. You get production-ready code. I get to showcase my work. Win-win.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            // Load free templates from JSON
            $templates_json = file_get_contents(__DIR__ . '/../../content/data/free-templates.json');
            $templates_data = json_decode($templates_json, true);
            $free_templates = $templates_data['templates'] ?? [];

            foreach ($free_templates as $template): ?>
                <div class="template-card bg-theme-card border border-theme-primary rounded-lg shadow-lg overflow-hidden group hover:shadow-xl transition-shadow duration-300">
                    <!-- Template Preview Image -->
                    <div class="aspect-video bg-theme-tertiary overflow-hidden">
                        <?php if (!empty($template['preview_image'])): ?>
                            <a href="<?php echo BASE_PATH . e($template['preview_url']); ?>" target="_blank" rel="noopener noreferrer">
                                <img src="<?php echo BASE_PATH . e($template['preview_image']); ?>"
                                     alt="<?php echo e($template['name']); ?> Preview"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                            </a>
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <i data-lucide="file-code" class="w-16 h-16 text-theme-tertiary"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Template Info -->
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="text-xl font-bold">
                                    <?php echo e($template['name']); ?>
                                </h3>
                                <div class="flex gap-2 items-center">
                                    <span class="px-2 py-1 bg-primary-blue bg-opacity-10 text-primary-blue text-xs font-semibold rounded">
                                        <?php echo e($template['framework']); ?>
                                    </span>
                                    <span class="text-xs text-theme-tertiary">
                                        <?php echo e($template['file_size']); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <p class="text-theme-primary mb-4 text-sm">
                            <?php echo e($template['description']); ?>
                        </p>

                        <!-- Features/Tech Stack -->
                        <?php if (!empty($template['tech_stack'])): ?>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php foreach ($template['tech_stack'] as $tech): ?>
                                <span class="tech-tag px-2 py-1 text-xs rounded bg-theme-tertiary text-theme-primary">
                                    <?php echo e($tech); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <a href="<?php echo BASE_PATH . e($template['preview_url']); ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="flex-1 inline-flex items-center justify-center gap-2 bg-primary-blue text-white hover:bg-opacity-90 px-4 py-2 rounded-lg font-semibold text-sm transition-all">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                                Preview
                            </a>
                            <a href="<?php echo BASE_PATH; ?>/download-template.php?id=<?php echo e($template['id']); ?>"
                               class="flex-1 inline-flex items-center justify-center gap-2 bg-primary-green text-black hover:bg-opacity-90 px-4 py-2 rounded-lg font-semibold text-sm transition-all">
                                <i data-lucide="download" class="w-4 h-4"></i>
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($free_templates)): ?>
        <div class="text-center py-12">
            <p class="text-theme-secondary">New templates coming soon! Check back regularly for updates.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Schema.org Structured Data for Free Templates -->
<?php if (!empty($free_templates)): ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ItemList",
    "name": "Free HTML Templates",
    "description": "Production-ready HTML templates for developers and businesses",
    "itemListElement": [
        <?php
        $template_schemas = [];
        foreach ($free_templates as $index => $template) {
            $template_schemas[] = json_encode([
                "@type" => "ListItem",
                "position" => $index + 1,
                "item" => [
                    "@type" => "SoftwareSourceCode",
                    "name" => $template['name'],
                    "description" => $template['description'],
                    "programmingLanguage" => "HTML",
                    "runtimePlatform" => $template['framework'],
                    "codeRepository" => SITE_URL . $template['download_url'],
                    "author" => [
                        "@type" => "Person",
                        "name" => "Travis Sutphin",
                        "url" => SITE_URL
                    ],
                    "dateModified" => $template['last_updated'],
                    "offers" => [
                        "@type" => "Offer",
                        "price" => "0",
                        "priceCurrency" => "USD",
                        "availability" => "https://schema.org/InStock"
                    ]
                ]
            ], JSON_UNESCAPED_SLASHES);
        }
        echo implode(",\n        ", $template_schemas);
        ?>
    ]
}
</script>
<?php endif; ?>

<!-- Free Stock Photos Section -->
<section id="free-stock-photos" class="free-stock-photos-section py-16 px-4">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4 text-theme-primary">Free Stock Photos</h2>
            <p class="text-xl max-w-3xl mx-auto text-theme-secondary mb-4">
                High-quality images for commercial and personal use. No attribution required.
            </p>
            <p class="text-sm max-w-2xl mx-auto text-theme-tertiary">
                AI-generated stock photos. Download full resolution PNGs for free. Use them anywhere.
            </p>
        </div>

        <?php
        // Load free stock photos from JSON
        $photos_json = file_get_contents(__DIR__ . '/../../content/data/free-stock-photos.json');
        $photos_data = json_decode($photos_json, true);
        $categories = $photos_data['categories'] ?? [];
        $photos = $photos_data['photos'] ?? [];
        ?>

        <!-- Category Filter -->
        <div class="flex flex-wrap justify-center gap-3 mb-8">
            <?php foreach ($categories as $category): ?>
                <button type="button"
                        class="photo-filter-btn px-4 py-2 rounded-full text-sm font-semibold transition-all <?php echo $category['id'] === 'all' ? 'bg-primary-green text-black' : 'bg-theme-tertiary text-theme-primary hover:bg-primary-blue hover:text-white'; ?>"
                        data-category="<?php echo e($category['id']); ?>">
                    <?php echo e($category['name']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Photo Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" id="photo-grid">
            <?php foreach ($photos as $photo): ?>
                <div class="photo-card bg-theme-card border border-theme-primary rounded-lg shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300"
                     data-category="<?php echo e($photo['category']); ?>">
                    <!-- Photo Thumbnail -->
                    <div class="aspect-square bg-theme-tertiary overflow-hidden relative">
                        <img src="<?php echo BASE_PATH . e($photo['thumbnail']); ?>"
                             alt="<?php echo e($photo['alt']); ?>"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy">
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex gap-3">
                                <button type="button"
                                        class="photo-preview-btn bg-white text-gray-800 hover:bg-gray-100 p-3 rounded-full shadow-lg"
                                        data-photo-id="<?php echo e($photo['id']); ?>"
                                        data-photo-src="<?php echo BASE_PATH . e($photo['download']); ?>"
                                        data-photo-title="<?php echo e($photo['title']); ?>"
                                        data-photo-desc="<?php echo e($photo['description']); ?>"
                                        title="Preview">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                                <a href="<?php echo BASE_PATH; ?>/download-photo.php?id=<?php echo e($photo['id']); ?>"
                                   class="bg-primary-green text-black hover:bg-opacity-90 p-3 rounded-full shadow-lg"
                                   title="Download">
                                    <i data-lucide="download" class="w-5 h-5"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Info -->
                    <div class="p-4">
                        <h3 class="font-semibold text-theme-primary text-sm mb-1">
                            <?php echo e($photo['title']); ?>
                        </h3>
                        <div class="flex items-center justify-between text-xs text-theme-tertiary">
                            <span class="capitalize"><?php echo e($photo['category']); ?></span>
                            <span><?php echo e($photo['file_size']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($photos)): ?>
        <div class="text-center py-12">
            <p class="text-theme-secondary">New photos coming soon! Check back regularly for updates.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Photo Lightbox Modal -->
<div id="photo-lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-90">
    <button type="button" id="lightbox-close" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors">
        <i data-lucide="x" class="w-8 h-8"></i>
    </button>
    <div class="max-w-5xl mx-auto p-4">
        <img id="lightbox-image" src="" alt="" class="max-h-[80vh] mx-auto rounded-lg shadow-2xl">
        <div class="text-center mt-4">
            <h3 id="lightbox-title" class="text-white text-xl font-semibold mb-2"></h3>
            <p id="lightbox-desc" class="text-gray-300 mb-4"></p>
            <a id="lightbox-download" href="" class="inline-flex items-center gap-2 bg-primary-green text-black hover:bg-opacity-90 px-6 py-3 rounded-lg font-semibold transition-all">
                <i data-lucide="download" class="w-5 h-5"></i>
                Download Full Resolution
            </a>
        </div>
    </div>
</div>

<!-- Stock Photos JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Category Filter
    const filterBtns = document.querySelectorAll('.photo-filter-btn');
    const photoCards = document.querySelectorAll('.photo-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const category = this.dataset.category;

            // Update active button styles
            filterBtns.forEach(b => {
                b.classList.remove('bg-primary-green', 'text-black');
                b.classList.add('bg-theme-tertiary', 'text-theme-primary');
            });
            this.classList.remove('bg-theme-tertiary', 'text-theme-primary');
            this.classList.add('bg-primary-green', 'text-black');

            // Filter photos
            photoCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Lightbox
    const lightbox = document.getElementById('photo-lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDesc = document.getElementById('lightbox-desc');
    const lightboxDownload = document.getElementById('lightbox-download');
    const lightboxClose = document.getElementById('lightbox-close');
    const previewBtns = document.querySelectorAll('.photo-preview-btn');

    previewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const photoId = this.dataset.photoId;
            const photoSrc = this.dataset.photoSrc;
            const photoTitle = this.dataset.photoTitle;
            const photoDesc = this.dataset.photoDesc;

            lightboxImage.src = photoSrc;
            lightboxImage.alt = photoTitle;
            lightboxTitle.textContent = photoTitle;
            lightboxDesc.textContent = photoDesc;
            lightboxDownload.href = '<?php echo BASE_PATH; ?>/download-photo.php?id=' + photoId;

            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';

            // Re-initialize Lucide icons in lightbox
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    });

    lightboxClose.addEventListener('click', function() {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = '';
    });

    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            lightboxClose.click();
        }
    });

    // ESC key to close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !lightbox.classList.contains('hidden')) {
            lightboxClose.click();
        }
    });
});
</script>

<!-- Schema.org Structured Data for Stock Photos -->
<?php if (!empty($photos)): ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ImageGallery",
    "name": "Free Stock Photos by Travis Sutphin",
    "description": "High-quality, free stock photos for commercial and personal use. No attribution required.",
    "url": "<?php echo SITE_URL; ?>/projects#free-stock-photos",
    "author": {
        "@type": "Person",
        "name": "Travis Sutphin",
        "url": "<?php echo SITE_URL; ?>"
    },
    "license": "https://creativecommons.org/publicdomain/zero/1.0/",
    "image": [
        <?php
        $photo_schemas = [];
        foreach ($photos as $photo) {
            $photo_schemas[] = json_encode([
                "@type" => "ImageObject",
                "name" => $photo['title'],
                "description" => $photo['description'],
                "contentUrl" => SITE_URL . $photo['download'],
                "thumbnailUrl" => SITE_URL . $photo['thumbnail'],
                "width" => $photo['dimensions']['width'],
                "height" => $photo['dimensions']['height'],
                "encodingFormat" => "image/png",
                "license" => "https://creativecommons.org/publicdomain/zero/1.0/",
                "acquireLicensePage" => SITE_URL . "/projects#free-stock-photos",
                "creditText" => "Travis Sutphin",
                "creator" => [
                    "@type" => "Person",
                    "name" => "Travis Sutphin"
                ],
                "datePublished" => $photo['date_added']
            ], JSON_UNESCAPED_SLASHES);
        }
        echo implode(",\n        ", $photo_schemas);
        ?>
    ]
}
</script>
<?php endif; ?>


<!-- Featured Projects -->
<section class="featured-projects-section py-16 px-4">
    <div class="floating-shape floating-shape-1"></div>
    <div class="floating-shape floating-shape-2"></div>
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Featured Projects</h2>
            <p class="text-xl max-w-3xl mx-auto">
                From MVP to market leader. See how we help founders go from idea to income.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $projects = [
                [
                    'name' => 'Thorium90.app',
                    'category' => 'AI-Powered CMS',
                    'description' => 'Next-generation content management system with AI-driven workflows, automated publishing, and intelligent content optimization. Built for teams who ship fast.',
                    'logo' => '/assets/images/projects/thorium90-project-image-official.png',
                    'link' => 'https://thorium90.app',
                    'case_study_link' => '/case-studies/2025-11-13-thorium90-app',
                    'tech' => ['React', 'Node.js', 'PostgreSQL', 'OpenAI', 'Prisma'],
                    'status' => 'live',
                    'highlight' => true
                ],
                [
                    'name' => 'rapidPRD.app',
                    'category' => 'Product Management',
                    'description' => 'Generate production-ready PRDs with user stories in minutes, not days. AI-powered requirements documentation that engineering teams actually use.',
                    'logo' => '/assets/images/projects/rapidprd-project-image-official.png',
                    'link' => 'https://rapidprd.app',
                    'tech' => ['Next.js', 'TypeScript', 'OpenAI', 'Tailwind', 'Stripe'],
                    'status' => 'live'
                ],
                [
                    'name' => 'TechPulseDaily.app',
                    'category' => 'Tech News',
                    'description' => 'AI-curated tech news aggregator delivering the most important stories in AI, startups, and software development. No database, pure RSS intelligence.',
                    'logo' => '/assets/images/projects/techpulsedaily-project-image-official.png',
                    'link' => 'https://techpulsedaily.app',
                    'tech' => ['PHP 8+', 'RSS Feeds', 'OpenAI', 'Tailwind', 'Railway'],
                    'status' => 'live'
                ],
                [
                    'name' => 'Recipe Only Website',
                    'category' => 'Food & Recipe',
                    'description' => '',
                    'logo' => '/assets/images/projects/just-the-recipe.png',
                    'link' => '',
                    'tech' => [],
                    'status' => 'production'
                ],
                [
                    'name' => 'FrontDoorDirectory.com',
                    'category' => 'Local Business Directory',
                    'description' => 'Free directory platform that gives home-based entrepreneurs enterprise-grade SEO visibility. Schema.org structured data, AI-optimized content, and location-based discovery—all at zero cost.',
                    'logo' => '/assets/images/projects/frontdoor-directory-project-image-official.png',
                    'link' => 'https://frontdoordirectory.com',
                    'case_study_link' => '/case-studies/2025-11-29-frontdoor-directory',
                    'tech' => ['Next.js 14', 'React', 'PostgreSQL', 'Prisma', 'Tailwind', 'Railway'],
                    'status' => 'live'
                ],
                [
                    'name' => 'AI Job Scrapper',
                    'category' => '',
                    'description' => '',
                    'logo' => '/assets/images/projects/project-placeholder-default.png',
                    'link' => '',
                    'tech' => [],
                    'status' => 'queue'
                ],
				[
                    'name' => 'Website Legal Boiler Plate',
                    'category' => '',
                    'description' => '',
                    'logo' => '/assets/images/projects/project-placeholder-default.png',
                    'link' => '',
                    'tech' => [],
                    'status' => 'queue'
                ],
				[
                    'name' => 'A Tourists Guide to St Augustine',
                    'category' => '',
                    'description' => '',
                    'logo' => '/assets/images/projects/project-placeholder-default.png',
                    'link' => '',
                    'tech' => [],
                    'status' => 'queue'
                ],
				[
                    'name' => 'Simple CRM',
                    'category' => '',
                    'description' => '',
                    'logo' => '/assets/images/projects/project-placeholder-default.png',
                    'link' => '',
                    'tech' => [],
                    'status' => 'queue'
                ]
            ];

            foreach ($projects as $project): ?>
                <div class="project-card bg-white rounded-lg shadow-lg overflow-hidden group <?php echo isset($project['highlight']) && $project['highlight'] ? 'ring-2 ring-primary-green' : ''; ?>">
                    <?php if (isset($project['highlight']) && $project['highlight']): ?>
                        <div class="bg-gradient-to-r from-primary-green to-primary-blue text-white text-center py-1 text-xs font-semibold">
                            FEATURED PROJECT • AI-Powered CMS Platform
                        </div>
                    <?php endif; ?>

                    <!-- Project Logo/Screenshot -->
                    <div class="aspect-video bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                        <?php
                        $logo_path = $project['logo'];
                        if (!empty($logo_path)) {
                            $webp_path = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $logo_path);
                        ?>
                            <picture>
                                <source srcset="<?php echo BASE_PATH . e($webp_path); ?>" type="image/webp">
                                <img src="<?php echo BASE_PATH . e($logo_path); ?>"
                                     alt="<?php echo e($project['name']); ?>"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                            </picture>
                        <?php } ?>
                    </div>

                    <!-- Project Info -->
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="text-xl font-bold">
                                    <?php echo e($project['name']); ?>
                                </h3>
                                <p class="text-sm text-primary-blue font-semibold">
                                    <?php echo e($project['category']); ?>
                                </p>
                            </div>
                            <?php if ($project['status'] === 'live'): ?>
                                <span class="px-2 py-1 bg-primary-green text-xs font-semibold rounded-full" style="color: #000000 !important;">
                                    LIVE
                                </span>
                            <?php elseif ($project['status'] === 'production'): ?>
                                <span class="px-2 py-1 bg-primary-blue text-white text-xs font-semibold rounded-full">
                                    IN PRODUCTION
                                </span>
                            <?php elseif ($project['status'] === 'queue'): ?>
                                <span class="px-2 py-1 bg-gray-400 text-white text-xs font-semibold rounded-full">
                                    IN QUEUE
                                </span>
                            <?php endif; ?>
                        </div>

                        <p class="text-gray-dark mb-4 text-sm">
                            <?php echo e($project['description']); ?>
                        </p>

                        <!-- Tech Stack -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php foreach ($project['tech'] as $tech): ?>
                                <span class="tech-tag px-2 py-1 text-xs rounded">
                                    <?php echo e($tech); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <!-- View Project Links -->
                        <div class="flex gap-3">
                            <?php if (!empty($project['link'])): ?>
                                <a href="<?php echo e($project['link']); ?>"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center gap-2 text-primary-blue hover:text-primary-green transition-colors font-semibold">
                                    View Project
                                    <i data-lucide="external-link" class="w-4 h-4"></i>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($project['case_study_link'])): ?>
                                <a href="<?php echo BASE_PATH . e($project['case_study_link']); ?>"
                                   class="inline-flex items-center gap-2 text-primary-green hover:text-primary-blue transition-colors font-semibold">
                                    Case Study
                                    <i data-lucide="file-text" class="w-4 h-4"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Schema.org Structured Data for Featured Projects -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ItemList",
    "name": "Featured Web Development Projects",
    "description": "Portfolio of live web applications and SaaS products built by Travis Sutphin",
    "itemListElement": [
        <?php
        $live_projects = array_filter($projects, fn($p) => $p['status'] === 'live' && !empty($p['link']));
        $project_schemas = [];
        $position = 1;
        foreach ($live_projects as $project) {
            $schema_item = [
                "@type" => "ListItem",
                "position" => $position,
                "item" => [
                    "@type" => "WebApplication",
                    "name" => $project['name'],
                    "description" => $project['description'],
                    "url" => $project['link'],
                    "applicationCategory" => $project['category'],
                    "operatingSystem" => "Web Browser",
                    "offers" => [
                        "@type" => "Offer",
                        "price" => "0",
                        "priceCurrency" => "USD"
                    ],
                    "author" => [
                        "@type" => "Person",
                        "name" => "Travis Sutphin",
                        "url" => SITE_URL
                    ]
                ]
            ];
            $project_schemas[] = json_encode($schema_item, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            $position++;
        }
        echo implode(",\n        ", $project_schemas);
        ?>
    ]
}
</script>

<!-- Client Testimonial -->
<section class="testimonial-section py-16 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="testimonial-card rounded-lg shadow-lg p-8 md:p-12">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center">
                        <i data-lucide="quote" class="w-8 h-8 text-white"></i>
                    </div>
                </div>
                <div>
                    <blockquote class="text-lg text-theme-primary mb-4">
                        "I tried implementing Travis's open source code myself - figured how hard could it be? Three weeks later, I hired him.
                        He finished our stuck AI project in 5 days. The guy literally gives away expert-level code just to prove his point."
                    </blockquote>
                    <cite class="text-sm">
                        <span class="font-semibold text-theme-primary">Marcus Chen</span>
                        <span class="text-theme-secondary"> — Solo Developer, FinTech Startup</span>
                    </cite>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Current Projects / Coming Soon -->
<section class="building-section py-16 px-4">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Currently Building</h2>
            <p class="text-xl max-w-3xl mx-auto">
                Exciting projects in development. Reserve your spot for Q1 2025.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <?php
            $upcoming = [
                [
                    'name' => 'AI Legal Assistant',
                    'category' => 'LegalTech',
                    'status' => 'In Development',
                    'completion' => '65%'
                ],
                [
                    'name' => 'SmartInventory',
                    'category' => 'Supply Chain',
                    'status' => 'In Development',
                    'completion' => '40%'
                ],
                [
                    'name' => 'CryptoTax Pro',
                    'category' => 'FinTech',
                    'status' => 'Planning',
                    'completion' => '15%'
                ]
            ];

            foreach ($upcoming as $project): ?>
                <div class="progress-card">
                    <h3 class="font-bold mb-2"><?php echo e($project['name']); ?></h3>
                    <p class="text-sm text-primary-blue font-semibold mb-3"><?php echo e($project['category']); ?></p>
                    <div class="mb-2">
                        <div class="flex justify-between text-sm mb-1">
                            <span><?php echo e($project['status']); ?></span>
                            <span class="font-semibold"><?php echo e($project['completion']); ?></span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar-fill"
                                 style="width: <?php echo e($project['completion']); ?>"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="projects-cta-section py-16 px-4 gradient-green-blue">
    <div class="max-w-4xl mx-auto text-center text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Ready to See Your Project Here?
        </h2>
        <p class="text-xl mb-8 opacity-95">
            Join these successful founders. Let's turn your idea into a live, profitable product.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo BASE_PATH; ?>/contact"
               class="bg-white text-dark-green hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg transition-all transform hover:scale-105 shadow-lg">
                Start Your Project →
            </a>
            <a href="<?php echo BASE_PATH; ?>/services"
               class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-dark-green px-8 py-4 rounded-lg font-semibold text-lg transition-all">
                View Services
            </a>
        </div>
    </div>
</section>
