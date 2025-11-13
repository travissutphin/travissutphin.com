# Case Study Creation Process
**Version:** 1.1
**Last Updated:** November 13, 2025
**Team:** [MarketingTeam] Lead | [Syntax], [Aesthetica] Support
**Purpose:** Maximize impact and SEO/AEO for case studies with perfect schema.org markup

---

## Quick Checklist (Copy for Each Case Study)

```
Pre-Writing:
[ ] Topic approved by [Travis] or [Cipher]
[ ] Target keywords identified (commercial intent)
[ ] Industry and services determined
[ ] Quantifiable results gathered

Writing:
[ ] Executive summary written
[ ] Problem/Solution/Results sections complete
[ ] FAQ section added (minimum 5 questions)
[ ] Frontmatter complete (all required fields)

Images (SAME AS BLOG PROCESS):
[ ] Hero image created (1200x630px PNG)
[ ] PNG saved to /assets/images/case-studies/
[ ] WebP optimization script run: node optimize-images.js
[ ] 3 WebP files created (full, 600w, 900w)
[ ] Image quality verified

Technical:
[ ] File named: YYYY-MM-DD-slug.md
[ ] Saved to: /content/case-studies/
[ ] Frontmatter syntax validated
[ ] Markdown renders correctly

Quality:
[ ] Grammar checked
[ ] All links tested
[ ] Schema.org markup verified
[ ] Mobile/desktop preview checked

Deployment:
[ ] Committed to Git
[ ] Pushed to GitHub
[ ] Production URL verified
[ ] Image display tested
```

---

## 1. Overview

Case studies are high-value content that demonstrates real-world results and builds trust with potential clients. Unlike blog posts (which are educational/informational), case studies are **conversion-focused** and require specialized SEO treatment to rank for commercial intent keywords.

### Key Differences: Blog vs Case Study

| Aspect | Blog Post | Case Study |
|--------|-----------|------------|
| **Purpose** | Education, awareness | Conversion, trust-building |
| **Intent** | Informational | Commercial investigation |
| **Schema Type** | BlogPosting | Article + Review + HowTo |
| **URL Structure** | `/blog/{slug}` | `/case-studies/{slug}` |
| **CTA Focus** | Newsletter, related posts | Contact, consultation |
| **Metadata** | Tags, category | Industry, services, results |
| **FAQ Schema** | Optional | Highly recommended |
| **Q&A Schema** | Rare | Required for AEO |

---

## 2. Content Structure Requirements

### 2.1 Frontmatter Metadata (YAML)

Every case study MUST include the following frontmatter:

```yaml
---
# Core Metadata
title: "Case Study: [Client/Project Name] - [Main Result]"
date: "YYYY-MM-DD"
excerpt: "Brief 1-2 sentence summary focusing on the problem solved and key result"
image: "/assets/images/case-studies/YYYY-MM-DD-slug.png"
author: "Travis Sutphin"

# Case Study Specific
caseStudyType: "client-success"  # Options: client-success, internal-project, industry-analysis
industry: "SaaS"  # Or: E-commerce, Healthcare, Finance, etc.
services: ["AI Integration", "Project Rescue", "CTO Consulting"]  # Services provided
client: "Company Name"  # Or "Confidential" for anonymized studies
projectDuration: "3 months"  # Or "2 weeks", "6 months", etc.

# Results (for schema and display)
results:
  - metric: "Deployment Time"
    before: "2-4 weeks"
    after: "Same day"
    improvement: "95% faster"
  - metric: "Development Cost"
    before: "$15,000"
    after: "$2,000"
    improvement: "87% reduction"
  - metric: "Maintenance Hours"
    before: "20 hours/month"
    after: "0 hours/month"
    improvement: "100% elimination"

# SEO/AEO Optimization
searchIntent: "commercial"  # commercial, transactional
primaryKeyword: "AI website development case study"
secondaryKeywords: ["AI-native platform", "website automation", "CMS alternative"]
targetAudience: "founders, CTOs, tech leads"

# Schema.org Enhancements
includeQA: true  # Include Q&A schema for AEO
includeFAQ: true  # Include FAQ schema
includeReview: true  # Include Review schema with ratings
aggregateRating:
  ratingValue: 4.9
  reviewCount: 1

# Social/OG Tags
ogType: "article"
twitterCard: "summary_large_image"
---
```

### 2.2 Required Content Sections

Every case study should follow this structure:

1. **Executive Summary** (H2)
   - 2-3 paragraphs
   - Problem, solution, results
   - Optimized for featured snippets

