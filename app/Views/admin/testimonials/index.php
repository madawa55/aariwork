<div class="page-actions">
    <button class="btn btn-primary" onclick="document.getElementById('addTestimonialForm').style.display='block'">Add New Testimonial</button>
</div>

<!-- Add Testimonial Form -->
<div id="addTestimonialForm" style="display:none; margin-bottom: 30px;">
    <div style="background: white; padding: 20px; border-radius: 10px;">
        <h3>Add New Testimonial</h3>
        <form method="POST" action="/admin/testimonials/create">
            <div class="form-group">
                <label>Customer Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea name="message" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label>Rating</label>
                <select name="rating">
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
            </div>
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="published" value="1" checked>
                    Publish immediately
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Add Testimonial</button>
            <button type="button" class="btn btn-secondary" onclick="document.getElementById('addTestimonialForm').style.display='none'">Cancel</button>
        </form>
    </div>
</div>

<!-- Testimonials List -->
<?php if (!empty($data['testimonials'])): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Message</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['testimonials'] as $testimonial): ?>
                <tr>
                    <td><?= htmlspecialchars($testimonial['name']) ?></td>
                    <td><?= htmlspecialchars(substr($testimonial['message'], 0, 100)) ?>...</td>
                    <td>
                        <?php for($i = 0; $i < ($testimonial['rating'] ?? 5); $i++): ?>
                            ⭐
                        <?php endfor; ?>
                    </td>
                    <td>
                        <?php if ($testimonial['published'] ?? false): ?>
                            <span style="color: green;">Published</span>
                        <?php else: ?>
                            <span style="color: orange;">Hidden</span>
                        <?php endif; ?>
                    </td>
                    <td><?= date('M d, Y', strtotime($testimonial['created_at'])) ?></td>
                    <td>
                        <form method="POST" action="/admin/testimonials/delete" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $testimonial['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="empty-state">
        <p>No testimonials yet.</p>
    </div>
<?php endif; ?>
