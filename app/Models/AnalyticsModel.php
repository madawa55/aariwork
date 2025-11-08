<?php
/**
 * Analytics Model
 * Handles analytics tracking
 */

class AnalyticsModel {
    private $filename = 'analytics.json';

    public function trackPageView($page) {
        $analytics = FileStorage::read($this->filename);

        if (!isset($analytics['page_views'])) {
            $analytics['page_views'] = [];
        }

        $today = date('Y-m-d');
        $key = $page . '_' . $today;

        if (!isset($analytics['page_views'][$key])) {
            $analytics['page_views'][$key] = [
                'page' => $page,
                'date' => $today,
                'count' => 0
            ];
        }

        $analytics['page_views'][$key]['count']++;
        $analytics['total_views'] = ($analytics['total_views'] ?? 0) + 1;

        FileStorage::write($this->filename, $analytics);
    }

    public function getStats() {
        $analytics = FileStorage::read($this->filename);
        $workModel = new WorkModel();
        $contactModel = new ContactModel();

        $allWorks = $workModel->getAll();
        $totalImages = 0;
        foreach ($allWorks as $work) {
            $totalImages += count($work['images']);
        }

        $contacts = $contactModel->getUnread();

        return [
            'total_views' => $analytics['total_views'] ?? 0,
            'total_works' => count($allWorks),
            'total_images' => $totalImages,
            'pending_messages' => count($contacts),
            'daily_views' => $this->getDailyViews(),
            'weekly_views' => $this->getWeeklyViews(),
            'monthly_views' => $this->getMonthlyViews(),
            'most_viewed' => $this->getMostViewedWorks()
        ];
    }

    private function getDailyViews() {
        $analytics = FileStorage::read($this->filename);
        $today = date('Y-m-d');
        $count = 0;

        if (isset($analytics['page_views'])) {
            foreach ($analytics['page_views'] as $view) {
                if ($view['date'] === $today) {
                    $count += $view['count'];
                }
            }
        }

        return $count;
    }

    private function getWeeklyViews() {
        $analytics = FileStorage::read($this->filename);
        $weekAgo = date('Y-m-d', strtotime('-7 days'));
        $count = 0;

        if (isset($analytics['page_views'])) {
            foreach ($analytics['page_views'] as $view) {
                if ($view['date'] >= $weekAgo) {
                    $count += $view['count'];
                }
            }
        }

        return $count;
    }

    private function getMonthlyViews() {
        $analytics = FileStorage::read($this->filename);
        $monthAgo = date('Y-m-d', strtotime('-30 days'));
        $count = 0;

        if (isset($analytics['page_views'])) {
            foreach ($analytics['page_views'] as $view) {
                if ($view['date'] >= $monthAgo) {
                    $count += $view['count'];
                }
            }
        }

        return $count;
    }

    private function getMostViewedWorks() {
        $workModel = new WorkModel();
        $works = $workModel->getAll();

        usort($works, function($a, $b) {
            return ($b['views'] ?? 0) - ($a['views'] ?? 0);
        });

        return array_slice($works, 0, 5);
    }

    public function exportToCSV() {
        $analytics = FileStorage::read($this->filename);
        $csv = "Date,Page,Views\n";

        if (isset($analytics['page_views'])) {
            foreach ($analytics['page_views'] as $view) {
                $csv .= "{$view['date']},{$view['page']},{$view['count']}\n";
            }
        }

        return $csv;
    }
}
