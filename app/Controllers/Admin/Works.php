<?php
/**
 * Works Controller
 * Manages portfolio works
 */

class Works {

    public function index() {
        Auth::checkAuth();

        $workModel = new WorkModel();
        $categoryModel = new CategoryModel();

        $data = [
            'works' => $workModel->getAll(),
            'categories' => $categoryModel->getAll(),
            'page_title' => 'Manage Works'
        ];

        include VIEWPATH . 'admin/header.php';
        include VIEWPATH . 'admin/works/index.php';
        include VIEWPATH . 'admin/footer.php';
    }

    public function create() {
        Auth::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processCreate();
        } else {
            $this->showCreateForm();
        }
    }

    private function showCreateForm() {
        $categoryModel = new CategoryModel();

        $data = [
            'categories' => $categoryModel->getAll(),
            'page_title' => 'Add New Work'
        ];

        include VIEWPATH . 'admin/header.php';
        include VIEWPATH . 'admin/works/create.php';
        include VIEWPATH . 'admin/footer.php';
    }

    private function processCreate() {
        $workModel = new WorkModel();

        $workData = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'categories' => $_POST['categories'] ?? [],
            'images' => []
        ];

        // Create work first to get ID
        $workId = $workModel->create($workData);

        // Handle image uploads
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $uploadedImages = $this->handleImageUploads($workId);
            $workData['images'] = $uploadedImages;
            $workData['featured_image'] = $uploadedImages[0] ?? '';

            // Update work with images
            $workModel->update($workId, $workData);
        }

        $_SESSION['success'] = 'Work created successfully!';
        header('Location: /admin/works');
        exit;
    }

    public function edit($id = null) {
        Auth::checkAuth();

        if (!$id) {
            header('Location: /admin/works');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processEdit($id);
        } else {
            $this->showEditForm($id);
        }
    }

    private function showEditForm($id) {
        $workModel = new WorkModel();
        $categoryModel = new CategoryModel();

        $work = $workModel->find($id);
        if (!$work) {
            header('Location: /admin/works');
            exit;
        }

        $data = [
            'work' => $work,
            'categories' => $categoryModel->getAll(),
            'page_title' => 'Edit Work'
        ];

        include VIEWPATH . 'admin/header.php';
        include VIEWPATH . 'admin/works/edit.php';
        include VIEWPATH . 'admin/footer.php';
    }

    private function processEdit($id) {
        $workModel = new WorkModel();
        $work = $workModel->find($id);

        $workData = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'categories' => $_POST['categories'] ?? []
        ];

        // Handle new image uploads
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $existingImages = $work['images'] ?? [];
            $newImages = $this->handleImageUploads($id);
            $workData['images'] = array_merge($existingImages, $newImages);

            // Update featured image if not set
            if (empty($work['featured_image'])) {
                $workData['featured_image'] = $workData['images'][0] ?? '';
            }
        }

        $workModel->update($id, $workData);

        $_SESSION['success'] = 'Work updated successfully!';
        header('Location: /admin/works');
        exit;
    }

    public function delete($id = null) {
        Auth::checkAuth();

        if (!$id) {
            header('Location: /admin/works');
            exit;
        }

        $workModel = new WorkModel();
        $workModel->delete($id);

        $_SESSION['success'] = 'Work deleted successfully!';
        header('Location: /admin/works');
        exit;
    }

    private function handleImageUploads($workId) {
        $uploadedImages = [];

        $fileCount = count($_FILES['images']['name']);

        for ($i = 0; $i < $fileCount; $i++) {
            if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                $file = [
                    'name' => $_FILES['images']['name'][$i],
                    'type' => $_FILES['images']['type'][$i],
                    'tmp_name' => $_FILES['images']['tmp_name'][$i],
                    'error' => $_FILES['images']['error'][$i],
                    'size' => $_FILES['images']['size'][$i]
                ];

                $result = ImageHandler::upload($file, $workId);

                if ($result['success']) {
                    $uploadedImages[] = [
                        'filename' => $result['filename'],
                        'original' => $result['original_path'],
                        'thumb' => $result['thumb_path']
                    ];
                }
            }
        }

        return $uploadedImages;
    }

    public function deleteImage() {
        Auth::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $workId = $_POST['work_id'] ?? null;
            $filename = $_POST['filename'] ?? null;

            if ($workId && $filename) {
                $workModel = new WorkModel();
                $work = $workModel->find($workId);

                if ($work) {
                    // Remove from images array
                    $images = array_filter($work['images'], function($img) use ($filename) {
                        return $img['filename'] !== $filename;
                    });

                    $workModel->update($workId, ['images' => array_values($images)]);
                    ImageHandler::deleteImage($workId, $filename);

                    echo json_encode(['success' => true]);
                    exit;
                }
            }
        }

        echo json_encode(['success' => false]);
        exit;
    }
}
