<?php
/**
 * Messages Controller
 * Manages contact messages
 */

class Messages {

    public function index() {
        Auth::checkAuth();

        $contactModel = new ContactModel();

        $data = [
            'messages' => $contactModel->getAll(),
            'page_title' => 'Contact Messages'
        ];

        include VIEWPATH . 'admin/header.php';
        include VIEWPATH . 'admin/messages/index.php';
        include VIEWPATH . 'admin/footer.php';
    }

    public function markRead() {
        Auth::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $contactModel = new ContactModel();
                $contactModel->markAsRead($id);

                echo json_encode(['success' => true]);
                exit;
            }
        }

        echo json_encode(['success' => false]);
        exit;
    }

    public function delete() {
        Auth::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $contactModel = new ContactModel();
                $contactModel->delete($id);

                $_SESSION['success'] = 'Message deleted successfully!';
            }
            header('Location: /admin/messages');
            exit;
        }
    }
}
