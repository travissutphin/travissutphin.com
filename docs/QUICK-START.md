# Quick Start Guide for New Team Members
**Welcome to the Travis Sutphin AI-CMS Platform Team! 🚀**

> **Purpose:** Get you productive in your first 30 minutes
> **Owner:** [Codey] (TPM)
> **Status:** 🟢 CURRENT
> **Last Updated:** October 11, 2025

---

## Your First 30 Minutes ⏱️

### 1. Read This Document (5 minutes)
You're doing it! Keep going.

### 2. Read Your Role-Specific Start Guide (10 minutes)
Find your role below and click the ⭐ **START HERE** link:

- **[Echo] - Content Strategist** → [BLOG-CREATION-GUIDE.md](processes/BLOG-CREATION-GUIDE.md) ⭐
- **[Aesthetica] - UI/UX Designer** → [Visual Brand Audit Report](design/visual-brand-audit-report-2025-10-11.md) ⭐
- **[Syntax] - Principal Engineer** → [System Overview](architecture/system-overview.md) ⭐
- **[Flow] - DevOps Engineer** → [Deployment Guide](deployment/deployment-guide.md) ⭐
- **[Sentinal] - Security Operations** → [Security Standards](processes/security-standards.md) ⭐
- **[Verity] - QA Engineer** → [Regression Tests](testing/regression-tests.md) ⭐
- **[Bran] - Digital Marketing (SEO)** → [Blog Taxonomy & SEO Plan](content-strategy/blog-taxonomy-seo-plan.md) ⭐
- **[Cipher] - StoryBrand Expert** → [StoryBrand Framework](marketing/storybrand-framework.md) ⭐
- **[Codey] - Technical Program Manager** → [Team Structure](processes/team-structure.md) ⭐

### 3. Review Current Work (5 minutes)
Check the kanban board for your area:
- **Development tasks** → [kanban/kanban_dev.html](kanban/kanban_dev.html)
- **Content calendar** → [kanban/kanban_content.html](kanban/kanban_content.html)
- **General tasks** → [kanban/kanban.html](kanban/kanban.html)

### 4. Understand Current Sprint Goals (5 minutes)
Read the most recent session summary:
- [Latest session notes](sessions/) - Check the most recent file

### 5. Ask Questions (5 minutes)
Know who to ask for help (see "Questions?" section below)

---

## Essential Knowledge for ALL Roles

### Project Overview
**What We're Building:**
- Travis Sutphin's portfolio and blog platform
- AI-powered content management system (AI-CMS)
- File-based PHP site (no database)
- Built with PHP 8+ and Tailwind CSS

