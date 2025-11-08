<form method="POST" action="/admin/works/create" enctype="multipart/form-data" class="work-form">
    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" id="title" name="title" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5"></textarea>
    </div>

    <div class="form-group">
        <label>Categories</label>
        <div class="checkbox-group">
            <?php foreach ($data['categories'] as $category): ?>
                <label class="checkbox-label">
                    <input type="checkbox" name="categories[]" value="<?= $category['id'] ?>">
                    <span style="color: <?= $category['color'] ?>"><?= htmlspecialchars($category['name']) ?></span>
                </label>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="form-group">
        <label for="images">Images *</label>
        <input type="file" id="images" name="images[]" multiple accept="image/*" required>
        <small>You can select multiple images. Supported formats: JPG, PNG, WEBP. Max size: 5MB per image.</small>
    </div>

    <div class="image-preview" id="imagePreview"></div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Create Work</button>
        <a href="/admin/works" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<script>
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';

    const files = e.target.files;
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (file.type.match('image.*')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'preview-item';
                div.innerHTML = '<img src="' + e.target.result + '">';
                preview.appendChild(div);
            };
            reader.readAsDataURL(file);
        }
    }
});
</script>
