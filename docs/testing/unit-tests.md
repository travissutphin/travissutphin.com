# Unit Testing Documentation

## Overview
Unit tests for travissutphin.com focus on testing individual PHP functions and components in isolation.

## Test Structure
- Tests located in `/tests/unit/`
- One test file per component/module
- Follow naming convention: `{ComponentName}Test.php`

## Key Areas to Test
1. Markdown parsing functions
2. Route handling logic
3. Template rendering functions
4. Dark mode toggle functionality
5. Blog post date parsing

## Running Tests
```bash
# Run all unit tests
php tests/run-unit-tests.php

# Run specific test
php tests/unit/MarkdownTest.php
```

## Test Coverage Goals
- Minimum 80% code coverage
- 100% coverage for critical functions
- All edge cases documented

## Writing New Tests
1. Create test file in `/tests/unit/`
2. Include assertions for:
   - Expected behavior
   - Error handling
   - Edge cases
3. Document test purpose clearly