<div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-icon">🎨</div>
        <div class="stat-content">
            <h3><?= $data['stats']['total_works'] ?? 0 ?></h3>
            <p>Total Works</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🖼️</div>
        <div class="stat-content">
            <h3><?= $data['stats']['total_images'] ?? 0 ?></h3>
            <p>Total Images</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">👁️</div>
        <div class="stat-content">
            <h3><?= $data['stats']['total_views'] ?? 0 ?></h3>
            <p>Total Views</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">✉️</div>
        <div class="stat-content">
            <h3><?= $data['stats']['pending_messages'] ?? 0 ?></h3>
            <p>Pending Messages</p>
        </div>
    </div>
</div>

<div class="dashboard-grid">
    <div class="dashboard-panel">
        <h2>Quick Actions</h2>
        <div class="quick-actions">
            <a href="/admin/works/create" class="action-btn">
                <span class="icon">➕</span>
                Add New Work
            </a>
            <a href="/admin/categories" class="action-btn">
                <span class="icon">🏷️</span>
                Manage Categories
            </a>
            <a href="/admin/messages" class="action-btn">
                <span class="icon">✉️</span>
                View Messages
            </a>
            <a href="/admin/analytics" class="action-btn">
                <span class="icon">📈</span>
                View Analytics
            </a>
        </div>
    </div>

    <div class="dashboard-panel">
        <h2>Recent Statistics</h2>
        <div class="stats-list">
            <div class="stats-item">
                <span class="label">Today's Views:</span>
                <span class="value"><?= $data['stats']['daily_views'] ?? 0 ?></span>
            </div>
            <div class="stats-item">
                <span class="label">This Week:</span>
                <span class="value"><?= $data['stats']['weekly_views'] ?? 0 ?></span>
            </div>
            <div class="stats-item">
                <span class="label">This Month:</span>
                <span class="value"><?= $data['stats']['monthly_views'] ?? 0 ?></span>
            </div>
        </div>
    </div>

    <div class="dashboard-panel full-width">
        <h2>Most Viewed Works</h2>
        <div class="popular-works">
            <?php if (!empty($data['stats']['most_viewed'])): ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Views</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['stats']['most_viewed'] as $work): ?>
                            <tr>
                                <td><?= htmlspecialchars($work['title']) ?></td>
                                <td><?= $work['views'] ?? 0 ?></td>
                                <td><?= date('M d, Y', strtotime($work['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="empty-state">No works yet. Create your first work!</p>
            <?php endif; ?>
        </div>
    </div>
</div>
