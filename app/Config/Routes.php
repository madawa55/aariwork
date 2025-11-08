<?php
/**
 * Routes Configuration
 */

function route($path) {
    $segments = explode('/', $path);

    // Default route
    if (empty($path)) {
        $controller = new Home();
        $controller->index();
        return;
    }

    // Admin routes
    if ($segments[0] === 'admin') {
        if (!isset($segments[1]) || $segments[1] === '') {
            $controller = new Dashboard();
            $controller->index();
            return;
        }

        switch ($segments[1]) {
            case 'login':
                $controller = new Auth();
                $controller->login();
                break;
            case 'logout':
                $controller = new Auth();
                $controller->logout();
                break;
            case 'dashboard':
                $controller = new Dashboard();
                $controller->index();
                break;
            case 'works':
                $controller = new Works();
                $method = $segments[2] ?? 'index';
                $id = $segments[3] ?? null;
                $controller->$method($id);
                break;
            case 'categories':
                $controller = new Categories();
                $method = $segments[2] ?? 'index';
                $controller->$method();
                break;
            case 'testimonials':
                $controller = new Testimonials();
                $method = $segments[2] ?? 'index';
                $controller->$method();
                break;
            case 'messages':
                $controller = new Messages();
                $method = $segments[2] ?? 'index';
                $controller->$method();
                break;
            case 'analytics':
                $controller = new Analytics();
                $controller->index();
                break;
            default:
                $controller = new Dashboard();
                $controller->index();
        }
        return;
    }

    // Public routes
    switch ($segments[0]) {
        case 'gallery':
            $controller = new Gallery();
            $controller->index();
            break;
        case 'work':
            $controller = new Gallery();
            $id = $segments[1] ?? null;
            $controller->detail($id);
            break;
        case 'contact':
            $controller = new Contact();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->submit();
            } else {
                $controller->index();
            }
            break;
        case 'search':
            $controller = new Gallery();
            $controller->search();
            break;
        default:
            $controller = new Home();
            $controller->index();
    }
}
