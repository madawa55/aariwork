#!/bin/bash

# Railway Deployment Script for Yuhaa Aari Work
# This script helps you deploy to Railway quickly

echo "========================================"
echo "Railway Deployment Helper"
echo "Yuhaa Aari Work Portfolio Website"
echo "========================================"
echo ""

# Check if git is installed
if ! command -v git &> /dev/null; then
    echo "❌ Git is not installed. Please install Git first:"
    echo "   https://git-scm.com/downloads"
    exit 1
fi

echo "✓ Git is installed"
echo ""

# Check if this is already a git repository
if [ ! -d .git ]; then
    echo "📦 Initializing Git repository..."
    git init
    echo "✓ Git repository initialized"
else
    echo "✓ Git repository already exists"
fi

echo ""
echo "📝 Adding files to git..."
git add .

echo ""
echo "💬 Enter commit message (or press Enter for default):"
read -r commit_message

if [ -z "$commit_message" ]; then
    commit_message="Deploy to Railway - $(date '+%Y-%m-%d %H:%M:%S')"
fi

git commit -m "$commit_message"
echo "✓ Changes committed"

echo ""
echo "========================================"
echo "Next Steps:"
echo "========================================"
echo ""
echo "1. Create a GitHub repository:"
echo "   → Go to https://github.com/new"
echo "   → Name: aari-work-portfolio"
echo "   → Keep it Private"
echo "   → Don't initialize with README"
echo "   → Click 'Create repository'"
echo ""
echo "2. Link this repository to GitHub:"
echo "   → Copy the commands from GitHub"
echo "   → They will look like:"
echo "     git remote add origin https://github.com/YOUR-USERNAME/aari-work-portfolio.git"
echo "     git branch -M main"
echo "     git push -u origin main"
echo ""
echo "3. Deploy to Railway:"
echo "   → Go to https://railway.app"
echo "   → Click 'New Project'"
echo "   → Select 'Deploy from GitHub repo'"
echo "   → Choose 'aari-work-portfolio'"
echo "   → Wait 3-5 minutes for deployment"
echo "   → Generate domain in Settings → Networking"
echo ""
echo "4. Access your website:"
echo "   → Public: https://your-app.up.railway.app"
echo "   → Admin: https://your-app.up.railway.app/admin/login"
echo ""
echo "📚 For detailed instructions, see:"
echo "   RAILWAY_DEPLOYMENT.md"
echo ""
echo "✅ Your code is ready to deploy!"
echo ""
