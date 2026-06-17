/**
 * hover-fix.js  —  v3
 * Inject CSS fix langsung via JS agar tidak bergantung pada
 * Blade cache atau link tag di layout.
 */
(function () {
    'use strict';

    /* ── Inject CSS override via <style> tag ─────────────── */
    var css = [
        /* Matikan transform-style preserve-3d pada semua child card */
        '.cyber-motion-card{transform-style:flat!important}',
        '.cyber-motion-card *{transform-style:flat!important;perspective:none!important}',

        /* Base tilt — ringan */
        '.cyber-motion-card{',
        '  transform:translate3d(0,0,0) perspective(1200px) rotateX(var(--tilt-x,0deg)) rotateY(var(--tilt-y,0deg));',
        '  transition:transform 280ms ease-out,border-color 240ms ease,background 240ms ease',
        '}',

        /* Active state — ringan */
        '.cyber-motion-card.is-card-active{',
        '  border-color:rgba(124,255,178,.52);',
        '  transform:translate3d(0,-3px,0) perspective(1200px) rotateX(var(--tilt-x,0deg)) rotateY(var(--tilt-y,0deg)) scale(1.004)',
        '}',

        /* Panel besar — NO tilt, NO 3d */
        '.algorithm-form-panel,.algorithm-output-panel,.algorithm-game-panel,',
        '.hash-form-panel,.hash-output-panel,.hash-game-panel,.rsa-form-panel{',
        '  transform-style:flat!important;perspective:none!important',
        '}',
        '.algorithm-form-panel.cyber-motion-card,.algorithm-output-panel.cyber-motion-card,.algorithm-game-panel.cyber-motion-card,',
        '.hash-form-panel.cyber-motion-card,.hash-output-panel.cyber-motion-card,.hash-game-panel.cyber-motion-card,.rsa-form-panel.cyber-motion-card{',
        '  transform:translate3d(0,0,0)!important;perspective:none!important',
        '}',
        '.algorithm-form-panel.cyber-motion-card.is-card-active,.algorithm-output-panel.cyber-motion-card.is-card-active,.algorithm-game-panel.cyber-motion-card.is-card-active,',
        '.hash-form-panel.cyber-motion-card.is-card-active,.hash-output-panel.cyber-motion-card.is-card-active,.hash-game-panel.cyber-motion-card.is-card-active,.rsa-form-panel.cyber-motion-card.is-card-active{',
        '  transform:translate3d(0,-2px,0)!important;perspective:none!important',
        '}',

        /* Area output DES dinamis */
        '[data-des-result-area],[data-des-result-area] *{',
        '  transform:none!important;transform-style:flat!important;perspective:none!important',
        '}',

        /* Card di dalam tabel */
        '.table-responsive .cyber-motion-card,.comparison-wrap .cyber-motion-card,',
        '.member-table-wrap .cyber-motion-card,.glossary-wrap .cyber-motion-card,table .cyber-motion-card{',
        '  transform:none!important',
        '}',

        /* Touch / mobile */
        '@media not all and (hover:hover) and (pointer:fine){',
        '  .cyber-motion-card,.cyber-motion-card.is-card-active{transform:translate3d(0,0,0)!important}',
        '}',

        /* Reduced motion */
        '@media (prefers-reduced-motion:reduce){',
        '  .cyber-motion-card,.cyber-motion-card.is-card-active{transform:translate3d(0,0,0)!important;transition:border-color 220ms ease!important}',
        '}',
    ].join('');

    var styleEl = document.createElement('style');
    styleEl.id  = 'hover-fix-css';
    styleEl.textContent = css;
    document.head.appendChild(styleEl);

    /* ── Pointer guard ───────────────────────────────────── */
    var hasFinePointer = window.matchMedia('(hover:hover) and (pointer:fine)').matches;

    var STABLE = [
        '.algorithm-output-panel','.algorithm-form-panel',
        '.algorithm-game-panel','.hash-form-panel',
        '.hash-output-panel','.hash-game-panel','.rsa-form-panel',
    ].join(',');

    /* Flatten inline style pada elemen dinamis */
    function flatEl(el) {
        el.style.setProperty('transform','none','important');
        el.style.setProperty('transform-style','flat','important');
        el.style.setProperty('perspective','none','important');
    }

    function flatArea() {
        var a = document.querySelector('[data-des-result-area]');
        if (!a) return;
        flatEl(a);
        a.querySelectorAll('*').forEach(flatEl);
    }

    function watchArea() {
        var a = document.querySelector('[data-des-result-area]');
        if (!a) return;
        flatArea();
        new MutationObserver(flatArea).observe(a, {childList:true, subtree:true});
    }

    /* Patch event listener hover per card */
    function patchCard(card) {
        if (card.dataset.hoverFixApplied === 'true') return;
        card.dataset.hoverFixApplied = 'true';

        var stable = card.matches(STABLE);
        var MAX = stable ? 0 : 1.0;

        if (stable) {
            card.style.setProperty('transform-style','flat','important');
            card.style.setProperty('perspective','none','important');
        }

        if (!hasFinePointer) return;

        var tX=0,tY=0,cX=0,cY=0,tPX=50,tPY=50,cPX=50,cPY=50;
        var active=false, raf=null;

        function tick() {
            raf=null;
            cX+=(tX-cX)*0.10; cY+=(tY-cY)*0.10;
            cPX+=(tPX-cPX)*0.12; cPY+=(tPY-cPY)*0.12;
            card.style.setProperty('--tilt-x', cX.toFixed(3)+'deg');
            card.style.setProperty('--tilt-y', cY.toFixed(3)+'deg');
            card.style.setProperty('--pointer-x', cPX.toFixed(2)+'%');
            card.style.setProperty('--pointer-y', cPY.toFixed(2)+'%');
            if (active||Math.abs(tX-cX)>.01||Math.abs(tY-cY)>.01||Math.abs(tPX-cPX)>.05||Math.abs(tPY-cPY)>.05)
                raf=requestAnimationFrame(tick);
        }
        function req(){if(!raf)raf=requestAnimationFrame(tick);}

        /* Buang listener lama dari app.js dengan cloneNode */
        var fresh=card.cloneNode(true);
        fresh.dataset.hoverFixApplied='true';
        fresh.dataset.cyberCardReady='true';
        if(stable){
            fresh.style.setProperty('transform-style','flat','important');
            fresh.style.setProperty('perspective','none','important');
        }
        card.parentNode.replaceChild(fresh,card);
        card=fresh;

        card.addEventListener('pointerenter',function(){active=true;card.classList.add('is-card-active');req();});
        card.addEventListener('pointermove',function(e){
            var r=card.getBoundingClientRect();
            var px=Math.max(0,Math.min(1,(e.clientX-r.left)/r.width));
            var py=Math.max(0,Math.min(1,(e.clientY-r.top)/r.height));
            tX=(0.5-py)*(MAX*2); tY=(px-0.5)*(MAX*2);
            tPX=px*100; tPY=py*100; req();
        });
        card.addEventListener('pointerleave',function(){
            active=false; tX=0;tY=0;tPX=50;tPY=50;
            card.classList.remove('is-card-active'); req();
        });
    }

    function patchAll() {
        document.querySelectorAll('.cyber-motion-card').forEach(patchCard);
        watchArea();
    }

    if (document.readyState==='loading') document.addEventListener('DOMContentLoaded',patchAll);
    else patchAll();

    window.applyHoverFix = patchAll;
}());
