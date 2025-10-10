# Deployment Guide

> **Version:** 2.0.0
> **Last Updated:** 2025-09-27
> **Owner:** [Flow]

## Deployment Overview

This guide covers the GitOps deployment process for travissutphin.com using our hybrid GitOps + Docs-as-Code system.

## Quick Start

### Local Development
```bash
# Option 1: PHP Built-in Server
cd public && php -S localhost:8080

# Option 2: Docker (New GitOps Method)
docker-compose -f gitops/deployment/docker-compose.yml up -d

# Option 3: XAMPP (Traditional)
# Copy files to htdocs/ and start XAMPP
```

### Testing Docker Locally
```bash
# Build the image
docker build -f gitops/deployment/Dockerfile -t travissutphin-com:local .

# Run container
docker run -d --name ts-local -p 8080:80 travissutphin-com:local

# Test application
curl http://localhost:8080/

# Check logs
docker logs ts-local

# Stop and cleanup
docker stop ts-local && docker rm ts-local
```

## Deployment Environments

### Environment Configuration Matrix
| Environment | Branch | Auto Deploy | Approval | URL |
|------------|--------|-------------|----------|-----|
| Local | any | Manual | None | localhost:8080 |
| Staging | main | ✅ Yes | Code Review | staging.travissutphin.com |
| Production | main | Manual | Required | travissutphin.com |

## GitOps Deployment Process

### Stage 1: Development → Staging
**Trigger**: Push to `main` branch
**Process**: Automated via GitHub Actions

```bash
# 1. Create feature branch
git checkout -b feature/new-feature

# 2. Make changes and test locally
# ... development work ...

# 3. Commit and push
git add .
git commit -m "feat: new feature description 🤖 Generated with Claude Code"
git push origin feature/new-feature

# 4. Create PR and get approval
# 5. Merge to main triggers staging deployment
```

### Stage 2: Staging → Production
**Trigger**: Manual approval
**Process**: GitHub Actions with approval gate

```bash
# Production deployment requires manual approval
# 1. Staging deployment completes successfully
# 2. [DeploymentTeam] reviews staging
# 3. Manual approval in GitHub Actions
# 4. Production deployment begins
```

## CI/CD Pipeline Details

### Pipeline Stages
1. **Security Scan** ([Sentinal])
   - Secret detection
   - Dependency vulnerabilities
   - Code security analysis

2. **Quality Assurance** ([Verity])
   - PHP syntax validation
   - Markdown format validation
   - Blog post format validation

3. **Build** ([Syntax] + [Aesthetica])
   - Docker image build
   - Container testing
   - Health check validation

4. **Deploy Staging** ([Flow])
   - Automated deployment
   - Smoke tests
   - Health verification

5. **Deploy Production** ([Flow] + [Team])
   - Manual approval required
   - Blue-green deployment
   - Full integration tests

6. **Update Documentation** ([Codey])
   - Deployment history
   - System status updates
   - Kanban board updates

### Pipeline Configuration
Location: `.github/workflows/ci-cd.yml`

Key features:
- Role-based job assignment
- Security-first approach
- Automated testing
- Manual production gates
- Documentation updates

## Environment-Specific Configuration

### Local Development Environment
```php
// config.php - Local detection
$is_production = false;
define('BASE_PATH', '/myPersonalSite/public');
define('DEBUG_MODE', true);
```

### Staging Environment
```bash
# Environment variables
PHP_ENV=staging
DEBUG_MODE=false
BASE_PATH=""
```

### Production Environment
```bash
# Environment variables
PHP_ENV=production
DEBUG_MODE=false
BASE_PATH=""
ENABLE_MONITORING=true
```

## Docker Configuration

### Dockerfile Structure
```dockerfile
# Multi-stage build for optimization
FROM php:8.2-apache as production
# Security hardening
# Performance optimization
# Health checks enabled
```

### docker-compose.yml Features
- Production-ready Apache configuration
- Health checks and monitoring
- Log volume mounting
- Restart policies
- Future Redis integration ready

## Health Checks & Monitoring

### Application Health Check
```bash
# HTTP health check
curl -f http://localhost/ || exit 1

# Container health check (built-in)
docker inspect --format='{{.State.Health.Status}}' container_name
```

### Monitoring Endpoints
- **Health**: `/health` (future implementation)
- **Status**: Built-in Apache status
- **Metrics**: Docker container metrics

## Rollback Procedures

### Quick Rollback (Production)
```bash
# 1. Identify last working commit
git log --oneline -10

# 2. Create hotfix branch
git checkout -b hotfix/rollback-to-sha

# 3. Reset to working commit
git reset --hard <working-commit-sha>

# 4. Force push and create emergency PR
git push --force-with-lease origin hotfix/rollback-to-sha

# 5. Emergency merge with [Travis] approval
```

### Container Rollback
```bash
# If using container registry
docker pull travissutphin-com:previous-tag
docker stop current-container
docker run -d --name rollback-container travissutphin-com:previous-tag
```

## Troubleshooting

### Common Issues

#### Docker Build Failures
```bash
# Check Docker daemon
docker version

# Clean build (no cache)
docker build --no-cache -f gitops/deployment/Dockerfile .

# Check build logs
docker build --progress=plain -f gitops/deployment/Dockerfile .
```

#### Permission Issues
```bash
# Fix file permissions
sudo chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html
```

#### Apache Configuration Issues
```bash
# Test Apache config
docker exec container_name apache2ctl configtest

# Check Apache error logs
docker logs container_name
```

### Debug Commands
```bash
# Container shell access
docker exec -it container_name /bin/bash

# Check running processes
docker exec container_name ps aux

# Check file permissions
docker exec container_name ls -la /var/www/html

# Test PHP
docker exec container_name php -v
```

## Performance Optimization

### Image Optimization
- Use multi-stage builds
- Minimize layer count
- Use .dockerignore
- Alpine base images (future consideration)

### Apache Optimization
```apache
# Production optimizations in apache.conf
KeepAlive On
MaxKeepAliveRequests 100
KeepAliveTimeout 2

# Enable compression
LoadModule deflate_module modules/mod_deflate.so
SetOutputFilter DEFLATE
```

### PHP Optimization
```ini
# Production PHP settings
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=4000
```

## Security Considerations

### Container Security
- Non-root user execution
- Minimal base image
- No unnecessary packages
- Regular base image updates

### Network Security
- Restricted port exposure
- Internal container networking
- Security headers enabled
- HTTPS redirect in production

## Maintenance Procedures

### Regular Maintenance Tasks
- **Weekly**: Base image updates
- **Monthly**: Security scans
- **Quarterly**: Performance review
- **As needed**: Configuration updates

### Update Procedures
```bash
# Update base image
docker pull php:8.2-apache

# Rebuild application image
docker build --pull -f gitops/deployment/Dockerfile .

# Test updated image
docker run --rm -p 8080:80 new-image-tag
```

## Emergency Procedures

### Emergency Deployment
1. **Assess Impact**: Determine severity and scope
2. **Create Hotfix**: Emergency branch from main
3. **Fast Track**: Skip normal approval for critical fixes
4. **Deploy**: Direct to production with monitoring
5. **Communicate**: Notify team and stakeholders
6. **Document**: Post-incident review

### Contact Information
- **Primary**: [Flow] (DevOps Lead)
- **Secondary**: [Syntax] (Technical Lead)
- **Emergency**: [Travis] (Product Owner)

---

*This deployment guide is maintained through our Docs-as-Code process and automatically updated.*