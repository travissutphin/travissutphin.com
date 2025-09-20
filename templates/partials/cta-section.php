<section class="bg-gradient-to-r from-primary-green to-primary-blue py-16 px-4 rounded-lg">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            <?php echo e($headline ?? 'Ready to Get Started?'); ?>
        </h2>
        <p class="text-xl text-white mb-8">
            <?php echo e($subheadline ?? 'Let\'s transform your vision into reality.'); ?>
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <?php if (!empty($buttons)): ?>
                <?php foreach ($buttons as $button): ?>
                    <a href="<?php echo e($button['url'] ?? '#'); ?>"
                       class="<?php echo $button['primary'] ?? false ?
                              'bg-white text-dark-green hover:bg-gray-100' :
                              'bg-transparent border-2 border-white text-white hover:bg-white hover:text-dark-green'; ?>
                              px-6 py-3 rounded-lg font-semibold transition-colors">
                        <?php echo e($button['text'] ?? 'Learn More'); ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <a href="<?php echo BASE_PATH; ?>/contact" class="bg-white text-dark-green hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold transition-colors">
                    Get Started
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>