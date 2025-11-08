<div class="page-actions">
    <a href="/admin/analytics/export" class="btn btn-primary">Export to CSV</a>
</div>

<div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-icon">👁️</div>
        <div class="stat-content">
            <h3><?= $data['stats']['total_views'] ?? 0 ?></h3>
            <p>Total Views</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📊</div>
        <div class="stat-content">
            <h3><?= $data['stats']['daily_views'] ?? 0 ?></h3>
            <p>Today's Views</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📈</div>
        <div class="stat-content">
            <h3><?= $data['stats']['weekly_views'] ?? 0 ?></h3>
            <p>This Week</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📅</div>
        <div class="stat-content">
            <h3><?= $data['stats']['monthly_views'] ?? 0 ?></h3>
            <p>This Month</p>
        </div>
    </div>
</div>

<div class="dashboard-panel">
    <h2>Most Viewed Works</h2>
    <?php if (!empty($data['stats']['most_viewed'])): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Title</th>
                    <th>Views</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['stats']['most_viewed'] as $index => $work): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($work['title']) ?></td>
                        <td><?= $work['views'] ?? 0 ?></td>
                        <td><?= date('M d, Y', strtotime($work['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty-state">
            <p>No analytics data available yet.</p>
        </div>
    <?php endif; ?>
</div>

<div class="dashboard-panel" style="margin-top: 30px;">
    <h2>Traffic Summary</h2>
    <div class="stats-list">
        <div class="stats-item">
            <span class="label">Total Works Published:</span>
            <span class="value"><?= $data['stats']['total_works'] ?? 0 ?></span>
        </div>
        <div class="stats-item">
            <span class="label">Total Images:</span>
            <span class="value"><?= $data['stats']['total_images'] ?? 0 ?></span>
        </div>
        <div class="stats-item">
            <span class="label">Pending Messages:</span>
            <span class="value"><?= $data['stats']['pending_messages'] ?? 0 ?></span>
        </div>
        <div class="stats-item">
            <span class="label">Average Views per Work:</span>
            <span class="value">
                <?php
                $totalWorks = $data['stats']['total_works'] ?? 1;
                $totalViews = $data['stats']['total_views'] ?? 0;
                echo $totalWorks > 0 ? round($totalViews / $totalWorks, 1) : 0;
                ?>
            </span>
        </div>
    </div>
</div>
