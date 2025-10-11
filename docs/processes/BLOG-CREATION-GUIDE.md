# Blog Post Creation Guide - SINGLE SOURCE OF TRUTH
**Version**: 1.0
**Last Updated**: October 11, 2025
**Owner**: [Echo] (Content Strategist)
**Process Status**: ✅ PRODUCTION READY

---

## 📋 Overview

This is the **definitive guide** for creating blog posts on travissutphin.com. All team members must follow this process to ensure consistency, performance, and SEO effectiveness.

**Key Principles:**
- **Consistency**: Every post follows the same structure
- **Performance**: Optimized images, fast loading
- **SEO/AEO**: Search Engine + Answer Engine optimized
- **Quality**: Professional, value-driven content

---

## 🎯 Quick Checklist (Copy for Each Post)

```
Pre-Writing:
[ ] Topic approved by [Travis] or [Echo]
[ ] Keyword research done by [Bran]
[ ] Target category identified
[ ] Search intent documented

Writing:
[ ] Draft created in markdown
[ ] Frontmatter complete (all 13 fields)
[ ] Content follows 4-min read target
[ ] StoryBrand messaging validated by [Cipher]

Images:
[ ] Hero image created (1200x630px PNG)
[ ] Image optimized to WebP (<100KB)
[ ] Both PNG + WebP in /blogs/ folder

Technical:
[ ] File named: YYYY-MM-DD-slug.md
[ ] Saved to: /content/blog/
[ ] Frontmatter syntax validated
[ ] Markdown renders correctly

Quality:
[ ] Grammar checked (Grammarly)
[ ] Links tested
[ ] Mobile preview checked
[ ] Dark mode preview checked

Deployment:
[ ] Committed to Git
[ ] Pushed to GitHub → Railway auto-deploys
[ ] Production URL verified
[ ] Sitemap updated (automatic)

SEO:
[ ] PageSpeed Insights run
[ ] Schema.org validated
[ ] Social share preview checked
```

---

## 📝 Step 1: Pre-Writing Planning

### 1.1 Topic Approval

**Who**: [Travis] or [Echo]
**Action**: Get topic approved before writing

**Approval Criteria:**
- Aligns with site categories (AI & Automation, Project Management, etc.)
- Solves a real problem for target audience
- Fits within 8-week SEO strategy

**Example Pitch:**
```
Topic: "3 Warning Signs Your AI Project Will Fail"
Category: AI & Automation
Target: Technical founders with stalled projects
Search Intent: Informational (problem awareness)
Keyword: "AI project failure warning signs"
```

### 1.2 Keyword Research

**Who**: [Bran] (SEO Specialist)
**Tools**: Ahrefs, SEMrush, or Google Keyword Planner

**Find:**
- Primary keyword (exact phrase to rank for)
- Secondary keywords (related terms)
- Search volume + competition
- User intent (informational, navigational, transactional)

**Example Output:**
```
Primary: "AI project failure" (1,200/mo, Medium)
Secondary: "why AI projects fail" (800/mo, Low)
Intent: Informational
User Question: "How do I know if my AI project is failing?"
```

### 1.3 Category & Topic Assignment

**Categories (choose ONE):**
1. **AI & Automation** - AI development, vibe coding, automation
2. **Project Management** - Planning, execution, team coordination
3. **Productivity & Systems** - Workflows, processes, efficiency
4. **Technical Leadership** - CTO skills, team management, decisions
5. **Business & Strategy** - Growth, revenue, product-market fit
6. **Learning & Development** - Skills, education, career growth

**Topics (choose 1-2):**
Each category has 2-3 topics (see `/docs/content-strategy/tag-master-list.md`)

**Example:**
```
Category: AI & Automation
Topics: ["AI Development", "Vibe Coding"]
```

---

## ✍️ Step 2: Writing the Content

### 2.1 File Naming Convention

**Format**: `YYYY-MM-DD-slug.md`

**Rules:**
- Date = Publication date (today or future)
- Slug = lowercase-with-hyphens
- Max length: 60 characters (including date)
- Use target keyword in slug

**Examples:**
```
✅ 2025-10-15-ai-project-failure-warning-signs.md
✅ 2025-10-20-stop-firefighting-mondays-updated.md
❌ 2025-10-15-blog-post.md (too generic)
❌ aiprojectfailure.md (missing date)
❌ 2025-10-15-This Is My Blog Post.md (not lowercase)
```

### 2.2 Frontmatter Structure

**Location**: Top of markdown file between `---` delimiters

**Required Fields (13 total):**

