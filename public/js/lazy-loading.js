/**
 * Lazy Loading Implementation with Intersection Observer Fallback
 * Simple, efficient, robust implementation following Core Principles
 */

(function() {
    'use strict';

    // Check for native lazy loading support
    if ('loading' in HTMLImageElement.prototype) {
        // Native lazy loading is supported, no additional JS needed
        return;
    }

    // Fallback: Intersection Observer for older browsers
    const images = document.querySelectorAll('img[loading="lazy"]');

    if (!images.length) {
        return;
    }

    // Check for Intersection Observer support
    if (!('IntersectionObserver' in window)) {
        // Load all images immediately for very old browsers
        images.forEach(img => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            }
        });
        return;
    }

    // Intersection Observer implementation
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;

                // Image is already loaded with src attribute
                // Just add loaded class for any styling if needed
                img.classList.add('lazy-loaded');

                // Stop observing this image
                observer.unobserve(img);
            }
        });
    }, {
        // Start loading when image is 50px away from viewport
        rootMargin: '50px 0px',
        threshold: 0.01
    });

    // Start observing all lazy images
    images.forEach(img => {
        imageObserver.observe(img);
    });
})();