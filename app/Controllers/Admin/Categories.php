<?php
/**
 * Categories Controller
 * Manages categories
 */

class Categories {

    public function index() {
        Auth::checkAuth();

        $categoryModel = new CategoryModel();

        $data = [
            'categories' => $categoryModel->getUsageStats(),
            'page_title' => 'Manage Categories'
        ];

        include VIEWPATH . 'admin/header.php';
        include VIEWPATH . 'admin/categories/index.php';
        include VIEWPATH . 'admin/footer.php';
    }

    public function create() {
        Auth::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryModel = new CategoryModel();
            $categoryModel->create($_POST);

            $_SESSION['success'] = 'Category created successfully!';
            header('Location: /admin/categories');
            exit;
        }
    }

    public function edit() {
        Auth::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $categoryModel = new CategoryModel();
                $categoryModel->update($id, $_POST);

                $_SESSION['success'] = 'Category updated successfully!';
            }
            header('Location: /admin/categories');
            exit;
        }
    }

    public function delete() {
        Auth::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $categoryModel = new CategoryModel();
                $categoryModel->delete($id);

                $_SESSION['success'] = 'Category deleted successfully!';
            }
            header('Location: /admin/categories');
            exit;
        }
    }
}
