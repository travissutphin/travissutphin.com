# Visual Brand Audit - Quick Start Guide
**For**: [Aesthetica]
**Time**: Start NOW (5-8 hours this week)
**Goal**: Identify critical issues before category page designs (Week 3)

---

## 🚀 Start Here (15 minutes)

### **1. Open the Site**
Local: `http://localhost/travissutphin.com/public/`

### **2. Quick Visual Sweep**
Visit these pages and take 2 minutes on each to get a feel:
- Home (/)
- Services (/services)
- Projects (/projects)
- Blog (/blog)
- Blog Post (click any post)
- Contact (/contact)

**First Impression Questions:**
- Does everything feel visually connected?
- Are there obvious inconsistencies that jump out?
- Is it clear what you're supposed to do on each page?
- Does dark mode look intentional or like an afterthought?

---

## 🎯 Priority Focus Areas (Do These First)

### **HIGH PRIORITY #1: Mobile Image Performance** ⚠️
**Why**: Affects SEO (Core Web Vitals) and user experience

**Check:**
1. Go to Blog page (`/blog`)
2. Open Chrome DevTools → Network tab
3. Filter by Images
4. Refresh page
5. Look at blog post image sizes

**What to Look For:**
- Are images 250KB+? (TOO LARGE)
- Should be <100KB for thumbnails
- Recent update increased image sizes 2-3x

**Document:**
```
Issue: Blog images not optimized
Current Size: [X KB]
Target Size: <100KB
Impact: HIGH (SEO + mobile performance)
```

---

### **HIGH PRIORITY #2: Call-to-Action Clarity** ⚠️
**Why**: Affects conversion rate (business impact)

**Check Each Page:**
For Home, Services, Projects, Team, Blog, Contact:

**Questions:**
- Within 3 seconds, what's the MAIN action I should take?
- Is there a clear primary button/CTA?
- Are there too many equal-priority CTAs competing?

**Document:**
```
Page: Home
Primary CTA: [What is it? Or "UNCLEAR"]
Visibility: High/Medium/Low
Recommendation: [What should it be?]
```

---

### **HIGH PRIORITY #3: Mobile Touch Targets** ⚠️
**Why**: Usability (especially important for category page designs)

**Check:**
1. Open Chrome DevTools
2. Device mode: iPhone SE (375x667)
3. Test Contact page form
4. Test Blog page cards
5. Test bottom navigation

**Questions:**
- Can you easily tap buttons? (minimum 44x44px)
- Do buttons feel cramped?
- Any accidental taps?

**Document:**
```
Page: Contact
Element: Submit button
Current Size: [Width x Height]
Too Small: Yes/No
Fix: Increase padding to py-3 px-6
```

---

## 📋 Detailed Audit Sections (Do After Priority Checks)

Once you've tackled the 3 high-priority items above, work through the full checklist in this order:

### **Day 1 Session (2-3 hours)**
1. **Color Consistency** (Section 1 in main checklist)
   - Document which colors are used where
   - Note any off-brand color variations
   - Check gradient consistency

2. **Typography** (Section 2)
   - Check heading sizes across pages
   - Verify font weights consistent
   - Test dark mode text contrast

3. **Spacing & Layout** (Section 3)
   - Measure section padding (use DevTools)
   - Check grid gaps consistent
   - Verify mobile padding sufficient

---

### **Day 2 Session (2-3 hours)**
4. **Component Consistency** (Section 4)
   - Compare button styles across pages
   - Check card styling (blog vs projects)
   - Review form styling

5. **Mobile UX** (Section 6)
   - Test all pages on mobile size
   - Check touch targets
   - Verify no horizontal scroll

6. **Dark/Light Mode** (Section 7)
   - Toggle on each page
   - Check text contrast both modes
   - Verify all components work in dark

---

### **Day 3 Session (1-2 hours)**
7. **Compile Report**
   - Use template from main checklist (Section 10)
   - Prioritize: Critical (red) → Medium (yellow) → Low (green)
   - Add effort estimates (hours)
   - Share with [Travis]

---

## 📸 Screenshot Guide

**When to Take Screenshots:**
- Found an inconsistency? → Screenshot it
- Found something good? → Screenshot it (so we can replicate)
- Unsure if something is intentional? → Screenshot it

**How to Organize:**
Save to: `/docs/design/audit-screenshots/[page-name]/`

**Naming:**
- `issue-[description].png` (e.g., `issue-button-size-mismatch.png`)
- `good-[description].png` (e.g., `good-card-hover-effect.png`)
- Include page name and mode if relevant: `home-dark-mode-contrast-issue.png`

---

## 🎨 Design Standards to Document

As you audit, document these patterns:

### **Colors We're Using**
```
Primary CTA: gradient-green-blue (#2be256 → #3d608f)
Secondary CTA: [to be determined]
Card Background (light): bg-white
Card Background (dark): [what is it?]
```

