# Free Stock Photos Implementation Plan

**Feature**: Add "Free Stock Photos" section under "My Work" navigation
**Status**: PLAN - Awaiting Approval
**Created**: December 6, 2025
**Owner**: [Codey] (TPM)

---

## Overview

Add a new section to the Projects page (and navigation) for free, downloadable stock photos. The section will feature AI-generated images organized by category with optimized display thumbnails and full-resolution downloads.

### Core Principle Adherence
- ✅ Simple: JSON-based data, no database
- ✅ Efficient: WebP thumbnails for fast loading, original PNGs for download
- ✅ Robust: Follows existing template/download patterns
- ✅ Best Practice: Schema.org ImageObject markup
- ✅ Scalable: Category system allows unlimited expansion

---

## Architecture Decision

### Option A: Section on Projects Page (Recommended)
Add as a new section on `/projects` page, similar to Free Templates.
- **Pros**: Consistent with existing "My Work" structure, no new routes needed
- **Cons**: Projects page gets longer

### Option B: Separate Stock Photos Page
Create dedicated `/stock-photos` page.
- **Pros**: Cleaner separation, dedicated SEO
- **Cons**: More files to maintain, breaks consistency

**Decision**: Option A - Section on Projects page, accessible via `/projects#free-stock-photos`

---

## File Structure

```
travissutphin.com/
├── content/data/
│   └── free-stock-photos.json          # NEW - Photo metadata
├── public/assets/images/stock-photos/
│   ├── lifestyle/                       # NEW - Category folders
│   │   ├── friends-jumping-park.png     # Full-size download
│   │   ├── friends-jumping-park.webp    # Optimized thumbnail
│   │   ├── man-sailboat-ocean.png
│   │   └── man-sailboat-ocean.webp
│   ├── business/
│   │   ├── medical-exam-room.png
│   │   ├── medical-exam-room.webp
│   │   ├── remote-work-video-call.png
│   │   └── remote-work-video-call.webp
│   └── [future categories]/
├── public/
│   └── download-photo.php               # NEW - Download handler with tracking
└── templates/pages/
    └── projects.php                     # MODIFY - Add stock photos section
```

---

## Data Structure

### free-stock-photos.json

```json
{
  "categories": [
    {
      "id": "lifestyle",
      "name": "Lifestyle",
      "description": "People, activities, and everyday moments"
    },
    {
      "id": "business",
      "name": "Business",
      "description": "Professional settings and workplace scenes"
    }
  ],
  "photos": [
    {
      "id": "friends-jumping-park",
      "title": "Friends Jumping in Park",
      "description": "Diverse group of four friends jumping joyfully in a sunny park",
      "alt": "Four diverse friends jumping and laughing together in a green park on a sunny day",
      "category": "lifestyle",
      "tags": ["people", "friends", "outdoor", "happy", "diversity", "summer"],
      "dimensions": {
        "width": 1024,
        "height": 1024
      },
      "file_size": "2.5 MB",
      "format": "PNG",
      "thumbnail": "/assets/images/stock-photos/lifestyle/friends-jumping-park.webp",
      "download": "/assets/images/stock-photos/lifestyle/friends-jumping-park.png",
      "date_added": "2025-12-06",
      "downloads": 0
    },
    {
      "id": "man-sailboat-ocean",
      "title": "Man on Sailboat",
      "description": "Smiling man relaxing on a sailboat with ocean in background",
      "alt": "Happy man in blue shirt sitting on a wooden sailboat on the ocean on a clear day",
      "category": "lifestyle",
      "tags": ["ocean", "sailing", "man", "relaxation", "summer", "boat"],
      "dimensions": {
        "width": 1024,
        "height": 1024
      },
      "file_size": "1.6 MB",
      "format": "PNG",
      "thumbnail": "/assets/images/stock-photos/lifestyle/man-sailboat-ocean.webp",
      "download": "/assets/images/stock-photos/lifestyle/man-sailboat-ocean.png",
      "date_added": "2025-12-06",
      "downloads": 0
    },
    {
      "id": "medical-exam-room",
      "title": "Medical Examination Room",
      "description": "Clean, modern medical examination room with equipment",
      "alt": "Bright medical examination room with exam table, computer desk, and anatomy poster",
      "category": "business",
      "tags": ["medical", "healthcare", "doctor", "clinic", "interior", "professional"],
      "dimensions": {
        "width": 1024,
        "height": 1024
      },
      "file_size": "2.2 MB",
      "format": "PNG",
      "thumbnail": "/assets/images/stock-photos/business/medical-exam-room.webp",
      "download": "/assets/images/stock-photos/business/medical-exam-room.png",
      "date_added": "2025-12-06",
      "downloads": 0
    },
    {
      "id": "remote-work-video-call",
      "title": "Remote Work Video Call",
      "description": "Professional working from home on a video conference call",
      "alt": "Man working from home office on laptop with video call showing four colleagues on monitor",
      "category": "business",
      "tags": ["remote work", "video call", "home office", "laptop", "professional", "meeting"],
      "dimensions": {
        "width": 1024,
        "height": 1024
      },
      "file_size": "2.6 MB",
      "format": "PNG",
      "thumbnail": "/assets/images/stock-photos/business/remote-work-video-call.webp",
      "download": "/assets/images/stock-photos/business/remote-work-video-call.png",
      "date_added": "2025-12-06",
      "downloads": 0
    }
  ]
}
```

