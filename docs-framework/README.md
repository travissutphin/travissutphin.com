# AI-DOCS Framework v1.0.0
## AI-Driven Operational Documentation System

**🤖 Built for AI Agents, Not Human Checklists**

This framework turns your project documentation into **executable workflows** that AI agents can run automatically. No more manual tracking, forgotten processes, or outdated documentation.

---

## 🎯 What Problem Does This Solve?

**Before (Traditional Docs):**
- ❌ Team reads documentation, forgets to follow it
- ❌ Kanban board manually updated (often forgotten)
- ❌ Process workflows documented but not enforced
- ❌ Documentation becomes outdated and ignored

**After (AI-DOCS Framework):**
- ✅ AI agents execute processes automatically via slash commands
- ✅ Kanban auto-updates when tasks move (code enforces compliance)
- ✅ Process workflows are scripts that run, not text to read
- ✅ Documentation stays fresh (automation breaks if docs are wrong)

---

## ⚡ Quick Start (30 Minutes)

### 1. Install Framework in Your Project
```bash
# Clone or copy framework into your project
git clone [framework-repo] ./docs-framework

# Or copy from existing project
cp -r /path/to/docs-framework ./docs-framework
```

### 2. Configure Your Project
Edit `/docs-framework/config/placeholders.json`:
```json
{
  "project": {
    "name": "My Project Name",
    "repository": "https://github.com/user/project",
    "production_url": "https://myproject.com"
  },
  "team": {
    "product_owner": "Travis",
    "tpm": "Codey",
    "principal_engineer": "Syntax"
  }
}
```

### 3. Install Slash Commands
```bash
# Copy slash commands to Claude Code
cp docs-framework/slash-commands/* .claude/commands/

# Commands now available:
# [StartDay]
# [TaskComplete]
# [OutlineBlog]
```

### 4. Test Automation
Type in Claude Code:
```
[StartDay]
```

AI agent will automatically:
- Check git status
- Review kanban board
- Report active tasks
- Suggest next action

**✅ Done!** Framework is active.

---

## 📁 Framework Structure

```
/docs-framework/
│
├── README.md                    # You are here
├── VERSION.md                   # Framework version history
│
├── /automation/                 # Executable workflow scripts
│   ├── process-startday.sh      # Morning standup automation
│   ├── process-taskcomplete.sh  # Task completion workflow
│   ├── process-tasklive.sh      # Post-deployment automation
│   └── kanban-updater.js        # Programmatic kanban updates
│
├── /slash-commands/             # Claude Code slash commands
│   ├── startday.md              # [StartDay] command definition
│   ├── taskcomplete.md          # [TaskComplete] command definition
│   ├── outlineblog.md           # [OutlineBlog] command definition
│   └── README.md                # How to install commands
│
├── /templates/                  # Project templates with [PLACEHOLDERS]
│   ├── CLAUDE.md.template       # AI workflow definitions
│   ├── kanban_dev.html.template # Kanban board template
│   ├── process-workflow.md.template
│   └── README.md.template       # Master documentation index
│
├── /config/                     # Configuration files
│   ├── placeholders.json        # Project-specific values
│   ├── workflow-states.json     # Kanban column definitions
│   ├── team-roles.json          # Team member roles
│   └── approval-levels.json     # What requires [PRODUCT_OWNER] approval
│
├── /docs/                       # Framework documentation
│   ├── SETUP-NEW-PROJECT.md     # 30-minute setup guide
│   ├── AUTOMATION-GUIDE.md      # How automation works
│   ├── SLASH-COMMANDS.md        # Command reference
│   └── TROUBLESHOOTING.md       # Common issues
│
└── /examples/                   # Real-world examples
    ├── example-claude-md.md     # From travissutphin.com
    ├── example-kanban.html      # Kanban board reference
    └── example-workflow.md      # Process workflow example
```

---

## 🤖 How It Works

### Slash Commands = Executable Workflows

**Traditional Documentation:**
```markdown
## Start of Day Process
1. Check git status
2. Review kanban board
3. Identify active tasks
4. Report to team
```
*Result: Humans read this, maybe follow it, often forget.*

**AI-DOCS Framework:**
```markdown
[StartDay]
```
*Result: AI agent executes script, automatically performs all 4 steps, reports results.*

### Kanban Auto-Updates

**Traditional:**
```
Human: "Remember to move task card to Live column"
Human: *forgets*
```

**AI-DOCS Framework:**
```bash
# When task deploys to production:
git push origin main

# Git hook triggers:
./automation/process-tasklive.sh

# Script automatically:
# 1. Detects task ID from commit
# 2. Moves kanban card: Staged → Live
# 3. Updates card status to "completed"
# 4. Commits kanban HTML file
# 5. Reports completion
```

---

## 🔧 Core Features

### 1. Slash Command System
**Commands you type → Workflows that execute**

| Command | Triggers | Actions |
|---------|----------|---------|
| `[StartDay]` | Morning standup | Git status, kanban review, task suggestions |
| `[TaskComplete]` | Task completion | Kanban update, sitemap refresh, git commit |
| `[OutlineBlog]` | Blog creation | Content strategy, SEO research, draft creation |