### **Typography Scale**
```
H1: text-4xl md:text-6xl (desktop) font-bold
H2: text-2xl md:text-3xl font-bold
H3: [what are we using?]
Body: text-base (16px)
Small: [what for meta info?]
```

### **Spacing Standards**
```
Section vertical: py-16 (64px)
Card padding: p-6 or p-8
Grid gap: gap-8
Button padding: [what are we using?]
```

### **Component Patterns**
```
Cards: rounded-lg shadow-md
Buttons: [what?]
Hover effects: [what?]
Transitions: [duration?]
```

---

## ⚠️ What to Look Out For

### **Common Inconsistencies to Watch For:**

**Colors:**
- ✅ Is `#2be256` used everywhere or do some use `#2ae255`?
- ✅ Is the gradient always the same direction?
- ✅ Do link colors match across pages?

**Typography:**
- ✅ Are H2s always the same size on every page?
- ✅ Is body text always 16px or does it vary?
- ✅ Are font weights consistent? (bold = 700, semibold = 600)

**Spacing:**
- ✅ Do all sections use py-16 or do some use py-12/py-20?
- ✅ Are card paddings always p-6 or do they vary?
- ✅ Is grid gap always gap-8?

**Components:**
- ✅ Do all cards use rounded-lg or do some use rounded-xl?
- ✅ Are shadows consistent? (shadow-md vs shadow-lg)
- ✅ Do all buttons have the same padding?

---

## 💡 Tips for Efficiency

### **Use Browser DevTools**
- **Inspect Element** to see exact CSS values
- **Device Mode** for mobile testing
- **Network Tab** for performance checking
- **Coverage Tab** to find unused CSS

### **Use Color Picker**
- Browser extensions like "ColorZilla"
- Or DevTools → Inspect → Color swatch
- Compare hex codes to brand colors

### **Use Rulers/Guides**
- Chrome extension "Page Ruler" for measuring
- Or DevTools → Inspect → Box model shows padding/margin

### **Take Notes As You Go**
- Don't try to remember everything
- Use the template in Section 10 as you find issues
- Mark priority (High/Med/Low) immediately

---

## ✅ End-of-Audit Checklist

Before you submit your report, make sure you have:

- [ ] Checked all 8 pages (Home, Services, Projects, Team, Blog List, Blog Post, Contact, 404)
- [ ] Tested both light AND dark mode on each page
- [ ] Tested desktop, tablet, AND mobile sizes
- [ ] Documented at least 3-5 critical issues
- [ ] Estimated fix effort for critical issues
- [ ] Taken screenshots of major issues
- [ ] Documented design patterns to maintain
- [ ] Created recommendations for category pages (Week 3)
- [ ] Prioritized issues: Critical → Medium → Low

---

## 📊 Expected Deliverables

At the end of this audit, you'll have:

1. **Visual Brand Audit Report**
   - Location: `/docs/design/visual-brand-audit-report-2025-10-11.md`
   - Format: Use template from Section 10 of main checklist

2. **Screenshots Folder**
   - Location: `/docs/design/audit-screenshots/`
   - Organized by page name

3. **Prioritized Fix List**
   - Critical issues (fix before category pages)
   - Medium priority (after taxonomy)
   - Low priority (backlog)

4. **Design Standards Doc**
   - Colors, typography, spacing to maintain
   - Reference for category page designs

---

## 🤝 Who to Ask for Help

**Color/Brand Questions**: [Travis] (brand vision)
**Technical CSS Questions**: [Syntax] (implementation)
**UX/Conversion Questions**: [Cipher] (StoryBrand positioning)
**SEO Impact Questions**: [Bran] (SEO/AEO strategy)

---

## 🎯 Success = Ready for Category Page Design

The goal of this audit is to prepare for **Week 3: Category Page Designs**.

By completing this audit, you'll:
- ✅ Know what design patterns to use (consistency)
- ✅ Know what issues to avoid (don't repeat mistakes)
- ✅ Have clear brand standards (colors, typography, spacing)
- ✅ Understand mobile requirements (touch targets, performance)

**When you're done with this audit, you'll be ready to design 6 beautiful, consistent category landing pages that integrate seamlessly with the existing site.**

---

## 🚀 Ready? Start Now!

1. Open: `http://localhost/travissutphin.com/public/`
2. Start with: **HIGH PRIORITY #1** (Mobile image performance)
3. Work through: The 3 priority checks (30 minutes)
4. Then: Full audit sections (4-6 hours)
5. Finally: Compile report (1 hour)

**Timeline**: Complete by end of week (before category page designs needed)

**Questions?** Check the full checklist at:
`/docs/design/visual-brand-audit-checklist.md`

---

**Good luck, [Aesthetica]! This audit will set the foundation for all future design work. 🎨**
