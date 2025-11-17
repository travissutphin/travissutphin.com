# Free Template Backlink Components
**Version**: 1.0
**Date**: November 16, 2025
**Strategy**: Option 2 (Sticky Banner + Footer Attribution)

---

## Component 1: CSS Styles

Add this CSS to the `<style>` section of the template (before closing `</style>`):

```css
/* ==================== TEMPLATE CREDIT BANNER ==================== */
.template-credit-banner {
    position: sticky;
    top: 0;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(10px);
    padding: 12px 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    animation: slideDown 0.3s ease-in-out;
}

.template-credit-banner .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.template-credit-banner p {
    margin: 0;
    font-size: 14px;
    color: #ffffff;
    line-height: 1.5;
}

.template-credit-banner strong {
    font-weight: 600;
}

.template-credit-banner a {
    color: #3b82f6;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s ease;
}

.template-credit-banner a:hover {
    color: #2563eb;
    text-decoration: underline;
}

.btn-close-banner {
    background: transparent;
    border: none;
    color: #ffffff;
    font-size: 24px;
    line-height: 1;
    cursor: pointer;
    padding: 0;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    transition: background 0.2s ease;
    flex-shrink: 0;
}

.btn-close-banner:hover {
    background: rgba(255, 255, 255, 0.1);
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .template-credit-banner p {
        font-size: 12px;
    }

    .template-credit-banner .container {
        padding: 0 15px;
    }
}
```

---

## Component 2: Sticky Banner HTML

Add this immediately after the `<body>` tag:

```html
<!-- Template Credit Banner -->
<div class="template-credit-banner" id="templateBanner">
    <div class="container">
        <p>
            <strong>🎨 Like this template?</strong>
            See more free templates + premium projects by
            <a href="https://travissutphin.com/projects" target="_blank" rel="noopener">Travis Sutphin</a>
        </p>
        <button class="btn-close-banner" onclick="closeBanner()" aria-label="Close banner">×</button>
    </div>
</div>
```

---

## Component 3: Footer Attribution HTML

Add this as a new column in the footer (adjust grid classes as needed for template):

```html
<div class="col-lg-3 col-md-6">
    <h5 class="footer-title">About This Template</h5>
    <p class="footer-description">
        Free template by <strong>Travis Sutphin</strong>
    </p>
    <a href="https://travissutphin.com/projects"
       target="_blank"
       rel="noopener"
       class="footer-backlink"
       style="color: inherit; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; margin-top: 8px; transition: opacity 0.2s ease;">
        <span>View More Templates & Projects</span>
        <span style="font-size: 1.2em;">→</span>
    </a>
</div>
```

---

## Component 4: JavaScript for Banner Dismiss

Add this JavaScript before the closing `</body>` tag:

```javascript
<!-- Template Banner Functionality -->
<script>
    // Check if banner was previously dismissed
    (function() {
        const bannerDismissed = localStorage.getItem('templateBannerDismissed');
        const dismissTime = localStorage.getItem('templateBannerDismissTime');

        // Show banner if not dismissed or if 30 days have passed
        if (bannerDismissed && dismissTime) {
            const daysSinceDismiss = (Date.now() - parseInt(dismissTime)) / (1000 * 60 * 60 * 24);
            if (daysSinceDismiss > 30) {
                localStorage.removeItem('templateBannerDismissed');
                localStorage.removeItem('templateBannerDismissTime');
            } else {
                document.getElementById('templateBanner').style.display = 'none';
            }
        }
    })();

    // Close banner function
    function closeBanner() {
        const banner = document.getElementById('templateBanner');
        banner.style.animation = 'slideUp 0.2s ease-in-out';

        setTimeout(function() {
            banner.style.display = 'none';
            localStorage.setItem('templateBannerDismissed', 'true');
            localStorage.setItem('templateBannerDismissTime', Date.now().toString());
        }, 200);
    }

    // Add slide up animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideUp {
            from {
                transform: translateY(0);
                opacity: 1;
            }
            to {
                transform: translateY(-100%);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
```

---

## Analytics Tracking (Optional)

Add event tracking for backlink clicks:

```javascript
// Track banner clicks
document.querySelector('.template-credit-banner a')?.addEventListener('click', function() {
    // Google Analytics 4
    if (typeof gtag !== 'undefined') {
        gtag('event', 'template_backlink_click', {
            'template_name': 'TEMPLATE_NAME_HERE',
            'link_location': 'sticky_banner'
        });
    }
});

// Track footer clicks
document.querySelector('.footer-backlink')?.addEventListener('click', function() {
    if (typeof gtag !== 'undefined') {
        gtag('event', 'template_backlink_click', {
            'template_name': 'TEMPLATE_NAME_HERE',
            'link_location': 'footer'
        });
    }
});
```

---

## Implementation Checklist

For each template:
- [ ] Add CSS styles to `<style>` section
- [ ] Add sticky banner HTML after `<body>` tag
- [ ] Add footer attribution column to footer
- [ ] Add JavaScript for banner dismiss functionality
- [ ] Test banner dismiss functionality
- [ ] Test on mobile devices
- [ ] Verify links point to correct URLs
- [ ] Test localStorage persists across page refreshes

---

## Notes

- Banner uses `localStorage` to remember dismiss state for 30 days
- Links use `target="_blank"` and `rel="noopener"` for security
- Responsive design works on all screen sizes
- Animation is smooth and non-intrusive
- Footer styling inherits from template's existing footer styles
