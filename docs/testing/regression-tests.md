# Regression Testing Documentation

## Overview
Regression tests ensure that new changes don't break existing functionality in travissutphin.com.

## Test Checklist
Run after each feature implementation or bug fix:

### Core Functionality
- [ ] Home page loads correctly
- [ ] Navigation works (desktop & mobile)
- [ ] All links use correct BASE_PATH
- [ ] 404 page displays for invalid routes

### Blog System
- [ ] Blog listing page displays all posts
- [ ] Individual blog posts render correctly
- [ ] Blog dates parse and display properly
- [ ] No blank pages in blog section

### Dark Mode
- [ ] Toggle switches between themes
- [ ] Theme preference persists (localStorage)
- [ ] All pages respect theme setting
- [ ] No flash of wrong theme on load

### Mobile Experience
- [ ] Bottom navigation displays on mobile
- [ ] Touch interactions work correctly
- [ ] Content is responsive at all breakpoints
- [ ] No horizontal scroll issues

### Performance
- [ ] Page load time < 3 seconds
- [ ] No console errors in browser
- [ ] All assets load correctly
- [ ] Tailwind CDN loads properly

## Running Regression Tests
1. Clear browser cache
2. Test in multiple browsers (Chrome, Firefox, Safari)
3. Test on mobile device or emulator
4. Check all items in checklist above

## Reporting Issues
Document any failures with:
- Browser/device used
- Steps to reproduce
- Expected vs actual behavior
- Screenshots if applicable