2. **The Challenge/Problem** (H2)
   - Detailed problem description
   - Context and background
   - Why existing solutions failed

3. **The Solution** (H2)
   - Your approach
   - Technologies/methodologies used
   - Implementation process (step-by-step if appropriate)

4. **Results & Impact** (H2)
   - Quantifiable metrics
   - Before/after comparisons
   - Charts or data visualizations (if available)

5. **Lessons Learned** (H2)
   - Key insights
   - Challenges overcome
   - Recommendations for similar situations

6. **FAQ Section** (H2) - **REQUIRED for AEO**
   - Minimum 5 questions
   - Focus on common objections/concerns
   - Optimize for voice search queries

7. **Q&A Section** (H2) - **OPTIONAL but Recommended**
   - Interview-style Q&A
   - More conversational than FAQ
   - Good for relationship building

---

## 3. SEO/AEO Optimization Strategy

### 3.1 Schema.org Markup Requirements

Case studies require **multiple schema types** for maximum SEO impact:

#### Primary Schema: Article
```json
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "[Title]",
  "description": "[Excerpt]",
  "image": "[Image URL]",
  "datePublished": "[Date]",
  "dateModified": "[Date]",
  "author": {
    "@type": "Person",
    "name": "Travis Sutphin",
    "jobTitle": "Fractional CTO",
    "url": "[Profile URL]"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Travis Sutphin - AI Tech Solutions",
    "logo": {
      "@type": "ImageObject",
      "url": "[Logo URL]"
    }
  },
  "articleSection": "Case Studies",
  "keywords": "[comma-separated keywords]",
  "wordCount": [count],
  "about": {
    "@type": "Thing",
    "name": "[Industry or Topic]"
  }
}
```

#### Secondary Schema: Review (if applicable)
```json
{
  "@context": "https://schema.org",
  "@type": "Review",
  "itemReviewed": {
    "@type": "Service",
    "name": "[Service Name]",
    "provider": {
      "@type": "Organization",
      "name": "Travis Sutphin - AI Tech Solutions"
    }
  },
  "reviewRating": {
    "@type": "Rating",
    "ratingValue": "4.9",
    "bestRating": "5"
  },
  "author": {
    "@type": "Person",
    "name": "[Client Name or 'Client']"
  },
  "reviewBody": "[Brief testimonial or key result]"
}
```

#### Tertiary Schema: HowTo (for process-heavy case studies)
```json
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to [Achieve Result]",
  "description": "[Process description]",
  "totalTime": "[Duration]",
  "step": [
    {
      "@type": "HowToStep",
      "name": "[Step Name]",
      "text": "[Step Description]",
      "position": 1
    }
  ]
}
```

#### Required Schema: FAQPage
```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "[Question text]",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "[Answer text]"
      }
    }
  ]
}
```

#### AEO Schema: QAPage (for Q&A sections)
```json
{
  "@context": "https://schema.org",
  "@type": "QAPage",
  "mainEntity": {
    "@type": "Question",
    "name": "[Main question]",
    "text": "[Full question]",
    "answerCount": 1,
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "[Answer]",
      "author": {
        "@type": "Person",
        "name": "Travis Sutphin"
      }
    }
  }
}
```

### 3.2 AEO (Answer Engine Optimization) Best Practices

**Answer Engine Optimization** targets AI systems like ChatGPT, Perplexity, Google's SGE, and Bing Copilot. These systems prioritize:

1. **Structured Q&A Format**
   - Use explicit "Q:" and "A:" labels
   - Write in natural language (conversational)
   - Target voice search queries ("How do I...", "What's the best way to...")

2. **Clear Problem/Solution Pairs**
   - State problems clearly in headers
   - Provide concise, actionable solutions
   - Use numbered lists and bullet points

3. **Quantifiable Results**
   - Always include specific metrics
   - Use before/after comparisons
   - Highlight percentage improvements

4. **Expert Authority Signals**
   - Include author credentials
   - Reference years of experience
   - Show domain expertise

5. **Semantic Relationships**
   - Use related terminology naturally
   - Define technical terms inline
   - Create concept connections

---

## 4. Technical Implementation Checklist

