/**
 * hover-fix.js
 * Patch initCyberCards() agar tilt ringan dan panel besar stabil.
 * Dimuat SETELAH app.js — mendaftarkan ulang event listener
 * dengan nilai yang sudah diperbaiki di semua card yang ada.
 */
(function () {
    'use strict';

    // Hanya aktif di perangkat dengan pointer presisi (mouse/trackpad)
    var hasFinePointer = window.matchMedia(
        '(hover: hover) and (pointer: fine)'
    ).matches;

    if (!hasFinePointer) return;

    var STABLE_SELECTORS = [
        '.algorithm-output-panel',
        '.algorithm-form-panel',
        '.algorithm-game-panel',
        '.hash-form-panel',
        '.hash-output-panel',
        '.hash-game-panel',
        '.rsa-form-panel',
    ].join(',');

    function patchCard(card) {
        // Tandai agar tidak di-patch dua kali
        if (card.dataset.hoverFixApplied === 'true') return;
        card.dataset.hoverFixApplied = 'true';

        var isStable = card.matches(STABLE_SELECTORS);
        var MAX_TILT = isStable ? 0 : 1.0; // deg

        var targetX = 0, targetY = 0;
        var currentX = 0, currentY = 0;
        var targetPX = 50, targetPY = 50;
        var currentPX = 50, currentPY = 50;
        var active = false;
        var raf = null;

        function tick() {
            raf = null;
            currentX += (targetX - currentX) * 0.10;
            currentY += (targetY - currentY) * 0.10;
            currentPX += (targetPX - currentPX) * 0.12;
            currentPY += (targetPY - currentPY) * 0.12;

            card.style.setProperty('--tilt-x', currentX.toFixed(3) + 'deg');
            card.style.setProperty('--tilt-y', currentY.toFixed(3) + 'deg');
            card.style.setProperty('--pointer-x', currentPX.toFixed(2) + '%');
            card.style.setProperty('--pointer-y', currentPY.toFixed(2) + '%');

            var moving =
                Math.abs(targetX - currentX) > 0.01 ||
                Math.abs(targetY - currentY) > 0.01 ||
                Math.abs(targetPX - currentPX) > 0.05 ||
                Math.abs(targetPY - currentPY) > 0.05;

            if (active || moving) {
                raf = requestAnimationFrame(tick);
            }
        }

        function request() {
            if (raf === null) raf = requestAnimationFrame(tick);
        }

        // Override event listeners dengan cloneNode trick —
        // hapus semua listener lama sekaligus
        var fresh = card.cloneNode(true);
        // Pertahankan dataset yang sudah ada
        fresh.dataset.hoverFixApplied = 'true';
        fresh.dataset.cyberCardReady = 'true';
        card.parentNode.replaceChild(fresh, card);
        card = fresh;

        card.addEventListener('pointerenter', function () {
            active = true;
            card.classList.add('is-card-active');
            request();
        });

        card.addEventListener('pointermove', function (e) {
            var rect = card.getBoundingClientRect();
            var px = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
            var py = Math.max(0, Math.min(1, (e.clientY - rect.top) / rect.height));

            targetX = (0.5 - py) * (MAX_TILT * 2);
            targetY = (px - 0.5) * (MAX_TILT * 2);
            targetPX = px * 100;
            targetPY = py * 100;
            request();
        });

        card.addEventListener('pointerleave', function () {
            active = false;
            targetX = 0; targetY = 0;
            targetPX = 50; targetPY = 50;
            card.classList.remove('is-card-active');
            request();
        });
    }

    function patchAll() {
        var cards = document.querySelectorAll('.cyber-motion-card');
        cards.forEach(patchCard);
    }

    // Jalankan setelah DOM siap
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', patchAll);
    } else {
        patchAll();
    }

    // Expose untuk dipanggil ulang jika card di-inject secara dinamis
    // (misal setelah renderDesResult())
    window.applyHoverFix = patchAll;
}());
