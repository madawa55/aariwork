<?php
/**
 * Contact Controller
 * Public contact form
 */

class Contact {

    public function index() {
        $analyticsModel = new AnalyticsModel();

        // Track page view
        $analyticsModel->trackPageView('contact');

        $data = [
            'settings' => FileStorage::read('settings.json'),
            'page_title' => 'Contact Us - ' . SITE_NAME
        ];

        include VIEWPATH . 'public/header.php';
        include VIEWPATH . 'public/contact.php';
        include VIEWPATH . 'public/footer.php';
    }

    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /contact');
            exit;
        }

        $contactModel = new ContactModel();

        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'message' => $_POST['message'] ?? '',
            'service_type' => $_POST['service_type'] ?? ''
        ];

        // Validate
        if (empty($data['name']) || empty($data['email']) || empty($data['message'])) {
            $_SESSION['error'] = 'Please fill all required fields.';
            header('Location: /contact');
            exit;
        }

        // Create contact
        $contactModel->create($data);

        // Send notification
        $contactModel->sendNotification($data);

        $_SESSION['success'] = 'Thank you for contacting us! We will get back to you soon.';
        header('Location: /contact');
        exit;
    }
}
