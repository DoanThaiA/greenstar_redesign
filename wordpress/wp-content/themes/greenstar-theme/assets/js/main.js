/**
 * GreenStar Vietnam – Main JavaScript
 * File: assets/js/main.js
 * Handles: mobile nav, sticky header, scroll-to-top, product tabs, accordion
 */

(function () {
    'use strict';

    /* -----------------------------------------------------------------------
       Utility helpers
    ----------------------------------------------------------------------- */
    const qs  = (sel, ctx = document) => ctx.querySelector(sel);
    const qsa = (sel, ctx = document) => [...ctx.querySelectorAll(sel)];

    /* -----------------------------------------------------------------------
       1. Sticky header — add .scrolled class on scroll
    ----------------------------------------------------------------------- */
    const header = qs('.site-header');
    if (header) {
        const onScroll = () => {
            header.classList.toggle('scrolled', window.scrollY > 40);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* -----------------------------------------------------------------------
       2. Mobile navigation
    ----------------------------------------------------------------------- */
    const navToggle  = qs('.nav-toggle');
    const mainNav    = qs('.main-nav');
    const navOverlay = qs('.nav-overlay');

    const openNav = () => {
        mainNav?.classList.add('mobile-open');
        navToggle?.classList.add('open');
        navOverlay?.classList.add('visible');
        document.body.style.overflow = 'hidden';
        navToggle?.setAttribute('aria-expanded', 'true');
    };

    const closeNav = () => {
        mainNav?.classList.remove('mobile-open');
        navToggle?.classList.remove('open');
        navOverlay?.classList.remove('visible');
        document.body.style.overflow = '';
        navToggle?.setAttribute('aria-expanded', 'false');
    };

    navToggle?.addEventListener('click', () => {
        const isOpen = mainNav?.classList.contains('mobile-open');
        isOpen ? closeNav() : openNav();
    });
    navOverlay?.addEventListener('click', closeNav);

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeNav();
    });

    // Sub-menu toggle on mobile
    qsa('.main-nav > ul > li > a .caret').forEach((caret) => {
        const link = caret.closest('a');
        link?.addEventListener('click', (e) => {
            if (window.innerWidth <= 1024) {
                e.preventDefault();
                const dropdown = link.parentElement.querySelector('.nav-dropdown');
                dropdown?.classList.toggle('sub-open');
                caret.textContent = dropdown?.classList.contains('sub-open') ? '▲' : '▼';
            }
        });
    });

    /* -----------------------------------------------------------------------
       3. Header search toggle
    ----------------------------------------------------------------------- */
    const searchToggle = qs('.header-search__toggle');
    const searchForm   = qs('.header-search__form');
    const searchInput  = qs('.header-search__form input');

    searchToggle?.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = searchForm?.classList.toggle('open');
        if (isOpen) searchInput?.focus();
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.header-search')) {
            searchForm?.classList.remove('open');
        }
    });

    /* -----------------------------------------------------------------------
       4. Scroll-to-top button
    ----------------------------------------------------------------------- */
    const scrollTopBtn = qs('.scroll-top');
    if (scrollTopBtn) {
        window.addEventListener('scroll', () => {
            scrollTopBtn.classList.toggle('visible', window.scrollY > 400);
        }, { passive: true });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* -----------------------------------------------------------------------
       5. Product tabs (show/hide product panels)
    ----------------------------------------------------------------------- */
    const tabButtons = qsa('.tab-btn');
    const tabPanels  = qsa('.tab-panel');

    tabButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const target = btn.dataset.tab;

            tabButtons.forEach((b) => b.classList.remove('active'));
            btn.classList.add('active');

            tabPanels.forEach((panel) => {
                const show = panel.dataset.tab === target;
                panel.style.display = show ? 'grid' : 'none';
                if (show) {
                    panel.style.opacity = '0';
                    panel.style.transform = 'translateY(12px)';
                    requestAnimationFrame(() => {
                        panel.style.transition = 'opacity .35s ease, transform .35s ease';
                        panel.style.opacity    = '1';
                        panel.style.transform  = 'translateY(0)';
                    });
                }
            });
        });
    });

    /* -----------------------------------------------------------------------
       6. Counter animation (for stats)
    ----------------------------------------------------------------------- */
    const animateCounter = (el) => {
        const target   = parseFloat(el.dataset.count);
        const suffix   = el.dataset.suffix || '';
        const duration = 1800;
        const start    = performance.now();

        const tick = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const ease     = 1 - Math.pow(1 - progress, 3); // ease-out cubic
            const value    = Math.round(ease * target);
            el.textContent = value + suffix;
            if (progress < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    };

    const counters     = qsa('[data-count]');
    const countersDone = new Set();

    if (counters.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting && !countersDone.has(entry.target)) {
                    countersDone.add(entry.target);
                    animateCounter(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach((c) => observer.observe(c));
    }

    /* -----------------------------------------------------------------------
       7. Scroll-reveal animation (fade + slide up)
    ----------------------------------------------------------------------- */
    const revealEls = qsa('[data-reveal]');

    if (revealEls.length && 'IntersectionObserver' in window) {
        const style = document.createElement('style');
        style.textContent = `
            [data-reveal] {
                opacity: 0;
                transform: translateY(28px);
                transition: opacity .6s ease, transform .6s ease;
            }
            [data-reveal].revealed {
                opacity: 1;
                transform: translateY(0);
            }
        `;
        document.head.appendChild(style);

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const delay = entry.target.dataset.revealDelay || 0;
                    setTimeout(() => {
                        entry.target.classList.add('revealed');
                    }, delay);
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        revealEls.forEach((el) => revealObserver.observe(el));
    }

    /* -----------------------------------------------------------------------
       8. CTA video modal (play button opens video lightbox)
    ----------------------------------------------------------------------- */
    const playBtn   = qs('.cta-section__icon');
    const videoUrl  = playBtn?.dataset.videoUrl;

    if (playBtn && videoUrl) {
        playBtn.addEventListener('click', () => {
            const modal = document.createElement('div');
            modal.className = 'gs-modal';
            modal.innerHTML = `
                <div class="gs-modal__backdrop"></div>
                <div class="gs-modal__content">
                    <button class="gs-modal__close" aria-label="Close">&times;</button>
                    <div class="gs-modal__video">
                        <iframe src="${videoUrl}?autoplay=1&rel=0"
                            frameborder="0" allowfullscreen allow="autoplay; fullscreen">
                        </iframe>
                    </div>
                </div>`;

            const style = document.createElement('style');
            style.textContent = `
                .gs-modal { position: fixed; inset: 0; z-index: 9999; display: flex; align-items: center; justify-content: center; animation: fadein .25s ease; }
                .gs-modal__backdrop { position: absolute; inset: 0; background: rgba(0,0,0,.85); }
                .gs-modal__content { position: relative; z-index: 1; width: min(900px, 95vw); }
                .gs-modal__close { position: absolute; top: -2.5rem; right: 0; background: none; color: #fff; font-size: 2rem; border: none; cursor: pointer; line-height: 1; }
                .gs-modal__video { position: relative; padding-bottom: 56.25%; border-radius: 12px; overflow: hidden; }
                .gs-modal__video iframe { position: absolute; inset: 0; width: 100%; height: 100%; }
                @keyframes fadein { from { opacity: 0; } to { opacity: 1; } }
            `;
            document.head.appendChild(style);
            document.body.appendChild(modal);
            document.body.style.overflow = 'hidden';

            const close = () => {
                modal.remove(); style.remove();
                document.body.style.overflow = '';
            };
            modal.querySelector('.gs-modal__close').addEventListener('click', close);
            modal.querySelector('.gs-modal__backdrop').addEventListener('click', close);
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); }, { once: true });
        });
    }

    /* -----------------------------------------------------------------------
       9. Newsletter subscribe form (CTA banner)
    ----------------------------------------------------------------------- */
    const newsletterForm = qs('#cta-newsletter-form');
    if (newsletterForm && window.greenstarData) {
        const msg = qs('#cta-newsletter-msg');
        newsletterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const emailField = qs('#cta-newsletter-email', newsletterForm);
            const email = emailField.value.trim();
            const submitBtn = qs('button[type="submit"]', newsletterForm);

            submitBtn.disabled = true;
            if (msg) { msg.textContent = ''; msg.className = 'cta-section__newsletter-msg'; }

            const body = new URLSearchParams({
                action: 'greenstar_subscribe',
                nonce: greenstarData.nonce,
                email,
            });

            fetch(greenstarData.ajaxUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body,
            })
                .then((res) => res.json())
                .then((data) => {
                    if (msg) {
                        msg.textContent = data.data || '';
                        msg.classList.add(data.success ? 'is-success' : 'is-error');
                    }
                    if (data.success) {
                        newsletterForm.reset();
                    }
                })
                .catch(() => {
                    if (msg) {
                        msg.textContent = 'Something went wrong. Please try again.';
                        msg.classList.add('is-error');
                    }
                })
                .finally(() => {
                    submitBtn.disabled = false;
                });
        });
    }

    /* -----------------------------------------------------------------------
       10. Contact page form
    ----------------------------------------------------------------------- */
    const contactForm = qs('#gs-contact-form');
    if (contactForm && window.greenstarData) {
        const contactStatus  = qs('#gs-contact-status');
        const contactSubmit  = qs('#gs-contact-submit-btn');

        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            contactSubmit.disabled = true;
            if (contactStatus) { contactStatus.textContent = ''; contactStatus.className = 'gsp-form-status'; }

            const body = new URLSearchParams({
                action: 'greenstar_contact',
                nonce: greenstarData.nonce,
                contact_name: qs('#contact_name', contactForm).value,
                contact_email: qs('#contact_email', contactForm).value,
                contact_phone: qs('#contact_phone', contactForm).value,
                contact_subject: qs('#contact_subject', contactForm).value,
                contact_message: qs('#contact_message', contactForm).value,
            });

            fetch(greenstarData.ajaxUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body,
            })
                .then((res) => res.json())
                .then((data) => {
                    if (contactStatus) {
                        contactStatus.textContent = data.data || '';
                        contactStatus.classList.add(data.success ? 'success' : 'error');
                    }
                    if (data.success) {
                        contactForm.reset();
                    }
                })
                .catch(() => {
                    if (contactStatus) {
                        contactStatus.textContent = 'Something went wrong. Please try again.';
                        contactStatus.classList.add('error');
                    }
                })
                .finally(() => {
                    contactSubmit.disabled = false;
                });
        });
    }

    /* -----------------------------------------------------------------------
       11. Facility gallery carousel arrows
    ----------------------------------------------------------------------- */
    qsa('.tech-gallery__carousel').forEach((carousel) => {
        const track = qs('.tech-gallery__grid', carousel);
        const prev  = qs('.tech-gallery__nav--prev', carousel);
        const next  = qs('.tech-gallery__nav--next', carousel);
        if (!track) return;

        const scrollByCard = (dir) => {
            const card = qs('.gallery-item', track);
            const amount = card ? card.getBoundingClientRect().width + 24 : 320;
            track.scrollBy({ left: dir * amount, behavior: 'smooth' });
        };

        prev?.addEventListener('click', () => scrollByCard(-1));
        next?.addEventListener('click', () => scrollByCard(1));
    });

    /* -----------------------------------------------------------------------
       12. Product archive — FILTER button toggles the sidebar
    ----------------------------------------------------------------------- */
    const filterBtn = qs('.gs-filter-btn');
    const archiveSidebar = qs('.gs-archive-sidebar');
    const archiveLayout  = qs('.gs-archive-layout');
    if (filterBtn && archiveSidebar) {
        filterBtn.setAttribute('aria-expanded', 'true');
        filterBtn.addEventListener('click', () => {
            const hidden = archiveSidebar.classList.toggle('is-hidden');
            archiveLayout?.classList.toggle('sidebar-hidden', hidden);
            filterBtn.classList.toggle('is-active', !hidden);
            filterBtn.setAttribute('aria-expanded', String(!hidden));
        });
    }

    /* -----------------------------------------------------------------------
       13. Active nav link based on current page
    ----------------------------------------------------------------------- */
    const currentUrl = window.location.pathname + window.location.search + window.location.hash;
    qsa('.main-nav a').forEach((link) => {
        try {
            link.classList.remove('active');
            const urlObj = new URL(link.href);
            const linkUrl = urlObj.pathname + urlObj.search + urlObj.hash;
            if (currentUrl === linkUrl) {
                link.classList.add('active');
            } else if (linkUrl !== '/' && linkUrl !== '/#' && currentUrl.startsWith(linkUrl)) {
                link.classList.add('active');
            }
        } catch (_) {}
    });

})();
