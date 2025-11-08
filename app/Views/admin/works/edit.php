<form method="POST" action="/admin/works/edit/<?= $data['work']['id'] ?>" enctype="multipart/form-data" class="work-form">
    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($data['work']['title']) ?>" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5"><?= htmlspecialchars($data['work']['description']) ?></textarea>
    </div>

    <div class="form-group">
        <label>Categories</label>
        <div class="checkbox-group">
            <?php foreach ($data['categories'] as $category): ?>
                <label class="checkbox-label">
                    <input type="checkbox" name="categories[]" value="<?= $category['id'] ?>"
                        <?= in_array($category['id'], $data['work']['categories']) ? 'checked' : '' ?>>
                    <span style="color: <?= $category['color'] ?>"><?= htmlspecialchars($category['name']) ?></span>
                </label>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="form-group">
        <label>Current Images</label>
        <div class="current-images">
            <?php if (!empty($data['work']['images'])): ?>
                <?php foreach ($data['work']['images'] as $image): ?>
                    <div class="image-item">
                        <img src="/<?= $image['thumb'] ?>" alt="">
                        <button type="button" class="btn-delete-image" data-work-id="<?= $data['work']['id'] ?>" data-filename="<?= $image['filename'] ?>">×</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No images uploaded.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group">
        <label for="images">Add More Images</label>
        <input type="file" id="images" name="images[]" multiple accept="image/*">
        <small>Supported formats: JPG, PNG, WEBP. Max size: 5MB per image.</small>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Update Work</button>
        <a href="/admin/works" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<script>
document.querySelectorAll('.btn-delete-image').forEach(btn => {
    btn.addEventListener('click', function() {
        if (!confirm('Delete this image?')) return;

        const workId = this.dataset.workId;
        const filename = this.dataset.filename;

        fetch('/admin/works/deleteImage', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'work_id=' + workId + '&filename=' + filename
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                this.parentElement.remove();
            }
        });
    });
});
</script>
