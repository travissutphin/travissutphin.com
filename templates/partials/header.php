<header class="bg-theme-primary border-b border-theme-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="<?php echo BASE_PATH; ?>/" class="inline-block">
                    <!-- Logo for Light Mode -->
                    <img src="<?php echo BASE_PATH; ?>/assets/images/travissutphinLogo-forLight-400x103.png"
                         alt="Travis Sutphin"
                         class="logo-light h-12 md:h-16 w-auto object-contain">
                    <!-- Logo for Dark Mode -->
                    <img src="<?php echo BASE_PATH; ?>/assets/images/travissutphinLogo-forDark-400x103.png"
                         alt="Travis Sutphin"
                         class="logo-dark h-12 md:h-16 w-auto object-contain">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:block">
                <?php render_partial('nav'); ?>
            </nav>

            <!-- Theme Toggle Button -->
            <button
                data-theme-toggle
                class="theme-toggle ml-4"
                aria-label="Switch to dark mode"
                title="Switch to dark mode"
                type="button"
            >
                <i data-lucide="sun" class="sun-icon w-4 h-4"></i>
                <i data-lucide="moon" class="moon-icon w-4 h-4"></i>
            </button>
        </div>
    </div>
</header>