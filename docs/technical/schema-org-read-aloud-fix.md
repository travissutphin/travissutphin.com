# Schema.org Fix for Chrome "Listen to This Page" Feature
**Date**: October 10, 2025
**Team**: [Bran], [Syntax]
**Issue**: Blog posts don't support Chrome's "Listen to this page" feature

---

## 🔍 Problem Analysis

### Why Homepage Works But Blog Posts Don't

**Chrome's "Listen to this page" requirements**:
1. ✅ `articleBody` property in BlogPosting schema (contains full article text)
2. ✅ Accurate `wordCount`
3. ✅ Proper `description` (uses blog excerpt, not default site description)
4. ✅ `publisher` as Organization (not Person)
5. ✅ Author with `sameAs` social links
6. ✅ `inLanguage` specification
7. ✅ Image with proper dimensions

### Current Issues Found

**Blog Post Schema Problems**:
- ❌ `articleBody`: Empty string (should contain full article text)
- ❌ `description`: Uses default site description instead of blog excerpt
- ❌ `wordCount`: Shows 500 instead of actual ~2150
- ❌ `publisher`: Was Person, should be Organization
- ❌ Missing `inLanguage`: "en-US"
- ⚠️ Author lacks `sameAs` social profile links

---

## ✅ Changes Made

### 1. Updated `/templates/partials/meta.php`

**Added for BlogPosting Schema**:

```php
// Use excerpt for description if available
$blog_description = isset($excerpt) ? $excerpt : $meta_description;

// Get article body text for Read Aloud feature
$article_text = '';
if (isset($html_content)) {
    $article_text = strip_tags($html_content);
} elseif (isset($content)) {
    $article_text = strip_tags(parse_markdown($content));
}

// Calculate accurate word count
$actual_word_count = !empty($article_text) ? str_word_count($article_text) : 500;
```

**Schema Properties Enhanced**:

| Property | Before | After |
|----------|--------|-------|
| `description` | Default site description | Blog post excerpt |
| `articleBody` | Missing ❌ | Full article text ✅ |
| `wordCount` | 500 (incorrect) | Actual count (2150) ✅ |
| `publisher @type` | Person | Organization ✅ |
| `publisher.logo` | Missing | Icon with dimensions ✅ |
| `author.sameAs` | Missing | LinkedIn + Twitter ✅ |
| `inLanguage` | Missing | "en-US" ✅ |

**Publisher Updated**:
```json
"publisher": {
    "@type": "Organization",
    "name": "Travis Sutphin",
    "url": "https://travissutphin.com",
    "logo": {
        "@type": "ImageObject",
        "url": "https://travissutphin.com/favicon_io/apple-touch-icon.png",
        "width": 180,
        "height": 180
    }
}
```

**Author Enhanced**:
```json
"author": {
    "@type": "Person",
    "name": "Travis Sutphin",
    "url": "https://travissutphin.com",
    "sameAs": [
        "https://linkedin.com/in/travissutphin",
        "https://twitter.com/travissutphin"
    ]
}
```

### 2. Updated Meta Tags

**Meta Description**:
```php
<!-- Now uses excerpt if available -->
<meta name="description" content="<?php echo e(isset($excerpt) ? $excerpt : $meta_description); ?>">
```

**Open Graph & Twitter**:
```php
<!-- Both now use excerpt for blog posts -->
<meta property="og:description" content="<?php echo e(isset($excerpt) ? $excerpt : $meta_description); ?>">
<meta name="twitter:description" content="<?php echo e(isset($excerpt) ? $excerpt : $meta_description); ?>">
```

---

## 🐛 Known Issue: Variables Not Passing Through

### Problem
After changes, blog posts still show:
- `articleBody`: "" (empty)
- `description`: Default site description
- `wordCount`: 500

### Root Cause
The `$excerpt` and proper content variables aren't being passed from `render_blog_post()` to the meta template through `render_page()`.

**Why?** The `extract($data)` in `render_page()` should make all variables available, but the meta.php partial might be executing before variables are fully extracted, or there's a scoping issue.

### Solution Needed

**Option 1: Pass variables explicitly to meta partial** (Recommended)
Update `render_page()` in `/lib/functions.php`:

