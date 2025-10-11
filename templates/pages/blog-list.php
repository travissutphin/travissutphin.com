<?php
// Pagination setup
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Check for category or tag filtering
$selected_category = isset($_GET['category']) ? $_GET['category'] : (isset($category_filter) ? $category_filter : null);
$selected_tag = isset($_GET['tag']) ? $_GET['tag'] : null;

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
foreach ($all_posts as $post) {
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

<!-- Hero Section with Gradient -->
<section class="min-h-hero flex items-center gradient-green-blue px-4 py-16">
    <div class="max-w-7xl mx-auto">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                Small Wins, Big Ships: A Blog for Builders
            </h1>
            <p class="text-xl md:text-2xl mb-6 max-w-3xl mx-auto">
                Bite-sized insights that move your project forward. Because momentum beats perfection, every time.
            </p>

            <!-- Community Signals -->
            <div class="flex justify-center items-center gap-6 mb-8 text-sm opacity-95">
                <span class="flex items-center gap-2">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    Join 2,147 builders reading along
                </span>
                <span class="flex items-center gap-2">
                    <i data-lucide="book-open" class="w-4 h-4"></i>
                    4-minute reads on average
                </span>
            </div>

            <!-- Search Bar (Placeholder) -->
            <div class="max-w-xl mx-auto">
                <div class="relative">
                    <input type="text"
                           placeholder="What's your next small win?"
                           class="search-input w-full px-6 py-4 pr-12 rounded-full text-lg"
                           onclick="alert('Search coming soon! For now, explore by interest below.')">
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                        <i data-lucide="search" class="w-6 h-6 text-gray-400"></i>
                    </div>
                </div>
                <p class="text-sm mt-3 opacity-90">
                    ✨ Popular this week:
                    <?php
                    $popular_post = !empty($all_posts) ? $all_posts[0] : null;
                    if ($popular_post): ?>
                        <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($popular_post['slug']); ?>"
                           class="underline hover:no-underline">
                            <?php echo e($popular_post['title'] ?? 'Check back soon'); ?>
                        </a>
                    <?php else: ?>
                        Check back soon for new content
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Category Filter Bar -->
<?php if (!empty($all_categories)): ?>
<section class="blog-filter-section py-6 px-4 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto">
        <p class="text-center text-sm text-theme-secondary mb-4">📂 Browse by Category:</p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="<?php echo BASE_PATH; ?>/blog"
               class="px-5 py-2 rounded-full text-sm font-semibold transition-all
                      <?php echo !$selected_category
                          ? 'filter-tag-active'
                          : 'filter-tag'; ?>">
                All Categories
            </a>
            <?php
            // Category slug mapping
            $category_slugs = [
                'AI & Automation' => 'ai-automation',
                'Project Management' => 'project-management',
                'Productivity & Systems' => 'productivity',
                'Technical Leadership' => 'technical-leadership',
                'Business & Strategy' => 'business-strategy',
                'Learning & Development' => 'learning-development'
            ];

            foreach ($all_categories as $category):
                $category_slug = $category_slugs[$category] ?? create_slug($category);
                $category_count = count(get_blog_posts(null, ['category' => $category]));
            ?>
                <a href="<?php echo BASE_PATH; ?>/blog/category/<?php echo $category_slug; ?>"
                   class="px-5 py-2 rounded-full text-sm font-semibold transition-all
                          <?php echo $selected_category === $category
                              ? 'filter-tag-active'
                              : 'filter-tag'; ?>">
                    <?php echo e($category); ?> (<?php echo $category_count; ?>)
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Tag Filter Bar -->
<section class="blog-filter-section py-6 px-4">
    <div class="max-w-7xl mx-auto">
        <p class="text-center text-sm text-theme-secondary mb-4">🏷️ Filter by Tag:</p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="<?php echo BASE_PATH; ?>/blog<?php echo $selected_category ? '/category/' . $category_slugs[$selected_category] : ''; ?>"
               class="px-5 py-2 rounded-full text-sm font-semibold transition-all
                      <?php echo !$selected_tag
                          ? 'filter-tag-active'
                          : 'filter-tag'; ?>">
                All Tags <?php echo !$selected_tag ? '(' . $total_posts . ')' : ''; ?>
            </a>
            <?php foreach ($all_tags as $tag):
                $tag_count = count(array_filter($all_posts, function($post) use ($tag) {
                    return isset($post['tags']) && in_array($tag, $post['tags']);
                }));
            ?>
                <a href="<?php echo BASE_PATH; ?>/blog?tag=<?php echo urlencode($tag); ?><?php echo $selected_category ? '&category=' . urlencode($selected_category) : ''; ?>"
                   class="px-5 py-2 rounded-full text-sm font-semibold transition-all
                          <?php echo $selected_tag === $tag
                              ? 'filter-tag-active'
                              : 'filter-tag'; ?>">
                    <?php echo e($tag); ?> (<?php echo $tag_count; ?>)
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Main Blog Content -->
<section class="blog-content-section py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <?php if (empty($posts)): ?>
            <div class="text-center py-12">
                <i data-lucide="inbox" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                <p class="text-theme-secondary text-lg">
                    <?php echo $selected_tag ? 'No posts found with tag "' . e($selected_tag) . '".' : 'No blog posts yet. Check back soon!'; ?>
                </p>
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
                                <a href="<?php echo BASE_PATH; ?>/blog?page=<?php echo $page - 1; ?>"
                                   class="pagination-btn px-4 py-2 rounded-lg shadow">
                                    ← Previous
                                </a>
                            <?php endif; ?>

                            <div class="flex space-x-1">
                                <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                                    <a href="<?php echo BASE_PATH; ?>/blog?page=<?php echo $i; ?>"
                                       class="w-10 h-10 flex items-center justify-center rounded-lg transition-all
                                              <?php echo $i === $page
                                                  ? 'pagination-active'
                                                  : 'pagination-btn'; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                <?php endfor; ?>
                            </div>

                            <?php if ($page < $total_pages): ?>
                                <a href="<?php echo BASE_PATH; ?>/blog?page=<?php echo $page + 1; ?>"
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
                                <?php foreach (array_slice($all_posts, 0, 3) as $popular): ?>
                                    <li>
                                        <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($popular['slug']); ?>"
                                           class="sidebar-link text-sm">
                                            <?php echo e($popular['title'] ?? 'Untitled'); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Category Cloud -->
                        <div class="sidebar-widget p-6">
                            <h3 class="sidebar-title text-lg font-bold mb-4">Categories</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($all_tags as $tag): ?>
                                    <a href="<?php echo BASE_PATH; ?>/blog?tag=<?php echo urlencode($tag); ?>"
                                       class="filter-tag px-3 py-1 text-xs rounded-full">
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

