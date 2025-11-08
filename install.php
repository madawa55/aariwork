<?php
/**
 * Installation Script
 * Run this once to initialize the website
 */

echo "===========================================\n";
echo "Yuhaa Aari Work - Installation Script\n";
echo "===========================================\n\n";

// Define paths
define('BASEPATH', __DIR__ . DIRECTORY_SEPARATOR);
define('DATAPATH', BASEPATH . 'writable' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);

// Create data directory if it doesn't exist
if (!is_dir(DATAPATH)) {
    mkdir(DATAPATH, 0755, true);
    echo "✓ Created data directory\n";
}

// Initialize data files
$dataFiles = [
    'admin.json' => [
        'username' => 'admin',
        'password' => password_hash('admin123', PASSWORD_BCRYPT),
        'email' => 'admin@aariwork.lk'
    ],
    'works.json' => [],
    'categories.json' => [
        ['id' => 1, 'name' => 'Bridal', 'color' => '#ff6b9d', 'created_at' => date('Y-m-d H:i:s')],
        ['id' => 2, 'name' => 'Casual', 'color' => '#4ecdc4', 'created_at' => date('Y-m-d H:i:s')],
        ['id' => 3, 'name' => 'Traditional', 'color' => '#ffe66d', 'created_at' => date('Y-m-d H:i:s')]
    ],
    'testimonials.json' => [],
    'contacts.json' => [],
    'analytics.json' => [
        'total_views' => 0,
        'page_views' => []
    ],
    'settings.json' => [
        'site_name' => 'Yuhaa Aari Work',
        'tagline' => 'Exquisite Aari Embroidery Work',
        'contact_email' => 'info@aariwork.lk',
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
        echo "✓ Created $file\n";
    } else {
        echo "- $file already exists (skipped)\n";
    }
}

// Create upload directories
$uploadDirs = [
    'public/uploads/works',
    'public/uploads/thumbnails',
    'public/uploads/temp'
];

foreach ($uploadDirs as $dir) {
    $dirPath = BASEPATH . $dir;
    if (!is_dir($dirPath)) {
        mkdir($dirPath, 0755, true);
        echo "✓ Created $dir directory\n";
    }
}

echo "\n===========================================\n";
echo "Installation Complete!\n";
echo "===========================================\n\n";

echo "Next Steps:\n";
echo "1. Start PHP server: cd public && php -S localhost:8000\n";
echo "2. Open browser: http://localhost:8000\n";
echo "3. Login to admin: http://localhost:8000/admin/login\n";
echo "   Username: admin\n";
echo "   Password: admin123\n\n";

echo "For more information, see:\n";
echo "- QUICKSTART.md for local testing\n";
echo "- README.md for full documentation\n";
echo "- DEPLOYMENT_SUMMARY.md for overview\n\n";
?>
