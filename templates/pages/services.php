<!-- Hero Section - Matching Homepage Style -->
<section class="min-h-hero flex items-center gradient-green-blue px-4 py-16">
    <div class="max-w-7xl mx-auto">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                Stop Losing $1000s Every Month Your App Isn't Live
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                I\'ll finish your app in 30 days, add AI capabilities, and help you launch—guaranteed.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo BASE_PATH; ?>/contact" class="bg-white text-dark-green hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg transition-colors">
                    Get My Free App Audit →
                </a>
            </div>
            <p class="text-sm mt-4 opacity-90">
                No commitment required • Results in 48 hours
            </p>
        </div>
    </div>
</section>

<!-- Problem Agitation (StoryBrand) -->
<section class="py-16 px-4 bg-white">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-dark-green mb-6">You're Stuck Because...</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="p-6">
                <i data-lucide="clock" class="w-12 h-12 text-red-500 mx-auto mb-4"></i>
                <h3 class="font-semibold text-lg mb-2">Time Is Running Out</h3>
                <p class="text-gray-dark">Your competitors launch while your app collects dust</p>
            </div>
            <div class="p-6">
                <i data-lucide="users-x" class="w-12 h-12 text-red-500 mx-auto mb-4"></i>
                <h3 class="font-semibold text-lg mb-2">Your Developer Quit</h3>
                <p class="text-gray-dark">Left with messy code and no documentation</p>
            </div>
            <div class="p-6">
                <i data-lucide="ban" class="w-12 h-12 text-red-500 mx-auto mb-4"></i>
                <h3 class="font-semibold text-lg mb-2">Perfectionism Paralysis</h3>
                <p class="text-gray-dark">Waiting for "perfect" while missing real opportunities</p>
            </div>
        </div>
    </div>
</section>

