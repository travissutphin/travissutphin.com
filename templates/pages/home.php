<!-- Hero Section -->
<section class="min-h-hero flex items-center gradient-green-blue px-4 py-16">
    <div class="max-w-7xl mx-auto">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                <?php echo e($headline ?? 'Stop Wrestling with Tech. Start Growing Your Business.'); ?>
            </h1>
            <p class="text-xl md:text-2xl mb-8">
                <?php echo e($subheadline ?? 'Get senior-level tech guidance for your small business—without hiring full-time. Focus on what you do best while I handle the technology.'); ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo BASE_PATH; ?>/contact" class="bg-white text-dark-green hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold transition-colors">
                    Schedule Free Strategy Call
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
                    'title' => 'Hands-On Problem Solving',
                    'description' => 'When tech issues block your business, I jump in and fix them.',
                    'features' => ['Emergency technical support', 'Hack/malware remediation', 'Email delivery issues', 'Architecture troubleshooting', 'Performance optimization']
                ],
				[
                    'icon' => 'compass',
                    'title' => 'Strategic Technology Planning',
                    'description' => 'Get clarity on tech decisions without the full-time CTO salary.',
                    'features' => ['AI Automation', 'Technology roadmap aligned with business goals', 'Platform and tool selection guidance', 'Scalability and growth planning']
                ],
                [
                    'icon' => 'shield-check',
                    'title' => 'Developer Team Oversight',
                    'description' => 'Ensure your developers deliver quality work that actually moves your business forward.',
                    'features' => ['I can complete if needed', 'Code review and quality assurance', 'Vendor/freelancer management', 'Technical project management']
                ]
            ];

            foreach ($services as $service) {
                render_partial('service-card', $service);
            }
            ?>
        </div>

		<div class="text-center mt-8">
			<a href="<?php echo BASE_PATH; ?>/services" class="inline-block bg-theme-card border-2 border-primary-green text-theme-primary hover:bg-primary-green hover:text-white px-8 py-3 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg">
				View All Available Services
			</a>
		</div>
    </div>
</section>

<!-- Problem Section (StoryBrand) -->
<section class="problem-section py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-theme-primary mb-6">The Technical Challenges Holding You Back</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="problem-card p-6">
                <i data-lucide="brain" class="problem-icon w-12 h-12 text-red-500 mx-auto mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-theme-primary">Drowning in Technical Decisions</h3>
                <p class="text-theme-secondary">You're spending to many hours/week researching tech instead of growing your business</p>
            </div>
            <div class="problem-card p-6">
                <i data-lucide="dollar-sign" class="problem-icon w-12 h-12 text-red-500 mx-auto mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-theme-primary">Can't Justify full time CTO Salary</h3>
                <p class="text-theme-secondary">You need expert guidance but not a full time cost</p>
            </div>
            <div class="problem-card p-6">
                <i data-lucide="timer" class="problem-icon w-12 h-12 text-red-500 mx-auto mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-theme-primary">Stuck IN the Business, Not ON It</h3>
                <p class="text-theme-secondary">You're troubleshooting issues at midnight instead of closing deals and building strategy</p>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="path-section py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-theme-primary mb-4">
            Your Path to Technical Confidence
        </h2>
        <p class="text-xl text-center text-theme-secondary mb-12 max-w-3xl mx-auto">
            Get the technical leadership your business needs—without the full-time commitment or cost.
        </p>
        <div class="path-container grid md:grid-cols-3 gap-8">
            <div class="path-card rounded-lg p-8 text-center">
                <div class="path-number w-16 h-16 bg-gradient-to-br from-primary-green to-primary-blue text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    1
                </div>
                <h3 class="text-xl font-semibold mb-3 text-theme-primary">Free Strategy Session</h3>
                <p class="text-theme-secondary">We'll discuss your biggest tech challenges and create a clear action plan, no obligation.</p>
            </div>
            <div class="path-card rounded-lg p-8 text-center">
                <div class="path-number w-16 h-16 bg-gradient-to-br from-primary-green to-primary-blue text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    2
                </div>
                <h3 class="text-xl font-semibold mb-3 text-theme-primary">Flexible Engagement</h3>
                <p class="text-theme-secondary">Start with 10-20 hours/month of fractional CTO support. Scale up or down as your business needs change.</p>
            </div>
            <div class="path-card rounded-lg p-8 text-center">
                <div class="path-number w-16 h-16 bg-gradient-to-br from-primary-green to-primary-blue text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    3
                </div>
                <h3 class="text-xl font-semibold mb-3 text-theme-primary">Focus on Growth</h3>
                <p class="text-theme-secondary">With tech handled by an expert, you're free to focus on growing your business.</p>
            </div>
        </div>
    </div>
</section>

<!-- Success Stories Section -->
<section class="success-section py-16 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-theme-primary mb-12">What Working Together Looks Like</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="success-card rounded-lg p-6">
                <i data-lucide="compass" class="success-icon w-10 h-10 text-primary-green mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-theme-primary">Clear Technical Direction</h3>
                <p class="text-theme-secondary">No more second-guessing tech decisions. You'll have a strategic roadmap and expert guidance</p>
            </div>
            <div class="success-card rounded-lg p-6">
                <i data-lucide="clock" class="success-icon w-10 h-10 text-primary-green mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-theme-primary">Hours Back Every Week</h3>
                <p class="text-theme-secondary">Stop troubleshooting tech issues and get back to leading your business</p>
            </div>
            <div class="success-card rounded-lg p-6">
                <i data-lucide="trending-up" class="success-icon w-10 h-10 text-primary-green mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-theme-primary">Scale Without Technical Fear</h3>
                <p class="text-theme-secondary">Your technology grows with your business, no surprises, no emergencies</p>
            </div>
            <div class="success-card rounded-lg p-6">
                <i data-lucide="check-circle" class="success-icon w-10 h-10 text-primary-green mb-4"></i>
                <h3 class="font-semibold text-lg mb-2 text-theme-primary">Better Developer ROI</h3>
                <p class="text-theme-secondary">When you have developers, they deliver quality work that actually moves your business forward</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section for AEO -->
