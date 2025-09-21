<!-- Hero Section -->
<section class="min-h-hero flex items-center gradient-green-blue px-4 py-16">
    <div class="max-w-7xl mx-auto">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                <?php echo e($headline ?? 'Your Half-Built App Deserves a Full Launch.'); ?>
            </h1>
            <p class="text-xl md:text-2xl mb-8">
                <?php echo e($subheadline ?? 'As your Fractional CTO, I\'ll finish what you started—fast—with AI and automation baked in.'); ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo BASE_PATH; ?>/contact" class="bg-white text-dark-green hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold transition-colors">
                    Finish My App
                </a>
                <a href="<?php echo BASE_PATH; ?>/services" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-dark-green px-6 py-3 rounded-lg font-semibold transition-colors">
                    Add AI Automation
                </a>
                <a href="<?php echo BASE_PATH; ?>/contact" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-dark-green px-6 py-3 rounded-lg font-semibold transition-colors">
                    Book Free Audit
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-theme-primary mb-12">
            How I Can Help
        </h2>
        <div class="grid md:grid-cols-3 gap-8">
            <?php
            $services = [
                [
                    'icon' => 'wrench',
                    'title' => 'Finish Your App',
                    'description' => 'Turn your unfinished project into a production-ready application.',
                    'features' => ['Complete development', 'Bug fixes', 'Launch support']
                ],
                [
                    'icon' => 'bot',
                    'title' => 'AI Integration',
                    'description' => 'Add intelligent automation to supercharge your workflows.',
                    'features' => ['Custom AI solutions', 'Workflow automation', 'Smart features']
                ],
                [
                    'icon' => 'brain',
                    'title' => 'Fractional CTO',
                    'description' => 'Strategic technical leadership without the full-time cost.',
                    'features' => ['Technical strategy', 'Team guidance', 'Architecture decisions']
                ]
            ];

            foreach ($services as $service) {
                render_partial('service-card', $service);
            }
            ?>
        </div>
    </div>
</section>

<!-- Problem Section (StoryBrand) -->
<section class="problem-section py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-theme-primary mb-6">The Problem You're Facing</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="problem-card p-6">
                <i data-lucide="x-circle" class="problem-icon w-12 h-12 text-red-500 mx-auto mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-theme-primary">Incomplete Project</h3>
                <p class="text-theme-secondary">Your app is 80% done but that last 20% feels impossible</p>
            </div>
            <div class="problem-card p-6">
                <i data-lucide="trending-down" class="problem-icon w-12 h-12 text-red-500 mx-auto mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-theme-primary">Lost Revenue</h3>
                <p class="text-theme-secondary">Every day without launch is money left on the table</p>
            </div>
            <div class="problem-card p-6">
                <i data-lucide="alert-triangle" class="problem-icon w-12 h-12 text-red-500 mx-auto mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-theme-primary">Technical Debt</h3>
                <p class="text-theme-secondary">The longer you wait, the harder it becomes to finish</p>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="path-section py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-theme-primary mb-4">
            Your Path to Launch
        </h2>
        <p class="text-xl text-center text-theme-secondary mb-12 max-w-3xl mx-auto">
            I've helped dozens of founders finish their apps and launch successfully. Here's how we'll get yours across the finish line:
        </p>
        <div class="path-container grid md:grid-cols-3 gap-8">
            <div class="path-card rounded-lg p-8 text-center">
                <div class="path-number w-16 h-16 bg-gradient-to-br from-primary-green to-primary-blue text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    1
                </div>
                <h3 class="text-xl font-semibold mb-3 text-theme-primary">Free Technical Audit</h3>
                <p class="text-theme-secondary">I'll review your codebase and create a clear roadmap to completion in 48 hours.</p>
            </div>
            <div class="path-card rounded-lg p-8 text-center">
                <div class="path-number w-16 h-16 bg-gradient-to-br from-primary-green to-primary-blue text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    2
                </div>
                <h3 class="text-xl font-semibold mb-3 text-theme-primary">Rapid Development</h3>
                <p class="text-theme-secondary">Using AI tools and automation, I'll complete features 3x faster than traditional development.</p>
            </div>
            <div class="path-card rounded-lg p-8 text-center">
                <div class="path-number w-16 h-16 bg-gradient-to-br from-primary-green to-primary-blue text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    3
                </div>
                <h3 class="text-xl font-semibold mb-3 text-theme-primary">Launch & Scale</h3>
                <p class="text-theme-secondary">Your app goes live with monitoring, support, and a plan for growth.</p>
            </div>
        </div>
    </div>
</section>

<!-- Success Stories Section -->
<section class="success-section py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-theme-primary mb-12">What Success Looks Like</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="success-card rounded-lg p-6">
                <i data-lucide="check-circle" class="success-icon w-10 h-10 text-primary-green mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-theme-primary">Finally Launched</h3>
                <p class="text-theme-secondary">Your app is live, generating revenue, and serving customers</p>
            </div>
            <div class="success-card rounded-lg p-6">
                <i data-lucide="trending-up" class="success-icon w-10 h-10 text-primary-green mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-theme-primary">Growing Fast</h3>
                <p class="text-theme-secondary">With AI automation built-in, you can scale without adding complexity</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <?php render_partial('cta-section', [
            'headline' => 'Ready to Finally Launch Your App?',
            'subheadline' => 'Let\'s turn your vision into a working product.',
            'buttons' => [
                ['text' => 'Get Started', 'url' => BASE_PATH . '/contact', 'primary' => true],
                ['text' => 'Learn More', 'url' => BASE_PATH . '/services', 'primary' => false]
            ]
        ]); ?>
    </div>
</section>