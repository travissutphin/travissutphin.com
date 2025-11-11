<!-- Hero Section - Matching Site Style -->
<section class="min-h-hero flex items-center gradient-green-blue px-4 py-16">
    <div class="max-w-7xl mx-auto">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                Free HTML Templates & Portfolio Projects
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                Production-ready Bootstrap & Tailwind templates (free forever) + real client work that shipped and scaled.
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
                                <h3 class="text-xl font-bold text-dark-green">
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
                    'name' => 'Kickstand - Your New WebSite',
                    'category' => 'Open Source',
                    'description' => 'Complete business website with AI deployment automation. Full source code on GitHub. Three options: DIY with the free code, partner with me, or I build it for you.',
                    'logo' => '/assets/images/travissutphincom-avatar-green.png',
                    'link' => 'https://github.com/travissutphin/travissutphin.com',
                    'tech' => ['PHP 8+', 'Tailwind CSS', 'AI Integration', 'GitHub'],
                    'status' => 'live',
                    'highlight' => true
                ],
                [
                    'name' => 'TechPulseDaily.app',
                    'category' => 'Open Source',
                    'description' => 'AI-Powered Tech News Aggregator - No database required',
                    'logo' => '/assets/images/projects/techpulsedaily-badge.png',
                    'link' => '',
                    'tech' => [],
                    'status' => 'production'
                ],
                [
                    'name' => 'AI Website Builder',
                    'category' => 'Open Source',
                    'description' => '',
                    'logo' => '',
                    'link' => '',
                    'tech' => [],
                    'status' => 'queue'
                ],
                [
                    'name' => 'Reciept Only Website',
                    'category' => 'Open Source',
                    'description' => '',
                    'logo' => '',
                    'link' => '',
                    'tech' => [],
                    'status' => 'Queue'
                ],
                [
                    'name' => 'AI Job Scrapper',
                    'category' => 'Open Source',
                    'description' => '',
                    'logo' => '',
                    'link' => '',
                    'tech' => [],
                    'status' => 'Queue'
                ],
                [
                    'name' => 'PRD Generation Platform (w/ User Stories)',
                    'category' => 'Open Source',
                    'description' => '',
                    'logo' => '',
                    'link' => '',
                    'tech' => [],
                    'status' => 'Queue'
                ],
				[
                    'name' => 'Website Legal Boiler Plate',
                    'category' => 'Open Source',
                    'description' => '',
                    'logo' => '',
                    'link' => '',
                    'tech' => [],
                    'status' => 'Queue'
                ],
				[
                    'name' => 'A Tourists Guide to St Augustine',
                    'category' => 'Open Source',
                    'description' => '',
                    'logo' => '',
                    'link' => '',
                    'tech' => [],
                    'status' => 'Queue'
                ],
				[
                    'name' => 'Simple CRM',
                    'category' => 'Open Source',
                    'description' => '',
                    'logo' => '',
                    'link' => '',
                    'tech' => [],
                    'status' => 'Queue'
                ]
            ];

            foreach ($projects as $project): ?>
                <div class="project-card bg-white rounded-lg shadow-lg overflow-hidden group <?php echo isset($project['highlight']) && $project['highlight'] ? 'ring-2 ring-primary-green' : ''; ?>">
                    <?php if (isset($project['highlight']) && $project['highlight']): ?>
                        <div class="bg-gradient-to-r from-primary-green to-primary-blue text-white text-center py-1 text-xs font-semibold">
                            FREE DOWNLOAD • The Code that Built this Site
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
                                <source srcset="<?php echo e($webp_path); ?>" type="image/webp">
                                <img src="<?php echo e($logo_path); ?>"
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
                                <h3 class="text-xl font-bold text-dark-green">
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

                        <!-- View Project Link -->
                        <a href="<?php echo e($project['link']); ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 text-primary-blue hover:text-primary-green transition-colors font-semibold">
                            View Project
                            <i data-lucide="external-link" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

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