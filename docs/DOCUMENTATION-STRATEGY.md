# Documentation Strategy & Organization Plan
**Created by**: [Codey] (TPM)
**Date**: October 11, 2025
**Status**: 🟡 PROPOSAL - Awaiting [Travis] Approval
**Purpose**: Solve documentation discoverability and maintenance problems

---

## 📋 Problem Statement

**Current State (Audit Results):**
- **39 markdown files** across 13 directories
- **12 HTML files** (mix of kanban boards and blog drafts)
- **README.md outdated** (last updated Sep 27, only lists 6 of 39 docs)
- **No clear hierarchy** (what's authoritative vs reference vs archived?)
- **Discovery problem**: Team members don't know what exists or when to use it

**Example Failure Scenario:**
```
[Echo] needs to create a blog post
→ Doesn't know BLOG-CREATION-GUIDE.md exists
→ Creates inconsistent post
→ Wastes time redoing work
→ Process not followed
```

**Root Causes:**
1. **No central index** - README doesn't list all docs
2. **No lifecycle management** - Old docs mixed with current
3. **No role-based navigation** - "I'm a developer, where do I start?"
4. **No task-based navigation** - "I need to deploy, where do I go?"
5. **No ownership tracking** - Unclear who maintains each doc

---

## 🎯 Proposed Solution

### Principle 1: Single Entry Point
**Master README serves as the central hub for all documentation**
- Every team member lands here first
- Clear navigation by role and task
- Status indicators (current/review needed/deprecated)

### Principle 2: Clear Document Taxonomy
**Four document types with distinct purposes:**

| Type | Purpose | Location | Example | Owner |
|------|---------|----------|---------|-------|
| **AUTHORITATIVE** | Single source of truth, follow this | `/processes/` | BLOG-CREATION-GUIDE.md | [Echo] |
| **REFERENCE** | Standards, best practices, lookup | `/design/`, `/architecture/` | visual-brand-audit-report.md | [Aesthetica] |
| **PLANNING** | Strategy docs, roadmaps, proposals | `/content-strategy/`, `/marketing/` | blog-taxonomy-seo-plan.md | [Bran] |
| **ARCHIVE** | Historical, one-time migrations | `/archive/` | tsp-012-*.md | [Flow] |

### Principle 3: Role-Based Entry Points
**Different team members need different starting points:**

```markdown
## 👤 Start Here Based on Your Role

**[Echo] - Content Strategist:**
→ [BLOG-CREATION-GUIDE.md](processes/BLOG-CREATION-GUIDE.md) ⭐ START HERE
→ [Blog Taxonomy](content-strategy/tag-master-list.md)
→ [SEO Strategy](content-strategy/blog-taxonomy-seo-plan.md)

**[Aesthetica] - Designer:**
→ [Visual Brand Audit](design/visual-brand-audit-report-2025-10-11.md) ⭐ START HERE
→ [Design Standards](design/visual-brand-audit-report-2025-10-11.md#design-standards)
→ [Aesthetica Start Guide](design/AESTHETICA-START-HERE.md)

**[Syntax] - Developer:**
→ [System Overview](architecture/system-overview.md) ⭐ START HERE
→ [Development Workflow](processes/development-workflow.md)
→ [Deployment Guide](deployment/deployment-guide.md)
```

### Principle 4: Task-Based Quick Links
**"I need to..." shortcuts:**

```markdown
## 🔧 Quick Task Index

**"I need to create a blog post"**
→ [BLOG-CREATION-GUIDE.md](processes/BLOG-CREATION-GUIDE.md) (complete guide)
→ [Image Optimization](processes/blog-image-optimization-guide.md) (images)
→ [Tag Master List](content-strategy/tag-master-list.md) (taxonomy)

**"I need to deploy to production"**
→ [Deployment Guide](deployment/deployment-guide.md) (Railway auto-deploy)
→ [Docker Quickstart](deployment/DOCKER-QUICKSTART.md) (if needed)

**"I need design standards"**
→ [Visual Audit Report](design/visual-brand-audit-report-2025-10-11.md) (authoritative)
→ [Quick Audit Guide](design/QUICK-START-AUDIT.md) (checklist)
```

### Principle 5: Lifecycle Management
**Every document has a status badge:**

| Badge | Meaning | Action Required |
|-------|---------|-----------------|
| 🟢 **CURRENT** | Up-to-date, use this | None - trust and use |
| 🟡 **REVIEW** | May be outdated, verify first | Review by [Owner] |
| 🔴 **DEPRECATED** | Don't use, kept for reference | Move to `/archive/` |
| ⭐ **AUTHORITATIVE** | Single source of truth | Follow this exactly |

**Example Header:**
```markdown
# Blog Creation Guide
**Status**: 🟢 CURRENT ⭐ AUTHORITATIVE
**Owner**: [Echo]
**Last Updated**: October 11, 2025
**Next Review**: January 11, 2026 (quarterly)
```

---

## 📁 Proposed Directory Reorganization

### Current Structure (Messy):
```
/docs/
├── 13 directories (unclear organization)
├── 39+ markdown files (no clear hierarchy)
├── 12 HTML files (mix of kanban + blog drafts)
├── README.md (outdated, incomplete)
```

### Proposed Structure (Clean):
```
/docs/
├── README.md ⭐ MASTER INDEX (start here)
├── QUICK-START.md 🆕 New team member onboarding
├── DOCUMENTATION-STRATEGY.md (this document)
│
├── /processes/ (AUTHORITATIVE - how to do things)
│   ├── BLOG-CREATION-GUIDE.md ⭐ (single source of truth)
│   ├── blog-image-optimization-guide.md
│   ├── development-workflow.md
│   ├── security-standards.md
│   └── team-structure.md
│
├── /architecture/ (REFERENCE - system design)
│   └── system-overview.md
│
├── /design/ (REFERENCE - UI/UX standards)
│   ├── visual-brand-audit-report-2025-10-11.md ⭐ (authoritative)
│   ├── AESTHETICA-START-HERE.md
│   ├── QUICK-START-AUDIT.md
│   ├── visual-brand-audit-checklist.md
│   └── AESTHETICA-COORDINATION-STATUS.md
│
├── /content-strategy/ (PLANNING - SEO, taxonomy)
│   ├── blog-taxonomy-seo-plan.md ⭐ (8-week strategy)
│   ├── tag-master-list.md ⭐ (approved categories/tags)
│   ├── post-taxonomy-migration.md
│   └── ui-design-assessment-priorities.md
│
├── /deployment/ (REFERENCE - DevOps procedures)
│   ├── deployment-guide.md ⭐ (how to deploy)
│   ├── DOCKER-QUICKSTART.md
│   └── deployment-history.md
│
├── /marketing/ (PLANNING - campaigns, messaging)
│   ├── storybrand-framework.md
│   ├── 2025-09-26-kickstand-launch-social-campaign.md
│   └── 2025-09-26-ai-as-your-team-campaign.md
│
├── /testing/ (REFERENCE - QA procedures)
│   ├── regression-tests.md
│   └── unit-tests.md
│
├── /technical/ (REFERENCE - technical guides)
│   └── schema-org-read-aloud-fix.md
│
├── /workflows/ (REFERENCE - Git, automation)
│   ├── git-workflow.md
│   └── deployment.md
│
├── /kanban/ 🆕 (PROJECT MANAGEMENT - boards)
│   ├── kanban_dev.html ⭐ (current development board)
│   ├── kanban_content.html (content calendar)
│   └── README.md (which board for what purpose)
│
├── /sessions/ 🆕 (SESSION SUMMARIES - historical)
│   └── 2025-10-11-taxonomy-and-audit.md
│
└── /archive/ 🆕 (DEPRECATED - old docs)
    ├── /deployment-migrations/
    │   ├── tsp-012-railway-deployment-plan.md
    │   ├── tsp-012-railway-deployment-status.md
    │   └── ... (8 other tsp-012 docs)
    ├── /features/
    │   ├── dark-mode-plan.md
    │   └── dark-mode-report.md
    └── /blog-drafts/ (old HTML blog posts from project-phases)
```

---

## 🔄 Implementation Plan

### Phase 1: Quick Wins (1 hour)
**[Codey] executes:**
1. Create new `/archive/` directory
2. Move deprecated docs:
   - All `tsp-012-*.md` files (one-time Railway migration)
   - `/docs/features/` → `/docs/archive/features/` (dark mode already implemented)
   - `/docs/project-phases/*.html` → `/docs/archive/blog-drafts/` (old blog posts)
   - `/docs/blog/` → `/docs/archive/blog-drafts/` (blog summaries not needed)
3. Create `/kanban/` directory and move boards
4. Create `/sessions/` directory for session summaries
5. Move `SESSION-SUMMARY-2025-10-11.md` → `/sessions/`

### Phase 2: Create Master Index (1-2 hours)
**[Codey] creates:**
1. **New README.md** with:
   - Role-based navigation
   - Task-based quick links
   - Status indicators for all docs
   - Last updated dates
   - Owner assignments

2. **QUICK-START.md** for new team members:
   ```markdown
   # Quick Start Guide for New Team Members

   ## Your First 30 Minutes
   1. Read this entire document (5 min)
   2. Read your role-specific start guide (10 min)
   3. Review the kanban board (5 min)
   4. Check current sprint goals (5 min)
   5. Ask [Codey] any questions (5 min)

   ## Role-Specific Start Guides
   [Links to role guides...]
   ```

### Phase 3: Add Status Headers (30 min)
**[Codey] adds to top of each active doc:**
```markdown
# Document Title
**Status**: 🟢 CURRENT ⭐ AUTHORITATIVE
**Owner**: [TeamMember]
**Last Updated**: YYYY-MM-DD
**Next Review**: YYYY-MM-DD
```

### Phase 4: Audit & Cleanup (1 hour)
**[Team] reviews together:**
1. [Codey] presents new structure
2. Each team member verifies their "start here" docs
3. Identify any missing critical documentation
4. Mark any docs for deprecation

---

## 📋 Ongoing Maintenance

### Monthly Review (15 min)
**[Codey] checks:**
- [ ] README.md lists all active docs
- [ ] Status badges are accurate
- [ ] No docs past "Next Review" date
- [ ] Archive folder not getting too large

### Quarterly Deep Audit (1 hour)
**[Team] together:**
- [ ] Review all AUTHORITATIVE docs
- [ ] Update any changed processes
- [ ] Archive unused docs
- [ ] Create new docs for new processes

### When to Create New Docs
**Decision Matrix:**

| Scenario | Action | Type | Location |
|----------|--------|------|----------|
| "How do I do X?" gets asked 3+ times | Create guide | AUTHORITATIVE | `/processes/` |
| Design standards need documenting | Create reference | REFERENCE | `/design/` |
| Planning new feature/strategy | Create plan | PLANNING | `/content-strategy/` |
| One-time migration/fix | Create log | ARCHIVE | `/archive/` |

---

## 🎯 Success Metrics

### Quantitative:
- **Discovery time**: <2 min to find right doc (vs current ~10+ min)
- **Outdated docs**: 0 docs past review date
- **README accuracy**: 100% of active docs listed
- **Team awareness**: 100% of team knows where to start

### Qualitative:
- ✅ New team member can onboard from docs alone
- ✅ No duplicate "how-to" guides created
- ✅ Team confidently references docs in daily work
- ✅ No questions like "Where's the X guide?"

---

## 🚀 Rollout Plan

### Week 1 (This Week):
**[Codey] executes Phases 1-3:**
- [ ] Reorganize directories (archive old docs)
- [ ] Create master README.md
- [ ] Create QUICK-START.md
- [ ] Add status headers to all active docs
- [ ] Commit and push changes

**[Team] reviews:**
- [ ] Each member verifies their role-specific docs
- [ ] Feedback on structure
- [ ] Identify missing docs

### Week 2:
**[Codey] iterates based on feedback:**
- [ ] Create any missing critical docs
- [ ] Refine README.md navigation
- [ ] Train team on new structure

### Week 3+:
**[Team] adopts new process:**
- [ ] All new docs follow structure
- [ ] Use status badges
- [ ] Update README.md when adding docs
- [ ] Monthly maintenance checks

---

## 📖 Example: How This Solves the Blog Guide Problem

**Current State (Problem):**
```
[Echo] needs to create a blog post
→ No idea where to start
→ Searches /docs/ folder randomly
→ Finds 39 files, unsure which is right
→ Might find "blog-image-optimization-guide.md" but misses "BLOG-CREATION-GUIDE.md"
→ Creates inconsistent post
```

**Future State (Solution):**
```
[Echo] needs to create a blog post
→ Opens /docs/README.md (knows to start here)
→ Sees "👤 Start Here - [Echo] Content Strategist"
→ First link: "BLOG-CREATION-GUIDE.md ⭐ START HERE"
→ Opens guide, sees 🟢 CURRENT ⭐ AUTHORITATIVE badge
→ Follows complete 7-step process
→ Creates consistent, optimized post
```

**Or, Task-Based:**
```
[Echo] needs to create a blog post
→ Opens /docs/README.md
→ Sees "🔧 Quick Task Index"
→ Finds: "I need to create a blog post"
→ Links to BLOG-CREATION-GUIDE.md
→ Done in 30 seconds
```

---

## ❓ Questions for [Travis]

Before implementing, need your decisions on:

1. **Archive Strategy**: Should we keep `/archive/` in the repo or move to separate archive repo?
   - **Recommendation**: Keep in repo but out of sight (folder structure)

2. **Review Frequency**: Monthly too often? Quarterly too rare?
   - **Recommendation**: Monthly quick check (15 min), Quarterly deep audit (1 hour)

3. **Who Owns README.md?**: [Codey] maintains or shared responsibility?
   - **Recommendation**: [Codey] owns, team contributes via pull requests

4. **Session Summaries**: Keep all in `/sessions/` or just keep most recent?
   - **Recommendation**: Keep last 3 months, archive older ones

5. **Approval Process**: Does this need team vote or [Travis] approval to proceed?
   - **Recommendation**: [Travis] approves, [Codey] implements, team reviews

---

## 📋 Implementation Checklist

**Phase 1: Reorganization (1 hour)**
- [ ] Create `/archive/` directory structure
- [ ] Move 15+ deprecated docs to archive
- [ ] Create `/kanban/` and move boards
- [ ] Create `/sessions/` and move summaries
- [ ] Update README.md to reflect new structure

**Phase 2: Master Index (1-2 hours)**
- [ ] Write comprehensive README.md
- [ ] Add role-based navigation
- [ ] Add task-based quick links
- [ ] Create QUICK-START.md
- [ ] Create `/kanban/README.md` (which board for what)

**Phase 3: Status Headers (30 min)**
- [ ] Add headers to all 20+ active docs
- [ ] Assign owners to each doc
- [ ] Set review dates (quarterly for authoritative)

**Phase 4: Team Review (1 hour meeting)**
- [ ] Present new structure to [Team]
- [ ] Each role validates their start docs
- [ ] Gather feedback
- [ ] Identify missing docs

**Phase 5: Launch (commit + deploy)**
- [ ] Commit all changes
- [ ] Push to GitHub
- [ ] Announce in team meeting
- [ ] Add to onboarding checklist

---

## 🎯 Next Steps

**Immediate (Awaiting Approval):**
1. [Travis] reviews this strategy
2. [Travis] answers 5 questions above
3. [Travis] approves or requests changes

**After Approval:**
1. [Codey] implements Phases 1-3 (~3 hours)
2. [Team] reviews and validates (~1 hour meeting)
3. [Codey] refines based on feedback (~1 hour)
4. [Team] adopts new process (ongoing)

**Timeline:**
- **Strategy approval**: End of day today
- **Implementation**: Tomorrow (3-4 hours)
- **Team review**: Next team meeting
- **Full adoption**: Week 2

---

## 📞 Ownership

**This Strategy Document:**
- **Owner**: [Codey] (TPM)
- **Approver**: [Travis]
- **Contributors**: [Team]
- **Status**: 🟡 AWAITING APPROVAL

**Questions?**
- Strategy questions → [Codey]
- Approval decisions → [Travis]
- Implementation help → [Codey] + [Syntax]

---

**Document Status**: 🟡 PROPOSAL
**Created**: October 11, 2025
**Owner**: [Codey]
**Next Action**: Awaiting [Travis] approval

---

*This strategy solves the discoverability problem by creating a single entry point, clear hierarchy, role-based navigation, and lifecycle management. Once approved, implementation takes ~4 hours total.*
