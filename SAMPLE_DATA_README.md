# Sample Data Setup Guide

Your website now includes comprehensive sample data to showcase the minimalist theme and all features!

## 📦 What's Included

### ✅ Sample Categories (6 items)
- **Bridal** - For bridal wear and wedding collections
- **Casual** - Everyday and casual wear
- **Traditional** - Classic traditional designs
- **Party Wear** - Festive and party collections
- **Ethnic** - Ethnic wear and cultural designs
- **Contemporary** - Modern and contemporary styles

*Colors have been updated to match the minimalist theme palette.*

### ✅ Sample Works/Products (8 items)
1. **Elegant Bridal Lehenga with Golden Threads** - Bridal, Traditional
2. **Contemporary Floral Saree Border** - Casual, Contemporary
3. **Royal Blue Party Wear Anarkali** - Party Wear, Ethnic
4. **Traditional Peacock Motif Blouse** - Traditional, Ethnic
5. **Minimalist White Kurta Set** - Casual, Contemporary
6. **Red Bridal Dupatta with Heavy Work** - Bridal, Traditional
7. **Pastel Pink Festive Gown** - Party Wear, Contemporary
8. **Emerald Green Ethnic Jacket** - Ethnic, Contemporary

*Each work includes detailed descriptions, multiple categories, view counts, and image references.*

### ✅ Sample Testimonials (6 items)
- Customer reviews with names, messages, and 4-5 star ratings
- All testimonials are published and visible on the homepage
- Includes authentic-sounding feedback from various customers

### ✅ Sample Contact Messages (5 items)
- Mix of inquiries: custom designs, orders, business inquiries
- Some marked as read, others as unread (for admin panel demo)
- Realistic messages with phone numbers and service types

## 🎨 Generating Placeholder Images

The sample data references placeholder images. You have **two options** to generate them:

### Option 1: Web-Based Generator (Recommended)

1. Start your local PHP server
2. Open your browser and navigate to:
   ```
   http://localhost/setup-samples.php?key=generate123
   ```
3. The script will automatically generate all 24 placeholder images
4. Once complete, **delete the `setup-samples.php` file** for security

### Option 2: Command Line (If PHP is in PATH)

```bash
php generate-sample-images.php
```

### What the Generator Creates

- **24 placeholder images** with different colors matching each product
- Images are **800x800px** in high quality (JPEG)
- Each image includes:
  - Colored background matching the product theme
  - Decorative pattern overlay
  - Product name text
  - Professional border
  - "Yuhaa Aari Work - Sample" watermark

All images are saved to: `public/uploads/works/`

## 🚀 Viewing Your Sample Data

### Public Website

Visit your website to see:
- **Homepage** → Shows 8 featured works and 3 testimonials
- **Gallery** → Browse all 8 works, filter by categories
- **Contact** → Contact form ready to receive messages

### Admin Panel

1. Login at: `http://localhost/admin/login`
2. Default credentials:
   - Username: `admin`
   - Password: `admin123`

In the admin panel you can:
- **Dashboard** → View statistics and recent activity
- **Works** → Manage all 8 sample works
- **Categories** → See all 6 categories
- **Testimonials** → Manage 6 customer reviews
- **Messages** → View 5 sample contact messages (3 unread, 2 read)
- **Analytics** → View sample analytics data

## 🔄 Replacing Sample Data

### Adding Real Images

1. Login to admin panel
2. Go to **Works** → Click on any work
3. Click **Edit**
4. Upload your real product images
5. Save changes

### Adding New Works

1. Login to admin panel
2. Go to **Works** → Click **Add New Work**
3. Fill in title, description, select categories
4. Upload real images
5. Click **Create Work**

### Editing Sample Data

All sample data is stored in JSON files at:
- `writable/data/works.json`
- `writable/data/categories.json`
- `writable/data/testimonials.json`
- `writable/data/contacts.json`

You can edit these files directly or use the admin panel.

## 🎨 Customization Tips

### Update Colors

Categories have colors assigned. To match your brand:
1. Login to admin panel
2. Go to **Categories**
3. Edit each category
4. Update the color codes

### Featured Works

The homepage shows the most recent 8 works. To feature specific works:
- Edit their `created_at` dates in `works.json` (newer dates appear first)
- Or delete sample works and add your own through the admin panel

### Testimonials

To manage testimonials:
1. Login to admin panel
2. Go to **Testimonials**
3. Click **Add New** or **Edit** existing ones
4. Toggle **Published** status to show/hide on homepage

## 🧹 Clean Up

After you're done testing with sample data:

### Remove Sample Works
```bash
# Delete sample images
rm -rf public/uploads/works/sample-*.jpg
```

Then clear the works data:
- Login to admin panel
- Delete each sample work manually
- Or reset `writable/data/works.json` to `[]`

### Remove Setup Scripts
```bash
# Delete these files once you're done
rm public/setup-samples.php
rm generate-sample-images.php
rm SAMPLE_DATA_README.md  # This file
```

## 📊 Sample Data Statistics

- Total Works: 8
- Total Categories: 6
- Total Testimonials: 6
- Total Contact Messages: 5
- Total Images: 24 (once generated)
- Total Views: 1,764 (across all works)

## 🎉 What's Next?

1. **Generate placeholder images** using one of the methods above
2. **View your website** to see the beautiful minimalist design in action
3. **Explore the admin panel** to familiarize yourself with management features
4. **Replace sample content** with your real aari embroidery work
5. **Customize colors and branding** to match your business
6. **Start accepting real customer inquiries!**

## ℹ️ Notes

- All sample data uses realistic names, descriptions, and details
- Categories use minimalist theme colors (#c9ab81, #1a1a1a, etc.)
- Sample dates range from Nov 1-8, 2025
- View counts are realistic (156-312 views)
- Contact messages include both read and unread states
- All testimonials are set to "published" status

## 🆘 Need Help?

If you encounter any issues:
1. Check that PHP GD library is installed (`php -m | grep gd`)
2. Verify file permissions on `public/uploads/works/` (755)
3. Check PHP error logs for any issues
4. Ensure your local server is running

---

**Enjoy your new minimalist portfolio website!** 🎨✨
