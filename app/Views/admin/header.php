<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['page_title'] ?? 'Admin' ?> - <?= SITE_NAME ?></title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="admin-page">
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <h2><?= SITE_NAME ?></h2>
                <p>Admin Panel</p>
            </div>

            <nav class="sidebar-nav">
                <a href="/admin/dashboard" class="nav-item <?= strpos($_SERVER['REQUEST_URI'], '/admin/dashboard') !== false ? 'active' : '' ?>">
                    <span class="icon">📊</span> Dashboard
                </a>
                <a href="/admin/works" class="nav-item <?= strpos($_SERVER['REQUEST_URI'], '/admin/works') !== false ? 'active' : '' ?>">
                    <span class="icon">🎨</span> Works
                </a>
                <a href="/admin/categories" class="nav-item <?= strpos($_SERVER['REQUEST_URI'], '/admin/categories') !== false ? 'active' : '' ?>">
                    <span class="icon">🏷️</span> Categories
                </a>
                <a href="/admin/testimonials" class="nav-item <?= strpos($_SERVER['REQUEST_URI'], '/admin/testimonials') !== false ? 'active' : '' ?>">
                    <span class="icon">💬</span> Testimonials
                </a>
                <a href="/admin/messages" class="nav-item <?= strpos($_SERVER['REQUEST_URI'], '/admin/messages') !== false ? 'active' : '' ?>">
                    <span class="icon">✉️</span> Messages
                </a>
                <a href="/admin/analytics" class="nav-item <?= strpos($_SERVER['REQUEST_URI'], '/admin/analytics') !== false ? 'active' : '' ?>">
                    <span class="icon">📈</span> Analytics
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="/" class="btn btn-outline" target="_blank">View Website</a>
                <a href="/admin/logout" class="btn btn-danger">Logout</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-content">
            <div class="content-header">
                <h1><?= $data['page_title'] ?? 'Admin' ?></h1>
                <div class="header-actions">
                    <span class="user-info">Welcome, <?= $_SESSION['admin_username'] ?? 'Admin' ?></span>
                </div>
            </div>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <div class="content-body">
