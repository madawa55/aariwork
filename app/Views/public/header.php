<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $data['settings']['tagline'] ?? 'Exquisite Aari Embroidery Work' ?>">
    <title><?= $data['page_title'] ?? SITE_NAME ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" id="mobileMenuToggle">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Navigation -->
    <nav class="main-nav" id="mainNav">
        <div class="container">
            <div class="nav-wrapper">
                <div class="nav-brand">
                    <a href="/"><?= SITE_NAME ?></a>
                </div>

                <ul class="nav-menu" id="navMenu">
                    <li><a href="/" class="<?= $_SERVER['REQUEST_URI'] == '/' ? 'active' : '' ?>">Home</a></li>
                    <li><a href="/gallery" class="<?= strpos($_SERVER['REQUEST_URI'], '/gallery') !== false ? 'active' : '' ?>">Gallery</a></li>
                    <li><a href="/contact" class="<?= strpos($_SERVER['REQUEST_URI'], '/contact') !== false ? 'active' : '' ?>">Contact</a></li>
                </ul>

                <div class="nav-search">
                    <form action="/search" method="GET" class="search-form">
                        <input type="text" name="q" placeholder="Search works..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                        <button type="submit">🔍</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <div class="container">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error">
            <div class="container">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
