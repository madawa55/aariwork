<div class="page-actions">
    <a href="/admin/works/create" class="btn btn-primary">Add New Work</a>
</div>

<?php if (!empty($data['works'])): ?>
    <div class="works-grid">
        <?php foreach ($data['works'] as $work): ?>
            <div class="work-card">
                <?php if (!empty($work['featured_image'])): ?>
                    <div class="work-image">
                        <img src="/<?= $work['featured_image'] ?>" alt="<?= htmlspecialchars($work['title']) ?>">
                    </div>
                <?php else: ?>
                    <div class="work-image no-image">
                        <span>No Image</span>
                    </div>
                <?php endif; ?>

                <div class="work-info">
                    <h3><?= htmlspecialchars($work['title']) ?></h3>
                    <p><?= htmlspecialchars(substr($work['description'], 0, 100)) ?>...</p>

                    <div class="work-meta">
                        <span><?= count($work['images']) ?> images</span>
                        <span><?= $work['views'] ?? 0 ?> views</span>
                    </div>

                    <div class="work-categories">
                        <?php
                        foreach ($work['categories'] as $catId):
                            foreach ($data['categories'] as $cat):
                                if ($cat['id'] == $catId):
                        ?>
                            <span class="category-tag" style="background-color: <?= $cat['color'] ?>20; color: <?= $cat['color'] ?>">
                                <?= htmlspecialchars($cat['name']) ?>
                            </span>
                        <?php
                                endif;
                            endforeach;
                        endforeach;
                        ?>
                    </div>

                    <div class="work-actions">
                        <a href="/admin/works/edit/<?= $work['id'] ?>" class="btn btn-sm btn-secondary">Edit</a>
                        <form method="POST" action="/admin/works/delete/<?= $work['id'] ?>" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this work?');">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="empty-state">
        <p>No works yet. Create your first work!</p>
        <a href="/admin/works/create" class="btn btn-primary">Add New Work</a>
    </div>
<?php endif; ?>
