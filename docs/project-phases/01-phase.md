Phase 1 MVP Implementation Document
Simple CMS for travissutphin.com
Project Overview
Build a lightweight, file-based CMS that demonstrates technical expertise through elegant simplicity. This document outlines ONLY the Phase 1 MVP requirements for immediate launch.
Core Philosophy: Simple, effective, robust, scalable - no overengineering.

🎯 MVP SCOPE
Technical Stack

Backend: PHP 8+ (no framework, simple routing)
Frontend: HTML5, Tailwind CSS (CDN)
Storage: JSON files for pages, Markdown for blog posts
Auth: Single password (bcrypt hashed in config file)
JavaScript: Vanilla JS only (minimal use)

Feature Set

4 public pages (Home, Services, Contact, Blog)
Password-protected admin for blog management
Markdown-based blog system
Mobile-first responsive design
Contact form (PHP mail)
Reusable PHP partials system


📁 FILE STRUCTURE
/
├── config.php (password hash, site settings)
├── content/
│   ├── pages/
│   │   ├── index.json
│   │   ├── services.json
│   │   └── contact.json
│   └── blog/
│       └── 2024-11-15-example-post.md
├── public/
│   ├── index.php (router)
│   ├── style.css (Tailwind CDN + custom)
│   └── favicon.ico
├── admin.php (password protected)
├── templates/
│   ├── layouts/
│   │   └── base.php (main HTML wrapper)
│   ├── partials/
│   │   ├── header.php (logo, navigation container)
│   │   ├── nav.php (navigation menu items)
│   │   ├── mobile-menu.php (hamburger menu)
│   │   ├── footer.php (footer content)
│   │   ├── meta.php (SEO/OG meta tags)
│   │   ├── service-card.php (reusable service block)
│   │   ├── blog-card.php (blog post preview)
│   │   ├── cta-section.php (call-to-action blocks)
│   │   ├── contact-form.php (form fields)
│   │   └── alert.php (success/error messages)
│   └── pages/
│       ├── home.php
│       ├── services.php
│       ├── contact.php
│       ├── blog-list.php
│       └── blog-post.php
└── lib/
    ├── markdown.php (parser - use Parsedown)
    └── functions.php (helpers, routing, render functions)

🎨 DESIGN SPECIFICATIONS
Color Palette

Primary Green: #2be256 (CTAs, success states)
Dark Green: #005a00 (Headers, emphasis)
Primary Blue: #3d608f (Secondary actions, links)
Light Blue: #8dace1 (Backgrounds, subtle elements)
Neutrals: #1a1a1a (text), #4a4a4a (secondary), #f8f9fa (light bg), #ffffff (bg)

Typography

Headings: System UI font stack
Body: System font stack
No custom fonts (performance priority)

Responsive Breakpoints

Base: 320px (mobile first)
SM: 640px
MD: 768px
LG: 1024px
XL: 1280px

Design Elements

Simple CSS gradients (green to blue)
Card-based layouts
8px spacing system (0.5rem increments)
Clean, minimal aesthetic
No animations in MVP


📄 PAGE SPECIFICATIONS
Homepage (index.json + home.php)
Content Structure:

Hero section with headline/subheadline
3 service cards
Simple process (3 steps)
Final CTA section

StoryBrand Messaging:

Headline: "Your Half-Built App Deserves a Full Launch."
Sub: "As your Fractional CTO, I'll finish what you started—fast—with AI and automation baked in."
CTAs: [Finish My App] [Add AI Automation] [Book Free Audit]

Services Page (services.json + services.php)
Content Structure:

Page header
5 service sections:

🔧 Finish Your App
🤖 AI Integration & Automation
🧠 Fractional CTO
🧩 Workflow Optimization
🔑 Security & Infrastructure


Each service: title, description, 3-5 bullet points
Bottom CTA

Contact Page (contact.json + contact.php)
Form Fields:

Name (required)
Email (required)
Message (required, textarea)
Simple PHP mail handler
Success/error messages using alert partial

Blog System
Blog List Page:

Simple chronological listing
Show 10 posts per page
Each post shows: title, date, tags, excerpt
Basic pagination (previous/next)

Individual Blog Post:

Full markdown content rendered
Meta information (date, tags)
Back to blog link


📝 BLOG POST FORMAT
markdown---
title: "Post Title Here"
date: 2024-11-15
tags: ["ai", "automation", "development"]
description: "Meta description for SEO (150-160 chars)"
excerpt: "Optional manual excerpt for listing page"
---

