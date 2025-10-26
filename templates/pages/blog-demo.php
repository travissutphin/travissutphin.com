<?php
// Pagination setup
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Check for category, tag, or search query filtering
$selected_category = isset($_GET['category']) ? $_GET['category'] : (isset($category_filter) ? $category_filter : null);
$selected_tag = isset($_GET['tag']) ? $_GET['tag'] : null;
$search_query = isset($_GET['q']) ? trim($_GET['q']) : null;

// Build filters array
$filters = [];
if ($selected_category) {
    $filters['category'] = $selected_category;
}
if ($selected_tag) {
    $filters['tag'] = $selected_tag;
}

// Get posts with filtering applied
$all_posts = get_blog_posts(null, $filters);

// Apply search query filtering if provided
if ($search_query) {
    $search_lower = strtolower($search_query);
    $all_posts = array_filter($all_posts, function($post) use ($search_lower) {
        // Search in title, excerpt, tags, and category
        $searchable_text = strtolower(
            ($post['title'] ?? '') . ' ' .
            ($post['excerpt'] ?? '') . ' ' .
            ($post['category'] ?? '') . ' ' .
            (isset($post['tags']) && is_array($post['tags']) ? implode(' ', $post['tags']) : '')
        );
        return strpos($searchable_text, $search_lower) !== false;
    });
    $all_posts = array_values($all_posts); // Re-index array
}

$total_posts = count($all_posts);
$posts_per_page = POSTS_PER_PAGE;
$total_pages = ceil($total_posts / $posts_per_page);
$offset = ($page - 1) * $posts_per_page;

// Get posts for current page
$posts = array_slice($all_posts, $offset, $posts_per_page);

// Get all categories for navigation
$all_categories = get_all_categories();

// Get all unique tags from posts
$all_tags = [];
foreach (get_blog_posts() as $post) {
    if (isset($post['tags']) && is_array($post['tags'])) {
        $all_tags = array_merge($all_tags, $post['tags']);
    }
}
$all_tags = array_unique($all_tags);
sort($all_tags);

// Get featured post (newest post)
$featured_post = !empty($all_posts) ? $all_posts[0] : null;
$regular_posts = ($selected_tag || $selected_category) ? $posts : array_slice($posts, 1); // Skip featured if filtering

// Calculate reading time dynamically
function calculate_reading_time($content) {
    $word_count = str_word_count(strip_tags($content));
    return ceil($word_count / 200);
}
?>

