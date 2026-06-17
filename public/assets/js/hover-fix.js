/**
 * hover-fix.js
 * 1. Patch initCyberCards() agar tilt ringan dan panel besar stabil.
 * 2. Reset transform pada panel output DES agar tidak ikut miring.
 */
(function () {
    'use strict';

    var hasFinePointer = window.matchMedia(
        '(hover: hover) and (pointer: fine)'
    ).matches;

    var STABLE_SELECTORS = [
        '.algorithm-output-panel',
        '.algorithm-form-panel',
        '.algorithm-game-panel',
        '.hash-form-panel',
        '.hash-output-panel',
        '.hash-game-panel',
        '.rsa-form-panel',
    ].join(',');

    /* ── 1. Flatten semua elemen di dalam panel besar ─────── */
    function flattenPanel(el) {
        el.style.setProperty('transform', 'none', 'important');
        el.style.setProperty('transform-style', 'flat', 'important');
        el.style.setProperty('perspective', 'none', 'important');
    }

    function flattenResultArea() {
        var area = document.querySelector('[data-des-result-area]');
        if (!area) return;
        /* Flatten area itu sendiri dan semua descendant */
        flattenPanel(area);
        area.querySelectorAll('*').forEach(flattenPanel);
    }

    /* Jalankan setelah setiap kemungkinan inject hasil DES */
    function watchResultArea() {
        var area = document.querySelector('[data-des-result-area]');
        if (!area) return;

        /* Langsung flatten kalau sudah ada isi */
        flattenResultArea();

        /* Observe mutation untuk inject berikutnya */
        var obs = new MutationObserver(function () {
            flattenResultArea();
        });
        obs.observe(area, { childList: true, subtree: true });
    }

    /* ── 2. Patch card hover — tilt ringan ───────────────── */
    function patchCard(card) {
        if (card.dataset.hoverFixApplied === 'true') return;
        card.dataset.hoverFixApplied = 'true';

        var isStable = card.matches(STABLE_SELECTORS);
        var MAX_TILT = isStable ? 0 : 1.0;

        /* Panel besar: reset transform-style sekarang */
        if (isStable) {
            card.style.setProperty('transform-style', 'flat', 'important');
            card.style.setProperty('perspective', 'none', 'important');
        }

        if (!hasFinePointer) return;

        var tX = 0, tY = 0, cX = 0, cY = 0;
        var tPX = 50, tPY = 50, cPX = 50, cPY = 50;
        var active = false, raf = null;

        function tick() {
            raf = null;
            cX += (tX - cX) * 0.10;
            cY += (tY - cY) * 0.10;
            cPX += (tPX - cPX) * 0.12;
            cPY += (tPY - cPY) * 0.12;

            card.style.setProperty('--tilt-x', cX.toFixed(3) + 'deg');
            card.style.setProperty('--tilt-y', cY.toFixed(3) + 'deg');
            card.style.setProperty('--pointer-x', cPX.toFixed(2) + '%');
            card.style.setProperty('--pointer-y', cPY.toFixed(2) + '%');

            if (active ||
                Math.abs(tX - cX) > 0.01 || Math.abs(tY - cY) > 0.01 ||
                Math.abs(tPX - cPX) > 0.05 || Math.abs(tPY - cPY) > 0.05) {
                raf = requestAnimationFrame(tick);
            }
        }

        function req() { if (!raf) raf = requestAnimationFrame(tick); }

        /* Clone untuk buang listener lama dari app.js */
        var fresh = card.cloneNode(true);
        fresh.dataset.hoverFixApplied = 'true';
        fresh.dataset.cyberCardReady = 'true';
        if (isStable) {
            fresh.style.setProperty('transform-style', 'flat', 'important');
            fresh.style.setProperty('perspective', 'none', 'important');
        }
        card.parentNode.replaceChild(fresh, card);
        card = fresh;

        card.addEventListener('pointerenter', function () {
            if (!hasFinePointer) return;
            active = true;
            card.classList.add('is-card-active');
            req();
        });

        card.addEventListener('pointermove', function (e) {
            if (!hasFinePointer) return;
            var r = card.getBoundingClientRect();
            var px = Math.max(0, Math.min(1, (e.clientX - r.left) / r.width));
            var py = Math.max(0, Math.min(1, (e.clientY - r.top) / r.height));
            tX = (0.5 - py) * (MAX_TILT * 2);
            tY = (px - 0.5) * (MAX_TILT * 2);
            tPX = px * 100;
            tPY = py * 100;
            req();
        });

        card.addEventListener('pointerleave', function () {
            if (!hasFinePointer) return;
            active = false;
            tX = 0; tY = 0; tPX = 50; tPY = 50;
            card.classList.remove('is-card-active');
            req();
        });
    }

    function patchAll() {
        document.querySelectorAll('.cyber-motion-card').forEach(patchCard);
        watchResultArea();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', patchAll);
    } else {
        patchAll();
    }

    window.applyHoverFix = patchAll;
}());
