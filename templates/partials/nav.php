<?php
$current_path = $_SERVER['REQUEST_URI'];
$current_page = str_replace(BASE_PATH . '/', '', $current_path);
$current_page = strtok($current_page, '?');
if (empty($current_page)) $current_page = 'home';
?>
<ul class="flex items-center space-x-8">
    <li>
        <a href="<?php echo BASE_PATH; ?>/"
           class="relative px-2 py-1 text-theme-secondary hover:text-theme-primary transition-all duration-300 <?php echo $current_page === 'home' ? 'text-theme-primary font-semibold' : ''; ?>">
            Home
            <?php if ($current_page === 'home'): ?>
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-primary-green to-primary-blue"></span>
            <?php endif; ?>
        </a>
    </li>
    <li>
        <a href="<?php echo BASE_PATH; ?>/services"
           class="relative px-2 py-1 text-theme-secondary hover:text-theme-primary transition-all duration-300 <?php echo $current_page === 'services' ? 'text-theme-primary font-semibold' : ''; ?>">
            Services
            <?php if ($current_page === 'services'): ?>
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-primary-green to-primary-blue"></span>
            <?php endif; ?>
        </a>
    </li>
    <li class="relative group">
        <button type="button"
                class="relative px-2 py-1 text-theme-secondary hover:text-theme-primary transition-all duration-300 flex items-center gap-1 <?php echo (strpos($current_page, 'case-studies') === 0 || strpos($current_page, 'projects') === 0 || strpos($current_page, 'templates-free') !== false) ? 'text-theme-primary font-semibold' : ''; ?>">
            My Work
            <i data-lucide="chevron-down" class="w-4 h-4"></i>
            <?php if (strpos($current_page, 'case-studies') === 0 || strpos($current_page, 'projects') === 0 || strpos($current_page, 'templates-free') !== false): ?>
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-primary-green to-primary-blue"></span>
            <?php endif; ?>
        </button>
        <!-- Dropdown Menu -->
        <div class="absolute left-0 mt-2 w-48 bg-theme-primary border border-theme-primary rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
            <ul class="py-2">
                <li>
                    <a href="<?php echo BASE_PATH; ?>/projects"
                       class="block px-4 py-2 text-theme-secondary hover:text-theme-primary hover:bg-theme-secondary/10 transition-colors <?php echo strpos($current_page, 'projects') === 0 ? 'text-theme-primary font-semibold' : ''; ?>">
                        Projects
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASE_PATH; ?>/projects#free-templates"
                       class="block px-4 py-2 text-theme-secondary hover:text-theme-primary hover:bg-theme-secondary/10 transition-colors">
                        Free Templates
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASE_PATH; ?>/case-studies"
                       class="block px-4 py-2 text-theme-secondary hover:text-theme-primary hover:bg-theme-secondary/10 transition-colors <?php echo strpos($current_page, 'case-studies') === 0 ? 'text-theme-primary font-semibold' : ''; ?>">
                        Case Studies
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <a href="<?php echo BASE_PATH; ?>/blog"
           class="relative px-2 py-1 text-theme-secondary hover:text-theme-primary transition-all duration-300 <?php echo strpos($current_page, 'blog') === 0 ? 'text-theme-primary font-semibold' : ''; ?>">
            Blog
            <?php if (strpos($current_page, 'blog') === 0): ?>
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-primary-green to-primary-blue"></span>
            <?php endif; ?>
        </a>
    </li>
    <li>
        <a href="<?php echo BASE_PATH; ?>/resume"
           class="relative px-2 py-1 text-theme-secondary hover:text-theme-primary transition-all duration-300 <?php echo $current_page === 'resume' ? 'text-theme-primary font-semibold' : ''; ?>">
            About
            <?php if ($current_page === 'resume'): ?>
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-primary-green to-primary-blue"></span>
            <?php endif; ?>
        </a>
    </li>
    <li>
        <a href="<?php echo BASE_PATH; ?>/contact"
           class="relative px-2 py-1 text-theme-secondary hover:text-theme-primary transition-all duration-300 <?php echo $current_page === 'contact' ? 'text-theme-primary font-semibold' : ''; ?>">
            Contact
            <?php if ($current_page === 'contact'): ?>
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-primary-green to-primary-blue"></span>
            <?php endif; ?>
        </a>
    </li>
</ul>
