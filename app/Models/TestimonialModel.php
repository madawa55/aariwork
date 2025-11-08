<?php
/**
 * Testimonial Model
 * Handles testimonial operations
 */

class TestimonialModel {
    private $filename = 'testimonials.json';

    public function getAll() {
        return FileStorage::read($this->filename);
    }

    public function getPublished() {
        $testimonials = $this->getAll();
        return array_filter($testimonials, function($t) {
            return isset($t['published']) && $t['published'] === true;
        });
    }

    public function find($id) {
        return FileStorage::find($this->filename, $id);
    }

    public function create($data) {
        $testimonial = [
            'id' => FileStorage::getNextId($this->filename),
            'name' => $data['name'],
            'message' => $data['message'],
            'rating' => $data['rating'] ?? 5,
            'published' => $data['published'] ?? true,
            'created_at' => date('Y-m-d H:i:s')
        ];

        FileStorage::append($this->filename, $testimonial);
        return $testimonial['id'];
    }

    public function update($id, $data) {
        return FileStorage::update($this->filename, $id, $data);
    }

    public function delete($id) {
        return FileStorage::delete($this->filename, $id);
    }

    public function togglePublish($id) {
        $testimonial = $this->find($id);
        if ($testimonial) {
            $published = !($testimonial['published'] ?? false);
            return FileStorage::update($this->filename, $id, ['published' => $published]);
        }
        return false;
    }
}
