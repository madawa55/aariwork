<!-- Work Detail -->
<section class="work-detail-section">
    <div class="container">
        <div class="work-detail-wrapper">
            <!-- Image Gallery -->
            <div class="work-gallery">
                <div class="main-image" id="mainImage">
                    <?php if (!empty($data['work']['images'])): ?>
                        <img src="/<?= $data['work']['images'][0]['original'] ?>" alt="<?= htmlspecialchars($data['work']['title']) ?>">
                    <?php endif; ?>
                </div>

                <?php if (count($data['work']['images']) > 1): ?>
                    <div class="image-thumbnails">
                        <?php foreach ($data['work']['images'] as $index => $image): ?>
                            <div class="thumbnail <?= $index === 0 ? 'active' : '' ?>" data-image="/<?= $image['original'] ?>">
                                <img src="/<?= $image['thumb'] ?>" alt="Thumbnail <?= $index + 1 ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Work Info -->
            <div class="work-info-panel">
                <h1><?= htmlspecialchars($data['work']['title']) ?></h1>

                <div class="work-meta">
                    <span class="meta-item">
                        <strong>Images:</strong> <?= count($data['work']['images']) ?>
                    </span>
                    <span class="meta-item">
                        <strong>Views:</strong> <?= $data['work']['views'] ?? 0 ?>
                    </span>
                    <span class="meta-item">
                        <strong>Posted:</strong> <?= date('M d, Y', strtotime($data['work']['created_at'])) ?>
                    </span>
                </div>

                <?php if (!empty($data['work']['categories'])): ?>
                    <div class="work-categories">
                        <strong>Categories:</strong>
                        <?php
                        foreach ($data['work']['categories'] as $catId):
                            foreach ($data['categories'] as $cat):
                                if ($cat['id'] == $catId):
                        ?>
                            <span class="category-badge" style="background-color: <?= $cat['color'] ?>20; color: <?= $cat['color'] ?>">
                                <?= htmlspecialchars($cat['name']) ?>
                            </span>
                        <?php
                                endif;
                            endforeach;
                        endforeach;
                        ?>
                    </div>
                <?php endif; ?>

                <div class="work-description">
                    <h3>Description</h3>
                    <p><?= nl2br(htmlspecialchars($data['work']['description'])) ?></p>
                </div>

                <div class="work-actions">
                    <a href="/contact" class="btn btn-primary">Inquire About This Work</a>
                    <a href="/gallery" class="btn btn-outline">Back to Gallery</a>
                </div>

                <!-- Social Share -->
                <div class="social-share">
                    <p><strong>Share:</strong></p>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>" target="_blank" class="share-btn">Facebook</a>
                    <?php if (!empty($data['settings']['whatsapp'])): ?>
                        <a href="https://wa.me/?text=Check%20out%20this%20work:%20<?= urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) ?>" target="_blank" class="share-btn">WhatsApp</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Related Works -->
        <?php if (!empty($data['related_works'])): ?>
            <div class="related-works">
                <h2>Related Works</h2>
                <div class="works-grid">
                    <?php foreach ($data['related_works'] as $work): ?>
                        <div class="work-item">
                            <a href="/work/<?= $work['id'] ?>" class="work-link">
                                <?php if (!empty($work['featured_image'])): ?>
                                    <div class="work-image">
                                        <img src="/<?= $work['featured_image'] ?>" alt="<?= htmlspecialchars($work['title']) ?>" loading="lazy">
                                    </div>
                                <?php endif; ?>
                                <div class="work-details">
                                    <h3><?= htmlspecialchars($work['title']) ?></h3>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
// Thumbnail click to change main image
document.querySelectorAll('.thumbnail').forEach(thumb => {
    thumb.addEventListener('click', function() {
        document.querySelector('.thumbnail.active')?.classList.remove('active');
        this.classList.add('active');

        const mainImage = document.querySelector('#mainImage img');
        mainImage.src = this.dataset.image;
    });
});
</script>
