# Deployment Configuration

## Overview
Site automatically detects environment and configures BASE_PATH accordingly.

## Local Development Options

### Option 1: PHP Built-in Server (Recommended)
```bash
# Run on port 8080 (or any port)
php serve.php 8080

# Access at: http://localhost:8080
```

### Option 2: XAMPP Subfolder
```bash
# Keep files in /xampp/htdocs/travissutphin.com
# Access at: http://localhost/travissutphin.com/public/
```

### Option 3: XAMPP Root
```bash
# Move public/* to /xampp/htdocs/
# Update paths in public/index.php to point to parent folders
# Access at: http://localhost/
```

## Production Deployment

### File Structure
```
/public_html (or /www)
├── index.php (from public/)
├── assets/
├── /content (one level up)
├── /templates (one level up)
├── /lib (one level up)
└── config.php (one level up)
```

### Steps:
1. Upload `public/*` contents to web root
2. Upload other folders (content, templates, lib) to parent directory
3. Update `config.php` if needed (auto-detects production)
4. Set proper file permissions (755 for folders, 644 for files)

## Environment Detection
The system automatically detects:
- **Production**: travissutphin.com or www.travissutphin.com
- **Local with port**: localhost:8080 (BASE_PATH = '')
- **Local subfolder**: localhost/myPersonalSite/public (BASE_PATH = '/myPersonalSite/public')

## No Configuration Required
- No .htaccess needed
- No nginx config needed
- Works with any standard PHP hosting
- BASE_PATH automatically adjusts

## Testing Checklist
- [ ] Home page loads at root URL
- [ ] All navigation links work
- [ ] Blog posts load correctly
- [ ] Images and assets display
- [ ] Dark mode toggle works
- [ ] Mobile navigation functions