<div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
    <div class="flex items-center mb-4">
        <div class="w-12 h-12 bg-gradient-to-br from-primary-green to-primary-blue rounded-lg flex items-center justify-center mr-3">
            <i data-lucide="<?php echo e($icon ?? 'code'); ?>" class="w-6 h-6 text-white"></i>
        </div>
        <h3 class="text-xl font-bold text-dark-green"><?php echo e($title ?? ''); ?></h3>
    </div>
    <p class="text-gray-dark mb-4">
        <?php echo e($description ?? ''); ?>
    </p>
    <?php if (!empty($features)): ?>
        <ul class="space-y-2">
            <?php foreach ($features as $feature): ?>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-primary-green mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-dark"><?php echo e($feature); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>