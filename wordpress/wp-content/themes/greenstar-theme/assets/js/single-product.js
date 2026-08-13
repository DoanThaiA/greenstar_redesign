/**
 * GreenStar – Single Product JS
 * File: assets/js/single-product.js
 *
 * Handles: gallery switcher, tab logic, inquiry form AJAX
 */
( function () {
    'use strict';

    /* ── Gallery ──────────────────────────────────────────────────────── */
    const mainImg   = document.getElementById( 'gsp-main-image' );
    const thumbsEl  = document.getElementById( 'gsp-thumbs' );
    const prevBtn   = document.querySelector( '.gsp-gallery__prev' );
    const nextBtn   = document.querySelector( '.gsp-gallery__next' );

    if ( mainImg && typeof gspData !== 'undefined' ) {
        const images  = gspData.images || [];
        let current   = 0;

        function setImage( index, smooth = true ) {
            if ( ! images[ index ] ) return;
            current = index;

            if ( smooth ) {
                mainImg.classList.add( 'fade' );
                setTimeout( () => {
                    mainImg.src = images[ index ];
                    mainImg.classList.remove( 'fade' );
                }, 220 );
            } else {
                mainImg.src = images[ index ];
            }

            // update thumbs
            if ( thumbsEl ) {
                thumbsEl.querySelectorAll( '.gsp-gallery__thumb' ).forEach( ( btn, i ) => {
                    btn.classList.toggle( 'active', i === index );
                } );
            }
        }

        // Thumbnail clicks
        if ( thumbsEl ) {
            thumbsEl.addEventListener( 'click', ( e ) => {
                const btn = e.target.closest( '.gsp-gallery__thumb' );
                if ( ! btn ) return;
                setImage( parseInt( btn.dataset.index, 10 ) );
            } );
        }

        // Arrow nav
        if ( prevBtn ) {
            prevBtn.addEventListener( 'click', () => {
                setImage( ( current - 1 + images.length ) % images.length );
            } );
        }
        if ( nextBtn ) {
            nextBtn.addEventListener( 'click', () => {
                setImage( ( current + 1 ) % images.length );
            } );
        }

        // Keyboard support
        const galleryEl = document.getElementById( 'gsp-gallery' );
        if ( galleryEl ) {
            galleryEl.addEventListener( 'keydown', ( e ) => {
                if ( e.key === 'ArrowLeft' )  setImage( ( current - 1 + images.length ) % images.length );
                if ( e.key === 'ArrowRight' ) setImage( ( current + 1 ) % images.length );
            } );
        }
    }

    /* ── Tabs ─────────────────────────────────────────────────────────── */
    const tabBtns   = document.querySelectorAll( '.gsp-tab-btn' );
    const tabPanels = document.querySelectorAll( '.gsp-tab-panel' );

    tabBtns.forEach( ( btn ) => {
        btn.addEventListener( 'click', () => {
            const target = btn.getAttribute( 'aria-controls' );

            tabBtns.forEach( ( b ) => {
                b.classList.remove( 'active' );
                b.setAttribute( 'aria-selected', 'false' );
            } );
            tabPanels.forEach( ( p ) => {
                p.hidden = true;
            } );

            btn.classList.add( 'active' );
            btn.setAttribute( 'aria-selected', 'true' );
            const panel = document.getElementById( target );
            if ( panel ) panel.hidden = false;
        } );
    } );

    /* ── Smooth scroll: "Get a Quote" ──────────────────────────────────── */
    document.querySelectorAll( 'a[href="#gsp-inquiry"]' ).forEach( ( link ) => {
        link.addEventListener( 'click', ( e ) => {
            e.preventDefault();
            const section = document.getElementById( 'gsp-inquiry' );
            if ( section ) {
                section.scrollIntoView( { behavior: 'smooth', block: 'start' } );
                // focus first field
                const firstField = section.querySelector( 'input, textarea' );
                if ( firstField ) {
                    setTimeout( () => firstField.focus(), 500 );
                }
            }
        } );
    } );

    /* ── Inquiry Form AJAX ────────────────────────────────────────────── */
    const form      = document.getElementById( 'gsp-inquiry-form' );
    const statusEl  = document.getElementById( 'gsp-form-status' );
    const submitBtn = document.getElementById( 'gsp-submit-btn' );

    if ( form && typeof gspData !== 'undefined' ) {
        form.addEventListener( 'submit', async ( e ) => {
            e.preventDefault();

            // Basic validation
            const required = form.querySelectorAll( '[required]' );
            let valid = true;
            required.forEach( ( field ) => {
                field.style.borderColor = '';
                if ( ! field.value.trim() ) {
                    field.style.borderColor = '#c00';
                    valid = false;
                }
            } );
            if ( ! valid ) return;

            submitBtn.classList.add( 'loading' );
            submitBtn.disabled = true;
            statusEl.className = 'gsp-form-status';
            statusEl.style.display = 'none';

            const formData = new FormData( form );
            formData.append( 'action', 'gsp_inquiry' );

            try {
                const resp = await fetch( gspData.ajaxUrl, {
                    method: 'POST',
                    body: formData,
                } );
                const data = await resp.json();

                if ( data.success ) {
                    statusEl.textContent = gspData.i18n.success;
                    statusEl.className = 'gsp-form-status success';
                    form.reset();
                } else {
                    statusEl.textContent = data.data || gspData.i18n.error;
                    statusEl.className = 'gsp-form-status error';
                }
            } catch ( err ) {
                statusEl.textContent = gspData.i18n.error;
                statusEl.className = 'gsp-form-status error';
            } finally {
                submitBtn.classList.remove( 'loading' );
                submitBtn.disabled = false;
            }
        } );
    }

    /* ── Process steps reveal on scroll ──────────────────────────────── */
    if ( 'IntersectionObserver' in window ) {
        const steps = document.querySelectorAll( '.gsp-process-step, .gsp-app-card' );
        const obs = new IntersectionObserver( ( entries ) => {
            entries.forEach( ( entry ) => {
                if ( entry.isIntersecting ) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    obs.unobserve( entry.target );
                }
            } );
        }, { threshold: 0.15 } );

        steps.forEach( ( el, i ) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(24px)';
            el.style.transition = `opacity .45s ease ${ i * 0.07 }s, transform .45s ease ${ i * 0.07 }s`;
            obs.observe( el );
        } );
    }

} )();
