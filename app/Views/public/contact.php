<!-- Contact Header -->
<section class="page-header">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Get in touch with us for your aari work requirements</p>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="contact-wrapper">
            <!-- Contact Form -->
            <div class="contact-form-panel">
                <h2>Send Us a Message</h2>

                <form method="POST" action="/contact" class="contact-form">
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="service_type">Service Type</label>
                        <select id="service_type" name="service_type">
                            <option value="">Select a service</option>
                            <option value="Bridal">Bridal Aari Work</option>
                            <option value="Casual">Casual Wear</option>
                            <option value="Traditional">Traditional Wear</option>
                            <option value="Custom">Custom Design</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" rows="6" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="contact-info-panel">
                <h2>Contact Information</h2>

                <div class="contact-info">
                    <div class="info-item">
                        <div class="info-icon">📧</div>
                        <div class="info-content">
                            <h4>Email</h4>
                            <p><?= $data['settings']['contact_email'] ?? SITE_EMAIL ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">📱</div>
                        <div class="info-content">
                            <h4>Phone</h4>
                            <p><?= $data['settings']['phone'] ?? '' ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">📍</div>
                        <div class="info-content">
                            <h4>Address</h4>
                            <p><?= $data['settings']['address'] ?? '' ?></p>
                        </div>
                    </div>
                </div>

                <div class="contact-social">
                    <h3>Follow Us</h3>
                    <div class="social-buttons">
                        <?php if (!empty($data['settings']['facebook'])): ?>
                            <a href="<?= $data['settings']['facebook'] ?>" target="_blank" class="social-btn">
                                Facebook
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($data['settings']['instagram'])): ?>
                            <a href="<?= $data['settings']['instagram'] ?>" target="_blank" class="social-btn">
                                Instagram
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($data['settings']['whatsapp'])): ?>
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $data['settings']['whatsapp']) ?>?text=Hi%20I%20am%20interested%20in%20your%20aari%20work" target="_blank" class="social-btn whatsapp">
                                WhatsApp
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="business-hours">
                    <h3>Business Hours</h3>
                    <p>Monday - Saturday: 9:00 AM - 6:00 PM</p>
                    <p>Sunday: By Appointment Only</p>
                </div>
            </div>
        </div>
    </div>
</section>