<!-- Hero Section with Gradient (COMPACT VERSION) -->
<section class="min-h-[60vh] flex items-center gradient-green-blue px-4 py-12">
    <div class="max-w-7xl mx-auto w-full">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-3">
                Small Wins, Big Ships
            </h1>
            <p class="text-lg md:text-xl mb-6 max-w-2xl mx-auto">
                Bite-sized insights that move your project forward
            </p>

            <!-- REDESIGNED: Compact Filter Bar -->
            <div class="max-w-4xl mx-auto bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-4 relative z-10 overflow-visible">
                <div class="flex flex-col md:flex-row gap-3 items-stretch md:items-center overflow-visible">
                    <!-- Category Dropdown (Compact) -->
                    <div class="flex-none md:w-64">
                        <div class="relative">
                            <select id="categoryFilter"
                                    class="w-full px-4 py-3 pr-10 rounded-lg bg-white dark:bg-gray-800 text-gray-800 dark:text-white font-medium appearance-none cursor-pointer
                                           focus:outline-none focus:ring-2 focus:ring-primary-green transition-all"
                                    onchange="window.location.href = this.value">
                                <option value="<?php echo BASE_PATH; ?>/blog-demo" <?php echo !$selected_category ? 'selected' : ''; ?>>
                                    📂 All Categories (<?php echo count(get_blog_posts()); ?>)
                                </option>
                                <?php
                                // Category slug mapping
                                $category_slugs = [
                                    'AI & Automation' => 'ai-automation',
                                    'Project Management' => 'project-management',
                                    'Productivity & Systems' => 'productivity-systems',
                                    'Technical Leadership' => 'technical-leadership',
                                    'Business & Strategy' => 'business-strategy',
                                    'Learning & Development' => 'learning-development'
                                ];

                                foreach ($all_categories as $category):
                                    $category_slug = $category_slugs[$category] ?? create_slug($category);
                                    $category_count = count(get_blog_posts(null, ['category' => $category]));
                                ?>
                                    <option value="<?php echo BASE_PATH; ?>/blog-demo?category=<?php echo urlencode($category); ?>"
                                            <?php echo $selected_category === $category ? 'selected' : ''; ?>>
                                        <?php echo e($category); ?> (<?php echo $category_count; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i data-lucide="chevron-down" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Post Search with Live Results -->
                    <div class="flex-1 relative z-20">
                        <div class="relative">
                            <input type="text"
                                   id="postSearch"
                                   placeholder="🔍 Search posts... (title, content, tags)"
                                   class="w-full px-4 py-3 pr-10 rounded-lg bg-white dark:bg-gray-800 text-gray-800 dark:text-white placeholder:text-gray-500 dark:placeholder:text-gray-400 font-medium
                                          focus:outline-none focus:ring-2 focus:ring-primary-green transition-all"
                                   autocomplete="off"
                                   value="<?php echo $search_query ? e($search_query) : ''; ?>">
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i data-lucide="search" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i>
                            </div>
                        </div>
                        <!-- Search Results Dropdown -->
                        <div id="searchAutocomplete"
                             class="absolute top-full left-0 right-0 mt-1 bg-white dark:bg-gray-800 rounded-lg shadow-xl z-[9999] max-h-96 overflow-y-auto hidden">
                            <div id="searchResults" class="py-2">
                                <!-- Results populated via JavaScript -->
                            </div>
                        </div>
                    </div>

                    <!-- Clear Filters Button (shown when filters active) -->
                    <?php if ($selected_category || $selected_tag || $search_query): ?>
                        <a href="<?php echo BASE_PATH; ?>/blog-demo"
                           class="flex-none px-6 py-3 bg-white/20 hover:bg-white/30 text-white rounded-lg font-semibold
                                  transition-all flex items-center gap-2">
                            <i data-lucide="x" class="w-4 h-4"></i>
                            Clear
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Active Filter Display -->
                <?php if ($selected_category || $selected_tag || $search_query): ?>
                    <div class="mt-3 flex flex-wrap items-center gap-2 text-sm">
                        <span class="text-white/80">Active filters:</span>
                        <?php if ($search_query): ?>
                            <span class="px-3 py-1 bg-white/20 text-white rounded-full flex items-center gap-1">
                                🔍 "<?php echo e($search_query); ?>"
                                <a href="<?php echo BASE_PATH; ?>/blog-demo<?php echo $selected_category ? '?category=' . urlencode($selected_category) : ''; ?><?php echo ($selected_category && $selected_tag) ? '&' : ($selected_tag ? '?' : ''); ?><?php echo $selected_tag ? 'tag=' . urlencode($selected_tag) : ''; ?>"
                                   class="ml-1 hover:text-red-300">×</a>
                            </span>
                        <?php endif; ?>
                        <?php if ($selected_category): ?>
                            <span class="px-3 py-1 bg-white/20 text-white rounded-full flex items-center gap-1">
                                📂 <?php echo e($selected_category); ?>
                                <a href="<?php echo BASE_PATH; ?>/blog-demo<?php echo $selected_tag ? '?tag=' . urlencode($selected_tag) : ''; ?><?php echo ($selected_tag && $search_query) ? '&' : ($search_query ? '?' : ''); ?><?php echo $search_query ? 'q=' . urlencode($search_query) : ''; ?>"
                                   class="ml-1 hover:text-red-300">×</a>
                            </span>
                        <?php endif; ?>
                        <?php if ($selected_tag): ?>
                            <span class="px-3 py-1 bg-white/20 text-white rounded-full flex items-center gap-1">
                                🏷️ <?php echo e($selected_tag); ?>
                                <a href="<?php echo BASE_PATH; ?>/blog-demo<?php echo $selected_category ? '?category=' . urlencode($selected_category) : ''; ?><?php echo ($selected_category && $search_query) ? '&' : ($search_query ? '?' : ''); ?><?php echo $search_query ? 'q=' . urlencode($search_query) : ''; ?>"
                                   class="ml-1 hover:text-red-300">×</a>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Results Count -->
                <div class="mt-3 text-center text-white/90 text-sm relative z-0">
                    <i data-lucide="file-text" class="w-4 h-4 inline"></i>
                    Showing <strong><?php echo $total_posts; ?></strong> post<?php echo $total_posts !== 1 ? 's' : ''; ?>
                </div>
            </div>

            <!-- Community Signals (Compact) -->
            <div class="flex justify-center items-center gap-6 text-sm opacity-90 relative z-0">
                <span class="flex items-center gap-2">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    2,147 builders reading
                </span>
                <span class="flex items-center gap-2">
                    <i data-lucide="book-open" class="w-4 h-4"></i>
                    4-min reads
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Main Blog Content (NO MORE FILTER SECTIONS - CONTENT STARTS IMMEDIATELY) -->
<section class="blog-content-section py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <?php if (empty($posts)): ?>
            <div class="text-center py-12">
                <i data-lucide="inbox" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                <p class="text-theme-secondary text-lg">
                    <?php
                    if ($search_query) {
                        echo 'No posts found matching "' . e($search_query) . '".';
                    } elseif ($selected_tag) {
                        echo 'No posts found with tag "' . e($selected_tag) . '".';
                    } else {
                        echo 'No blog posts yet. Check back soon!';
                    }
                    ?>
                </p>
                <a href="<?php echo BASE_PATH; ?>/blog-demo"
                   class="mt-4 inline-block px-6 py-3 bg-gradient-to-r from-primary-green to-primary-blue text-white rounded-lg font-semibold hover:shadow-lg transition-all">
                    ← Back to All Posts
                </a>
            </div>
        <?php else: ?>
            <div class="lg:flex lg:gap-8">
                <!-- Main Content Area -->
                <div class="lg:w-3/4">
                    <?php if ($featured_post && !$selected_tag && $page == 1): ?>
                        <!-- Featured Post Card -->
                        <div class="mb-12 animate-on-scroll">
                            <div class="featured-post-card">
                                <!-- Featured Badge -->
                                <div class="featured-badge text-white text-center py-2 text-sm font-semibold">
                                    ♥ READER FAVORITE
                                </div>

                                <div class="p-8">
                                    <!-- Blog Image (Clickable) -->
                                    <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($featured_post['slug']); ?>" class="blog-thumbnail h-64 md:h-96 rounded-lg mb-6 overflow-hidden shadow-2xl block">
                                        <?php if (!empty($featured_post['image'])): ?>
                                            <?php
                                            // Generate WebP path from PNG path
                                            $image_path = BASE_PATH . trim(trim($featured_post['image']), '"');
                                            $image_path_webp = preg_replace('/\.png$/i', '.webp', $image_path);
                                            ?>
                                            <picture>
                                                <source type="image/webp" srcset="<?php echo $image_path_webp; ?>">
                                                <img src="<?php echo $image_path; ?>"
                                                     alt="<?php echo htmlspecialchars($featured_post['title'] ?? 'Blog post'); ?>"
                                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                                     loading="lazy">
                                            </picture>
                                        <?php else: ?>
                                            <div class="bg-gradient-to-br from-primary-green to-primary-blue h-full flex items-center justify-center">
                                                <i data-lucide="file-text" class="w-20 h-20 text-white opacity-50"></i>
                                            </div>
                                        <?php endif; ?>
                                    </a>

                                    <!-- Category & Date -->
                                    <div class="flex items-center gap-4 mb-4">
                                        <?php if (!empty($featured_post['tags'])): ?>
                                            <span class="px-3 py-1 bg-light-blue text-primary-blue text-xs font-semibold rounded-full">
                                                <?php echo e($featured_post['tags'][0]); ?>
                                            </span>
                                        <?php endif; ?>
                                        <span class="text-sm text-theme-primary dark:text-white">
                                            <?php echo date('M d, Y', strtotime($featured_post['date'] ?? 'now')); ?>
                                        </span>
                                        <span class="text-sm text-theme-primary dark:text-white">
                                            <?php
                                            $reading_time = isset($featured_post['readingTime'])
                                                ? intval($featured_post['readingTime'])
                                                : calculate_reading_time($featured_post['content'] ?? '');
                                            echo $reading_time . ' min read';
                                            ?>
                                        </span>
                                    </div>

                                    <!-- Title & Excerpt -->
                                    <h2 class="blog-title text-2xl font-bold mb-3 hover:text-primary-blue transition-colors">
                                        <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($featured_post['slug']); ?>">
                                            <?php echo e($featured_post['title'] ?? 'Untitled'); ?>
                                        </a>
                                    </h2>
                                    <p class="blog-excerpt mb-6 line-clamp-3">
                                        <?php echo e($featured_post['excerpt'] ?? ''); ?>
                                    </p>

                                    <!-- Author & CTA -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center">
                                                <span class="text-white font-semibold">TS</span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-theme-primary">Travis Sutphin</p>
                                                <p class="text-xs text-theme-secondary">AI-Tech-Solutions</p>
                                            </div>
                                        </div>
                                        <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($featured_post['slug']); ?>"
                                           class="px-4 py-2 bg-gradient-to-r from-primary-green to-primary-blue text-white rounded-lg font-semibold hover:shadow-lg transition-all">
                                            Read More →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Regular Blog Posts Grid -->
                    <div class="grid md:grid-cols-2 gap-8">
                        <?php foreach ($regular_posts as $post): ?>
                            <div class="animate-on-scroll blog-fade-in">
                                <div class="blog-post-card h-full flex flex-col">
                                    <!-- Thumbnail (Clickable) -->
                                    <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($post['slug']); ?>" class="blog-thumbnail h-48 overflow-hidden block">
                                        <?php if (!empty($post['image'])): ?>
                                            <?php
                                            // Generate WebP path from PNG path
                                            $image_path = BASE_PATH . trim(trim($post['image']), '"');
                                            $image_path_webp = preg_replace('/\.png$/i', '.webp', $image_path);
                                            ?>
                                            <picture>
                                                <source type="image/webp" srcset="<?php echo $image_path_webp; ?>">
                                                <img src="<?php echo $image_path; ?>"
                                                     alt="<?php echo htmlspecialchars($post['title'] ?? 'Blog post'); ?>"
                                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                                     loading="lazy">
                                            </picture>
                                        <?php else: ?>
                                            <div class="bg-gradient-to-br from-gray-100 to-gray-200 h-full flex items-center justify-center">
                                                <i data-lucide="file-text" class="w-12 h-12 text-gray-400"></i>
                                            </div>
                                        <?php endif; ?>
                                    </a>

                                    <div class="p-6 flex-grow flex flex-col">
                                        <!-- Category & Meta -->
                                        <div class="flex items-center gap-3 mb-3 text-sm">
                                            <?php if (!empty($post['tags'])): ?>
                                                <span class="px-2 py-1 bg-light-blue text-primary-blue font-semibold rounded">
                                                    <?php echo e($post['tags'][0]); ?>
                                                </span>
                                            <?php endif; ?>
                                            <span class="text-theme-primary dark:text-white">
                                                <?php echo date('M d', strtotime($post['date'] ?? 'now')); ?>
                                            </span>
                                            <span class="text-theme-primary dark:text-white">
                                                <?php
                                                $reading_time = isset($post['readingTime'])
                                                    ? intval($post['readingTime'])
                                                    : calculate_reading_time($post['content'] ?? '');
                                                echo $reading_time . ' min';
                                                ?>
                                            </span>
                                        </div>

                                        <!-- Title -->
                                        <h3 class="blog-title text-lg font-bold mb-2 line-clamp-2 hover:text-primary-blue transition-colors">
                                            <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($post['slug']); ?>">
                                                <?php echo e($post['title'] ?? 'Untitled'); ?>
                                            </a>
                                        </h3>

                                        <!-- Excerpt -->
                                        <p class="blog-excerpt text-sm mb-4 line-clamp-3 flex-grow">
                                            <?php echo e($post['excerpt'] ?? ''); ?>
                                        </p>

                                        <!-- Author & Read More Button -->
                                        <div class="flex items-center justify-between mt-auto">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center">
                                                    <span class="text-white text-xs font-semibold">TS</span>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-semibold text-theme-primary">Travis Sutphin</p>
                                                    <p class="text-xs text-theme-secondary">AI-Tech-Solutions</p>
                                                </div>
                                            </div>
                                            <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($post['slug']); ?>"
                                               class="px-3 py-1.5 bg-gradient-to-r from-primary-green to-primary-blue text-white text-xs rounded-lg font-semibold hover:shadow-lg transition-all">
                                                Read More →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if ($total_pages > 1 && !$selected_tag): ?>
                        <div class="mt-12 flex justify-center items-center space-x-2">
                            <?php if ($page > 1): ?>
                                <a href="<?php echo BASE_PATH; ?>/blog-demo?page=<?php echo $page - 1; ?><?php echo $selected_category ? '&category=' . urlencode($selected_category) : ''; ?>"
                                   class="pagination-btn px-4 py-2 rounded-lg shadow">
                                    ← Previous
                                </a>
                            <?php endif; ?>

                            <div class="flex space-x-1">
                                <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                                    <a href="<?php echo BASE_PATH; ?>/blog-demo?page=<?php echo $i; ?><?php echo $selected_category ? '&category=' . urlencode($selected_category) : ''; ?>"
                                       class="w-10 h-10 flex items-center justify-center rounded-lg transition-all
                                              <?php echo $i === $page
                                                  ? 'pagination-active'
                                                  : 'pagination-btn'; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                <?php endfor; ?>
                            </div>

                            <?php if ($page < $total_pages): ?>
                                <a href="<?php echo BASE_PATH; ?>/blog-demo?page=<?php echo $page + 1; ?><?php echo $selected_category ? '&category=' . urlencode($selected_category) : ''; ?>"
                                   class="pagination-btn px-4 py-2 rounded-lg shadow">
                                    Next →
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar (Desktop Only) -->
                <aside class="hidden lg:block lg:w-1/4">
                    <div class="sticky top-8 space-y-8">
                        <!-- Community CTA -->
                        <div class="sidebar-cta text-white rounded-lg p-6">
                            <h3 class="text-xl font-bold mb-3">Need a Second Opinion?</h3>
                            <p class="text-sm mb-4 opacity-95">
                                Sometimes a fresh perspective is all you need to move forward.
                            </p>
                            <a href="<?php echo BASE_PATH; ?>/contact"
                               class="block text-center bg-white text-dark-green py-2 px-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                                Let's Chat →
                            </a>
                        </div>

                        <!-- Popular Posts -->
                        <div class="sidebar-widget p-6">
                            <h3 class="sidebar-title text-lg font-bold mb-4">Popular Posts</h3>
                            <ul class="space-y-3">
                                <?php
                                $all_posts_unfiltered = get_blog_posts();
                                foreach (array_slice($all_posts_unfiltered, 0, 3) as $popular): ?>
                                    <li>
                                        <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($popular['slug']); ?>"
                                           class="sidebar-link text-sm">
                                            <?php echo e($popular['title'] ?? 'Untitled'); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Quick Tag Access -->
                        <div class="sidebar-widget p-6">
                            <h3 class="sidebar-title text-lg font-bold mb-4">Popular Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach (array_slice($all_tags, 0, 10) as $tag): ?>
                                    <a href="<?php echo BASE_PATH; ?>/blog-demo?tag=<?php echo urlencode($tag); ?>"
                                       class="filter-tag px-3 py-1 text-xs rounded-full hover:bg-primary-green hover:text-white transition-colors">
                                        <?php echo e($tag); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 px-4 gradient-green-blue">
    <div class="max-w-4xl mx-auto text-center text-white">
        <h2 class="text-3xl font-bold mb-4">Join the Builder's Weekly</h2>
        <p class="text-xl mb-8 opacity-95">
            Every Thursday: One actionable insight to move your project forward. That's it.
        </p>
        <div class="max-w-md mx-auto">
            <div class="newsletter-backdrop rounded-lg p-8">
                <input type="email"
                       placeholder="Your best email..."
                       class="search-input w-full px-4 py-3 rounded-lg mb-4"
                       onclick="alert('Newsletter launching soon! We\'ll notify you when it\'s ready.')">
                <button class="w-full bg-white text-dark-green py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Save My Spot →
                </button>
                <p class="text-xs mt-3 opacity-75">
                    Weekly insights. Zero spam. Unsubscribe anytime.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Post Search JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const postSearch = document.getElementById('postSearch');
    const searchAutocomplete = document.getElementById('searchAutocomplete');
    const searchResults = document.getElementById('searchResults');

    // All posts data from PHP
    const allPosts = <?php echo json_encode(array_map(function($post) {
        return [
            'title' => $post['title'] ?? '',
            'excerpt' => $post['excerpt'] ?? '',
            'slug' => $post['slug'] ?? '',
            'tags' => $post['tags'] ?? [],
            'category' => $post['category'] ?? '',
            'readingTime' => $post['readingTime'] ?? 5
        ];
    }, get_blog_posts())); ?>;

    // Post search functionality
    postSearch.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();

        if (searchTerm.length === 0) {
            searchAutocomplete.classList.add('hidden');
            return;
        }

        // Search through posts (title, excerpt, tags, category)
        const matchingPosts = allPosts.filter(post => {
            const searchableText = (
                post.title.toLowerCase() + ' ' +
                post.excerpt.toLowerCase() + ' ' +
                post.category.toLowerCase() + ' ' +
                (post.tags || []).join(' ').toLowerCase()
            );
            return searchableText.includes(searchTerm);
        });

        if (matchingPosts.length === 0) {
            searchResults.innerHTML = '<div class="px-4 py-3 text-gray-500 dark:text-gray-400 text-sm text-center">No posts found matching your search</div>';
            searchAutocomplete.classList.remove('hidden');
            return;
        }

        // Build results HTML
        let html = '';
        matchingPosts.slice(0, 5).forEach(post => {
            const url = '<?php echo BASE_PATH; ?>/blog/' + post.slug;

            html += `
                <a href="${url}"
                   class="block px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors border-b border-gray-100 dark:border-gray-700 last:border-0">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-gray-800 dark:text-white text-sm mb-1 truncate">
                                📄 ${post.title}
                            </div>
                            <div class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2">
                                ${post.excerpt}
                            </div>
                            <div class="flex items-center gap-2 mt-1 text-xs text-gray-500 dark:text-gray-500">
                                <span>📂 ${post.category}</span>
                                <span>•</span>
                                <span>⏱️ ${post.readingTime} min</span>
                            </div>
                        </div>
                    </div>
                </a>
            `;
        });

        // Add "View all results" link if there are more posts
        if (matchingPosts.length > 5) {
            html += `
                <a href="<?php echo BASE_PATH; ?>/blog-demo?q=${encodeURIComponent(searchTerm)}"
                   class="block px-4 py-3 bg-gray-50 dark:bg-gray-900 text-center text-sm font-semibold text-primary-green hover:text-primary-blue transition-colors">
                    View all ${matchingPosts.length} results →
                </a>
            `;
        }

        searchResults.innerHTML = html;
        searchAutocomplete.classList.remove('hidden');
    });

    // Close autocomplete when clicking outside
    document.addEventListener('click', function(event) {
        if (!postSearch.contains(event.target) && !searchAutocomplete.contains(event.target)) {
            searchAutocomplete.classList.add('hidden');
        }
    });

    // Handle Enter key
    postSearch.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            const searchTerm = this.value.trim();
            if (searchTerm.length > 0) {
                const currentCategory = <?php echo json_encode($selected_category); ?>;
                const categoryParam = currentCategory ? '&category=' + encodeURIComponent(currentCategory) : '';
                window.location.href = '<?php echo BASE_PATH; ?>/blog-demo?q=' + encodeURIComponent(searchTerm) + categoryParam;
            }
        }
    });
});
</script>
