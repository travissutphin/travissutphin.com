# How to Add New Free HTML Templates

**Process Owner:** [Travis]
**Support Team:** [Syntax], [Bran], [Echo]
**Last Updated:** 2025-12-04
**Version:** 1.2

---

## Overview

This guide walks you through adding new free HTML templates to the `/projects` page. The system is designed for **staggered releases** to maximize SEO impact—each template launch gets its own moment for indexing and backlinks.

---

## Quick Start Checklist

- [ ] Template files ready (HTML, CSS, JS, images)
- [ ] **Credit banner added** to template HTML (required)
- [ ] Preview screenshot created (1200px wide, ~630px height)
- [ ] **Preview image converted to WebP** (target: <50KB)
- [ ] Template tested locally
- [ ] Template description written (2-3 sentences)
- [ ] .zip file created
- [ ] JSON metadata updated (**newest template first**)
- [ ] Sitemap updated (if adding template preview URLs)
- [ ] Live page tested

---

## Step-by-Step Process

### **Step 1: Prepare Your Template Files**

**Directory Structure:**
```
/public/templates-free/{framework}/{template-slug}/
├── index.html          # Main template file (with credit banner)
├── preview.webp        # Screenshot in WebP format (optimized)
├── preview.png         # Original screenshot (keep for reference)
├── {template-slug}.zip # Downloadable package
└── README.md           # Optional: Usage instructions
```

**Example:**
```
/public/templates-free/bootstrap/landing-page-modern/
├── index.html
├── preview.webp        # Optimized (target: <50KB)
├── preview.png         # Original
├── landing-page-modern.zip
└── README.md
```

**Framework Options:**
- `bootstrap` - For Bootstrap 5.x templates
- `tailwind` - For Tailwind CSS templates

---

### **Step 2: Add Credit Banner to Template HTML (Required)**

Every template MUST include a sticky credit banner at the top. This drives traffic back to travissutphin.com/projects.

**Banner CSS (add to `<style>` section before `</head>`):**
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
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1rem;
}

.template-credit-banner p {
    margin: 0;
    font-size: 14px;
    color: #ffffff;
    line-height: 1.5;
}

.template-credit-banner strong { font-weight: 600; }

