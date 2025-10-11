# TSP Task #012 - Railway Deployment Options
## Branch Strategy Decision Required

**Date**: October 10, 2025
**Current Status**: Code pushed to `feature/gitops-docs-as-code-hybrid`
**Railway Configuration**: Connected to `main` branch
**Decision Required By**: [Travis]

---

## 🎯 Deployment Options

### Option 1: Merge to Main (Fastest)
**Time to Deploy**: ~5 minutes

```bash
# Merge feature branch to main
git checkout main
git pull origin main
git merge feature/gitops-docs-as-code-hybrid
git push origin main

# Railway will auto-deploy when main updates
```

**Pros**:
- ✅ Immediate deployment
- ✅ No Railway reconfiguration needed
- ✅ Follows GitOps workflow

**Cons**:
- ⚠️ No staging test first
- ⚠️ Direct to production

---

### Option 2: Reconfigure Railway to Feature Branch (Recommended)
**Time to Deploy**: ~10 minutes

**Steps**:
1. Go to Railway dashboard
2. Settings → Deploy → Connected Branch
3. Change from `main` to `feature/gitops-docs-as-code-hybrid`
4. Railway will auto-deploy from feature branch

**Pros**:
- ✅ Test deployment without affecting main
- ✅ Can verify everything works
- ✅ Easy rollback if issues

**Cons**:
- ⚠️ Need to reconfigure Railway
- ⚠️ Remember to switch back to main later

---

### Option 3: Railway CLI Manual Deploy (Most Control)
**Time to Deploy**: ~15 minutes

```bash
# Install Railway CLI (if not done)
npm install -g @railway/cli

# Login to Railway
railway login

# Link to existing project
railway link

# Deploy from current branch
railway up

# View deployment
railway open
```

**Pros**:
- ✅ Deploy from any branch
- ✅ No Git merge required
- ✅ Full control over deployment

**Cons**:
- ⚠️ Manual process
- ⚠️ Need CLI setup

---

## 🔧 Required Environment Variables

Regardless of deployment method, set these in Railway dashboard:

```env
# Application Settings
APP_ENV=production
APP_URL=https://railways.com  # When domain is configured
BASE_PATH=/

# PHP Configuration
PHP_MEMORY_LIMIT=256M
PHP_MAX_EXECUTION_TIME=30

# Railway provides automatically
PORT=<Railway assigns>
RAILWAY_ENVIRONMENT=production
```

---

## 📋 Pre-Deployment Checklist

Before deploying via any method:

- [ ] Verify Docker container still running locally
  ```bash
  docker ps
  ```

- [ ] Check application at http://localhost:8080

- [ ] Ensure no sensitive data in repository
  ```bash
  git log -1 --name-only
  ```

- [ ] Railway environment variables configured

- [ ] Domain settings prepared (if using custom domain)

---

## 🚀 Quick Deploy Commands

### For Option 1 (Merge to Main):
```bash
git checkout main && git merge feature/gitops-docs-as-code-hybrid && git push
```

### For Option 2 (Switch Branch in Railway):
No commands needed - use Railway dashboard

### For Option 3 (CLI Deploy):
```bash
railway up
```

---

## 🎯 [Codey] Recommendation

**Recommend Option 2**: Reconfigure Railway to deploy from feature branch first
- Test deployment without affecting main
- Verify Railway build succeeds
- Check application works on Railway infrastructure
- Then merge to main once confirmed

This gives us a staging-like test before production deployment.

---

## 📊 Current Readiness

| Component | Status | Notes |
|-----------|--------|-------|
| Git Repository | ✅ Ready | All files committed and pushed |
| Docker Config | ✅ Ready | Tested locally, working |
| Railway Project | ✅ Created | Connected to GitHub |
| Environment Vars | ❌ Not Set | Need configuration |
| Custom Domain | ❌ Not Set | railways.com not configured |
| SSL Certificate | ⏳ Pending | Railway provides automatically |

---

## 🔄 Next Immediate Steps

1. **[Travis]**: Choose deployment option (1, 2, or 3)
2. **[Flow]**: Configure environment variables in Railway
3. **[Team]**: Stand by for deployment verification

---

**Document Status**: ACTION REQUIRED
**Awaiting**: Deployment method decision
**Ready to Deploy**: YES