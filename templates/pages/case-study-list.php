<?php
// Check for industry or service filtering
$selected_industry = isset($_GET['industry']) ? $_GET['industry'] : null;
$selected_service = isset($_GET['service']) ? $_GET['service'] : null;

// Build filters array
$filters = [];
if ($selected_industry) {
    $filters['industry'] = $selected_industry;
}
if ($selected_service) {
    $filters['service'] = $selected_service;
}

// Get case studies with filtering applied
$all_case_studies = get_case_studies(null, $filters);
$case_studies = $all_case_studies; // No pagination for now, can add later

// Get all industries and services for filters
$all_industries = get_all_industries();
$all_services = get_all_services();

// Get featured case study (newest)
$featured_case_study = !empty($case_studies) ? $case_studies[0] : null;
$regular_case_studies = !empty($case_studies) ? array_slice($case_studies, 1) : [];
?>

<!-- Hero Section -->
<section class="min-h-[60vh] flex items-center gradient-green-blue px-4 py-12">
    <div class="max-w-7xl mx-auto w-full">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-3">
                Real Results, Real Businesses
            </h1>
            <p class="text-lg md:text-xl mb-6 max-w-2xl mx-auto">
                See how we've helped companies transform their projects from stuck to shipped
            </p>

            <!-- Filter Bar -->
            <div class="max-w-4xl mx-auto bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-4">
                <div class="flex flex-col md:flex-row gap-3 items-stretch md:items-center">
                    <!-- Industry Dropdown -->
                    <div class="flex-1">
                        <div class="relative">
                            <select id="industryFilter"
                                    class="w-full px-4 py-3 pr-10 rounded-lg bg-white dark:bg-gray-800 text-gray-800 dark:text-white font-medium appearance-none cursor-pointer
                                           focus:outline-none focus:ring-2 focus:ring-primary-green transition-all"
                                    onchange="window.location.href = this.value">
                                <option value="<?php echo BASE_PATH; ?>/case-studies" <?php echo !$selected_industry ? 'selected' : ''; ?>>
                                    🏢 All Industries (<?php echo count(get_case_studies()); ?>)
                                </option>
                                <?php foreach ($all_industries as $industry):
                                    $industry_count = count(get_case_studies(null, ['industry' => $industry]));
                                ?>
                                    <option value="<?php echo BASE_PATH; ?>/case-studies?industry=<?php echo urlencode($industry); ?>"
                                            <?php echo $selected_industry === $industry ? 'selected' : ''; ?>>
                                        <?php echo e($industry); ?> (<?php echo $industry_count; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i data-lucide="chevron-down" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Service Dropdown -->
                    <div class="flex-1">
                        <div class="relative">
                            <select id="serviceFilter"
                                    class="w-full px-4 py-3 pr-10 rounded-lg bg-white dark:bg-gray-800 text-gray-800 dark:text-white font-medium appearance-none cursor-pointer
                                           focus:outline-none focus:ring-2 focus:ring-primary-green transition-all"
                                    onchange="window.location.href = this.value">
                                <option value="<?php echo BASE_PATH; ?>/case-studies" <?php echo !$selected_service ? 'selected' : ''; ?>>
                                    🛠️ All Services
                                </option>
                                <?php foreach ($all_services as $service):
                                    $service_count = count(get_case_studies(null, ['service' => $service]));
                                ?>
                                    <option value="<?php echo BASE_PATH; ?>/case-studies?service=<?php echo urlencode($service); ?>"
                                            <?php echo $selected_service === $service ? 'selected' : ''; ?>>
                                        <?php echo e($service); ?> (<?php echo $service_count; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i data-lucide="chevron-down" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Clear Filters Button (shown when filters active) -->
                    <?php if ($selected_industry || $selected_service): ?>
                        <a href="<?php echo BASE_PATH; ?>/case-studies"
                           class="flex-none px-6 py-3 bg-white/20 hover:bg-white/30 text-white rounded-lg font-semibold
                                  transition-all flex items-center gap-2 justify-center">
                            <i data-lucide="x" class="w-4 h-4"></i>
                            Clear
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Active Filter Display -->
                <?php if ($selected_industry || $selected_service): ?>
                    <div class="mt-3 flex flex-wrap items-center gap-2 text-sm">
                        <span class="text-white/80">Showing:</span>
                        <?php if ($selected_industry): ?>
                            <span class="px-3 py-1 bg-white/20 text-white rounded-full flex items-center gap-1">
                                🏢 <?php echo e($selected_industry); ?>
                                <a href="<?php echo BASE_PATH; ?>/case-studies<?php echo $selected_service ? '?service=' . urlencode($selected_service) : ''; ?>"
                                   class="ml-1 hover:text-red-300">×</a>
                            </span>
                        <?php endif; ?>
                        <?php if ($selected_service): ?>
                            <span class="px-3 py-1 bg-white/20 text-white rounded-full flex items-center gap-1">
                                🛠️ <?php echo e($selected_service); ?>
                                <a href="<?php echo BASE_PATH; ?>/case-studies<?php echo $selected_industry ? '?industry=' . urlencode($selected_industry) : ''; ?>"
                                   class="ml-1 hover:text-red-300">×</a>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Results Count -->
                <div class="mt-3 text-center text-white/90 text-sm">
                    <i data-lucide="file-text" class="w-4 h-4 inline"></i>
                    Found <strong><?php echo count($case_studies); ?></strong> case <?php echo count($case_studies) !== 1 ? 'studies' : 'study'; ?>
                </div>
            </div>

            <!-- Stats -->
            <div class="flex justify-center items-center gap-6 text-sm opacity-90">
                <span class="flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    <?php echo count(get_case_studies()); ?>+ Success Stories
                </span>
                <span class="flex items-center gap-2">
                    <i data-lucide="trending-up" class="w-4 h-4"></i>
                    Proven Results
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Main Case Studies Content -->
<section class="blog-content-section py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <?php if (empty($case_studies)): ?>
            <div class="text-center py-12">
                <i data-lucide="inbox" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                <p class="text-theme-secondary text-lg mb-4">
                    <?php if ($selected_industry): ?>
                        No case studies found for <?php echo e($selected_industry); ?> industry.
                    <?php elseif ($selected_service): ?>
                        No case studies found for <?php echo e($selected_service); ?> service.
                    <?php else: ?>
                        No case studies available yet. Check back soon!
                    <?php endif; ?>
                </p>
                <a href="<?php echo BASE_PATH; ?>/case-studies"
                   class="inline-block px-6 py-3 bg-gradient-to-r from-primary-green to-primary-blue text-white rounded-lg font-semibold hover:shadow-lg transition-all">
                    ← View All Case Studies
                </a>
            </div>
        <?php else: ?>
            <?php if ($featured_case_study && !$selected_industry && !$selected_service): ?>
                <!-- Featured Case Study Card -->
                <div class="mb-12">
                    <div class="featured-post-card">
                        <!-- Featured Badge -->
                        <div class="featured-badge text-white text-center py-2 text-sm font-semibold">
                            ⭐ FEATURED CASE STUDY
                        </div>

                        <div class="p-8">
                            <!-- Featured Case Study Image -->
                            <a href="<?php echo BASE_PATH; ?>/case-studies/<?php echo e($featured_case_study['slug']); ?>"
                               class="blog-thumbnail h-64 md:h-96 rounded-lg mb-6 overflow-hidden shadow-2xl block">
                                <?php if (!empty($featured_case_study['image'])): ?>
                                    <?php
                                    $image_path = BASE_PATH . trim(trim($featured_case_study['image']), '"');
                                    $image_path_webp = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $image_path);
                                    ?>
                                    <picture>
                                        <source type="image/webp" srcset="<?php echo $image_path_webp; ?>">
                                        <img src="<?php echo $image_path; ?>"
                                             alt="<?php echo htmlspecialchars($featured_case_study['title'] ?? 'Case Study'); ?>"
                                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                             loading="lazy">
                                    </picture>
                                <?php else: ?>
                                    <div class="bg-gradient-to-br from-primary-green to-primary-blue h-full flex items-center justify-center">
                                        <i data-lucide="bar-chart-3" class="w-20 h-20 text-white opacity-50"></i>
                                    </div>
                                <?php endif; ?>
                            </a>

                            <!-- Industry & Date -->
                            <div class="flex items-center gap-4 mb-4">
                                <?php if (!empty($featured_case_study['industry'])): ?>
                                    <span class="px-3 py-1 bg-light-blue text-primary-blue text-xs font-semibold rounded-full">
                                        <?php echo e($featured_case_study['industry']); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if (!empty($featured_case_study['date'])): ?>
                                    <span class="text-sm text-theme-primary dark:text-white">
                                        <?php echo date('M d, Y', strtotime($featured_case_study['date'])); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Title & Excerpt -->
                            <h2 class="blog-title text-2xl font-bold mb-3 hover:text-primary-blue transition-colors">
                                <a href="<?php echo BASE_PATH; ?>/case-studies/<?php echo e($featured_case_study['slug']); ?>">
                                    <?php echo e($featured_case_study['title'] ?? 'Untitled'); ?>
                                </a>
                            </h2>
                            <p class="blog-excerpt mb-6 line-clamp-3">
                                <?php echo e($featured_case_study['excerpt'] ?? ''); ?>
                            </p>

                            <!-- Key Results (if available) -->
                            <?php if (!empty($featured_case_study['results']) && is_array($featured_case_study['results'])): ?>
                            <div class="grid grid-cols-3 gap-4 mb-6 p-4 bg-light-bg dark:bg-gray-800 rounded-lg">
                                <?php foreach (array_slice($featured_case_study['results'], 0, 3) as $result): ?>
                                <div class="text-center">
                                    <div class="text-primary-green font-bold text-xl">
                                        <?php echo e($result['improvement'] ?? ''); ?>
                                    </div>
                                    <div class="text-xs text-theme-secondary mt-1">
                                        <?php echo e($result['metric'] ?? ''); ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>

                            <!-- CTA -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-primary-green to-primary-blue rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold">TS</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-theme-primary">Travis Sutphin</p>
                                        <p class="text-xs text-theme-secondary">Fractional CTO</p>
                                    </div>
                                </div>
                                <a href="<?php echo BASE_PATH; ?>/case-studies/<?php echo e($featured_case_study['slug']); ?>"
                                   class="px-4 py-2 bg-gradient-to-r from-primary-green to-primary-blue text-white rounded-lg font-semibold hover:shadow-lg transition-all">
                                    Read Full Story →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Regular Case Studies Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                <?php
                $studies_to_show = ($featured_case_study && !$selected_industry && !$selected_service) ? $regular_case_studies : $case_studies;
                foreach ($studies_to_show as $case_study):
                    render_partial('case-study-card', ['case_study' => $case_study]);
                endforeach;
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 px-4 gradient-green-blue">
    <div class="max-w-4xl mx-auto text-center text-white">
        <h2 class="text-3xl font-bold mb-4">Ready to Be Our Next Success Story?</h2>
        <p class="text-xl mb-8 opacity-95">
            Let's talk about how we can help you overcome your project challenges and ship faster.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo BASE_PATH; ?>/contact"
               class="inline-block bg-white text-dark-green px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Schedule a Consultation →
            </a>
            <a href="<?php echo BASE_PATH; ?>/services"
               class="inline-block bg-white/20 backdrop-blur text-white px-8 py-3 rounded-lg font-semibold hover:bg-white/30 transition-colors">
                View Services
            </a>
        </div>
    </div>
</section>

<!-- CollectionPage Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "Case Studies",
    "description": "Real-world success stories showing how we help companies transform stuck projects into shipped products",
    "url": "<?php echo SITE_URL; ?>/case-studies",
    "mainEntity": {
        "@type": "ItemList",
        "itemListElement": [
            <?php foreach (array_slice($case_studies, 0, 10) as $index => $cs): ?>
            {
                "@type": "Article",
                "position": <?php echo $index + 1; ?>,
                "name": "<?php echo str_replace('"', '\"', $cs['title'] ?? ''); ?>",
                "url": "<?php echo SITE_URL; ?>/case-studies/<?php echo $cs['slug'] ?? ''; ?>",
                "description": "<?php echo str_replace('"', '\"', $cs['excerpt'] ?? ''); ?>",
                "datePublished": "<?php echo $cs['date'] ?? date('Y-m-d'); ?>"
            }<?php echo $index < min(count($case_studies), 10) - 1 ? ',' : ''; ?>
            <?php endforeach; ?>
        ]
    }
}
</script>