```yaml
---
title: "Your Compelling Title Here"
date: "YYYY-MM-DD"
category: "Category Name"
topics: ["Topic 1", "Topic 2"]
tags: ["Tag1", "Tag2", "Tag3"]
intent: "informational"
search_query: "target keyword phrase"
author: "Travis Sutphin"
readingTime: 4
excerpt: "Brief 1-2 sentence summary that appears in blog list and social shares."
image: "/assets/images/blogs/YYYY-MM-DD-slug.png"
faq: false
---
```

**Field Specifications:**

| Field | Type | Rules | Example |
|-------|------|-------|---------|
| `title` | String | 50-60 chars, include keyword, compelling | "3 Warning Signs Your AI Project Will Fail" |
| `date` | String | YYYY-MM-DD format, matches filename | "2025-10-15" |
| `category` | String | ONE of 6 approved categories | "AI & Automation" |
| `topics` | Array | 1-2 topics from category, quoted strings | `["AI Development", "Vibe Coding"]` |
| `tags` | Array | 2-4 tags, 3+ post minimum rule | `["AI", "Project Management", "Best Practices"]` |
| `intent` | String | Search intent type | "informational" \| "transactional" \| "navigational" |
| `search_query` | String | Primary keyword phrase | "AI project failure warning signs" |
| `author` | String | Always same | "Travis Sutphin" |
| `readingTime` | Number | Minutes (200 words/min) | 4 |
| `excerpt` | String | 150-160 chars, used for meta description | "Learn the 3 critical warning signs..." |
| `image` | String | Path to hero image | "/assets/images/blogs/YYYY-MM-DD-slug.png" |
| `faq` | Boolean | `true` or `false`, enables FAQ schema | false |

**Intent Options:**
- `informational` - Teaching, explaining, answering "how/what/why"
- `transactional` - "Get started", "Try", "Buy", action-oriented
- `navigational` - Finding specific page/resource

### 2.3 Content Structure

**Target Length**: 800-1200 words (4-6 min read)

**Recommended Structure:**

```markdown
## Opening Hook (1-2 paragraphs)
Start with pain point or relatable scenario

## Problem Statement
What challenge does the reader face?

## Solution Overview
Your approach in 2-3 sentences

## Main Content (3-5 sections)
### Section 1: First Point
- Explanation
- Example
- Takeaway

### Section 2: Second Point
[Same pattern]

### Section 3: Third Point
[Same pattern]

## Practical Application
How to implement this today

## Conclusion & CTA
- Recap key points
- Next steps
- Link to related post or contact page
```

**StoryBrand Framework** (validate with [Cipher]):
- **Customer = Hero**: Reader has a problem
- **You = Guide**: You've solved this before
- **Solution**: Your process/framework
- **Call to Action**: Next step

**Writing Guidelines:**
- **Conversational tone**: Write like you're talking to a friend
- **Short paragraphs**: 2-3 sentences max
- **Active voice**: "We built" not "It was built"
- **Bullet points**: Break up long lists
- **Examples**: Real scenarios, not hypotheticals
- **Bold key points**: Helps skimmers

### 2.4 Markdown Formatting

**Headings:**
```markdown
# Title (H1) - Only once, in frontmatter
## Section Heading (H2) - Main sections
### Subsection (H3) - Under H2s
```

**Text Formatting:**
```markdown
**Bold** for emphasis
*Italic* for subtle emphasis
`code` for technical terms, filenames
```

**Lists:**
```markdown
- Unordered list
- Item 2
  - Nested item

1. Ordered list
2. Step 2
3. Step 3
```

**Links:**
```markdown
[Link Text](https://url.com)
[Internal Link](/services)
[Blog Post](/blog/slug)
```

**Code Blocks:**
```markdown
```language
code here
```
```

**Images:**
```markdown
![Alt text](/assets/images/blogs/image.png)
```

---

## 🎨 Step 3: Creating the Hero Image

### 3.1 Image Specifications

**Dimensions:**
- Width: **1200px**
- Height: **630px**
- Aspect Ratio: **16:9**
- Format: **PNG** (source), **WebP** (optimized)

