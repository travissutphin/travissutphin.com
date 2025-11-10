# Free HTML Templates Directory

This directory contains free, production-ready HTML templates available for download on travissutphin.com/projects

## Directory Structure

```
/templates-free
├── /bootstrap           # Bootstrap 5.x templates
│   ├── /template-1
│   │   ├── index.html         # Live preview
│   │   ├── preview.png        # Screenshot (1200x630px)
│   │   ├── template-1.zip     # Download package
│   │   └── README.md          # Optional usage guide
│   └── /template-2
│       └── ...
└── /tailwind            # Tailwind CSS templates (future)
    └── ...
```

## Quick Add New Template

1. Create directory: `/templates-free/{framework}/{template-slug}/`
2. Add files: `index.html`, `preview.png`, `{template-slug}.zip`
3. Update JSON: `/content/data/free-templates.json`
4. Test: Visit `http://localhost/projects`
5. Update sitemap: `/public/sitemap.xml`

## Full Guide

See: `/docs/processes/ADD-NEW-TEMPLATE-GUIDE.md`

## Security

- `.htaccess` prevents directory listing
- Only `.html`, `.zip`, `.png`, `.jpg`, `.webp` files are accessible
- All user-facing code is manually reviewed (no user uploads)

---

**Built by Travis Sutphin** | https://travissutphin.com
