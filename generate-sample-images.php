<?php
/**
 * Generate Sample Placeholder Images
 * Run this script once to create placeholder images for sample data
 * Usage: php generate-sample-images.php
 */

// Check if GD library is available
if (!extension_loaded('gd')) {
    die("Error: GD library is not installed. Please install php-gd extension.\n");
}

// Create uploads/works directory if it doesn't exist
$uploadDir = __DIR__ . '/public/uploads/works';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Define sample images to create
$images = [
    // Work 1 - Bridal Lehenga (Golden theme)
    ['name' => 'sample-1-1.jpg', 'color' => [212, 175, 55], 'text' => 'Bridal Lehenga 1'],
    ['name' => 'sample-1-2.jpg', 'color' => [218, 165, 32], 'text' => 'Bridal Lehenga 2'],
    ['name' => 'sample-1-3.jpg', 'color' => [184, 134, 11], 'text' => 'Bridal Lehenga 3'],

    // Work 2 - Floral Saree (Soft colors)
    ['name' => 'sample-2-1.jpg', 'color' => [255, 182, 193], 'text' => 'Floral Saree 1'],
    ['name' => 'sample-2-2.jpg', 'color' => [255, 160, 180], 'text' => 'Floral Saree 2'],

    // Work 3 - Royal Blue Anarkali
    ['name' => 'sample-3-1.jpg', 'color' => [65, 105, 225], 'text' => 'Royal Anarkali 1'],
    ['name' => 'sample-3-2.jpg', 'color' => [70, 130, 180], 'text' => 'Royal Anarkali 2'],
    ['name' => 'sample-3-3.jpg', 'color' => [72, 118, 255], 'text' => 'Royal Anarkali 3'],
    ['name' => 'sample-3-4.jpg', 'color' => [100, 149, 237], 'text' => 'Royal Anarkali 4'],

    // Work 4 - Peacock Blouse (Green/Blue)
    ['name' => 'sample-4-1.jpg', 'color' => [0, 128, 128], 'text' => 'Peacock Blouse 1'],
    ['name' => 'sample-4-2.jpg', 'color' => [32, 178, 170], 'text' => 'Peacock Blouse 2'],

    // Work 5 - White Kurta (Light colors)
    ['name' => 'sample-5-1.jpg', 'color' => [245, 245, 245], 'text' => 'White Kurta 1'],
    ['name' => 'sample-5-2.jpg', 'color' => [250, 250, 250], 'text' => 'White Kurta 2'],
    ['name' => 'sample-5-3.jpg', 'color' => [240, 240, 240], 'text' => 'White Kurta 3'],

    // Work 6 - Red Dupatta
    ['name' => 'sample-6-1.jpg', 'color' => [178, 34, 34], 'text' => 'Red Dupatta 1'],
    ['name' => 'sample-6-2.jpg', 'color' => [220, 20, 60], 'text' => 'Red Dupatta 2'],
    ['name' => 'sample-6-3.jpg', 'color' => [165, 42, 42], 'text' => 'Red Dupatta 3'],

    // Work 7 - Pink Gown
    ['name' => 'sample-7-1.jpg', 'color' => [255, 192, 203], 'text' => 'Pink Gown 1'],
    ['name' => 'sample-7-2.jpg', 'color' => [255, 182, 193], 'text' => 'Pink Gown 2'],

    // Work 8 - Emerald Jacket
    ['name' => 'sample-8-1.jpg', 'color' => [0, 128, 0], 'text' => 'Emerald Jacket 1'],
    ['name' => 'sample-8-2.jpg', 'color' => [50, 205, 50], 'text' => 'Emerald Jacket 2'],
    ['name' => 'sample-8-3.jpg', 'color' => [46, 139, 87], 'text' => 'Emerald Jacket 3'],
];

$width = 800;
$height = 800;
$created = 0;

echo "Creating placeholder images...\n\n";

foreach ($images as $img) {
    $filepath = $uploadDir . '/' . $img['name'];

    // Skip if file already exists
    if (file_exists($filepath)) {
        echo "⚠ Skipped: {$img['name']} (already exists)\n";
        continue;
    }

    // Create image
    $image = imagecreatetruecolor($width, $height);

    // Allocate colors
    $bgColor = imagecolorallocate($image, $img['color'][0], $img['color'][1], $img['color'][2]);
    $textColor = imagecolorallocate($image, 255, 255, 255);
    $borderColor = imagecolorallocate($image, 200, 200, 200);

    // Fill background
    imagefill($image, 0, 0, $bgColor);

    // Add decorative pattern (simple diagonal lines)
    for ($i = 0; $i < $width; $i += 40) {
        $lineColor = imagecolorallocatealpha($image, 255, 255, 255, 100);
        imageline($image, $i, 0, $i + $height, $height, $lineColor);
    }

    // Add border
    imagerectangle($image, 10, 10, $width - 10, $height - 10, $borderColor);

    // Add text
    $fontSize = 5;
    $textWidth = imagefontwidth($fontSize) * strlen($img['text']);
    $textHeight = imagefontheight($fontSize);
    $x = ($width - $textWidth) / 2;
    $y = ($height - $textHeight) / 2;

    // Add shadow
    $shadowColor = imagecolorallocate($image, 0, 0, 0);
    imagestring($image, $fontSize, $x + 2, $y + 2, $img['text'], $shadowColor);

    // Add main text
    imagestring($image, $fontSize, $x, $y, $img['text'], $textColor);

    // Add watermark
    $watermark = "Yuhaa Aari Work - Sample";
    $wmWidth = imagefontwidth(3) * strlen($watermark);
    $wmX = ($width - $wmWidth) / 2;
    $wmY = $height - 50;
    $wmColor = imagecolorallocatealpha($image, 255, 255, 255, 50);
    imagestring($image, 3, $wmX, $wmY, $watermark, $wmColor);

    // Save image
    imagejpeg($image, $filepath, 90);
    imagedestroy($image);

    $created++;
    echo "✓ Created: {$img['name']}\n";
}

echo "\n========================================\n";
echo "Summary:\n";
echo "Total images created: $created\n";
echo "Location: public/uploads/works/\n";
echo "========================================\n\n";

echo "Sample data is ready! You can now:\n";
echo "1. Access your website in a browser\n";
echo "2. View the gallery with sample works\n";
echo "3. Check testimonials on the homepage\n";
echo "4. Login to admin panel to see contact messages\n\n";

echo "Note: You can replace these placeholder images with real\n";
echo "product photos by uploading through the admin panel.\n";
?>
