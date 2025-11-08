<?php
/**
 * Testimonials Controller
 * Manages testimonials
 */

class Testimonials {

    public function index() {
        Auth::checkAuth();

        $testimonialModel = new TestimonialModel();

        $data = [
            'testimonials' => $testimonialModel->getAll(),
            'page_title' => 'Manage Testimonials'
        ];

        include VIEWPATH . 'admin/header.php';
        include VIEWPATH . 'admin/testimonials/index.php';
        include VIEWPATH . 'admin/footer.php';
    }

    public function create() {
        Auth::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $testimonialModel = new TestimonialModel();
            $testimonialModel->create($_POST);

            $_SESSION['success'] = 'Testimonial created successfully!';
            header('Location: /admin/testimonials');
            exit;
        }
    }

    public function edit() {
        Auth::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $testimonialModel = new TestimonialModel();
                $testimonialModel->update($id, $_POST);

                $_SESSION['success'] = 'Testimonial updated successfully!';
            }
            header('Location: /admin/testimonials');
            exit;
        }
    }

    public function delete() {
        Auth::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $testimonialModel = new TestimonialModel();
                $testimonialModel->delete($id);

                $_SESSION['success'] = 'Testimonial deleted successfully!';
            }
            header('Location: /admin/testimonials');
            exit;
        }
    }

    public function togglePublish() {
        Auth::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $testimonialModel = new TestimonialModel();
                $testimonialModel->togglePublish($id);

                echo json_encode(['success' => true]);
                exit;
            }
        }

        echo json_encode(['success' => false]);
        exit;
    }
}
