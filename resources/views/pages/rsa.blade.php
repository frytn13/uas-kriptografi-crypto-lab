@extends('layouts.app')

@section('title', 'Crypto Lab | RSA Algorithm')

@section('content')
<style>
    .algorithm-hero {
        position: relative;
        overflow: hidden;
        padding: 132px 0 80px;
        border-bottom: 1px solid var(--color-hairline);
        background:
            radial-gradient(circle at 50% 34%, rgba(124, 255, 178, 0.08), transparent 34%),
            rgba(0, 0, 0, 0.78);
    }

    .algorithm-hero-content {
        max-width: 1040px;
        margin: 0 auto;
        text-align: center;
    }

    .algorithm-hero-text {
        max-width: 880px;
        margin: var(--space-lg) auto 0;
        color: var(--color-body-strong);
        font-size: 18px;
    }

    .algorithm-meta-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        margin-top: 96px;
        border-top: 1px solid var(--color-hairline);
        border-left: 1px solid var(--color-hairline);
    }

    .algorithm-meta-item {
        min-height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: var(--space-lg);
        border-right: 1px solid var(--color-hairline);
        border-bottom: 1px solid var(--color-hairline);
    }

    .algorithm-meta-item span,
    .concept-card span,
    .formula-card span,
    .application-card span,
    .game-card span,
    .hash-step-card span,
    .hash-flow-item span,
    .hash-result-row span,
    .rsa-result-row span,
    .game-stat span,
    .game-candidate-card span,
    .rsa-mini-label {
        color: var(--color-muted);
        font-family: var(--font-mono);
        font-size: 11px;
        line-height: 1.4;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .algorithm-meta-item strong,
    .hash-flow-item strong,
    .hash-result-row strong,
    .rsa-result-row strong,
    .game-stat strong {
        color: var(--color-primary);
        font-family: var(--font-display);
        font-size: 20px;
        font-weight: 400;
        line-height: 1.3;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .algorithm-section {
        padding: var(--section-space) 0;
        background: rgba(0, 0, 0, 0.78);
    }

    .algorithm-section-bordered {
        border-top: 1px solid var(--color-hairline);
        border-bottom: 1px solid var(--color-hairline);
        background: rgba(13, 13, 13, 0.84);
    }

    .algorithm-grid-2 {
        display: grid;
        grid-template-columns: 0.9fr 1.1fr;
        gap: var(--space-xxl);
    }

    .algorithm-grid-3,
    .algorithm-grid-4,
    .rsa-form-grid,
    .rsa-game-grid {
        display: grid;
        border-top: 1px solid var(--color-hairline);
        border-left: 1px solid var(--color-hairline);
    }

    .algorithm-grid-3 {
        grid-template-columns: repeat(3, 1fr);
    }

    .algorithm-grid-4 {
        grid-template-columns: repeat(4, 1fr);
    }

    .rsa-form-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .rsa-game-grid {
        grid-template-columns: repeat(3, 1fr);
        margin-top: var(--space-xl);
    }

    .concept-card,
    .formula-card,
    .application-card,
    .game-card,
    .hash-step-card,
    .hash-flow-item,
    .game-candidate-card,
    .rsa-form-panel-card {
        position: relative;
        min-height: 260px;
        padding: var(--space-lg);
        border-right: 1px solid var(--color-hairline);
        border-bottom: 1px solid var(--color-hairline);
    }

    .concept-card h3,
    .formula-card h3,
    .application-card h3,
    .game-card h3,
    .hash-step-card h3,
    .hash-flow-item h3,
    .game-candidate-card h3 {
        margin-top: var(--space-xl);
        margin-bottom: var(--space-lg);
    }

    .concept-card p,
    .formula-card p,
    .application-card p,
    .game-card p,
    .hash-step-card p,
    .hash-flow-item p,
    .game-candidate-card p {
        margin: 0;
        color: var(--color-body);
    }

    .rsa-flow {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        border-top: 1px solid var(--color-hairline);
        border-left: 1px solid var(--color-hairline);
    }

    .hash-flow-item {
        min-height: 210px;
    }

    .hash-flow-item span {
        display: block;
        margin-bottom: var(--space-xl);
    }

    .hash-flow-item strong {
        display: block;
        margin-bottom: var(--space-md);
        font-size: 22px;
    }

    .rsa-compare-pair,
    .rsa-key-pair,
    .rsa-option-buttons {
        display: grid;
        gap: var(--space-md);
        margin-top: var(--space-lg);
    }

    .rsa-compare-pair div,
    .rsa-key-pair div {
        border: 1px solid var(--color-hairline);
        padding: var(--space-md);
        background: rgba(0, 0, 0, 0.24);
    }

    .rsa-compare-pair strong,
    .rsa-key-pair strong {
        display: block;
        margin-bottom: var(--space-xs);
        color: var(--color-primary);
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .rsa-form-panel {
        min-height: 100%;
        border: 0;
        border-right: 1px solid var(--color-hairline);
        border-bottom: 1px solid var(--color-hairline);
        padding: var(--space-lg);
    }

    .rsa-form-group {
        margin-bottom: var(--space-lg);
    }

    .rsa-form-group label {
        display: block;
        margin-bottom: var(--space-sm);
        color: var(--color-muted);
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .rsa-input,
    .rsa-textarea {
        width: 100%;
        border: 1px solid var(--color-hairline-strong);
        background: rgba(0, 0, 0, 0.72);
        color: var(--color-primary);
        outline: none;
        font-family: var(--font-mono);
        font-size: 14px;
        line-height: 1.7;
    }

    .rsa-input {
        min-height: 48px;
        padding: 0 var(--space-lg);
    }

    .rsa-textarea {
        min-height: 152px;
        resize: vertical;
        padding: var(--space-lg);
    }

    .rsa-input:focus,
    .rsa-textarea:focus {
        border-color: rgba(124, 255, 178, 0.58);
    }

    .rsa-error,
    .rsa-feedback,
    .rsa-copy-feedback,
    .rsa-game-feedback {
        margin-top: var(--space-md);
        min-height: 22px;
        color: var(--color-link);
        font-family: var(--font-mono);
        font-size: 12px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .rsa-error {
        color: #ffb7b7;
    }

    .rsa-output-area {
        margin-top: var(--space-xl);
    }

    .rsa-result-list {
        margin-top: var(--space-lg);
        border: 1px solid var(--color-hairline);
        border-bottom: 0;
        background: rgba(0, 0, 0, 0.18);
    }

    .hash-result-row,
    .rsa-result-row {
        display: grid;
        grid-template-columns: 0.72fr 1.28fr;
        gap: var(--space-lg);
        padding: var(--space-lg);
        border-bottom: 1px solid var(--color-hairline);
    }

    .rsa-code-output,
    .hash-code-output {
        display: block;
        width: 100%;
        overflow-wrap: anywhere;
        white-space: pre-wrap;
        color: var(--color-link);
        font-family: var(--font-mono);
        font-size: 13px;
        line-height: 1.8;
    }

    .rsa-result-row .rsa-code-output {
        padding: var(--space-md);
        border: 1px solid var(--color-hairline);
        background: rgba(0, 0, 0, 0.36);
    }

    .rsa-formula-code {
        display: block;
        margin-top: var(--space-md);
        padding: var(--space-md);
        border: 1px solid var(--color-hairline);
        color: var(--color-link);
        background: rgba(0, 0, 0, 0.42);
        font-family: var(--font-mono);
        font-size: 12px;
        line-height: 1.8;
        overflow-x: auto;
        white-space: pre-wrap;
        scrollbar-width: none;
    }

    .rsa-formula-code::-webkit-scrollbar {
        display: none;
    }

    .rsa-note,
    .hash-note {
        margin-top: var(--space-lg);
        color: var(--color-body);
        font-size: 17px;
    }

    .rsa-button-row,
    .hash-button-row {
        display: flex;
        flex-wrap: wrap;
        gap: var(--space-md);
        margin-top: var(--space-xl);
    }

    .rsa-status-pill {
        display: inline-flex;
        align-items: center;
        min-height: 36px;
        padding: 0 var(--space-md);
        border: 1px solid rgba(124, 255, 178, 0.48);
        color: var(--color-primary);
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .game-dashboard {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        margin-bottom: var(--space-xl);
        border-top: 1px solid var(--color-hairline);
        border-left: 1px solid var(--color-hairline);
    }

    .game-stat {
        min-height: 116px;
        padding: var(--space-lg);
        border-right: 1px solid var(--color-hairline);
        border-bottom: 1px solid var(--color-hairline);
        background: rgba(0, 0, 0, 0.22);
    }

    .game-stat span {
        display: block;
        margin-bottom: var(--space-md);
    }

    .game-candidate-card {
        min-height: 220px;
    }

    .rsa-option-button,
    .rsa-small-button {
        min-height: 40px;
        border: 1px solid var(--color-hairline-strong);
        border-radius: 999px;
        background: transparent;
        color: var(--color-primary);
        cursor: pointer;
        padding: 0 var(--space-md);
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .rsa-option-button:hover,
    .rsa-small-button:hover,
    .rsa-option-button.is-selected {
        border-color: rgba(124, 255, 178, 0.7);
        background: rgba(124, 255, 178, 0.08);
        color: #ffffff;
    }

    .rsa-warning {
        border-left: 1px solid rgba(124, 255, 178, 0.55);
        padding-left: var(--space-lg);
        color: var(--color-body-strong);
        font-size: 18px;
    }

    .rsa-top-gap {
        margin-top: var(--space-xl);
    }

    @media (max-width: 1180px) {
        .algorithm-grid-3,
        .algorithm-grid-4,
        .rsa-flow,
        .rsa-form-grid,
        .rsa-game-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 900px) {
        .algorithm-grid-2,
        .algorithm-meta-grid,
        .game-dashboard {
            grid-template-columns: 1fr;
        }

        .hash-result-row,
        .rsa-result-row {
            grid-template-columns: 1fr;
            gap: var(--space-xs);
        }
    }

    @media (max-width: 768px) {
        .algorithm-hero {
            padding: 96px 0 64px;
        }

        .algorithm-meta-grid {
            margin-top: 64px;
        }

        .algorithm-grid-3,
        .algorithm-grid-4,
        .rsa-flow,
        .rsa-form-grid,
        .rsa-game-grid {
            grid-template-columns: 1fr;
        }

        .concept-card,
        .formula-card,
        .application-card,
        .game-card,
        .hash-step-card,
        .hash-flow-item,
        .game-candidate-card,
        .rsa-form-panel {
            min-height: auto;
        }
    }
</style>

<section class="algorithm-hero">
    <div class="container">
        <div class="algorithm-hero-content">
            <p class="caption">ALGORITHM MODULE 02</p>
            <h1>RSA ALGORITHM</h1>
            <p class="algorithm-hero-text">
                RSA adalah algoritma kriptografi asimetris yang menggunakan pasangan <em>public key</em> dan <em>private key</em>. Halaman ini membahas konsep, pembentukan kunci, rumus, simulasi enkripsi, simulasi dekripsi, pengaplikasian, dan game edukatif RSA Key Builder.
            </p>

            <div class="hero-actions">
                <a href="#rsa-simulation" class="button-primary">START SIMULATION</a>
                <a href="#rsa-game" class="button-secondary">PLAY RSA GAME</a>
            </div>
        </div>

        <div class="algorithm-meta-grid">
            <div class="algorithm-meta-item">
                <span>Kategori</span>
                <strong>Asymmetric</strong>
            </div>

            <div class="algorithm-meta-item">
                <span>Kunci</span>
                <strong>Public & Private</strong>
            </div>

            <div class="algorithm-meta-item">
                <span>Proses</span>
                <strong>Encrypt & Decrypt</strong>
            </div>

            <div class="algorithm-meta-item">
                <span>Dasar</span>
                <strong>Modulo</strong>
            </div>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container algorithm-grid-2">
        <div>
            <p class="caption">HISTORY</p>
            <h2>SEJARAH SINGKAT RSA</h2>
        </div>

        <div class="text-block">
            <p>
                RSA diperkenalkan oleh Ronald Rivest, Adi Shamir, dan Leonard Adleman. Nama RSA berasal dari inisial ketiga penemunya. Algoritma ini menjadi salah satu pendekatan kunci publik yang dikenal luas dalam Kriptografi modern.
            </p>

            <p>
                RSA berbeda dari algoritma simetris seperti DES atau GOST karena tidak memakai satu kunci rahasia yang sama. RSA memakai public key untuk proses enkripsi dan private key untuk proses dekripsi.
            </p>

            <p>
                Keamanan RSA bertumpu pada sulitnya memfaktorkan bilangan besar menjadi dua faktor prima. Pada halaman ini, bilangan prima kecil digunakan agar proses hitung dapat dipahami secara manual.
            </p>
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">CORE CONCEPT</p>
                <h2>APA ITU RSA?</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            <article class="concept-card">
                <span>01</span>
                <h3>ASYMMETRIC KEY</h3>
                <p>RSA menggunakan dua kunci berbeda, yaitu public key dan private key.</p>
            </article>

            <article class="concept-card">
                <span>02</span>
                <h3>PUBLIC KEY</h3>
                <p>Public key digunakan untuk mengenkripsi pesan dan boleh dibagikan kepada pihak lain.</p>
            </article>

            <article class="concept-card">
                <span>03</span>
                <h3>PRIVATE KEY</h3>
                <p>Private key digunakan untuk mendekripsi pesan dan harus dirahasiakan.</p>
            </article>

            <article class="concept-card">
                <span>04</span>
                <h3>PRIME NUMBER</h3>
                <p>Pembentukan kunci RSA dimulai dari dua bilangan prima p dan q.</p>
            </article>

            <article class="concept-card">
                <span>05</span>
                <h3>MODULAR ARITHMETIC</h3>
                <p>Enkripsi dan dekripsi RSA menggunakan operasi perpangkatan modulo.</p>
            </article>

            <article class="concept-card">
                <span>06</span>
                <h3>FACTORIZATION</h3>
                <p>Keamanan RSA bergantung pada sulitnya memfaktorkan nilai n yang sangat besar.</p>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">COMPARISON</p>
                <h2>RSA BERBEDA DARI HASH</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            <article class="concept-card">
                <span>Aspek 01</span>
                <h3>ARAH PROSES</h3>
                <div class="rsa-compare-pair">
                    <div><strong>Hash</strong><p>Satu arah.</p></div>
                    <div><strong>RSA</strong><p>Dua arah dengan kunci yang sesuai.</p></div>
                </div>
            </article>

            <article class="concept-card">
                <span>Aspek 02</span>
                <h3>OUTPUT</h3>
                <div class="rsa-compare-pair">
                    <div><strong>Hash</strong><p>Message digest.</p></div>
                    <div><strong>RSA</strong><p>Ciphertext.</p></div>
                </div>
            </article>

            <article class="concept-card">
                <span>Aspek 03</span>
                <h3>KUNCI</h3>
                <div class="rsa-compare-pair">
                    <div><strong>Hash</strong><p>Tidak memakai key.</p></div>
                    <div><strong>RSA</strong><p>Memakai public key dan private key.</p></div>
                </div>
            </article>
        </div>

        <div class="algorithm-grid-2 rsa-top-gap">
            <article class="concept-card">
                <span>Aspek 04</span>
                <h3>DEKRIPSI</h3>
                <div class="rsa-compare-pair">
                    <div><strong>Hash</strong><p>Tidak bisa didekripsi.</p></div>
                    <div><strong>RSA</strong><p>Bisa didekripsi memakai private key.</p></div>
                </div>
            </article>

            <article class="concept-card">
                <span>Aspek 05</span>
                <h3>TUJUAN</h3>
                <div class="rsa-compare-pair">
                    <div><strong>Hash</strong><p>Integritas data.</p></div>
                    <div><strong>RSA</strong><p>Kerahasiaan data dan autentikasi.</p></div>
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
                <h2>CARA KERJA RSA</h2>
            </div>
        </div>

        <div class="rsa-flow">
            <div class="hash-flow-item">
                <span>Step 01</span>
                <strong>Pilih p dan q</strong>
                <p>RSA dimulai dari dua bilangan prima yang berbeda.</p>
            </div>

            <div class="hash-flow-item">
                <span>Step 02</span>
                <strong>Hitung n</strong>
                <p>Nilai n diperoleh dari p × q dan menjadi bagian dari kedua kunci.</p>
            </div>

            <div class="hash-flow-item">
                <span>Step 03</span>
                <strong>Hitung φ(n)</strong>
                <p>Euler Totient digunakan untuk menentukan e dan d.</p>
            </div>

            <div class="hash-flow-item">
                <span>Step 04</span>
                <strong>Pilih e</strong>
                <p>Nilai e harus relatif prima terhadap φ(n).</p>
            </div>

            <div class="hash-flow-item">
                <span>Step 05</span>
                <strong>Hitung d</strong>
                <p>Nilai d adalah invers modular dari e terhadap φ(n).</p>
            </div>

            <div class="hash-flow-item">
                <span>Step 06</span>
                <strong>Public Key</strong>
                <p>Public Key dibentuk sebagai pasangan (e, n).</p>
            </div>

            <div class="hash-flow-item">
                <span>Step 07</span>
                <strong>Private Key</strong>
                <p>Private Key dibentuk sebagai pasangan (d, n).</p>
            </div>

            <div class="hash-flow-item">
                <span>Step 08</span>
                <strong>Encrypt & Decrypt</strong>
                <p>Plaintext dienkripsi dengan public key dan didekripsi dengan private key.</p>
            </div>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">CALCULATION</p>
                <h2>RUMUS DAN PERHITUNGAN RSA</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            <article class="hash-step-card">
                <span>Formula 01</span>
                <h3>MODULUS</h3>
                <p>Nilai n diperoleh dari perkalian p dan q.</p>
                <code class="rsa-formula-code">p = 61
q = 53
n = p × q
n = 61 × 53
n = 3233</code>
            </article>

            <article class="hash-step-card">
                <span>Formula 02</span>
                <h3>EULER TOTIENT</h3>
                <p>Nilai φ(n) dihitung dari p - 1 dan q - 1.</p>
                <code class="rsa-formula-code">φ(n) = (p - 1) × (q - 1)
φ(n) = 60 × 52
φ(n) = 3120</code>
            </article>

            <article class="hash-step-card">
                <span>Formula 03</span>
                <h3>PUBLIC EXPONENT</h3>
                <p>Nilai e harus relatif prima terhadap φ(n).</p>
                <code class="rsa-formula-code">1 &lt; e &lt; φ(n)
gcd(e, φ(n)) = 1
e = 17
gcd(17, 3120) = 1</code>
            </article>

            <article class="hash-step-card">
                <span>Formula 04</span>
                <h3>PRIVATE EXPONENT</h3>
                <p>Nilai d adalah invers modular dari e terhadap φ(n).</p>
                <code class="rsa-formula-code">d × e ≡ 1 mod φ(n)
d = e⁻¹ mod φ(n)
d = 2753
17 × 2753 mod 3120 = 1</code>
            </article>

            <article class="hash-step-card">
                <span>Formula 05</span>
                <h3>ENCRYPT</h3>
                <p>Plaintext numerik M diubah menjadi ciphertext C.</p>
                <code class="rsa-formula-code">Public Key = (e, n)
C = M^e mod n</code>
            </article>

            <article class="hash-step-card">
                <span>Formula 06</span>
                <h3>DECRYPT</h3>
                <p>Ciphertext C dikembalikan menjadi plaintext numerik M.</p>
                <code class="rsa-formula-code">Private Key = (d, n)
M = C^d mod n</code>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered" id="rsa-simulation">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">SIMULATION</p>
                <h2>GENERATE KEY, ENCRYPT, DAN DECRYPT</h2>
            </div>
        </div>

        <div class="rsa-form-grid">
            <form class="hash-form-panel rsa-form-panel" action="{{ route('rsa.process') }}" method="POST" data-rsa-form="keygen">
                @csrf
                <input type="hidden" name="mode" value="keygen">

                <p class="caption">KEY GENERATION</p>
                <h3>BUILD RSA KEY</h3>

                <div class="rsa-form-group">
                    <label for="rsa_p">Prime p</label>
                    <input id="rsa_p" type="number" name="p" class="rsa-input" value="61" min="3" max="9973">
                    <div class="rsa-error" data-rsa-error="p"></div>
                </div>

                <div class="rsa-form-group">
                    <label for="rsa_q">Prime q</label>
                    <input id="rsa_q" type="number" name="q" class="rsa-input" value="53" min="3" max="9973">
                    <div class="rsa-error" data-rsa-error="q"></div>
                </div>

                <div class="rsa-form-group">
                    <label for="rsa_e">Public Exponent e</label>
                    <input id="rsa_e" type="number" name="e" class="rsa-input" value="17" min="2" max="1000000">
                    <div class="rsa-error" data-rsa-error="e"></div>
                </div>

                <div class="rsa-button-row">
                    <button type="submit" class="button-primary" data-default-text="GENERATE KEY">GENERATE KEY</button>
                    <button type="button" class="button-secondary" data-rsa-reset>RESET</button>
                </div>

                <div class="rsa-feedback" data-rsa-feedback></div>
            </form>

            <form class="hash-form-panel rsa-form-panel" action="{{ route('rsa.process') }}" method="POST" data-rsa-form="encrypt">
                @csrf
                <input type="hidden" name="mode" value="encrypt">

                <p class="caption">ENCRYPT MODE</p>
                <h3>PLAINTEXT TO CIPHERTEXT</h3>

                <div class="rsa-form-group">
                    <label for="rsa_plaintext">Plaintext</label>
                    <textarea id="rsa_plaintext" name="plaintext" class="rsa-textarea" placeholder="Masukkan plaintext...">RSA</textarea>
                    <div class="rsa-error" data-rsa-error="plaintext"></div>
                </div>

                <div class="rsa-form-group">
                    <label for="rsa_public_e">Public e</label>
                    <input id="rsa_public_e" type="number" name="public_e" class="rsa-input" value="17">
                    <div class="rsa-error" data-rsa-error="public_e"></div>
                </div>

                <div class="rsa-form-group">
                    <label for="rsa_public_n">Public n</label>
                    <input id="rsa_public_n" type="number" name="public_n" class="rsa-input" value="3233">
                    <div class="rsa-error" data-rsa-error="public_n"></div>
                </div>

                <div class="rsa-button-row">
                    <button type="submit" class="button-primary" data-default-text="ENCRYPT RSA">ENCRYPT RSA</button>
                </div>

                <div class="rsa-feedback" data-rsa-feedback></div>
            </form>

            <form class="hash-form-panel rsa-form-panel" action="{{ route('rsa.process') }}" method="POST" data-rsa-form="decrypt">
                @csrf
                <input type="hidden" name="mode" value="decrypt">

                <p class="caption">DECRYPT MODE</p>
                <h3>CIPHERTEXT TO PLAINTEXT</h3>

                <div class="rsa-form-group">
                    <label for="rsa_ciphertext">Ciphertext Numbers</label>
                    <textarea id="rsa_ciphertext" name="ciphertext" class="rsa-textarea" placeholder="Contoh: 1859 2680 2790"></textarea>
                    <div class="rsa-error" data-rsa-error="ciphertext"></div>
                </div>

                <div class="rsa-form-group">
                    <label for="rsa_private_d">Private d</label>
                    <input id="rsa_private_d" type="number" name="private_d" class="rsa-input" value="2753">
                    <div class="rsa-error" data-rsa-error="private_d"></div>
                </div>

                <div class="rsa-form-group">
                    <label for="rsa_private_n">Private n</label>
                    <input id="rsa_private_n" type="number" name="private_n" class="rsa-input" value="3233">
                    <div class="rsa-error" data-rsa-error="private_n"></div>
                </div>

                <div class="rsa-button-row">
                    <button type="submit" class="button-primary" data-default-text="DECRYPT RSA">DECRYPT RSA</button>
                </div>

                <div class="rsa-feedback" data-rsa-feedback></div>
            </form>
        </div>

        <div class="rsa-output-area" data-rsa-result-area></div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">REAL WORLD USE</p>
                <h2>PENGAPLIKASIAN RSA</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            <article class="application-card">
                <span>01</span>
                <h3>SECURE COMMUNICATION</h3>
                <p>RSA digunakan dalam konsep komunikasi aman berbasis pasangan kunci.</p>
            </article>

            <article class="application-card">
                <span>02</span>
                <h3>DIGITAL SIGNATURE</h3>
                <p>RSA dapat digunakan dalam tanda tangan digital untuk membantu verifikasi keaslian data.</p>
            </article>

            <article class="application-card">
                <span>03</span>
                <h3>KEY EXCHANGE</h3>
                <p>RSA dapat membantu proses pertukaran kunci dalam sistem keamanan.</p>
            </article>

            <article class="application-card">
                <span>04</span>
                <h3>CERTIFICATE SYSTEM</h3>
                <p>RSA banyak dibahas dalam ekosistem sertifikat digital dan keamanan web.</p>
            </article>

            <article class="application-card">
                <span>05</span>
                <h3>AUTHENTICATION</h3>
                <p>RSA dapat digunakan untuk membantu verifikasi identitas digital.</p>
            </article>

            <article class="application-card">
                <span>06</span>
                <h3>DATA PROTECTION</h3>
                <p>RSA cocok untuk data kecil atau kunci rahasia, bukan file besar secara langsung.</p>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered" id="rsa-game">
    <div class="container algorithm-grid-2">
        <div>
            <p class="caption">MINI GAME</p>
            <h2>RSA KEY BUILDER</h2>
            <p class="algorithm-hero-text" style="margin-left:0;">
                Pilih nilai n, φ(n), dan d yang benar berdasarkan nilai p, q, dan e. Game ini melatih logika pembentukan kunci RSA tanpa membuat soal terlalu sulit.
            </p>
        </div>

        <div class="hash-game-panel" data-rsa-game>
            <p class="caption">CHALLENGE</p>
            <h3 data-game-title>RSA BUILDER</h3>

            <div class="game-dashboard">
                <div class="game-stat">
                    <span>Score</span>
                    <strong data-game-score>0</strong>
                </div>

                <div class="game-stat">
                    <span>Round</span>
                    <strong data-game-round>1</strong>
                </div>

                <div class="game-stat">
                    <span>Given</span>
                    <strong data-game-given>p, q, e</strong>
                </div>
            </div>

            <p class="rsa-warning" data-game-hint>Hitung nilai n, φ(n), dan d.</p>

            <div class="rsa-game-grid" data-game-options></div>

            <div class="rsa-button-row">
                <button type="button" class="button-primary" data-check-game>CHECK ANSWER</button>
                <button type="button" class="button-secondary" data-fill-keygen>USE IN GENERATOR</button>
                <button type="button" class="button-secondary" data-next-game>SKIP</button>
            </div>

            <div class="rsa-game-feedback" data-game-feedback></div>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">LIMITATION</p>
                <h2>BATASAN HALAMAN RSA</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            <article class="concept-card">
                <span>01</span>
                <h3>DEMO ONLY</h3>
                <p>Halaman RSA ini digunakan untuk pembelajaran, bukan sistem keamanan produksi.</p>
            </article>

            <article class="concept-card">
                <span>02</span>
                <h3>SMALL PRIME</h3>
                <p>Bilangan prima kecil digunakan agar proses hitung mudah dipahami.</p>
            </article>

            <article class="concept-card">
                <span>03</span>
                <h3>NO OAEP</h3>
                <p>Simulasi ini memakai RSA dasar dan belum menerapkan padding seperti OAEP.</p>
            </article>

            <article class="concept-card">
                <span>04</span>
                <h3>LIMITED INPUT</h3>
                <p>Plaintext dibatasi agar proses simulasi tetap ringan dan mudah dibaca.</p>
            </article>

            <article class="concept-card">
                <span>05</span>
                <h3>n MUST BE LARGER</h3>
                <p>Nilai n harus lebih besar dari nilai byte plaintext yang dienkripsi.</p>
            </article>

            <article class="concept-card">
                <span>06</span>
                <h3>PRIVATE KEY</h3>
                <p>Private key harus dirahasiakan dan tidak boleh dibagikan kepada pihak lain.</p>
            </article>
        </div>
    </div>
</section>

<script>
    const rsaChallenges = @json($gameChallenges ?? []);
    const rsaForms = document.querySelectorAll('[data-rsa-form]');
    const rsaResultArea = document.querySelector('[data-rsa-result-area]');
    const rsaResetButton = document.querySelector('[data-rsa-reset]');

    rsaForms.forEach((form) => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            await submitRsaForm(form);
        });
    });

    if (rsaResetButton) {
        rsaResetButton.addEventListener('click', () => {
            setInputValue('#rsa_p', 61);
            setInputValue('#rsa_q', 53);
            setInputValue('#rsa_e', 17);
            setInputValue('#rsa_plaintext', 'RSA');
            setInputValue('#rsa_public_e', 17);
            setInputValue('#rsa_public_n', 3233);
            setInputValue('#rsa_ciphertext', '');
            setInputValue('#rsa_private_d', 2753);
            setInputValue('#rsa_private_n', 3233);
            clearRsaErrors();
            clearRsaFeedback();

            if (rsaResultArea) {
                rsaResultArea.innerHTML = '';
            }
        });
    }

    document.addEventListener('click', async (event) => {
        const copyButton = event.target.closest('[data-rsa-copy]');

        if (!copyButton) {
            return;
        }

        const target = document.querySelector(copyButton.dataset.rsaCopy);
        const feedback = copyButton.parentElement.querySelector('[data-rsa-copy-feedback]');

        if (!target) {
            return;
        }

        try {
            await navigator.clipboard.writeText(target.textContent.trim());

            if (feedback) {
                feedback.textContent = 'COPIED';
            }
        } catch (error) {
            if (feedback) {
                feedback.textContent = 'COPY FAILED';
            }
        }

        window.setTimeout(() => {
            if (feedback) {
                feedback.textContent = '';
            }
        }, 1600);
    });

    async function submitRsaForm(form) {
        const submitButton = form.querySelector('[type="submit"]');
        const feedback = form.querySelector('[data-rsa-feedback]');
        const defaultText = submitButton?.dataset.defaultText || submitButton?.textContent || 'PROCESS';

        clearRsaErrors(form);

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
                    showRsaErrors(form, data.errors);

                    if (feedback) {
                        feedback.textContent = data.message || 'CHECK INPUT FIELD.';
                    }

                    return;
                }

                throw new Error(data.message || 'Request failed.');
            }

            renderRsaResult(data.rsaResult);

            if (feedback) {
                feedback.textContent = 'RSA PROCESS COMPLETED.';
            }

            rsaResultArea?.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        } catch (error) {
            if (feedback) {
                feedback.textContent = 'REQUEST FAILED. CHECK INPUT VALUE.';
            }
        } finally {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = defaultText;
            }
        }
    }

    function renderRsaResult(result) {
        if (!rsaResultArea || !result) {
            return;
        }

        if (result.mode === 'keygen') {
            renderKeygenResult(result);
            return;
        }

        if (result.mode === 'encrypt') {
            renderEncryptResult(result);
            return;
        }

        if (result.mode === 'decrypt') {
            renderDecryptResult(result);
        }
    }

    function renderKeygenResult(result) {
        rsaResultArea.innerHTML = `
            <div class="hash-output-panel algorithm-output-panel">
                <p class="caption">KEY OUTPUT</p>
                <h3>RSA KEY GENERATED</h3>

                <div class="rsa-result-list">
                    ${renderResultRow('n', result.n)}
                    ${renderResultRow('φ(n)', result.phi)}
                    ${renderResultRow('Public Key', result.public_key)}
                    ${renderResultRow('Private Key', result.private_key)}
                    ${renderResultRow('Check', `${result.e} × ${result.d} mod ${result.phi} = ${result.mod_inverse_check}`)}
                    ${renderCodeRow('Steps', result.steps.join('\n'))}
                </div>

                <p class="rsa-note">${escapeHtml(result.note)}</p>

                <div class="rsa-button-row">
                    <button type="button" class="button-secondary" data-use-public-key="${result.e}|${result.n}">USE PUBLIC KEY</button>
                    <button type="button" class="button-secondary" data-use-private-key="${result.d}|${result.n}">USE PRIVATE KEY</button>
                    <button type="button" class="button-secondary" data-rsa-copy="#rsa-key-output">COPY KEYS</button>
                </div>

                <code class="rsa-code-output" id="rsa-key-output" style="display:none;">Public Key: ${escapeHtml(result.public_key)}\nPrivate Key: ${escapeHtml(result.private_key)}</code>
                <div class="rsa-copy-feedback" data-rsa-copy-feedback></div>
            </div>
        `;

        bindUseKeyButtons();
        reinitializeMotion();
    }

    function renderEncryptResult(result) {
        const blocks = result.blocks.map((block) => {
            return `#${block.index} ${escapeHtml(block.character)} → ASCII ${block.ascii} → ${block.cipher}\n${escapeHtml(block.formula)}`;
        }).join('\n\n');

        rsaResultArea.innerHTML = `
            <div class="hash-output-panel algorithm-output-panel">
                <p class="caption">ENCRYPT OUTPUT</p>
                <h3>CIPHERTEXT GENERATED</h3>

                <div class="rsa-result-list">
                    ${renderResultRow('Public Key', result.public_key)}
                    ${renderResultRow('Input Length', `${result.input_characters} characters / ${result.input_bytes} bytes`)}
                    ${renderCodeRow('Ciphertext', result.ciphertext, 'rsa-cipher-output')}
                    ${renderCodeRow('Block Detail', blocks)}
                </div>

                <p class="rsa-note">${escapeHtml(result.note)}</p>

                <div class="rsa-button-row">
                    <button type="button" class="button-secondary" data-fill-decrypt="${escapeHtml(result.ciphertext)}|${result.n}">SEND TO DECRYPT</button>
                    <button type="button" class="button-secondary" data-rsa-copy="#rsa-cipher-output">COPY CIPHERTEXT</button>
                </div>

                <div class="rsa-copy-feedback" data-rsa-copy-feedback></div>
            </div>
        `;

        bindFillDecryptButton();
        reinitializeMotion();
    }

    function renderDecryptResult(result) {
        const blocks = result.blocks.map((block) => {
            return `#${block.index} ${block.cipher} → ASCII ${block.ascii} → ${escapeHtml(block.character)}\n${escapeHtml(block.formula)}`;
        }).join('\n\n');

        rsaResultArea.innerHTML = `
            <div class="hash-output-panel algorithm-output-panel">
                <p class="caption">DECRYPT OUTPUT</p>
                <h3>PLAINTEXT RECOVERED</h3>

                <div class="rsa-result-list">
                    ${renderResultRow('Private Key', result.private_key)}
                    ${renderCodeRow('Plaintext', result.plaintext, 'rsa-plain-output')}
                    ${renderCodeRow('Ciphertext', result.ciphertext)}
                    ${renderCodeRow('Block Detail', blocks)}
                </div>

                <p class="rsa-note">${escapeHtml(result.note)}</p>

                <button type="button" class="button-secondary" data-rsa-copy="#rsa-plain-output">COPY PLAINTEXT</button>
                <div class="rsa-copy-feedback" data-rsa-copy-feedback></div>
            </div>
        `;

        reinitializeMotion();
    }

    function renderResultRow(label, value) {
        return `
            <div class="rsa-result-row">
                <span>${escapeHtml(label)}</span>
                <strong>${escapeHtml(value)}</strong>
            </div>
        `;
    }

    function renderCodeRow(label, value, id = '') {
        const idAttribute = id ? ` id="${id}"` : '';

        return `
            <div class="rsa-result-row">
                <span>${escapeHtml(label)}</span>
                <code class="rsa-code-output"${idAttribute}>${escapeHtml(value)}</code>
            </div>
        `;
    }

    function bindUseKeyButtons() {
        document.querySelector('[data-use-public-key]')?.addEventListener('click', (event) => {
            const [e, n] = event.currentTarget.dataset.usePublicKey.split('|');
            setInputValue('#rsa_public_e', e);
            setInputValue('#rsa_public_n', n);
        });

        document.querySelector('[data-use-private-key]')?.addEventListener('click', (event) => {
            const [d, n] = event.currentTarget.dataset.usePrivateKey.split('|');
            setInputValue('#rsa_private_d', d);
            setInputValue('#rsa_private_n', n);
        });
    }

    function bindFillDecryptButton() {
        document.querySelector('[data-fill-decrypt]')?.addEventListener('click', (event) => {
            const [ciphertext, n] = event.currentTarget.dataset.fillDecrypt.split('|');
            setInputValue('#rsa_ciphertext', ciphertext);
            setInputValue('#rsa_private_n', n);

            document.querySelector('[data-rsa-form="decrypt"]')?.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        });
    }

    function showRsaErrors(form, errors) {
        Object.entries(errors).forEach(([field, messages]) => {
            const target = form.querySelector(`[data-rsa-error="${field}"]`) || form.querySelector('[data-rsa-feedback]');

            if (target) {
                target.textContent = messages[0];
            }
        });
    }

    function clearRsaErrors(form = document) {
        form.querySelectorAll('[data-rsa-error]').forEach((element) => {
            element.textContent = '';
        });
    }

    function clearRsaFeedback() {
        document.querySelectorAll('[data-rsa-feedback]').forEach((element) => {
            element.textContent = '';
        });
    }

    function setInputValue(selector, value) {
        const input = document.querySelector(selector);

        if (input) {
            input.value = value;
        }
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

    function reinitializeMotion() {
        requestAnimationFrame(() => {
            if (typeof initCyberCards === 'function') {
                initCyberCards();
            }
        });
    }

    const rsaGame = document.querySelector('[data-rsa-game]');

    if (rsaGame && rsaChallenges.length > 0) {
        initRsaGame();
    }

    function initRsaGame() {
        const title = rsaGame.querySelector('[data-game-title]');
        const score = rsaGame.querySelector('[data-game-score]');
        const round = rsaGame.querySelector('[data-game-round]');
        const given = rsaGame.querySelector('[data-game-given]');
        const hint = rsaGame.querySelector('[data-game-hint]');
        const options = rsaGame.querySelector('[data-game-options]');
        const feedback = rsaGame.querySelector('[data-game-feedback]');
        const checkButton = rsaGame.querySelector('[data-check-game]');
        const nextButton = rsaGame.querySelector('[data-next-game]');
        const fillButton = rsaGame.querySelector('[data-fill-keygen]');

        let currentChallenge = null;
        let selected = { n: null, phi: null, d: null };
        let currentScore = 0;
        let currentRound = 1;
        let lastChallengeId = null;
        let challengeQueue = shuffleArray(rsaChallenges);

        function getNextChallenge() {
            if (challengeQueue.length === 0) {
                challengeQueue = shuffleArray(rsaChallenges);
            }

            let nextChallenge = challengeQueue.shift();

            if (rsaChallenges.length > 1 && lastChallengeId !== null && nextChallenge.id === lastChallengeId) {
                challengeQueue.push(nextChallenge);
                nextChallenge = challengeQueue.shift();
            }

            lastChallengeId = nextChallenge.id;
            return nextChallenge;
        }

        function loadChallenge() {
            currentChallenge = getNextChallenge();
            selected = { n: null, phi: null, d: null };

            title.textContent = currentChallenge.title;
            score.textContent = currentScore;
            round.textContent = currentRound;
            given.textContent = `p=${currentChallenge.p}, q=${currentChallenge.q}, e=${currentChallenge.e}`;
            hint.textContent = currentChallenge.hint;
            feedback.textContent = '';

            options.innerHTML = [
                renderOptionGroup('n', 'Choose n = p × q', currentChallenge.n_options),
                renderOptionGroup('phi', 'Choose φ(n)', currentChallenge.phi_options),
                renderOptionGroup('d', 'Choose d', currentChallenge.d_options),
            ].join('');

            reinitializeMotion();
        }

        function renderOptionGroup(key, label, values) {
            return `
                <div class="game-candidate-card" data-option-group="${key}">
                    <span>${escapeHtml(label)}</span>
                    <h3>${key === 'phi' ? 'φ(n)' : key.toUpperCase()}</h3>
                    <div class="rsa-option-buttons">
                        ${shuffleArray(values).map((value) => `
                            <button type="button" class="rsa-option-button" data-option-key="${key}" data-option-value="${value}">
                                ${value}
                            </button>
                        `).join('')}
                    </div>
                </div>
            `;
        }

        options.addEventListener('click', (event) => {
            const button = event.target.closest('[data-option-key]');

            if (!button) {
                return;
            }

            const key = button.dataset.optionKey;
            selected[key] = Number(button.dataset.optionValue);

            options.querySelectorAll(`[data-option-key="${key}"]`).forEach((option) => {
                option.classList.toggle('is-selected', option === button);
            });
        });

        checkButton.addEventListener('click', () => {
            if (selected.n === null || selected.phi === null || selected.d === null) {
                feedback.textContent = 'PILIH n, φ(n), DAN d TERLEBIH DAHULU.';
                return;
            }

            const isCorrect = selected.n === currentChallenge.n && selected.phi === currentChallenge.phi && selected.d === currentChallenge.d;

            if (isCorrect) {
                currentScore += 15;
                feedback.textContent = 'CORRECT. NEW RSA CHALLENGE LOADING...';
            } else {
                currentScore = Math.max(0, currentScore - 5);
                feedback.textContent = `WRONG. ANSWER: n=${currentChallenge.n}, φ(n)=${currentChallenge.phi}, d=${currentChallenge.d}. NEW CHALLENGE LOADING...`;
            }

            score.textContent = currentScore;
            currentRound += 1;
            window.setTimeout(loadChallenge, 1800);
        });

        nextButton.addEventListener('click', () => {
            currentRound += 1;
            feedback.textContent = 'CHALLENGE SKIPPED.';
            window.setTimeout(loadChallenge, 500);
        });

        fillButton.addEventListener('click', () => {
            setInputValue('#rsa_p', currentChallenge.p);
            setInputValue('#rsa_q', currentChallenge.q);
            setInputValue('#rsa_e', currentChallenge.e);
            document.querySelector('#rsa-simulation')?.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });

        loadChallenge();
    }
</script>
@endsection
