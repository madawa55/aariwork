<?php
/**
 * FileStorage Library
 * Handles JSON file operations
 */

class FileStorage {

    /**
     * Read data from JSON file
     */
    public static function read($filename) {
        $filepath = DATAPATH . $filename;

        if (!file_exists($filepath)) {
            return [];
        }

        $content = file_get_contents($filepath);
        return json_decode($content, true) ?: [];
    }

    /**
     * Write data to JSON file
     */
    public static function write($filename, $data) {
        $filepath = DATAPATH . $filename;
        $json = json_encode($data, JSON_PRETTY_PRINT);
        return file_put_contents($filepath, $json) !== false;
    }

    /**
     * Append data to JSON array file
     */
    public static function append($filename, $data) {
        $existing = self::read($filename);
        $existing[] = $data;
        return self::write($filename, $existing);
    }

    /**
     * Update specific item in JSON array by ID
     */
    public static function update($filename, $id, $data) {
        $items = self::read($filename);

        foreach ($items as $key => $item) {
            if (isset($item['id']) && $item['id'] == $id) {
                $items[$key] = array_merge($item, $data);
                return self::write($filename, $items);
            }
        }

        return false;
    }

    /**
     * Delete specific item from JSON array by ID
     */
    public static function delete($filename, $id) {
        $items = self::read($filename);
        $filtered = array_filter($items, function($item) use ($id) {
            return !isset($item['id']) || $item['id'] != $id;
        });

        return self::write($filename, array_values($filtered));
    }

    /**
     * Find item by ID
     */
    public static function find($filename, $id) {
        $items = self::read($filename);

        foreach ($items as $item) {
            if (isset($item['id']) && $item['id'] == $id) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Get next available ID
     */
    public static function getNextId($filename) {
        $items = self::read($filename);

        if (empty($items)) {
            return 1;
        }

        $maxId = 0;
        foreach ($items as $item) {
            if (isset($item['id']) && $item['id'] > $maxId) {
                $maxId = $item['id'];
            }
        }

        return $maxId + 1;
    }

    /**
     * Search items by keyword
     */
    public static function search($filename, $keyword, $fields = []) {
        $items = self::read($filename);
        $keyword = strtolower($keyword);

        return array_filter($items, function($item) use ($keyword, $fields) {
            foreach ($fields as $field) {
                if (isset($item[$field]) &&
                    stripos($item[$field], $keyword) !== false) {
                    return true;
                }
            }
            return false;
        });
    }

    /**
     * Filter items by field value
     */
    public static function filter($filename, $field, $value) {
        $items = self::read($filename);

        return array_filter($items, function($item) use ($field, $value) {
            if (is_array($value)) {
                return isset($item[$field]) && in_array($item[$field], $value);
            }
            return isset($item[$field]) && $item[$field] == $value;
        });
    }
}
