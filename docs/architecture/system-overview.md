# System Architecture Overview

> **Version:** 2.0.0
> **Last Updated:** 2025-09-27
> **Owner:** [Syntax] + [Flow]

## Architecture Philosophy
**Simple, file-based, scalable PHP application with GitOps deployment automation.**

## Tech Stack

### Core Application
- **Language**: PHP 8.2+
- **Framework**: Custom file-based (no database)
- **Content**: Markdown with Parsedown
- **Styling**: Tailwind CSS (via CDN)
- **Server**: Apache with mod_rewrite

### GitOps Infrastructure
- **CI/CD**: GitHub Actions
- **Containerization**: Docker + Apache
- **Orchestration**: Docker Compose
- **Documentation**: Markdown (Docs-as-Code)
- **Monitoring**: Health checks + logging

## Project Structure

```
travissutphin.com/
├── .github/workflows/        # CI/CD pipelines
├── content/                  # Markdown content
│   └── blog/                # Blog posts (YYYY-MM-DD-slug.md)
├── docs/                    # Documentation (Docs-as-Code)
│   ├── architecture/        # System architecture docs
│   ├── processes/           # Team processes and workflows
│   └── deployment/          # Deployment guides and history
├── gitops/                  # GitOps configuration
│   ├── deployment/          # Docker and deployment configs
│   ├── environments/        # Environment-specific configs
│   └── automation/          # Deployment scripts
├── lib/                     # Core PHP functions
├── public/                  # Web root
│   ├── assets/             # Static assets
│   ├── css/                # Stylesheets
│   └── images/             # Images and media
├── templates/               # PHP template files
├── config.php              # Site configuration
└── README.md               # Project overview
```

## Application Flow

### Request Lifecycle
1. **Apache** receives request
2. **mod_rewrite** routes to appropriate handler
3. **Router** (index.php) determines page type
4. **Template Engine** renders PHP templates
5. **Content Parser** processes Markdown (if blog)
6. **Response** sent to client

### Content Management
```
Markdown Files → Parsedown → HTML → Template → Response
```

### Static Assets
```
/public/assets/ → Apache → Client (with caching headers)
```

## Environment Configuration

### Local Development
- **Server**: PHP built-in server (port 8080) or XAMPP (port 80)
- **Base Path**: Auto-detected based on environment
- **Debug**: Enabled for troubleshooting

### Staging Environment
- **Server**: Docker container with Apache
- **Base Path**: Root (`/`)
- **Debug**: Limited logging
- **Health Checks**: Enabled

### Production Environment
- **Server**: Docker container with optimized Apache config
- **Base Path**: Root (`/`)
- **Security**: Full headers and hardening
- **Monitoring**: Comprehensive logging and health checks

## Security Architecture

### Application Security ([Sentinal])
- **Input Validation**: All user inputs sanitized
- **Output Encoding**: XSS prevention
- **Security Headers**: CSP, HSTS, X-Frame-Options
- **File Access**: Restricted to public directory

### Infrastructure Security ([Flow])
- **Container Security**: Non-root user, minimal base image
- **Network Security**: Restricted ports and access
- **Secrets Management**: Environment variables only
- **Access Control**: GitOps-based deployment only

## Performance Considerations

### Caching Strategy
- **Static Assets**: 1 month browser cache
- **HTML Pages**: No cache (dynamic content)
- **Images**: Optimized and cached
- **CSS/JS**: CDN delivery where possible

### Optimization Techniques
- **Image Optimization**: 1200x630px for blog images
- **Lazy Loading**: Implemented for blog images
- **Minification**: CSS minification in production
- **Compression**: Apache gzip compression enabled

## Scalability Design

### Horizontal Scaling
- **Stateless Application**: No server-side sessions for content
- **File-based**: No database dependency
- **Container Ready**: Docker for easy scaling
- **CDN Ready**: Static assets can be offloaded

### Vertical Scaling
- **PHP OPcache**: Enabled in production
- **Apache Tuning**: Optimized for PHP workload
- **Memory Management**: Efficient file reading
- **Process Management**: Apache MPM optimization

## Data Flow

### Blog Content Flow
```
Author → Markdown File → Git → CI/CD → Staging → Production
```

### Documentation Flow
```
Team → Docs-as-Code → Git → Auto-generate → Deploy
```

### Image Asset Flow
```
Design → PNG (1200x630) → Git → CDN → Client
```

## Monitoring & Observability

### Health Monitoring
- **Application Health**: HTTP endpoint checks
- **Container Health**: Docker health checks
- **Performance**: Response time monitoring
- **Error Tracking**: Apache error logs

### Logging Strategy
- **Access Logs**: Apache combined format
- **Error Logs**: PHP errors and Apache errors
- **Deployment Logs**: CI/CD pipeline logs
- **Audit Logs**: Git commit history

## Future Architecture Considerations

### Phase 2 Enhancements
- **Redis Caching**: For high-traffic scenarios
- **Database Integration**: For user management features
- **CDN Integration**: For global content delivery
- **Search Functionality**: Full-text search implementation

### Scalability Roadmap
1. **Current**: Single container deployment
2. **Phase 2**: Multi-container with Redis
3. **Phase 3**: Kubernetes orchestration
4. **Phase 4**: Microservices architecture (if needed)

---

*This architecture supports our core principle: simple, efficient, robust, and scalable.*