<section class="py-16 px-4 bg-theme-surface">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-theme-primary mb-12">Frequently Asked Questions</h2>
        <div class="space-y-6">
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">What exactly is a Fractional CTO?</h3>
                <p class="text-theme-secondary">A Fractional CTO is a part-time Chief Technology Officer who provides senior-level technical leadership to your business without the full-time salary and commitment. You get access to 20+ years of tech expertise for 10-20 hours per month, perfect for small companies and solopreneurs who need strategic tech guidance but can't afford (or don't need) a full-time CTO.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">How is this different from hiring a developer or consultant?</h3>
                <p class="text-theme-secondary">Developers execute tasks; consultants give advice and leave. A Fractional CTO is your ongoing strategic technology partner. I don't just write code or create reports—I own your technical strategy, make decisions with you, guide your team, and ensure technology serves your business goals. I'm accountable for your technical success long-term.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">How much does Fractional CTO service cost compared to hiring full-time?</h3>
                <p class="text-theme-secondary">A full-time CTO costs $100,000+ annually plus benefits and equity. Fractional CTO services start at $2,000/month for 20 hours of strategic guidance. A fraction of the cost with immediate access to senior expertise and no long-term commitment.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">I'm not technical at all. Can you still help me?</h3>
                <p class="text-theme-secondary">Non-technical founders need guidance the most. I translate technical concepts into plain business language, help you make confident tech decisions, and protect you from costly mistakes. You don't need to become technical—you just need someone technical on your side.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">What's included in Fractional CTO services?</h3>
                <p class="text-theme-secondary">Fractional CTO services included are outlined here: <u><a href="/services">https://travissutphin.com/services</a></u>. Think of me as your part-time CTO who's always available when you need guidance.</p>
            </div>
            <div class="faq-item p-6 bg-theme-card rounded-lg">
                <h3 class="text-xl font-semibold text-theme-primary mb-3">What if I already have developers or a technical team?</h3>
                <p class="text-theme-secondary">Perfect! Many of my clients have developers but lack technical leadership. I'll oversee your team, review their work, ensure quality standards, and translate between technical execution and business objectives. Your developers will be more effective with clear direction and oversight.</p>
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
            "name": "What exactly is a Fractional CTO?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "A Fractional CTO is a part-time Chief Technology Officer who provides senior-level technical leadership to your business without the full-time salary and commitment. You get access to 20+ years of tech expertise for 10-20 hours per month, perfect for small companies and solopreneurs who need strategic tech guidance but can't afford (or don't need) a full-time CTO."
            }
        },
        {
            "@type": "Question",
            "name": "How much does Fractional CTO service cost compared to hiring full-time?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "A full-time CTO costs $150,000-$300,000+ annually plus benefits and equity. Fractional CTO services start at $3,000-$6,000/month for 10-20 hours of strategic guidance—roughly 10-20% of the cost with immediate access to senior expertise and no long-term commitment."
            }
        },
        {
            "@type": "Question",
            "name": "I'm not technical at all. Can you still help me?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "That's exactly who I help! Non-technical founders need guidance the most. I translate technical concepts into plain business language, help you make confident tech decisions, and protect you from costly mistakes. You don't need to become technical—you just need someone technical on your side."
            }
        },
        {
            "@type": "Question",
            "name": "What's included in Fractional CTO services?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Fractional CTO services include strategic technology planning, architecture and platform decisions, developer team oversight and code reviews, vendor/freelancer management, emergency technical support, scalability planning, and serving as your technical advisor for business decisions. Think of me as your part-time CTO who's always available when you need guidance."
            }
        },
        {
            "@type": "Question",
            "name": "How is this different from hiring a developer or consultant?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Developers execute tasks; consultants give advice and leave. A Fractional CTO is your ongoing strategic technology partner. I don't just write code or create reports—I own your technical strategy, make decisions with you, guide your team, and ensure technology serves your business goals. I'm accountable for your technical success long-term."
            }
        },
        {
            "@type": "Question",
            "name": "What if I already have developers or a technical team?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Perfect! Many of my clients have developers but lack technical leadership. I'll oversee your team, review their work, ensure quality standards, and translate between technical execution and business objectives. Your developers will be more effective with clear direction and oversight."
            }
        }
    ]
}
</script>

<!-- CTA Section -->
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <?php render_partial('cta-section', [
            'headline' => 'Ready to Stop Wrestling with Technology?',
            'subheadline' => 'Let\'s talk about how fractional CTO services can free you up to focus on growing your business.',
            'buttons' => [
                ['text' => 'Schedule Free Strategy Session', 'url' => BASE_PATH . '/contact', 'primary' => true],
                ['text' => 'Learn About Fractional CTO Services', 'url' => BASE_PATH . '/services', 'primary' => false]
            ]
        ]); ?>
    </div>
</section>