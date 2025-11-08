<?php
/**
 * Category Model
 * Handles category/tag operations
 */

class CategoryModel {
    private $filename = 'categories.json';

    public function getAll() {
        return FileStorage::read($this->filename);
    }

    public function find($id) {
        return FileStorage::find($this->filename, $id);
    }

    public function create($data) {
        $category = [
            'id' => FileStorage::getNextId($this->filename),
            'name' => $data['name'],
            'color' => $data['color'] ?? '#000000',
            'created_at' => date('Y-m-d H:i:s')
        ];

        FileStorage::append($this->filename, $category);
        return $category['id'];
    }

    public function update($id, $data) {
        return FileStorage::update($this->filename, $id, [
            'name' => $data['name'],
            'color' => $data['color'] ?? '#000000'
        ]);
    }

    public function delete($id) {
        return FileStorage::delete($this->filename, $id);
    }

    public function getUsageStats() {
        $categories = $this->getAll();
        $workModel = new WorkModel();
        $allWorks = $workModel->getAll();

        $stats = [];
        foreach ($categories as $category) {
            $count = 0;
            foreach ($allWorks as $work) {
                if (in_array($category['id'], $work['categories'])) {
                    $count++;
                }
            }
            $stats[] = array_merge($category, ['usage_count' => $count]);
        }

        return $stats;
    }
}
