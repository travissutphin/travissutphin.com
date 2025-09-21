<footer class="bg-theme-secondary border-t border-theme-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center">
            <!-- Social Media Icons - Hidden on mobile -->
            <div class="hidden md:flex justify-center space-x-4 mb-6">
                <a href="https://github.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center text-white hover:shadow-lg transition-all">
                    <i class="fab fa-github text-lg"></i>
                </a>
                <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center text-white hover:shadow-lg transition-all">
                    <i class="fab fa-linkedin-in text-lg"></i>
                </a>
                <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center text-white hover:shadow-lg transition-all">
                    <i class="fab fa-twitter text-lg"></i>
                </a>
                <a href="mailto:<?php echo SITE_EMAIL; ?>" class="w-10 h-10 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center text-white hover:shadow-lg transition-all">
                    <i class="fas fa-envelope text-lg"></i>
                </a>
            </div>

            <div class="hidden md:block mt-4 space-x-4">
                <a href="<?php echo BASE_PATH; ?>/" class="text-theme-secondary hover:text-theme-primary transition-colors">Home</a>
                <a href="<?php echo BASE_PATH; ?>/services" class="text-theme-secondary hover:text-theme-primary transition-colors">Services</a>
                <a href="<?php echo BASE_PATH; ?>/projects" class="text-theme-secondary hover:text-theme-primary transition-colors">Projects</a>
                <a href="<?php echo BASE_PATH; ?>/team" class="text-theme-secondary hover:text-theme-primary transition-colors">Team</a>
                <a href="<?php echo BASE_PATH; ?>/blog" class="text-theme-secondary hover:text-theme-primary transition-colors">Blog</a>
                <a href="<?php echo BASE_PATH; ?>/contact" class="text-theme-secondary hover:text-theme-primary transition-colors">Contact</a>
            </div>

            <p class="text-theme-secondary mt-4">
                &copy; <?php echo date('Y'); ?> Travis Sutphin. All rights reserved.
            </p>
        </div>
    </div>
</footer>