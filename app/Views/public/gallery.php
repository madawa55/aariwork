<!-- Gallery Header -->
<section class="page-header">
    <div class="container">
        <h1>
            <?php if (isset($data['keyword']) && !empty($data['keyword'])): ?>
                Search Results for "<?= htmlspecialchars($data['keyword']) ?>"
            <?php else: ?>
                Our Gallery
            <?php endif; ?>
        </h1>
        <p>Explore our collection of beautiful aari embroidery work</p>
    </div>
</section>

<!-- Gallery Filters -->
<section class="gallery-filters">
    <div class="container">
        <div class="filter-wrapper">
            <div class="category-filters">
                <a href="/gallery" class="filter-btn <?= !isset($data['selected_category']) ? 'active' : '' ?>">
                    All
                </a>
                <?php foreach ($data['categories'] as $category): ?>
                    <a href="/gallery?category=<?= $category['id'] ?>"
                       class="filter-btn <?= isset($data['selected_category']) && $data['selected_category'] == $category['id'] ? 'active' : '' ?>"
                       style="border-color: <?= $category['color'] ?>">
                        <?= htmlspecialchars($category['name']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="gallery-section">
    <div class="container">
        <?php if (!empty($data['works'])): ?>
            <div class="gallery-grid">
                <?php foreach ($data['works'] as $work): ?>
                    <div class="gallery-item">
                        <a href="/work/<?= $work['id'] ?>" class="gallery-link">
                            <?php if (!empty($work['featured_image'])): ?>
                                <div class="gallery-image">
                                    <img src="/<?= $work['featured_image'] ?>" alt="<?= htmlspecialchars($work['title']) ?>" loading="lazy">
                                    <div class="gallery-overlay">
                                        <div class="overlay-content">
                                            <h3><?= htmlspecialchars($work['title']) ?></h3>
                                            <p><?= count($work['images']) ?> images</p>
                                            <span class="view-btn">View Details</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <p>
                    <?php if (isset($data['keyword']) && !empty($data['keyword'])): ?>
                        No results found for "<?= htmlspecialchars($data['keyword']) ?>". Try a different search term.
                    <?php else: ?>
                        No works available in this category.
                    <?php endif; ?>
                </p>
                <a href="/gallery" class="btn btn-primary">View All Works</a>
            </div>
        <?php endif; ?>
    </div>
</section>
