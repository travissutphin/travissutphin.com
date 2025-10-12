<?php
$current_path = $_SERVER['REQUEST_URI'];
$current_page = str_replace(BASE_PATH . '/', '', $current_path);
$current_page = strtok($current_page, '?');
if (empty($current_page)) $current_page = 'home';
?>

<!-- Mobile Bottom Navigation (iOS style) -->
<nav class="md:hidden fixed bottom-0 left-0 right-0 bg-theme-card border-t border-theme-primary z-50">
    <div class="grid grid-cols-5 items-center">
        <!-- Home -->
        <a href="<?php echo BASE_PATH; ?>/"
           class="flex flex-col items-center justify-center py-2 px-3 <?php echo $current_page === 'home' ? 'text-theme-primary' : 'text-theme-secondary'; ?>">
            <i data-lucide="home" class="w-5 h-5 mb-1"></i>
            <span class="text-xs">Home</span>
        </a>

        <!-- Services -->
        <a href="<?php echo BASE_PATH; ?>/services"
           class="flex flex-col items-center justify-center py-2 px-3 <?php echo $current_page === 'services' ? 'text-theme-primary' : 'text-theme-secondary'; ?>">
            <i data-lucide="briefcase" class="w-5 h-5 mb-1"></i>
            <span class="text-xs">Services</span>
        </a>

        <!-- Social (Center button) -->
        <button id="social-menu-btn"
                class="flex flex-col items-center justify-center py-2 px-3 relative">
            <div class="w-12 h-12 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center -mt-4 shadow-lg">
                <i data-lucide="share-2" class="w-5 h-5 text-white"></i>
            </div>
            <span class="text-xs text-theme-inverse mt-1">Connect</span>
        </button>

        <!-- Free Apps -->
        <a href="<?php echo BASE_PATH; ?>/projects"
           class="flex flex-col items-center justify-center py-2 px-3 <?php echo $current_page === 'projects' ? 'text-theme-primary' : 'text-theme-secondary'; ?>">
            <i data-lucide="folder" class="w-5 h-5 mb-1"></i>
            <span class="text-xs">Free Apps</span>
        </a>

        <!-- Blog -->
        <a href="<?php echo BASE_PATH; ?>/blog"
           class="flex flex-col items-center justify-center py-2 px-3 <?php echo strpos($current_page, 'blog') === 0 ? 'text-theme-primary' : 'text-theme-secondary'; ?>">
            <i data-lucide="book-open" class="w-5 h-5 mb-1"></i>
            <span class="text-xs">Blog</span>
        </a>
    </div>
</nav>

<!-- Social Links Popup -->
<div id="social-popup" class="hidden fixed inset-0 z-40 md:hidden">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-50" id="social-overlay"></div>

    <!-- Popup Content -->
    <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 bg-theme-card rounded-2xl shadow-xl p-6 w-11/12 max-w-sm">
        <h3 class="text-center font-semibold text-theme-primary mb-4">Connect With Me</h3>

        <div class="grid grid-cols-4 gap-4">
            <a href="https://www.reddit.com/r/travissutphin/"
               target="_blank"
               rel="noopener noreferrer"
               class="flex flex-col items-center justify-center p-3 rounded-lg hover:bg-theme-tertiary transition-colors"
               aria-label="Visit Reddit profile">
                <div class="w-12 h-12 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center mb-2">
                    <i class="fab fa-reddit text-white text-xl"></i>
                </div>
                <span class="text-xs text-theme-secondary">Reddit</span>
            </a>

            <a href="https://github.com/travissutphin?tab=repositories"
               target="_blank"
               rel="noopener noreferrer"
               class="flex flex-col items-center justify-center p-3 rounded-lg hover:bg-theme-tertiary transition-colors"
               aria-label="Visit GitHub repositories">
                <div class="w-12 h-12 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center mb-2">
                    <i class="fab fa-github text-white text-xl"></i>
                </div>
                <span class="text-xs text-theme-secondary">GitHub</span>
            </a>

            <a href="https://www.linkedin.com/in/travis-sutphin-4472a1a/"
               target="_blank"
               rel="noopener noreferrer"
               class="flex flex-col items-center justify-center p-3 rounded-lg hover:bg-theme-tertiary transition-colors"
               aria-label="Visit LinkedIn profile">
                <div class="w-12 h-12 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center mb-2">
                    <i class="fab fa-linkedin-in text-white text-xl"></i>
                </div>
                <span class="text-xs text-theme-secondary">LinkedIn</span>
            </a>

            <a href="mailto:<?php echo SITE_EMAIL; ?>"
               class="flex flex-col items-center justify-center p-3 rounded-lg hover:bg-theme-tertiary transition-colors"
               aria-label="Send email">
                <div class="w-12 h-12 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center mb-2">
                    <i class="fas fa-envelope text-white text-xl"></i>
                </div>
                <span class="text-xs text-theme-secondary">Email</span>
            </a>
        </div>

        <button id="close-social" class="mt-4 w-full py-2 text-theme-secondary text-sm">
            Close
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const socialBtn = document.getElementById('social-menu-btn');
    const socialPopup = document.getElementById('social-popup');
    const socialOverlay = document.getElementById('social-overlay');
    const closeBtn = document.getElementById('close-social');

    function openSocial() {
        socialPopup.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeSocial() {
        socialPopup.classList.add('hidden');
        document.body.style.overflow = '';
    }

    if (socialBtn) {
        socialBtn.addEventListener('click', openSocial);
    }

    if (socialOverlay) {
        socialOverlay.addEventListener('click', closeSocial);
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', closeSocial);
    }
});
</script>