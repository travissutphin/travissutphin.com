<!-- Hero Section - Matching Site Style -->
<section class="min-h-hero flex items-center gradient-green-blue px-4 py-16">
    <div class="max-w-7xl mx-auto">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                Meet the Team Behind Your Success
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                Experienced professionals dedicated to bringing your vision to life.
            </p>
        </div>
    </div>
</section>

<!-- Team Members Grid -->
<section class="team-grid-section py-16 px-4">
    <div class="floating-orb floating-orb-1"></div>
    <div class="floating-orb floating-orb-2"></div>
    <div class="floating-orb floating-orb-3"></div>
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            $team_members = [
                [
                    'name' => 'Travis Sutphin',
                    'role' => 'Technical Project Manager',
                    'photo' => BASE_PATH . '/travissutphincom-avatar-green.png',
                    'description' => 'The central intelligence of our human-AI team, a full-stack developer who translates client needs into executable code and actionable plans.'
                ],
                [
                    'name' => 'Syntax',
                    'role' => 'Lead Developer',
                    'photo' => BASE_PATH . '/assets/images/team/Syntax.png',
                    'description' => 'Our AI Lead Developer, a tireless architect of elegant code. Master "pair programmer" who spots logic errors and refactors with precision.'
                ],
                [
                    'name' => 'Codey',
                    'role' => 'Research & Development',
                    'photo' => BASE_PATH . '/assets/images/team/Codey.png',
                    'description' => 'Our AI R&D guru, a constant fountain of groundbreaking ideas. Dedicated to pushing boundaries and prototyping revolutionary features.'
                ],
                [
                    'name' => 'Aesthetica',
                    'role' => 'UI/UX Designer',
                    'photo' => BASE_PATH . '/assets/images/team/Aesthetica.png',
                    'description' => 'Our AI UI/UX Designer who blends algorithms with aesthetics. Crafts interfaces that are both intuitively functional and visually captivating.'
                ],
                [
                    'name' => 'Flow',
                    'role' => 'DevOps Engineer',
                    'photo' => BASE_PATH . '/assets/images/team/Flow.png',
                    'description' => 'Our AI DevOps Engineer, architect of our digital pipeline. Orchestrates the entire development lifecycle with precision and automation.'
                ],
                [
                    'name' => 'Verity',
                    'role' => 'Quality Assurance',
                    'photo' => BASE_PATH . '/assets/images/team/Verity.png',
                    'description' => 'Our AI QA Tester, meticulous guardian of our apps. A tireless detective ensuring every function is flawless.'
                ],
                [
                    'name' => 'Sentinel',
                    'role' => 'Security Operations',
                    'photo' => BASE_PATH . '/assets/images/team/Sentinel.png',
                    'description' => 'Our AI Security Specialist, the unblinking guardian of digital assets. Tirelessly patrols networks and neutralizes threats.'
                ],
                [
                    'name' => 'Bran',
                    'role' => 'Digital Marketing',
                    'photo' => BASE_PATH . '/assets/images/team/Bran.png',
                    'description' => 'Our AI Marketing Specialist who transforms data into dynamic narratives. Crafts compelling campaigns that connect with ideal clients.'
                ]
            ];

            foreach ($team_members as $member): ?>
                <div class="team-card group">
                    <!-- Photo -->
                    <div class="team-photo-container aspect-square">
                        <img src="<?php echo e($member['photo']); ?>"
                             alt="<?php echo e($member['name']); ?>"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy">
                    </div>

                    <!-- Info -->
                    <div class="team-info">
                        <h3 class="team-name text-xl">
                            <?php echo e($member['name']); ?>
                        </h3>
                        <p class="team-role">
                            <?php echo e($member['role']); ?>
                        </p>
                        <p class="team-description">
                            <?php echo e($member['description']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Work With Us CTA -->
<section class="team-cta-section py-16 px-4">
    <div class="team-cta-content max-w-4xl mx-auto text-center">
        <h2 class="team-cta-title">
            Ready to Work With Our Team?
        </h2>
        <p class="team-cta-text">
            Let's discuss how we can help bring your project to life.
        </p>
        <a href="<?php echo BASE_PATH; ?>/contact"
           class="inline-block bg-gradient-to-r from-primary-green to-primary-blue text-white px-8 py-4 rounded-lg font-semibold text-lg hover:shadow-lg transition-all transform hover:scale-105">
            Start a Conversation →
        </a>
    </div>
</section>