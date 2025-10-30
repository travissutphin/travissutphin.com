# [StartDay] - Morning Standup Automation

**Version**: 1.0.0
**Command**: `[StartDay]` or `/startday`
**Trigger**: Type in Claude Code at start of work session
**Purpose**: Automate morning standup process for AI team
**Executor**: [Codey] (TPM) coordinates [Flow], [Sentinal], [Team]

---

## 🤖 AUTO-EXECUTION INSTRUCTIONS

**You are now executing the [ProcessStartDay] workflow. This is FULLY AUTOMATED. Do not ask [PRODUCT_OWNER] what to work on - TELL them based on kanban analysis.**

---

## STEP 1: Git Status Analysis
**Executor**: [Flow] (Lead), [Sentinal] (Support)

### Actions to Execute:
```bash
# 1. Check current branch
CURRENT_BRANCH=$(git branch --show-current)

# 2. Check uncommitted changes
UNCOMMITTED=$(git status --porcelain | wc -l)

# 3. Check sync with remote
git fetch origin --quiet
LOCAL=$(git rev-parse @)
REMOTE=$(git rev-parse @{u})

if [ $LOCAL = $REMOTE ]; then
    SYNC_STATUS="✅ Synced"
elif [ $LOCAL != $REMOTE ]; then
    SYNC_STATUS="⚠️  Needs pull or push"
fi

# 4. List uncommitted files (if any)
if [ $UNCOMMITTED -gt 0 ]; then
    git status --short
fi
```

### Report Format:
```
📊 GIT STATUS:
- Current Branch: [branch_name]
- Uncommitted Files: [count]
- Sync Status: [synced/needs pull/needs push]
- Files pending commit: [list if any]
```

---

## STEP 2: Local Server Verification
**Executor**: [Flow] (Lead), [Sentinal] (Support)

### Actions to Execute:

**For XAMPP projects (port 80):**
```bash
# Check if Apache is running
if netstat -ano | grep ":80" > /dev/null 2>&1; then
    echo "✅ XAMPP Apache running on port 80"
    echo "🌐 Local URL: http://localhost/"
else
    echo "⚠️  XAMPP Apache not running"
    echo "Action: Start XAMPP Control Panel and start Apache"
fi
```

**For PHP dev server (port 8080):**
```bash
# Check if PHP server running
if netstat -ano | grep ":8080" > /dev/null 2>&1; then
    echo "✅ PHP dev server running on port 8080"
    echo "🌐 Local URL: http://localhost:8080/"
else
    echo "⚠️  PHP dev server not running"
    echo "Action: cd public && php -S localhost:8080"
fi
```

### Report Format:
```
🖥️  LOCAL SERVER:
- Status: [✅ Running / ⚠️  Not Running]
- Port: [80 or 8080]
- URL: http://localhost:[port]/
- Action Required: [None / Start server command]
```

---

## STEP 3: Kanban Board Analysis
**Executor**: [Codey] (Lead)

### Actions to Execute:
1. **Read kanban file**: [KANBAN_DEV_PATH] (from placeholders.json)
2. **Parse HTML** to extract:
   - Sprint goal (from header)
   - All cards in "Sprint" column
   - All cards in "QA" column
   - All cards in "Staged" column
   - Any cards with `status-blocked` class
3. **Identify active tasks** (in Sprint/QA/Staged)
4. **Calculate sprint health**:
   - Total tasks in sprint
   - Completed tasks (in Live column)
   - In-progress tasks (Sprint + QA + Staged)
   - Sprint completion % = (completed / total) * 100

### Report Format:
```
📋 KANBAN BOARD ANALYSIS:

**Sprint Info:**
- Sprint: [Sprint X (dates)]
- Sprint Goal: [goal from kanban header]
- Sprint Health: [X%] ([completed]/[total] tasks)

**Active Tasks (In Progress):**
1. #[ID] - [Title] ([Assignee]) - Status: [Sprint/QA/Staged]
2. #[ID] - [Title] ([Assignee]) - Status: [Sprint/QA/Staged]
...

**Blockers:**
- [List any tasks with status-blocked, or "None"]

**Completed This Sprint:**
- [Count] tasks deployed to Live
```

