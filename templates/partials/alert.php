<?php
$alert_type = $type ?? 'info';
$alert_classes = [
    'success' => 'bg-green-100 border-green-400 text-green-700',
    'error' => 'bg-red-100 border-red-400 text-red-700',
    'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
    'info' => 'bg-blue-100 border-blue-400 text-blue-700'
];
$class = $alert_classes[$alert_type] ?? $alert_classes['info'];
?>

<div class="border-l-4 p-4 <?php echo $class; ?> mb-4" role="alert">
    <p class="font-bold"><?php echo e($title ?? ucfirst($alert_type)); ?></p>
    <p><?php echo e($message ?? ''); ?></p>
</div>