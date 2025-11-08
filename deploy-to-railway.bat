@echo off
echo ========================================
echo Railway Deployment Helper
echo Yuhaa Aari Work Portfolio Website
echo ========================================
echo.

REM Check if git is installed
git --version >nul 2>&1
if errorlevel 1 (
    echo X Git is not installed. Please install Git first:
    echo   https://git-scm.com/downloads
    pause
    exit /b 1
)

echo √ Git is installed
echo.

REM Check if this is already a git repository
if not exist .git (
    echo Initializing Git repository...
    git init
    echo √ Git repository initialized
) else (
    echo √ Git repository already exists
)

echo.
echo Adding files to git...
git add .

echo.
set /p commit_message="Enter commit message (or press Enter for default): "

if "%commit_message%"=="" (
    set commit_message=Deploy to Railway
)

git commit -m "%commit_message%"
echo √ Changes committed

echo.
echo ========================================
echo Next Steps:
echo ========================================
echo.
echo 1. Create a GitHub repository:
echo    ^> Go to https://github.com/new
echo    ^> Name: aari-work-portfolio
echo    ^> Keep it Private
echo    ^> Don't initialize with README
echo    ^> Click 'Create repository'
echo.
echo 2. Link this repository to GitHub:
echo    Run these commands (replace YOUR-USERNAME):
echo.
echo    git remote add origin https://github.com/YOUR-USERNAME/aari-work-portfolio.git
echo    git branch -M main
echo    git push -u origin main
echo.
echo 3. Deploy to Railway:
echo    ^> Go to https://railway.app
echo    ^> Click 'New Project'
echo    ^> Select 'Deploy from GitHub repo'
echo    ^> Choose 'aari-work-portfolio'
echo    ^> Wait 3-5 minutes for deployment
echo    ^> Generate domain in Settings -^> Networking
echo.
echo 4. Access your website:
echo    ^> Public: https://your-app.up.railway.app
echo    ^> Admin: https://your-app.up.railway.app/admin/login
echo    ^> Login: admin / admin123 (CHANGE THIS!)
echo.
echo For detailed instructions, see:
echo    RAILWAY_DEPLOYMENT.md
echo.
echo √ Your code is ready to deploy!
echo.
pause
