<?php
/**
 * Database Configuration
 * Using File-Based Storage (JSON files)
 */

// Site configuration
define('SITE_NAME', 'Yuhaa Aari Work');
define('SITE_EMAIL', 'info@aariwork.lk');
define('ADMIN_EMAIL', 'admin@aariwork.lk');

// Security
define('CSRF_TOKEN_NAME', 'csrf_token');
define('SESSION_TIMEOUT', 3600); // 1 hour

// Upload settings
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']);
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('THUMBNAIL_WIDTH', 400);
define('THUMBNAIL_HEIGHT', 300);

// Initialize data files if they don't exist
function initDataFiles() {
    $dataFiles = [
        'admin.json' => ['username' => 'admin', 'password' => password_hash('admin123', PASSWORD_BCRYPT), 'email' => ADMIN_EMAIL],
        'works.json' => [],
        'categories.json' => [
            ['id' => 1, 'name' => 'Bridal', 'color' => '#ff6b9d', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'name' => 'Casual', 'color' => '#4ecdc4', 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 3, 'name' => 'Traditional', 'color' => '#ffe66d', 'created_at' => date('Y-m-d H:i:s')]
        ],
        'testimonials.json' => [],
        'contacts.json' => [],
        'analytics.json' => ['total_views' => 0, 'page_views' => []],
        'settings.json' => [
            'site_name' => SITE_NAME,
            'tagline' => 'Exquisite Aari Embroidery Work',
            'contact_email' => SITE_EMAIL,
            'phone' => '+94 77 123 4567',
            'address' => 'Colombo, Sri Lanka',
            'facebook' => 'https://facebook.com/aariwork',
            'instagram' => 'https://instagram.com/aariwork',
            'whatsapp' => '+94771234567'
        ]
    ];

    foreach ($dataFiles as $file => $defaultData) {
        $filePath = DATAPATH . $file;
        if (!file_exists($filePath)) {
            file_put_contents($filePath, json_encode($defaultData, JSON_PRETTY_PRINT));
        }
    }
}

initDataFiles();
