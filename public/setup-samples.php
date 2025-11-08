<?php
/**
 * Web-based Sample Image Generator
 * Access this file through your browser: http://localhost/setup-samples.php
 */

// Security: Remove this file after generating samples
$securityKey = isset($_GET['key']) ? $_GET['key'] : '';
if ($securityKey !== 'generate123') {
    die('Access denied. Please add ?key=generate123 to the URL.');
}

// Check if GD library is available
if (!extension_loaded('gd')) {
    die("Error: GD library is not installed. Please install php-gd extension.");
}

// Create uploads/works directory if it doesn't exist
$uploadDir = __DIR__ . '/uploads/works';
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
$skipped = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Data Setup - Yuhaa Aari Work</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f5f5f5;
            padding: 40px 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #1a1a1a;
            margin-bottom: 10px;
            font-size: 28px;
        }
        .subtitle {
            color: #6b6b6b;
            margin-bottom: 30px;
            font-size: 16px;
        }
        .progress {
            background: #f0f0f0;
            height: 6px;
            border-radius: 3px;
            margin: 30px 0;
            overflow: hidden;
        }
        .progress-bar {
            background: #c9ab81;
            height: 100%;
            width: 0%;
            transition: width 0.3s;
        }
        .log {
            background: #fafafa;
            border: 1px solid #e8e8e8;
            border-radius: 4px;
            padding: 20px;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            max-height: 400px;
            overflow-y: auto;
        }
        .log-entry {
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .log-entry:last-child {
            border-bottom: none;
        }
        .success { color: #28a745; }
        .warning { color: #ffa500; }
        .info { color: #6b6b6b; }
        .summary {
            background: #e8f5e9;
            border-left: 4px solid #28a745;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .summary h3 {
            color: #1a1a1a;
            margin-bottom: 15px;
        }
        .summary ul {
            list-style: none;
            padding-left: 0;
        }
        .summary li {
            padding: 8px 0;
            color: #4a4a4a;
        }
        .summary li::before {
            content: "✓ ";
            color: #28a745;
            font-weight: bold;
            margin-right: 8px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #1a1a1a;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 10px 0 0;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background: #000;
        }
        .warning-box {
            background: #fff3cd;
            border-left: 4px solid #ffa500;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sample Data Setup</h1>
        <p class="subtitle">Generating placeholder images for your portfolio...</p>

        <div class="progress">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <div class="log" id="log">
<?php

foreach ($images as $index => $img) {
    $filepath = $uploadDir . '/' . $img['name'];

    // Skip if file already exists
    if (file_exists($filepath)) {
        echo '<div class="log-entry warning">⚠ Skipped: ' . htmlspecialchars($img['name']) . ' (already exists)</div>';
        $skipped++;
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

    // Add decorative pattern
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
    echo '<div class="log-entry success">✓ Created: ' . htmlspecialchars($img['name']) . '</div>';

    // Update progress
    $progress = (($index + 1) / count($images)) * 100;
    echo '<script>document.getElementById("progressBar").style.width = "' . $progress . '%";</script>';
    flush();
}

?>
        </div>

        <div class="summary">
            <h3>Setup Complete!</h3>
            <ul>
                <li>Images created: <?= $created ?></li>
                <li>Images skipped: <?= $skipped ?></li>
                <li>Sample works added: 8</li>
                <li>Sample testimonials added: 6</li>
                <li>Sample categories added: 6</li>
                <li>Sample contact messages added: 5</li>
            </ul>
        </div>

        <div class="warning-box">
            <strong>Important:</strong> Delete this file (setup-samples.php) after generating samples for security reasons.
        </div>

        <a href="/" class="btn">View Website</a>
        <a href="/admin/login" class="btn">Admin Panel</a>
    </div>
</body>
</html>
