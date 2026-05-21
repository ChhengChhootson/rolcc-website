import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import intersect from '@alpinejs/intersect';
import focus from '@alpinejs/focus';
import morph from '@alpinejs/morph';

// Alpine plugins
Alpine.plugin(collapse);
Alpine.plugin(intersect);
Alpine.plugin(focus);
Alpine.plugin(morph);

window.Alpine = Alpine;
Alpine.start();

// ============================================================
// SMOOTH SCROLL
// ============================================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// ============================================================
// NAVBAR SCROLL EFFECT
// ============================================================
const navbar = document.getElementById('main-navbar');
if (navbar) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 60) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
}

// ============================================================
// LAZY LOADING IMAGES
// ============================================================
if ('IntersectionObserver' in window) {
    const imgObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
                imgObserver.unobserve(img);
            }
        });
    }, { rootMargin: '50px' });

    document.querySelectorAll('img[data-src]').forEach(img => imgObserver.observe(img));
}

// ============================================================
// COUNTER ANIMATION
// ============================================================
window.animateCounter = function(el, target, duration = 2000) {
    const step = target / (duration / 16);
    let current = 0;
    const timer = setInterval(() => {
        current += step;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        el.textContent = Math.floor(current).toLocaleString();
    }, 16);
};

// ============================================================
// FLASH MESSAGE AUTO-DISMISS
// ============================================================
setTimeout(() => {
    document.querySelectorAll('[data-auto-dismiss]').forEach(el => {
        el.style.transition = 'opacity 0.5s ease';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 500);
    });
}, 5000);

// ============================================================
// CSRF AXIOS CONFIG
// ============================================================
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]')?.content;

// ============================================================
// PRAYER COUNTER (AJAX)
// ============================================================
window.prayForRequest = async function(id, btn) {
    try {
        const res = await axios.post(`/prayer/${id}/pray`);
        btn.querySelector('.count').textContent = res.data.count;
        btn.classList.add('text-church-blue');
        btn.disabled = true;
    } catch (e) {
        console.error('Prayer count update failed');
    }
};

// ============================================================
// VIDEO EMBED HELPERS
// ============================================================
window.openVideoModal = function(embedUrl) {
    const modal = document.getElementById('video-modal');
    const iframe = document.getElementById('video-iframe');
    if (modal && iframe) {
        iframe.src = embedUrl + '?autoplay=1';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
};

window.closeVideoModal = function() {
    const modal = document.getElementById('video-modal');
    const iframe = document.getElementById('video-iframe');
    if (modal && iframe) {
        iframe.src = '';
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }
};

// ESC key closes modal
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeVideoModal();
});
