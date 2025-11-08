<?php
/**
 * Work Model
 * Handles work/portfolio data operations
 */

class WorkModel {
    private $filename = 'works.json';

    public function getAll() {
        $works = FileStorage::read($this->filename);
        // Sort by created_at descending
        usort($works, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        return $works;
    }

    public function find($id) {
        return FileStorage::find($this->filename, $id);
    }

    public function create($data) {
        $work = [
            'id' => FileStorage::getNextId($this->filename),
            'title' => $data['title'],
            'description' => $data['description'] ?? '',
            'categories' => $data['categories'] ?? [],
            'images' => $data['images'] ?? [],
            'featured_image' => $data['featured_image'] ?? '',
            'views' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        FileStorage::append($this->filename, $work);
        return $work['id'];
    }

    public function update($id, $data) {
        $updateData = [
            'title' => $data['title'],
            'description' => $data['description'] ?? '',
            'categories' => $data['categories'] ?? [],
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (isset($data['images'])) {
            $updateData['images'] = $data['images'];
        }

        if (isset($data['featured_image'])) {
            $updateData['featured_image'] = $data['featured_image'];
        }

        return FileStorage::update($this->filename, $id, $updateData);
    }

    public function delete($id) {
        // Delete images first
        ImageHandler::deleteWorkImages($id);
        return FileStorage::delete($this->filename, $id);
    }

    public function search($keyword) {
        return FileStorage::search($this->filename, $keyword, ['title', 'description']);
    }

    public function getByCategory($categoryId) {
        $works = $this->getAll();
        return array_filter($works, function($work) use ($categoryId) {
            return in_array($categoryId, $work['categories']);
        });
    }

    public function incrementViews($id) {
        $work = $this->find($id);
        if ($work) {
            $work['views'] = ($work['views'] ?? 0) + 1;
            FileStorage::update($this->filename, $id, ['views' => $work['views']]);
        }
    }

    public function getFeatured($limit = 6) {
        $works = $this->getAll();
        return array_slice($works, 0, $limit);
    }

    public function getRelated($id, $limit = 4) {
        $work = $this->find($id);
        if (!$work) {
            return [];
        }

        $allWorks = $this->getAll();
        $related = [];

        foreach ($allWorks as $w) {
            if ($w['id'] != $id) {
                // Check if has common categories
                $commonCategories = array_intersect($work['categories'], $w['categories']);
                if (!empty($commonCategories)) {
                    $related[] = $w;
                }
            }
        }

        return array_slice($related, 0, $limit);
    }
}
