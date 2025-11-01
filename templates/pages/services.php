<!-- Hero Section -->
<section class="min-h-hero flex items-center gradient-green-blue px-4 py-16">
    <div class="max-w-7xl mx-auto">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                Fractional CTO Services
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                Get senior-level tech leadership without the full-time cost. Choose ongoing support or per-project solutions.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo BASE_PATH; ?>/contact" class="bg-white text-dark-green hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg transition-colors">
                    Schedule Free Strategy Call
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Included Services Section -->
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-theme-primary mb-4">
                Included in Fractional CTO Services
            </h2>
            <p class="text-xl text-theme-secondary max-w-3xl mx-auto">
                All of these services are included in your monthly fractional CTO engagement.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php
            $includedServices = [
                [
                    'icon' => 'wrench',
                    'title' => 'Hands-On Problem Solving',
                    'description' => 'When tech issues block your business, I jump in and fix them. Emergency support included.'
                ],
                [
                    'icon' => 'alert-triangle',
                    'title' => 'Hack/Malware Remediation',
                    'description' => 'Site hacked? I clean it up, secure it, and prevent future attacks. Emergency response available.'
                ],
                [
                    'icon' => 'compass',
                    'title' => 'Strategic Technology Planning',
                    'description' => 'Get clarity on tech decisions without the full-time CTO salary. I create technology roadmaps aligned with your business goals.'
                ],
                [
                    'icon' => 'phone',
                    'title' => 'Monthly Strategy Sessions',
                    'description' => 'Regular calls to discuss challenges, review progress, and plan next steps for your technology.'
                ],
                [
                    'icon' => 'mail',
                    'title' => 'Email System Setup & Fixes',
                    'description' => 'Fix delivery issues, configure SPF/DKIM/DMARC, or set up transactional email systems.'
                ],
                [
                    'icon' => 'target',
                    'title' => 'Architecture & Platform Decisions',
                    'description' => 'Expert guidance on choosing the right technologies, platforms, and tools for your business needs.'
                ],
                [
                    'icon' => 'lock',
                    'title' => 'Security Audit & Hardening',
                    'description' => 'Comprehensive security review with actionable fixes. Protect your business from vulnerabilities.'
                ],
                [
                    'icon' => 'gauge',
                    'title' => 'Performance Optimization',
                    'description' => 'Make your website lightning-fast. Database optimization, caching, and infrastructure improvements.'
                ],
                [
                    'icon' => 'shield-check',
                    'title' => 'Developer Team Oversight',
                    'description' => 'Ensure your developers deliver quality work. I review code, manage vendors, and keep your technical projects on track.'
                ],
                [
                    'icon' => 'users',
                    'title' => 'Team Guidance & Mentoring',
                    'description' => 'I mentor your technical team, help with hiring decisions, and ensure they have clear direction.'
                ],
            ];

            foreach ($includedServices as $service): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="p-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-primary-green to-primary-blue rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="<?php echo e($service['icon']); ?>" class="w-8 h-8 text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark-green mb-3"><?php echo e($service['title']); ?></h3>
                        <p class="text-gray-dark text-sm">
                            <?php echo e($service['description']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Per-Project Solutions Section -->
<section class="py-16 px-4 bg-theme-surface">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-theme-primary mb-4">
                Per-Project Solutions
            </h2>
            <p class="text-xl text-theme-secondary max-w-3xl mx-auto">
                Need help with a specific project? These solutions are billed separately based on scope.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php
            $projectServices = [
                [
                    'icon' => 'map-pinned',
                    'title' => 'Google Business Profile',
                    'description' => 'Claim, optimize, and manage your Google Business Profile to boost local search visibility. Get found by customers searching for your services in your area.'
                ],
                [
                    'icon' => 'rss',
                    'title' => 'Content Creation',
                    'description' => 'Strategic blog posts, case studies, and technical content that position you as an industry expert. SEO-optimized writing that attracts qualified leads.'
                ],
                [
                    'icon' => 'code',
                    'title' => 'App Development & Completion',
                    'description' => 'Build new features or complete your unfinished project. I take it from stuck to production-ready.',
                    'highlight' => false
                ],
                [
                    'icon' => 'search',
                    'title' => 'SEO Optimization',
                    'description' => 'Improve your search rankings and online visibility. Aanalytics setup, technical SEO, AEO (Answer Engine Optimization) and performance tracking.',
					'highlight' => true
                ],
                [
                    'icon' => 'sparkles',
                    'title' => 'AI Integration & Automation',
                    'description' => 'Add ChatGPT, Claude, or other AI capabilities to your WebApp.',
                    'highlight' => true
                ],
                [
                    'icon' => 'zap',
                    'title' => 'Workflow Automation',
                    'description' => 'Automate repetitive tasks with custom workflows. Save hours per week on manual processes.',
                    'highlight' => false
                ],
                [
                    'icon' => 'database',
                    'title' => 'Data Migration & Integration',
                    'description' => 'Migrate data between systems or integrate third-party APIs and services safely.',
                    'highlight' => false
                ],
                [
                    'icon' => 'cloud',
                    'title' => 'Infrastructure & DevOps',
                    'description' => 'Server setup, deployment pipelines, monitoring, and cloud infrastructure management.',
                    'highlight' => false
                ]
            ];

            foreach ($projectServices as $service): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all <?php echo $service['highlight'] ? 'ring-2 ring-primary-green' : ''; ?>">
                    <?php if ($service['highlight']): ?>
                        <div class="bg-gradient-to-r from-primary-green to-primary-blue text-white text-center py-2 text-xs font-semibold uppercase">
                            Popular Choice
                        </div>
                    <?php endif; ?>
                    <div class="p-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-primary-green to-primary-blue rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="<?php echo e($service['icon']); ?>" class="w-8 h-8 text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark-green mb-3"><?php echo e($service['title']); ?></h3>
                        <p class="text-gray-dark text-sm mb-4">
                            <?php echo e($service['description']); ?>
                        </p>
                        <a href="<?php echo BASE_PATH; ?>/contact"
                           class="inline-block text-primary-blue hover:text-dark-green font-semibold text-sm transition-colors">
                            Get a Quote →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Pricing Overview Section -->
<section class="py-16 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-theme-primary mb-4">
                How Pricing Works
            </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Retainer Pricing -->
            <div class="bg-theme-card rounded-lg shadow-lg p-8">
                <div class="text-center mb-6">
                    <div class="inline-block bg-theme-surface text-theme-primary px-4 py-1 rounded-full text-sm font-semibold mb-4">
                        PAY AS YOU GO
                    </div>
                    <h3 class="text-2xl font-bold text-theme-primary mb-2">Retainer</h3>
                    <p class="text-theme-secondary text-sm">Access when you need help</p>
                </div>
                <div class="text-center mb-6">
                    <div class="text-4xl font-bold text-theme-primary mb-2">
                        $500<span class="text-lg text-theme-secondary"> /month</span>
                    </div>
                    <p class="text-sm text-theme-secondary">then pay per occurrence</p>
                </div>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-blue mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">5 Business Day Initial Audit Required</span>
                    </li>
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-blue mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">$250 per hour</span>
                    </li>
					<li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-blue mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">Access to support</span>
                    </li>
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-blue mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">Pay only when you need help</span>
                    </li>
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-blue mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">No long term commitment</span>
                    </li>
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-blue mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">Upgrade to fractional CTO anytime</span>
                    </li>
                </ul>
                <a href="<?php echo BASE_PATH; ?>/contact"
                   class="block text-center bg-theme-surface text-theme-primary py-3 rounded-lg font-semibold hover:opacity-80 transition-opacity">
                    Get Started
                </a>
            </div>

            <!-- Fractional CTO Pricing -->
            <div class="bg-theme-card rounded-lg shadow-lg p-8 border-2 border-primary-green">
                <div class="text-center mb-6">
                    <div class="inline-block bg-gradient-to-r from-primary-green to-primary-blue text-white px-4 py-1 rounded-full text-sm font-semibold mb-4">
                        ONGOING SUPPORT
                    </div>
                    <h3 class="text-2xl font-bold text-theme-primary mb-2">Fractional CTO</h3>
                    <p class="text-theme-secondary text-sm">All included services</p>
                </div>
                <div class="text-center mb-6">
                    <div class="text-4xl font-bold text-theme-primary mb-2">
                        Starting at $2,000<span class="text-lg text-theme-secondary">/month</span>
                    </div>
                    <p class="text-sm text-theme-secondary">10 hours monthly • Cancel anytime</p>
                </div>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">All included services above</span>
                    </li>
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">Monthly strategy calls</span>
                    </li>
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">Emergency support included</span>
                    </li>
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">Scale hours up or down as needed</span>
                    </li>
                </ul>
                <a href="<?php echo BASE_PATH; ?>/contact"
                   class="block text-center bg-gradient-to-r from-primary-green to-primary-blue text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-shadow">
                    Schedule Strategy Call
                </a>
            </div>

            <!-- Per-Project Pricing -->
            <div class="bg-theme-card rounded-lg shadow-lg p-8">
                <div class="text-center mb-6">
                    <div class="inline-block bg-theme-surface text-theme-primary px-4 py-1 rounded-full text-sm font-semibold mb-4">
                        ONE-TIME PROJECTS
                    </div>
                    <h3 class="text-2xl font-bold text-theme-primary mb-2">Per-Project Solutions</h3>
                    <p class="text-theme-secondary text-sm">Billed based on scope</p>
                </div>
                <div class="text-center mb-6">
                    <div class="text-4xl font-bold text-theme-primary mb-2">
                        Custom Quote
                    </div>
                    <p class="text-sm text-theme-secondary">Fixed price or hourly available</p>
                </div>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-blue mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">Clear scope and timeline</span>
                    </li>
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-blue mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">Fixed-price or hourly options</span>
                    </li>
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-blue mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">No long-term commitment</span>
                    </li>
                    <li class="flex items-start">
                        <i data-lucide="check" class="w-5 h-5 text-primary-blue mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-theme-secondary">Combine multiple projects for discount</span>
                    </li>
                </ul>
                <a href="<?php echo BASE_PATH; ?>/contact"
                   class="block text-center bg-theme-surface text-theme-primary py-3 rounded-lg font-semibold hover:opacity-80 transition-opacity">
                    Request a Quote
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 px-4 bg-theme-surface">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-theme-primary mb-12">Common Questions</h2>
        <div class="space-y-6">
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">What's the difference between Fractional CTO and per-project work?</h3>
                <p class="text-theme-secondary">Fractional CTO is ongoing monthly support focused on strategic guidance, team oversight, and technical leadership. Per-project work is for specific deliverables like building a feature, fixing a hack, or setting up email systems. Many clients start with per-project work and transition to fractional CTO as their business grows.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">Can I combine fractional CTO services with per-project work?</h3>
                <p class="text-theme-secondary">Absolutely! Many fractional CTO clients also need specific projects completed. We can bundle services together, and fractional CTO clients receive priority scheduling and discounted rates on per-project work.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">How quickly can you start on an emergency project?</h3>
                <p class="text-theme-secondary">For emergencies like site hacks or critical email issues, I typically start within 24 hours. Fractional CTO clients get priority emergency support. For non-emergency projects, most work begins within 7 days.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">Do you work with specific technologies or platforms?</h3>
                <p class="text-theme-secondary">I work with most modern tech stacks including PHP, JavaScript/Node.js, Python, WordPress, custom web applications, cloud platforms (AWS, Google Cloud, Azure), and major AI APIs (OpenAI, Anthropic, Google AI). If you're using something uncommon, we'll discuss compatibility during our strategy call.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQPage Schema for AEO -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "What's the difference between Fractional CTO and per-project work?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Fractional CTO is ongoing monthly support focused on strategic guidance, team oversight, and technical leadership. Per-project work is for specific deliverables like building a feature, fixing a hack, or setting up email systems. Many clients start with per-project work and transition to fractional CTO as their business grows."
            }
        },
        {
            "@type": "Question",
            "name": "Can I combine fractional CTO services with per-project work?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Absolutely! Many fractional CTO clients also need specific projects completed. We can bundle services together, and fractional CTO clients receive priority scheduling and discounted rates on per-project work."
            }
        },
        {
            "@type": "Question",
            "name": "How quickly can you start on an emergency project?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "For emergencies like site hacks or critical email issues, I typically start within 24 hours. Fractional CTO clients get priority emergency support. For non-emergency projects, most work begins within 7 days."
            }
        },
        {
            "@type": "Question",
            "name": "Do you work with specific technologies or platforms?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "I work with most modern tech stacks including PHP, JavaScript/Node.js, Python, WordPress, custom web applications, cloud platforms (AWS, Google Cloud, Azure), and major AI APIs (OpenAI, Anthropic, Google AI). If you're using something uncommon, we'll discuss compatibility during our strategy call."
            }
        }
    ]
}
</script>

<!-- Final CTA -->
<section class="py-16 px-4 gradient-green-blue">
    <div class="max-w-4xl mx-auto text-center text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Ready to Stop Wrestling with Technology?
        </h2>
        <p class="text-xl mb-8 opacity-95">
            Whether you need ongoing support or help with a specific project, let's talk about how I can help your business.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo BASE_PATH; ?>/contact"
               class="bg-white text-dark-green hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg transition-all transform hover:scale-105 shadow-lg">
                Schedule Free Strategy Call
            </a>
        </div>
        <p class="text-sm mt-6 opacity-90">
            No commitment required • Get clarity on your tech challenges
        </p>
    </div>
</section>