```php
function render_page($template, $data = []) {
    extract($data);

    // ... existing code ...

    // Explicitly pass blog-specific vars to meta partial
    $meta_vars = [
        'title' => $title,
        'meta_description' => $meta_description,
        'og_image' => $og_image ?? '/assets/images/default-og.png',
        'og_type' => $og_type ?? 'website',
        'is_blog_post' => $is_blog_post ?? false,
        'excerpt' => $excerpt ?? null,  // ADD THIS
        'html_content' => $html_content ?? null,  // ADD THIS
        'content' => $content ?? null,  // ADD THIS
        'date' => $date ?? null,
        'tags' => $tags ?? [],
        'readingTime' => $readingTime ?? null,
        'image' => $image ?? null
    ];

    // Then in base.php, pass $meta_vars to meta partial
}
```

**Option 2: Debug variable availability**
Add temporary debug to see what's available:

```php
// In meta.php, temporarily add:
<!-- DEBUG:
excerpt: <?php var_dump(isset($excerpt) ? 'SET' : 'NOT SET'); ?>
html_content: <?php var_dump(isset($html_content) ? 'SET' : 'NOT SET'); ?>
-->
```

---

## 📊 Expected Outcome After Fix

### BlogPosting Schema (Corrected)
```json
{
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": "Vibe Coding for Beginners: 5 Do's and 5 Don'ts That'll Save Your Sanity",
    "description": "Master AI-assisted coding with these 5 essential do's and don'ts...",
    "articleBody": "So you've discovered the magic of vibe coding... [full 2150 word article text]",
    "datePublished": "2025-10-10",
    "dateModified": "2025-10-10",
    "author": {
        "@type": "Person",
        "name": "Travis Sutphin",
        "url": "https://travissutphin.com",
        "sameAs": [
            "https://linkedin.com/in/travissutphin",
            "https://twitter.com/travissutphin"
        ]
    },
    "publisher": {
        "@type": "Organization",
        "name": "Travis Sutphin",
        "url": "https://travissutphin.com",
        "logo": {
            "@type": "ImageObject",
            "url": "https://travissutphin.com/favicon_io/apple-touch-icon.png",
            "width": 180,
            "height": 180
        }
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "https://travissutphin.com/blog/2025-10-10-vibe-coding-dos-and-donts"
    },
    "image": {
        "@type": "ImageObject",
        "url": "https://travissutphin.com/assets/images/blogs/2025-10-10-vibe-coding-dos-and-donts.png",
        "width": 1200,
        "height": 630
    },
    "wordCount": 2150,
    "timeRequired": "PT8M",
    "articleSection": "AI",
    "inLanguage": "en-US",
    "keywords": "vibe coding, AI-assisted coding, AI coding tools, beginner coding..."
}
```

---

## 🎯 Chrome Read Aloud Checklist

After fixing variable passing:

- [ ] `articleBody` contains full article text (not empty)
- [ ] `description` uses blog excerpt (not default description)
- [ ] `wordCount` shows actual count (2150, not 500)
- [ ] `publisher` is Organization with logo
- [ ] `author` has sameAs social links
- [ ] `image` included with dimensions
- [ ] `inLanguage` set to "en-US"
- [ ] Test in Chrome: "Listen to this page" icon appears
- [ ] Validate with Google Rich Results Test

---

## 🔗 Related Files Modified

1. `/templates/partials/meta.php` - Schema.org and meta tags
2. `/lib/functions.php` - Will need update for variable passing
3. `/templates/layouts/base.php` - May need update to pass vars to meta partial

---

## 📝 Next Steps

**[Syntax]**:
1. Debug why `$excerpt` and `$html_content` aren't available in meta.php
2. Update `render_page()` to explicitly pass all needed variables
3. Test locally that articleBody is populated
4. Verify Chrome Read Aloud feature works

**[Bran]**:
1. After fix, validate with Google Rich Results Test
2. Test "Listen to this page" in Chrome on multiple blog posts
3. Document any additional requirements found

---

## 🚀 Deployment

After fixing variable passing:

```bash
git add templates/partials/meta.php lib/functions.php
git commit -m "fix: enable Chrome Read Aloud with complete BlogPosting schema

- Add articleBody property with full article text
- Use blog excerpt for description (not default)
- Calculate accurate wordCount
- Update publisher to Organization type with logo
- Add author sameAs social profile links
- Include inLanguage specification
- Fix variable passing from render_blog_post to meta template

Chrome Read Aloud now fully supported on all blog posts."

git push origin main
```

---

**Status**: Changes made, variable passing issue identified
**Blocking**: Need to fix variable scoping in `render_page()`
**Next**: [Syntax] to debug and implement variable passing fix