### 4.1 File Structure
```
/content/case-studies/
  ├── YYYY-MM-DD-client-slug.md

/assets/images/case-studies/
  ├── YYYY-MM-DD-client-slug.png (1200x630px)
  ├── YYYY-MM-DD-client-slug.webp
  ├── YYYY-MM-DD-client-slug-600w.webp
  ├── YYYY-MM-DD-client-slug-900w.webp

/templates/pages/
  ├── case-study-single.php (new template)
  ├── case-study-list.php (new template)

/templates/partials/
  ├── case-study-card.php (new partial)
```

### 4.2 Routing Setup

Add to `/public/index.php`:
```php
// Add to $routes array
'case-studies' => 'case-study-list.php',

// Add case study routing (after blog routing)
if (strpos($route, 'case-studies/') === 0) {
    $slug = substr($route, 13); // Remove 'case-studies/' prefix
    render_case_study($slug);
    exit;
}
```

### 4.3 URL Structure

- **List page:** `https://travissutphin.com/case-studies`
- **Single case study:** `https://travissutphin.com/case-studies/thorium90-app`
- **Filtered by industry:** `https://travissutphin.com/case-studies?industry=saas`
- **Filtered by service:** `https://travissutphin.com/case-studies?service=ai-integration`

---

## 5. Content Creation Workflow

### Step 1: Research & Planning ([Cipher], [Echo])
- [ ] Identify the case study subject
- [ ] Gather quantifiable results/metrics
- [ ] Interview stakeholders (if applicable)
- [ ] Identify target keywords (commercial intent)
- [ ] Map out FAQ questions (minimum 5)
- [ ] Create content outline

### Step 2: Content Writing ([Cipher] Lead, [Echo] Support)
- [ ] Write executive summary (optimized for featured snippets)
- [ ] Document the challenge/problem
- [ ] Describe the solution (with process steps)
- [ ] Present results with metrics
- [ ] Add lessons learned section
- [ ] Write FAQ section (Q&A format)
- [ ] Optimize for readability (short paragraphs, bullets, headers)

### Step 3: SEO Optimization ([Bran] Lead)
- [ ] Optimize title tag (60 chars max)
- [ ] Write meta description (155 chars, includes CTA)
- [ ] Add primary keyword to H1, first paragraph
- [ ] Include secondary keywords naturally
- [ ] Add internal links to services, other case studies
- [ ] Add external links to authoritative sources
- [ ] Optimize image alt text
- [ ] Create Open Graph tags
- [ ] Set up Twitter Card metadata

### Step 4: Visual Assets ([Aesthetica])

#### 4.1 Hero Image Creation

**Dimensions:**
- Width: **1200px**
- Height: **630px**
- Aspect Ratio: **16:9**
- Format: **PNG** (source), **WebP** (optimized)

