<?php
/**
 * Auth Controller
 * Handles admin authentication
 */

class Auth {

    public function login() {
        // If already logged in, redirect to dashboard
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            header('Location: /admin/dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processLogin();
        } else {
            $this->showLoginForm();
        }
    }

    private function processLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Get admin credentials
        $admin = FileStorage::read('admin.json');

        if ($username === $admin['username'] && password_verify($password, $admin['password'])) {
            // Set session
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            $_SESSION['last_activity'] = time();

            header('Location: /admin/dashboard');
            exit;
        } else {
            $error = 'Invalid username or password';
            $this->showLoginForm($error);
        }
    }

    private function showLoginForm($error = null) {
        include VIEWPATH . 'admin/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }

    /**
     * Check if admin is logged in
     */
    public static function checkAuth() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: /admin/login');
            exit;
        }

        // Check session timeout
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > SESSION_TIMEOUT) {
            session_destroy();
            header('Location: /admin/login');
            exit;
        }

        $_SESSION['last_activity'] = time();
    }
}
