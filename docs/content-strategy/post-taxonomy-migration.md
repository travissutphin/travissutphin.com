# Blog Post Taxonomy Migration Plan
**Date**: October 11, 2025
**Owner**: [Bran] (Lead), [Echo] (Support)
**Timeline**: Week of October 14-18, 2025

---

## 📋 Migration Checklist: All 14 Posts

### Post 1: 2024-10-05-outgrowing-excel-why-web-apps-transform-business-operations.md
**Current Tags**: `["Web Development", "Business Operations", "Excel Alternative", "Scalability"]`

**New Taxonomy**:
```yaml
category: "Business & Strategy"
topics: ["Digital Transformation"]
tags: ["Business Operations", "Software Development", "Scalability"]
intent: "commercial"
search_query: "when to replace Excel with web app"
```
- ❌ Remove: `Excel Alternative` (too specific)
- ✅ Change: `Web Development` → `Software Development`
- ✅ Keep: `Business Operations`, `Scalability`

---

### Post 2: 2024-10-26-raci-chart-project-management-guide.md
**Current Tags**: `["Project Management", "Team Leadership", "Business Tools", "Productivity"]`

**New Taxonomy**:
```yaml
category: "Project Management"
topics: ["Team Leadership", "Project Planning"]
tags: ["Project Management", "Team Leadership", "Workflows"]
intent: "navigational"
search_query: "RACI chart template project management"
```
- ❌ Remove: `Business Tools` (merge into Business Operations)
- ✅ Change: `Productivity` → `Workflows`
- ✅ Keep: `Project Management`, `Team Leadership`

---

### Post 3: 2024-11-22-stop-firefighting-mondays-30-minute-ceo-framework.md
**Current Tags**: `["Productivity", "CEO", "Time Management", "Framework"]`

**New Taxonomy**:
```yaml
category: "Productivity & Systems"
topics: ["Time Management", "Weekly Planning"]
tags: ["Productivity", "Time Management", "Leadership"]
intent: "informational"
search_query: "weekly planning framework for executives"
```
- ❌ Remove: `Framework` (generic)
- ✅ Change: `CEO` → `Leadership`
- ✅ Keep: `Productivity`, `Time Management`

---

### Post 4: 2024-12-15-10-technical-pm-skills-nobody-warned-you-about.md
**Current Tags**: `["Project Management", "Technical Leadership", "TPM", "Engineering Management"]`

**New Taxonomy**:
```yaml
category: "Technical Leadership"
topics: ["Engineering Management", "Technical Skills"]
tags: ["Engineering Management", "Technical Leadership", "Project Management"]
intent: "informational"
search_query: "technical project manager skills"
```
- ❌ Remove: `TPM` (abbreviation)
- ✅ Keep: `Project Management`, `Technical Leadership`, `Engineering Management`

---

### Post 5: 2025-01-25-learn-by-reading-master-by-doing.md
**Current Tags**: `["Learning", "Professional Development", "Mastery", "Methodology"]`

**New Taxonomy**:
```yaml
category: "Learning & Development"
topics: ["Learning Methods", "Professional Growth"]
tags: ["Learning", "Professional Development"]
intent: "informational"
search_query: "how to master new skills effectively"
```
- ❌ Remove: `Mastery`, `Methodology` (merge into Learning)
- ✅ Keep: `Learning`, `Professional Development`

---

### Post 6: 2025-02-10-12-agile-principles-that-actually-work-in-real-projects.md
**Current Tags**: `["Agile", "Project Management", "Software Development", "Team Leadership"]`

**New Taxonomy**:
```yaml
category: "Project Management"
topics: ["Agile & Scrum", "Team Leadership"]
tags: ["Agile", "Project Management", "Software Development", "Team Leadership"]
intent: "informational"
search_query: "practical agile principles for teams"
```
- ✅ Keep all tags (well-structured already!)

---

### Post 7: 2025-03-19-recurring-tasks-best-practices-that-actually-work.md
**Current Tags**: `["Project Management", "Productivity", "Team Management", "Workflows"]`

**New Taxonomy**:
```yaml
category: "Productivity & Systems"
topics: ["File & Workflow Systems"]
tags: ["Project Management", "Productivity", "Workflows", "Systems & Processes"]
intent: "informational"
search_query: "recurring task management best practices"
```
- ❌ Remove: `Team Management`
- ✅ Add: `Systems & Processes`
- ✅ Keep: `Project Management`, `Productivity`, `Workflows`