**Design Guidelines:**
- **Title**: Include case study title or key result
- **Branding**: Use site colors (green #2be256, blue #3d608f)
- **Readable**: Text must be legible at small sizes
- **Professional**: Match site aesthetic
- **Results-focused**: Highlight key metric if possible

**Tools:**
- **Canva**: Use 1200x630 template
- **Figma**: Design from scratch
- **Adobe Express**: Quick templates

**Naming Convention:**
```
Format: YYYY-MM-DD-slug.png
Example: 2025-11-13-thorium90-app.png

Must match the case study filename (without .md extension)
```

**Checklist:**
- [ ] Design hero image (1200x630px PNG)
- [ ] Save to: `/public/assets/images/case-studies/YYYY-MM-DD-slug.png`

#### 4.2 Image Optimization (CRITICAL - SAME AS BLOG PROCESS)

**Location**: `/public/assets/images/case-studies/`

**Process:**

1. **Save PNG source**:
   ```bash
   Save to: /public/assets/images/case-studies/YYYY-MM-DD-slug.png
   ```

2. **Run optimization script**:
   ```bash
   cd public/assets/images/case-studies
   node optimize-images.js
   ```

3. **Verify WebP files created**:
   ```bash
   ls -lh YYYY-MM-DD-slug*.webp

   # Should see 3 files:
   # - YYYY-MM-DD-slug.webp (full size, ~40-80KB)
   # - YYYY-MM-DD-slug-600w.webp (mobile, ~10-15KB)
   # - YYYY-MM-DD-slug-900w.webp (tablet, ~15-25KB)
   ```

**Expected Results:**
- PNG: 150-250KB (fallback for old browsers)
- WebP (full): 40-80KB (60-70% smaller)
- WebP (600w): 10-15KB (mobile optimized)
- WebP (900w): 15-25KB (tablet optimized)

**Quality Check:**
- [ ] Zoom to 200% - text is crisp
- [ ] No visible compression artifacts
- [ ] Colors match original
- [ ] All 3 WebP sizes created

**Alternative: Manual WebP Conversion**

If Node.js/Sharp is unavailable, use online tools:

**Option 1: Squoosh.app (Recommended)**
1. Go to https://squoosh.app/
2. Upload PNG
3. Set format to WebP, quality 85
4. Create 3 versions:
   - Full size (1200px wide) → save as `YYYY-MM-DD-slug.webp`
   - Resize to 600px wide → save as `YYYY-MM-DD-slug-600w.webp`
   - Resize to 900px wide → save as `YYYY-MM-DD-slug-900w.webp`
5. Save all to `/public/assets/images/case-studies/`

**Option 2: ImageMagick (CLI)**
```bash
cd public/assets/images/case-studies

# Full size
magick YYYY-MM-DD-slug.png -quality 85 YYYY-MM-DD-slug.webp

# 600w version
magick YYYY-MM-DD-slug.png -resize 600x -quality 85 YYYY-MM-DD-slug-600w.webp

# 900w version
magick YYYY-MM-DD-slug.png -resize 900x -quality 85 YYYY-MM-DD-slug-900w.webp
```

**Final Checklist:**
- [ ] PNG source saved (150-250KB)
- [ ] Full WebP created (40-80KB)
- [ ] 600w WebP created (10-15KB)
- [ ] 900w WebP created (15-25KB)
- [ ] All images in `/public/assets/images/case-studies/`
- [ ] Image quality verified

#### 4.3 Additional Graphics (Optional)
- [ ] Create result/metric graphics (if applicable)
- [ ] Design before/after visuals (if applicable)
- [ ] Optimize all images for web

### Step 5: Technical Implementation ([Syntax] Lead, [Aesthetica] Support)
- [ ] Create markdown file with proper frontmatter
- [ ] Add all required metadata fields
- [ ] Implement Article schema
- [ ] Implement FAQPage schema
- [ ] Implement QAPage schema (if Q&A section exists)
- [ ] Add Review schema (if applicable)
- [ ] Add HowTo schema (if process-heavy)
- [ ] Set up breadcrumb schema
- [ ] Test all internal links
- [ ] Verify responsive design

### Step 6: QA & Testing ([Verity])
- [ ] Test on desktop (Chrome, Firefox, Safari)
- [ ] Test on mobile (iOS, Android)
- [ ] Verify schema with Google Rich Results Test
- [ ] Check page load speed (< 3 seconds)
- [ ] Validate HTML/CSS
- [ ] Test all CTAs (contact forms, buttons)
- [ ] Verify social share images
- [ ] Check accessibility (WCAG AA standards)

### Step 7: Security Review ([Sentinal])
- [ ] Review for sensitive information disclosure
- [ ] Verify client permissions for public sharing
- [ ] Check for exposed API keys, credentials
- [ ] Ensure proper content security policy

### Step 8: Pre-Launch ([Codey] - TPM)
- [ ] Update sitemap.xml
- [ ] Add to case studies index page
- [ ] Create internal links from relevant blog posts
- [ ] Prepare social media posts
- [ ] Draft email announcement (if applicable)
- [ ] Schedule publication

### Step 9: Launch & Distribution ([MarketingTeam])
- [ ] Publish case study
- [ ] Submit URL to Google Search Console
- [ ] Share on LinkedIn
- [ ] Share on Twitter/X
- [ ] Send to email list (if applicable)
- [ ] Add to portfolio/services pages
- [ ] Create LinkedIn article (repurposed content)

### Step 10: Post-Launch Monitoring ([Bran], [Codey])
- [ ] Monitor Google Search Console for indexing
- [ ] Track keyword rankings (weekly for first month)
- [ ] Monitor traffic in analytics
- [ ] Track conversions (contact form submissions)
- [ ] Gather user feedback
- [ ] Update content based on performance (after 30 days)

---

## 6. Ongoing Optimization

### Monthly Reviews ([Bran] Lead)
- Review traffic analytics
- Check keyword rankings
- Analyze conversion rates
- Update metrics if new results available
- Refresh content with new insights

### Quarterly Updates ([MarketingTeam])
- Update case study with new results
- Add new FAQ questions based on user queries
- Refresh images/graphics
- Update schema markup with latest standards
- A/B test different CTAs

---

## 7. Success Metrics

### SEO Metrics
- **Organic Traffic:** Target 100+ visits/month per case study (within 6 months)
- **Keyword Rankings:** Top 10 for primary keyword within 3 months
- **Rich Results:** Featured snippets, FAQ accordions in SERPs
- **Backlinks:** Minimum 5 quality backlinks within 6 months

### AEO Metrics
- **AI Citation Rate:** Monitor mentions in ChatGPT, Perplexity, etc.
- **Voice Search Appearances:** Track via Search Console
- **Answer Box Rankings:** Aim for top 3 answer box positions

### Conversion Metrics
- **Contact Form Submissions:** Minimum 2% conversion rate
- **Consultation Requests:** Track case study → consultation path
- **Email Newsletter Signups:** Secondary CTA conversion
- **Time on Page:** Target 4+ minutes average

### Engagement Metrics
- **Scroll Depth:** Target 75% average scroll depth
- **Social Shares:** Minimum 20 shares per case study
- **Comments/Feedback:** Track qualitative feedback

---

## 8. Example: Thorium90 Case Study Implementation

### Current Status
- ✅ Content written (comprehensive, well-structured)
- ✅ Frontmatter needs to be added
- ⏳ Schema.org markup needs implementation
- ⏳ FAQ section needs to be added
- ⏳ Q&A section should be considered
- ⏳ Template needs to be created
- ⏳ Routing needs to be implemented

### Recommended Frontmatter for Thorium90 Case Study
```yaml
---
title: "Case Study: thorium90.app - How AI-Native Architecture Eliminates Traditional CMS Complexity"
date: "2025-11-13"
excerpt: "Discover how thorium90.app replaced traditional web development with AI-as-infrastructure, reducing deployment time by 95% and cutting costs by 87% for travissutphin.com."
image: "/assets/images/case-studies/2025-11-13-thorium90-app.png"
author: "Travis Sutphin"

caseStudyType: "internal-project"
industry: "Web Development"
services: ["AI Integration", "Website Development", "Platform Innovation"]
client: "travissutphin.com (Internal)"
projectDuration: "Same day"

results:
  - metric: "Deployment Time"
    before: "2-4 weeks"
    after: "Same day"
    improvement: "95% faster"
  - metric: "Development Cost"
    before: "$5,000-$15,000"
    after: "Platform fee only"
    improvement: "87% reduction"
  - metric: "Maintenance Time"
    before: "20 hours/month"
    after: "0 hours/month"
    improvement: "100% elimination"

searchIntent: "commercial"
primaryKeyword: "AI website development platform"
secondaryKeywords: ["AI-native CMS", "WordPress alternative", "automated website builder", "AI infrastructure"]
targetAudience: "founders, solopreneurs, small business owners, consultants"

includeQA: true
includeFAQ: true
includeReview: false
aggregateRating: null

ogType: "article"
twitterCard: "summary_large_image"
---
```

### FAQ Section to Add to Thorium90 Case Study

Add this section before the conclusion:

```markdown
## Frequently Asked Questions

**Q: Is thorium90.app suitable for e-commerce websites?**
A: Currently, thorium90.app excels at content-heavy sites, portfolios, and business websites. E-commerce functionality is evolving but established platforms like Shopify may still be better for complex online stores with extensive payment processing and inventory management needs.

**Q: How much technical knowledge do I need to use thorium90.app?**
A: None. If you can describe what you want in plain English, you can build and manage a thorium90.app website. The platform uses natural language interfaces, eliminating the need for coding, design, or technical expertise.

**Q: What happens to my website if thorium90.app shuts down?**
A: This is a valid concern with any AI-native platform. It's similar to using any SaaS platform—ensure you have regular backups and understand the platform's export capabilities. The trade-off is between platform dependency and the significant benefits of speed, cost savings, and ease of use.

**Q: Can I migrate my existing WordPress site to thorium90.app?**
A: Yes, though the process is different from traditional migrations. Instead of importing databases and files, you describe your existing site's structure and content to the AI, which rebuilds it natively. Most small to medium-sized sites can be recreated within hours.

**Q: How does thorium90.app handle SEO compared to WordPress with SEO plugins?**
A: thorium90.app generates semantic HTML5 by default, implements proper meta tags automatically, and creates optimal site structure without requiring plugins. Early results show comparable or better SEO performance than WordPress sites, as evidenced by travissutphin.com's implementation.

**Q: What are the ongoing costs of using thorium90.app?**
A: While specific pricing varies, the total cost of ownership is significantly lower than traditional development. You eliminate agency fees ($5,000-$50,000+), maintenance contracts ($500-$2,000/month), plugin subscriptions ($10-$100/month each), and emergency developer calls ($150-$300/hour).

**Q: Is thorium90.app secure without traditional security plugins?**
A: AI-native platforms have a smaller attack surface than traditional CMS platforms. Without admin panels, plugin vulnerabilities, or database injection points, there are fewer entry points for attacks. However, as with any platform, proper HTTPS implementation and best practices are still essential.

**Q: How does content updates work? Do I need to learn a new interface?**
A: Content updates are conversational. Instead of logging into a CMS, navigating menus, and editing in a block editor, you simply describe what you want changed. For example: "Update the services page to include my new AI automation offering."
```

---

## 9. Template Specifications

### 9.1 Case Study Single Page Template

Should include:
- **Hero Section:** Large title, excerpt, key metrics callout
- **Quick Stats Bar:** Before/after metrics, visual comparison
- **Breadcrumbs:** Home > Case Studies > [Title]
- **Main Content Area:** Full-width for readability
- **Sidebar (optional):** Related case studies, CTA
- **Results Callout Box:** Highlighted metrics with visual elements
- **FAQ Accordion:** Collapsible FAQ section
- **Q&A Section:** If applicable, formatted differently than FAQ
- **CTA Section:** Strong call-to-action (contact, consultation)
- **Related Case Studies:** 3 related studies at bottom
- **Social Sharing:** LinkedIn, Twitter, copy link
- **Schema.org:** All required schema types embedded

### 9.2 Case Study List Page Template

Should include:
- **Hero Section:** Overview of case study portfolio
- **Filters:** By industry, service, result type
- **Search:** Keyword search across case studies
- **Card Grid:** 3-column grid (2-col mobile)
- **Pagination:** If more than 9 case studies
- **CTA Section:** "Want your own success story?"

---

## 10. Quick Reference: Process Roles

| Step | Primary Owner | Support | Output |
|------|--------------|---------|--------|
| Research & Planning | [Cipher] | [Echo] | Outline, keyword research |
| Content Writing | [Cipher] | [Echo] | Full markdown content |
| SEO Optimization | [Bran] | - | Optimized metadata |
| Visual Assets | [Aesthetica] | - | Images, graphics |
| Technical Implementation | [Syntax] | [Aesthetica] | Live case study page |
| QA & Testing | [Verity] | - | Test report |
| Security Review | [Sentinal] | - | Security clearance |
| Pre-Launch Coordination | [Codey] | All | Launch checklist |
| Distribution | [Bran] | [Echo], [Cipher] | Social posts, emails |
| Monitoring & Optimization | [Bran] | [Codey] | Performance reports |

---

## 11. Tools & Resources

### SEO Tools
- **Google Search Console:** Monitor indexing, rich results
- **Google Rich Results Test:** Validate schema markup
- **Screaming Frog:** Technical SEO audit
- **Ahrefs/SEMrush:** Keyword research, competitor analysis

### Schema Tools
- **Schema.org Validator:** Test schema markup
- **Google Rich Results Test:** Preview how case study appears in search
- **JSON-LD Generator:** Create schema markup

### Content Tools
- **Grammarly:** Grammar and readability
- **Hemingway Editor:** Simplify complex sentences
- **Answer The Public:** Find question-based keywords for FAQ

### Image Tools
- **Canva:** Create hero images, graphics
- **TinyPNG/Squoosh:** Optimize images
- **CloudConvert:** Batch convert to WebP

### Analytics Tools
- **Google Analytics 4:** Track traffic, conversions
- **Hotjar:** Heatmaps, scroll depth
- **Microsoft Clarity:** Session recordings

---

## 12. Next Steps for Thorium90 Case Study

### Immediate Actions ([Syntax], [Aesthetica])
1. Add YAML frontmatter to existing case study
2. Create FAQ section with 8 questions
3. Design hero image (1200x630px)
4. Create case-study-single.php template
5. Add routing to index.php
6. Implement all required schema types
7. Test and launch

### Short-term Actions ([MarketingTeam])
1. Create case-study-list.php template
2. Design case studies landing page
3. Add internal links from services page
4. Prepare social media content
5. Submit to search engines

### Long-term Strategy ([Codey])
1. Create 2-3 case studies per quarter
2. Monitor performance and optimize
3. Build case study portfolio
4. Use case studies in sales process
5. Repurpose into other content formats

---

**Process Owner:** [Codey] (TPM)
**Last Updated:** 2025-11-13
**Next Review:** 2026-02-13
