import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import focus from '@alpinejs/focus';

Alpine.plugin(collapse);
Alpine.plugin(focus);

window.Alpine = Alpine;
Alpine.start();

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]')?.content;

// ============================================================
// DRAG & DROP MEDIA UPLOAD
// ============================================================
window.initDropzone = function(dropzoneEl, inputEl, previewEl) {
    if (!dropzoneEl) return;

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzoneEl.addEventListener(eventName, e => {
            e.preventDefault();
            e.stopPropagation();
        });
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        dropzoneEl.addEventListener(eventName, () => {
            dropzoneEl.classList.add('border-church-blue', 'bg-church-blue/5');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzoneEl.addEventListener(eventName, () => {
            dropzoneEl.classList.remove('border-church-blue', 'bg-church-blue/5');
        });
    });

    dropzoneEl.addEventListener('drop', e => {
        const files = e.dataTransfer.files;
        if (inputEl && files.length) {
            inputEl.files = files;
            previewFiles(files, previewEl);
        }
    });

    dropzoneEl.addEventListener('click', () => inputEl?.click());

    if (inputEl) {
        inputEl.addEventListener('change', () => {
            previewFiles(inputEl.files, previewEl);
        });
    }
};

function previewFiles(files, previewEl) {
    if (!previewEl) return;
    previewEl.innerHTML = '';
    Array.from(files).forEach(file => {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-20 h-20 object-cover rounded-xl border border-gray-200';
            previewEl.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

// ============================================================
// CONFIRM DELETE
// ============================================================
window.confirmDelete = function(form) {
    if (confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
        form.submit();
    }
};

// ============================================================
// RICH TEXT EDITOR (Trix)
// ============================================================
document.addEventListener('trix-change', function(e) {
    const hiddenInput = e.target.previousElementSibling;
    if (hiddenInput && hiddenInput.type === 'hidden') {
        hiddenInput.value = e.target.innerHTML;
    }
});

// ============================================================
// REORDER (Drag & Drop Table Rows)
// ============================================================
window.initSortable = function(tableBody, endpoint) {
    if (!tableBody) return;

    let dragging = null;

    tableBody.querySelectorAll('tr[data-id]').forEach(row => {
        row.setAttribute('draggable', true);

        row.addEventListener('dragstart', () => {
            dragging = row;
            row.style.opacity = '0.5';
        });

        row.addEventListener('dragend', () => {
            row.style.opacity = '';
            dragging = null;
            saveOrder(tableBody, endpoint);
        });

        row.addEventListener('dragover', e => {
            e.preventDefault();
            if (dragging && dragging !== row) {
                const rect = row.getBoundingClientRect();
                const next = (e.clientY - rect.top) / (rect.bottom - rect.top) > 0.5;
                tableBody.insertBefore(dragging, next ? row.nextSibling : row);
            }
        });
    });
};

function saveOrder(tableBody, endpoint) {
    const order = Array.from(tableBody.querySelectorAll('tr[data-id]')).map((row, index) => ({
        id: row.dataset.id,
        order: index,
    }));

    axios.post(endpoint, { order })
        .then(() => showToast('Order saved!', 'success'))
        .catch(() => showToast('Failed to save order', 'error'));
}

// ============================================================
// TOAST NOTIFICATIONS
// ============================================================
window.showToast = function(message, type = 'success') {
    const toast = document.createElement('div');
    const colors = {
        success: 'bg-green-500',
        error: 'bg-red-500',
        warning: 'bg-yellow-500',
        info: 'bg-blue-500',
    };

    toast.className = `fixed bottom-6 right-6 z-50 ${colors[type] || colors.success} text-white px-5 py-3 rounded-xl shadow-lg text-sm font-medium transition-all duration-300 translate-y-0`;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(10px)';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
};

// ============================================================
// SLUG GENERATOR
// ============================================================
window.generateSlug = function(sourceId, targetId) {
    const source = document.getElementById(sourceId);
    const target = document.getElementById(targetId);

    if (source && target && !target.dataset.locked) {
        source.addEventListener('input', () => {
            target.value = source.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        });
    }

    if (target) {
        target.addEventListener('input', () => {
            target.dataset.locked = 'true';
        });
    }
};

// ============================================================
// FORM VALIDATION HELPERS
// ============================================================
window.validateForm = function(formId) {
    const form = document.getElementById(formId);
    if (!form) return true;

    let isValid = true;
    form.querySelectorAll('[required]').forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('border-red-400');
            isValid = false;

            field.addEventListener('input', () => {
                field.classList.remove('border-red-400');
            }, { once: true });
        }
    });

    return isValid;
};
