<?php
/**
 * Home Controller
 * Public homepage
 */

class Home {

    public function index() {
        $workModel = new WorkModel();
        $testimonialModel = new TestimonialModel();
        $analyticsModel = new AnalyticsModel();

        // Track page view
        $analyticsModel->trackPageView('home');

        $data = [
            'featured_works' => $workModel->getFeatured(6),
            'testimonials' => $testimonialModel->getPublished(),
            'settings' => FileStorage::read('settings.json'),
            'page_title' => 'Home - ' . SITE_NAME
        ];

        include VIEWPATH . 'public/header.php';
        include VIEWPATH . 'public/home.php';
        include VIEWPATH . 'public/footer.php';
    }
}
