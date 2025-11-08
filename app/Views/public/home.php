<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1><?= SITE_NAME ?></h1>
        <p><?= $data['settings']['tagline'] ?? 'Exquisite Aari Embroidery Work' ?></p>
        <div class="hero-actions">
            <a href="/gallery" class="btn btn-primary">View Gallery</a>
            <a href="/contact" class="btn btn-outline">Contact Us</a>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <div class="section-header">
            <h2>About Us</h2>
            <p>Creating beautiful handcrafted aari embroidery work with passion and precision</p>
        </div>

        <div class="about-content">
            <p>Welcome to Yuhaa Aari Work, where traditional craftsmanship meets contemporary design. We specialize in exquisite aari embroidery work, creating stunning pieces that add elegance and beauty to any garment.</p>
            <p>Each piece is carefully handcrafted with attention to detail, ensuring the highest quality and unique designs that stand out.</p>
        </div>
    </div>
</section>

<!-- Featured Works -->
<section class="featured-works">
    <div class="container">
        <div class="section-header">
            <h2>Our Recent Works</h2>
            <p>Browse through our latest creations</p>
        </div>

        <?php if (!empty($data['featured_works'])): ?>
            <div class="works-grid">
                <?php foreach ($data['featured_works'] as $work): ?>
                    <div class="work-item">
                        <a href="/work/<?= $work['id'] ?>" class="work-link">
                            <?php if (!empty($work['featured_image'])): ?>
                                <div class="work-image">
                                    <img src="/<?= $work['featured_image'] ?>" alt="<?= htmlspecialchars($work['title']) ?>" loading="lazy">
                                    <div class="work-overlay">
                                        <span class="view-btn">View Details</span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="work-details">
                                <h3><?= htmlspecialchars($work['title']) ?></h3>
                                <p><?= htmlspecialchars(substr($work['description'], 0, 100)) ?>...</p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="section-footer">
                <a href="/gallery" class="btn btn-primary">View All Works</a>
            </div>
        <?php else: ?>
            <p class="empty-state">No works available yet. Check back soon!</p>
        <?php endif; ?>
    </div>
</section>

<!-- Testimonials -->
<?php if (!empty($data['testimonials'])): ?>
<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2>What Our Clients Say</h2>
            <p>Reviews from our satisfied customers</p>
        </div>

        <div class="testimonials-grid">
            <?php foreach (array_slice($data['testimonials'], 0, 3) as $testimonial): ?>
                <div class="testimonial-item">
                    <div class="testimonial-rating">
                        <?php for ($i = 0; $i < ($testimonial['rating'] ?? 5); $i++): ?>
                            <span class="star">⭐</span>
                        <?php endfor; ?>
                    </div>
                    <p class="testimonial-message">"<?= htmlspecialchars($testimonial['message']) ?>"</p>
                    <p class="testimonial-author">- <?= htmlspecialchars($testimonial['name']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Call to Action -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Get Started?</h2>
        <p>Contact us today to discuss your aari work requirements</p>
        <a href="/contact" class="btn btn-primary btn-lg">Get in Touch</a>
    </div>
</section>
