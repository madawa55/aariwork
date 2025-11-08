# Quick Start Guide

## Testing Locally on Windows

### Method 1: Using PHP Built-in Server (Recommended for Testing)

1. **Navigate to the project directory:**
   ```cmd
   cd D:\AARI_Work\public
   ```

2. **Start PHP built-in server:**
   ```cmd
   php -S localhost:8000
   ```

3. **Open your browser:**
   - Public Site: `http://localhost:8000`
   - Admin Panel: `http://localhost:8000/admin/login`

4. **Login credentials:**
   - Username: `admin`
   - Password: `admin123`

### Method 2: Using XAMPP

1. **Install XAMPP** (if not already installed)
   - Download from: https://www.apachefriends.org/

2. **Move project to htdocs:**
   ```cmd
   Move D:\AARI_Work to C:\xampp\htdocs\aari
   ```

3. **Update Apache DocumentRoot** (optional for clean URLs):
   - Edit `C:\xampp\apache\conf\httpd.conf`
   - Change DocumentRoot to: `C:/xampp/htdocs/aari/public`

4. **Start Apache:**
   - Open XAMPP Control Panel
   - Start Apache

5. **Access the site:**
   - Public Site: `http://localhost/aari/public`
   - Admin Panel: `http://localhost/aari/public/admin/login`

### Method 3: Using WAMP

1. **Install WAMP** (if not already installed)
   - Download from: https://www.wampserver.com/

2. **Move project to www:**
   ```cmd
   Move D:\AARI_Work to C:\wamp64\www\aari
   ```

3. **Start WAMP Server**

4. **Access the site:**
   - Public Site: `http://localhost/aari/public`
   - Admin Panel: `http://localhost/aari/public/admin/login`

## First Steps After Installation

### 1. Add Your First Work

1. Login to admin panel
2. Click "Works" → "Add New Work"
3. Fill in details:
   - Title: "Sample Bridal Work"
   - Description: "Beautiful bridal aari work with intricate designs"
   - Categories: Select "Bridal"
   - Images: Upload 2-3 sample images

### 2. Add a Testimonial

1. Go to "Testimonials"
2. Click "Add New Testimonial"
3. Fill in:
   - Customer Name: "Sarah Johnson"
   - Message: "Amazing work! The attention to detail is outstanding."
   - Rating: 5 stars
   - Check "Publish immediately"

### 3. Test Contact Form

1. Go to public website
2. Click "Contact"
3. Fill in the form and submit
4. Check admin panel → "Messages" to see the submission

### 4. Customize Settings

Edit `writable/data/settings.json`:

```json
{
    "site_name": "Your Business Name",
    "tagline": "Your Custom Tagline",
    "contact_email": "your-email@example.com",
    "phone": "+94 77 123 4567",
    "address": "Your Address",
    "facebook": "https://facebook.com/yourpage",
    "instagram": "https://instagram.com/yourpage",
    "whatsapp": "+94771234567"
}
```

## Common Issues & Solutions

### Issue: "Page not found" error

**Solution:**
- Make sure you're in the `public` directory when running PHP server
- Check that .htaccess file exists in public folder

### Issue: Images not uploading

**Solution:**
- Check folder permissions
- On Windows: Right-click `public/uploads` → Properties → Security → Edit → Give "Full Control"

### Issue: Can't login to admin

**Solution:**
- Default credentials: admin / admin123
- Reset password by editing `writable/data/admin.json`:
  ```json
  {
    "username": "admin",
    "password": "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
    "email": "admin@example.com"
  }
  ```
  This sets password to: `password`

### Issue: Contact form not sending emails

**Solution:**
- Email sending requires a properly configured mail server
- For local testing, check `writable/data/contacts.json` to see saved submissions
- For production, ensure your hosting has mail() function enabled

## Directory Permissions

### Windows (using PHP built-in server):
No special permissions needed

### Linux/Production Server:
```bash
chmod -R 755 writable/
chmod -R 755 public/uploads/
chmod 644 public/.htaccess
```

## Testing Checklist

- [ ] Can access homepage
- [ ] Can view gallery
- [ ] Can search works
- [ ] Can view individual work details
- [ ] Can submit contact form
- [ ] Can login to admin panel
- [ ] Can create a new work with images
- [ ] Can create categories
- [ ] Can add testimonials
- [ ] Can view messages
- [ ] Can view analytics

## Next Steps

1. **Upload your actual works:**
   - Take high-quality photos of your aari work
   - Upload through admin panel

2. **Customize design:**
   - Edit colors in `public/assets/css/style.css`
   - Update site name and tagline

3. **Add social media links:**
   - Update settings.json with your actual social media URLs

4. **Deploy to production:**
   - Follow the deployment guide in README.md
   - Consider using shared hosting (HostGator, Bluehost) or cloud hosting (DigitalOcean, AWS)

## Sample Data

To help you get started, here are some sample works you can add:

### Work 1: Bridal Aari Work
- **Title:** Elegant Bridal Saree Embroidery
- **Description:** Intricate aari work on silk saree featuring floral motifs and traditional patterns. Perfect for bridal occasions.
- **Categories:** Bridal, Traditional

### Work 2: Casual Design
- **Title:** Modern Casual Dress Embroidery
- **Description:** Contemporary aari designs on cotton fabric with geometric patterns.
- **Categories:** Casual

### Work 3: Traditional Work
- **Title:** Classic Temple Border Design
- **Description:** Traditional temple border aari work with peacock and lotus motifs.
- **Categories:** Traditional

## Resources

- **Free Stock Photos for Testing:**
  - https://unsplash.com (search "embroidery")
  - https://pexels.com (search "textile")

- **Color Palette Generator:**
  - https://coolors.co

- **Icon Resources:**
  - https://emojipedia.org (for emoji icons used in site)

## Support

If you encounter any issues:

1. Check PHP error logs
2. Verify all files are uploaded correctly
3. Ensure proper permissions on writable directories
4. Check browser console for JavaScript errors

---

**Ready to launch?** Follow the deployment guide in README.md!
