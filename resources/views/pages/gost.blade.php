@extends('layouts.app')

@section('title', 'Crypto Lab | GOST Algorithm')

@section('content')
<style>
    .gost-page {
        --gost-pad: clamp(22px, 2.4vw, 34px);
    }

    .gost-page * {
        min-width: 0;
    }

    .gost-compare-grid,
    .gost-simulation-grid,
    .gost-round-grid,
    .gost-subkey-grid,
    .gost-game-option-grid {
        display: grid;
        gap: var(--space-lg);
    }

    .gost-compare-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
        margin-top: var(--space-xl);
    }

    .gost-simulation-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        align-items: start;
    }

    .gost-subkey-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
        margin-top: var(--space-xl);
    }

    .gost-round-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
        margin-top: var(--space-xl);
    }

    .gost-compare-card,
    .gost-mini-panel,
    .gost-round-card,
    .gost-subkey-card,
    .gost-game-selected {
        min-height: auto;
        border: 1px solid var(--color-hairline);
        padding: var(--gost-pad);
        background: transparent;
    }

    .gost-compare-card {
        display: flex;
        flex-direction: column;
    }

    .gost-compare-card span,
    .gost-mini-panel span,
    .gost-round-card span,
    .gost-subkey-card span,
    .gost-game-selected span {
        display: block;
        margin-bottom: var(--space-md);
        color: var(--color-muted);
        font-family: var(--font-mono);
        font-size: 11px;
        line-height: 1.4;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .gost-compare-card h3,
    .gost-mini-panel h3 {
        margin: 0 0 var(--space-lg);
    }

    .gost-compare-pair {
        display: grid;
        margin-top: auto;
        border-top: 1px solid var(--color-hairline);
    }

    .gost-compare-pair div {
        display: grid;
        grid-template-columns: minmax(110px, 0.42fr) minmax(0, 1fr);
        gap: var(--space-md);
        padding: var(--space-md) 0;
        border-bottom: 1px solid var(--color-hairline);
    }

    .gost-compare-pair div:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .gost-compare-pair strong,
    .gost-round-card strong,
    .gost-subkey-card strong,
    .gost-game-selected strong {
        color: var(--color-primary);
        font-family: var(--font-display);
        font-size: 18px;
        font-weight: 400;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .gost-compare-pair p,
    .gost-mini-panel p,
    .gost-round-card p,
    .gost-subkey-card p {
        margin: 0;
        color: var(--color-body);
    }

    .gost-page .algorithm-flow {
        grid-template-columns: repeat(4, minmax(0, 1fr));
        align-items: stretch;
    }

    .gost-page .algorithm-flow-item {
        min-height: 230px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        gap: var(--space-md);
        padding: clamp(28px, 2.6vw, 36px);
        background: transparent;
    }

    .gost-page .algorithm-flow-item span {
        display: block;
        width: 100%;
        margin: 0;
    }

    .gost-page .algorithm-flow-item strong {
        display: block;
        width: 100%;
        margin: 0;
        font-size: clamp(22px, 2.1vw, 28px);
        line-height: 1.18;
    }

    .gost-page .algorithm-flow-item p {
        width: 100%;
        max-width: 36ch;
        margin: 0;
        font-size: 16px;
        line-height: 1.75;
    }

    .gost-page .algorithm-form-panel,
    .gost-page .algorithm-output-panel,
    .gost-page .algorithm-game-panel {
        padding: clamp(24px, 2.6vw, 36px);
    }

    .gost-page .algorithm-result-list {
        margin-top: var(--space-lg);
    }

    .gost-page .algorithm-result-row {
        grid-template-columns: minmax(150px, 0.58fr) minmax(0, 1.42fr);
        align-items: start;
        padding: var(--space-lg) 0;
    }

    .gost-page .algorithm-code-output {
        max-width: 100%;
        white-space: normal;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .gost-output-actions,
    .gost-game-actions {
        display: flex;
        flex-wrap: wrap;
        gap: var(--space-md);
        margin-top: var(--space-xl);
    }

    .gost-error,
    .gost-feedback,
    .gost-game-feedback {
        margin-top: var(--space-md);
        min-height: 24px;
        color: var(--color-link);
        font-family: var(--font-mono);
        font-size: 12px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .gost-error {
        color: #ffb7b7;
    }

    .gost-round-heading {
        margin-top: var(--space-xxl);
        padding-top: var(--space-xl);
        border-top: 1px solid var(--color-hairline);
    }

    .gost-round-heading h3 {
        margin: 0;
    }

    .gost-round-card,
    .gost-subkey-card {
        display: grid;
        align-content: start;
        gap: var(--space-sm);
    }

    .gost-round-card code,
    .gost-subkey-card code,
    .gost-game-selected code {
        display: block;
        color: var(--color-link);
        font-family: var(--font-mono);
        font-size: 12px;
        line-height: 1.7;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .gost-round-card code,
    .gost-subkey-card code {
        padding-top: var(--space-xs);
        border-top: 1px solid var(--color-hairline);
    }

    .gost-game-board {
        display: grid;
        gap: var(--space-lg);
    }

    .gost-game-option-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        margin-top: var(--space-xl);
    }

    .gost-game-option {
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

    .gost-game-option:hover {
        border-color: rgba(124, 255, 178, 0.64);
    }

    .gost-game-option.is-disabled {
        opacity: 0.35;
        pointer-events: none;
    }

    .gost-game-sequence {
        display: flex;
        flex-wrap: wrap;
        gap: var(--space-sm);
        margin-top: var(--space-md);
    }

    .gost-game-sequence code {
        border: 1px solid var(--color-hairline);
        padding: 8px 10px;
    }

    @media (max-width: 1180px) {
        .gost-compare-grid,
        .gost-subkey-grid,
        .gost-round-grid,
        .gost-page .algorithm-flow {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 900px) {
        .gost-compare-grid,
        .gost-simulation-grid,
        .gost-subkey-grid,
        .gost-round-grid,
        .gost-game-option-grid,
        .gost-page .algorithm-flow {
            grid-template-columns: 1fr;
        }

        .gost-page .algorithm-result-row,
        .gost-compare-pair div {
            grid-template-columns: 1fr;
            gap: var(--space-xs);
        }
    }

    @media (max-width: 768px) {
        .gost-page .algorithm-form-panel,
        .gost-page .algorithm-output-panel,
        .gost-page .algorithm-game-panel,
        .gost-compare-card,
        .gost-mini-panel,
        .gost-round-card,
        .gost-subkey-card,
        .gost-game-selected,
        .gost-page .algorithm-flow-item {
            padding: var(--space-lg);
        }

        .gost-page .algorithm-flow-item {
            min-height: auto;
        }

        .gost-game-option {
            min-height: 92px;
        }
    }
</style>

@php
    $defaultKey = 'UKMC2026UKMC2026UKMC2026UKMC2026';
    $encryptPlaintext = old('plaintext', $gostResult['plaintext'] ?? 'SURABAYA');
    $encryptKey = old('key', $gostResult['key'] ?? $defaultKey);
    $decryptCiphertext = old('ciphertext_hex', $gostResult['ciphertext_hex'] ?? '');
@endphp

<div class="gost-page">
<section class="algorithm-hero">
    <div class="container">
        <div class="algorithm-hero-content">
            <p class="caption">ALGORITHM MODULE 04</p>
            <h1>GOST ALGORITHM</h1>
            <p class="algorithm-hero-text">
                GOST 28147-89 atau Magma adalah algoritma kriptografi simetris berbasis block cipher. Algoritma ini memproses blok 64-bit, memakai key 256-bit, dan menjalankan 32 Feistel round.
            </p>

            <div class="hero-actions">
                <a href="#gost-simulation" class="button-primary">START SIMULATION</a>
                <a href="#gost-game" class="button-secondary">PLAY GOST GAME</a>
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
                <span>Key Size</span>
                <strong>256-bit</strong>
            </div>

            <div class="algorithm-meta-item">
                <span>Round</span>
                <strong>32 Feistel</strong>
            </div>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container algorithm-grid-2">
        <div>
            <p class="caption">HISTORY</p>
            <h2>SEJARAH SINGKAT GOST</h2>
        </div>

        <div class="text-block">
            <p>
                GOST merupakan keluarga standar kriptografi yang berasal dari Rusia. Salah satu algoritma yang sering dipelajari adalah GOST 28147-89, yaitu block cipher simetris yang menggunakan blok 64-bit dan key 256-bit.
            </p>
            <p>
                Pada pembelajaran Kriptografi, GOST menarik untuk dibandingkan dengan DES karena keduanya sama-sama memakai struktur Feistel, tetapi GOST menggunakan jumlah round lebih banyak dan ukuran key yang lebih besar.
            </p>
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">CORE CONCEPT</p>
                <h2>APA ITU GOST?</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            <article class="concept-card">
                <span>01</span>
                <h3>SYMMETRIC KEY</h3>
                <p>GOST menggunakan satu secret key yang sama untuk enkripsi dan dekripsi.</p>
            </article>

            <article class="concept-card">
                <span>02</span>
                <h3>BLOCK CIPHER</h3>
                <p>Plaintext diproses dalam blok tetap berukuran 64-bit.</p>
            </article>

            <article class="concept-card">
                <span>03</span>
                <h3>256-BIT KEY</h3>
                <p>Key utama sepanjang 256-bit dibagi menjadi delapan subkey 32-bit.</p>
            </article>

            <article class="concept-card">
                <span>04</span>
                <h3>FEISTEL NETWORK</h3>
                <p>Blok data dibagi menjadi sisi kiri dan kanan lalu diproses secara bertahap.</p>
            </article>

            <article class="concept-card">
                <span>05</span>
                <h3>S-BOX</h3>
                <p>Operasi substitusi S-Box mengubah potongan 4-bit agar hasil round lebih kompleks.</p>
            </article>

            <article class="concept-card">
                <span>06</span>
                <h3>32 ROUNDS</h3>
                <p>GOST melakukan 32 round untuk menghasilkan ciphertext pada satu blok data.</p>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">COMPARISON</p>
                <h2>GOST BERBEDA DARI HASH, RSA, DAN DES</h2>
            </div>
        </div>

        <div class="gost-compare-grid">
            <article class="gost-compare-card algorithm-card">
                <span>Hash</span>
                <h3>One-Way Function</h3>
                <div class="gost-compare-pair">
                    <div><strong>Kunci</strong><p>Tidak memakai key.</p></div>
                    <div><strong>Dekripsi</strong><p>Tidak bisa didekripsi.</p></div>
                    <div><strong>Tujuan</strong><p>Integritas data.</p></div>
                </div>
            </article>

            <article class="gost-compare-card algorithm-card">
                <span>RSA</span>
                <h3>Asymmetric Cryptography</h3>
                <div class="gost-compare-pair">
                    <div><strong>Kunci</strong><p>Public key dan private key.</p></div>
                    <div><strong>Dekripsi</strong><p>Bisa memakai private key.</p></div>
                    <div><strong>Tujuan</strong><p>Kerahasiaan dan autentikasi.</p></div>
                </div>
            </article>

            <article class="gost-compare-card algorithm-card">
                <span>DES</span>
                <h3>Symmetric Block Cipher</h3>
                <div class="gost-compare-pair">
                    <div><strong>Key</strong><p>Effective key 56-bit.</p></div>
                    <div><strong>Round</strong><p>16 Feistel round.</p></div>
                    <div><strong>Block</strong><p>64-bit.</p></div>
                </div>
            </article>

            <article class="gost-compare-card algorithm-card">
                <span>GOST</span>
                <h3>Symmetric Block Cipher</h3>
                <div class="gost-compare-pair">
                    <div><strong>Key</strong><p>Key utama 256-bit.</p></div>
                    <div><strong>Round</strong><p>32 Feistel round.</p></div>
                    <div><strong>Block</strong><p>64-bit.</p></div>
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
                <h2>CARA KERJA GOST</h2>
            </div>
        </div>

        <div class="algorithm-flow">
            <article class="algorithm-flow-item">
                <span>Step 01</span>
                <strong>Plaintext 64-bit</strong>
                <p>Input teks dikonversi menjadi blok data 64-bit.</p>
            </article>

            <article class="algorithm-flow-item">
                <span>Step 02</span>
                <strong>Split L0 dan R0</strong>
                <p>Blok dibagi menjadi dua bagian 32-bit.</p>
            </article>

            <article class="algorithm-flow-item">
                <span>Step 03</span>
                <strong>32 Feistel Round</strong>
                <p>Setiap round memakai subkey, modulo addition, S-Box, rotate, dan XOR.</p>
            </article>

            <article class="algorithm-flow-item">
                <span>Step 04</span>
                <strong>Ciphertext Output</strong>
                <p>Hasil akhir dikonversi menjadi ciphertext hex 64-bit.</p>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">KEY SCHEDULE</p>
                <h2>PEMBENTUKAN SUBKEY GOST</h2>
            </div>
        </div>

        <div class="algorithm-flow">
            <article class="algorithm-flow-item">
                <span>01</span>
                <strong>Key 256-bit</strong>
                <p>Key demo memakai 32 karakter ASCII sehingga setara 256-bit.</p>
            </article>

            <article class="algorithm-flow-item">
                <span>02</span>
                <strong>8 Subkey</strong>
                <p>Key dibagi menjadi K1 sampai K8, masing-masing 32-bit.</p>
            </article>

            <article class="algorithm-flow-item">
                <span>03</span>
                <strong>Round 1-24</strong>
                <p>Urutan K1 sampai K8 diulang sebanyak tiga kali.</p>
            </article>

            <article class="algorithm-flow-item">
                <span>04</span>
                <strong>Round 25-32</strong>
                <p>Subkey digunakan dari K8 sampai K1 pada delapan round terakhir.</p>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">FORMULA</p>
                <h2>RUMUS DAN OPERASI INTI GOST</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            <article class="formula-card">
                <span>Formula 01</span>
                <h3>FEISTEL ROUND</h3>
                <code class="algorithm-code-output">Lᵢ = Rᵢ₋₁
Rᵢ = Lᵢ₋₁ XOR F(Rᵢ₋₁, Kᵢ)</code>
            </article>

            <article class="formula-card">
                <span>Formula 02</span>
                <h3>ROUND FUNCTION</h3>
                <code class="algorithm-code-output">F(R, K) = ROTL11(S((R + K) mod 2³²))</code>
            </article>

            <article class="formula-card">
                <span>Formula 03</span>
                <h3>MODULO ADDITION</h3>
                <code class="algorithm-code-output">X = (R + K) mod 2³²</code>
            </article>

            <article class="formula-card">
                <span>Formula 04</span>
                <h3>S-BOX</h3>
                <p>Hasil penjumlahan dibagi menjadi delapan potongan 4-bit lalu diganti melalui S-Box.</p>
            </article>

            <article class="formula-card">
                <span>Formula 05</span>
                <h3>ROTATE LEFT</h3>
                <code class="algorithm-code-output">Y = ROTL11(S(X))</code>
            </article>

            <article class="formula-card">
                <span>Formula 06</span>
                <h3>XOR RESULT</h3>
                <code class="algorithm-code-output">Rᵢ = Lᵢ₋₁ XOR Y</code>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container algorithm-grid-2">
        <div>
            <p class="caption">MANUAL TRACE</p>
            <h2>PENJABARAN PERHITUNGAN GOST</h2>
        </div>

        <div class="text-block">
            <p>
                Contoh demo menggunakan plaintext <strong>SURABAYA</strong> dan key <strong>UKMC2026UKMC2026UKMC2026UKMC2026</strong>. Plaintext dikonversi menjadi blok 64-bit, sedangkan key 32 karakter dikonversi menjadi key 256-bit.
            </p>
            <p>
                Pada round pertama, bagian kanan blok ditambah dengan subkey K1 menggunakan modulo 2³², kemudian melewati S-Box, diputar kiri 11 bit, dan di-XOR dengan bagian kiri blok. Pola ini berulang sampai 32 round.
            </p>
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered" id="gost-simulation">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">SIMULATION</p>
                <h2>ENCRYPT & DECRYPT GOST</h2>
            </div>
        </div>

        <div class="gost-simulation-grid">
            <form class="algorithm-form-panel" action="{{ route('gost.process') }}" method="POST" data-gost-form="encrypt">
                @csrf
                <input type="hidden" name="mode" value="encrypt">

                <p class="caption">ENCRYPT MODE</p>
                <h3>PLAINTEXT TO CIPHERTEXT</h3>

                <div class="algorithm-form-group">
                    <label for="gost_plaintext">Plaintext</label>
                    <input id="gost_plaintext" type="text" name="plaintext" class="algorithm-input" maxlength="8" value="{{ $encryptPlaintext }}" placeholder="Maksimal 8 karakter">
                    <div class="gost-error" data-form-error="plaintext"></div>
                </div>

                <div class="algorithm-form-group">
                    <label for="gost_encrypt_key">Key 256-bit</label>
                    <textarea id="gost_encrypt_key" name="key" class="algorithm-textarea" maxlength="32" placeholder="Tepat 32 karakter">{{ $encryptKey }}</textarea>
                    <div class="gost-error" data-form-error="key"></div>
                </div>

                <div class="algorithm-button-row">
                    <button type="submit" class="button-primary" data-default-text="ENCRYPT GOST">ENCRYPT GOST</button>
                    <button type="button" class="button-secondary" data-gost-reset>RESET</button>
                </div>

                <div class="gost-feedback" data-form-feedback></div>
            </form>

            <form class="algorithm-form-panel" action="{{ route('gost.process') }}" method="POST" data-gost-form="decrypt">
                @csrf
                <input type="hidden" name="mode" value="decrypt">

                <p class="caption">DECRYPT MODE</p>
                <h3>CIPHERTEXT TO PLAINTEXT</h3>

                <div class="algorithm-form-group">
                    <label for="gost_ciphertext_hex">Ciphertext Hex</label>
                    <input id="gost_ciphertext_hex" type="text" name="ciphertext_hex" class="algorithm-input" maxlength="16" value="{{ $decryptCiphertext }}" placeholder="16 karakter hex">
                    <div class="gost-error" data-form-error="ciphertext_hex"></div>
                </div>

                <div class="algorithm-form-group">
                    <label for="gost_decrypt_key">Key 256-bit</label>
                    <textarea id="gost_decrypt_key" name="key" class="algorithm-textarea" maxlength="32" placeholder="Tepat 32 karakter">{{ $encryptKey }}</textarea>
                    <div class="gost-error" data-form-error="key"></div>
                </div>

                <div class="algorithm-button-row">
                    <button type="submit" class="button-primary" data-default-text="DECRYPT GOST">DECRYPT GOST</button>
                </div>

                <div class="gost-feedback" data-form-feedback></div>
            </form>
        </div>

        <div data-gost-result-area></div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">REAL WORLD USE</p>
                <h2>PENGAPLIKASIAN GOST</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            <article class="application-card">
                <span>01</span>
                <h3>BLOCK CIPHER LEARNING</h3>
                <p>GOST dapat digunakan untuk memahami block cipher selain DES.</p>
            </article>

            <article class="application-card">
                <span>02</span>
                <h3>FEISTEL NETWORK STUDY</h3>
                <p>GOST memperlihatkan struktur Feistel dengan jumlah round yang lebih banyak.</p>
            </article>

            <article class="application-card">
                <span>03</span>
                <h3>SYMMETRIC CRYPTOGRAPHY</h3>
                <p>GOST membantu menjelaskan penggunaan secret key dalam algoritma simetris.</p>
            </article>

            <article class="application-card">
                <span>04</span>
                <h3>KEY SCHEDULE STUDY</h3>
                <p>GOST menunjukkan key 256-bit yang dibagi menjadi delapan subkey.</p>
            </article>

            <article class="application-card">
                <span>05</span>
                <h3>SECURITY COMPARISON</h3>
                <p>GOST dapat dibandingkan dengan DES karena sama-sama memakai blok 64-bit.</p>
            </article>

            <article class="application-card">
                <span>06</span>
                <h3>CRYPTOGRAPHY EDUCATION</h3>
                <p>GOST cocok untuk belajar modulo addition, S-Box, rotasi bit, dan XOR.</p>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered" id="gost-game">
    <div class="container gost-simulation-grid">
        <div>
            <p class="caption">MINI GAME</p>
            <h2>GOST ROUND BUILDER</h2>
            <p class="algorithm-hero-text" style="margin-left:0;">
                Susun urutan operasi GOST berdasarkan tantangan yang muncul. Pilih step satu per satu sampai urutannya benar.
            </p>
        </div>

        <div class="algorithm-game-panel" data-gost-game>
            <p class="caption">CHALLENGE</p>
            <h3 data-game-title>ROUND FUNCTION ORDER</h3>
            <p class="algorithm-note" data-game-hint></p>

            <div class="gost-game-selected">
                <span>Selected Sequence</span>
                <div class="gost-game-sequence" data-game-sequence></div>
            </div>

            <div class="gost-game-option-grid" data-game-options></div>

            <div class="gost-game-actions">
                <button type="button" class="button-primary" data-check-game>CHECK ANSWER</button>
                <button type="button" class="button-secondary" data-next-game>NEXT CHALLENGE</button>
                <button type="button" class="button-secondary" data-reset-game>RESET SEQUENCE</button>
            </div>

            <div class="gost-game-feedback" data-game-feedback></div>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">LIMITATION</p>
                <h2>BATASAN HALAMAN GOST</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            <article class="concept-card">
                <span>01</span>
                <h3>DEMO ONLY</h3>
                <p>Halaman ini digunakan untuk pembelajaran, bukan sistem keamanan produksi.</p>
            </article>

            <article class="concept-card">
                <span>02</span>
                <h3>SINGLE BLOCK</h3>
                <p>Simulasi dibatasi pada satu blok 64-bit atau maksimal 8 karakter plaintext.</p>
            </article>

            <article class="concept-card">
                <span>03</span>
                <h3>KEY 32 CHARACTERS</h3>
                <p>Key demo wajib 32 karakter ASCII agar setara key 256-bit.</p>
            </article>

            <article class="concept-card">
                <span>04</span>
                <h3>NO MODE OPERATION</h3>
                <p>Halaman ini tidak membahas mode operasi seperti CBC, CFB, OFB, atau CTR.</p>
            </article>

            <article class="concept-card">
                <span>05</span>
                <h3>FIXED S-BOX</h3>
                <p>Simulasi memakai S-Box tetap agar proses pembelajaran konsisten.</p>
            </article>

            <article class="concept-card">
                <span>06</span>
                <h3>NOT PRODUCTION</h3>
                <p>Implementasi ini tidak dipakai untuk melindungi data nyata.</p>
            </article>
        </div>
    </div>
</section>
</div>

<script>
    const gostGameChallenges = @json($gameChallenges);
    const defaultGostKey = 'UKMC2026UKMC2026UKMC2026UKMC2026';
    const gostForms = document.querySelectorAll('[data-gost-form]');
    const gostResultArea = document.querySelector('[data-gost-result-area]');
    const gostResetButton = document.querySelector('[data-gost-reset]');

    gostForms.forEach((form) => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            await submitGostForm(form);
        });
    });

    if (gostResetButton) {
        gostResetButton.addEventListener('click', () => {
            const encryptForm = document.querySelector('[data-gost-form="encrypt"]');
            const decryptForm = document.querySelector('[data-gost-form="decrypt"]');

            if (encryptForm) {
                encryptForm.querySelector('[name="plaintext"]').value = 'SURABAYA';
                encryptForm.querySelector('[name="key"]').value = defaultGostKey;
            }

            if (decryptForm) {
                decryptForm.querySelector('[name="ciphertext_hex"]').value = '';
                decryptForm.querySelector('[name="key"]').value = defaultGostKey;
            }

            clearGostErrors();
            clearGostFeedback();

            if (gostResultArea) {
                gostResultArea.innerHTML = '';
            }
        });
    }

    document.addEventListener('click', async (event) => {
        const copyButton = event.target.closest('[data-copy-value]');
        const sendDecryptButton = event.target.closest('[data-send-gost-decrypt]');

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

        if (sendDecryptButton) {
            const ciphertext = sendDecryptButton.dataset.ciphertext;
            const key = sendDecryptButton.dataset.key;
            const decryptForm = document.querySelector('[data-gost-form="decrypt"]');

            if (decryptForm) {
                decryptForm.querySelector('[name="ciphertext_hex"]').value = ciphertext;
                decryptForm.querySelector('[name="key"]').value = key;
                document.querySelector('#gost-simulation')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    });

    async function submitGostForm(form) {
        const submitButton = form.querySelector('[type="submit"]');
        const feedback = form.querySelector('[data-form-feedback]');
        const defaultText = submitButton?.dataset.defaultText || submitButton?.textContent || 'PROCESS';

        clearFormErrors(form);

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
                if (data.errors) {
                    showFormErrors(form, data.errors);
                    if (feedback) feedback.textContent = 'CHECK INPUT FIELD.';
                    return;
                }

                throw new Error(data.message || 'Request failed.');
            }

            if (data.gostResult) {
                renderGostResult(data.gostResult);
                if (feedback) feedback.textContent = 'GOST PROCESS FINISHED WITHOUT PAGE REFRESH.';
            }

            gostResultArea?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
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

    function renderGostResult(result) {
        if (!gostResultArea) {
            return;
        }

        const isEncrypt = result.mode === 'encrypt';
        const mainRows = isEncrypt
            ? [
                ['Mode', result.mode_label],
                ['Plaintext', result.plaintext],
                ['Plaintext Hex', result.plaintext_hex],
                ['Key Length', result.key_length],
                ['Key Hex', result.key_hex],
                ['Ciphertext Hex', result.ciphertext_hex, 'gost-ciphertext-value'],
                ['Ciphertext Binary', result.ciphertext_binary],
                ['Round Count', `${result.round_count} Feistel rounds`],
            ]
            : [
                ['Mode', result.mode_label],
                ['Ciphertext Hex', result.ciphertext_hex],
                ['Key Length', result.key_length],
                ['Key Hex', result.key_hex],
                ['Plaintext Result', result.plaintext, 'gost-plaintext-value'],
                ['Plaintext Hex', result.plaintext_hex],
                ['Plaintext Binary', result.plaintext_binary],
                ['Round Count', `${result.round_count} Feistel rounds`],
            ];

        const rowsHtml = mainRows.map((row) => {
            const [label, value, id] = row;
            const idAttribute = id ? ` id="${id}"` : '';

            return `
                <div class="algorithm-result-row">
                    <span>${escapeHtml(label)}</span>
                    <code class="algorithm-code-output"${idAttribute}>${escapeHtml(value)}</code>
                </div>
            `;
        }).join('');

        const subkeysHtml = result.subkeys.map((subkey) => `
            <article class="gost-subkey-card algorithm-card">
                <span>${escapeHtml(subkey.label)}</span>
                <strong>${escapeHtml(subkey.hex)}</strong>
            </article>
        `).join('');

        const roundsHtml = result.rounds.map((round) => `
            <article class="gost-round-card algorithm-card">
                <span>Round ${round.round} / ${escapeHtml(round.subkey)}</span>
                <strong>${escapeHtml(round.operation)}</strong>
                <code>Subkey : ${escapeHtml(round.subkey_hex)}</code>
                <code>F(R,K) : ${escapeHtml(round.f_hex)}</code>
                <code>L      : ${escapeHtml(round.left_hex)}</code>
                <code>R      : ${escapeHtml(round.right_hex)}</code>
            </article>
        `).join('');

        const actionHtml = isEncrypt
            ? `<button type="button" class="button-secondary" data-send-gost-decrypt data-ciphertext="${escapeHtml(result.ciphertext_hex)}" data-key="${escapeHtml(result.key)}">SEND TO DECRYPT</button>`
            : '';

        gostResultArea.innerHTML = `
            <div class="algorithm-output-panel" style="margin-top: var(--space-xl);">
                <p class="caption">GOST OUTPUT</p>
                <h3>${escapeHtml(result.mode_label)}</h3>

                <div class="algorithm-result-list">
                    ${rowsHtml}
                </div>

                <p class="algorithm-note">${escapeHtml(result.note)}</p>

                <div class="gost-output-actions">
                    <button type="button" class="button-secondary" data-copy-value="${isEncrypt ? '#gost-ciphertext-value' : '#gost-plaintext-value'}">COPY RESULT</button>
                    ${actionHtml}
                </div>
                <div class="gost-feedback" data-copy-feedback></div>

                <div class="gost-round-heading">
                    <p class="caption">SUBKEY SUMMARY</p>
                    <h3>K1 SAMPAI K8</h3>
                </div>

                <div class="gost-subkey-grid">
                    ${subkeysHtml}
                </div>

                <div class="gost-round-heading">
                    <p class="caption">ROUND SUMMARY</p>
                    <h3>32 FEISTEL ROUNDS</h3>
                </div>

                <div class="gost-round-grid">
                    ${roundsHtml}
                </div>
            </div>
        `;

        requestAnimationFrame(() => {
            if (typeof initCyberCards === 'function') {
                initCyberCards();
            }
        });
    }

    function showFormErrors(form, errors) {
        Object.entries(errors).forEach(([field, messages]) => {
            const target = form.querySelector(`[data-form-error="${field}"]`);
            if (target) target.textContent = messages[0];
        });

        if (errors.gost) {
            const feedback = form.querySelector('[data-form-feedback]');
            if (feedback) feedback.textContent = errors.gost[0];
        }
    }

    function clearFormErrors(form) {
        form.querySelectorAll('[data-form-error]').forEach((element) => {
            element.textContent = '';
        });
    }

    function clearGostErrors() {
        document.querySelectorAll('[data-form-error]').forEach((element) => {
            element.textContent = '';
        });
    }

    function clearGostFeedback() {
        document.querySelectorAll('[data-form-feedback]').forEach((element) => {
            element.textContent = '';
        });
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

    const gostGame = document.querySelector('[data-gost-game]');

    if (gostGame && gostGameChallenges.length > 0) {
        initGostGame();
    }

    function initGostGame() {
        const title = gostGame.querySelector('[data-game-title]');
        const hint = gostGame.querySelector('[data-game-hint]');
        const sequenceContainer = gostGame.querySelector('[data-game-sequence]');
        const optionsContainer = gostGame.querySelector('[data-game-options]');
        const feedback = gostGame.querySelector('[data-game-feedback]');
        const checkButton = gostGame.querySelector('[data-check-game]');
        const nextButton = gostGame.querySelector('[data-next-game]');
        const resetButton = gostGame.querySelector('[data-reset-game]');

        let queue = shuffleArray(gostGameChallenges);
        let currentChallenge = null;
        let selectedSequence = [];

        function nextChallenge() {
            if (queue.length === 0) {
                queue = shuffleArray(gostGameChallenges);
            }

            currentChallenge = queue.shift();
            selectedSequence = [];
            title.textContent = currentChallenge.title;
            hint.textContent = currentChallenge.hint;
            feedback.textContent = '';
            renderSequence();
            renderOptions();
        }

        function renderSequence() {
            sequenceContainer.innerHTML = selectedSequence.length
                ? selectedSequence.map((item, index) => `<code>${index + 1}. ${escapeHtml(item)}</code>`).join('')
                : '<code>Belum ada step yang dipilih.</code>';
        }

        function renderOptions() {
            optionsContainer.innerHTML = shuffleArray(currentChallenge.options).map((option) => {
                const disabled = selectedSequence.includes(option) ? ' is-disabled' : '';
                return `<button type="button" class="gost-game-option${disabled}" data-option="${escapeHtml(option)}">${escapeHtml(option)}</button>`;
            }).join('');
        }

        optionsContainer.addEventListener('click', (event) => {
            const optionButton = event.target.closest('[data-option]');
            if (!optionButton || optionButton.classList.contains('is-disabled')) {
                return;
            }

            selectedSequence.push(optionButton.dataset.option);
            renderSequence();
            renderOptions();
        });

        checkButton?.addEventListener('click', () => {
            const isCorrect = currentChallenge.answer.length === selectedSequence.length
                && currentChallenge.answer.every((item, index) => item === selectedSequence[index]);

            if (isCorrect) {
                feedback.textContent = 'CORRECT. GOST FLOW MATCHED.';
                window.setTimeout(nextChallenge, 1200);
                return;
            }

            feedback.textContent = 'NOT YET. CHECK THE ORDER AGAIN.';
        });

        nextButton?.addEventListener('click', nextChallenge);

        resetButton?.addEventListener('click', () => {
            selectedSequence = [];
            feedback.textContent = '';
            renderSequence();
            renderOptions();
        });

        nextChallenge();
    }
</script>
@endsection