<!-- Solution - Services Grid with Better Visual Hierarchy -->
<section class="py-16 px-4 bg-gray-light">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-dark-green mb-4">
                Here's How I'll Get You Unstuck
            </h2>
            <p class="text-xl text-gray-dark max-w-3xl mx-auto">
                Choose the help you need. Most founders start with "Finish Your App" then add AI capabilities.
            </p>
        </div>

        <!-- Primary Services (Top 3 from Homepage) -->
        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <?php
            $primaryServices = [
                [
                    'icon' => 'rocket',
                    'title' => 'Finish Your App',
                    'subtitle' => 'Most Popular',
                    'description' => 'I\'ll complete your stalled project in 30 days or less.',
                    'features' => [
                        'Full code audit in 48 hours',
                        'Complete remaining features',
                        'Fix all critical bugs',
                        'Deploy to production'
                    ],
                    'cta' => 'Start Free Audit',
                    'highlight' => true
                ],
                [
                    'icon' => 'sparkles',
                    'title' => 'Add AI Powers',
                    'subtitle' => '3x Value',
                    'description' => 'Transform your app with intelligent features users love.',
                    'features' => [
                        'ChatGPT/Claude integration',
                        'Smart automation workflows',
                        'AI-powered search & insights',
                        'Content generation'
                    ],
                    'cta' => 'See AI Options',
                    'highlight' => false
                ],
                [
                    'icon' => 'shield',
                    'title' => 'Fractional CTO',
                    'subtitle' => 'Ongoing Support',
                    'description' => 'Get senior technical leadership at a fraction of the cost.',
                    'features' => [
                        'Weekly strategy calls',
                        'Architecture decisions',
                        'Team mentoring',
                        'Vendor management'
                    ],
                    'cta' => 'Learn More',
                    'highlight' => false
                ]
            ];

            foreach ($primaryServices as $service): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden <?php echo $service['highlight'] ? 'ring-2 ring-primary-green transform scale-105' : ''; ?> card-hover">
                    <?php if ($service['highlight']): ?>
                        <div class="bg-gradient-to-r from-primary-green to-primary-blue text-white text-center py-2 text-sm font-semibold">
                            MOST FOUNDERS START HERE
                        </div>
                    <?php endif; ?>
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-primary-green to-primary-blue rounded-lg flex items-center justify-center">
                                <i data-lucide="<?php echo e($service['icon']); ?>" class="w-8 h-8 text-white"></i>
                            </div>
                            <span class="text-sm text-primary-blue font-semibold"><?php echo e($service['subtitle']); ?></span>
                        </div>
                        <h3 class="text-xl font-bold text-dark-green mb-3"><?php echo e($service['title']); ?></h3>
                        <p class="text-gray-dark mb-6">
                            <?php echo e($service['description']); ?>
                        </p>
                        <ul class="space-y-3 mb-6">
                            <?php foreach ($service['features'] as $feature): ?>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="w-5 h-5 text-primary-green mr-2 mt-0.5 flex-shrink-0"></i>
                                    <span class="text-sm"><?php echo e($feature); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="<?php echo BASE_PATH; ?>/contact"
                           class="block text-center py-3 rounded-lg font-semibold transition-all
                                  <?php echo $service['highlight']
                                      ? 'bg-gradient-to-r from-primary-green to-primary-blue text-white hover:shadow-lg'
                                      : 'bg-gray-100 text-dark-green hover:bg-gray-200'; ?>">
                            <?php echo e($service['cta']); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Additional Services -->
        <div class="text-center mb-8">
            <h3 class="text-2xl font-bold text-dark-green mb-4">Also Available</h3>
        </div>
        <div class="grid md:grid-cols-2 gap-6">
            <?php
            $additionalServices = [
                [
                    'icon' => 'zap',
                    'title' => 'Workflow Automation',
                    'description' => 'Save 10+ hours/week with custom automation'
                ],
                [
                    'icon' => 'lock',
                    'title' => 'Security & Performance',
                    'description' => 'Make your app bulletproof and lightning fast'
                ]
            ];

            foreach ($additionalServices as $service): ?>
                <div class="bg-white rounded-lg p-6 flex items-center space-x-4 card-hover">
                    <div class="w-12 h-12 bg-light-blue rounded-lg flex items-center justify-center flex-shrink-0">
                        <i data-lucide="<?php echo e($service['icon']); ?>" class="w-6 h-6 text-primary-blue"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-dark-green"><?php echo e($service['title']); ?></h4>
                        <p class="text-sm text-gray-dark"><?php echo e($service['description']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Process Section (Guide's Plan) -->
<section class="py-16 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-dark-green mb-4">
            My Simple 3-Step Process
        </h2>
        <p class="text-xl text-center text-gray-dark mb-12 max-w-3xl mx-auto">
            No lengthy contracts. No surprise costs. Just results.
        </p>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-primary-green to-primary-blue text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                    1
                </div>
                <h3 class="text-xl font-semibold mb-3">Free Technical Audit</h3>
                <p class="text-gray-dark">I review your code and create a detailed roadmap in 48 hours</p>
                <p class="text-sm text-primary-blue mt-2 font-semibold">Day 0-2</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-primary-green to-primary-blue text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                    2
                </div>
                <h3 class="text-xl font-semibold mb-3">Rapid Development</h3>
                <p class="text-gray-dark">Using AI tools, I complete features 3x faster than traditional dev</p>
                <p class="text-sm text-primary-blue mt-2 font-semibold">Day 3-25</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-primary-green to-primary-blue text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                    3
                </div>
                <h3 class="text-xl font-semibold mb-3">Launch & Support</h3>
                <p class="text-gray-dark">Your app goes live with monitoring and 30-day support included</p>
                <p class="text-sm text-primary-blue mt-2 font-semibold">Day 26-30</p>
            </div>
        </div>
    </div>
</section>

<!-- Social Proof / Results -->
<section class="py-16 px-4 bg-gray-light">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-dark-green mb-12">Real Results for Real Founders</h2>
        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <div>
                <div class="text-4xl font-bold text-primary-green mb-2">50+</div>
                <p class="text-gray-dark">Apps Completed</p>
            </div>
            <div>
                <div class="text-4xl font-bold text-primary-green mb-2">30</div>
                <p class="text-gray-dark">Average Days to Launch</p>
            </div>
            <div>
                <div class="text-4xl font-bold text-primary-green mb-2">3x</div>
                <p class="text-gray-dark">Faster with AI Tools</p>
            </div>
        </div>
        <blockquote class="bg-white rounded-lg p-8 shadow-md max-w-2xl mx-auto">
            <p class="text-lg italic text-gray-dark mb-4">
                "Travis took our stalled MVP and had it live in 3 weeks. The AI features he added doubled our user engagement."
            </p>
            <cite class="text-sm text-primary-blue font-semibold">- Founder, SaaS Startup</cite>
        </blockquote>
    </div>
</section>

<!-- Final CTA (Clear Call to Action) -->
<section class="py-16 px-4 gradient-green-blue">
    <div class="max-w-4xl mx-auto text-center text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Your App Has Waited Long Enough
        </h2>
        <p class="text-xl mb-8 opacity-95">
            Every day you delay costs you customers, revenue, and market position.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo BASE_PATH; ?>/contact"
               class="bg-white text-dark-green hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg transition-all transform hover:scale-105 shadow-lg">
                Get Your Free Audit Now →
            </a>
        </div>
        <p class="text-sm mt-6 opacity-90">
            🔥 Limited spots available • Most projects start within 7 days
        </p>
    </div>
</section>