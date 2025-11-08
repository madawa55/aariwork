# Yuhaa Aari Work - Portfolio Website

A responsive portfolio website for Yuhaa Aari Work, showcasing beautiful handcrafted aari embroidery work. Built with PHP using a custom lightweight MVC framework with file-based storage (no database required).

## Features

### Public Features
- ✅ Responsive design (Mobile, Tablet, Desktop)
- ✅ Homepage with hero section and featured works
- ✅ Gallery with category filtering
- ✅ Search functionality
- ✅ Individual work detail pages with image carousel
- ✅ Contact form with email notifications
- ✅ Testimonials section
- ✅ Social media integration (Facebook, Instagram, WhatsApp)
- ✅ WhatsApp floating button
- ✅ SEO-friendly URLs

### Admin Panel Features
- ✅ Secure login system
- ✅ Dashboard with statistics
- ✅ Work management (Create, Edit, Delete)
- ✅ Multi-image upload with thumbnails
- ✅ Category/Tag management
- ✅ Testimonial management
- ✅ Contact message management
- ✅ Basic analytics tracking
- ✅ CSV export for analytics

## Requirements

- PHP 8.0 or higher
- Apache/Nginx web server with mod_rewrite enabled
- GD Library for image processing
- 500MB storage space minimum

## Installation

### Step 1: Upload Files

Upload all files to your web server. The directory structure should look like this:

```
your-website/
├── app/
├── public/
├── writable/
├── aari.md
└── README.md
```

### Step 2: Set Permissions

Set the correct permissions for the writable directory:

```bash
chmod -R 755 writable/
chmod -R 755 public/uploads/
```

### Step 3: Configure Web Server

#### For Apache:

The `.htaccess` file is already included in the `public` folder. Make sure mod_rewrite is enabled:

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

Set your document root to the `public` folder in your Apache configuration.

#### For Nginx:

Add this to your Nginx configuration:

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/your-website/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

### Step 4: Configure Email (Optional)

For contact form email notifications to work, ensure your server has a working mail() function or configure SMTP.

Edit `app/Config/Database.php` to update the email settings:

```php
define('ADMIN_EMAIL', 'your-email@example.com');
define('SITE_EMAIL', 'noreply@your-domain.com');
```

## Default Admin Credentials

**Important:** Change these after first login!

- **Username:** admin
- **Password:** admin123

## Usage

### Accessing the Website

- **Public Website:** `http://your-domain.com`
- **Admin Panel:** `http://your-domain.com/admin/login`

### Adding Your First Work

1. Log in to the admin panel
2. Navigate to "Works" from the sidebar
3. Click "Add New Work"
4. Fill in the title and description
5. Select categories
6. Upload multiple images
7. Click "Create Work"

### Managing Categories

1. Go to "Categories" in the admin panel
2. Click "Add New Category"
3. Enter category name and choose a color
4. Click "Add Category"

### Managing Testimonials

1. Go to "Testimonials" in the admin panel
2. Click "Add New Testimonial"
3. Enter customer name, message, and rating
4. Check "Publish immediately" if you want it visible
5. Click "Add Testimonial"

### Viewing Messages

1. Go to "Messages" in the admin panel
2. Click "View" on any message to see full details
3. Messages are automatically marked as read when viewed
4. Delete spam or old messages as needed

### Viewing Analytics

1. Go to "Analytics" in the admin panel
2. View statistics including:
   - Total views
   - Daily/Weekly/Monthly views
   - Most viewed works
3. Click "Export to CSV" to download analytics data

## File Structure

```
├── app/
│   ├── Config/          # Configuration files
│   ├── Controllers/     # Application controllers
│   │   ├── Admin/       # Admin panel controllers
│   │   ├── Home.php
│   │   ├── Gallery.php
│   │   └── Contact.php
│   ├── Models/          # Data models
│   ├── Views/           # View templates
│   │   ├── admin/       # Admin panel views
│   │   └── public/      # Public website views
│   └── Libraries/       # Custom libraries
│       ├── FileStorage.php
│       └── ImageHandler.php
├── public/              # Web accessible directory
│   ├── assets/
│   │   ├── css/
│   │   └── js/
│   ├── uploads/         # Uploaded images
│   ├── index.php        # Entry point
│   └── .htaccess
└── writable/
    ├── data/            # JSON data files
    ├── logs/
    └── cache/
```

## Data Storage

All data is stored in JSON files located in `writable/data/`:

- `admin.json` - Admin credentials
- `works.json` - Portfolio works
- `categories.json` - Categories/tags
- `testimonials.json` - Customer testimonials
- `contacts.json` - Contact form submissions
- `analytics.json` - Analytics data
- `settings.json` - Site settings

## Customization

### Changing Site Information

Edit `app/Config/Database.php`:

```php
define('SITE_NAME', 'Your Business Name');
define('SITE_EMAIL', 'your-email@example.com');
```

### Updating Social Media Links

Edit `writable/data/settings.json`:

```json
{
    "facebook": "https://facebook.com/your-page",
    "instagram": "https://instagram.com/your-account",
    "whatsapp": "+94771234567"
}
```

### Changing Colors

Edit `public/assets/css/style.css` and modify the CSS variables:

```css
:root {
    --primary-color: #d4526e;
    --secondary-color: #4a4a4a;
    --accent-color: #f0a500;
}
```

## Security

### Important Security Steps

1. **Change Admin Password:**
   - Log in to admin panel
   - Go to Settings (future feature) or manually edit `writable/data/admin.json`

2. **Secure Sensitive Files:**
   - The `.htaccess` file already protects sensitive files
   - Ensure `writable` directory is not web-accessible

3. **SSL Certificate:**
   - Install an SSL certificate for HTTPS
   - Uncomment the HTTPS redirect in `public/.htaccess`

4. **File Permissions:**
   ```bash
   chmod 644 public/.htaccess
   chmod 755 writable/
   chmod 755 public/uploads/
   ```

## Backup

### Backing Up Your Site

To backup your website, save these items:

1. **Data Files:** `writable/data/`
2. **Uploaded Images:** `public/uploads/`
3. **Configuration:** `app/Config/Database.php`

### Restore from Backup

1. Copy data files back to `writable/data/`
2. Copy images back to `public/uploads/`
3. Restore configuration file

## Troubleshooting

### Images Not Uploading

- Check folder permissions: `chmod 755 public/uploads/`
- Verify PHP upload limits in `php.ini`:
  ```
  upload_max_filesize = 10M
  post_max_size = 10M
  ```

### Contact Form Not Sending Emails

- Verify server mail() function is working
- Check spam folder
- Consider using SMTP instead of mail()

### .htaccess Not Working

- Enable mod_rewrite: `sudo a2enmod rewrite`
- Check Apache configuration allows `.htaccess` overrides

### Images Not Displaying

- Check file paths in JSON data files
- Verify correct permissions on upload directory
- Check browser console for 404 errors

## Performance Optimization

### Enable Caching

The `.htaccess` file includes caching rules for static files.

### Optimize Images

Before uploading, compress images using tools like:
- TinyPNG
- ImageOptim
- Squoosh

### Enable Gzip Compression

Already enabled in `.htaccess` if mod_deflate is available.

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Support

For issues or questions:
1. Check the troubleshooting section
2. Review PHP error logs
3. Contact your web hosting provider for server-related issues

## Credits

- Built for Yuhaa Aari Work
- Developed using custom PHP MVC framework
- Responsive design with mobile-first approach

## License

This project is proprietary software developed for Yuhaa Aari Work.

---

**Last Updated:** <?= date('Y-m-d') ?>
