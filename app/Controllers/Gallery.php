<?php
/**
 * Gallery Controller
 * Public gallery and work details
 */

class Gallery {

    public function index() {
        $workModel = new WorkModel();
        $categoryModel = new CategoryModel();
        $analyticsModel = new AnalyticsModel();

        // Track page view
        $analyticsModel->trackPageView('gallery');

        // Handle category filter
        $categoryId = $_GET['category'] ?? null;

        if ($categoryId) {
            $works = $workModel->getByCategory($categoryId);
        } else {
            $works = $workModel->getAll();
        }

        $data = [
            'works' => $works,
            'categories' => $categoryModel->getAll(),
            'selected_category' => $categoryId,
            'settings' => FileStorage::read('settings.json'),
            'page_title' => 'Gallery - ' . SITE_NAME
        ];

        include VIEWPATH . 'public/header.php';
        include VIEWPATH . 'public/gallery.php';
        include VIEWPATH . 'public/footer.php';
    }

    public function detail($id = null) {
        if (!$id) {
            header('Location: /gallery');
            exit;
        }

        $workModel = new WorkModel();
        $categoryModel = new CategoryModel();
        $analyticsModel = new AnalyticsModel();

        $work = $workModel->find($id);

        if (!$work) {
            header('Location: /gallery');
            exit;
        }

        // Increment views
        $workModel->incrementViews($id);

        // Track page view
        $analyticsModel->trackPageView('work_' . $id);

        $data = [
            'work' => $work,
            'categories' => $categoryModel->getAll(),
            'related_works' => $workModel->getRelated($id, 4),
            'settings' => FileStorage::read('settings.json'),
            'page_title' => $work['title'] . ' - ' . SITE_NAME
        ];

        include VIEWPATH . 'public/header.php';
        include VIEWPATH . 'public/work-detail.php';
        include VIEWPATH . 'public/footer.php';
    }

    public function search() {
        $keyword = $_GET['q'] ?? '';
        $workModel = new WorkModel();
        $categoryModel = new CategoryModel();
        $analyticsModel = new AnalyticsModel();

        // Track search
        $analyticsModel->trackPageView('search');

        $works = [];
        if (!empty($keyword)) {
            $works = $workModel->search($keyword);
        }

        $data = [
            'works' => $works,
            'keyword' => $keyword,
            'categories' => $categoryModel->getAll(),
            'settings' => FileStorage::read('settings.json'),
            'page_title' => 'Search Results - ' . SITE_NAME
        ];

        include VIEWPATH . 'public/header.php';
        include VIEWPATH . 'public/gallery.php';
        include VIEWPATH . 'public/footer.php';
    }
}
