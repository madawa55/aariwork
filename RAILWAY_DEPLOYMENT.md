# 🚂 Railway Deployment Guide

Complete guide to deploy your Yuhaa Aari Work website to Railway.app

---

## 📋 Prerequisites

1. **GitHub Account** - https://github.com (free)
2. **Railway Account** - https://railway.app (free tier available)
3. **Git Installed** - https://git-scm.com/downloads

---

## 🚀 Deployment Steps

### Step 1: Initialize Git Repository

Open Command Prompt in your project directory:

```cmd
cd D:\AARI_Work

# Initialize git repository
git init

# Add all files
git add .

# Create first commit
git commit -m "Initial commit - Yuhaa Aari Work website"
```

### Step 2: Create GitHub Repository

1. Go to https://github.com
2. Click **"+"** → **"New repository"**
3. Repository name: `aari-work-portfolio`
4. Description: `Portfolio website for Yuhaa Aari Work`
5. Keep it **Private** (recommended) or Public
6. **Don't** initialize with README (we already have files)
7. Click **"Create repository"**

### Step 3: Push to GitHub

Copy the commands from GitHub (they'll look like this):

```cmd
git remote add origin https://github.com/YOUR-USERNAME/aari-work-portfolio.git
git branch -M main
git push -u origin main
```

**Note:** Replace `YOUR-USERNAME` with your actual GitHub username

### Step 4: Deploy to Railway

1. **Go to Railway:**
   - Visit https://railway.app
   - Click **"Login"** → **"Login with GitHub"**
   - Authorize Railway to access your GitHub

2. **Create New Project:**
   - Click **"New Project"**
   - Select **"Deploy from GitHub repo"**
   - Choose your repository: `aari-work-portfolio`

3. **Railway Auto-Detection:**
   - Railway will automatically detect the Dockerfile
   - It will start building your application
   - Wait 3-5 minutes for the build to complete

4. **Generate Domain:**
   - Click on your deployed service
   - Go to **"Settings"** tab
   - Scroll to **"Networking"** section
   - Click **"Generate Domain"**
   - Copy your URL (e.g., `your-app.up.railway.app`)

5. **Open Your Website:**
   - Click the generated URL
   - Your website is now live! 🎉

---

## 🔧 Configuration

### Environment Variables (Optional)

If you want to customize settings without changing code:

1. In Railway, go to your project
2. Click **"Variables"** tab
3. Add these variables:

```
SITE_NAME=Your Business Name
ADMIN_EMAIL=your-email@example.com
SITE_EMAIL=noreply@your-domain.com
```

### Custom Domain (Optional)

1. In Railway, go to **Settings** → **Networking**
2. Click **"Custom Domain"**
3. Enter your domain (e.g., `www.aariwork.lk`)
4. Follow DNS configuration instructions

---

## 📁 Persistent Storage

**Important:** Railway containers are ephemeral. Your uploaded images and data will be lost on restart unless you use Railway's volume feature.

### Option 1: Use Railway Volumes (Recommended)

1. In Railway, click your service
2. Go to **"Volumes"** tab
3. Click **"Add Volume"**
4. Mount path: `/var/www/html/writable`
5. Click **"Add"**

Repeat for uploads:
6. Click **"Add Volume"** again
7. Mount path: `/var/www/html/public/uploads`
8. Click **"Add"**

### Option 2: Use External Storage

For production, consider using:
- **Cloudinary** - For image storage
- **AWS S3** - For file storage
- **Railway PostgreSQL** - For data storage (requires code modification)

---

## 🔒 Security Steps

### 1. Change Admin Password

After deployment:

1. Login to your Railway URL
2. Go to `https://your-app.up.railway.app/admin/login`
3. Login with: `admin` / `admin123`
4. Change the password immediately!

**To change password manually:**

1. In Railway, click **"Deployments"**
2. Find the latest deployment
3. Click **"View Logs"**
4. Or use Railway CLI to access files

### 2. Update Settings

Access your Railway deployment and update:
- Email addresses
- Phone numbers
- Social media links
- Business information

---

## 🔄 Updating Your Website

### When You Make Changes:

```cmd
# Navigate to project
cd D:\AARI_Work

# Make your changes to files...

# Add changes
git add .

# Commit changes
git commit -m "Description of changes"

# Push to GitHub
git push origin main
```

Railway will **automatically redeploy** when you push to GitHub! 🚀

---

## 📊 Monitoring

### View Logs

1. Go to Railway dashboard
2. Click your project
3. Click **"Deployments"**
4. Click latest deployment
5. Click **"View Logs"**

### Check Metrics

1. Click **"Metrics"** tab
2. View:
   - CPU usage
   - Memory usage
   - Network traffic

---

## 💰 Railway Pricing

### Free Tier (Hobby Plan)
- **$5 free credits/month**
- Perfect for testing and small sites
- Automatic sleep after inactivity (can be disabled)

### Usage Estimates
- Small portfolio site: ~$2-3/month
- With images and traffic: ~$5-8/month

**Tip:** Railway only charges for actual usage!

---

## 🛠️ Troubleshooting

### Build Failed

**Check:**
1. View build logs in Railway
2. Ensure Dockerfile is correct
3. Check all files are committed to git

**Solution:**
```cmd
git add .
git commit -m "Fix build issues"
git push origin main
```

### Website Shows 500 Error

**Check:**
1. View application logs in Railway
2. Check file permissions
3. Verify data files exist

**Solution:**
- Redeploy from Railway dashboard
- Check logs for specific errors

### Images Not Uploading

**Problem:** Ephemeral filesystem
**Solution:** Add Railway volumes (see Persistent Storage above)

### Can't Login to Admin

**Check:**
1. Ensure data files were created
2. View logs for errors
3. Try default credentials: admin / admin123

---

## 🔗 Useful Railway Commands

### Install Railway CLI (Optional)

```cmd
# Windows (PowerShell)
iwr https://railway.app/install.ps1 | iex
```

### Common CLI Commands

```cmd
# Login to Railway
railway login

# Link to project
railway link

# View logs
railway logs

# Open in browser
railway open

# Run command in Railway environment
railway run php artisan migrate
```

---

## 📱 Testing Your Deployment

### Checklist

- [ ] Homepage loads correctly
- [ ] Can access admin panel
- [ ] Can login with default credentials
- [ ] Dashboard displays properly
- [ ] Can create a test work
- [ ] Can upload images (if volumes configured)
- [ ] Gallery displays works
- [ ] Contact form works
- [ ] Mobile responsive works
- [ ] All pages load correctly

---

## 🎯 Production Checklist

Before announcing your site:

### Security
- [ ] Changed admin password
- [ ] Updated email addresses
- [ ] Removed test data
- [ ] SSL/HTTPS enabled (automatic on Railway)

### Content
- [ ] Added real portfolio works
- [ ] Added testimonials
- [ ] Updated all settings
- [ ] Added social media links
- [ ] Filled contact information

### Configuration
- [ ] Set up Railway volumes for persistence
- [ ] Configured custom domain (optional)
- [ ] Set up backups
- [ ] Tested on mobile devices

### Performance
- [ ] Optimized images before upload
- [ ] Tested page load speed
- [ ] Verified responsive design
- [ ] Checked all links work

---

## 💾 Backup Strategy

### Automated Backups

Since Railway uses containers, set up automated backups:

1. **Weekly Backup Script:**
   - Download all data files
   - Download all uploaded images
   - Store in cloud storage

2. **GitHub as Backup:**
   - Commit data files to a private branch
   - Use `.gitignore` to exclude sensitive data

### Manual Backup

```cmd
# Clone repository
git clone https://github.com/YOUR-USERNAME/aari-work-portfolio.git

# Your code is backed up!
# For data files and uploads, download from Railway volumes
```

---

## 🌐 Custom Domain Setup

### Using Your Own Domain (e.g., aariwork.lk)

1. **In Railway:**
   - Settings → Networking → Custom Domain
   - Add: `www.aariwork.lk` or `aariwork.lk`

2. **In Your Domain Provider:**
   - Add CNAME record:
     - Name: `www`
     - Value: `your-app.up.railway.app`

   Or A record:
   - Get IP from Railway
   - Add A record pointing to that IP

3. **Wait for DNS:**
   - DNS propagation takes 1-24 hours
   - Check status: https://dnschecker.org

---

## 📈 Scaling

### If Your Site Gets Popular:

1. **Upgrade Railway Plan:**
   - Go to Settings → Plan
   - Upgrade to Pro for more resources

2. **Optimize Images:**
   - Use image compression
   - Implement lazy loading (already included)

3. **Add CDN:**
   - Use Cloudflare (free)
   - Point DNS through Cloudflare

---

## 🆘 Getting Help

### Railway Support
- Discord: https://discord.gg/railway
- Docs: https://docs.railway.app
- Twitter: @Railway

### Project Documentation
- README.md - Full documentation
- START_HERE.md - Quick start guide
- QUICKSTART.md - Local testing

---

## ✅ Quick Reference

### Your Railway URLs

After deployment, you'll have:
- **Website:** `https://your-app.up.railway.app`
- **Admin:** `https://your-app.up.railway.app/admin/login`
- **Gallery:** `https://your-app.up.railway.app/gallery`
- **Contact:** `https://your-app.up.railway.app/contact`

### Default Login
- **Username:** `admin`
- **Password:** `admin123` (⚠️ CHANGE THIS!)

### Important Paths in Container
- **Data:** `/var/www/html/writable/data/`
- **Uploads:** `/var/www/html/public/uploads/`
- **Logs:** `/var/www/html/writable/logs/`

---

## 🎉 Success!

Your website is now live on Railway!

**Next Steps:**
1. Test all functionality
2. Change admin password
3. Add your content
4. Share with the world!

**Your website is accessible from anywhere in the world! 🌍**

---

**Need help?** Check the other documentation files or Railway's support channels.

**Built with ❤️ for Yuhaa Aari Work**