---

### Post 8: 2025-04-22-standard-naming-conventions-stop-file-chaos.md
**Current Tags**: `["Organization", "Productivity", "File Management", "Team Efficiency"]`

**New Taxonomy**:
```yaml
category: "Productivity & Systems"
topics: ["File & Workflow Systems"]
tags: ["Organization", "Productivity", "Best Practices"]
intent: "informational"
search_query: "file naming conventions for teams"
```
- ❌ Remove: `File Management`, `Team Efficiency` (consolidate)
- ✅ Keep: `Organization`, `Productivity`
- ✅ Add: `Best Practices`

---

### Post 9: 2025-05-30-why-every-project-manager-needs-weekly-big-3.md
**Current Tags**: `["Project Management", "Productivity", "Weekly Planning", "Leadership"]`

**New Taxonomy**:
```yaml
category: "Project Management"
topics: ["Project Planning"]
tags: ["Project Management", "Productivity", "Time Management", "Leadership"]
intent: "informational"
search_query: "weekly planning for project managers"
```
- ❌ Remove: `Weekly Planning` (consolidate)
- ✅ Add: `Time Management`
- ✅ Keep: `Project Management`, `Productivity`, `Leadership`

---

### Post 10: 2025-06-26-how-we-do-anything-is-how-we-do-everything.md
**Current Tags**: `["Leadership", "Personal Development", "Habits", "Professional Excellence"]`

**New Taxonomy**:
```yaml
category: "Learning & Development"
topics: ["Professional Growth"]
tags: ["Leadership", "Professional Development"]
intent: "informational"
search_query: "leadership mindset and habits"
```
- ❌ Remove: `Personal Development`, `Habits`, `Professional Excellence` (consolidate)
- ✅ Change: All → `Professional Development`
- ✅ Keep: `Leadership`

---

### Post 11: 2025-09-21-why-your-ai-project-stuck-80-percent.md
**Current Tags**: `["AI", "Development", "Project Management", "Consulting"]`

**New Taxonomy**:
```yaml
category: "AI & Automation"
topics: ["AI Development"]
tags: ["AI", "AI Development", "Project Management", "Consulting"]
intent: "transactional"
search_query: "why AI projects fail to complete"
```
- ✅ Change: `Development` → `AI Development`
- ✅ Keep: `AI`, `Project Management`, `Consulting`

---

### Post 12: 2025-09-26-ai-speed-trap-why-moving-fast-without-systems-breaks-everything.md
**Current Tags**: `["AI", "Productivity", "Development", "Systems", "Quality"]`

**New Taxonomy**:
```yaml
category: "AI & Automation"
topics: ["AI Development"]
tags: ["AI", "AI Development", "Systems & Processes", "Best Practices"]
intent: "informational"
search_query: "AI development best practices and systems"
```
- ❌ Remove: `Quality` (merge into Best Practices)
- ✅ Change: `Development` → `AI Development`
- ✅ Change: `Systems` → `Systems & Processes`
- ✅ Add: `Best Practices`

---

### Post 13: 2025-09-30-the-hidden-cost-of-vibe-coding-with-ai-why-planning-still-matters.md
**Current Tags**: `["AI", "Development", "Best Practices", "Documentation", "Technical Debt"]`

**New Taxonomy**:
```yaml
category: "AI & Automation"
topics: ["AI Development", "Vibe Coding"]
tags: ["AI", "AI Development", "Best Practices", "Development Best Practices"]
intent: "informational"
search_query: "vibe coding problems and planning"
```
- ❌ Remove: `Documentation`, `Technical Debt` (consolidate)
- ✅ Change: `Development` → `AI Development`
- ✅ Add: `Development Best Practices`
- ✅ Keep: `AI`, `Best Practices`

---

### Post 14: 2025-10-10-vibe-coding-dos-and-donts.md
**Current Tags**: `["AI", "Vibe Coding", "AI-Assisted Development", "Beginner Guide", "Code Generation", "Best Practices", "LLM Tools", "Software Development"]`
**(TOO MANY TAGS - 8 total, need to reduce to 3-5)**

**New Taxonomy**:
```yaml
category: "AI & Automation"
topics: ["Vibe Coding", "AI Development"]
tags: ["AI", "Code Generation", "Best Practices", "AI Development"]
intent: "informational"
search_query: "vibe coding best practices for beginners"
```
- ❌ Remove: `Vibe Coding` (use as topic, not tag)
- ❌ Remove: `AI-Assisted Development` (redundant with AI Development)
- ❌ Remove: `Beginner Guide` (use intent instead)
- ❌ Remove: `LLM Tools` → merge into general `AI`
- ✅ Change: `Software Development` → `AI Development`
- ✅ Keep: `AI`, `Code Generation`, `Best Practices`

