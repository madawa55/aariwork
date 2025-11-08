<div class="page-actions">
    <button class="btn btn-primary" onclick="document.getElementById('addCategoryForm').style.display='block'">Add New Category</button>
</div>

<!-- Add Category Form (Hidden by default) -->
<div id="addCategoryForm" style="display:none; margin-bottom: 30px;">
    <div style="background: white; padding: 20px; border-radius: 10px;">
        <h3>Add New Category</h3>
        <form method="POST" action="/admin/categories/create">
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Color</label>
                <input type="color" name="color" value="#4f46e5">
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
            <button type="button" class="btn btn-secondary" onclick="document.getElementById('addCategoryForm').style.display='none'">Cancel</button>
        </form>
    </div>
</div>

<!-- Categories List -->
<?php if (!empty($data['categories'])): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Color</th>
                <th>Usage Count</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['categories'] as $category): ?>
                <tr>
                    <td><?= htmlspecialchars($category['name']) ?></td>
                    <td>
                        <span style="display: inline-block; width: 30px; height: 30px; background: <?= $category['color'] ?>; border-radius: 5px;"></span>
                    </td>
                    <td><?= $category['usage_count'] ?? 0 ?> works</td>
                    <td><?= date('M d, Y', strtotime($category['created_at'])) ?></td>
                    <td>
                        <form method="POST" action="/admin/categories/delete" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $category['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="empty-state">
        <p>No categories yet.</p>
    </div>
<?php endif; ?>
