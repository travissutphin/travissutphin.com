<!-- Hero Section -->
<section class="min-h-hero flex items-center gradient-green-blue px-4 py-16">
    <div class="max-w-7xl mx-auto">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                Spending More Time Fixing Tech Than Running Your Business?
            </h1>
            <p class="text-xl md:text-2xl mb-6 max-w-3xl mx-auto">
                You started a business to do what you love—not troubleshoot servers, wrangle developers, or debug code. Get a senior-level CTO without the six-figure salary.
            </p>
            <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto opacity-90">
                20+ years helping solopreneurs and small agencies get their time back.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo BASE_PATH; ?>/contact" class="reddit-cta bg-white text-dark-green hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg transition-colors">
                    Get My Time Back — Free Assessment
                </a>
            </div>
            <p class="text-sm mt-4 opacity-80">
                Join 50+ solopreneurs and small agencies who got their time back. Average response: 4 hours.
            </p>
        </div>
    </div>
</section>

<!-- Trust Badges Section -->
<section class="py-12 px-4 bg-white">
    <div class="max-w-4xl mx-auto">
        <div class="grid md:grid-cols-3 gap-8 text-center">
            <div class="p-4">
                <div class="w-16 h-16 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="zap" class="w-8 h-8 text-white"></i>
                </div>
                <p class="font-semibold text-dark-green mb-1">4-Hour</p>
                <p class="text-sm text-gray-dark">Average Response Time</p>
            </div>
            <div class="p-4">
                <div class="w-16 h-16 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="x-circle" class="w-8 h-8 text-white"></i>
                </div>
                <p class="font-semibold text-dark-green mb-1">No Long-Term</p>
                <p class="text-sm text-gray-dark">Contracts Required</p>
            </div>
            <div class="p-4">
                <div class="w-16 h-16 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="clock" class="w-8 h-8 text-white"></i>
                </div>
                <p class="font-semibold text-dark-green mb-1">Get Your Time Back</p>
                <p class="text-sm text-gray-dark">Focus on Growth</p>
            </div>
        </div>
    </div>
</section>

