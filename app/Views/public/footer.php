    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><?= SITE_NAME ?></h3>
                    <p><?= $data['settings']['tagline'] ?? 'Exquisite Aari Embroidery Work' ?></p>
                </div>

                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/gallery">Gallery</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Contact Info</h4>
                    <p><?= $data['settings']['phone'] ?? '' ?></p>
                    <p><?= $data['settings']['contact_email'] ?? '' ?></p>
                    <p><?= $data['settings']['address'] ?? '' ?></p>
                </div>

                <div class="footer-section">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <?php if (!empty($data['settings']['facebook'])): ?>
                            <a href="<?= $data['settings']['facebook'] ?>" target="_blank" class="social-link">Facebook</a>
                        <?php endif; ?>

                        <?php if (!empty($data['settings']['instagram'])): ?>
                            <a href="<?= $data['settings']['instagram'] ?>" target="_blank" class="social-link">Instagram</a>
                        <?php endif; ?>

                        <?php if (!empty($data['settings']['whatsapp'])): ?>
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $data['settings']['whatsapp']) ?>" target="_blank" class="social-link">WhatsApp</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> <?= SITE_NAME ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <?php if (!empty($data['settings']['whatsapp'])): ?>
        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $data['settings']['whatsapp']) ?>?text=Hi%20I%20am%20interested%20in%20your%20aari%20work"
           class="whatsapp-float" target="_blank" title="Chat on WhatsApp">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="white">
                <path d="M16 0C7.164 0 0 7.163 0 16c0 2.826.737 5.627 2.139 8.085L.027 31.562l7.643-2.04A15.933 15.933 0 0 0 16 32c8.837 0 16-7.163 16-16S24.837 0 16 0zm0 29.455c-2.477 0-4.886-.68-6.996-1.973l-.503-.295-5.211 1.391 1.404-5.077-.324-.516A13.407 13.407 0 0 1 2.545 16c0-7.442 6.058-13.5 13.455-13.5 7.442 0 13.5 6.058 13.5 13.5 0 7.397-6.058 13.455-13.5 13.455z"/>
            </svg>
        </a>
    <?php endif; ?>

    <script src="/assets/js/main.js"></script>
</body>
</html>
