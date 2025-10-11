# Kanban Boards Guide
**Project Management & Task Tracking**

> **Status:** 🟢 CURRENT
> **Owner:** [Codey] (TPM)
> **Last Updated:** October 11, 2025
> **Next Review:** January 11, 2026

---

## Which Board Should I Use?

### 1. kanban_dev.html ⭐ (Primary Development Board)
**Use this for:** Technical development tasks, bugs, features, infrastructure work

**Who uses it:**
- [Syntax] - Principal Engineer
- [Flow] - DevOps Engineer
- [Sentinal] - Security Operations
- [Verity] - QA Engineer
- [Aesthetica] - UI/UX Designer (technical design tasks)
- [Codey] - TPM (overall tracking)

**Workflow:**
```
Backlog → In Progress → Review → Done
```

**Examples of tasks:**
- Implement blog taxonomy system
- Fix Schema.org structured data
- Optimize blog images (WebP conversion)
- Deploy to Railway production
- Security vulnerability patches
- UI component development

**Update frequency:** Daily during stand-ups

---

### 2. kanban_content.html (Content Calendar)
**Use this for:** Blog posts, content strategy, SEO campaigns, marketing initiatives

**Who uses it:**
- [Echo] - Content Strategist
- [Bran] - Digital Marketing (SEO/AEO)
- [Cipher] - StoryBrand Expert
- [Codey] - TPM (coordination)

**Workflow:**
```
Idea → Planning → Writing → Review → Published
```

**Examples of tasks:**
- Write "AI Speed Trap" blog post
- Implement 8-week SEO taxonomy plan
- Create social media campaign
- Update blog post metadata
- Content audit and optimization

**Update frequency:** Weekly content planning meetings

---

### 3. kanban.html (General Tasks)
**Use this for:** Miscellaneous tasks, documentation, process improvements, admin work

**Who uses it:**
- [Codey] - TPM (process tasks)
- All team members (general admin)

**Workflow:**
```
To Do → Doing → Done
```

**Examples of tasks:**
- Update team documentation
- Create new team member onboarding guide
- Process improvement initiatives
- Meeting action items
- Documentation audits

**Update frequency:** As needed

---

## How to Use the Boards

### Opening a Board
1. Navigate to `/docs/kanban/` directory
2. Double-click the `.html` file
3. Opens in your default browser (works offline!)

**Tip:** Bookmark your primary board for quick access

### Adding a Task
1. Open the appropriate board (see guide above)
2. Click "+ Add Card" in the appropriate column
3. Enter task details:
   - **Title:** Brief, action-oriented (e.g., "Fix blog image optimization")
   - **Description:** Context, acceptance criteria, links to docs
   - **Priority:** High/Medium/Low
   - **Assignee:** [RoleName]
   - **Due date:** If applicable

### Moving a Task
1. Drag and drop the card to the next column
2. Update during daily stand-ups (dev board) or weekly meetings (content board)
3. [Codey] tracks overall progress

### Completing a Task
1. Ensure all acceptance criteria met (see [Definition of Done](../QUICK-START.md#definition-of-done))
2. Move card to "Done" or "Published" column
3. Add completion notes in card description
4. Archive after sprint review (or monthly for content board)

---

## Board Conventions

### Card Labels/Colors
- 🔴 **Red:** Urgent/Blocker
- 🟠 **Orange:** High priority
- 🟡 **Yellow:** Medium priority
- 🟢 **Green:** Low priority
- 🔵 **Blue:** Enhancement/Nice-to-have
- 🟣 **Purple:** Documentation/Process

### Task Naming Conventions
**Good examples:**
- ✅ "Implement WebP image conversion for blog posts"
- ✅ "Write 'Vibe Coding' blog post"
- ✅ "Fix Schema.org BlogPosting structured data"

**Bad examples:**
- ❌ "Images" (too vague)
- ❌ "Blog stuff" (not actionable)
- ❌ "Fix things" (no specificity)

### Status Updates
**Each card should have:**
- Clear owner ([RoleName])
- Current status (updated regularly)
- Blockers (if any) clearly noted
- Links to relevant docs or code

---

## Integration with Other Processes

### Daily Stand-Up (TechTeam)
1. Open `kanban_dev.html`
2. Review your assigned cards
3. Report progress in stand-up
4. Move cards as appropriate

### Content Planning (MarketingTeam)
1. Open `kanban_content.html`
2. Review content calendar
3. Update progress on blog posts
4. Plan next week's content

### Sprint Planning
1. [Codey] reviews `kanban_dev.html` backlog
2. Team estimates tasks
3. Move selected tasks to "In Progress" column
4. Define sprint goals

### Sprint Review
1. Demo completed tasks from "Done" column
2. Archive completed cards
3. Move incomplete tasks back to backlog or next sprint

---

## Archiving and Cleanup

### When to Archive Cards
- **Dev board:** After sprint review (every 2 weeks)
- **Content board:** After blog post is live 30+ days
- **General board:** After task is complete 7+ days

### How to Archive
1. Review "Done" column
2. Screenshot or export task details if needed for reference
3. Delete or move to "Archive" section
4. Keep board clean and focused on active work

**Note:** Session summaries in `/docs/sessions/` serve as historical record of completed work

---

## Troubleshooting

### Q: Board won't open or shows errors
**A:** Ensure you're opening the `.html` file in a modern browser (Chrome, Firefox, Edge, Safari)

### Q: Changes aren't saving
**A:** Most kanban boards auto-save to browser localStorage. Clearing browser cache will reset the board. Export important data regularly.

### Q: I don't know which board to use
**A:**
- Technical task? → `kanban_dev.html`
- Content/blog task? → `kanban_content.html`
- Other/admin task? → `kanban.html`
- Still unsure? Ask [Codey]

### Q: Who updates the boards?
**A:**
- **Assignees** update their own cards daily
- **[Codey]** maintains overall structure and facilitates updates
- **[Travis]** (Product Owner) adds new tasks to backlog

---

## Best Practices

✅ **Do:**
- Update your cards daily
- Use clear, action-oriented task names
- Add context and links in card descriptions
- Mark blockers immediately
- Keep cards up-to-date during stand-ups

❌ **Don't:**
- Let cards go stale (no updates for 1+ week)
- Create vague tasks ("fix stuff")
- Assign tasks without owner
- Skip moving cards to "Done" when complete
- Ignore blockers or dependencies

---

**Quick Reference Card:**

| Board | Primary Users | Purpose | Update Frequency |
|-------|--------------|---------|------------------|
| `kanban_dev.html` | TechTeam | Development tasks | Daily |
| `kanban_content.html` | MarketingTeam | Content/blog posts | Weekly |
| `kanban.html` | All | General/admin tasks | As needed |

---

**Document Status:** 🟢 CURRENT
**Owner:** [Codey]
**Last Updated:** October 11, 2025
**Next Review:** January 11, 2026 (quarterly)

---

*For more on our Scrum + Kanban hybrid process, see [Team Structure](../processes/team-structure.md) and [Development Workflow](../processes/development-workflow.md).*
