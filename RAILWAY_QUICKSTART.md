# 🚂 Railway Quick Start - Deploy in 10 Minutes

Deploy your Yuhaa Aari Work website to Railway in just a few steps!

---

## ⚡ Super Quick Deployment (Fastest Way)

### 1. Run the Deployment Script

**Windows:**
```cmd
cd D:\AARI_Work
deploy-to-railway.bat
```

**Mac/Linux:**
```bash
cd /path/to/AARI_Work
chmod +x deploy-to-railway.sh
./deploy-to-railway.sh
```

### 2. Create GitHub Repository

1. Go to https://github.com/new
2. Repository name: `aari-work-portfolio`
3. Make it **Private**
4. Click **Create repository**
5. Copy the commands shown and run them:

```cmd
git remote add origin https://github.com/YOUR-USERNAME/aari-work-portfolio.git
git branch -M main
git push -u origin main
```

### 3. Deploy to Railway

1. Go to https://railway.app
2. Click **"Login with GitHub"**
3. Click **"New Project"**
4. Select **"Deploy from GitHub repo"**
5. Choose **"aari-work-portfolio"**
6. Wait 3-5 minutes ⏱️

### 4. Get Your URL

1. Click on your deployed service
2. Go to **Settings** → **Networking**
3. Click **"Generate Domain"**
4. Copy your URL (e.g., `aari-work.up.railway.app`)

### 5. Visit Your Website! 🎉

- **Website:** `https://your-app.up.railway.app`
- **Admin:** `https://your-app.up.railway.app/admin/login`
- **Login:** `admin` / `admin123`

**⚠️ IMPORTANT: Change the admin password immediately!**

---

## 📝 Manual Steps (Without Script)

If you prefer manual deployment:

### Step 1: Initialize Git

```cmd
cd D:\AARI_Work
git init
git add .
git commit -m "Initial commit"
```

### Step 2: Create GitHub Repo

Follow step 2 above

### Step 3: Push to GitHub

```cmd
git remote add origin https://github.com/YOUR-USERNAME/aari-work-portfolio.git
git branch -M main
git push -u origin main
```

### Step 4: Deploy to Railway

Follow steps 3-5 above

---

## 🔧 Essential Post-Deployment Setup

### 1. Add Persistent Storage (IMPORTANT!)

**Without this, your uploads will be lost on restart!**

1. In Railway, click your service
2. Click **"Volumes"** tab
3. Click **"New Volume"**
4. Mount path: `/var/www/html/writable`
5. Click **"Add"**

Repeat for uploads:
6. Click **"New Volume"** again
7. Mount path: `/var/www/html/public/uploads`
8. Click **"Add"**

### 2. Change Admin Password

1. Visit your admin panel
2. Login with default credentials
3. Change password immediately!

### 3. Update Site Settings

Edit on Railway or via admin panel:
- Business name
- Contact information
- Social media links

---

## 🔄 Updating Your Site

When you make changes:

```cmd
cd D:\AARI_Work

# Make your changes...

git add .
git commit -m "Describe your changes"
git push origin main
```

**Railway auto-deploys on push!** 🚀

---

## 💰 Cost Estimate

### Railway Pricing
- **Free:** $5/month credit (perfect for testing)
- **Usage:** ~$2-5/month for small portfolio sites
- **Only pay for what you use!**

---

## ⚙️ Important Files

These files make Railway deployment work:

- **Dockerfile** - Container configuration
- **railway.json** - Railway settings
- **.dockerignore** - Files to exclude
- **.gitignore** - Git exclusions

**Don't delete these files!**

---

## 🐛 Common Issues & Fixes

### "Build Failed"

**Check:**
- All files committed to git
- Dockerfile exists
- View build logs in Railway

**Fix:**
```cmd
git add .
git commit -m "Fix build"
git push
```

### "Can't Upload Images"

**Problem:** No persistent storage

**Fix:** Add Railway volumes (see above)

### "Website Shows Error"

**Check:**
- View logs in Railway dashboard
- Ensure data files initialized
- Check file permissions

**Fix:** Redeploy from Railway dashboard

### "Lost Data After Restart"

**Problem:** No volumes configured

**Fix:** Add volumes for `writable` and `uploads` directories

---

## 📊 Monitoring Your Site

### View Logs

1. Railway dashboard
2. Click your service
3. **Deployments** → Latest → **View Logs**

### Check Performance

1. **Metrics** tab
2. View CPU, Memory, Network usage

---

## 🔒 Security Checklist

After deployment:

- [ ] Changed admin password
- [ ] Updated email in settings
- [ ] Removed test data
- [ ] Added volumes for persistence
- [ ] SSL/HTTPS working (automatic)
- [ ] Tested on mobile

---

## 🎯 What's Included

Your Railway deployment includes:

✅ **Automatic HTTPS** - SSL certificate included
✅ **Auto-deploys** - Push to GitHub to update
✅ **Global CDN** - Fast worldwide
✅ **Automatic scaling** - Handles traffic spikes
✅ **99.9% uptime** - Reliable hosting
✅ **Easy rollbacks** - Revert to previous versions

---

## 📱 Test Your Deployment

### Quick Test Checklist

- [ ] Homepage loads
- [ ] Admin panel accessible
- [ ] Can login
- [ ] Dashboard shows
- [ ] Gallery works
- [ ] Mobile responsive
- [ ] Contact form works

### Full Test

1. Add a test work with images
2. Create a test category
3. Add a test testimonial
4. Submit contact form
5. Check analytics
6. Test on mobile device

---

## 🌐 Custom Domain (Optional)

Want to use your own domain like `aariwork.lk`?

1. Railway: **Settings** → **Networking** → **Custom Domain**
2. Add your domain
3. Update DNS at your domain provider
4. Wait 1-24 hours for DNS propagation

See **RAILWAY_DEPLOYMENT.md** for detailed instructions.

---

## 📞 Need Help?

### Documentation
- **RAILWAY_DEPLOYMENT.md** - Full deployment guide
- **README.md** - Complete documentation
- **START_HERE.md** - Local testing guide

### Railway Support
- Discord: https://discord.gg/railway
- Docs: https://docs.railway.app
- Status: https://railway.app/status

---

## ✅ Success Checklist

Your site is ready when:

- [ ] Website loads at Railway URL
- [ ] Can access admin panel
- [ ] Volumes configured for persistence
- [ ] Admin password changed
- [ ] Site settings updated
- [ ] Test content added
- [ ] Mobile tested
- [ ] Contact form working

---

## 🎉 You're Live!

**Congratulations!** Your website is now live on the internet!

**Share your website:**
- Copy your Railway URL
- Share on social media
- Send to clients
- Add to business cards

**Your Railway URL:**
`https://your-app.up.railway.app`

---

## 📈 Next Steps

1. **Add Content:**
   - Upload your portfolio works
   - Add customer testimonials
   - Fill in all settings

2. **Promote:**
   - Share on social media
   - Update business materials
   - Tell customers

3. **Monitor:**
   - Check analytics weekly
   - Respond to messages
   - Update content regularly

4. **Optimize:**
   - Add more works
   - Collect testimonials
   - Improve descriptions

---

## 💡 Pro Tips

1. **Regular Backups:** Download data files weekly
2. **Update Often:** Add new works to keep site fresh
3. **Monitor Usage:** Check Railway dashboard for costs
4. **Test Mobile:** Most visitors will use phones
5. **Quick Response:** Answer contact messages promptly

---

**Your website is live and ready for customers! 🚀**

For more details, see **RAILWAY_DEPLOYMENT.md**

**Built with ❤️ for Yuhaa Aari Work**
