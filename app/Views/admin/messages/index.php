<?php if (!empty($data['messages'])): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Status</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Service Type</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['messages'] as $message): ?>
                <tr style="<?= !($message['read'] ?? false) ? 'background: #f0f9ff;' : '' ?>">
                    <td>
                        <?php if (!($message['read'] ?? false)): ?>
                            <span style="display: inline-block; width: 10px; height: 10px; background: #3b82f6; border-radius: 50%;"></span> New
                        <?php else: ?>
                            Read
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($message['name']) ?></td>
                    <td><?= htmlspecialchars($message['email']) ?></td>
                    <td><?= htmlspecialchars($message['phone']) ?></td>
                    <td><?= htmlspecialchars($message['service_type']) ?></td>
                    <td><?= htmlspecialchars(substr($message['message'], 0, 50)) ?>...</td>
                    <td><?= date('M d, Y H:i', strtotime($message['created_at'])) ?></td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="viewMessage(<?= htmlspecialchars(json_encode($message)) ?>)">View</button>
                        <form method="POST" action="/admin/messages/delete" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $message['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="empty-state">
        <p>No messages yet.</p>
    </div>
<?php endif; ?>

<!-- Message Modal -->
<div id="messageModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 9999; padding: 20px;">
    <div style="background: white; max-width: 600px; margin: 50px auto; padding: 30px; border-radius: 10px; max-height: 80vh; overflow-y: auto;">
        <h2>Message Details</h2>
        <div id="messageContent"></div>
        <button class="btn btn-secondary" onclick="document.getElementById('messageModal').style.display='none'">Close</button>
    </div>
</div>

<script>
function viewMessage(message) {
    const content = `
        <p><strong>From:</strong> ${message.name}</p>
        <p><strong>Email:</strong> <a href="mailto:${message.email}">${message.email}</a></p>
        <p><strong>Phone:</strong> ${message.phone}</p>
        <p><strong>Service Type:</strong> ${message.service_type}</p>
        <p><strong>Date:</strong> ${new Date(message.created_at).toLocaleString()}</p>
        <hr>
        <p><strong>Message:</strong></p>
        <p>${message.message}</p>
    `;

    document.getElementById('messageContent').innerHTML = content;
    document.getElementById('messageModal').style.display = 'block';

    // Mark as read
    if (!message.read) {
        fetch('/admin/messages/markRead', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'id=' + message.id
        });
    }
}
</script>
