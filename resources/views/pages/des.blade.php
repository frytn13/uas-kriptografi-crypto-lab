@extends('layouts.app')

@section('title', 'Crypto Lab | DES Algorithm')

@section('content')
    <style>
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
    </style>

    @php
        $encryptPlaintext = old('plaintext', $desResult['plaintext'] ?? 'SURABAYA');
        $encryptKey = old('key', $desResult['key'] ?? 'UKMC2026');
        $decryptCiphertext = old('ciphertext_binary', $desResult['ciphertext_binary'] ?? '');
    @endphp

    <div class="des-page">
        <section class="algorithm-hero">
            <div class="container">
                <div class="algorithm-hero-content">
                    <p class="caption">ALGORITHM MODULE 03</p>
                    <h1>DES ALGORITHM</h1>
                    <p class="algorithm-hero-text">
                        DES adalah algoritma kriptografi simetris berbasis block cipher. Data diproses dalam blok 64-bit,
                        memakai effective key 56-bit, dan melalui 16 Feistel round untuk menghasilkan ciphertext.
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
                        DES pernah menjadi standar penting dalam kriptografi simetris. Algoritma ini banyak dipelajari
                        karena memperkenalkan konsep block cipher, Feistel Network, key schedule, permutasi, substitusi, dan
                        penggunaan subkey pada setiap round.
                    </p>
                    <p>
                        Walaupun ukuran kunci DES sudah tidak cukup aman untuk kebutuhan modern, alurnya tetap penting
                        sebagai dasar untuk memahami algoritma block cipher lain seperti Triple DES dan beberapa konsep yang
                        juga muncul pada algoritma modern.
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
                            <div><strong>Kunci</strong>
                                <p>Tidak memakai key.</p>
                            </div>
                            <div><strong>Dekripsi</strong>
                                <p>Tidak bisa didekripsi.</p>
                            </div>
                            <div><strong>Tujuan</strong>
                                <p>Menjaga integritas data.</p>
                            </div>
                        </div>
                    </article>

                    <article class="des-compare-card algorithm-card">
                        <span>RSA</span>
                        <h3>Asymmetric Cryptography</h3>
                        <div class="des-compare-pair">
                            <div><strong>Kunci</strong>
                                <p>Memakai public key dan private key.</p>
                            </div>
                            <div><strong>Dekripsi</strong>
                                <p>Bisa dengan private key.</p>
                            </div>
                            <div><strong>Tujuan</strong>
                                <p>Kerahasiaan dan tanda tangan digital.</p>
                            </div>
                        </div>
                    </article>

                    <article class="des-compare-card algorithm-card">
                        <span>DES</span>
                        <h3>Symmetric Block Cipher</h3>
                        <div class="des-compare-pair">
                            <div><strong>Kunci</strong>
                                <p>Memakai satu secret key.</p>
                            </div>
                            <div><strong>Dekripsi</strong>
                                <p>Bisa dengan key yang sama.</p>
                            </div>
                            <div><strong>Tujuan</strong>
                                <p>Menjaga kerahasiaan data.</p>
                            </div>
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
                    <article class="formula-card">
                        <span>Formula 01</span>
                        <h3>FEISTEL LEFT</h3>
                        <code class="algorithm-code-output">Lᵢ = Rᵢ₋₁</code>
                    </article>

                    <article class="formula-card">
                        <span>Formula 02</span>
                        <h3>FEISTEL RIGHT</h3>
                        <code class="algorithm-code-output">Rᵢ = Lᵢ₋₁ XOR F(Rᵢ₋₁, Kᵢ)</code>
                    </article>

                    <article class="formula-card">
                        <span>Formula 03</span>
                        <h3>ROUND FUNCTION</h3>
                        <code class="algorithm-code-output">F(R, K) = P(S(E(R) XOR K))</code>
                    </article>
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
                    <form class="algorithm-form-panel" action="{{ route('des.process') }}" method="POST"
                        data-des-form="encrypt">
                        @csrf
                        <input type="hidden" name="mode" value="encrypt">

                        <p class="caption">ENCRYPT MODE</p>
                        <h3>PLAINTEXT TO CIPHERTEXT</h3>

                        <div class="algorithm-form-group">
                            <label for="des_plaintext">Plaintext Maksimal 8 Karakter</label>
                            <input id="des_plaintext" type="text" name="plaintext" class="algorithm-input"
                                value="{{ $encryptPlaintext }}" maxlength="8" placeholder="SURABAYA">
                            <div class="des-error" data-form-error="plaintext"></div>
                        </div>

                        <div class="algorithm-form-group">
                            <label for="des_encrypt_key">Key Tepat 8 Karakter</label>
                            <input id="des_encrypt_key" type="text" name="key" class="algorithm-input"
                                value="{{ $encryptKey }}" maxlength="8" placeholder="UKMC2026">
                            <div class="des-error" data-form-error="key"></div>
                        </div>

                        <div class="algorithm-button-row">
                            <button type="submit" class="button-primary" data-default-text="ENCRYPT DES">ENCRYPT
                                DES</button>
                            <button type="button" class="button-secondary" data-des-reset>RESET</button>
                        </div>

                        <div class="des-feedback" data-form-feedback></div>
                    </form>

                    <form class="algorithm-form-panel" action="{{ route('des.process') }}" method="POST"
                        data-des-form="decrypt">
                        @csrf
                        <input type="hidden" name="mode" value="decrypt">

                        <p class="caption">DECRYPT MODE</p>
                        <h3>CIPHERTEXT TO PLAINTEXT</h3>

                        <div class="algorithm-form-group">
                            <label for="des_ciphertext_binary">Ciphertext Biner 64 Bit</label>
                            <input id="des_ciphertext_binary" type="text" name="ciphertext_binary" class="algorithm-input"
                                value="{{ $decryptCiphertext }}" maxlength="64"
                                placeholder="0011000010000111011000000011001001111000100000010100111110111000">
                            <div class="des-error" data-form-error="ciphertext_binary"></div>
                        </div>
                        <div class="algorithm-form-group">
                            <label for="des_decrypt_key">Key Tepat 8 Karakter</label>
                            <input id="des_decrypt_key" type="text" name="key" class="algorithm-input"
                                value="{{ $encryptKey }}" maxlength="8" placeholder="UKMC2026">
                            <div class="des-error" data-form-error="key"></div>
                        </div>

                        <div class="algorithm-button-row">
                            <button type="submit" class="button-primary" data-default-text="DECRYPT DES">DECRYPT
                                DES</button>
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
                        Susun urutan proses DES dengan benar. Game ini dibuat ringan agar pengguna memahami alur DES tanpa
                        harus menghitung seluruh tabel permutasi secara manual.
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
        const desChallenges = @json($gameChallenges);
        const desForms = document.querySelectorAll('[data-des-form]');
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
            if (!desResultArea) {
                return;
            }

            const isEncrypt = result.mode === 'encrypt';
            const primaryLabel = isEncrypt ? 'Ciphertext Biner' : 'Plaintext Result';
            const primaryValue = isEncrypt ? result.ciphertext_binary : result.plaintext;
            const primaryId = isEncrypt ? 'des-cipher-output' : 'des-plain-output';

            const rows = isEncrypt
                ? [
                    ['Mode', result.mode_label],
                    ['Plaintext', result.plaintext],
                    ['Padded Plaintext', result.padded_plaintext],
                    ['Key', result.key],
                    ['Plaintext Biner', result.plaintext_binary],
                    ['Key Biner', result.key_binary],
                    ['Initial Permutation', result.initial_permutation_binary],
                    ['Final Swap Block', result.final_permutation_binary],
                    [primaryLabel, primaryValue, primaryId],
                    ['Round Count', `${result.round_count} rounds`],
                ]
                : [
                    ['Mode', result.mode_label],
                    ['Ciphertext Biner', result.ciphertext_binary],
                    ['Key', result.key],
                    ['Key Biner', result.key_binary],
                    ['Plaintext Biner', result.plaintext_binary],
                    ['Initial Permutation', result.initial_permutation_binary],
                    ['Final Swap Block', result.final_permutation_binary],
                    [primaryLabel, primaryValue || '[EMPTY RESULT]', primaryId],
                    ['Round Count', `${result.round_count} rounds`],
                ];

            desResultArea.innerHTML = `
            <div class="algorithm-output-panel" style="margin-top: var(--space-xl);">
                <p class="caption">DES OUTPUT</p>
                <h3>${escapeHtml(result.mode_label)}</h3>

                <div class="algorithm-result-list">
                    ${rows.map(([label, value, id]) => `
                        <div class="algorithm-result-row">
                            <span>${escapeHtml(label)}</span>
                            <code class="algorithm-code-output" ${id ? `id="${id}"` : ''}>${escapeHtml(value)}</code>
                        </div>
                    `).join('')}
                </div>

                <p class="algorithm-note">${escapeHtml(result.note)}</p>

                <div class="des-output-actions">
                    <button type="button" class="button-secondary" data-copy-value="#${primaryId}">
                        COPY ${isEncrypt ? 'CIPHERTEXT' : 'PLAINTEXT'}
                    </button>

                    ${isEncrypt ? `
                        <button type="button" class="button-secondary" data-use-des-decrypt data-ciphertext="${escapeHtml(result.ciphertext_binary)}" data-key="${escapeHtml(result.key)}">
                            USE FOR DECRYPT
                        </button>
                    ` : ''}
                </div>

                <div class="des-feedback" data-copy-feedback></div>

                <div class="des-round-heading">
                    <p class="caption">ROUND SUMMARY</p>
                    <h3>16 FEISTEL ROUNDS</h3>
                </div>

                <div class="des-round-grid">
                    ${result.rounds.map((round) => `
                        <article class="des-round-card algorithm-card">
                            <span>Round ${round.round}</span>
                            <strong>K${round.round}</strong>
                            <code>Subkey: ${escapeHtml(round.subkey_binary)}</code>
                            <code>F: ${escapeHtml(round.function_binary)}</code>
                            <code>L: ${escapeHtml(round.left_binary)}</code>
                            <code>R: ${escapeHtml(round.right_binary)}</code>
                        </article>
                    `).join('')}
                </div>
            </div>
        `;

            requestAnimationFrame(() => {
                if (typeof initCyberCards === 'function') {
                    initCyberCards();
                }
            });
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