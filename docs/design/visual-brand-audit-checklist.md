# Visual Brand Audit Checklist & Action Plan
**Date**: October 11, 2025
**Owner**: [Aesthetica]
**Timeline**: 5-8 hours (This Week)
**Deliverable**: Brand consistency report + design refinement backlog

---

## 🎯 Audit Objectives

1. **Identify visual inconsistencies** across 8 pages
2. **Document current design patterns** (colors, typography, spacing)
3. **Spot UX issues** that hurt conversion or usability
4. **Create prioritized fix list** for design improvements
5. **Establish design standards** for category pages (Week 3)

---

## 📱 Pages to Audit (8 Total)

- [ ] **Home** (`/`)
- [ ] **Services** (`/services`)
- [ ] **Projects** (`/projects`)
- [ ] **Team** (`/team`)
- [ ] **Blog List** (`/blog`)
- [ ] **Blog Post** (`/blog/[any-post]`)
- [ ] **Contact** (`/contact`)
- [ ] **404** (`/404` - test manually)

**Testing Environments:**
- Desktop (1920x1080)
- Tablet (768x1024)
- Mobile (375x667 - iPhone SE)
- Dark Mode + Light Mode (both)

---

## 🎨 SECTION 1: Color Consistency Audit

### **Brand Colors (Expected)**
From `theme-variables.css`:
```css
--primary-green: #2be256
--dark-green: #005a00
--primary-blue: #3d608f
--light-blue: #8dace1
--dark: #1a1a1a
--gray-dark: #4a4a4a
--gray-light: #f8f9fa
```

### **Audit Checklist**

#### **Primary Brand Colors**
- [ ] Primary green (`#2be256`) - Where is it used?
  - [ ] CTAs/buttons
  - [ ] Links
  - [ ] Accents
  - [ ] Icons
  - **Note any off-brand variations** (e.g., `#2ae255` instead)

- [ ] Primary blue (`#3d608f`) - Where is it used?
  - [ ] Headers
  - [ ] Backgrounds
  - [ ] Gradients
  - [ ] Text accents

#### **Gradient Usage**
- [ ] "gradient-green-blue" - List all instances
  - [ ] Hero sections
  - [ ] CTAs
  - [ ] Backgrounds
  - **Check**: Are gradients consistent direction/opacity?

#### **Background Colors**
- [ ] Light mode backgrounds consistent?
- [ ] Dark mode backgrounds consistent?
- [ ] Card backgrounds match across pages?
- [ ] Section dividers use same colors?

#### **Text Colors**
- [ ] Primary text color consistent (light vs dark mode)?
- [ ] Secondary text color consistent?
- [ ] Link colors consistent?
- [ ] Link hover states consistent?

### **Document Findings**
```
COLOR INCONSISTENCIES FOUND:

Page: [Page Name]
Element: [Button, heading, etc.]
Current: [#hexcode]
Expected: [#hexcode]
Impact: High/Medium/Low
Fix Effort: Easy/Medium/Hard
```

---

## 📝 SECTION 2: Typography Audit

### **Typography Scale (Expected)**
From Tailwind config in `base.php`:
```
text-xs:   0.75rem (12px)
text-sm:   0.875rem (14px)
text-base: 1rem (16px)
text-lg:   1.125rem (18px)
text-xl:   1.25rem (20px)
text-2xl:  1.5rem (24px)
text-3xl:  1.875rem (30px)
text-4xl:  2.25rem (36px)
text-6xl:  3.75rem (60px)
```

### **Audit Checklist**

#### **Headings (H1-H6)**
For each page, document:
- [ ] **H1** (Main page title)
  - Size (desktop/mobile)
  - Weight (font-weight)
  - Color (light/dark mode)
  - Line height

- [ ] **H2** (Section headings)
  - Size (desktop/mobile)
  - Weight
  - Color
  - Spacing (margin-top, margin-bottom)

- [ ] **H3** (Subsection headings)
  - Size
  - Weight
  - Color

#### **Body Text**
- [ ] Base font size consistent? (expect 1rem/16px)
- [ ] Line height comfortable? (1.5-1.75 recommended)
- [ ] Paragraph spacing consistent?
- [ ] Text color contrast passes WCAG AA? (4.5:1 minimum)

