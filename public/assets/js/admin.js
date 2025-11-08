/**
 * Admin Panel JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s';
            setTimeout(function() {
                alert.remove();
            }, 500);
        }, 5000);
    });

    // Confirm delete actions
    const deleteForms = document.querySelectorAll('form[action*="delete"]');
    deleteForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    });

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(function(field) {
                if (field.value.trim() === '') {
                    isValid = false;
                    field.style.borderColor = 'red';
                } else {
                    field.style.borderColor = '';
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields');
            }
        });
    });

    // Image preview functionality
    const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
    imageInputs.forEach(function(input) {
        input.addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            if (!preview) return;

            preview.innerHTML = '';

            const files = e.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (file.type.match('image.*')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'preview-item';
                        div.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
                        preview.appendChild(div);
                    };

                    reader.readAsDataURL(file);
                }
            }
        });
    });

    // Toggle publish status for testimonials
    const publishToggles = document.querySelectorAll('[data-toggle-publish]');
    publishToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const id = this.dataset.id;
            const url = this.dataset.url || '/admin/testimonials/togglePublish';

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
        });
    });

    // Mark message as read
    const messageItems = document.querySelectorAll('[data-message-id]');
    messageItems.forEach(function(item) {
        item.addEventListener('click', function() {
            const id = this.dataset.messageId;

            fetch('/admin/messages/markRead', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (data.success) {
                    item.classList.remove('unread');
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
        });
    });

    // Character counter for textareas
    const textareas = document.querySelectorAll('textarea[maxlength]');
    textareas.forEach(function(textarea) {
        const maxLength = textarea.getAttribute('maxlength');
        const counter = document.createElement('div');
        counter.className = 'char-counter';
        counter.style.textAlign = 'right';
        counter.style.fontSize = '0.85rem';
        counter.style.color = '#666';
        counter.style.marginTop = '5px';

        textarea.parentNode.appendChild(counter);

        const updateCounter = function() {
            const remaining = maxLength - textarea.value.length;
            counter.textContent = remaining + ' characters remaining';

            if (remaining < 20) {
                counter.style.color = 'red';
            } else {
                counter.style.color = '#666';
            }
        };

        textarea.addEventListener('input', updateCounter);
        updateCounter();
    });

    // Sortable tables
    const sortableTables = document.querySelectorAll('.data-table');
    sortableTables.forEach(function(table) {
        const headers = table.querySelectorAll('th');

        headers.forEach(function(header, index) {
            header.style.cursor = 'pointer';
            header.addEventListener('click', function() {
                sortTable(table, index);
            });
        });
    });

    function sortTable(table, column) {
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));

        rows.sort(function(a, b) {
            const aValue = a.cells[column].textContent.trim();
            const bValue = b.cells[column].textContent.trim();

            if (!isNaN(aValue) && !isNaN(bValue)) {
                return parseFloat(aValue) - parseFloat(bValue);
            }

            return aValue.localeCompare(bValue);
        });

        rows.forEach(function(row) {
            tbody.appendChild(row);
        });
    }

    // Auto-save draft functionality (for future enhancement)
    const autoSaveForms = document.querySelectorAll('[data-autosave]');
    autoSaveForms.forEach(function(form) {
        const formId = form.dataset.autosave;

        // Load saved draft
        const savedData = localStorage.getItem('draft_' + formId);
        if (savedData) {
            const data = JSON.parse(savedData);
            Object.keys(data).forEach(function(key) {
                const field = form.querySelector('[name="' + key + '"]');
                if (field) {
                    field.value = data[key];
                }
            });
        }

        // Save on input
        form.addEventListener('input', function() {
            const formData = {};
            const inputs = form.querySelectorAll('input, textarea, select');

            inputs.forEach(function(input) {
                if (input.name) {
                    formData[input.name] = input.value;
                }
            });

            localStorage.setItem('draft_' + formId, JSON.stringify(formData));
        });

        // Clear draft on submit
        form.addEventListener('submit', function() {
            localStorage.removeItem('draft_' + formId);
        });
    });

    // Drag and drop file upload
    const dropZones = document.querySelectorAll('.drop-zone');
    dropZones.forEach(function(dropZone) {
        const fileInput = dropZone.querySelector('input[type="file"]');

        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('drag-over');
        });

        dropZone.addEventListener('dragleave', function() {
            this.classList.remove('drag-over');
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');

            if (fileInput && e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                const event = new Event('change', { bubbles: true });
                fileInput.dispatchEvent(event);
            }
        });
    });
});
