<?php
// Pagination setup
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$all_posts = get_blog_posts();
$total_posts = count($all_posts);
$posts_per_page = POSTS_PER_PAGE;
$total_pages = ceil($total_posts / $posts_per_page);
$offset = ($page - 1) * $posts_per_page;

// Get posts for current page
$posts = array_slice($all_posts, $offset, $posts_per_page);

// Get all unique tags from posts
$all_tags = [];
foreach ($all_posts as $post) {
    if (isset($post['tags']) && is_array($post['tags'])) {
        $all_tags = array_merge($all_tags, $post['tags']);
    }
}
$all_tags = array_unique($all_tags);
sort($all_tags);

// Filter by tag if specified
$selected_tag = isset($_GET['tag']) ? $_GET['tag'] : null;
if ($selected_tag) {
    $posts = array_filter($all_posts, function($post) use ($selected_tag) {
        return isset($post['tags']) && in_array($selected_tag, $post['tags']);
    });
    $posts = array_slice($posts, $offset, $posts_per_page);
}

// Get featured post (newest post)
$featured_post = !empty($all_posts) ? $all_posts[0] : null;
$regular_posts = $selected_tag ? $posts : array_slice($posts, 1); // Skip featured if not filtering

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
                           class="w-full px-6 py-4 pr-12 rounded-full text-dark-green text-lg"
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
<section class="py-8 px-4 bg-white border-b">
    <div class="max-w-7xl mx-auto">
        <p class="text-center text-sm text-gray-dark mb-4">Explore by interest:</p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="<?php echo BASE_PATH; ?>/blog"
               class="px-5 py-2 rounded-full text-sm font-semibold transition-all
                      <?php echo !$selected_tag
                          ? 'bg-gradient-to-r from-primary-green to-primary-blue text-white shadow-md'
                          : 'bg-gray-100 text-gray-dark hover:bg-gray-200'; ?>">
                All Topics <?php echo !$selected_tag ? '(' . $total_posts . ')' : ''; ?>
            </a>
            <?php foreach ($all_tags as $tag):
                $tag_count = count(array_filter($all_posts, function($post) use ($tag) {
                    return isset($post['tags']) && in_array($tag, $post['tags']);
                }));
            ?>
                <a href="<?php echo BASE_PATH; ?>/blog?tag=<?php echo urlencode($tag); ?>"
                   class="px-5 py-2 rounded-full text-sm font-semibold transition-all
                          <?php echo $selected_tag === $tag
                              ? 'bg-gradient-to-r from-primary-green to-primary-blue text-white shadow-md'
                              : 'bg-gray-100 text-gray-dark hover:bg-gray-200'; ?>">
                    <?php echo e($tag); ?> (<?php echo $tag_count; ?>)
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Main Blog Content -->
<section class="py-16 px-4 bg-gray-light">
    <div class="max-w-7xl mx-auto">
        <?php if (empty($posts)): ?>
            <div class="text-center py-12">
                <i data-lucide="inbox" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                <p class="text-gray-dark text-lg">
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
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-[1.02] transition-transform card-hover">
                                <!-- Featured Badge -->
                                <div class="bg-gradient-to-r from-primary-green to-primary-blue text-white text-center py-2 text-sm font-semibold">
                                    ♥ READER FAVORITE
                                </div>

                                <div class="p-8">
                                    <!-- Thumbnail Placeholder -->
                                    <div class="bg-gradient-to-br from-primary-green to-primary-blue h-64 rounded-lg mb-6 flex items-center justify-center">
                                        <i data-lucide="file-text" class="w-20 h-20 text-white opacity-50"></i>
                                    </div>

                                    <!-- Category & Date -->
                                    <div class="flex items-center gap-4 mb-4">
                                        <?php if (!empty($featured_post['tags'])): ?>
                                            <span class="px-3 py-1 bg-light-blue text-primary-blue text-xs font-semibold rounded-full">
                                                <?php echo e($featured_post['tags'][0]); ?>
                                            </span>
                                        <?php endif; ?>
                                        <span class="text-sm text-gray-dark">
                                            <?php echo date('M d, Y', strtotime($featured_post['date'] ?? 'now')); ?>
                                        </span>
                                        <span class="text-sm text-gray-dark">
                                            <?php
                                            $reading_time = isset($featured_post['readingTime'])
                                                ? intval($featured_post['readingTime'])
                                                : calculate_reading_time($featured_post['content'] ?? '');
                                            echo $reading_time . ' min read';
                                            ?>
                                        </span>
                                    </div>

                                    <!-- Title & Excerpt -->
                                    <h2 class="text-2xl font-bold text-dark-green mb-3 hover:text-primary-blue transition-colors">
                                        <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($featured_post['slug']); ?>">
                                            <?php echo e($featured_post['title'] ?? 'Untitled'); ?>
                                        </a>
                                    </h2>
                                    <p class="text-gray-dark mb-6 line-clamp-3">
                                        <?php echo e($featured_post['excerpt'] ?? ''); ?>
                                    </p>

                                    <!-- Author & CTA -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center">
                                                <span class="text-white font-semibold">TS</span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-dark-green">Travis Sutphin</p>
                                                <p class="text-xs text-gray-dark">Fractional CTO</p>
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
                            <div class="animate-on-scroll">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow card-hover h-full flex flex-col">
                                    <!-- Thumbnail -->
                                    <div class="bg-gradient-to-br from-gray-200 to-gray-300 h-48 flex items-center justify-center">
                                        <i data-lucide="file-text" class="w-12 h-12 text-gray-400"></i>
                                    </div>

                                    <div class="p-6 flex-grow flex flex-col">
                                        <!-- Category & Meta -->
                                        <div class="flex items-center gap-3 mb-3 text-xs">
                                            <?php if (!empty($post['tags'])): ?>
                                                <span class="px-2 py-1 bg-light-blue text-primary-blue font-semibold rounded">
                                                    <?php echo e($post['tags'][0]); ?>
                                                </span>
                                            <?php endif; ?>
                                            <span class="text-gray-dark">
                                                <?php echo date('M d', strtotime($post['date'] ?? 'now')); ?>
                                            </span>
                                            <span class="text-gray-dark">
                                                <?php
                                                $reading_time = isset($post['readingTime'])
                                                    ? intval($post['readingTime'])
                                                    : calculate_reading_time($post['content'] ?? '');
                                                echo $reading_time . ' min';
                                                ?>
                                            </span>
                                        </div>

                                        <!-- Title -->
                                        <h3 class="text-lg font-bold text-dark-green mb-2 line-clamp-2 hover:text-primary-blue transition-colors">
                                            <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($post['slug']); ?>">
                                                <?php echo e($post['title'] ?? 'Untitled'); ?>
                                            </a>
                                        </h3>

                                        <!-- Excerpt -->
                                        <p class="text-sm text-gray-dark mb-4 line-clamp-3 flex-grow">
                                            <?php echo e($post['excerpt'] ?? ''); ?>
                                        </p>

                                        <!-- Author -->
                                        <div class="flex items-center gap-2 mt-auto">
                                            <div class="w-8 h-8 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center">
                                                <span class="text-white text-xs font-semibold">TS</span>
                                            </div>
                                            <span class="text-xs text-gray-dark">Travis Sutphin</span>
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
                                   class="px-4 py-2 bg-white text-gray-dark rounded-lg hover:bg-gray-100 transition-colors shadow">
                                    ← Previous
                                </a>
                            <?php endif; ?>

                            <div class="flex space-x-1">
                                <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                                    <a href="<?php echo BASE_PATH; ?>/blog?page=<?php echo $i; ?>"
                                       class="w-10 h-10 flex items-center justify-center rounded-lg transition-all
                                              <?php echo $i === $page
                                                  ? 'bg-gradient-to-r from-primary-green to-primary-blue text-white'
                                                  : 'bg-white text-gray-dark hover:bg-gray-100'; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                <?php endfor; ?>
                            </div>

                            <?php if ($page < $total_pages): ?>
                                <a href="<?php echo BASE_PATH; ?>/blog?page=<?php echo $page + 1; ?>"
                                   class="px-4 py-2 bg-white text-gray-dark rounded-lg hover:bg-gray-100 transition-colors shadow">
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
                        <div class="bg-gradient-to-br from-primary-green to-primary-blue text-white rounded-lg p-6">
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
                        <div class="bg-white rounded-lg p-6 shadow-md">
                            <h3 class="text-lg font-bold text-dark-green mb-4">Popular Posts</h3>
                            <ul class="space-y-3">
                                <?php foreach (array_slice($all_posts, 0, 3) as $popular): ?>
                                    <li>
                                        <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($popular['slug']); ?>"
                                           class="text-sm text-gray-dark hover:text-primary-blue transition-colors">
                                            <?php echo e($popular['title'] ?? 'Untitled'); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Category Cloud -->
                        <div class="bg-white rounded-lg p-6 shadow-md">
                            <h3 class="text-lg font-bold text-dark-green mb-4">Categories</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($all_tags as $tag): ?>
                                    <a href="<?php echo BASE_PATH; ?>/blog?tag=<?php echo urlencode($tag); ?>"
                                       class="px-3 py-1 bg-gray-100 text-gray-dark text-xs rounded-full hover:bg-gray-200 transition-colors">
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
            <div class="bg-white/10 backdrop-blur rounded-lg p-8">
                <input type="email"
                       placeholder="Your best email..."
                       class="w-full px-4 py-3 rounded-lg text-dark-green mb-4"
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

<!-- Bottom CTA (Mobile) -->
<div class="lg:hidden fixed bottom-16 left-0 right-0 p-4 bg-white shadow-lg border-t z-40">
    <a href="<?php echo BASE_PATH; ?>/contact"
       class="block w-full text-center bg-gradient-to-r from-primary-green to-primary-blue text-white py-3 rounded-lg font-semibold">
        Got Questions? Let's Talk →
    </a>
</div>