---

## 📊 Migration Summary

### Before (Current State)
- **Total Unique Tags**: 42
- **Average Tags per Post**: 4.3
- **Tags with 1 Post**: 29 (69%)
- **Tags with 3+ Posts**: 4 (10%)
- **No Categories**: 0
- **No Topics**: 0

### After (Target State)
- **Total Unique Tags**: 25 (-41% reduction)
- **Average Tags per Post**: 3.5
- **Tags with 1 Post**: 0 (0%)
- **Tags with 3+ Posts**: 25 (100%)
- **Categories**: 6
- **Topics**: 15

### Impact
- ✅ **Reduced tag bloat** by 41%
- ✅ **100% of tags** used on 3+ posts
- ✅ **Improved SEO** with category structure
- ✅ **Better UX** with clear navigation
- ✅ **Topic clusters** for internal linking

---

## 🔧 Implementation Steps

### Step 1: Backup (Before Changes)
```bash
# Create backup of all blog posts
cd content/blog
git add .
git commit -m "backup: blog posts before taxonomy migration"
```

### Step 2: Update Frontmatter Schema
Update `/lib/functions.php` to parse new fields:
- `category` (string, required)
- `topics` (array, 1-2 items)
- `tags` (array, 3-5 items)
- `intent` (string, optional)
- `search_query` (string, optional)

### Step 3: Migrate Posts (One by One)
For each post:
1. Read current frontmatter
2. Update with new taxonomy (see checklist above)
3. Test locally to verify no breakage
4. Commit individually

### Step 4: Update Templates
- Update `blog-list.php` to show categories
- Create category filter in addition to tags
- Add breadcrumb navigation
- Update meta.php for category schema

### Step 5: Create Category Pages
Create landing pages for each category:
- `/templates/pages/category-ai-automation.php`
- `/templates/pages/category-project-management.php`
- `/templates/pages/category-productivity.php`
- `/templates/pages/category-technical-leadership.php`
- `/templates/pages/category-business-strategy.php`
- `/templates/pages/category-learning-development.php`

### Step 6: Update Routing
Add category routing to `/public/index.php`:
```php
// Category pages
if (preg_match('#^/blog/([a-z-]+)/?$#', $uri, $matches)) {
    $category = $matches[1];
    // Render category page
}
```

### Step 7: Test & Validate
- [ ] All 14 posts render correctly
- [ ] Category filtering works
- [ ] Tag filtering still works
- [ ] Breadcrumbs display
- [ ] Schema.org validates
- [ ] No 404 errors

### Step 8: Deploy
```bash
git add .
git commit -m "feat: implement blog taxonomy with categories, topics, and optimized tags"
git push origin main
```

---

## ⏱️ Time Estimates

| Task | Owner | Hours | Completion |
|------|-------|-------|------------|
| Update frontmatter schema | [Syntax] | 2h | Day 1 |
| Migrate 14 posts | [Bran] + [Echo] | 4h | Day 2 |
| Create category pages | [Syntax] + [Aesthetica] | 6h | Day 3 |
| Update routing & templates | [Syntax] | 4h | Day 4 |
| QA testing | [Verity] | 3h | Day 5 |
| Deploy & validate | [Flow] | 1h | Day 5 |

**Total Effort**: 20 hours across 5 days

---

## ✅ Success Criteria

### Technical
- [ ] All 14 posts have category, topics, tags
- [ ] Zero posts with >5 tags
- [ ] Zero tags used on only 1 post
- [ ] Category pages render correctly
- [ ] Schema.org validates with categories
- [ ] Google Search Console shows no errors

### SEO
- [ ] Sitemap.xml includes category URLs
- [ ] Category pages have unique meta descriptions
- [ ] Internal linking connects posts within categories
- [ ] Breadcrumb schema implemented

### User Experience
- [ ] Users can filter by category
- [ ] Users can filter by tag
- [ ] Navigation is intuitive
- [ ] Mobile responsive

---

**Start Date**: October 14, 2025 (Monday)
**Target Completion**: October 18, 2025 (Friday)
**Review Meeting**: October 21, 2025 with [Travis]
