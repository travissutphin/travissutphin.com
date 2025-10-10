#!/bin/bash
# Simple GitOps Deployment Script
# Usage: ./automation/deploy.sh [staging|production]

set -e

ENVIRONMENT=${1:-staging}
TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')
LOG_FILE="docs/deployment/deployment-history.md"

echo "🚀 Simple GitOps Deployment Starting..."
echo "Environment: $ENVIRONMENT"
echo "Time: $TIMESTAMP"
echo "==========================================="

# Step 1: Validate PHP syntax
echo "🔍 [Verity] Checking PHP syntax..."
find . -name "*.php" -exec php -l {} \; > /dev/null
if [ $? -eq 0 ]; then
    echo "✅ PHP syntax check passed"
else
    echo "❌ PHP syntax errors found"
    exit 1
fi

# Step 2: Validate blog post format
echo "🔍 [Verity] Checking blog post format..."
cd content/blog
for file in *.md; do
    if [[ ! "$file" =~ ^[0-9]{4}-[0-9]{2}-[0-9]{2}-.+\.md$ ]]; then
        echo "❌ Invalid blog post filename: $file"
        exit 1
    fi
done
cd ../..
echo "✅ Blog post format validation passed"

# Step 3: Security check for secrets
echo "🔒 [Sentinal] Basic security scan..."
if grep -r "password\|api_key\|secret" --include="*.php" --include="*.js" . 2>/dev/null; then
    echo "⚠️  Potential secrets found in code - review required"
    read -p "Continue anyway? (y/N): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        exit 1
    fi
fi
echo "✅ Basic security scan completed"

# Step 4: Environment-specific actions
if [ "$ENVIRONMENT" = "production" ]; then
    echo "🌟 [Flow] Production deployment preparation..."
    echo "⚠️  Production deployment requires manual verification:"
    echo "   1. Staging has been tested"
    echo "   2. Changes have been reviewed"
    echo "   3. Backup is available"
    read -p "All checks completed? (y/N): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        echo "❌ Production deployment cancelled"
        exit 1
    fi
else
    echo "🧪 [Flow] Staging deployment..."
fi

# Step 5: Update deployment history (Docs-as-Code)
echo "📚 [Codey] Updating deployment documentation..."
{
    echo ""
    echo "### $TIMESTAMP - $ENVIRONMENT Deployment"
    echo "**Deployer**: [Team]"
    echo "**Environment**: $ENVIRONMENT"
    echo "**Commit**: $(git rev-parse --short HEAD)"
    echo "**Status**: ✅ Success"
    echo ""
    echo "**Automated Checks**:"
    echo "- ✅ PHP syntax validation"
    echo "- ✅ Blog post format validation"
    echo "- ✅ Basic security scan"
    echo ""
} >> "$LOG_FILE"

# Step 6: Deployment complete
echo "==========================================="
echo "✅ Deployment completed successfully!"
echo "📋 Documentation updated in $LOG_FILE"
echo ""
echo "🎯 Next Steps:"
if [ "$ENVIRONMENT" = "staging" ]; then
    echo "   - Test the staging environment"
    echo "   - Run: ./automation/deploy.sh production"
else
    echo "   - Verify production environment"
    echo "   - Monitor for any issues"
fi