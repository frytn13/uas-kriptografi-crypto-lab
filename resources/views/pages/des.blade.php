@extends('layouts.app')

@section('title', 'Crypto Lab | DES Algorithm')

@section('content')
<style>
    /* ===== EMERGENCY HOVER FIX ===== */
    /* Override aggressive tilt from app.js without waiting for file update */
    .cyber-motion-card {
        transform-style: flat !important;
        perspective: none !important;
    }
    
    .cyber-motion-card * {
        transform-style: flat !important;
        perspective: none !important;
    }
    
    /* Base state — gentle movement only */
    .cyber-motion-card {
        transform: translate3d(0, 0, 0) !important;
        transition: transform 280ms ease-out, border-color 220ms ease, background 220ms ease !important;
    }
    
    /* Active state — very gentle lift, NO tilt */
    .cyber-motion-card.is-card-active {
        border-color: rgba(124, 255, 178, 0.52) !important;
        transform: translate3d(0, -3px, 0) scale(1.004) !important;
    }
    
    /* Big panels — MUST be flat */
    .algorithm-form-panel,
    .algorithm-output-panel,
    .algorithm-game-panel,
    .hash-form-panel,
    .hash-output-panel,
    .hash-game-panel,
    .rsa-form-panel {
        transform: translate3d(0, 0, 0) !important;
        transform-style: flat !important;
        perspective: none !important;
    }
    
    .algorithm-form-panel.cyber-motion-card.is-card-active,
    .algorithm-output-panel.cyber-motion-card.is-card-active,
    .algorithm-game-panel.cyber-motion-card.is-card-active {
        transform: translate3d(0, -2px, 0) !important;
    }
    
    /* DES result area — FLAT */
    [data-des-result-area],
    [data-des-result-area] * {
        transform: none !important;
        transform-style: flat !important;
        perspective: none !important;
    }
    
    /* Touch devices — NO tilt */
    @media not all and (hover: hover) and (pointer: fine) {
        .cyber-motion-card,
        .cyber-motion-card.is-card-active {
            transform: translate3d(0, 0, 0) !important;
        }
    }
    /* ===== END EMERGENCY FIX ===== */

    .des-page {
        --des-card-min: 220px;
    }

    .des-page * {
        min-width: 0;
    }

    .des-compare-grid,
    .des-simulation-grid,
    .des-round-grid,
    .des-game-option-grid {
        display: grid;
        gap: var(--space-lg);
    }

    .des-compare-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        margin-top: var(--space-xl);
    }

    .des-simulation-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        align-items: start;
    }

    .des-compare-card,
    .des-mini-panel,
    .des-game-selected,
    .des-round-card {
        min-height: auto;
        border: 1px solid var(--color-hairline);
        padding: clamp(20px, 2.2vw, 28px);
        background: transparent;
    }

    .des-compare-card {
        display: flex;
        flex-direction: column;
    }

    .des-compare-card span,
    .des-mini-panel span,
    .des-game-selected span,
    .des-round-card span {
        display: block;
        margin-bottom: var(--space-md);
        color: var(--color-muted);
        font-family: var(--font-mono);
        font-size: 11px;
        line-height: 1.4;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .des-compare-card h3,
    .des-mini-panel h3 {
        margin: 0 0 var(--space-lg);
    }

    .des-compare-pair {
        display: grid;
        gap: 0;
        margin-top: auto;
        border-top: 1px solid var(--color-hairline);
    }

    .des-compare-pair div {
        display: grid;
        grid-template-columns: minmax(112px, 0.42fr) minmax(0, 1fr);
        gap: var(--space-md);
        padding: var(--space-md) 0;
        border-bottom: 1px solid var(--color-hairline);
    }

    .des-compare-pair div:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .des-compare-pair strong,
    .des-game-selected strong,
    .des-round-card strong {
        color: var(--color-primary);
        font-family: var(--font-display);
        font-size: 18px;
        font-weight: 400;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .des-compare-pair p,
    .des-mini-panel p {
        margin: 0;
        color: var(--color-body);
    }

    .des-output-actions {
        display: flex;
        flex-wrap: wrap;
        gap: var(--space-md);
        margin-top: var(--space-xl);
    }

    .des-error,
    .des-feedback,
    .des-game-feedback {
        margin-top: var(--space-md);
        min-height: 24px;
        color: var(--color-link);
        font-family: var(--font-mono);
        font-size: 12px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .des-error {
        color: #ffb7b7;
    }

    .des-page .algorithm-form-panel,
    .des-page .algorithm-output-panel,
    .des-page .algorithm-game-panel {
        padding: clamp(22px, 2.4vw, 32px);
    }

    .des-page .algorithm-result-list {
        margin-top: var(--space-lg);
    }

    .des-page .algorithm-result-row {
        grid-template-columns: minmax(150px, 0.58fr) minmax(0, 1.42fr);
        align-items: start;
        padding: var(--space-lg) 0;
    }

    .des-page .algorithm-code-output {
        max-width: 100%;
        white-space: normal;
        overflow-wrap: anywhere;
        word-break: break-word;
    }


    .des-page .algorithm-flow {
        grid-template-columns: repeat(4, minmax(0, 1fr));
        align-items: stretch;
    }

    .des-page .algorithm-flow-item {
        min-height: 230px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap: var(--space-md);
        padding: clamp(28px, 2.6vw, 36px);
        background: transparent;
    }

    .des-page .algorithm-flow-item span {
        display: block;
        width: 100%;
        margin: 0;
        color: var(--color-muted);
        font-family: var(--font-mono);
        font-size: 11px;
        line-height: 1.4;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .des-page .algorithm-flow-item strong {
        display: block;
        width: 100%;
        margin: 0;
        color: var(--color-primary);
        font-family: var(--font-display);
        font-size: clamp(22px, 2.1vw, 28px);
        font-weight: 400;
        line-height: 1.18;
        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .des-page .algorithm-flow-item p {
        width: 100%;
        max-width: 34ch;
        margin: 0;
        color: var(--color-body);
        font-size: 16px;
        line-height: 1.75;
    }

    .des-round-heading {
        margin-top: var(--space-xxl);
        padding-top: var(--space-xl);
        border-top: 1px solid var(--color-hairline);
    }

    .des-round-heading h3 {
        margin: 0;
    }

    .des-round-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
        margin-top: var(--space-xl);
    }

    .des-round-card {
        display: grid;
        align-content: start;
        gap: var(--space-sm);
    }

    .des-round-card code,
    .des-game-selected code {
        display: block;
        color: var(--color-link);
        font-family: var(--font-mono);
        font-size: 12px;
        line-height: 1.7;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .des-round-card code {
        padding-top: var(--space-xs);
        border-top: 1px solid var(--color-hairline);
    }

    .des-game-board {
        display: grid;
        gap: var(--space-lg);
    }

    .des-game-option-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        margin-top: var(--space-xl);
    }

    .des-game-option {
        width: 100%;
        min-height: 112px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--color-hairline);
        background: transparent;
        color: var(--color-primary);
        cursor: pointer;
        padding: var(--space-lg);
        font-family: var(--font-display);
        font-size: clamp(18px, 2vw, 22px);
        letter-spacing: 1px;
        line-height: 1.35;
        text-align: center;
        text-transform: uppercase;
    }

    .des-game-option:hover {
        border-color: rgba(124, 255, 178, 0.64);
    }

    .des-game-option.is-disabled {
        opacity: 0.35;
        pointer-events: none;
    }

    .des-game-sequence {
        display: flex;
        flex-wrap: wrap;
        gap: var(--space-sm);
        margin-top: var(--space-md);
    }

    .des-game-sequence code {
        border: 1px solid var(--color-hairline);
        padding: 8px 10px;
    }

    @media (max-width: 1180px) {
        .des-round-grid,
        .des-compare-grid,
        .des-page .algorithm-flow {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 900px) {
        .des-simulation-grid,
        .des-round-grid,
        .des-compare-grid,
        .des-game-option-grid,
        .des-page .algorithm-flow {
            grid-template-columns: 1fr;
        }

        .des-page .algorithm-result-row,
        .des-compare-pair div {
            grid-template-columns: 1fr;
            gap: var(--space-xs);
        }
    }

    @media (max-width: 768px) {
        .des-page .algorithm-form-panel,
        .des-page .algorithm-output-panel,
        .des-page .algorithm-game-panel,
        .des-compare-card,
        .des-mini-panel,
        .des-game-selected,
        .des-round-card,
        .des-page .algorithm-flow-item {
            padding: var(--space-lg);
        }

        .des-page .algorithm-flow-item {
            min-height: auto;
        }

        .des-game-option {
            min-height: 92px;
        }
    }

    /* ── Binary output scoped styles ─────────────────────────── */

    .des-field-hint {
        display: block;
        margin-top: 4px;
        color: var(--color-muted);
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: 1px;
        line-height: 1.5;
    }

    .des-bin-section {
        margin-top: var(--space-xl);
        padding-top: var(--space-xl);
        border-top: 1px solid var(--color-hairline);
    }

    .des-bin-section-title {
        margin: 0 0 var(--space-lg);
        color: var(--color-muted);
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .des-bin-row {
        display: grid;
        grid-template-columns: minmax(180px, 0.55fr) minmax(0, 1fr);
        gap: var(--space-md);
        padding: var(--space-md) 0;
        border-bottom: 1px solid var(--color-hairline);
        align-items: start;
    }

    .des-bin-row:last-child {
        border-bottom: none;
    }

    .des-bin-label {
        color: var(--color-muted);
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding-top: 2px;
    }

    .des-bin-value {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        align-items: flex-start;
    }

    .des-bin-group {
        display: inline-block;
        color: var(--color-link);
        font-family: var(--font-mono);
        font-size: 12px;
        line-height: 1.6;
        letter-spacing: 1px;
        background: rgba(195, 217, 243, 0.06);
        border: 1px solid rgba(195, 217, 243, 0.12);
        padding: 1px 4px;
        border-radius: 3px;
    }

    .des-bin-group--highlight {
        color: var(--color-cyber);
        background: rgba(124, 255, 178, 0.07);
        border-color: rgba(124, 255, 178, 0.18);
    }

    /* Key schedule table */
    .des-key-table-wrap {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: var(--color-hairline-strong) transparent;
        margin-top: var(--space-lg);
    }

    .des-key-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
        font-family: var(--font-mono);
        font-size: 11px;
    }

    .des-key-table th {
        padding: var(--space-sm) var(--space-md);
        border-bottom: 1px solid var(--color-hairline-strong);
        border-right: 1px solid var(--color-hairline);
        color: var(--color-muted);
        letter-spacing: 1.5px;
        text-transform: uppercase;
        text-align: left;
        white-space: nowrap;
        background: rgba(255,255,255,0.02);
    }

    .des-key-table td {
        padding: var(--space-sm) var(--space-md);
        border-bottom: 1px solid var(--color-hairline);
        border-right: 1px solid var(--color-hairline);
        vertical-align: top;
        line-height: 1.6;
    }

    .des-key-table td:first-child {
        color: var(--color-primary);
        white-space: nowrap;
        font-weight: 600;
        width: 60px;
    }

    .des-key-table td:nth-child(2) {
        color: var(--color-muted);
        width: 50px;
        text-align: center;
    }

    .des-key-table td:nth-child(3),
    .des-key-table td:nth-child(4),
    .des-key-table td:nth-child(5) {
        color: var(--color-link);
        overflow-wrap: anywhere;
        word-break: break-all;
    }

    .des-key-table td:nth-child(5) {
        color: var(--color-cyber);
    }

    /* Round detail collapsible */
    .des-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: var(--space-lg);
        margin-top: var(--space-xl);
    }

    .des-detail-card {
        border: 1px solid var(--color-hairline);
        background: transparent;
    }

    .des-detail-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: var(--space-md) var(--space-lg);
        cursor: pointer;
        user-select: none;
        border-bottom: 1px solid transparent;
        transition: border-color 180ms ease, background 180ms ease;
    }

    .des-detail-header:hover {
        background: rgba(255,255,255,0.03);
    }

    .des-detail-card.is-open .des-detail-header {
        border-bottom-color: var(--color-hairline);
    }

    .des-detail-header-left {
        display: flex;
        align-items: baseline;
        gap: var(--space-sm);
    }

    .des-detail-round-num {
        color: var(--color-primary);
        font-family: var(--font-display);
        font-size: 20px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .des-detail-round-sub {
        color: var(--color-muted);
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .des-detail-toggle {
        color: var(--color-muted);
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        transition: color 180ms ease;
        white-space: nowrap;
    }

    .des-detail-header:hover .des-detail-toggle {
        color: var(--color-primary);
    }

    .des-detail-body {
        display: none;
        padding: var(--space-lg);
    }

    .des-detail-card.is-open .des-detail-body {
        display: block;
    }

    .des-detail-row {
        display: grid;
        grid-template-columns: minmax(140px, 0.5fr) minmax(0, 1fr);
        gap: var(--space-sm);
        padding: var(--space-sm) 0;
        border-bottom: 1px solid var(--color-hairline);
        align-items: start;
    }

    .des-detail-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .des-detail-row-label {
        color: var(--color-muted);
        font-family: var(--font-mono);
        font-size: 10px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding-top: 2px;
    }

    .des-detail-row-value {
        display: flex;
        flex-wrap: wrap;
        gap: 3px;
    }

    @media (max-width: 900px) {
        .des-detail-grid {
            grid-template-columns: 1fr;
        }

        .des-bin-row {
            grid-template-columns: 1fr;
            gap: var(--space-xs);
        }
    }

    /* ── Formula section scoped styles ──────────────────────── */

    .des-formula-card {
        display: flex;
        flex-direction: column;
        gap: var(--space-md);
    }

    .des-formula-desc {
        margin: 0;
        color: var(--color-body);
        font-size: 15px;
        line-height: 1.75;
    }

    .des-formula-symbols {
        margin: 0;
        padding: 0;
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 6px;
        border-top: 1px solid var(--color-hairline);
        padding-top: var(--space-md);
        margin-top: auto;
    }

    .des-formula-symbols li {
        display: flex;
        align-items: baseline;
        gap: var(--space-sm);
        color: var(--color-body);
        font-size: 13px;
        line-height: 1.5;
    }

    .des-formula-symbols li code {
        flex-shrink: 0;
        min-width: 72px;
        color: var(--color-cyber);
        font-family: var(--font-mono);
        font-size: 12px;
        letter-spacing: 0.5px;
    }

    /* Keterangan Simbol */
    .des-formula-legend {
        margin-top: var(--space-xxl);
        padding-top: var(--space-xl);
        border-top: 1px solid var(--color-hairline);
    }

    .des-formula-legend-title {
        margin: 0 0 var(--space-lg);
        color: var(--color-muted);
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .des-formula-legend-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0;
        border-top: 1px solid var(--color-hairline);
        border-left: 1px solid var(--color-hairline);
    }

    .des-symbol-row {
        display: grid;
        grid-template-columns: minmax(80px, 0.28fr) minmax(0, 1fr);
        gap: var(--space-md);
        padding: var(--space-md) var(--space-lg);
        border-right: 1px solid var(--color-hairline);
        border-bottom: 1px solid var(--color-hairline);
        align-items: baseline;
    }

    .des-symbol-row code {
        color: var(--color-cyber);
        font-family: var(--font-mono);
        font-size: 13px;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .des-symbol-row span {
        color: var(--color-body);
        font-size: 14px;
        line-height: 1.55;
    }

    /* Alur Singkat Operasi Round */
    .des-round-flow-wrap {
        margin-top: var(--space-xxl);
        padding-top: var(--space-xl);
        border-top: 1px solid var(--color-hairline);
    }

    .des-round-flow-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: var(--space-lg);
        margin-top: var(--space-lg);
    }

    .des-round-flow-step {
        display: flex;
        flex-direction: column;
        gap: var(--space-md);
        padding: var(--space-lg);
        border: 1px solid var(--color-hairline);
    }

    .des-round-flow-num {
        display: block;
        color: var(--color-cyber);
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: 2px;
    }

    .des-round-flow-step strong {
        display: block;
        color: var(--color-primary);
        font-family: var(--font-display);
        font-size: 18px;
        font-weight: 400;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .des-round-flow-step p {
        margin: 0;
        color: var(--color-body);
        font-size: 14px;
        line-height: 1.7;
    }

    @media (max-width: 1080px) {
        .des-formula-legend-grid {
            grid-template-columns: 1fr;
        }

        .des-round-flow-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .des-round-flow-grid {
            grid-template-columns: 1fr;
        }

        .des-symbol-row {
            grid-template-columns: minmax(70px, 0.32fr) minmax(0, 1fr);
            gap: var(--space-sm);
            padding: var(--space-sm) var(--space-md);
        }
    }
</style>

@php
    $encryptPlaintext = old('plaintext', $desResult['plaintext'] ?? 'SURABAYA');
    $encryptKey = old('key', $desResult['key'] ?? 'UKMC2026');
    $decryptCiphertextBinary = old('ciphertext_binary', $desResult['ciphertext_binary'] ?? '');
@endphp

<div class="des-page">
<section class="algorithm-hero">
    <div class="container">
        <div class="algorithm-hero-content">
            <p class="caption">ALGORITHM MODULE 03</p>
            <h1>DES ALGORITHM</h1>
            <p class="algorithm-hero-text">
                DES adalah algoritma kriptografi simetris berbasis block cipher. Data diproses dalam blok 64-bit, memakai effective key 56-bit, dan melalui 16 Feistel round untuk menghasilkan ciphertext.
            </p>

            <div class="hero-actions">
                <a href="#des-simulation" class="button-primary">START SIMULATION</a>
                <a href="#des-game" class="button-secondary">PLAY DES GAME</a>
            </div>
        </div>

        <div class="algorithm-meta-grid">
            <div class="algorithm-meta-item">
                <span>Kategori</span>
                <strong>Symmetric Block Cipher</strong>
            </div>

            <div class="algorithm-meta-item">
                <span>Block Size</span>
                <strong>64-bit</strong>
            </div>

            <div class="algorithm-meta-item">
                <span>Effective Key</span>
                <strong>56-bit</strong>
            </div>

            <div class="algorithm-meta-item">
                <span>Round</span>
                <strong>16 Feistel</strong>
            </div>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container algorithm-grid-2">
        <div>
            <p class="caption">HISTORY</p>
            <h2>SEJARAH SINGKAT DES</h2>
        </div>

        <div class="text-block">
            <p>
                DES pernah menjadi standar penting dalam kriptografi simetris. Algoritma ini banyak dipelajari karena memperkenalkan konsep block cipher, Feistel Network, key schedule, permutasi, substitusi, dan penggunaan subkey pada setiap round.
            </p>
            <p>
                Walaupun ukuran kunci DES sudah tidak cukup aman untuk kebutuhan modern, alurnya tetap penting sebagai dasar untuk memahami algoritma block cipher lain seperti Triple DES dan beberapa konsep yang juga muncul pada algoritma modern.
            </p>
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">CORE CONCEPT</p>
                <h2>APA ITU DES?</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            <article class="concept-card">
                <span>01</span>
                <h3>SYMMETRIC KEY</h3>
                <p>DES memakai kunci yang sama untuk enkripsi dan dekripsi.</p>
            </article>

            <article class="concept-card">
                <span>02</span>
                <h3>BLOCK CIPHER</h3>
                <p>Plaintext diproses dalam blok 64-bit sehingga cocok untuk menjelaskan kriptografi blok.</p>
            </article>

            <article class="concept-card">
                <span>03</span>
                <h3>FEISTEL NETWORK</h3>
                <p>Setiap round membagi data menjadi sisi kiri dan kanan lalu menukar hasil pemrosesan.</p>
            </article>

            <article class="concept-card">
                <span>04</span>
                <h3>KEY SCHEDULE</h3>
                <p>Key utama diproses menjadi 16 subkey yang digunakan pada 16 round.</p>
            </article>

            <article class="concept-card">
                <span>05</span>
                <h3>S-BOX</h3>
                <p>S-Box mengubah input 48-bit hasil XOR menjadi output 32-bit.</p>
            </article>

            <article class="concept-card">
                <span>06</span>
                <h3>PERMUTATION</h3>
                <p>DES memakai beberapa permutasi seperti IP, FP, PC-1, PC-2, E, dan P-Box.</p>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">COMPARISON</p>
                <h2>DES BERBEDA DARI HASH DAN RSA</h2>
            </div>
        </div>

        <div class="des-compare-grid">
            <article class="des-compare-card algorithm-card">
                <span>Hash</span>
                <h3>One-Way Function</h3>
                <div class="des-compare-pair">
                    <div><strong>Kunci</strong><p>Tidak memakai key.</p></div>
                    <div><strong>Dekripsi</strong><p>Tidak bisa didekripsi.</p></div>
                    <div><strong>Tujuan</strong><p>Menjaga integritas data.</p></div>
                </div>
            </article>

            <article class="des-compare-card algorithm-card">
                <span>RSA</span>
                <h3>Asymmetric Cryptography</h3>
                <div class="des-compare-pair">
                    <div><strong>Kunci</strong><p>Memakai public key dan private key.</p></div>
                    <div><strong>Dekripsi</strong><p>Bisa dengan private key.</p></div>
                    <div><strong>Tujuan</strong><p>Kerahasiaan dan tanda tangan digital.</p></div>
                </div>
            </article>

            <article class="des-compare-card algorithm-card">
                <span>DES</span>
                <h3>Symmetric Block Cipher</h3>
                <div class="des-compare-pair">
                    <div><strong>Kunci</strong><p>Memakai satu secret key.</p></div>
                    <div><strong>Dekripsi</strong><p>Bisa dengan key yang sama.</p></div>
                    <div><strong>Tujuan</strong><p>Menjaga kerahasiaan data.</p></div>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">HOW IT WORKS</p>
                <h2>CARA KERJA DES</h2>
            </div>
        </div>

        <div class="algorithm-flow">
            <article class="algorithm-flow-item">
                <span>Step 01</span>
                <strong>Plaintext 64-bit</strong>
                <p>Input teks dikonversi ke biner 64-bit.</p>
            </article>

            <article class="algorithm-flow-item">
                <span>Step 02</span>
                <strong>Initial Permutation</strong>
                <p>Bit plaintext diacak berdasarkan tabel IP.</p>
            </article>

            <article class="algorithm-flow-item">
                <span>Step 03</span>
                <strong>Feistel Round</strong>
                <p>Data dibagi menjadi L dan R lalu diproses sebanyak 16 round.</p>
            </article>

            <article class="algorithm-flow-item">
                <span>Step 04</span>
                <strong>Final Permutation</strong>
                <p>Hasil akhir round dipermutasi menjadi ciphertext.</p>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">KEY SCHEDULE</p>
                <h2>PEMBENTUKAN SUBKEY DES</h2>
            </div>
        </div>

        <div class="algorithm-flow">
            <article class="algorithm-flow-item">
                <span>01</span>
                <strong>Key 64-bit</strong>
                <p>Key awal terdiri dari 8 karakter atau 64-bit.</p>
            </article>

            <article class="algorithm-flow-item">
                <span>02</span>
                <strong>PC-1</strong>
                <p>Parity bit dihilangkan sehingga tersisa effective key 56-bit.</p>
            </article>

            <article class="algorithm-flow-item">
                <span>03</span>
                <strong>C0 dan D0</strong>
                <p>Key 56-bit dibagi menjadi dua bagian 28-bit.</p>
            </article>

            <article class="algorithm-flow-item">
                <span>04</span>
                <strong>PC-2</strong>
                <p>Setiap round menghasilkan subkey 48-bit.</p>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">FORMULA</p>
                <h2>RUMUS DAN OPERASI INTI DES</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">

            {{-- Formula 01 — Feistel Left --}}
            <article class="formula-card des-formula-card">
                <span>Formula 01</span>
                <h3>FEISTEL LEFT</h3>
                <code class="algorithm-code-output">Lᵢ = Rᵢ₋₁</code>
                <p class="des-formula-desc">
                    Pada setiap round DES, bagian kiri baru (Lᵢ) diambil langsung dari bagian kanan pada round sebelumnya (Rᵢ₋₁). Proses ini menunjukkan pola pertukaran pada jaringan Feistel, sehingga data kanan sebelumnya menjadi data kiri untuk round berikutnya.
                </p>
                <ul class="des-formula-symbols">
                    <li><code>Lᵢ</code> — blok kiri pada round ke-i (32 bit)</li>
                    <li><code>Rᵢ₋₁</code> — blok kanan dari round sebelumnya</li>
                </ul>
            </article>

            {{-- Formula 02 — Feistel Right --}}
            <article class="formula-card des-formula-card">
                <span>Formula 02</span>
                <h3>FEISTEL RIGHT</h3>
                <code class="algorithm-code-output">Rᵢ = Lᵢ₋₁ XOR F(Rᵢ₋₁, Kᵢ)</code>
                <p class="des-formula-desc">
                    Bagian kanan baru (Rᵢ) dihitung dengan melakukan operasi XOR antara Lᵢ₋₁ dan hasil fungsi F. Fungsi F memproses Rᵢ₋₁ menggunakan subkey Kᵢ. Karena setiap round memakai subkey berbeda, hasil perubahan data pada setiap round juga berbeda.
                </p>
                <ul class="des-formula-symbols">
                    <li><code>Rᵢ</code> — blok kanan pada round ke-i (32 bit)</li>
                    <li><code>Lᵢ₋₁</code> — blok kiri dari round sebelumnya</li>
                    <li><code>Kᵢ</code> — subkey DES pada round ke-i (48 bit)</li>
                    <li><code>XOR</code> — operasi biner, hasilkan 1 jika bit berbeda</li>
                </ul>
            </article>

            {{-- Formula 03 — Round Function --}}
            <article class="formula-card des-formula-card">
                <span>Formula 03</span>
                <h3>ROUND FUNCTION</h3>
                <code class="algorithm-code-output">F(R, K) = P(S(E(R) XOR K))</code>
                <p class="des-formula-desc">
                    Fungsi F dimulai dengan ekspansi E(R), yaitu memperluas blok kanan dari 32 bit menjadi 48 bit. Hasil ekspansi di-XOR dengan subkey K. Setelah itu, S-Box mengubah 48 bit menjadi 32 bit. Hasilnya diproses oleh P-Box sebelum digunakan pada perhitungan Rᵢ.
                </p>
                <ul class="des-formula-symbols">
                    <li><code>E(R)</code> — ekspansi 32 bit → 48 bit</li>
                    <li><code>S</code> — S-Box, 48 bit → 32 bit</li>
                    <li><code>P</code> — P-Box, permutasi posisi bit</li>
                    <li><code>K</code> — subkey 48 bit pada round ke-i</li>
                </ul>
            </article>

        </div>

        {{-- Keterangan Simbol --}}
        <div class="des-formula-legend">
            <p class="des-formula-legend-title">KETERANGAN SIMBOL</p>
            <div class="des-formula-legend-grid">
                <div class="des-symbol-row"><code>i</code><span>Nomor round, dari 1 sampai 16</span></div>
                <div class="des-symbol-row"><code>Lᵢ</code><span>Blok kiri pada round ke-i — 32 bit</span></div>
                <div class="des-symbol-row"><code>Rᵢ</code><span>Blok kanan pada round ke-i — 32 bit</span></div>
                <div class="des-symbol-row"><code>Lᵢ₋₁</code><span>Blok kiri dari round sebelumnya</span></div>
                <div class="des-symbol-row"><code>Rᵢ₋₁</code><span>Blok kanan dari round sebelumnya</span></div>
                <div class="des-symbol-row"><code>Kᵢ</code><span>Subkey DES pada round ke-i — 48 bit</span></div>
                <div class="des-symbol-row"><code>E(R)</code><span>Ekspansi blok kanan dari 32 bit menjadi 48 bit</span></div>
                <div class="des-symbol-row"><code>S</code><span>Proses S-Box — mengubah 48 bit menjadi 32 bit</span></div>
                <div class="des-symbol-row"><code>P</code><span>Permutasi P-Box — mengatur ulang posisi bit (32 bit)</span></div>
                <div class="des-symbol-row"><code>XOR</code><span>Operasi biner — menghasilkan 1 jika kedua bit berbeda</span></div>
            </div>
        </div>

        {{-- Alur Singkat Operasi Round --}}
        <div class="des-round-flow-wrap">
            <p class="des-formula-legend-title">ALUR SINGKAT OPERASI ROUND</p>
            <div class="des-round-flow-grid">
                <div class="des-round-flow-step">
                    <span class="des-round-flow-num">01</span>
                    <div>
                        <strong>Ekspansi E</strong>
                        <p>Rᵢ₋₁ diekspansi dari 32 bit menjadi 48 bit menggunakan tabel E.</p>
                    </div>
                </div>
                <div class="des-round-flow-step">
                    <span class="des-round-flow-num">02</span>
                    <div>
                        <strong>XOR Subkey</strong>
                        <p>Hasil ekspansi di-XOR dengan subkey Kᵢ (48 bit). Setiap round memakai subkey berbeda.</p>
                    </div>
                </div>
                <div class="des-round-flow-step">
                    <span class="des-round-flow-num">03</span>
                    <div>
                        <strong>S-Box</strong>
                        <p>S-Box mengubah hasil XOR dari 48 bit menjadi 32 bit melalui 8 tabel substitusi.</p>
                    </div>
                </div>
                <div class="des-round-flow-step">
                    <span class="des-round-flow-num">04</span>
                    <div>
                        <strong>P-Box → Rᵢ</strong>
                        <p>Hasil P-Box di-XOR dengan Lᵢ₋₁ untuk membentuk Rᵢ pada round berikutnya.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="algorithm-section" id="des-simulation">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">SIMULATION</p>
                <h2>ENCRYPT & DECRYPT DES</h2>
            </div>
        </div>

        <div class="des-simulation-grid">
            <form class="algorithm-form-panel" action="{{ route('des.process') }}" method="POST" data-des-form="encrypt">
                @csrf
                <input type="hidden" name="mode" value="encrypt">

                <p class="caption">ENCRYPT MODE</p>
                <h3>PLAINTEXT TO CIPHERTEXT</h3>

                <div class="algorithm-form-group">
                    <label for="des_plaintext">Plaintext Maksimal 8 Karakter</label>
                    <input id="des_plaintext" type="text" name="plaintext" class="algorithm-input" value="{{ $encryptPlaintext }}" maxlength="8" placeholder="SURABAYA">
                    <div class="des-error" data-form-error="plaintext"></div>
                </div>

                <div class="algorithm-form-group">
                    <label for="des_encrypt_key">Key Tepat 8 Karakter</label>
                    <input id="des_encrypt_key" type="text" name="key" class="algorithm-input" value="{{ $encryptKey }}" maxlength="8" placeholder="UKMC2026">
                    <div class="des-error" data-form-error="key"></div>
                </div>

                <div class="algorithm-button-row">
                    <button type="submit" class="button-primary" data-default-text="ENCRYPT DES">ENCRYPT DES</button>
                    <button type="button" class="button-secondary" data-des-reset>RESET</button>
                </div>

                <div class="des-feedback" data-form-feedback></div>
            </form>

            <form class="algorithm-form-panel" action="{{ route('des.process') }}" method="POST" data-des-form="decrypt">
                @csrf
                <input type="hidden" name="mode" value="decrypt">

                <p class="caption">DECRYPT MODE</p>
                <h3>CIPHERTEXT TO PLAINTEXT</h3>

                <div class="algorithm-form-group">
                    <label for="des_ciphertext_binary">Ciphertext Binary 64 Bit</label>
                    <input id="des_ciphertext_binary" type="text" name="ciphertext_binary" class="algorithm-input" value="{{ $decryptCiphertextBinary }}" maxlength="64" placeholder="0101010101100101010011000100110001011110001010100111000010010001">
                    <small class="des-field-hint">Masukkan ciphertext hasil enkripsi DES dalam bentuk biner 64 bit.</small>
                    <div class="des-error" data-form-error="ciphertext_binary"></div>
                </div>

                <div class="algorithm-form-group">
                    <label for="des_decrypt_key">Key Tepat 8 Karakter</label>
                    <input id="des_decrypt_key" type="text" name="key" class="algorithm-input" value="{{ $encryptKey }}" maxlength="8" placeholder="UKMC2026">
                    <div class="des-error" data-form-error="key"></div>
                </div>

                <div class="algorithm-button-row">
                    <button type="submit" class="button-primary" data-default-text="DECRYPT DES">DECRYPT DES</button>
                </div>

                <div class="des-feedback" data-form-feedback></div>
            </form>
        </div>

        <div data-des-result-area></div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">REAL WORLD USE</p>
                <h2>PENGAPLIKASIAN DES</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            <article class="application-card">
                <span>01</span>
                <h3>CRYPTOSYSTEM LEARNING</h3>
                <p>DES membantu memahami dasar enkripsi blok dan operasi bitwise.</p>
            </article>

            <article class="application-card">
                <span>02</span>
                <h3>FEISTEL STUDY</h3>
                <p>DES menjadi contoh populer untuk mempelajari Feistel Network.</p>
            </article>

            <article class="application-card">
                <span>03</span>
                <h3>LEGACY SYSTEM</h3>
                <p>DES pernah digunakan pada sistem lama sehingga penting untuk dipahami secara historis.</p>
            </article>

            <article class="application-card">
                <span>04</span>
                <h3>3DES FOUNDATION</h3>
                <p>Triple DES dikembangkan dari prinsip dasar DES.</p>
            </article>

            <article class="application-card">
                <span>05</span>
                <h3>SUBSTITUTION</h3>
                <p>S-Box DES dapat digunakan untuk memahami substitusi pada kriptografi.</p>
            </article>

            <article class="application-card">
                <span>06</span>
                <h3>SECURITY COMPARISON</h3>
                <p>DES dapat dibandingkan dengan RSA, Hash, GOST, dan algoritma modern.</p>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section" id="des-game">
    <div class="container algorithm-grid-2">
        <div>
            <p class="caption">MINI GAME</p>
            <h2>DES FLOW BUILDER</h2>
            <p class="algorithm-hero-text" style="margin-left:0;">
                Susun urutan proses DES dengan benar. Game ini dibuat ringan agar pengguna memahami alur DES tanpa harus menghitung seluruh tabel permutasi secara manual.
            </p>
        </div>

        <div class="algorithm-game-panel" data-des-game>
            <p class="caption">CHALLENGE</p>
            <h3 data-game-title>DES FLOW</h3>

            <div class="des-game-board">
                <div class="des-mini-panel algorithm-card">
                    <span>Prompt</span>
                    <p data-game-prompt></p>
                </div>

                <div class="des-mini-panel algorithm-card">
                    <span>Hint</span>
                    <p data-game-hint></p>
                </div>

                <div class="des-game-selected algorithm-card">
                    <span>Selected Sequence</span>
                    <div class="des-game-sequence" data-game-sequence></div>
                </div>
            </div>

            <div class="des-game-option-grid" data-game-options></div>

            <div class="algorithm-button-row">
                <button type="button" class="button-secondary" data-game-reset>RESET ROUND</button>
                <button type="button" class="button-secondary" data-game-next>NEXT CHALLENGE</button>
            </div>

            <div class="des-game-feedback" data-game-feedback></div>
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">LIMITATION</p>
                <h2>BATASAN HALAMAN DES</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            <article class="concept-card">
                <span>01</span>
                <h3>DEMO ONLY</h3>
                <p>Halaman ini dibuat untuk pembelajaran, bukan sistem keamanan produksi.</p>
            </article>

            <article class="concept-card">
                <span>02</span>
                <h3>SMALL BLOCK</h3>
                <p>Simulasi memakai satu blok 64-bit agar proses mudah dipahami.</p>
            </article>

            <article class="concept-card">
                <span>03</span>
                <h3>KEY SIZE</h3>
                <p>Effective key DES adalah 56-bit sehingga tidak aman untuk kebutuhan modern.</p>
            </article>

            <article class="concept-card">
                <span>04</span>
                <h3>ASCII INPUT</h3>
                <p>Input simulasi dibatasi pada karakter ASCII yang dapat ditampilkan.</p>
            </article>

            <article class="concept-card">
                <span>05</span>
                <h3>SIMPLE PADDING</h3>
                <p>Jika plaintext kurang dari 8 karakter, sistem menambahkan null padding untuk demonstrasi.</p>
            </article>

            <article class="concept-card">
                <span>06</span>
                <h3>NO MODE OPERATION</h3>
                <p>Halaman ini fokus pada DES dasar, bukan CBC, CFB, OFB, atau CTR.</p>
            </article>
        </div>
    </div>
</section>

</div>

<script>
    // ── DES scoped script ─────────────────────────────────────────────────────
    const desChallenges = @json($gameChallenges);
    const desForms      = document.querySelectorAll('[data-des-form]');
    const desResultArea = document.querySelector('[data-des-result-area]');
    const desResetButton = document.querySelector('[data-des-reset]');

    desForms.forEach((form) => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            await submitDesForm(form);
        });
    });

    if (desResetButton) {
        desResetButton.addEventListener('click', () => {
            const encryptForm = document.querySelector('[data-des-form="encrypt"]');
            const decryptForm = document.querySelector('[data-des-form="decrypt"]');

            if (encryptForm) {
                encryptForm.querySelector('[name="plaintext"]').value = 'SURABAYA';
                encryptForm.querySelector('[name="key"]').value = 'UKMC2026';
            }

            if (decryptForm) {
                decryptForm.querySelector('[name="ciphertext_binary"]').value = '';
                decryptForm.querySelector('[name="key"]').value = 'UKMC2026';
            }

            clearDesErrors();
            clearDesFeedback();

            if (desResultArea) {
                desResultArea.innerHTML = '';
            }
        });
    }

    document.addEventListener('click', async (event) => {
        const copyButton = event.target.closest('[data-copy-value]');
        const useDecryptButton = event.target.closest('[data-use-des-decrypt]');

        if (copyButton) {
            const target = document.querySelector(copyButton.dataset.copyValue);
            const feedback = copyButton.parentElement.querySelector('[data-copy-feedback]');

            if (!target) {
                return;
            }

            try {
                await navigator.clipboard.writeText(target.textContent.trim());
                if (feedback) feedback.textContent = 'COPIED';
            } catch (error) {
                if (feedback) feedback.textContent = 'COPY FAILED';
            }

            window.setTimeout(() => {
                if (feedback) feedback.textContent = '';
            }, 1600);
        }

        if (useDecryptButton) {
            const decryptForm = document.querySelector('[data-des-form="decrypt"]');
            const ciphertextInput = document.querySelector('#des_ciphertext_binary');
            const keyInput = document.querySelector('#des_decrypt_key');

            if (decryptForm && ciphertextInput && keyInput) {
                ciphertextInput.value = useDecryptButton.dataset.ciphertext;
                keyInput.value = useDecryptButton.dataset.key;
                decryptForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    });

    async function submitDesForm(form) {
        const submitButton = form.querySelector('[type="submit"]');
        const feedback = form.querySelector('[data-form-feedback]');
        const defaultText = submitButton?.dataset.defaultText || submitButton?.textContent || 'PROCESS';

        clearDesFormErrors(form);

        if (submitButton) {
            submitButton.disabled = true;
            submitButton.textContent = 'PROCESSING...';
        }

        if (feedback) {
            feedback.textContent = 'PROCESSING REQUEST...';
        }

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new FormData(form)
            });

            const data = await response.json();

            if (!response.ok) {
                if (response.status === 422 && data.errors) {
                    showDesErrors(form, data.errors);
                    if (feedback) feedback.textContent = data.message || 'CHECK INPUT FIELD.';
                    return;
                }

                throw new Error(data.message || 'Request failed.');
            }

            renderDesResult(data.desResult);

            if (feedback) {
                feedback.textContent = data.mode === 'encrypt' ? 'DES ENCRYPTED WITHOUT PAGE REFRESH.' : 'DES DECRYPTED WITHOUT PAGE REFRESH.';
            }

            desResultArea?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        } catch (error) {
            if (feedback) {
                feedback.textContent = 'REQUEST FAILED. CHECK INPUT.';
            }
        } finally {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = defaultText;
            }
        }
    }

    function renderDesResult(result) {
        if (!desResultArea) { return; }

        const isEncrypt  = result.mode === 'encrypt';
        const outputBin  = isEncrypt ? result.ciphertext_binary : result.plaintext_binary;
        const outputId   = isEncrypt ? 'des-cipher-bin-output' : 'des-plain-bin-output';

        // ── 1. Ringkasan Proses ─────────────────────────────────────────────
        const summaryRows = isEncrypt
            ? [
                ['Mode',                     result.mode_label,                   false],
                ['Plaintext',                result.plaintext,                    false],
                ['Padded Plaintext',         result.padded_plaintext,             false],
                ['Key',                      result.key,                          false],
                ['Plaintext Binary (64-bit)',   result.plaintext_binary,          true, 8],
                ['Key Binary (64-bit)',         result.key_binary,                true, 8],
                ['Initial Permutation (64-bit)',result.initial_permutation_binary,true, 8],
                ['Final Swap (64-bit)',         result.final_swap_binary,         true, 8],
                ['Ciphertext Binary (64-bit)',  outputBin,                        true, 8, outputId],
              ]
            : [
                ['Mode',                     result.mode_label,                   false],
                ['Key',                      result.key,                          false],
                ['Ciphertext Binary (64-bit)', result.ciphertext_binary,          true, 8],
                ['Key Binary (64-bit)',        result.key_binary,                 true, 8],
                ['Initial Permutation (64-bit)',result.initial_permutation_binary,true, 8],
                ['Final Swap (64-bit)',         result.final_swap_binary,         true, 8],
                ['Plaintext Binary (64-bit)',   outputBin,                        true, 8, outputId],
                ['Plaintext Result',          result.plaintext || '[EMPTY]',      false],
              ];

        const summaryHtml = summaryRows.map(([lbl, val, isBin, grp, id]) => {
            const inner = isBin
                ? desBinGroups(val, grp || 8, id)
                : `<span style="color:var(--color-body);font-family:var(--font-mono);font-size:13px;">${escapeHtml(String(val))}</span>`;
            return `<div class="des-bin-row">
                        <span class="des-bin-label">${escapeHtml(lbl)}</span>
                        <div class="des-bin-value">${inner}</div>
                    </div>`;
        }).join('');

        // ── 2. Key Schedule K1–K16 ──────────────────────────────────────────
        const scheduleRows = result.subkeys.map(sk => `
            <tr>
                <td>K${sk.round}</td>
                <td>${sk.shift}</td>
                <td>${desBinGroupsRaw(sk.c_binary, 4)}</td>
                <td>${desBinGroupsRaw(sk.d_binary, 4)}</td>
                <td>${desBinGroupsRaw(sk.subkey_binary, 6)}</td>
            </tr>`).join('');

        const scheduleHtml = `
            <div class="des-key-table-wrap">
                <table class="des-key-table">
                    <thead>
                        <tr>
                            <th>Round</th>
                            <th>Shift</th>
                            <th>C (28-bit)</th>
                            <th>D (28-bit)</th>
                            <th>Subkey K (48-bit)</th>
                        </tr>
                    </thead>
                    <tbody>${scheduleRows}</tbody>
                </table>
            </div>`;

        // ── 3. 16 Round Detail (collapsible) ────────────────────────────────
        const roundCards = result.rounds.map(r => {
            const cardId = `des-round-card-${r.round}`;
            const detailRows = [
                ['L (32-bit)',        r.left_binary,      8],
                ['R (32-bit)',        r.right_binary,     8],
                ['Expansion E (48-bit)', r.expansion_binary, 6],
                ['Subkey K (48-bit)', r.subkey_binary,    6],
                ['XOR Result (48-bit)',  r.after_xor_binary, 6],
                ['S-Box Out (32-bit)', r.sbox_output_binary, 4],
                ['P-Box / F (32-bit)', r.pbox_binary,     4],
            ].map(([lbl, val, grp]) => `
                <div class="des-detail-row">
                    <span class="des-detail-row-label">${escapeHtml(lbl)}</span>
                    <div class="des-detail-row-value">${desBinGroupsRaw(val, grp)}</div>
                </div>`).join('');

            return `
                <div class="des-detail-card algorithm-card" id="${cardId}">
                    <div class="des-detail-header" onclick="desDetailToggle('${cardId}')">
                        <div class="des-detail-header-left">
                            <span class="des-detail-round-num">Round ${r.round}</span>
                            <span class="des-detail-round-sub">K${r.round}: ${escapeHtml(r.subkey_binary.slice(0,12))}…</span>
                        </div>
                        <span class="des-detail-toggle">EXPAND ▼</span>
                    </div>
                    <div class="des-detail-body">${detailRows}</div>
                </div>`;
        }).join('');

        // ── Assemble full output panel ───────────────────────────────────────
        desResultArea.innerHTML = `
            <div class="algorithm-output-panel" style="margin-top:var(--space-xl);">
                <p class="caption">DES OUTPUT</p>
                <h3>${escapeHtml(result.mode_label)}</h3>

                <div class="des-bin-section">
                    <p class="des-bin-section-title">Ringkasan Proses</p>
                    ${summaryHtml}
                </div>

                <div class="des-output-actions" style="margin-top:var(--space-xl);">
                    <button type="button" class="button-secondary" data-des-copy-id="${outputId}">
                        COPY ${isEncrypt ? 'CIPHERTEXT BINARY' : 'PLAINTEXT BINARY'}
                    </button>
                    ${isEncrypt ? `
                        <button type="button" class="button-secondary"
                            data-use-des-decrypt
                            data-ciphertext="${escapeHtml(result.ciphertext_binary)}"
                            data-key="${escapeHtml(result.key)}">
                            USE FOR DECRYPT
                        </button>` : ''}
                </div>

                <div class="des-feedback" data-copy-feedback style="margin-top:var(--space-sm);"></div>

                <p class="algorithm-note" style="margin-top:var(--space-lg);">${escapeHtml(result.note)}</p>

                <div class="des-bin-section">
                    <p class="des-bin-section-title">Key Schedule K1 – K16</p>
                    ${scheduleHtml}
                </div>

                <div class="des-bin-section">
                    <p class="des-bin-section-title">16 Feistel Rounds — Klik round untuk expand detail</p>
                    <div class="des-detail-grid">${roundCards}</div>
                </div>
            </div>`;

        // copy button handler (scoped, untuk tombol yang baru dirender)
        const copyBtn = desResultArea.querySelector('[data-des-copy-id]');
        if (copyBtn) {
            copyBtn.addEventListener('click', async () => {
                const targetId  = copyBtn.dataset.desCopyId;
                const targetEl  = desResultArea.querySelector('#' + targetId);
                const feedbackEl = desResultArea.querySelector('[data-copy-feedback]');
                if (!targetEl) return;
                try {
                    // ambil hanya teks (hapus spasi antar grup)
                    const raw = targetEl.querySelectorAll('.des-bin-group');
                    const bits = Array.from(raw).map(el => el.textContent.trim()).join('');
                    await navigator.clipboard.writeText(bits);
                    if (feedbackEl) feedbackEl.textContent = 'COPIED';
                } catch {
                    if (feedbackEl) feedbackEl.textContent = 'COPY FAILED';
                }
                window.setTimeout(() => { if (feedbackEl) feedbackEl.textContent = ''; }, 1600);
            });
        }

        requestAnimationFrame(() => {
            if (typeof initCyberCards === 'function') { initCyberCards(); }
        });
    }

    // ── Binary formatting helpers ─────────────────────────────────────────────

    /**
     * Render bit string sebagai span group, dengan optional id pada wrapper.
     * Highlight = warna cyber untuk output utama.
     */
    function desBinGroups(bits, groupSize, wrapperId) {
        if (!bits) return '<span style="color:var(--color-muted)">—</span>';
        const attrs = wrapperId ? ` id="${wrapperId}"` : '';
        const isHighlight = !!wrapperId;
        const cls = isHighlight ? 'des-bin-group des-bin-group--highlight' : 'des-bin-group';
        let html = `<span class="des-bin-value"${attrs}>`;
        for (let i = 0; i < bits.length; i += groupSize) {
            html += `<span class="${cls}">${escapeHtml(bits.slice(i, i + groupSize))}</span>`;
        }
        html += '</span>';
        return html;
    }

    /** Sama tapi tanpa wrapper span — untuk dipakai di dalam cell tabel / detail row. */
    function desBinGroupsRaw(bits, groupSize) {
        if (!bits) return '<span style="color:var(--color-muted)">—</span>';
        let html = '';
        for (let i = 0; i < bits.length; i += groupSize) {
            html += `<span class="des-bin-group">${escapeHtml(bits.slice(i, i + groupSize))}</span>`;
        }
        return html;
    }

    // ── Toggle round detail ───────────────────────────────────────────────────
    function desDetailToggle(cardId) {
        const card   = document.getElementById(cardId);
        if (!card) return;
        const isOpen = card.classList.toggle('is-open');
        const toggle = card.querySelector('.des-detail-toggle');
        if (toggle) toggle.textContent = isOpen ? 'COLLAPSE ▲' : 'EXPAND ▼';
    }

    function showDesErrors(form, errors) {
        Object.entries(errors).forEach(([field, messages]) => {
            const target = form.querySelector(`[data-form-error="${field}"]`);
            if (target) target.textContent = messages[0];
        });

        if (errors.des) {
            const feedback = form.querySelector('[data-form-feedback]');
            if (feedback) feedback.textContent = errors.des[0];
        }
    }

    function clearDesFormErrors(form) {
        form.querySelectorAll('[data-form-error]').forEach((element) => element.textContent = '');
    }

    function clearDesErrors() {
        document.querySelectorAll('[data-form-error]').forEach((element) => element.textContent = '');
    }

    function clearDesFeedback() {
        document.querySelectorAll('[data-form-feedback]').forEach((element) => element.textContent = '');
    }

    function escapeHtml(value) {
        return String(value)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    function shuffleArray(items) {
        const clonedItems = [...items];
        for (let index = clonedItems.length - 1; index > 0; index -= 1) {
            const randomIndex = Math.floor(Math.random() * (index + 1));
            [clonedItems[index], clonedItems[randomIndex]] = [clonedItems[randomIndex], clonedItems[index]];
        }
        return clonedItems;
    }

    const desGame = document.querySelector('[data-des-game]');

    if (desGame && desChallenges.length > 0) {
        initDesGame();
    }

    function initDesGame() {
        const title = desGame.querySelector('[data-game-title]');
        const prompt = desGame.querySelector('[data-game-prompt]');
        const hint = desGame.querySelector('[data-game-hint]');
        const sequence = desGame.querySelector('[data-game-sequence]');
        const optionContainer = desGame.querySelector('[data-game-options]');
        const feedback = desGame.querySelector('[data-game-feedback]');
        const resetButton = desGame.querySelector('[data-game-reset]');
        const nextButton = desGame.querySelector('[data-game-next]');

        let queue = shuffleArray(desChallenges);
        let currentChallenge = null;
        let selected = [];
        let locked = false;

        function nextChallenge() {
            if (queue.length === 0) {
                queue = shuffleArray(desChallenges);
            }

            currentChallenge = queue.shift();
            selected = [];
            locked = false;

            title.textContent = currentChallenge.title;
            prompt.textContent = currentChallenge.prompt;
            hint.textContent = currentChallenge.hint;
            feedback.textContent = '';
            renderSequence();

            optionContainer.innerHTML = shuffleArray(currentChallenge.options).map((option) => `
                <button type="button" class="des-game-option game-candidate-card" data-game-option="${escapeHtml(option)}">
                    ${escapeHtml(option)}
                </button>
            `).join('');

            requestAnimationFrame(() => {
                if (typeof initCyberCards === 'function') {
                    initCyberCards();
                }
            });
        }

        function renderSequence() {
            sequence.innerHTML = selected.length
                ? selected.map((item, index) => `<code>${index + 1}. ${escapeHtml(item)}</code>`).join('')
                : '<code>Belum ada pilihan</code>';
        }

        optionContainer.addEventListener('click', (event) => {
            const button = event.target.closest('[data-game-option]');
            if (!button || locked) return;

            const value = button.dataset.gameOption;
            const expected = currentChallenge.answer[selected.length];

            if (value !== expected) {
                locked = true;
                feedback.textContent = `WRONG STEP. EXPECTED: ${expected}. LOADING NEW CHALLENGE...`;
                window.setTimeout(nextChallenge, 1500);
                return;
            }

            selected.push(value);
            button.classList.add('is-disabled');
            renderSequence();

            if (selected.length === currentChallenge.answer.length) {
                locked = true;
                feedback.textContent = 'CORRECT SEQUENCE. LOADING NEXT CHALLENGE...';
                window.setTimeout(nextChallenge, 1400);
            } else {
                feedback.textContent = 'CORRECT STEP. CONTINUE THE SEQUENCE.';
            }
        });

        resetButton?.addEventListener('click', () => {
            selected = [];
            locked = false;
            feedback.textContent = 'ROUND RESET.';
            renderSequence();
            optionContainer.querySelectorAll('[data-game-option]').forEach((button) => button.classList.remove('is-disabled'));
        });

        nextButton?.addEventListener('click', nextChallenge);

        nextChallenge();
    }
</script>
@endsection