---

## STEP 4: Sprint Context & Recommendations
**Executor**: [Codey] (Lead)

### Actions to Execute:
1. **Analyze priority**: Check `data-priority` attribute on cards
2. **Identify next action**:
   - If tasks in Sprint column → "Continue development on #[ID]"
   - If tasks in QA column → "[Verity] should test #[ID]"
   - If tasks in Staged column → "[Flow] should deploy #[ID] to Live"
   - If blockers exist → "Resolve blocker on #[ID]"
   - If Sprint column empty → "Pull task from Backlog"
3. **Check for dependencies**: Read card descriptions for "@depends" mentions

### Report Format:
```
🎯 RECOMMENDED NEXT ACTION:

**Priority**: [High/Medium/Low]
**Task**: #[ID] - [Title]
**Assignee**: [Team Member]
**Action**: [Specific next step]
**Reason**: [Why this task is priority]

**Alternative Tasks:**
- #[ID] - [Title] ([Assignee]) - [If primary task blocked]
```

---

## STEP 5: Final Report to [PRODUCT_OWNER]
**Executor**: [Codey] (Lead)

### Complete Report Template:
```
🌅 START DAY REPORT
====================
**Date**: [Current Date]
**Time**: [Current Time]
**Reporter**: [Codey] (Automated Standup)

---

📊 GIT STATUS:
- Current Branch: [branch_name]
- Uncommitted Files: [count]
- Sync Status: [status]
[List uncommitted files if any]

---

🖥️  LOCAL SERVER:
- Status: [Running/Not Running]
- URL: http://localhost:[port]/
[Action required if not running]

---

📋 SPRINT STATUS:
- Sprint: [Sprint X (dates)]
- Sprint Goal: [goal]
- Sprint Health: [X%] ([completed]/[total] completed)

**Active Tasks:**
1. #[ID] - [Title] ([Assignee]) - [Status]
2. #[ID] - [Title] ([Assignee]) - [Status]

**Blockers**: [List or "None"]

---

🎯 RECOMMENDED NEXT ACTION:
**Task**: #[ID] - [Title]
**Assignee**: [Team Member]
**Action**: [Specific step]
**Priority**: [High/Medium/Low]

---

📝 NOTES:
[Any important observations, warnings, or context]

---

✅ **Ready to start work!**
```

---

## ERROR HANDLING

### If git command fails:
```
⚠️  Git status unavailable. Possible reasons:
- Not in a git repository
- Git not installed
- Network issues for remote check
Action: Verify git installation and repository status
```

### If kanban file not found:
```
⚠️  Kanban board not found at: [KANBAN_DEV_PATH]
Action: Verify path in docs-framework/config/placeholders.json
```

### If server check fails (Windows):
```
Note: Using netstat command (Windows). For Linux/Mac, adjust to: lsof -i :[port]
```

---

## CONFIGURATION

### Customize for your project:
Edit `/docs-framework/config/placeholders.json`:
```json
{
  "paths": {
    "kanban_dev": "/docs/kanban/kanban_dev.html"
  },
  "tech_stack": {
    "server_type": "XAMPP",
    "port": "80"
  }
}
```

---

## APPROVAL LEVEL

**Category**: `auto_execute` (routine operational task)
**No [PRODUCT_OWNER] approval required** - This is a reporting function

Reference: `/docs-framework/config/approval-levels.json`

---

## TESTING

### Test this command:
1. Type `[StartDay]` in Claude Code
2. Verify all 5 sections appear in report
3. Check if recommendations match kanban state
4. Confirm server status is accurate

### Expected execution time: 5-10 seconds

---

## MAINTENANCE

### Update workflow:
1. Edit this file (`/docs-framework/slash-commands/startday.md`)
2. Test immediately by typing `[StartDay]`
3. If broken, error will be obvious in AI output
4. Fix and test again

### Version history:
- v1.0.0 (2025-10-12): Initial release

---

**Command Status**: ✅ PRODUCTION READY
**Last Updated**: 2025-10-12
**Maintainer**: [Codey] (TPM)

---

*This command should execute fully automatically. Do not ask [PRODUCT_OWNER] questions - provide actionable intelligence.*