#### **Special Text Styles**
- [ ] Links (color, underline, hover state)
- [ ] Buttons (font-size, weight, padding)
- [ ] Labels/tags (size, weight, case - uppercase?)
- [ ] Meta info (dates, reading time - size and color)
- [ ] Quotes/callouts (style, size)

### **Document Findings**
```
TYPOGRAPHY INCONSISTENCIES:

Page: [Page Name]
Element: H2 section heading
Current: text-xl (20px) font-bold
Expected: text-2xl (24px) font-bold
Pages Affected: Home, Services, Blog
Priority: Medium
```

---

## 📐 SECTION 3: Spacing & Layout Audit

### **Audit Checklist**

#### **Section Spacing**
- [ ] Vertical spacing between sections consistent?
  - Expected: `py-16` (4rem top/bottom) or similar
  - Check: Home, Services, Projects, Team, Blog, Contact
  - **Note exceptions**: Hero sections may differ

- [ ] Container max-width consistent?
  - Expected: `max-w-7xl mx-auto` (1280px)
  - Check all pages

#### **Component Padding**
- [ ] Card padding consistent?
  - Expected: `p-6` or `p-8` for cards
  - Check: Blog cards, project cards, team cards

- [ ] Button padding consistent?
  - Expected: `px-4 py-2` or similar
  - Check: Primary CTAs, secondary buttons, link buttons

#### **Grid Layouts**
- [ ] Blog grid: `md:grid-cols-2` consistent?
- [ ] Projects grid: Columns consistent?
- [ ] Team grid: Layout matches other grids?
- [ ] Gap spacing: Consistent across grids? (expect `gap-8` or `gap-6`)

#### **Mobile Responsiveness**
- [ ] Mobile padding sufficient? (minimum `px-4`)
- [ ] Text doesn't touch edges on mobile?
- [ ] Buttons easy to tap? (44px minimum height)
- [ ] Images scale properly?

### **Document Findings**
```
SPACING INCONSISTENCIES:

Issue: Section vertical spacing varies
- Home page: py-16 (64px)
- Services page: py-12 (48px)
- Blog page: py-20 (80px)
Recommendation: Standardize to py-16 for consistency
Priority: Low
```

---

## 🖼️ SECTION 4: Component Consistency Audit

### **Buttons**

#### **Primary CTA Button**
- [ ] Color scheme consistent? (gradient green-blue expected)
- [ ] Size consistent? (padding, font-size)
- [ ] Hover state consistent?
- [ ] Icon usage? (arrows, icons consistent placement?)

#### **Secondary Button**
- [ ] Distinct from primary?
- [ ] Consistent styling across pages?

#### **Link Buttons**
- [ ] "Learn More", "Read More" styled consistently?
- [ ] Underline or no underline? Consistent?

### **Cards**

#### **Blog Post Cards**
- [ ] Thumbnail height consistent? (currently `h-48` on regular, `h-64 md:h-96` on featured)
- [ ] Padding consistent? (currently `p-6`)
- [ ] Border radius consistent? (`rounded-lg`)
- [ ] Shadow consistent? (`shadow-md` vs `shadow-lg`)
- [ ] Hover effect? (shadow, transform, etc.)

#### **Project Cards**
- [ ] Match blog card styling?
- [ ] Consistent layout structure?

#### **Team Cards**
- [ ] Match other card styles?
- [ ] Photo styling consistent?

### **Forms**

#### **Contact Form** (if exists)
- [ ] Input field styling (border, padding, border-radius)
- [ ] Label styling (size, color, weight)
- [ ] Error state styling
- [ ] Focus state (outline color)
- [ ] Submit button matches primary CTA style?

### **Navigation**

#### **Header/Top Nav**
- [ ] Logo size consistent on all pages?
- [ ] Nav link styling (size, weight, color, hover)
- [ ] Mobile menu (hamburger icon, menu slide-in)
- [ ] Active page indicator?

#### **Bottom Nav (Mobile)**
- [ ] Icon sizes consistent?
- [ ] Label text size?
- [ ] Active state clear?
- [ ] Easy to reach with thumb?

#### **Breadcrumbs** (if exists)
- [ ] Styling consistent?
- [ ] Separator icon/character?
- [ ] Link vs non-link styling?

