# Yuhaa Aari Work Portfolio Website - Project Specification

## 1. Project Overview
**Business**: Yuhaa Aari Work - Single-owner business specializing in traditional aari embroidery work
**Website Purpose**: Professional portfolio website to showcase past and current aari work projects
**Reference Site**: https://www.aariwork.lk/
**Target Audience**: Potential customers looking for aari embroidery services

## 2. Technical Stack

### Framework & Language
- **Framework**: CodeIgniter 4.x
- **Language**: PHP 8.0+
- **Storage**: File-based system (NO DATABASE)
  - JSON files for data storage
  - File system for image management
  - Flat file structure for configuration

### Frontend Technologies
- **CSS Framework**: Bootstrap 5 / Tailwind CSS (responsive design)
- **JavaScript**: Vanilla JS or jQuery for interactivity
- **Image Optimization**: PHP GD Library or Intervention Image

## 3. File-Based Data Storage Structure

### Data Files (stored in `/writable/data/`)
```
/writable/data/
├── works.json          # All portfolio work items
├── categories.json     # Work categories/tags
├── testimonials.json   # Customer reviews
├── contacts.json       # Contact form submissions
├── analytics.json      # Basic visitor analytics
└── admin.json         # Admin credentials (hashed)
```

### Image Storage (stored in `/public/uploads/`)
```
/public/uploads/
├── works/
│   ├── work-{id}/
│   │   ├── original/   # Original uploaded images
│   │   └── thumb/      # Thumbnail versions
├── thumbnails/         # Category thumbnails
└── temp/              # Temporary upload location
```

## 4. Feature Requirements

### 4.1 Public-Facing Features

#### A. Homepage
- Hero section with featured work
- Brief business introduction
- Call-to-action buttons (Contact, View Gallery)
- Latest 6-8 work items preview

#### B. Gallery/Portfolio Section
- Grid layout displaying all work items
- Filter by categories/tags
- **Search functionality** - Search by title, description, or tags
- Lightbox/modal view for images
- Multiple images per work item with image carousel
- Lazy loading for performance

#### C. Individual Work Detail Page
- Multiple image carousel/slider
- Work description and details
- Category tags
- Related work suggestions
- Social media share buttons

#### D. Contact Form
- Fields: Name, Email, Phone, Message, Service Type
- Form validation (client-side and server-side)
- Email notification to owner
- Save submission to `contacts.json`
- Success/error feedback messages

#### E. Testimonials Section
- Display customer reviews
- Star rating system
- Customer name and date
- Optional customer photo

#### F. Social Media Integration
- Social media icon links (Facebook, Instagram, WhatsApp)
- WhatsApp direct message button for quick inquiries
- Instagram feed embed (optional)

#### G. Search Functionality
- Search bar in header/navigation
- Search through work titles, descriptions, and tags
- Display search results in gallery format

### 4.2 Admin Panel Features

#### A. Authentication
- Secure login page (`/admin/login`)
- Session-based authentication
- Password hashing (PHP `password_hash()`)
- CSRF protection
- Auto-logout after inactivity

#### B. Dashboard
- Overview statistics:
  - Total works posted
  - Total images uploaded
  - Pending contact messages
  - Recent visitor analytics (views this week/month)
- Quick action buttons

#### C. Work Management
- **Add New Work**:
  - Upload multiple images (drag & drop)
  - Work title and description
  - Select/create categories/tags
  - Image reordering
  - Set featured image

- **Edit Existing Work**:
  - Modify all work details
  - Add/remove images
  - Update categories

- **Delete Work**:
  - Confirmation prompt
  - Cascade delete all related images

#### D. Category/Tag Management
- Create, edit, delete categories
- Assign colors to categories
- Category usage statistics

#### E. Testimonial Management
- Add new testimonials
- Edit/delete existing testimonials
- Approve/hide testimonials
- Star rating input

#### F. Contact Messages
- View all contact form submissions
- Mark as read/unread
- Delete messages
- Reply via email (optional)

#### G. Basic Analytics
- Page views tracking
- Most viewed work items
- Visitor statistics (daily/weekly/monthly)
- Contact form submission trends
- Export analytics to CSV

#### H. Settings
- Update admin password
- Site configuration (site name, tagline, contact info)
- Social media links management
- Email notification settings

## 5. Security Considerations

- **Input Validation**: Sanitize all user inputs
- **File Upload Security**:
  - Whitelist allowed image types (jpg, jpeg, png, webp)
  - Validate file MIME types
  - Generate unique filenames
  - Limit file sizes (max 5MB per image)
- **Authentication**:
  - Bcrypt password hashing
  - Session hijacking protection
  - Rate limiting on login attempts
- **CSRF Protection**: CodeIgniter's built-in CSRF tokens
- **XSS Prevention**: Escape output data
- **Directory Permissions**: Restrict access to data files

## 6. Responsive Design Requirements

- Mobile-first approach
- Breakpoints: Mobile (320px+), Tablet (768px+), Desktop (1024px+)
- Touch-friendly navigation and gallery
- Optimized images for different screen sizes
- Fast loading times (under 3 seconds)

## 7. File Structure (CodeIgniter 4)

```
/app/
├── Controllers/
│   ├── Home.php                 # Public pages
│   ├── Gallery.php              # Gallery and work details
│   ├── Contact.php              # Contact form handling
│   └── Admin/
│       ├── Auth.php             # Admin login/logout
│       ├── Dashboard.php        # Admin dashboard
│       ├── Works.php            # Work management
│       ├── Categories.php       # Category management
│       ├── Testimonials.php     # Testimonial management
│       ├── Messages.php         # Contact messages
│       └── Analytics.php        # Analytics view
├── Models/
│   ├── WorkModel.php            # Work data operations
│   ├── CategoryModel.php        # Category operations
│   ├── TestimonialModel.php    # Testimonial operations
│   ├── ContactModel.php         # Contact form operations
│   └── AnalyticsModel.php       # Analytics tracking
├── Views/
│   ├── public/                  # Public-facing views
│   └── admin/                   # Admin panel views
└── Libraries/
    ├── FileStorage.php          # JSON file operations
    └── ImageHandler.php         # Image processing

/public/
├── uploads/                     # User-uploaded images
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
└── index.php

/writable/
└── data/                        # JSON data files
```

## 8. Development Phases

### Phase 1: Setup & Core Structure
- Install CodeIgniter 4
- Setup file-based storage system
- Create basic routing
- Implement admin authentication

### Phase 2: Admin Panel
- Build admin dashboard
- Implement work CRUD operations
- Multi-image upload functionality
- Category management

### Phase 3: Public Website
- Homepage design and implementation
- Gallery with filtering
- Individual work detail pages
- Responsive design implementation

### Phase 4: Additional Features
- Search functionality
- Contact form with email notifications
- Testimonials section
- Social media integration

### Phase 5: Analytics & Optimization
- Basic analytics implementation
- Image optimization
- Performance tuning
- Security hardening

### Phase 6: Testing & Deployment
- Cross-browser testing
- Mobile responsiveness testing
- Security testing
- Deploy to hosting server

## 9. Hosting Requirements

- PHP 8.0 or higher
- Apache/Nginx web server
- Mod_rewrite enabled (for clean URLs)
- Minimum 500MB storage space
- SSL certificate (for HTTPS)
- Email service (for contact form notifications)

## 10. Future Enhancements (Optional)

- Multi-language support (Sinhala/English)
- Before/after image comparisons
- Customer login for order tracking
- Online booking/appointment system
- Image watermarking
- Backup/restore functionality
- SEO optimization (meta tags, sitemap)