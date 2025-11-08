<?php
/**
 * Analytics Controller
 * View analytics
 */

class Analytics {

    public function index() {
        Auth::checkAuth();

        $analyticsModel = new AnalyticsModel();

        $data = [
            'stats' => $analyticsModel->getStats(),
            'page_title' => 'Analytics'
        ];

        include VIEWPATH . 'admin/header.php';
        include VIEWPATH . 'admin/analytics/index.php';
        include VIEWPATH . 'admin/footer.php';
    }

    public function export() {
        Auth::checkAuth();

        $analyticsModel = new AnalyticsModel();
        $csv = $analyticsModel->exportToCSV();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="analytics_' . date('Y-m-d') . '.csv"');
        echo $csv;
        exit;
    }
}