### **Document Findings**
```
COMPONENT INCONSISTENCIES:

Component: Blog cards
Issue: Featured card has shadow-2xl, regular cards have shadow-md
Question: Intentional hierarchy or inconsistency?
Recommendation: Document as intentional design pattern
Priority: Low (document only)
```

---

## 🎯 SECTION 5: Call-to-Action (CTA) Audit

### **Primary CTA per Page**
For each page, identify the PRIMARY action you want users to take:

- [ ] **Home Page**
  - Current primary CTA: _________________
  - Placement: _________________
  - Visibility: High/Medium/Low
  - Is it obvious? Yes/No

- [ ] **Services Page**
  - Current primary CTA: _________________
  - Placement: _________________
  - Does it match service offering? Yes/No

- [ ] **Projects Page**
  - Current primary CTA: _________________
  - Purpose: _________________

- [ ] **Team Page**
  - Current primary CTA: _________________
  - Purpose: _________________

- [ ] **Blog List**
  - Current primary CTA: _________________
  - Should there be one? Yes/No

- [ ] **Blog Post**
  - Current primary CTA: _________________
  - Placement: Top/Middle/Bottom/Sidebar

- [ ] **Contact Page**
  - Current primary CTA: _________________
  - Is form the CTA or something else?

### **CTA Clarity Questions**
- [ ] Can you tell within 3 seconds what the main action is on each page?
- [ ] Are CTAs repeated? (e.g., contact button in header + footer + page)
- [ ] Do CTAs have clear value propositions? ("Get Started" vs "Schedule Free Consultation")
- [ ] Are secondary CTAs competing with primary? (too many options = analysis paralysis)

### **Document Findings**
```
CTA ISSUES:

Page: Home
Issue: No clear primary CTA visible above the fold
Current: Multiple equal-weight CTAs (Services, Projects, Contact)
Recommendation: Single prominent "Book a Free Consultation" CTA in hero
Priority: HIGH (conversion impact)
```

---

## 🖥️ SECTION 6: Mobile UX Audit

### **Testing Instructions**
1. Use Chrome DevTools device emulation
2. Test on iPhone SE (375x667) - smallest common size
3. Test on iPad (768x1024)
4. Test actual device if available

### **Audit Checklist**

#### **Touch Targets**
- [ ] All buttons minimum 44x44px? (Apple HIG standard)
- [ ] Sufficient spacing between tappable elements? (8px minimum)
- [ ] Bottom nav easy to reach? (within thumb zone?)

#### **Text Readability**
- [ ] Minimum font size 14px on mobile?
- [ ] Line length comfortable? (45-75 characters ideal)
- [ ] Sufficient contrast? (especially in dark mode)
- [ ] No horizontal scrolling?

#### **Images & Media**
- [ ] Images scale properly on mobile?
- [ ] Blog post images don't overflow?
- [ ] Hero images not cut off awkwardly?
- [ ] Icons legible at mobile size?

#### **Forms (Contact Page)**
- [ ] Input fields full width on mobile?
- [ ] Labels above inputs (not side-by-side)?
- [ ] Keyboard doesn't hide submit button?
- [ ] Appropriate input types? (email, tel, etc.)

#### **Navigation**
- [ ] Mobile menu easy to open?
- [ ] Menu items easy to tap?
- [ ] Bottom nav visible/fixed?
- [ ] No overlapping elements?

#### **Performance**
- [ ] Page loads fast on mobile? (test with throttling)
- [ ] Images lazy-loading?
- [ ] Smooth scrolling?
- [ ] No layout shift on load?

### **Document Findings**
```
MOBILE UX ISSUES:

Issue: Blog post images too large on mobile
Page: Blog list
Current: Images are 250KB+ each
Impact: Slow load time on mobile (4G)
Recommendation: Optimize images, serve smaller sizes on mobile
Priority: HIGH (affects SEO Core Web Vitals)
```

---

## 🌗 SECTION 7: Dark/Light Mode Audit

### **Theme Toggle**
- [ ] Toggle visible and accessible on all pages?
- [ ] Toggle state persists across pages?
- [ ] Toggle icon clear (sun/moon)?
- [ ] Toggle easy to find?

### **Color Contrast (Both Modes)**

