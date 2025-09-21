# GitHub Repository Overwrite Plan

## Current Situation
- Local repo has significant changes (new structure, docs reorganization)
- Remote not currently connected
- Backup of old repo already secured

## Strategy: Complete Repository Overwrite

### Option 1: Force Push (Recommended for Clean History)
This replaces the entire GitHub repository with your local version.

```bash
# Step 1: Add GitHub remote
git remote add origin https://github.com/travissutphin/travissutphin.com.git

# Step 2: Stage all changes
git add -A

# Step 3: Commit everything
git commit -m "feat: Complete site rebuild with environment-aware deployment

- Reorganized documentation structure
- Implemented smart BASE_PATH detection
- Added environment-based configuration
- Cleaned up project structure"

# Step 4: Force push to overwrite remote
git push -f origin master
```

### Option 2: Fresh Repository (Nuclear Option)
If you want completely fresh start:

```bash
# Step 1: Delete .git folder (removes all history)
rm -rf .git

# Step 2: Initialize new repository
git init

# Step 3: Add all files
git add -A

# Step 4: Initial commit
git commit -m "Initial commit: Complete site implementation"

# Step 5: Add remote
git remote add origin https://github.com/travissutphin/travissutphin.com.git

# Step 6: Force push
git push -f origin master
```

### Option 3: Backup Branch + Overwrite
Preserves old code in a branch on GitHub:

```bash
# Step 1: Add remote
git remote add origin https://github.com/travissutphin/travissutphin.com.git

# Step 2: Fetch existing code
git fetch origin

# Step 3: Create backup branch from remote master
git branch backup-old-site origin/master

# Step 4: Push backup branch
git push origin backup-old-site

# Step 5: Stage and commit new changes
git add -A
git commit -m "feat: Complete site rebuild"

# Step 6: Force push to master
git push -f origin master
```

## Important Considerations

### Before Pushing:
1. ✅ Confirm backup is secure
2. ✅ Review sensitive data:
   - No API keys in code
   - No passwords (except hashed admin)
   - No private information

### Files to Consider Adding to .gitignore:
```
.claude/
*.log
.env
config.local.php
```

### After Pushing:
1. Verify on GitHub that files appear correctly
2. Check GitHub Pages if using (may need to reconfigure)
3. Update any deployment webhooks
4. Clear any CDN caches

## Rollback Plan
If something goes wrong:

```bash
# Option A: Restore from local backup
cp -r ../travissutphin.com-backup/* .
git add -A
git commit -m "Restore: Reverting to backup"
git push -f origin master

# Option B: Reset to previous commit (if available)
git reset --hard HEAD~1
git push -f origin master
```

## Recommended Approach
**Use Option 1** - It's cleanest and preserves some history while completely replacing the remote code.

## GitHub Repository Settings to Check:
- Default branch (should be 'master' or 'main')
- GitHub Pages source (if applicable)
- Deployment keys or secrets
- Webhooks or Actions