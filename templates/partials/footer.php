<footer class="bg-theme-secondary border-t border-theme-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center">
            <!-- Social Media Icons - Hidden on mobile -->
            <div class="hidden md:flex justify-center space-x-4 mb-6">
                <a href="https://www.reddit.com/r/travissutphin/"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="w-10 h-10 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center text-white hover:shadow-lg transition-all"
                   aria-label="Visit Reddit profile">
                    <i class="fab fa-reddit text-lg"></i>
                </a>
                <a href="https://github.com/travissutphin?tab=repositories"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="w-10 h-10 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center text-white hover:shadow-lg transition-all"
                   aria-label="Visit GitHub repositories">
                    <i class="fab fa-github text-lg"></i>
                </a>
                <a href="https://www.linkedin.com/in/travis-sutphin-4472a1a/"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="w-10 h-10 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center text-white hover:shadow-lg transition-all"
                   aria-label="Visit LinkedIn profile">
                    <i class="fab fa-linkedin-in text-lg"></i>
                </a>
                <a href="mailto:<?php echo SITE_EMAIL; ?>"
                   class="w-10 h-10 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center text-white hover:shadow-lg transition-all"
                   aria-label="Send email">
                    <i class="fas fa-envelope text-lg"></i>
                </a>
            </div>

            <div class="hidden md:block mt-4 space-x-4">
                <a href="<?php echo BASE_PATH; ?>/" class="text-theme-secondary hover:text-theme-primary transition-colors">Home</a>
                <a href="<?php echo BASE_PATH; ?>/services" class="text-theme-secondary hover:text-theme-primary transition-colors">Services</a>
                <a href="<?php echo BASE_PATH; ?>/team" class="text-theme-secondary hover:text-theme-primary transition-colors">Team</a>
                <a href="<?php echo BASE_PATH; ?>/blog" class="text-theme-secondary hover:text-theme-primary transition-colors">Blog</a>
                <a href="<?php echo BASE_PATH; ?>/projects" class="text-theme-secondary hover:text-theme-primary transition-colors">Projects</a>
                <a href="<?php echo BASE_PATH; ?>/resume" class="text-theme-secondary hover:text-theme-primary transition-colors">Resume</a>
                <a href="<?php echo BASE_PATH; ?>/contact" class="text-theme-secondary hover:text-theme-primary transition-colors">Contact</a>
            </div>

            <p class="text-theme-secondary mt-4">
                &copy; <?php echo date('Y'); ?> Travis Sutphin. All rights reserved.
            </p>
        </div>
    </div>
</footer>