#### **Light Mode**
- [ ] Text readable on all backgrounds? (4.5:1 minimum for body, 3:1 for headings)
- [ ] Links distinguishable from body text?
- [ ] Buttons have sufficient contrast?
- [ ] Form inputs have visible borders?

#### **Dark Mode**
- [ ] Background not pure black? (use dark gray for better readability)
- [ ] Text not pure white? (use off-white to reduce eye strain)
- [ ] Colors adjusted for dark backgrounds? (may need brighter versions)
- [ ] Images don't look washed out?

### **Component Theming**
For each page, verify in BOTH modes:
- [ ] Cards have visible borders/shadows?
- [ ] Input fields visible?
- [ ] Buttons contrast properly?
- [ ] Gradients work in dark mode?
- [ ] Code blocks (if any) readable?

### **Document Findings**
```
DARK MODE ISSUES:

Issue: Blog card meta text (date/time) low contrast in dark mode
Current: Using text-gray-dark (fixed color)
Expected: Should use text-theme-primary dark:text-white
Pages: Blog list (just fixed today! ✅)
Status: RESOLVED
```

---

## 🔍 SECTION 8: Accessibility Quick Check

### **Keyboard Navigation**
- [ ] Can tab through all interactive elements?
- [ ] Tab order logical?
- [ ] Focus indicator visible? (outline on focused elements)
- [ ] Can navigate without mouse?

### **Semantic HTML**
- [ ] Headings in logical order? (H1 → H2 → H3, no skipping)
- [ ] Links have descriptive text? (not "click here")
- [ ] Images have alt text?
- [ ] Forms have labels properly associated?

### **ARIA Labels**
- [ ] Icon buttons have aria-labels? (e.g., theme toggle, menu button)
- [ ] Navigation has aria landmarks?
- [ ] Skip to content link for keyboard users?

