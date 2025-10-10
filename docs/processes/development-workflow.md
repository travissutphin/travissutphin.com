# Development Workflow

> **Version:** 2.0.0
> **Last Updated:** 2025-09-27
> **Owner:** [Flow] + [Codey]

## Core Principle
**Keep it simple, efficient, robust, best practice and scalable. No overengineering.**

## Development Guidelines
1. Don't create files unless necessary
2. Prefer editing over creating new files
3. Keep animations simple and working
4. No unnecessary comments in code
5. Test all changes before marking complete

## Simple GitOps Workflow

### Branch Strategy
```
main (production) ← feature/branch-name
```

### Feature Development Process
1. **Create Feature Branch**: `git checkout -b feature/description`
2. **Development**: Follow coding standards and test locally
3. **Push & PR**: Create pull request with description
4. **Review**: [Syntax] + relevant team member review
5. **Simple Validation**: Run `./automation/deploy.sh staging`
6. **Merge**: Manual deployment using automation scripts

### Environment Promotion
- **Local Development**: XAMPP on port 80 or PHP server on port 8080
- **Staging**: `./automation/deploy.sh staging`
- **Production**: `./automation/deploy.sh production` (with manual approval)

## Definition of Done
- [ ] Code reviewed and approved
- [ ] Simple validation passing (`./automation/deploy.sh staging`)
- [ ] Security review completed ([Sentinal])
- [ ] Deployed to staging environment
- [ ] Product Owner acceptance ([Travis])
- [ ] Documentation updated (Docs-as-Code)
- [ ] Kanban board updated

## Quality & Security Standards

### Code Quality ([Verity])
- PHP syntax validation
- Markdown format validation
- Blog post naming convention: `YYYY-MM-DD-slug.md`
- Image requirements: 1200x630px PNG in `/assets/images/blogs/`

### Security Standards ([Sentinal])
- No hardcoded secrets or credentials
- Input validation on all user inputs
- Security headers configured
- Regular dependency updates

### Performance Standards ([Flow])
- Page load times < 3 seconds
- Optimized images and assets
- Proper caching headers
- Health check endpoints

## Local Development Setup

### Option 1: XAMPP (Current)
```bash
# Start XAMPP Control Panel (port 80)
# Copy files to htdocs/
```

### Option 2: PHP Built-in Server
```bash
cd public && php -S localhost:8080
```

### Option 3: Simple Automation Testing
```bash
# Test your changes before deployment
./automation/deploy.sh staging
```

## Commands Reference

### Development
```bash
# Check PHP syntax
php -l filename.php

# Start local server
cd public && php -S localhost:8080

# Simple deployment testing
./automation/deploy.sh staging

# Update documentation
./automation/sync-docs.sh
```

### Git Operations
```bash
# Create feature branch
git checkout -b feature/description

# Check status
git status

# Commit with message
git commit -m "feat: description 🤖 Generated with Claude Code"
```

## Blog Post Management

### Creating New Posts
1. **File**: `/content/blog/YYYY-MM-DD-slug.md`
2. **Image**: `/public/assets/images/blogs/YYYY-MM-DD-slug.png` (1200x630px)
3. **Update**: Sitemap automatically updated via CI/CD
4. **Review**: [MarketingTeam] content review before publication

### Blog Post Requirements
- **Format**: Markdown with frontmatter
- **Naming**: `YYYY-MM-DD-slug.md`
- **Image**: 1200x630px PNG, same filename as post
- **SEO**: Meta description, proper headings, schema.org markup

## Deployment Process

### Staging Deployment
- **Trigger**: Push to main branch
- **Process**: Automated via GitHub Actions
- **Validation**: Health checks and smoke tests
- **Notification**: Team notification on completion

### Production Deployment
- **Trigger**: Manual approval after staging validation
- **Process**: Blue-green deployment strategy
- **Validation**: Full integration tests
- **Rollback**: Automated rollback on health check failure

## Monitoring & Maintenance

### Health Checks
- Application response time
- Database connectivity (future)
- Error rate monitoring
- Security scan results

### Regular Maintenance
- **Weekly**: Dependency updates
- **Monthly**: Security audit
- **Quarterly**: Performance review
- **As Needed**: Feature flag cleanup

---

*This workflow is enforced through our GitOps pipeline and automatically updated.*