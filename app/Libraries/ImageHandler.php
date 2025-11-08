<?php
/**
 * ImageHandler Library
 * Handles image upload and processing
 */

class ImageHandler {

    /**
     * Upload and process image
     */
    public static function upload($file, $workId) {
        // Validate file
        if (!self::validate($file)) {
            return ['success' => false, 'error' => 'Invalid file type or size'];
        }

        // Create work directory
        $workDir = UPLOADPATH . 'works' . DIRECTORY_SEPARATOR . 'work-' . $workId;
        $originalDir = $workDir . DIRECTORY_SEPARATOR . 'original';
        $thumbDir = $workDir . DIRECTORY_SEPARATOR . 'thumb';

        if (!is_dir($originalDir)) {
            mkdir($originalDir, 0755, true);
        }
        if (!is_dir($thumbDir)) {
            mkdir($thumbDir, 0755, true);
        }

        // Generate unique filename
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = uniqid() . '_' . time() . '.' . $extension;

        // Move original file
        $originalPath = $originalDir . DIRECTORY_SEPARATOR . $filename;
        if (!move_uploaded_file($file['tmp_name'], $originalPath)) {
            return ['success' => false, 'error' => 'Failed to upload file'];
        }

        // Create thumbnail
        $thumbPath = $thumbDir . DIRECTORY_SEPARATOR . $filename;
        self::createThumbnail($originalPath, $thumbPath);

        return [
            'success' => true,
            'filename' => $filename,
            'original_path' => 'uploads/works/work-' . $workId . '/original/' . $filename,
            'thumb_path' => 'uploads/works/work-' . $workId . '/thumb/' . $filename
        ];
    }

    /**
     * Validate uploaded file
     */
    private static function validate($file) {
        // Check if file was uploaded
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return false;
        }

        // Check file size
        if ($file['size'] > MAX_FILE_SIZE) {
            return false;
        }

        // Check MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        return in_array($mimeType, ALLOWED_IMAGE_TYPES);
    }

    /**
     * Create thumbnail
     */
    private static function createThumbnail($source, $destination) {
        $imageInfo = getimagesize($source);
        $width = $imageInfo[0];
        $height = $imageInfo[1];
        $mimeType = $imageInfo['mime'];

        // Create image resource
        switch ($mimeType) {
            case 'image/jpeg':
            case 'image/jpg':
                $srcImage = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $srcImage = imagecreatefrompng($source);
                break;
            case 'image/webp':
                $srcImage = imagecreatefromwebp($source);
                break;
            default:
                return false;
        }

        // Calculate new dimensions
        $aspectRatio = $width / $height;
        $thumbWidth = THUMBNAIL_WIDTH;
        $thumbHeight = THUMBNAIL_HEIGHT;

        if ($aspectRatio > 1) {
            $thumbHeight = $thumbWidth / $aspectRatio;
        } else {
            $thumbWidth = $thumbHeight * $aspectRatio;
        }

        // Create thumbnail
        $thumbImage = imagecreatetruecolor($thumbWidth, $thumbHeight);

        // Preserve transparency for PNG
        if ($mimeType === 'image/png') {
            imagealphablending($thumbImage, false);
            imagesavealpha($thumbImage, true);
        }

        imagecopyresampled($thumbImage, $srcImage, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);

        // Save thumbnail
        switch ($mimeType) {
            case 'image/jpeg':
            case 'image/jpg':
                imagejpeg($thumbImage, $destination, 85);
                break;
            case 'image/png':
                imagepng($thumbImage, $destination, 8);
                break;
            case 'image/webp':
                imagewebp($thumbImage, $destination, 85);
                break;
        }

        imagedestroy($srcImage);
        imagedestroy($thumbImage);

        return true;
    }

    /**
     * Delete work images
     */
    public static function deleteWorkImages($workId) {
        $workDir = UPLOADPATH . 'works' . DIRECTORY_SEPARATOR . 'work-' . $workId;

        if (is_dir($workDir)) {
            self::deleteDirectory($workDir);
        }
    }

    /**
     * Delete directory recursively
     */
    private static function deleteDirectory($dir) {
        if (!is_dir($dir)) {
            return;
        }

        $files = array_diff(scandir($dir), ['.', '..']);

        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            is_dir($path) ? self::deleteDirectory($path) : unlink($path);
        }

        rmdir($dir);
    }

    /**
     * Delete single image
     */
    public static function deleteImage($workId, $filename) {
        $originalPath = UPLOADPATH . 'works' . DIRECTORY_SEPARATOR . 'work-' . $workId . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $filename;
        $thumbPath = UPLOADPATH . 'works' . DIRECTORY_SEPARATOR . 'work-' . $workId . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR . $filename;

        if (file_exists($originalPath)) {
            unlink($originalPath);
        }

        if (file_exists($thumbPath)) {
            unlink($thumbPath);
        }
    }
}