.template-credit-banner a {
    color: #3b82f6;  /* Customize to match template's accent color */
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

.btn-close-banner:hover { background: rgba(255, 255, 255, 0.1); }

@keyframes slideDown {
    from { transform: translateY(-100%); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

@media (max-width: 768px) {
    .template-credit-banner p { font-size: 12px; }
    .template-credit-banner .container { padding: 0 15px; }
}
```

**Banner HTML (add right after `<body>`):**
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

**Banner JavaScript (add before `</body>`):**
```html
<!-- Template Banner Functionality -->
<script>
    (function() {
        const bannerDismissed = localStorage.getItem('templateBannerDismissed');
        const dismissTime = localStorage.getItem('templateBannerDismissTime');
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

    function closeBanner() {
        const banner = document.getElementById('templateBanner');
        banner.style.animation = 'slideUp 0.2s ease-in-out';
        setTimeout(function() {
            banner.style.display = 'none';
            localStorage.setItem('templateBannerDismissed', 'true');
            localStorage.setItem('templateBannerDismissTime', Date.now().toString());
        }, 200);
    }

    const style = document.createElement('style');
    style.textContent = '@keyframes slideUp { from { transform: translateY(0); opacity: 1; } to { transform: translateY(-100%); opacity: 0; } }';
    document.head.appendChild(style);
</script>
```

**Banner Behavior:**
- Appears at top of page on load
- User can dismiss with × button
- Stays dismissed for 30 days (localStorage)
- Re-appears after 30 days

---

### **Step 2b: Add Footer Credit Link (Required)**

Every template MUST include a footer credit link. This provides a permanent backlink even if users dismiss the top banner.

**Footer Credit HTML:**
Add this to the footer section of your template (typically at the bottom, after copyright):

**For Tailwind CSS templates:**
```html
<p class="text-sm text-gray-400 mt-4">
    Like this template? See more free templates + premium projects by
    <a href="https://travissutphin.com/projects#free-templates"
       target="_blank"
       rel="noopener"
       class="text-white hover:text-[ACCENT-COLOR] transition-colors font-semibold">Travis Sutphin</a>
</p>
```

**For Bootstrap templates:**
```html
<p class="footer-description">
    Like this template? See more free templates + premium projects by
    <a href="https://travissutphin.com/projects#free-templates"
       target="_blank"
       rel="noopener"
       style="color: #fff; font-weight: 600; text-decoration: none;">Travis Sutphin</a>
</p>
```

**Customization:**
- Replace `[ACCENT-COLOR]` with the template's accent color (e.g., `text-royal-gold`, `text-seagrass`, `text-[#E63946]`)
- Place in footer's bottom section, after copyright/legal links
- Use `font-semibold` on the link for emphasis

**Important:** The anchor `#free-templates` links directly to the Free Templates section on /projects.

---

### **Step 3: Create the Template .zip File**

**What to Include in the .zip:**
- All HTML files
- CSS files (if custom styles beyond framework)
- JavaScript files (if any)
- Image assets (optimized for web)
- README.md with:
  - Quick start instructions
  - Customization tips
  - Credits/license (MIT recommended)
  - Link back to travissutphin.com

**Example README.md for .zip:**
```markdown
# Modern Landing Page Template

Free Bootstrap 5 template by Travis Sutphin

## Quick Start
1. Extract all files
2. Open index.html in your browser
3. Customize text, images, and colors
4. Deploy to your web host

## Customization
- Colors: Edit the CSS variables in `<style>` section
- Images: Replace placeholder images in `/images`
- Content: Update text directly in index.html

## Credits
Built with Bootstrap 5.3
Created by Travis Sutphin - https://travissutphin.com

## License
MIT License - Free for personal and commercial use
```

---

### **Step 4: Create & Optimize Preview Screenshot**

**Specifications:**
- **Dimensions:** 1200px wide (height varies, ~630px typical)
- **Source Format:** PNG
- **Final Format:** WebP (required for production)
- **Target File Size:** Under 50KB (WebP)
- **Content:** Full-page screenshot or hero section

**Step 4a: Capture Screenshot**
- Browser DevTools (responsive mode at 1200px width)
- Screenshot tools (Snagit, Lightshot, or browser extensions)
- Save as `preview.png` (keep original for reference)

**Step 4b: Convert to WebP (Required)**
```bash
# Install sharp-cli globally (one-time)
npm install -g sharp-cli

# Convert PNG to WebP (run from project root)
sharp -i "public/templates-free/{framework}/{template-slug}/preview.png" \
      -o "public/templates-free/{framework}/{template-slug}/" \
      -f webp -q 80 resize 1200
```

**Compression Results (typical):**
| Original PNG | WebP Output | Savings |
|-------------|-------------|---------|
| 500-1300 KB | 25-50 KB    | 90-95%  |

**Final Files:**
```
/public/templates-free/{framework}/{template-slug}/
├── preview.png   # Original (keep for reference)
├── preview.webp  # Optimized (used in production)
```

**Important:** The `free-templates.json` must reference `preview.webp`, not `preview.png`!

---

### **Step 5: Write Template Description**

**Formula:** [What it is] + [Key benefit] + [Who it's for]

**Examples:**

✅ **Good:**
> "Modern landing page template with hero section, features grid, and contact form. Fully responsive with clean code. Perfect for SaaS products and service businesses launching fast."

✅ **Good:**
> "Single-page portfolio template showcasing projects with image galleries and filterable categories. Mobile-first design with smooth animations. Ideal for freelancers and creative professionals."

❌ **Too Generic:**
> "A nice template for websites with Bootstrap."

❌ **Too Technical:**
> "Utilizes Bootstrap 5.3 grid system with flexbox utilities and responsive breakpoints at 768px and 1024px."

❌ **Wrong Usage:**
> "Do not use "StoryBrand Framework", instead us "impactFul Framework"

**Length:** 2-3 sentences, ~30-50 words

---

### **Step 6: Update `/content/data/free-templates.json`**

**Location:** `C:\xampp\htdocs\travissutphin.com\content\data\free-templates.json`

⚠️ **IMPORTANT: Ordering Rule - Newest Templates First!**

Templates are displayed in the order they appear in the JSON array. **Always add new templates at the TOP of the array** so the newest template appears first on the /projects page.

**Add Your Template Entry (at the TOP of the array):**

```json
{
  "templates": [
    {
      "id": "landing-page-modern",
      "name": "Modern Landing Page",
      "framework": "Bootstrap 5",
      "category": "Landing Page",
      "description": "Modern landing page template with hero section, features grid, and contact form. Fully responsive with clean code. Perfect for SaaS products and service businesses.",
      "preview_url": "/templates-free/bootstrap/landing-page-modern/index.html",
      "download_url": "/templates-free/bootstrap/landing-page-modern/landing-page-modern.zip",
      "preview_image": "/templates-free/bootstrap/landing-page-modern/preview.webp",
      "tech_stack": ["Bootstrap 5", "Responsive", "Mobile-First", "SEO Ready"],
      "features": ["Hero Section", "Features Grid", "Contact Form", "Testimonials"],
      "file_size": "450 KB",
      "last_updated": "2025-01-15"
    },
    // ... older templates follow ...
  ]
}
```

**Field Reference:**

| Field | Description | Example |
|-------|-------------|---------|
| `id` | Unique slug (lowercase, hyphens) | `"landing-page-modern"` |
| `name` | Display name | `"Modern Landing Page"` |
| `framework` | Framework version | `"Bootstrap 5"` or `"Tailwind CSS"` |
| `category` | Template type | `"Landing Page"`, `"Portfolio"`, `"Dashboard"` |
| `description` | 2-3 sentence description | See examples above |
| `preview_url` | Path to live preview | `"/templates-free/bootstrap/...index.html"` |
| `download_url` | Path to .zip file | `"/templates-free/bootstrap/...zip"` |
| `preview_image` | Path to screenshot (**use .webp**) | `"/templates-free/bootstrap/...preview.webp"` |
| `tech_stack` | Array of technologies | `["Bootstrap 5", "Responsive"]` |
| `features` | Array of key features (optional) | `["Hero Section", "Contact Form"]` |
| `file_size` | Approximate .zip size | `"450 KB"` (check actual file) |
| `last_updated` | ISO date (YYYY-MM-DD) | `"2025-01-15"` |

---

### **Step 7: Test Locally**

**Via XAMPP (Port 80):**
```
http://localhost/projects
```

**Via PHP Built-in Server (Port 8080):**
```bash
cd public
php -S localhost:8080
```
Then visit: `http://localhost:8080/projects`

**QA Checklist:**
- [ ] Template card displays correctly
- [ ] Preview image loads (WebP format)
- [ ] Framework badge shows correct framework
- [ ] Tech stack tags display
- [ ] "Preview" button opens template in new tab
- [ ] "Download" button triggers .zip download
- [ ] Template preview page renders correctly
- [ ] **Credit banner appears** at top of template
- [ ] **Banner dismiss button** works and persists (localStorage)
- [ ] **Footer credit link** appears in footer section
- [ ] **Footer link** opens to /projects#free-templates (new tab)
- [ ] No PHP errors in error log
- [ ] Mobile responsive (test at 375px, 768px, 1024px)

---

### **Step 8: Update Sitemap (Optional but Recommended)**

**Location:** `C:\xampp\htdocs\travissutphin.com\public\sitemap.xml`

**When to Update:**
1. The `/projects` page lastmod date should be updated when you add a new template
2. Optionally add the template preview URL itself for better SEO

**Update Projects Page Entry:**
```xml
<url>
    <loc>https://travissutphin.com/projects</loc>
    <lastmod>2025-11-15</lastmod> <!-- Today's date -->
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
</url>
```

**Add Template Preview URL (Optional):**
```xml
<!-- Free Templates -->
<url>
    <loc>https://travissutphin.com/templates-free/bootstrap/landing-page-modern/index.html</loc>
    <lastmod>2025-01-15</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
</url>
```

---

### **Step 9: Marketing & Promotion** (Recommended)

**Internal Promotion:**
- [ ] Mention template in relevant blog post
- [ ] Add to newsletter (if applicable)
- [ ] Share on social media

**External Promotion:**
- [ ] Submit to template directories (BootstrapBay, ThemeForest free section)
- [ ] Share on Dev.to, Reddit (r/webdev, r/html), X
- [ ] Create GitHub repository showcase

**SEO Tips:**
- Wait 1-2 weeks between template launches for maximum SEO impact
- Each template becomes a new indexed page
- Target different keywords with each template description

---

## File Size Guidelines

**Recommended .zip Sizes:**
- Simple landing pages: 200-500 KB
- Portfolio templates: 500 KB - 1 MB
- Complex dashboards: 1-2 MB

**Keep it Lean:**
- Optimize images (use TinyPNG)
- Minify CSS/JS for production builds (optional)
- Remove unused Bootstrap components (if custom build)

---

## Common Issues & Troubleshooting

### Issue: Template card shows broken image
**Solution:** Check `preview_image` path in JSON. Ensure file exists at exact path.

### Issue: Download doesn't work
**Solution:** Verify .zip file exists at `download_url` path. Check .htaccess allows .zip downloads.

### Issue: Preview opens in same tab
**Solution:** Verify `target="_blank"` is in preview link (already in template).

### Issue: PHP error when loading page
**Solution:** Run `php -l templates/pages/projects.php` to check syntax. Validate JSON with online validator.

### Issue: Schema.org not showing in Google
**Solution:** Use Google's Rich Results Test: https://search.google.com/test/rich-results
Paste your live `/projects` page URL.

---

## Future Enhancements (Roadmap)

**Phase 2:**
- [ ] Download counter (track popularity)
- [ ] User ratings/reviews
- [ ] Template tags/filtering (by use case)

**Phase 3:**
- [ ] CDN hosting for .zip files (Cloudflare R2)
- [ ] Template customizer (live color picker)
- [ ] Newsletter opt-in for template updates

---

## Quick Reference: Adding Template in 5 Minutes

```bash
# 1. Create directory
mkdir -p public/templates-free/bootstrap/my-template

# 2. Add files
# - Copy your index.html, .zip, preview.png to directory

# 3. Update JSON
# - Edit content/data/free-templates.json
# - Add new template entry

# 4. Test
cd public && php -S localhost:8080
# Visit: http://localhost:8080/projects

# 5. Update sitemap
# - Edit public/sitemap.xml
# - Update /projects lastmod date

# Done!
```

---

## Support

**Questions?** Ask [Syntax] for technical issues, [Bran] for SEO questions, [Echo] for content strategy.

**Process Updates:** Submit suggestions to [Codey] for process improvements.

---

**Happy Templating! 🚀**