# Post Title

Your markdown content here...

🔐 ADMIN SPECIFICATIONS
Authentication

Single password field
Password stored as bcrypt hash in config.php
PHP session-based auth
1-hour timeout
No username required

Admin Features (Blog Only)

List Posts: Table showing all blog posts (title, date, actions)
Create Post:

Title field
Date field (defaults to today)
Tags field (comma-separated)
Description field (meta)
Content textarea (markdown)
Save button


Edit Post: Same as create, pre-populated
Delete Post: Confirmation required
Logout: Destroy session

File Naming Convention
Blog posts saved as: YYYY-MM-DD-slug-from-title.md

🧩 PARTIALS IMPLEMENTATION
Required Partials
Layout Partials:

base.php: Main HTML structure, includes other partials
meta.php: Dynamic SEO tags, Open Graph, Twitter Cards
header.php: Logo, desktop nav, mobile menu trigger
nav.php: Navigation items (reused in header and mobile)
mobile-menu.php: Hamburger menu for small screens
footer.php: Copyright, basic links

Component Partials:

service-card.php: Reusable service display block
blog-card.php: Blog post preview card
cta-section.php: Call-to-action sections
contact-form.php: Contact form fields and structure
alert.php: Success/error message display

Helper Functions Required

render_partial($name, $data): Include partial with data
render_page($template, $data): Render full page with layout
get_blog_posts($limit): Retrieve blog posts
parse_markdown($content): Convert markdown to HTML
create_slug($title): Generate URL-friendly slugs
is_authenticated(): Check admin session


⚙️ TECHNICAL REQUIREMENTS
Performance

Page load < 2 seconds on 3G
Lighthouse score 90+ (all metrics)
No render-blocking resources
Images lazy loaded

SEO

Clean URLs (/blog/post-slug)
Meta titles and descriptions
Open Graph tags
Canonical URLs
Sitemap.xml (static for now)
Robots.txt

Security

Password: bcrypt hashed
CSRF protection on forms
XSS prevention (escape output)
HTTPS required
Rate limiting on login (5 attempts)
Secure session handling

Browser Support

Chrome (last 2 versions)
Firefox (last 2 versions)
Safari (last 2 versions)
Edge (last 2 versions)
Mobile browsers (iOS Safari, Chrome Mobile)


🚀 DEVELOPMENT TIMELINE
Week 1: Foundation & Partials

 Setup file structure
 Create router (index.php)
 Implement base layout and core partials
 Configure Tailwind CDN
 Create helper functions
 Setup config file

Week 2: Content & Design

 Build homepage with StoryBrand messaging
 Create service cards partial and services page
 Implement CTA sections
 Build contact form and handler
 Mobile responsive testing
 Add custom CSS for gradients

Week 3: Blog System

 Integrate markdown parser (Parsedown)
 Create blog listing page
 Build blog post template
 Implement tag system
 Add pagination
 Create blog card partial

Week 4: Admin & Launch

 Build admin authentication
 Create blog CRUD interface
 Add form validation
 Implement alert system
 Final testing
 Deploy to production


✅ DEFINITION OF DONE
Must Complete for Launch:

 All 4 pages functional and responsive
 Blog system fully operational
 Admin can create/edit/delete posts
 Contact form sends emails
 Mobile responsive (tested on real devices)
 Basic SEO meta tags in place
 Password protection working
 No PHP errors or warnings
 Loading speed < 2 seconds
 Tested in all major browsers

Optional (If Time Permits):

 Favicon
 404 page
 RSS feed
 Auto-generate sitemap
 Basic analytics code


🚫 NOT IN PHASE 1
Do NOT implement these features:

AI content parsing
Database (stay file-based)
JavaScript frameworks
Build processes
User accounts
Search functionality
Email capture/newsletter
Calendly integration
Comments system
Related posts
Category filtering
Admin page editing (only blog)
Live preview
Cache management


📋 FINAL NOTES

Keep it simple - If a feature seems complex, it's probably Phase 2
File-based only - No database in Phase 1
Focus on content - The site must clearly communicate the value proposition
Mobile-first - Design for mobile, enhance for desktop
Manual is okay - Page content via JSON files, edited manually is fine for MVP

Success Metric: A professional, fast, working website that converts visitors into clients, demonstrating technical expertise through elegant simplicity.
Delivery: Deployable code that can go live immediately upon completion of Week 4 checklist.