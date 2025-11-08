<?php
/**
 * Yuhaa Aari Work - Portfolio Website
 * Entry Point
 */

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Define path constants
define('BASEPATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APPPATH', BASEPATH . 'app' . DIRECTORY_SEPARATOR);
define('VIEWPATH', APPPATH . 'Views' . DIRECTORY_SEPARATOR);
define('DATAPATH', BASEPATH . 'writable' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);
define('UPLOADPATH', __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR);
define('BASEURL', '/');

// Start session
session_start();

// Autoloader
spl_autoload_register(function ($class) {
    $paths = [
        APPPATH . 'Controllers/',
        APPPATH . 'Controllers/Admin/',
        APPPATH . 'Models/',
        APPPATH . 'Libraries/',
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Load core libraries
require_once APPPATH . 'Config/Routes.php';
require_once APPPATH . 'Config/Database.php';

// Simple Router
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = dirname($_SERVER['SCRIPT_NAME']);
$path = str_replace($script_name, '', $request_uri);
$path = trim(parse_url($path, PHP_URL_PATH), '/');

// Route the request
route($path);
