<?php
/**
 * Contact Model
 * Handles contact form submissions
 */

class ContactModel {
    private $filename = 'contacts.json';

    public function getAll() {
        $contacts = FileStorage::read($this->filename);
        usort($contacts, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        return $contacts;
    }

    public function getUnread() {
        $contacts = $this->getAll();
        return array_filter($contacts, function($c) {
            return !isset($c['read']) || $c['read'] === false;
        });
    }

    public function find($id) {
        return FileStorage::find($this->filename, $id);
    }

    public function create($data) {
        $contact = [
            'id' => FileStorage::getNextId($this->filename),
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? '',
            'message' => $data['message'],
            'service_type' => $data['service_type'] ?? '',
            'read' => false,
            'created_at' => date('Y-m-d H:i:s')
        ];

        FileStorage::append($this->filename, $contact);
        return $contact['id'];
    }

    public function markAsRead($id) {
        return FileStorage::update($this->filename, $id, ['read' => true]);
    }

    public function delete($id) {
        return FileStorage::delete($this->filename, $id);
    }

    public function sendNotification($data) {
        $to = ADMIN_EMAIL;
        $subject = "New Contact Form Submission - " . SITE_NAME;
        $message = "Name: {$data['name']}\n";
        $message .= "Email: {$data['email']}\n";
        $message .= "Phone: {$data['phone']}\n";
        $message .= "Service Type: {$data['service_type']}\n\n";
        $message .= "Message:\n{$data['message']}";

        $headers = "From: " . SITE_EMAIL;

        return mail($to, $subject, $message, $headers);
    }
}