**Key Differentiators:**
- GitOps workflow (Git as CMS)
- AI team collaboration (you're part of an AI-powered team!)
- StoryBrand messaging framework
- SEO-first content strategy

### Team Structure
We use a **Scrum + Kanban hybrid**:
- **2-week sprints** for development work
- **Kanban boards** for content and operational tasks
- **Daily stand-ups** for TechTeam (15 min)
- **Sprint reviews** to demo work
- **Sprint retrospectives** for process improvement

### Core Principle
**Keep it simple, efficient, robust, best practice, and scalable. No overengineering.**

### Tech Stack (Quick Reference)
```
Language:     PHP 8+
CSS:          Tailwind CSS (via CDN)
Content:      Markdown (Parsedown library)
Server:       XAMPP (port 80) or PHP dev server (port 8080)
Deployment:   Railway (auto-deploy from GitHub)
CI/CD:        GitHub Actions → Railway
```

### Repository Structure
```
/travissutphin.com/
├── /public/          # Web root (all accessible files)
├── /content/         # Markdown content (blog posts, pages)
├── /templates/       # PHP templates (layouts, partials)
├── /lib/             # Core PHP functions
├── /docs/            # 📚 You are here - documentation hub
└── /automation/      # Deployment and automation scripts
```

---

## Common Tasks

### How to Find Documentation
**Always start here:** [docs/README.md](README.md) - Master index with role-based and task-based navigation

**Can't find what you need?**
1. Use the "Quick Task Index" in [README.md](README.md)
2. Search your role's section in [README.md](README.md)
3. Ask [Codey] (TPM) for guidance

### How to Create a Blog Post
[Echo] and [Bran] - This is your primary task:
1. Read [BLOG-CREATION-GUIDE.md](processes/BLOG-CREATION-GUIDE.md) (complete 7-step process)
2. Choose taxonomy from [Tag Master List](content-strategy/tag-master-list.md)
3. Prepare images using [Blog Image Optimization](processes/blog-image-optimization-guide.md)
4. Follow SEO guidelines in [Blog Taxonomy & SEO Plan](content-strategy/blog-taxonomy-seo-plan.md)

### How to Deploy to Production
[Flow], [Syntax], [Sentinal] - Here's the deployment process:
1. Read [Deployment Guide](deployment/deployment-guide.md) (Railway auto-deploy)
2. Follow [Git Workflow](workflows/git-workflow.md) (branch, commit, merge)
3. Review [Deployment History](deployment/deployment-history.md) for context
4. If issues: [Docker Quickstart](deployment/DOCKER-QUICKSTART.md)

### How to Run QA Tests
[Verity] - Your QA workflow:
1. [Regression Tests](testing/regression-tests.md) - Manual test scenarios
2. [Unit Tests](testing/unit-tests.md) - Automated test coverage
3. [Visual Audit Checklist](design/visual-brand-audit-checklist.md) - UI/UX checks

### How to Maintain Design Standards
[Aesthetica] - Your design workflow:
1. [Visual Brand Audit Report](design/visual-brand-audit-report-2025-10-11.md) - Authoritative standards (Grade: B+, 87/100)
2. [Quick Audit Checklist](design/QUICK-START-AUDIT.md) - Fast design review
3. [Aesthetica Start Guide](design/AESTHETICA-START-HERE.md) - Role onboarding

---

## Tools and Access

### Local Development Setup
1. **XAMPP** (primary): Runs on port 80
   - Start XAMPP Control Panel
   - Start Apache module
   - Access: `http://localhost/`

2. **PHP Dev Server** (alternative): Runs on port 8080
   ```bash
   cd public && php -S localhost:8080
   ```
   - Access: `http://localhost:8080/`

### Essential Commands
```bash
# Check PHP syntax
php -l filename.php

# Start local dev server
cd public && php -S localhost:8080

# Check git status
git status

# View current branch
git branch
```

### Production URL
- **Live site:** https://travissutphin.com
- **Railway dashboard:** (ask [Flow] for access)

---

## Team Communication

### Who to Ask for Help

| Question Type | Ask |
|--------------|-----|
| Documentation questions | [Codey] |
| Content/blog creation | [Echo] |
| Design and UI/UX | [Aesthetica] |
| Technical/code issues | [Syntax] |
| Deployment/DevOps | [Flow] |
| Security concerns | [Sentinal] |
| QA and testing | [Verity] |
| SEO and marketing | [Bran] |
| Messaging and branding | [Cipher] |

### Daily Stand-Up Format (TechTeam)
**15-minute daily sync:**
1. What did I complete yesterday?
2. What will I work on today?
3. Any blockers?

### Sprint Ceremonies
- **Sprint Planning** (start of sprint) - Define goals and backlog
- **Sprint Review** (end of sprint) - Demo working software
- **Sprint Retrospective** (after review) - Process improvement

---

## Documentation Best Practices

### When Creating New Docs
**Decision Matrix:**

| Scenario | Action | Type | Location |
|----------|--------|------|----------|
| "How do I do X?" asked 3+ times | Create guide | AUTHORITATIVE | `/processes/` |
| Design standards need documenting | Create reference | REFERENCE | `/design/` |
| Planning new feature/strategy | Create plan | PLANNING | `/content-strategy/` |
| One-time migration/fix | Create log | ARCHIVE | `/archive/` |

### Document Status Badges
Always include at the top of new docs:
```markdown
**Status:** 🟢 CURRENT
**Owner:** [YourRole]
**Last Updated:** YYYY-MM-DD
**Next Review:** YYYY-MM-DD (quarterly for authoritative docs)
```

### Status Badge Meanings
- 🟢 **CURRENT** - Up-to-date, use this
- 🟡 **REVIEW** - May be outdated, verify first
- 🔴 **DEPRECATED** - Don't use (moved to `/archive/`)
- ⭐ **AUTHORITATIVE** - Single source of truth, follow exactly

---

## Development Workflow

### Definition of Done
Before marking any task complete:
- [ ] Code reviewed and approved
- [ ] Automated tests passing (if applicable)
- [ ] Security review completed
- [ ] Deployed to staging environment
- [ ] Product Owner ([Travis]) acceptance

### Git Workflow (Simplified)
1. Create feature branch: `git checkout -b feature/your-feature-name`
2. Make changes and commit: `git commit -m "your message"`
3. Push to GitHub: `git push origin feature/your-feature-name`
4. Railway auto-deploys from main branch
5. Merge to main only after [Travis] approval

**Full details:** [Git Workflow](workflows/git-workflow.md)

---

## Success Metrics

**You're successfully onboarded when:**
- ✅ You know where to find documentation (this README)
- ✅ You've read your role-specific start guide
- ✅ You understand the current sprint goals
- ✅ You know who to ask for help
- ✅ You can complete basic tasks in your role
- ✅ You're contributing to daily stand-ups (if TechTeam)

---

## Next Steps After Onboarding

### Week 1
- [ ] Complete your first small task (assigned by [Codey])
- [ ] Attend daily stand-ups (if TechTeam)
- [ ] Review all docs in your role section
- [ ] Ask questions early and often

### Week 2
- [ ] Take on medium-complexity tasks
- [ ] Participate in sprint ceremonies
- [ ] Start contributing to documentation
- [ ] Identify process improvements

### Month 1
- [ ] Own significant features/tasks
- [ ] Mentor new team members
- [ ] Contribute to sprint planning
- [ ] Propose process optimizations

---

## Frequently Asked Questions

### Q: Where do I start if I'm overwhelmed?
**A:** Start with your role-specific ⭐ **START HERE** guide (section 2 above). Read only that one document first.

### Q: How do I know which documentation to trust?
**A:** Look for the ⭐ **AUTHORITATIVE** badge. These are single sources of truth.

### Q: What if documentation is outdated?
**A:** Report to [Codey] immediately. We have quarterly review cycles to keep docs fresh.

### Q: Can I update documentation?
**A:** Yes! Follow the process in [DOCUMENTATION-STRATEGY.md](DOCUMENTATION-STRATEGY.md). Always add status headers.

### Q: How do I access the kanban board?
**A:** Open [kanban/kanban_dev.html](kanban/kanban_dev.html) in your browser. It's a local HTML file.

### Q: What's the difference between AUTHORITATIVE and REFERENCE docs?
**A:**
- **AUTHORITATIVE** = Single source of truth, must follow exactly (e.g., BLOG-CREATION-GUIDE.md)
- **REFERENCE** = Best practices, lookup guides, standards (e.g., design audit report)

---

## Emergency Contacts

**Blockers or urgent issues:**
1. Report to [Codey] (TPM) immediately
2. Escalate to [Travis] (Product Owner) if critical
3. For security issues: [Sentinal] first, then [Travis]

---

**Document Status:** 🟢 CURRENT ⭐ AUTHORITATIVE
**Owner:** [Codey]
**Last Updated:** October 11, 2025
**Next Review:** January 11, 2026 (quarterly)

---

*Welcome to the team! Remember: We keep it simple, efficient, robust, best practice, and scalable. No overengineering. When in doubt, ask [Codey] or check [README.md](README.md).*
