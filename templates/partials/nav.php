<?php
$current_path = $_SERVER['REQUEST_URI'];
$current_page = str_replace(BASE_PATH . '/', '', $current_path);
$current_page = strtok($current_page, '?');
if (empty($current_page)) $current_page = 'home';
?>
<ul class="flex space-x-8">
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
    <li>
        <a href="<?php echo BASE_PATH; ?>/team"
           class="relative px-2 py-1 text-theme-secondary hover:text-theme-primary transition-all duration-300 <?php echo $current_page === 'team' ? 'text-theme-primary font-semibold' : ''; ?>">
            Team
            <?php if ($current_page === 'team'): ?>
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-primary-green to-primary-blue"></span>
            <?php endif; ?>
        </a>
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
        <a href="<?php echo BASE_PATH; ?>/projects"
           class="relative px-2 py-1 text-theme-secondary hover:text-theme-primary transition-all duration-300 <?php echo $current_page === 'projects' ? 'text-theme-primary font-semibold' : ''; ?>">
            Free Apps
            <?php if ($current_page === 'projects'): ?>
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-primary-green to-primary-blue"></span>
            <?php endif; ?>
        </a>
    </li>
</ul>