### **Color Contrast Tool**
Use WebAIM Contrast Checker (https://webaim.org/resources/contrastchecker/)

Test these combinations:
- [ ] Body text on background (both modes)
- [ ] Headings on background (both modes)
- [ ] Link text on background
- [ ] Button text on button background
- [ ] Meta text (dates, tags) on background

### **Document Findings**
```
ACCESSIBILITY ISSUES:

Issue: Theme toggle missing aria-label
Current: Just icon, no label
Recommendation: Add aria-label="Toggle dark mode"
Priority: Medium (accessibility)
```

---

## 📊 SECTION 9: Performance Quick Check

### **Image Optimization**
- [ ] Blog images properly sized? (1200x630 for OG, smaller for cards)
- [ ] Images compressed? (use TinyPNG, ImageOptim, etc.)
- [ ] Format appropriate? (PNG for graphics, JPG for photos, WebP for modern browsers)
- [ ] Lazy loading implemented?

### **CSS Performance**
- [ ] CSS files reasonably sized? (check file sizes - blog-sections.css = 15KB)
- [ ] Unused CSS? (Chrome DevTools → Coverage tab)
- [ ] Critical CSS inline? (for above-the-fold content)

### **Core Web Vitals** (Quick Test)
Use PageSpeed Insights or Chrome DevTools Lighthouse:
- [ ] LCP (Largest Contentful Paint): < 2.5s
- [ ] FID (First Input Delay): < 100ms
- [ ] CLS (Cumulative Layout Shift): < 0.1

### **Document Findings**
```
PERFORMANCE ISSUES:

Issue: Blog images 2-3x larger after recent update
Files: 10 blog post PNGs increased from 100KB to 250KB+
Impact: Slower mobile load, affects Core Web Vitals
Recommendation: Re-optimize images with compression
Priority: HIGH (affects SEO)
```

---

## 📝 SECTION 10: Deliverable - Findings Report

### **Template for Final Report**

```markdown
# Visual Brand Audit Report
**Date**: [Date]
**Audited By**: [Aesthetica]
**Pages Reviewed**: 8 pages (Home, Services, Projects, Team, Blog, Blog Post, Contact, 404)
**Modes Tested**: Light + Dark, Desktop + Tablet + Mobile

---

## Executive Summary
[2-3 sentences: Overall assessment, major findings, recommended next steps]

---

## Critical Issues (Fix Before Category Pages Launch)
| Priority | Issue | Pages Affected | Impact | Effort |
|----------|-------|----------------|--------|--------|
| 🔴 HIGH | Blog images not optimized | Blog List | SEO/Performance | 2h |
| 🔴 HIGH | No clear primary CTA | Home | Conversion | 3h |
| 🔴 HIGH | Mobile touch targets too small | Contact Form | UX | 1h |

**Total Effort**: [X hours]

---

## Medium Priority Issues (Can Wait Until After Taxonomy)
| Priority | Issue | Pages Affected | Impact | Effort |
|----------|-------|----------------|--------|--------|
| 🟡 MED | Section spacing inconsistent | All pages | Visual polish | 2h |
| 🟡 MED | Card shadows vary | Blog, Projects | Consistency | 1h |

**Total Effort**: [X hours]

---

## Low Priority (Nice to Have)
| Priority | Issue | Pages Affected | Impact | Effort |
|----------|-------|----------------|--------|--------|
| 🟢 LOW | Typography scale not perfectly consistent | Multiple | Minor | 3h |

---

## Design Patterns Documented (Keep These)
[List of intentional design decisions that may look inconsistent but are purposeful]

- Featured blog card uses larger shadow (shadow-2xl vs shadow-md) - INTENTIONAL hierarchy
- Hero sections have larger padding (py-20) vs regular sections (py-16) - INTENTIONAL emphasis

---

## Recommendations for Category Pages (Week 3)
Based on this audit, here's what to keep in mind when designing category pages:

1. **Use consistent card styling** from blog list page
2. **Primary CTA should be clear** (subscribe? contact? read?)
3. **Mobile-first design** (ensure touch targets 44px minimum)
4. **Dark mode from start** (don't retrofit)
5. **Image optimization** (compress before upload)

---

## Design Standards Established
[Document the patterns found that should be maintained]

### Colors
- Primary CTA: gradient-green-blue
- Secondary CTA: [to be defined]
- Card backgrounds: bg-white (light), bg-theme-card (dark)

### Typography
- H1: text-4xl md:text-6xl font-bold
- H2: text-2xl md:text-3xl font-bold
- H3: text-xl font-bold
- Body: text-base (16px)

### Spacing
- Section padding: py-16
- Card padding: p-6 or p-8
- Grid gap: gap-8

### Components
- Cards: rounded-lg shadow-md hover:shadow-lg
- Buttons: px-4 py-2 rounded-lg
- Images: rounded-lg with hover:scale-105 transition

---

## Next Steps
1. [Priority] Optimize blog images (2 hours)
2. [Priority] Define primary CTAs for each page (1 hour)
3. [Priority] Fix mobile touch targets (1 hour)
4. [Week 3] Design category landing pages using established patterns
```

---

## ✅ Action Plan for [Aesthetica]

### **Day 1 (2-3 hours): Initial Audit**
1. Review all 8 pages in both light and dark mode
2. Take screenshots of any inconsistencies
3. Complete Sections 1-4 (Color, Typography, Spacing, Components)

### **Day 2 (2-3 hours): UX & Performance**
4. Complete Sections 5-7 (CTA, Mobile UX, Dark Mode)
5. Run PageSpeed Insights on key pages
6. Test keyboard navigation

### **Day 3 (1-2 hours): Report & Recommendations**
7. Complete Section 8-9 (Accessibility, Performance)
8. Compile findings into final report
9. Create prioritized fix list
10. Share with [Travis] for review

---

## 🎯 Success Criteria

By end of this audit, you should have:
- [ ] Clear documentation of current design patterns
- [ ] List of critical issues (fix before category pages)
- [ ] List of medium/low priority issues (backlog)
- [ ] Design standards for category page work (Week 3)
- [ ] Prioritized fix list with effort estimates

---

## 📁 Where to Save Work

**Screenshots**: `/docs/design/audit-screenshots/[page-name]/`
**Final Report**: `/docs/design/visual-brand-audit-report-2025-10-11.md`
**Fix Backlog**: `/docs/design/design-backlog.md` (link to Kanban if using)

---

**Questions?** Tag [Travis] or [Syntax] if you need clarification on any technical aspects.

**Ready to start?** Begin with the **Home page** in **light mode on desktop** to establish baseline patterns, then compare other pages against it.
