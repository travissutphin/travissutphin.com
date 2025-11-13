<?php
// Case study card partial
// Expected variable: $case_study (array)

$cs = $case_study ?? [];
$cs_slug = $cs['slug'] ?? '';
$cs_title = $cs['title'] ?? 'Untitled Case Study';
$cs_excerpt = $cs['excerpt'] ?? '';
$cs_image = $cs['image'] ?? '';
$cs_industry = $cs['industry'] ?? '';
$cs_client = $cs['client'] ?? '';
$cs_date = $cs['date'] ?? '';
$cs_services = $cs['services'] ?? [];
$cs_results = $cs['results'] ?? [];

// Get first result for preview
$first_result = !empty($cs_results) ? $cs_results[0] : null;
?>

<article class="blog-post-card h-full flex flex-col group">
    <!-- Case Study Image/Thumbnail -->
    <a href="<?php echo BASE_PATH; ?>/case-studies/<?php echo e($cs_slug); ?>"
       class="blog-thumbnail h-48 overflow-hidden block relative">
        <?php if (!empty($cs_image)): ?>
            <?php
            // Generate WebP path from PNG path
            $image_path = BASE_PATH . trim(trim($cs_image), '"');
            $image_path_webp = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $image_path);
            ?>
            <picture>
                <source type="image/webp" srcset="<?php echo $image_path_webp; ?>">
                <img src="<?php echo $image_path; ?>"
                     alt="<?php echo htmlspecialchars($cs_title); ?>"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                     loading="lazy">
            </picture>
        <?php else: ?>
            <div class="bg-gradient-to-br from-primary-green to-primary-blue h-full flex items-center justify-center">
                <i data-lucide="bar-chart-3" class="w-16 h-16 text-white opacity-50"></i>
            </div>
        <?php endif; ?>

        <!-- Case Study Badge Overlay -->
        <div class="absolute top-3 left-3">
            <span class="px-2 py-1 bg-white/90 backdrop-blur text-primary-blue text-xs font-bold rounded">
                📊 CASE STUDY
            </span>
        </div>
    </a>

    <div class="p-6 flex-grow flex flex-col">
        <!-- Industry & Date -->
        <div class="flex items-center gap-3 mb-3 text-sm">
            <?php if (!empty($cs_industry)): ?>
                <span class="px-2 py-1 bg-light-blue text-primary-blue font-semibold rounded flex items-center gap-1">
                    <i data-lucide="building" class="w-3 h-3"></i>
                    <?php echo e($cs_industry); ?>
                </span>
            <?php endif; ?>
            <?php if (!empty($cs_date)): ?>
                <span class="text-theme-primary dark:text-white">
                    <?php echo date('M Y', strtotime($cs_date)); ?>
                </span>
            <?php endif; ?>
        </div>

        <!-- Title -->
        <h3 class="blog-title text-lg font-bold mb-2 line-clamp-2 hover:text-primary-blue transition-colors">
            <a href="<?php echo BASE_PATH; ?>/case-studies/<?php echo e($cs_slug); ?>">
                <?php echo e($cs_title); ?>
            </a>
        </h3>

        <!-- Excerpt -->
        <p class="blog-excerpt text-sm mb-4 line-clamp-3 flex-grow">
            <?php echo e($cs_excerpt); ?>
        </p>

        <!-- Key Result Highlight (if available) -->
        <?php if ($first_result): ?>
        <div class="bg-light-bg dark:bg-gray-800 rounded-lg p-3 mb-4">
            <div class="text-xs text-theme-secondary mb-1">
                <?php echo e($first_result['metric'] ?? ''); ?>
            </div>
            <div class="text-primary-green font-bold text-lg">
                <?php echo e($first_result['improvement'] ?? ''); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Services Tags -->
        <?php if (!empty($cs_services) && is_array($cs_services)): ?>
        <div class="flex flex-wrap gap-1 mb-4">
            <?php foreach (array_slice($cs_services, 0, 2) as $service): ?>
                <span class="text-xs px-2 py-1 bg-light-bg dark:bg-gray-800 text-theme-secondary rounded">
                    <?php echo e($service); ?>
                </span>
            <?php endforeach; ?>
            <?php if (count($cs_services) > 2): ?>
                <span class="text-xs px-2 py-1 bg-light-bg dark:bg-gray-800 text-theme-secondary rounded">
                    +<?php echo count($cs_services) - 2; ?>
                </span>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Read More Button -->
        <div class="mt-auto">
            <a href="<?php echo BASE_PATH; ?>/case-studies/<?php echo e($cs_slug); ?>"
               class="inline-block px-4 py-2 bg-gradient-to-r from-primary-green to-primary-blue text-white text-sm rounded-lg font-semibold hover:shadow-lg transition-all">
                Read Case Study →
            </a>
        </div>
    </div>
</article>
