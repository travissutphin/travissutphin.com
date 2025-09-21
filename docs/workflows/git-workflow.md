# Git Workflow & Best Practices

## Branch Strategy

### Main Branches
- `main` - Production-ready code only
- `develop` - Integration branch for features

### Supporting Branches
- `feature/*` - New features (e.g., `feature/payment-integration`)
- `bugfix/*` - Bug fixes (e.g., `bugfix/login-error`)
- `hotfix/*` - Emergency production fixes
- `release/*` - Release preparation

## Workflow

### 1. Starting New Work
```bash
# Update your local develop branch
git checkout develop
git pull origin develop

# Create a new feature branch
git checkout -b feature/your-feature-name
```

### 2. Making Changes
```bash
# Make your changes
# Add files to staging
git add .

# Commit with descriptive message
git commit -m "feat: add user authentication system"

# Push to remote
git push origin feature/your-feature-name
```

### 3. Commit Message Convention
Follow the Conventional Commits specification:

- `feat:` New feature
- `fix:` Bug fix
- `docs:` Documentation changes
- `style:` Code style changes (formatting, etc.)
- `refactor:` Code refactoring
- `test:` Adding or updating tests
- `chore:` Maintenance tasks

Examples:
```
feat: add projects page with portfolio showcase
fix: resolve blank page issue on blog post
docs: update README with installation steps
style: format code according to PSR-12
refactor: simplify navigation component logic
```

### 4. Before Merging
```bash
# Update with latest develop
git checkout develop
git pull origin develop
git checkout feature/your-feature-name
git rebase develop

# Run tests (when implemented)
# php vendor/bin/phpunit

# Check for issues
git status
```

## Best Practices

### DO's
- ✅ Commit early and often
- ✅ Write clear, descriptive commit messages
- ✅ Keep commits focused on a single change
- ✅ Pull before push to avoid conflicts
- ✅ Review your changes before committing
- ✅ Use .gitignore for sensitive/temporary files

### DON'Ts
- ❌ Commit directly to main
- ❌ Commit sensitive information (passwords, API keys)
- ❌ Commit large binary files
- ❌ Force push to shared branches
- ❌ Commit commented-out code
- ❌ Mix formatting changes with logic changes

## Quick Commands

```bash
# View status
git status

# View commit history
git log --oneline --graph --decorate

# View changes
git diff

# Stash changes temporarily
git stash
git stash pop

# Undo last commit (keep changes)
git reset --soft HEAD~1

# Discard local changes
git checkout -- filename.php

# Update branch list
git fetch --prune
```

## Team Responsibilities

- **[Flow]** - DevOps: Manages CI/CD pipeline, deployment automation
- **[Sentinel]** - Security: Reviews for security vulnerabilities, secrets scanning
- **[Syntax]** - Lead Dev: Code reviews, merge approvals
- **[Verity]** - QA: Testing before merge to develop/main

## Emergency Procedures

### Rollback Production
```bash
git checkout main
git revert HEAD
git push origin main
```

### Fix Merge Conflicts
```bash
# Open conflicted files and resolve manually
# Look for <<<<<<< HEAD markers
git add resolved-file.php
git commit -m "fix: resolve merge conflicts"
```

## Protected Files
Never modify these without team discussion:
- `.htaccess` (routing configuration)
- `config.php` (when it contains production settings)
- Database migration files (once run in production)