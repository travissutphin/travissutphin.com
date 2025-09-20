<article class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
    <div class="mb-4">
        <time class="text-sm text-gray-dark"><?php echo e($date ?? ''); ?></time>
    </div>
    <h3 class="text-xl font-bold text-dark-green mb-2">
        <a href="<?php echo BASE_PATH; ?>/blog/<?php echo e($slug ?? ''); ?>" class="hover:text-primary-green transition-colors">
            <?php echo e($title ?? ''); ?>
        </a>
    </h3>
    <p class="text-gray-dark mb-4">
        <?php echo e($excerpt ?? ''); ?>
    </p>
    <?php if (!empty($tags)): ?>
        <div class="flex flex-wrap gap-2">
            <?php foreach ($tags as $tag): ?>
                <span class="px-2 py-1 text-xs bg-light-blue text-primary-blue rounded">
                    <?php echo e($tag); ?>
                </span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</article>