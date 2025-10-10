# Docker Quick Start Guide
## Railway.com Migration - Phase 2 Implementation

**Team**: [Flow], [Gordon], [Syntax]
**Date**: October 10, 2025

---

## 🚀 Quick Start (5 minutes)

### Prerequisites
- Docker Desktop installed and running
- Git repository cloned locally
- Port 8080 available

### Step 1: Build the Docker Image
```bash
# From project root directory
docker build -t travissutphin-web .
```

### Step 2: Run with Docker Compose
```bash
# Start the container
docker-compose up -d

# View logs
docker-compose logs -f

# Access the site
# Open browser to: http://localhost:8080
```

### Step 3: Test the Container
```bash
# Run syntax and configuration tests
docker-compose --profile test run test

# Check container health
docker ps
docker inspect travissutphin-web | grep -A 5 Health
```

---

## 🧪 Testing Checklist

### [Verity] - QA Testing
- [ ] Homepage loads correctly at http://localhost:8080
- [ ] Blog posts render properly
- [ ] Navigation works (all links)
- [ ] Mobile responsive design works
- [ ] Images load correctly
- [ ] Content from /content/blog is displayed

### [Sentinel] - Security Testing
- [ ] No sensitive files exposed (check /docs, /.git)
- [ ] Headers configured correctly
- [ ] Error pages don't expose server info
- [ ] Permissions are restrictive

### [Flow] - DevOps Testing
- [ ] Container builds successfully
- [ ] Health checks pass
- [ ] Restart policy works (kill and auto-restart)
- [ ] Volume mounts work for development
- [ ] Logs are accessible

---

## 📝 Common Commands

### Container Management
```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# Restart containers
docker-compose restart

# View running containers
docker ps

# View logs
docker-compose logs -f web
```

### Debugging
```bash
# Enter container shell
docker exec -it travissutphin-web bash

# Check Apache config
docker exec travissutphin-web apache2ctl -S

# Check PHP config
docker exec travissutphin-web php -i

# Test from inside container
docker exec travissutphin-web curl http://localhost/
```

### Building & Cleaning
```bash
# Rebuild image (after Dockerfile changes)
docker-compose build --no-cache

# Remove all containers and volumes
docker-compose down -v

# Clean up unused images
docker system prune
```

---

## 🚂 Railway Deployment (Phase 3)

### Local Testing for Railway
```bash
# Test production build
docker build -t travissutphin-prod .
docker run -p 8080:80 travissutphin-prod

# Verify railway.json
cat railway.json | python -m json.tool
```

### Railway CLI Commands
```bash
# Install Railway CLI
npm install -g @railway/cli

# Login to Railway
railway login

# Create new project
railway init

# Deploy to Railway
railway up

# View deployment logs
railway logs

# Open deployed app
railway open
```

---

## 🔧 Troubleshooting

### Container Won't Start
```bash
# Check logs for errors
docker-compose logs web

# Verify Dockerfile syntax
docker build --no-cache .

# Check port conflicts
netstat -an | grep 8080
```

### Site Not Loading
```bash
# Verify container is running
docker ps

# Check Apache is running
docker exec travissutphin-web ps aux | grep apache

# Test internal connectivity
docker exec travissutphin-web curl http://localhost/
```

### Permission Issues
```bash
# Fix ownership inside container
docker exec travissutphin-web chown -R www-data:www-data /var/www/html

# Rebuild with correct permissions
docker-compose build --no-cache
```

---

## 📊 Performance Testing

```bash
# Basic load test with Apache Bench
docker run --rm --network travissutphin-network alpine/httpie ab -n 100 -c 10 http://web/

# Check resource usage
docker stats travissutphin-web

# Monitor logs during load
docker-compose logs -f web
```

---

## ✅ Ready for Railway?

Before deploying to Railway, ensure:
1. ✅ All tests pass locally
2. ✅ No hardcoded localhost references
3. ✅ Environment variables documented
4. ✅ Health checks working
5. ✅ Team sign-off received

---

## 📚 Resources

- [Full Migration Plan - TSP Task #012](./tsp-012-railway-docker-migration-plan.md)
- [Railway Documentation](https://docs.railway.app)
- [Docker PHP Best Practices](https://docs.docker.com/language/php/)
- [Team Contact](#) - Slack: #devops-migration

---

**Next Steps**: Once local testing is complete, proceed to Phase 3: Railway Setup in the main migration plan.

**Questions?** Contact [Flow] or [Gordon] via team channels.