---

## UI/UX Design

### Gallery Layout
- **Grid**: 3 columns desktop, 2 tablet, 1 mobile
- **Card Design**: Match existing template cards
- **Thumbnail**: 400x400px WebP (aspect-ratio preserved)
- **Hover**: Scale effect + download overlay

### Card Components
```
┌─────────────────────────┐
│    [Thumbnail Image]    │  ← WebP, lazy loaded
│                         │
├─────────────────────────┤
│ Title                   │
│ Category • 2.5 MB       │
│ [Tags: people, outdoor] │
│                         │
│ [Preview] [Download]    │  ← Two action buttons
└─────────────────────────┘
```

### Category Filter
- Horizontal pill buttons above grid
- "All" | "Lifestyle" | "Business" | [future categories]
- JavaScript filter (no page reload)

### Lightbox Preview
- Click thumbnail to open full preview
- Show larger image + metadata
- Download button in lightbox

---

## Schema.org Markup

### ImageGallery + ImageObject Schema

```json
{
  "@context": "https://schema.org",
  "@type": "ImageGallery",
  "name": "Free Stock Photos by Travis Sutphin",
  "description": "High-quality, free stock photos for commercial and personal use",
  "url": "https://travissutphin.com/projects#free-stock-photos",
  "author": {
    "@type": "Person",
    "name": "Travis Sutphin",
    "url": "https://travissutphin.com"
  },
  "license": "https://creativecommons.org/publicdomain/zero/1.0/",
  "image": [
    {
      "@type": "ImageObject",
      "name": "Friends Jumping in Park",
      "description": "Diverse group of four friends jumping joyfully in a sunny park",
      "contentUrl": "https://travissutphin.com/assets/images/stock-photos/lifestyle/friends-jumping-park.png",
      "thumbnailUrl": "https://travissutphin.com/assets/images/stock-photos/lifestyle/friends-jumping-park.webp",
      "width": 1024,
      "height": 1024,
      "encodingFormat": "image/png",
      "license": "https://creativecommons.org/publicdomain/zero/1.0/",
      "acquireLicensePage": "https://travissutphin.com/projects#free-stock-photos",
      "creditText": "Travis Sutphin",
      "creator": {
        "@type": "Person",
        "name": "Travis Sutphin"
      },
      "datePublished": "2025-12-06"
    }
  ]
}
```

---

## SEO Considerations

### Meta Tags
- Title: "Free Stock Photos - Download High-Quality Images | Travis Sutphin"
- Description: "Free stock photos for commercial use. High-resolution lifestyle and business images. No attribution required."

### URL Structure
- Main section: `/projects#free-stock-photos`
- Individual photo (future): `/stock-photos/friends-jumping-park` (if needed)

### Image SEO
- Descriptive filenames (not IMG_001.png)
- Rich alt text for each image
- Structured data for Google Images

---

## Implementation Steps

### Phase 1: Foundation (Files & Data)
1. [ ] Create `public/assets/images/stock-photos/` directory structure
2. [ ] Rename and move 4 images from Desktop to proper folders
3. [ ] Convert images to WebP thumbnails (400px, quality 80)
4. [ ] Create `content/data/free-stock-photos.json`
5. [ ] Create `public/download-photo.php` (copy pattern from download-template.php)

### Phase 2: UI Implementation
6. [ ] Add "Free Stock Photos" section to `templates/pages/projects.php`
7. [ ] Implement category filter (JavaScript)
8. [ ] Add lightbox preview functionality
9. [ ] Style cards to match existing template cards

### Phase 3: Navigation & Schema
10. [ ] Update `templates/partials/nav.php` - Add "Free Stock Photos" to dropdown
11. [ ] Add Schema.org ImageGallery + ImageObject markup
12. [ ] Update sitemap.xml

### Phase 4: QA & Polish
13. [ ] Test download functionality
14. [ ] Test mobile responsiveness
15. [ ] Validate Schema.org markup
16. [ ] PageSpeed test for image optimization

---

## Future Expansion

### Additional Categories (When Content Available)
- Nature & Landscapes
- Food & Beverage
- Technology
- Abstract & Backgrounds
- Travel & Architecture

### Potential Features
- Search by tag
- Collections/Sets
- Related photos
- Usage examples
- Download tracking dashboard

---

## Questions for Approval

1. **License**: Should we use CC0 (public domain) or require attribution?
   - Recommendation: CC0 for simplicity and maximum appeal

2. **Download Tracking**: Track downloads like templates?
   - Recommendation: Yes, reuse existing pattern

3. **Image Naming**: Use the suggested descriptive names?
   - `friends-jumping-park.png` vs `lifestyle-001.png`
   - Recommendation: Descriptive for SEO

4. **Initial Categories**: Start with just "Lifestyle" and "Business"?
   - Based on the 4 images provided, this makes sense

---

## Approval Checklist

- [ ] Architecture decision approved (Section on Projects page)
- [ ] Data structure approved
- [ ] UI/UX design approved
- [ ] Schema markup approach approved
- [ ] License decision made
- [ ] Ready to implement

---

**Next Step**: Review this plan and approve to begin implementation.
