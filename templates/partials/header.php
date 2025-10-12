<header class="bg-theme-primary border-b border-theme-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="<?php echo BASE_PATH; ?>/" class="inline-block">
                    <!-- Logo for Light Mode -->
                    <picture class="logo-light">
                        <source srcset="<?php echo BASE_PATH; ?>/assets/images/travissutphinLogo-forLight-400x103.webp" type="image/webp">
                        <img src="<?php echo BASE_PATH; ?>/assets/images/travissutphinLogo-forLight-400x103.png"
                             alt="Travis Sutphin"
                             class="h-12 md:h-16 w-auto object-contain"
                             width="400"
                             height="103">
                    </picture>
                    <!-- Logo for Dark Mode -->
                    <picture class="logo-dark">
                        <source srcset="<?php echo BASE_PATH; ?>/assets/images/travissutphinLogo-forDark-400x103.webp" type="image/webp">
                        <img src="<?php echo BASE_PATH; ?>/assets/images/travissutphinLogo-forDark-400x103.png"
                             alt="Travis Sutphin"
                             class="h-12 md:h-16 w-auto object-contain"
                             width="400"
                             height="103">
                    </picture>
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