**Design Guidelines:**
- **Title**: Include post title or key phrase
- **Branding**: Use site colors (green #2be256, blue #3d608f)
- **Readable**: Text must be legible at small sizes
- **Simple**: Avoid clutter, focus on 1-2 elements
- **Professional**: Match site aesthetic

**Tools:**
- **Canva**: Use 1200x630 template
- **Figma**: Design from scratch
- **Adobe Express**: Quick templates

### 3.2 Image Naming

**Format**: `YYYY-MM-DD-slug.png`

**Must match** the blog post filename (without .md extension)

**Examples:**
```
Post: 2025-10-15-ai-project-failure-warning-signs.md
Image: 2025-10-15-ai-project-failure-warning-signs.png
```

### 3.3 Image Optimization (CRITICAL)

**Location**: `/public/assets/images/blogs/`

**Process:**

1. **Save PNG source**:
   ```bash
   Save to: /public/assets/images/blogs/YYYY-MM-DD-slug.png
   ```

2. **Run optimization script**:
   ```bash
   cd public/assets/images/blogs
   node optimize-images.js
   ```

3. **Verify WebP created**:
   ```bash
   ls -lh YYYY-MM-DD-slug.webp
   # Should be <100KB (typically 25-35KB)
   ```

**Expected Results:**
- PNG: 150-250KB (fallback for old browsers)
- WebP: 25-35KB (90% smaller, modern browsers)

**Quality Check:**
- Zoom in to 200% - text should be crisp
- No visible compression artifacts
- Colors match original

---

## ✅ Step 4: Quality Assurance

### 4.1 Technical Validation

**File Structure Check:**
```bash
# Verify files exist
ls /content/blog/YYYY-MM-DD-slug.md
ls /public/assets/images/blogs/YYYY-MM-DD-slug.png
ls /public/assets/images/blogs/YYYY-MM-DD-slug.webp
```

**Frontmatter Syntax:**
- No tabs (use spaces)
- Quotes around strings
- Square brackets for arrays: `["item1", "item2"]`
- Boolean lowercase: `true` or `false`
- No trailing commas

**Test Locally:**
```bash
# If using PHP server
cd public && php -S localhost:8080
# Then visit: http://localhost:8080/blog/slug
```

### 4.2 Content Quality

**Run Through Checklist:**
- [ ] Grammar checked (Grammarly/ProWritingAid)
- [ ] All links work (internal + external)
- [ ] Code examples formatted correctly
- [ ] Images display properly
- [ ] Reading time accurate (200 words/min)
- [ ] Excerpt is compelling

**StoryBrand Validation** ([Cipher]):
- [ ] Clear problem statement
- [ ] You positioned as guide (not hero)
- [ ] Plan is simple and actionable
- [ ] CTA is clear

### 4.3 Preview Testing

**Test Scenarios:**
1. **Desktop (Chrome)**: Full experience
2. **Mobile (iPhone)**: Touch targets, readability
3. **Dark Mode**: Text contrast, image visibility
4. **Tablet**: Layout responsiveness

**Check:**
- Hero image loads quickly
- Lazy loading works (scroll to see images load)
- Bottom nav doesn't overlap content (80px padding)
- Code blocks don't overflow horizontally

---

## 🚀 Step 5: Deployment

### 5.1 Git Workflow

**Commit Process:**

```bash
# 1. Add blog post + images
git add content/blog/YYYY-MM-DD-slug.md
git add public/assets/images/blogs/YYYY-MM-DD-slug.png
git add public/assets/images/blogs/YYYY-MM-DD-slug.webp

# 2. Commit with descriptive message
git commit -m "content: add blog post - [Title]

Brief description of what post covers.

Category: [Category Name]
Topics: [Topic1, Topic2]
Keywords: [primary keyword]
"

# 3. Push to GitHub
git push origin main
```

**Railway Auto-Deploys:**
- Push to `main` triggers automatic deployment
- Wait ~30-60 seconds for deploy
- Site updates at https://travissutphin.com

### 5.2 Sitemap Update

**Automatic Process:**
The sitemap is **automatically updated** when you deploy (no manual action needed).

**Verify Sitemap:**
```
https://travissutphin.com/sitemap.xml
```

Should include your new blog post URL:
```xml
<url>
  <loc>https://travissutphin.com/blog/YYYY-MM-DD-slug</loc>
  <lastmod>YYYY-MM-DD</lastmod>
  <changefreq>monthly</changefreq>
  <priority>0.8</priority>
</url>
```

### 5.3 Post-Deploy Verification

**Test Production:**

1. **Visit post URL**:
   ```
   https://travissutphin.com/blog/YYYY-MM-DD-slug
   ```

2. **Check blog list**:
   ```
   https://travissutphin.com/blog
   ```
   - Post appears in grid
   - Category filter works
   - Tag filter works

3. **DevTools Check**:
   - Open Network tab
   - Filter by Images
   - Verify WebP loading (not PNG)
   - Confirm <100KB per image

4. **Mobile Test**:
   - Open on iPhone/Android
   - Check readability
   - Verify lazy loading works

---

## 📊 Step 6: SEO Validation

### 6.1 PageSpeed Insights

**URL**: https://pagespeed.web.dev/

**Run Test:**
```
Enter: https://travissutphin.com/blog/YYYY-MM-DD-slug
Click: Analyze
```

**Target Scores:**
- Mobile: **90+**
- Desktop: **95+**
- LCP (Largest Contentful Paint): **<2.5s**
- CLS (Cumulative Layout Shift): **<0.1**

**If Score is Low:**
- Image optimization (should be <100KB)
- Lazy loading working?
- No blocking scripts?

### 6.2 Schema.org Validation

**URL**: https://validator.schema.org/

**Test:**
```
Enter: https://travissutphin.com/blog/YYYY-MM-DD-slug
Click: Run Test
```

**Expected Schema Types:**
- `BlogPosting` ✅
- `Person` (author) ✅
- `Organization` (publisher) ✅
- `WebPage` ✅

**If FAQ Enabled** (`faq: true`):
- `FAQPage` ✅
- `Question` items ✅

### 6.3 Social Share Preview

**Test Tools:**
- **Facebook**: https://developers.facebook.com/tools/debug/
- **Twitter**: https://cards-dev.twitter.com/validator
- **LinkedIn**: Post preview in LinkedIn

**Verify:**
- Title displays correctly
- Excerpt appears as description
- Hero image shows (1200x630px)
- Site name shows: "Travis Sutphin"

---

## 🔄 Step 7: Post-Publication Tasks

### 7.1 Immediate (Day 1)

**Monitor:**
- [ ] Google Search Console for indexing
- [ ] Analytics for initial traffic
- [ ] Error logs for 404s or issues

**Promote:**
- [ ] Share on LinkedIn (if applicable)
- [ ] Add to newsletter draft (if applicable)
- [ ] Internal link from related posts

### 7.2 Short-Term (Week 1)

**Check:**
- [ ] PageSpeed score stable
- [ ] No broken links reported
- [ ] Images loading correctly

**SEO:**
- [ ] Google indexed the page
- [ ] Search appearance correct
- [ ] Rich results showing (if applicable)

### 7.3 Long-Term (Month 1)

**Review:**
- [ ] Traffic trends (Google Analytics)
- [ ] Bounce rate acceptable (<70%)
- [ ] Average time on page (target: 2+ minutes)
- [ ] Conversion rate (if CTA present)

**Optimize:**
- [ ] Update based on search queries
- [ ] Add internal links to new posts
- [ ] Refresh date if content updated

---

## 🚨 Common Issues & Solutions

### Issue: Post Returns 404

**Cause**: Filename doesn't match expected pattern
**Solution**:
```bash
# Verify filename format
ls content/blog/YYYY-MM-DD-slug.md

# Must be exact format, lowercase, hyphens only
```

### Issue: Image Not Loading

**Cause**: Path mismatch between frontmatter and actual file
**Solution**:
```yaml
# Frontmatter path:
image: "/assets/images/blogs/2025-10-15-slug.png"

# Actual file location:
/public/assets/images/blogs/2025-10-15-slug.png
```

### Issue: WebP Not Loading (PNG Loads Instead)

**Cause**: WebP file doesn't exist or wrong path
**Solution**:
```bash
cd public/assets/images/blogs
node optimize-images.js
```

### Issue: Frontmatter Parse Error

**Cause**: Syntax error in YAML
**Solution**:
```yaml
# Common mistakes:
❌ tags: [AI, Testing]  # Missing quotes
✅ tags: ["AI", "Testing"]

❌ title: It's working  # Apostrophe breaks parsing
✅ title: "It's working"

❌ faq: False  # Capitalized boolean
✅ faq: false
```

### Issue: Reading Time Incorrect

**Cause**: Manual entry doesn't match content length
**Solution**:
```bash
# Count words in post
wc -w content/blog/YYYY-MM-DD-slug.md

# Calculate reading time
words ÷ 200 = minutes
```

### Issue: Schema.org Validation Fails

**Cause**: Missing required frontmatter fields
**Solution**:
Ensure all 13 fields are present:
- title, date, category, topics, tags
- intent, search_query, author, readingTime
- excerpt, image, faq

---

## 📚 Reference Materials

### Essential Documents

**Taxonomy & SEO:**
- `/docs/content-strategy/blog-taxonomy-seo-plan.md` - Full SEO strategy
- `/docs/content-strategy/tag-master-list.md` - Approved categories/topics/tags
- `/docs/content-strategy/post-taxonomy-migration.md` - Migration examples

**Design & Performance:**
- `/docs/design/visual-brand-audit-report-2025-10-11.md` - Design standards
- `/docs/processes/blog-image-optimization-guide.md` - Detailed image guide

**Image Optimization:**
- `/public/assets/images/blogs/optimize-images.js` - Optimization script
- `/public/assets/images/blogs/package.json` - Sharp dependency

### Approval Matrix

| Decision | Owner | Backup |
|----------|-------|--------|
| Topic approval | [Travis] or [Echo] | - |
| Keyword research | [Bran] | [Echo] |
| Content writing | [Echo] | [Travis] |
| Image design | [Aesthetica] | External designer |
| StoryBrand review | [Cipher] | [Travis] |
| Technical QA | [Verity] | [Syntax] |
| SEO validation | [Bran] | [Syntax] |
| Deployment | [Flow] or Auto | [Syntax] |

### Contact for Help

**Question Type** → **Ask**:
- Content strategy → [Echo]
- SEO/keywords → [Bran]
- StoryBrand messaging → [Cipher]
- Technical issues → [Syntax]
- Design/images → [Aesthetica]
- Process questions → [Codey]
- Final approval → [Travis]

---

## 📋 Templates

### Blog Post Template

```markdown
---
title: "[Compelling Title with Keyword]"
date: "YYYY-MM-DD"
category: "[One of 6 Categories]"
topics: ["[Topic1]", "[Topic2]"]
tags: ["[Tag1]", "[Tag2]", "[Tag3]"]
intent: "informational"
search_query: "[primary keyword phrase]"
author: "Travis Sutphin"
readingTime: 4
excerpt: "[Brief 1-2 sentence summary for meta description and social shares.]"
image: "/assets/images/blogs/YYYY-MM-DD-slug.png"
faq: false
---

## Opening Hook

Start with a relatable scenario or pain point...

## Problem Statement

What challenge does the reader face?

## Solution Overview

Your approach in 2-3 sentences.

## Main Point 1

Explanation, example, takeaway.

## Main Point 2

Explanation, example, takeaway.

## Main Point 3

Explanation, example, takeaway.

## Practical Application

How to implement this today.

## Conclusion

Recap key points, next steps, CTA.
```

### Commit Message Template

```
content: add blog post - [Title]

Brief description of what post covers.

Category: [Category Name]
Topics: [Topic1, Topic2]
Keywords: [primary keyword]
Reading Time: X min
Image: Optimized (PNG + WebP)
```

---

## ✅ Final Checklist (Print This!)

```
PRE-WRITING
[ ] Topic approved
[ ] Keyword research done
[ ] Category selected
[ ] Topics assigned (1-2)
[ ] Tags chosen (2-4)
[ ] Search intent documented

WRITING
[ ] File named: YYYY-MM-DD-slug.md
[ ] Saved to: /content/blog/
[ ] All 13 frontmatter fields complete
[ ] Content structure follows template
[ ] 800-1200 words (4-6 min)
[ ] StoryBrand validated
[ ] Grammar checked

IMAGES
[ ] Hero image created (1200x630px)
[ ] PNG saved: /public/assets/images/blogs/
[ ] WebP optimized: node optimize-images.js
[ ] WebP verified: <100KB
[ ] Both formats committed

QUALITY
[ ] Frontmatter syntax validated
[ ] Links tested (all work)
[ ] Local preview checked
[ ] Mobile preview checked
[ ] Dark mode preview checked
[ ] Code blocks formatted

DEPLOYMENT
[ ] Git committed (post + images)
[ ] Pushed to GitHub
[ ] Railway deployed (auto)
[ ] Production URL verified
[ ] Sitemap includes post

SEO
[ ] PageSpeed Insights: 90+ mobile
[ ] Schema.org validated
[ ] Social preview checked
[ ] Google Search Console monitored

POST-PUBLICATION
[ ] Analytics tracking
[ ] No 404 errors
[ ] WebP loading correctly
[ ] Promoted (if applicable)
```

---

## 📞 Support

**Questions about this guide?**
- [Codey] (TPM) - Process questions
- [Echo] (Content) - Writing questions
- [Syntax] (Tech) - Technical questions

**Update this guide?**
Submit changes via pull request or notify [Codey].

---

**Document Version**: 1.0
**Created**: October 11, 2025
**Last Updated**: October 11, 2025
**Next Review**: January 11, 2026 (quarterly)

**Status**: ✅ **PRODUCTION READY** - All processes tested and validated

---

*This is the single source of truth for blog creation. All other documents are supplementary. When in doubt, follow this guide.*