<!-- What I Can Fix Section -->
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-theme-primary mb-4">
                What I Can Fix for You
            </h2>
            <p class="text-xl text-theme-secondary max-w-3xl mx-auto">
                Whether you need ongoing support or emergency help, I handle the tech problems that are costing you time and money.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php
            $includedServices = [
                [
                    'icon' => 'wrench',
                    'title' => 'Emergency Problem Solving',
                    'description' => 'Site down? Feature broken? Business blocked by tech issues? I jump in immediately and get you running again.'
                ],
                [
                    'icon' => 'alert-triangle',
                    'title' => 'Hack & Malware Cleanup',
                    'description' => 'Hacked sites cleaned, secured, and protected. I respond within 24 hours and prevent future attacks.'
                ],
                [
                    'icon' => 'shield-check',
                    'title' => 'Bad Developer Cleanup',
                    'description' => 'Fix messy code, complete abandoned projects, and clean up after developers who disappeared or failed to deliver.'
                ],
                [
                    'icon' => 'mail',
                    'title' => 'Email System Rescue',
                    'description' => 'Emails going to spam? Delivery failing? I fix SPF/DKIM/DMARC issues and set up reliable transactional email.'
                ],
                [
                    'icon' => 'lock',
                    'title' => 'Security Audit & Hardening',
                    'description' => 'Find vulnerabilities before hackers do. Get a comprehensive security review with actionable fixes you can actually implement.'
                ],
                [
                    'icon' => 'gauge',
                    'title' => 'Performance Optimization',
                    'description' => 'Slow site killing conversions? I make it lightning-fast with database optimization, caching, and infrastructure improvements.'
                ],
                [
                    'icon' => 'compass',
                    'title' => 'Strategic Technology Planning',
                    'description' => 'Stop wasting money on the wrong tech. Get clear direction on what to build, buy, or fix—without the CTO salary.'
                ],
                [
                    'icon' => 'users',
                    'title' => 'Developer Team Oversight',
                    'description' => 'Make sure your developers actually deliver quality work. I review code, manage vendors, and keep projects on track.'
                ],
                [
                    'icon' => 'target',
                    'title' => 'Tech Stack Decisions',
                    'description' => 'Confused about which platform, framework, or tool to use? I cut through the hype and recommend what actually works for your business.'
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

<!-- Specialized Solutions Section -->
<section class="py-16 px-4 bg-theme-surface">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-theme-primary mb-4">
                Specialized Solutions
            </h2>
            <p class="text-xl text-theme-secondary max-w-3xl mx-auto">
                Need something specific built, fixed, or optimized? I handle complex projects others struggle with.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php
            $projectServices = [
                [
                    'icon' => 'code',
                    'title' => 'Rescue Stalled Projects',
                    'description' => 'Your app stuck at 80% complete? Developer disappeared? I take abandoned projects from dead-end to production-ready.',
                    'highlight' => true
                ],
                [
                    'icon' => 'sparkles',
                    'title' => 'AI Integration & Automation',
                    'description' => 'Add ChatGPT, Claude, or custom AI to your app. Automate workflows that are eating up your team\'s time.',
                    'highlight' => true
                ],
                [
                    'icon' => 'search',
                    'title' => 'SEO That Actually Works',
                    'description' => 'Improve rankings with technical SEO, Answer Engine Optimization (AEO), analytics setup, and performance tracking.',
                    'highlight' => false
                ],
                [
                    'icon' => 'database',
                    'title' => 'Data Migration & Integration',
                    'description' => 'Move data between systems without losing anything. Integrate APIs and third-party services safely.',
                    'highlight' => false
                ],
                [
                    'icon' => 'cloud',
                    'title' => 'Infrastructure & DevOps',
                    'description' => 'Server setup, deployment pipelines, monitoring, and cloud infrastructure that actually scales.',
                    'highlight' => false
                ],
                [
                    'icon' => 'zap',
                    'title' => 'Workflow Automation',
                    'description' => 'Stop doing repetitive tasks manually. Custom automation workflows that save hours every week.',
                    'highlight' => false
                ],
                [
                    'icon' => 'map-pinned',
                    'title' => 'Google Business Profile',
                    'description' => 'Get found in local search. Claim, optimize, and manage your Google Business Profile properly.',
                    'highlight' => false
                ],
                [
                    'icon' => 'rss',
                    'title' => 'Technical Content Creation',
                    'description' => 'SEO-optimized blog posts, case studies, and technical content that positions you as an expert and attracts qualified leads.',
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
                            Get Custom Quote →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-16 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-theme-primary mb-4">
                How It Works
            </h2>
            <p class="text-xl text-theme-secondary max-w-3xl mx-auto">
                Simple, transparent process. No surprises, no long-term commitments.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="relative">
                <div class="bg-white rounded-lg shadow-lg p-8 h-full">
                    <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-xl">1</span>
                    </div>
                    <div class="pt-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-primary-green to-primary-blue rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="phone" class="w-8 h-8 text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-dark-green mb-3">Free Strategy Call</h3>
                        <p class="text-gray-dark mb-4">
                            30-minute call where I diagnose your exact problem. No sales pitch—just honest technical assessment.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-dark">
                            <li class="flex items-start">
                                <i data-lucide="check" class="w-4 h-4 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Identify root causes</span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check" class="w-4 h-4 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Discuss potential solutions</span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check" class="w-4 h-4 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Get immediate recommendations</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative">
                <div class="bg-white rounded-lg shadow-lg p-8 h-full">
                    <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-xl">2</span>
                    </div>
                    <div class="pt-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-primary-green to-primary-blue rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="file-text" class="w-8 h-8 text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-dark-green mb-3">Custom Proposal</h3>
                        <p class="text-gray-dark mb-4">
                            Transparent pricing tailored to YOUR specific situation. Choose ongoing support or per-project pricing.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-dark">
                            <li class="flex items-start">
                                <i data-lucide="check" class="w-4 h-4 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Clear scope and timeline</span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check" class="w-4 h-4 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Fixed-price or hourly options</span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check" class="w-4 h-4 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>No hidden fees or surprises</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative">
                <div class="bg-white rounded-lg shadow-lg p-8 h-full">
                    <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-xl">3</span>
                    </div>
                    <div class="pt-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-primary-green to-primary-blue rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="rocket" class="w-8 h-8 text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-dark-green mb-3">Fast Start</h3>
                        <p class="text-gray-dark mb-4">
                            Emergencies start within 24 hours. Most projects begin within 7 days. You stay in control the entire time.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-dark">
                            <li class="flex items-start">
                                <i data-lucide="check" class="w-4 h-4 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Regular progress updates</span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check" class="w-4 h-4 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Cancel anytime (ongoing plans)</span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check" class="w-4 h-4 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Direct access—no account managers</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="<?php echo BASE_PATH; ?>/contact"
               class="reddit-cta inline-block bg-gradient-to-r from-primary-green to-primary-blue text-white px-8 py-4 rounded-lg font-semibold text-lg hover:shadow-lg transition-shadow">
                Schedule Your Free Assessment Now
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 px-4 bg-theme-surface">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-theme-primary mb-12">Questions You're Probably Asking</h2>
        <div class="space-y-6">
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">I'm just a solopreneur—is this for me?</h3>
                <p class="text-theme-secondary">Absolutely. Most of my clients are solopreneurs or teams of 2-5 people who wear too many hats. You don't need a big budget or complex tech stack. If you're spending more than 5 hours a week on tech issues instead of growing your business, we should talk. You get senior-level expertise at a fraction of hiring a full-time person.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">How much time will this actually save me?</h3>
                <p class="text-theme-secondary">Most clients get back 10-20 hours per month—time they were spending troubleshooting tech instead of talking to customers, creating content, or closing deals. One client said: "I went from spending evenings debugging to spending evenings with my family." You focus on what makes you money; I handle everything else tech-related.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">What if my project is a complete mess?</h3>
                <p class="text-theme-secondary">I specialize in messes. Bad code, technical debt, abandoned projects, half-finished features—I've cleaned up disasters that would make other developers run away. The worse the situation, the more value I bring. During our free assessment, I'll tell you honestly if it's salvageable or if you need to start over.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">I already have developers—why do I need you?</h3>
                <p class="text-theme-secondary">I don't replace your team—I make them better and save you from being the middleman. With 20+ years of experience, I review their work objectively, catch problems early, ensure they're building what you actually need, and translate between "tech speak" and business goals. You stop being the project manager and get back to being the CEO.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">How do I know you won't disappear mid-project?</h3>
                <p class="text-theme-secondary">Fair question—I've cleaned up after developers who did exactly that. Here's my guarantee: you work directly with me (not a team of juniors), I provide regular updates, and you can cancel anytime on ongoing plans. For project work, payment milestones are tied to deliverables. If you're not satisfied at any point, 100% money-back guarantee applies.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">What technologies do you work with?</h3>
                <p class="text-theme-secondary">Most modern tech stacks: PHP, JavaScript/Node.js, Python, WordPress, custom web applications, cloud platforms (AWS, Google Cloud, Azure), and major AI APIs (OpenAI, Anthropic, Google AI). If you're using something unusual, we'll discuss it on the strategy call. I focus on solving your business problem, not being dogmatic about tools.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">How quickly can you start?</h3>
                <p class="text-theme-secondary">For critical emergencies (site hacked, major outage, business-blocking issues), I typically respond within 4 hours and start work within 24 hours. For non-emergency projects, most work begins within 7 days. The sooner we talk, the sooner you get your time back.</p>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="py-16 px-4 gradient-green-blue">
    <div class="max-w-4xl mx-auto text-center text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Ready to Focus on Growing Your Business Again?
        </h2>
        <p class="text-xl mb-6 opacity-95">
            Stop spending your valuable time on tech problems. Get back to what you do best—running your business.
        </p>
        <p class="text-lg mb-8 opacity-90">
            Free 30-minute call. No pressure, no commitment. Just honest advice about how to get your time back.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo BASE_PATH; ?>/contact"
               class="reddit-cta bg-white text-dark-green hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg transition-all transform hover:scale-105 shadow-lg">
                Get My Time Back — Free Assessment
            </a>
        </div>
        <p class="text-sm mt-6 opacity-90">
            Average response time: 4 hours • Only taking 3 new clients this month
        </p>
    </div>
</section>

<!-- Reddit Pixel -->
<script>
!function(w,d){if(!w.rdt){var p=w.rdt=function(){p.sendEvent?p.sendEvent.apply(p,arguments):p.callQueue.push(arguments)};p.callQueue=[];var t=d.createElement("script");t.src="https://www.redditstatic.com/ads/pixel.js",t.async=!0;var s=d.getElementsByTagName("script")[0];s.parentNode.insertBefore(t,s)}}(window,document);

// Initialize Reddit Pixel
rdt('init', 'a2_hz7dl91hbub1', {
    optOut: false,
    useDecimalCurrencyValues: true
});

// Track page visit
rdt('track', 'PageVisit');

// Track CTA button clicks as Lead events
document.addEventListener('DOMContentLoaded', function() {
    // Get all CTA buttons with class 'reddit-cta'
    var ctaButtons = document.querySelectorAll('.reddit-cta');

    ctaButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Track as Lead conversion
            rdt('track', 'Lead');

            // Optional: Track with custom data
            // rdt('track', 'Custom', {
            //     customEventName: 'CTA_Click',
            //     value: 1
            // });
        });
    });
});
</script>