### 2. Automated Kanban Updates
**Code enforces compliance, not reminders**

```javascript
// Move task card automatically
node automation/kanban-updater.js \
  --task-id="013" \
  --from-column="staged" \
  --to-column="live" \
  --status="completed"

// Kanban HTML automatically updated
// Git commit automatically created
```

### 3. Portable Templates
**[PLACEHOLDERS] for all project-specific values**

```markdown
# [PROJECT_NAME] Documentation

**Owner**: [PRODUCT_OWNER_NAME]
**Repository**: [GITHUB_REPO_URL]
**Tech Stack**: [PRIMARY_LANGUAGE], [CSS_FRAMEWORK]
```

Replace placeholders once during setup, reuse forever.

### 4. Approval-Aware Automation
**High-level decisions → [PRODUCT_OWNER] approval required**
**Routine tasks → AI executes automatically**

Configured in `/config/approval-levels.json`:
```json
{
  "requires_approval": [
    "architectural_changes",
    "new_feature_planning",
    "budget_decisions"
  ],
  "auto_execute": [
    "kanban_updates",
    "sitemap_refresh",
    "deployment_logs"
  ]
}
```

### 5. Iterative & Easy to Update
**Framework evolves with your project**

```bash
# Update workflow
vim docs-framework/automation/process-startday.sh

# Test immediately
[StartDay]

# If broken, fix is obvious (script error)
# If working, team benefits instantly
```

---

## 📊 Workflow States (Configurable)

Default kanban columns:
```
Backlog → Sprint → QA → Staged → Live
```

Customize via `/config/workflow-states.json`:
```json
{
  "columns": [
    {"id": "backlog", "name": "Backlog", "icon": "📋"},
    {"id": "sprint", "name": "Sprint", "icon": "🚀"},
    {"id": "qa", "name": "QA", "icon": "🧪"},
    {"id": "staged", "name": "Staged", "icon": "📦"},
    {"id": "live", "name": "Live", "icon": "✅"}
  ]
}
```

Works with any workflow: Scrum, Kanban, custom.

---

## 🎯 Use Cases

### Use Case 1: Start Your Day
**Before:** Manually check git, read kanban, decide what to work on
**After:** Type `[StartDay]`, AI reports everything + suggests priority

### Use Case 2: Complete a Task
**Before:** Deploy code, remember to update kanban, update docs, commit
**After:** Type `[TaskComplete]`, AI does all 4 steps automatically

### Use Case 3: Onboard New Team Member
**Before:** 2-hour orientation, explain processes, hope they remember
**After:** New team member types `[StartDay]`, AI guides them through everything

### Use Case 4: Transfer Framework to New Project
**Before:** Copy-paste docs, manually update every reference, 2-4 hours
**After:** Copy framework, replace 5 placeholders, 30 minutes done

---

## 🔄 Version Control

Framework uses **Semantic Versioning (SemVer)**:
- **v1.0.0** - Initial release (you are here)
- **v1.1.0** - New features (more commands, more automation)
- **v2.0.0** - Breaking changes (major restructure)

Track in your project:
```markdown
# My Project - Documentation

**Framework Version**: v1.0.0
**Adopted**: 2025-10-12
**Last Updated**: 2025-10-12
```

When framework updates, you decide when to upgrade.

---

## 📖 Documentation

- **[SETUP-NEW-PROJECT.md](docs/SETUP-NEW-PROJECT.md)** - 30-minute setup guide
- **[AUTOMATION-GUIDE.md](docs/AUTOMATION-GUIDE.md)** - How automation works under the hood
- **[SLASH-COMMANDS.md](docs/SLASH-COMMANDS.md)** - Complete command reference
- **[TROUBLESHOOTING.md](docs/TROUBLESHOOTING.md)** - Common issues and solutions

---

## 🎯 Success Metrics

**You know the framework works when:**
- ✅ Team types `[StartDay]` instead of asking "what should I work on?"
- ✅ Kanban is always accurate (no manual updates needed)
- ✅ New team members productive in 30 minutes (not 2 hours)
- ✅ Process improvements take 5 minutes (edit script, test, done)
- ✅ Documentation never outdated (automation breaks if it's wrong)

---

## 🚀 Next Steps

1. **Install**: Follow [SETUP-NEW-PROJECT.md](docs/SETUP-NEW-PROJECT.md)
2. **Test**: Run `[StartDay]` command
3. **Customize**: Edit workflows to match your process
4. **Iterate**: Improve automation as you learn what works

---

## 📞 Support

**Framework Owner**: [Codey] (TPM)
**Questions**: Open an issue or contact framework maintainer
**Contributions**: Pull requests welcome

---

## 📄 License

MIT License (or specify your license)

---

**Framework Version**: 1.0.0
**Last Updated**: 2025-10-12
**Built for**: AI agents who execute, not humans who forget

---

*"Documentation should execute, not just inform."* - Framework Philosophy
