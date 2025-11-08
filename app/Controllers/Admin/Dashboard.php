<?php
/**
 * Dashboard Controller
 * Admin dashboard
 */

class Dashboard {

    public function index() {
        Auth::checkAuth();

        $analyticsModel = new AnalyticsModel();
        $stats = $analyticsModel->getStats();

        $data = [
            'stats' => $stats,
            'page_title' => 'Dashboard'
        ];

        include VIEWPATH . 'admin/header.php';
        include VIEWPATH . 'admin/dashboard.php';
        include VIEWPATH . 'admin/footer.php';
    }
}
