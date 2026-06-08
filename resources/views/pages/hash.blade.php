@extends('layouts.app')

@section('title', 'Crypto Lab | Hash Function')

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
            max-width: 860px;
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
        .hash-result-row span,
        .hash-step-card span,
        .game-stat span,
        .game-candidate-card span {
            color: var(--color-muted);
            font-family: var(--font-mono);
            font-size: 11px;
            line-height: 1.4;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .algorithm-meta-item strong,
        .hash-result-row strong,
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

        .algorithm-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            border-top: 1px solid var(--color-hairline);
            border-left: 1px solid var(--color-hairline);
        }

        .algorithm-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            border-top: 1px solid var(--color-hairline);
            border-left: 1px solid var(--color-hairline);
        }

        .concept-card,
        .formula-card,
        .application-card,
        .game-card,
        .hash-step-card {
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
        .hash-step-card h3 {
            margin-top: var(--space-xl);
            margin-bottom: var(--space-lg);
        }

        .concept-card p,
        .formula-card p,
        .application-card p,
        .game-card p,
        .hash-step-card p {
            margin: 0;
            color: var(--color-body);
        }

        .hash-flow {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            border-top: 1px solid var(--color-hairline);
            border-left: 1px solid var(--color-hairline);
        }

        .hash-flow-item {
            min-height: 190px;
            padding: var(--space-lg);
            border-right: 1px solid var(--color-hairline);
            border-bottom: 1px solid var(--color-hairline);
        }

        .hash-flow-item span {
            display: block;
            margin-bottom: var(--space-xl);
            color: var(--color-muted);
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .hash-flow-item strong {
            color: var(--color-primary);
            font-family: var(--font-display);
            font-size: 22px;
            font-weight: 400;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .hash-form-panel,
        .hash-output-panel,
        .hash-game-panel {
            position: relative;
            overflow: visible !important;
            border: 1px solid var(--color-hairline);
            padding: var(--space-lg);
        }

        .hash-form-panel.has-open-select {
            z-index: 120 !important;
        }

        .hash-output-panel,
        .hash-game-panel {
            z-index: 12;
        }

        .hash-form-group {
            position: relative;
            z-index: 5;
            margin-bottom: var(--space-lg);
        }

        .hash-form-group.has-open-select {
            z-index: 150;
        }

        .hash-form-group label {
            display: block;
            margin-bottom: var(--space-sm);
            color: var(--color-muted);
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .hash-textarea,
        .hash-select,
        .hash-input {
            width: 100%;
            border: 1px solid var(--color-hairline-strong);
            background: rgba(0, 0, 0, 0.72);
            color: var(--color-primary);
            outline: none;
            font-family: var(--font-mono);
            font-size: 14px;
            line-height: 1.7;
        }

        .hash-textarea {
            min-height: 180px;
            resize: vertical;
            padding: var(--space-lg);
        }

        .hash-select,
        .hash-input {
            min-height: 48px;
            padding: 0 var(--space-lg);
        }

        .hash-textarea:focus,
        .hash-select:focus,
        .hash-input:focus {
            border-color: rgba(124, 255, 178, 0.58);
        }

        .hash-select-shell {
            position: relative;
            z-index: 20;
            width: 100%;
        }

        .hash-select-shell.is-open {
            z-index: 200;
        }

        .hash-native-select {
            position: absolute;
            width: 1px;
            height: 1px;
            opacity: 0;
            pointer-events: none;
        }

        .hash-select-trigger {
            position: relative;
            z-index: 2;
            width: 100%;
            min-height: 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: var(--space-md);
            border: 1px solid var(--color-hairline-strong);
            background:
                radial-gradient(circle at 50% 0%, rgba(124, 255, 178, 0.055), transparent 44%),
                rgba(0, 0, 0, 0.72);
            color: var(--color-primary);
            cursor: pointer;
            padding: 0 var(--space-lg);
            font-family: var(--font-mono);
            font-size: 14px;
            line-height: 1.7;
            letter-spacing: 1px;
            text-align: left;
            text-transform: uppercase;
        }

        .hash-select-trigger:hover,
        .hash-select-shell.is-open .hash-select-trigger {
            border-color: rgba(124, 255, 178, 0.68);
        }

        .hash-select-label {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .hash-select-caret {
            flex: 0 0 auto;
            color: var(--color-link);
            font-size: 14px;
            transition: transform 180ms ease;
        }

        .hash-select-shell.is-open .hash-select-caret {
            transform: rotate(180deg);
        }

        .hash-select-menu {
            position: absolute;
            left: 0;
            right: 0;
            top: calc(100% + 8px);
            z-index: 300;
            display: grid;
            gap: 1px;
            max-height: 260px;
            overflow-y: auto;
            border: 1px solid rgba(124, 255, 178, 0.42);
            background: rgba(0, 8, 3, 0.98);
            padding: 6px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            pointer-events: none;
            transition:
                opacity 160ms ease,
                transform 160ms ease,
                visibility 160ms ease;
        }

        .hash-select-shell.is-open .hash-select-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            pointer-events: auto;
        }

        .hash-select-option {
            min-height: 44px;
            border: 1px solid transparent;
            background: rgba(255, 255, 255, 0.025);
            color: var(--color-body-strong);
            cursor: pointer;
            padding: 0 var(--space-md);
            font-family: var(--font-mono);
            font-size: 13px;
            letter-spacing: 1px;
            text-align: left;
            text-transform: uppercase;
        }

        .hash-select-option:hover {
            border-color: rgba(124, 255, 178, 0.42);
            background: rgba(124, 255, 178, 0.08);
            color: var(--color-primary);
        }

        .hash-select-option.is-selected {
            border-color: rgba(124, 255, 178, 0.68);
            background: rgba(124, 255, 178, 0.14);
            color: #ffffff;
        }

        .hash-select-option span {
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            letter-spacing: inherit;
            text-transform: inherit;
        }

        .hash-select-menu::-webkit-scrollbar {
            width: 6px;
        }

        .hash-select-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.04);
        }

        .hash-select-menu::-webkit-scrollbar-thumb {
            background: rgba(124, 255, 178, 0.42);
        }

        .hash-error {
            margin-top: var(--space-sm);
            min-height: 18px;
            color: #ffb7b7;
            font-family: var(--font-mono);
            font-size: 12px;
            letter-spacing: 1px;
        }

        .hash-result-list {
            border-top: 1px solid var(--color-hairline);
        }

        .hash-result-row {
            display: grid;
            grid-template-columns: 0.72fr 1.28fr;
            gap: var(--space-lg);
            padding: var(--space-lg) 0;
            border-bottom: 1px solid var(--color-hairline);
        }

        .hash-code-output {
            display: block;
            width: 100%;
            overflow-wrap: anywhere;
            color: var(--color-link);
            font-family: var(--font-mono);
            font-size: 13px;
            line-height: 1.8;
        }

        .hash-note {
            margin-top: var(--space-lg);
            color: var(--color-body);
            font-size: 17px;
        }

        .hash-button-row,
        .game-choice-grid {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-md);
            margin-top: var(--space-xl);
        }

        .hash-copy-feedback,
        .game-feedback,
        .hash-ajax-feedback {
            margin-top: var(--space-md);
            min-height: 24px;
            color: var(--color-link);
            font-family: var(--font-mono);
            font-size: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .hash-warning {
            border-left: 1px solid rgba(124, 255, 178, 0.55);
            padding-left: var(--space-lg);
            color: var(--color-body-strong);
            font-size: 18px;
        }

        .hash-compare-mobile {
            display: none;
            margin-top: var(--space-xl);
            gap: var(--space-lg);
        }

        .hash-compare-card {
            position: relative;
            overflow: hidden;
            border: 1px solid var(--color-hairline);
            padding: var(--space-lg);
            background:
                radial-gradient(circle at 50% 8%, rgba(124, 255, 178, 0.045), transparent 38%),
                rgba(0, 0, 0, 0.28);
        }

        .hash-compare-card > span {
            display: block;
            color: var(--color-muted);
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .hash-compare-card h3 {
            margin-top: var(--space-lg);
            margin-bottom: var(--space-lg);
            color: var(--color-primary);
            font-family: var(--font-display);
            font-size: 24px;
            font-weight: 400;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .hash-compare-card-body {
            display: grid;
            gap: var(--space-md);
        }

        .hash-compare-point {
            border-top: 1px solid var(--color-hairline);
            padding-top: var(--space-md);
        }

        .hash-compare-point strong {
            display: block;
            margin-bottom: var(--space-xs);
            color: var(--color-link);
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .hash-compare-point p {
            margin: 0;
            color: var(--color-body-strong);
            font-size: 16px;
            line-height: 1.7;
        }

        .formula-code {
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
        }

        .hash-status {
            display: inline-flex;
            align-items: center;
            min-height: 36px;
            padding: 0 var(--space-md);
            border: 1px solid var(--color-hairline-strong);
            color: var(--color-primary);
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .hash-status.is-match {
            border-color: rgba(124, 255, 178, 0.78);
            color: #ffffff;
        }

        .hash-status.is-not-match {
            border-color: rgba(255, 183, 183, 0.78);
            color: #ffb7b7;
        }

        .game-dashboard {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            margin-bottom: var(--space-xl);
            border-top: 1px solid var(--color-hairline);
            border-left: 1px solid var(--color-hairline);
        }

        .game-stat {
            min-height: 120px;
            padding: var(--space-lg);
            border-right: 1px solid var(--color-hairline);
            border-bottom: 1px solid var(--color-hairline);
            background: rgba(0, 0, 0, 0.22);
        }

        .game-stat span {
            display: block;
            margin-bottom: var(--space-lg);
        }

        .game-target-box {
            margin-top: var(--space-xl);
            padding: var(--space-lg);
            border: 1px solid var(--color-hairline);
            background: rgba(0, 0, 0, 0.3);
        }

        .game-candidate-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--space-lg);
            margin-top: var(--space-xl);
        }

        .game-candidate-card {
            position: relative;
            min-height: 190px;
            padding: var(--space-lg);
            border: 1px solid var(--color-hairline);
            background:
                radial-gradient(circle at 50% 8%, rgba(124, 255, 178, 0.045), transparent 38%),
                rgba(0, 0, 0, 0.28);
        }

        .game-candidate-card strong {
            display: block;
            margin-top: var(--space-md);
            color: var(--color-primary);
            font-family: var(--font-display);
            font-size: 24px;
            font-weight: 400;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .game-candidate-actions {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-sm);
            margin-top: var(--space-lg);
        }

        .game-small-button {
            min-height: 38px;
            padding: 0 var(--space-md);
            border: 1px solid var(--color-hairline-strong);
            border-radius: 999px;
            background: transparent;
            color: var(--color-primary);
            cursor: pointer;
            font-family: var(--font-mono);
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .game-small-button:hover {
            border-color: rgba(124, 255, 178, 0.7);
        }

        .game-small-button.is-danger:hover {
            border-color: rgba(255, 183, 183, 0.7);
            color: #ffb7b7;
        }

        @media (max-width: 1180px) {

            .algorithm-grid-3,
            .algorithm-grid-4,
            .hash-flow,
            .game-candidate-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {

            .algorithm-grid-2,
            .algorithm-meta-grid,
            .game-dashboard {
                grid-template-columns: 1fr;
            }

            .hash-result-row {
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
            .hash-flow,
            .game-candidate-grid {
                grid-template-columns: 1fr;
            }

            .hash-compare-desktop {
                display: none !important;
            }

            .hash-compare-mobile {
                display: grid;
            }

            .hash-warning {
                font-size: 16px;
                line-height: 1.8;
            }

            .hash-select-menu {
                max-height: 220px;
            }
        }
    </style>

    @php
        $selectedAlgorithm = old('algorithm', $hashResult['algorithm'] ?? $verifyResult['algorithm'] ?? 'sha256');
        $plainTextValue = old('plain_text', $hashResult['plaintext'] ?? $verifyResult['plaintext'] ?? 'KRIPTOGRAFI');
        $expectedHashValue = old('expected_hash', $verifyResult['expected_hash'] ?? '');
    @endphp

    <section class="algorithm-hero">
        <div class="container">
            <div class="algorithm-hero-content">
                <p class="caption">ALGORITHM MODULE 01</p>
                <h1>HASH FUNCTION</h1>
                <p class="algorithm-hero-text">
                    Hash adalah fungsi satu arah yang mengubah data menjadi nilai ringkas yang disebut hash value atau
                    message digest. Halaman ini membahas sejarah, konsep, cara kerja, perhitungan, simulasi generate,
                    verifikasi hash, penerapan, dan game edukatif.
                </p>

                <div class="hero-actions">
                    <a href="#hash-simulation" class="button-primary">START SIMULATION</a>
                    <a href="#hash-game" class="button-secondary">PLAY HASH GAME</a>
                </div>
            </div>

            <div class="algorithm-meta-grid">
                <div class="algorithm-meta-item">
                    <span>Kategori</span>
                    <strong>Hash Function</strong>
                </div>

                <div class="algorithm-meta-item">
                    <span>Arah Proses</span>
                    <strong>Satu Arah</strong>
                </div>

                <div class="algorithm-meta-item">
                    <span>Output</span>
                    <strong>Message Digest</strong>
                </div>

                <div class="algorithm-meta-item">
                    <span>Decrypt</span>
                    <strong>Tidak Ada</strong>
                </div>
            </div>
        </div>
    </section>

    <section class="algorithm-section">
        <div class="container algorithm-grid-2">
            <div>
                <p class="caption">HISTORY</p>
                <h2>SEJARAH SINGKAT HASH</h2>
            </div>

            <div class="text-block">
                <p>
                    Konsep hash pada awalnya banyak digunakan dalam ilmu komputer untuk mempercepat pencarian data,
                    pengindeksan, dan struktur data seperti hash table. Dalam Kriptografi, hash berkembang menjadi fungsi
                    penting untuk membantu menjaga integritas data.
                </p>

                <p>
                    MD5 dikembangkan oleh Ronald Rivest pada tahun 1991 sebagai penerus MD4. Setelah itu, keluarga Secure
                    Hash Algorithm atau SHA dikembangkan dan distandardisasi untuk kebutuhan keamanan data. SHA-1 pernah
                    digunakan secara luas, tetapi kemudian dianggap lemah untuk keamanan modern.
                </p>

                <p>
                    Pada pembelajaran Kriptografi saat ini, SHA-256 dan SHA-512 lebih sering digunakan sebagai contoh fungsi
                    hash modern karena menghasilkan digest yang lebih panjang dan lebih relevan dibanding MD5 atau SHA-1.
                </p>
            </div>
        </div>
    </section>

    <section class="algorithm-section algorithm-section-bordered">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">CORE CONCEPT</p>
                    <h2>APA ITU HASH?</h2>
                </div>
            </div>

            <div class="algorithm-grid-3">
                <article class="concept-card">
                    <span>01</span>
                    <h3>ONE-WAY FUNCTION</h3>
                    <p>Hash bersifat satu arah. Hasil hash tidak dapat dikembalikan menjadi plaintext asli melalui proses
                        dekripsi.</p>
                </article>

                <article class="concept-card">
                    <span>02</span>
                    <h3>DETERMINISTIC</h3>
                    <p>Input yang sama akan selalu menghasilkan nilai hash yang sama selama algoritma yang digunakan juga
                        sama.</p>
                </article>

                <article class="concept-card">
                    <span>03</span>
                    <h3>FIXED LENGTH</h3>
                    <p>Panjang output hash tetap sesuai algoritma, meskipun panjang input dapat berbeda-beda.</p>
                </article>

                <article class="concept-card">
                    <span>04</span>
                    <h3>AVALANCHE EFFECT</h3>
                    <p>Perubahan kecil pada input dapat menghasilkan nilai hash yang sangat berbeda.</p>
                </article>

                <article class="concept-card">
                    <span>05</span>
                    <h3>FAST COMPUTATION</h3>
                    <p>Hash dapat dihitung dengan cepat sehingga sering digunakan untuk pemeriksaan integritas data.</p>
                </article>

                <article class="concept-card">
                    <span>06</span>
                    <h3>COLLISION RESISTANCE</h3>
                    <p>Fungsi hash yang baik membuat pencarian dua input berbeda dengan hash yang sama menjadi sangat sulit.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="algorithm-section">
        <div class="container algorithm-grid-2">
            <div>
                <p class="caption">IMPORTANT NOTE</p>
                <h2>HASH BUKAN ENKRIPSI</h2>
            </div>

            <div class="text-block">
                <p class="hash-warning">
                    Hash tidak memiliki fitur dekripsi. Fitur yang benar untuk hash adalah generate dan verify. Verify
                    berarti sistem menghitung ulang hash dari plaintext lalu membandingkannya dengan hash pembanding.
                </p>

                <div class="comparison-wrap hash-compare-desktop">
                    <table class="comparison-table">
                        <thead>
                            <tr>
                                <th>Aspek</th>
                                <th>Hash</th>
                                <th>Enkripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Arah Proses</td>
                                <td>Satu arah</td>
                                <td>Dua arah</td>
                            </tr>
                            <tr>
                                <td>Decrypt</td>
                                <td>Tidak bisa didekripsi</td>
                                <td>Bisa didekripsi dengan key</td>
                            </tr>
                            <tr>
                                <td>Tujuan</td>
                                <td>Integritas data</td>
                                <td>Kerahasiaan data</td>
                            </tr>
                            <tr>
                                <td>Output</td>
                                <td>Message digest</td>
                                <td>Ciphertext</td>
                            </tr>
                            <tr>
                                <td>Proses Balik yang Benar</td>
                                <td>Verify hash</td>
                                <td>Decrypt ciphertext</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="hash-compare-mobile" aria-label="Perbandingan Hash dan Enkripsi">
                    <article class="hash-compare-card">
                        <span>Aspek</span>
                        <h3>Arah Proses</h3>
                        <div class="hash-compare-card-body">
                            <div class="hash-compare-point">
                                <strong>Hash</strong>
                                <p>Satu arah.</p>
                            </div>
                            <div class="hash-compare-point">
                                <strong>Enkripsi</strong>
                                <p>Dua arah.</p>
                            </div>
                        </div>
                    </article>

                    <article class="hash-compare-card">
                        <span>Aspek</span>
                        <h3>Decrypt</h3>
                        <div class="hash-compare-card-body">
                            <div class="hash-compare-point">
                                <strong>Hash</strong>
                                <p>Tidak bisa didekripsi.</p>
                            </div>
                            <div class="hash-compare-point">
                                <strong>Enkripsi</strong>
                                <p>Bisa didekripsi dengan key.</p>
                            </div>
                        </div>
                    </article>

                    <article class="hash-compare-card">
                        <span>Aspek</span>
                        <h3>Tujuan</h3>
                        <div class="hash-compare-card-body">
                            <div class="hash-compare-point">
                                <strong>Hash</strong>
                                <p>Integritas data.</p>
                            </div>
                            <div class="hash-compare-point">
                                <strong>Enkripsi</strong>
                                <p>Kerahasiaan data.</p>
                            </div>
                        </div>
                    </article>

                    <article class="hash-compare-card">
                        <span>Aspek</span>
                        <h3>Output</h3>
                        <div class="hash-compare-card-body">
                            <div class="hash-compare-point">
                                <strong>Hash</strong>
                                <p>Message digest.</p>
                            </div>
                            <div class="hash-compare-point">
                                <strong>Enkripsi</strong>
                                <p>Ciphertext.</p>
                            </div>
                        </div>
                    </article>

                    <article class="hash-compare-card">
                        <span>Aspek</span>
                        <h3>Proses Balik yang Benar</h3>
                        <div class="hash-compare-card-body">
                            <div class="hash-compare-point">
                                <strong>Hash</strong>
                                <p>Verify hash.</p>
                            </div>
                            <div class="hash-compare-point">
                                <strong>Enkripsi</strong>
                                <p>Decrypt ciphertext.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="algorithm-section algorithm-section-bordered">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">HASH ALGORITHMS</p>
                    <h2>ALGORITMA YANG TERSEDIA</h2>
                </div>
            </div>

            <div class="comparison-wrap">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Algoritma</th>
                            <th>Panjang Output</th>
                            <th>Block Size</th>
                            <th>Status Pembelajaran</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($algorithms as $key => $algorithm)
                            <tr>
                                <td>{{ $algorithm['label'] }}</td>
                                <td>{{ $algorithm['hex_length'] }} karakter hex / {{ $algorithm['bits'] }} bit</td>
                                <td>{{ $algorithm['block_size'] }}</td>
                                <td>{{ $key === 'sha256' ? 'Rekomendasi utama' : 'Pembanding pembelajaran' }}</td>
                                <td>{{ $algorithm['note'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="algorithm-section">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">HOW IT WORKS</p>
                    <h2>CARA KERJA HASH</h2>
                </div>
            </div>

            <div class="hash-flow">
                <div class="hash-flow-item">
                    <span>Step 01</span>
                    <strong>Plaintext</strong>
                    <p>Pengguna memasukkan data awal berupa teks.</p>
                </div>

                <div class="hash-flow-item">
                    <span>Step 02</span>
                    <strong>Byte & Bit</strong>
                    <p>Data dibaca sebagai karakter, byte, lalu dapat direpresentasikan ke bentuk bit.</p>
                </div>

                <div class="hash-flow-item">
                    <span>Step 03</span>
                    <strong>Padding</strong>
                    <p>Data ditambahkan bit tertentu agar sesuai ukuran blok pemrosesan.</p>
                </div>

                <div class="hash-flow-item">
                    <span>Step 04</span>
                    <strong>Compression</strong>
                    <p>Blok diproses dengan operasi bitwise, rotate, XOR, dan modular addition.</p>
                </div>

                <div class="hash-flow-item">
                    <span>Step 05</span>
                    <strong>Digest</strong>
                    <p>Hasil akhir berupa nilai hash dengan panjang tetap.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="algorithm-section algorithm-section-bordered">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">CALCULATION</p>
                    <h2>PENJABARAN PERHITUNGAN HASH</h2>
                </div>
            </div>

            <div class="algorithm-grid-3">
                <article class="hash-step-card">
                    <span>Stage 01</span>
                    <h3>INPUT KE BINER</h3>
                    <p>Contoh input "A" memiliki ASCII 65. Nilai 65 dalam biner 8-bit adalah 01000001.</p>
                    <code class="formula-code">Input  : A
    ASCII  : 65
    Binary : 01000001
    Length : 8 bit</code>
                </article>

                <article class="hash-step-card">
                    <span>Stage 02</span>
                    <h3>PADDING SHA-256</h3>
                    <p>SHA-256 memproses blok 512-bit. Panjang pesan ditambah bit 1, lalu bit 0 sampai panjangnya 448 mod
                        512, kemudian ditambah panjang pesan 64-bit.</p>
                    <code class="formula-code">L + 1 + K ≡ 448 (mod 512)

    L = panjang pesan
    K = jumlah bit 0
    64 bit terakhir = panjang pesan asli</code>
                </article>

                <article class="hash-step-card">
                    <span>Stage 03</span>
                    <h3>MESSAGE BLOCK</h3>
                    <p>Setelah padding, data dibagi menjadi blok. Untuk SHA-256, setiap blok berukuran 512-bit.</p>
                    <code class="formula-code">1 block = 512 bit
    16 word awal = 32-bit
    Message schedule = W0 sampai W63</code>
                </article>

                <article class="hash-step-card">
                    <span>Stage 04</span>
                    <h3>MESSAGE SCHEDULE</h3>
                    <p>SHA-256 mengembangkan 16 word awal menjadi 64 word agar dapat diproses pada 64 round.</p>
                    <code class="formula-code">Wt = σ1(Wt-2) + Wt-7 + σ0(Wt-15) + Wt-16</code>
                </article>

                <article class="hash-step-card">
                    <span>Stage 05</span>
                    <h3>ROUND FUNCTION</h3>
                    <p>Setiap round menghitung nilai sementara menggunakan operasi Ch, Maj, Sigma, konstanta K, dan word W.
                    </p>
                    <code class="formula-code">T1 = h + Σ1(e) + Ch(e,f,g) + Kt + Wt
    T2 = Σ0(a) + Maj(a,b,c)</code>
                </article>

                <article class="hash-step-card">
                    <span>Stage 06</span>
                    <h3>FINAL DIGEST</h3>
                    <p>Setelah semua round selesai, nilai hash diperbarui dan digabungkan menjadi digest akhir.</p>
                    <code class="formula-code">Digest = H0 || H1 || H2 || H3 || H4 || H5 || H6 || H7</code>
                </article>
            </div>
        </div>
    </section>

    <section class="algorithm-section">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">SHA-256 CORE FORMULAS</p>
                    <h2>RUMUS INTI SHA-256</h2>
                </div>
            </div>

            <div class="algorithm-grid-4">
                <article class="formula-card">
                    <span>Formula 01</span>
                    <h3>CH FUNCTION</h3>
                    <code class="formula-code">Ch(x, y, z) = (x AND y) XOR (NOT x AND z)</code>
                </article>

                <article class="formula-card">
                    <span>Formula 02</span>
                    <h3>MAJ FUNCTION</h3>
                    <code class="formula-code">Maj(x, y, z) = (x AND y) XOR (x AND z) XOR (y AND z)</code>
                </article>

                <article class="formula-card">
                    <span>Formula 03</span>
                    <h3>BIG SIGMA 0</h3>
                    <code class="formula-code">Σ0(x) = ROTR²(x) XOR ROTR¹³(x) XOR ROTR²²(x)</code>
                </article>

                <article class="formula-card">
                    <span>Formula 04</span>
                    <h3>BIG SIGMA 1</h3>
                    <code class="formula-code">Σ1(x) = ROTR⁶(x) XOR ROTR¹¹(x) XOR ROTR²⁵(x)</code>
                </article>
            </div>
        </div>
    </section>

    <section class="algorithm-section algorithm-section-bordered" id="hash-simulation">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">SIMULATION</p>
                    <h2>GENERATE & VERIFY HASH</h2>
                </div>
            </div>

            <div class="algorithm-grid-2">
                <form class="hash-form-panel" action="{{ route('hash.process') }}" method="POST" data-hash-form="generate">
                    @csrf
                    <input type="hidden" name="mode" value="generate">

                    <p class="caption">GENERATE MODE</p>
                    <h3>PLAINTEXT TO HASH</h3>

                    <div class="hash-form-group">
                        <label for="plain_text_generate">Plaintext</label>
                        <textarea id="plain_text_generate" name="plain_text" class="hash-textarea"
                            placeholder="Masukkan plaintext...">{{ $plainTextValue }}</textarea>
                        <div class="hash-error" data-form-error="plain_text"></div>
                    </div>

                    <div class="hash-form-group">
                        <label for="algorithm_generate">Hash Algorithm</label>

                        <div class="hash-select-shell" data-custom-select>
                            <select id="algorithm_generate" name="algorithm" class="hash-select hash-native-select"
                                data-native-select>
                                @foreach ($algorithms as $key => $algorithm)
                                    <option value="{{ $key }}" @selected($selectedAlgorithm === $key)>
                                        {{ $algorithm['label'] }} — {{ $algorithm['hex_length'] }} HEX
                                    </option>
                                @endforeach
                            </select>

                            <button type="button" class="hash-select-trigger" data-select-trigger>
                                <span class="hash-select-label" data-select-label>SHA-256 — 64 HEX</span>
                                <span class="hash-select-caret">⌄</span>
                            </button>

                            <div class="hash-select-menu" data-select-menu>
                                @foreach ($algorithms as $key => $algorithm)
                                    <button type="button" class="hash-select-option" data-select-option="{{ $key }}">
                                        <span>{{ $algorithm['label'] }} — {{ $algorithm['hex_length'] }} HEX</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="hash-error" data-form-error="algorithm"></div>
                    </div>

                    <div class="hash-button-row">
                        <button type="submit" class="button-primary" data-default-text="GENERATE HASH">GENERATE
                            HASH</button>
                        <button type="button" class="button-secondary" data-hash-reset>RESET</button>
                    </div>

                    <div class="hash-ajax-feedback" data-form-feedback></div>
                </form>

                <form class="hash-form-panel" action="{{ route('hash.process') }}" method="POST" data-hash-form="verify">
                    @csrf
                    <input type="hidden" name="mode" value="verify">

                    <p class="caption">VERIFY MODE</p>
                    <h3>PLAINTEXT + HASH CHECK</h3>

                    <div class="hash-form-group">
                        <label for="plain_text_verify">Plaintext</label>
                        <textarea id="plain_text_verify" name="plain_text" class="hash-textarea"
                            placeholder="Masukkan plaintext yang ingin diverifikasi...">{{ $plainTextValue }}</textarea>
                        <div class="hash-error" data-form-error="plain_text"></div>
                    </div>

                    <div class="hash-form-group">
                        <label for="algorithm_verify">Hash Algorithm</label>

                        <div class="hash-select-shell" data-custom-select>
                            <select id="algorithm_verify" name="algorithm" class="hash-select hash-native-select"
                                data-native-select>
                                @foreach ($algorithms as $key => $algorithm)
                                    <option value="{{ $key }}" @selected($selectedAlgorithm === $key)>
                                        {{ $algorithm['label'] }} — {{ $algorithm['hex_length'] }} HEX
                                    </option>
                                @endforeach
                            </select>

                            <button type="button" class="hash-select-trigger" data-select-trigger>
                                <span class="hash-select-label" data-select-label>SHA-256 — 64 HEX</span>
                                <span class="hash-select-caret">⌄</span>
                            </button>

                            <div class="hash-select-menu" data-select-menu>
                                @foreach ($algorithms as $key => $algorithm)
                                    <button type="button" class="hash-select-option" data-select-option="{{ $key }}">
                                        <span>{{ $algorithm['label'] }} — {{ $algorithm['hex_length'] }} HEX</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="hash-error" data-form-error="algorithm"></div>
                    </div>

                    <div class="hash-form-group">
                        <label for="expected_hash">Hash Pembanding</label>
                        <input id="expected_hash" type="text" name="expected_hash" class="hash-input"
                            value="{{ $expectedHashValue }}" placeholder="Tempel hash yang ingin dicek...">
                        <div class="hash-error" data-form-error="expected_hash"></div>
                    </div>

                    <div class="hash-button-row">
                        <button type="submit" class="button-primary" data-default-text="VERIFY HASH">VERIFY HASH</button>
                    </div>

                    <div class="hash-ajax-feedback" data-form-feedback></div>
                </form>
            </div>

            <div data-hash-result-area>
                @if ($hashResult)
                    <div class="hash-output-panel" style="margin-top: var(--space-xl);">
                        <p class="caption">HASH OUTPUT</p>
                        <h3>{{ $hashResult['algorithm_label'] }} RESULT</h3>

                        <div class="hash-result-list">
                            <div class="hash-result-row">
                                <span>Algorithm</span>
                                <strong>{{ $hashResult['algorithm_label'] }}</strong>
                            </div>

                            <div class="hash-result-row">
                                <span>Input Length</span>
                                <strong>{{ $hashResult['input_characters'] }} characters / {{ $hashResult['input_bytes'] }}
                                    bytes / {{ $hashResult['input_bits'] }} bits</strong>
                            </div>

                            <div class="hash-result-row">
                                <span>Block Size</span>
                                <strong>{{ $hashResult['block_size'] }}</strong>
                            </div>

                            <div class="hash-result-row">
                                <span>Output Length</span>
                                <strong>{{ $hashResult['output_characters'] }} hex characters / {{ $hashResult['bits'] }}
                                    bits</strong>
                            </div>

                            <div class="hash-result-row">
                                <span>Hash Result</span>
                                <code class="hash-code-output" id="hash-output-value">{{ $hashResult['hash'] }}</code>
                            </div>
                        </div>

                        <p class="hash-note">{{ $hashResult['note'] }}</p>

                        <button type="button" class="button-secondary" data-copy-value="#hash-output-value">
                            COPY HASH
                        </button>

                        <div class="hash-copy-feedback" data-copy-feedback></div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="algorithm-section">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">REAL WORLD USE</p>
                    <h2>PENGAPLIKASIAN HASH</h2>
                </div>
            </div>

            <div class="algorithm-grid-3">
                <article class="application-card">
                    <span>01</span>
                    <h3>VERIFIKASI FILE</h3>
                    <p>Hash digunakan untuk membandingkan file asli dan file unduhan agar perubahan data dapat diketahui.
                    </p>
                </article>

                <article class="application-card">
                    <span>02</span>
                    <h3>PASSWORD HASHING</h3>
                    <p>Password tidak disimpan langsung, tetapi diubah menjadi hash. Untuk sistem nyata, gunakan bcrypt atau
                        Argon2.</p>
                </article>

                <article class="application-card">
                    <span>03</span>
                    <h3>DIGITAL SIGNATURE</h3>
                    <p>Hash digunakan sebagai ringkasan dokumen sebelum diproses dalam tanda tangan digital.</p>
                </article>

                <article class="application-card">
                    <span>04</span>
                    <h3>BLOCKCHAIN</h3>
                    <p>Hash digunakan untuk menghubungkan blok data dan menjaga keterkaitan antarblok.</p>
                </article>

                <article class="application-card">
                    <span>05</span>
                    <h3>INTEGRITY CHECK</h3>
                    <p>Hash membantu memastikan bahwa data tidak berubah selama penyimpanan atau pengiriman.</p>
                </article>

                <article class="application-card">
                    <span>06</span>
                    <h3>DIGITAL FORENSIC</h3>
                    <p>Hash membantu membuktikan bahwa barang bukti digital tidak mengalami perubahan.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="algorithm-section algorithm-section-bordered" id="hash-game">
        <div class="container algorithm-grid-2">
            <div>
                <p class="caption">MINI GAME</p>
                <h2>HASH DETECTIVE</h2>
                <p class="algorithm-hero-text" style="margin-left:0;">
                    Cari plaintext yang cocok dengan target hash. Gunakan fitur Generate Hash untuk menguji kandidat, lalu
                    pilih kandidat yang menghasilkan digest yang sama.
                </p>
            </div>

            <div class="hash-game-panel" data-hash-game>
                <p class="caption">CHALLENGE</p>
                <h3 data-game-title>HASH SUSPECT</h3>

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
                        <span>Algorithm</span>
                        <strong data-game-algorithm-label>SHA-256</strong>
                    </div>
                </div>

                <div class="game-target-box">
                    <span>Target Digest</span>
                    <code class="hash-code-output" data-game-target-hash></code>
                </div>

                <p class="hash-note" data-game-hint></p>

                <div class="game-candidate-grid" data-game-candidates></div>

                <div class="hash-button-row">
                    <button type="button" class="button-secondary" data-next-game>
                        SKIP CHALLENGE
                    </button>
                </div>

                <div class="game-feedback" data-game-feedback></div>
            </div>
        </div>
    </section>

    <section class="algorithm-section">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">LIMITATION</p>
                    <h2>BATASAN HALAMAN HASH</h2>
                </div>
            </div>

            <div class="algorithm-grid-3">
                <article class="concept-card">
                    <span>01</span>
                    <h3>PEMBELAJARAN</h3>
                    <p>Halaman ini dibuat sebagai media pembelajaran mata kuliah Kriptografi.</p>
                </article>

                <article class="concept-card">
                    <span>02</span>
                    <h3>NO DATABASE</h3>
                    <p>Input dan hasil hash tidak disimpan ke database.</p>
                </article>

                <article class="concept-card">
                    <span>03</span>
                    <h3>NO DECRYPT</h3>
                    <p>Hash tidak dapat didekripsi kembali menjadi plaintext.</p>
                </article>

                <article class="concept-card">
                    <span>04</span>
                    <h3>MD5 AND SHA-1</h3>
                    <p>MD5 dan SHA-1 disediakan untuk perbandingan pembelajaran, bukan rekomendasi keamanan modern.</p>
                </article>

                <article class="concept-card">
                    <span>05</span>
                    <h3>PASSWORD SECURITY</h3>
                    <p>Untuk password sistem nyata, gunakan metode khusus seperti bcrypt atau Argon2.</p>
                </article>

                <article class="concept-card">
                    <span>06</span>
                    <h3>NOT PRODUCTION</h3>
                    <p>Website ini tidak digunakan sebagai sistem keamanan produksi.</p>
                </article>
            </div>
        </div>
    </section>

    <script>
        const hashChallenges = @json($gameChallenges);

        const hashResultArea = document.querySelector('[data-hash-result-area]');
        const hashForms = document.querySelectorAll('[data-hash-form]');
        const resetButton = document.querySelector('[data-hash-reset]');

        initCustomHashSelects();

        hashForms.forEach((form) => {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();
                await submitHashForm(form);
            });
        });

        if (resetButton) {
            resetButton.addEventListener('click', () => {
                const generateForm = document.querySelector('[data-hash-form="generate"]');
                const verifyForm = document.querySelector('[data-hash-form="verify"]');

                if (generateForm) {
                    generateForm.reset();
                    generateForm.querySelector('[name="plain_text"]').value = '';
                    generateForm.querySelector('[name="algorithm"]').value = 'sha256';
                    generateForm.querySelector('[name="algorithm"]').dispatchEvent(new Event('change', { bubbles: true }));
                }

                if (verifyForm) {
                    verifyForm.reset();
                    verifyForm.querySelector('[name="plain_text"]').value = '';
                    verifyForm.querySelector('[name="algorithm"]').value = 'sha256';
                    verifyForm.querySelector('[name="algorithm"]').dispatchEvent(new Event('change', { bubbles: true }));
                    verifyForm.querySelector('[name="expected_hash"]').value = '';
                }

                clearAllFormErrors();
                clearAllFeedback();
                closeAllCustomSelects();

                if (hashResultArea) {
                    hashResultArea.innerHTML = '';
                }
            });
        }

        document.addEventListener('click', async (event) => {
            const copyButton = event.target.closest('[data-copy-value]');

            if (!copyButton) {
                return;
            }

            const targetSelector = copyButton.dataset.copyValue;
            const targetElement = document.querySelector(targetSelector);
            const feedback = copyButton.parentElement.querySelector('[data-copy-feedback]');

            if (!targetElement) {
                return;
            }

            try {
                await navigator.clipboard.writeText(targetElement.textContent.trim());

                if (feedback) {
                    feedback.textContent = 'HASH COPIED';
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
            }, 1800);
        });

        function initCustomHashSelects() {
            const customSelects = document.querySelectorAll('[data-custom-select]');

            customSelects.forEach((shell) => {
                if (shell.dataset.customSelectReady === 'true') {
                    return;
                }

                shell.dataset.customSelectReady = 'true';

                const nativeSelect = shell.querySelector('[data-native-select]');
                const trigger = shell.querySelector('[data-select-trigger]');
                const label = shell.querySelector('[data-select-label]');
                const options = shell.querySelectorAll('[data-select-option]');
                const formGroup = shell.closest('.hash-form-group');
                const formPanel = shell.closest('.hash-form-panel');

                if (!nativeSelect || !trigger || !label || !options.length) {
                    return;
                }

                function syncLabel() {
                    const selectedOption = nativeSelect.options[nativeSelect.selectedIndex];
                    label.textContent = selectedOption ? selectedOption.textContent.trim() : '';

                    options.forEach((option) => {
                        option.classList.toggle(
                            'is-selected',
                            option.dataset.selectOption === nativeSelect.value
                        );
                    });
                }

                function openSelect() {
                    closeAllCustomSelects(shell);
                    shell.classList.add('is-open');
                    formGroup?.classList.add('has-open-select');
                    formPanel?.classList.add('has-open-select');
                }

                function closeSelect() {
                    shell.classList.remove('is-open');
                    formGroup?.classList.remove('has-open-select');
                    formPanel?.classList.remove('has-open-select');
                }

                trigger.addEventListener('click', () => {
                    if (shell.classList.contains('is-open')) {
                        closeSelect();
                    } else {
                        openSelect();
                    }
                });

                options.forEach((option) => {
                    option.addEventListener('click', () => {
                        nativeSelect.value = option.dataset.selectOption;
                        nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
                        syncLabel();
                        closeSelect();
                    });
                });

                nativeSelect.addEventListener('change', syncLabel);

                document.addEventListener('click', (event) => {
                    if (!shell.contains(event.target)) {
                        closeSelect();
                    }
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        closeSelect();
                    }
                });

                syncLabel();
            });
        }

        function closeAllCustomSelects(exceptShell = null) {
            document.querySelectorAll('[data-custom-select].is-open').forEach((shell) => {
                if (exceptShell && shell === exceptShell) {
                    return;
                }

                shell.classList.remove('is-open');
                shell.closest('.hash-form-group')?.classList.remove('has-open-select');
                shell.closest('.hash-form-panel')?.classList.remove('has-open-select');
            });
        }

        async function submitHashForm(form) {
            const submitButton = form.querySelector('[type="submit"]');
            const feedback = form.querySelector('[data-form-feedback]');
            const defaultText = submitButton?.dataset.defaultText || submitButton?.textContent || 'PROCESS';

            clearFormErrors(form);
            closeAllCustomSelects();

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
                        showFormErrors(form, data.errors);

                        if (feedback) {
                            feedback.textContent = 'CHECK INPUT FIELD.';
                        }

                        return;
                    }

                    throw new Error(data.message || 'Request failed.');
                }

                if (data.mode === 'generate' && data.hashResult) {
                    renderHashResult(data.hashResult);

                    if (feedback) {
                        feedback.textContent = 'HASH GENERATED WITHOUT PAGE REFRESH.';
                    }
                }

                if (data.mode === 'verify' && data.verifyResult) {
                    renderVerifyResult(data.verifyResult);

                    if (feedback) {
                        feedback.textContent = 'HASH VERIFIED WITHOUT PAGE REFRESH.';
                    }
                }

                hashResultArea?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });

                window.setTimeout(() => {
                    if (typeof initCyberCards === 'function') {
                        initCyberCards();
                    }
                }, 80);
            } catch (error) {
                if (feedback) {
                    feedback.textContent = 'REQUEST FAILED. CHECK BROWSER CONSOLE.';
                }
            } finally {
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.textContent = defaultText;
                }
            }
        }

        function renderHashResult(result) {
            if (!hashResultArea) {
                return;
            }

            hashResultArea.innerHTML = `
                <div class="hash-output-panel" style="margin-top: var(--space-xl);">
                    <p class="caption">HASH OUTPUT</p>
                    <h3>${escapeHtml(result.algorithm_label)} RESULT</h3>

                    <div class="hash-result-list">
                        <div class="hash-result-row">
                            <span>Algorithm</span>
                            <strong>${escapeHtml(result.algorithm_label)}</strong>
                        </div>

                        <div class="hash-result-row">
                            <span>Input Length</span>
                            <strong>${result.input_characters} characters / ${result.input_bytes} bytes / ${result.input_bits} bits</strong>
                        </div>

                        <div class="hash-result-row">
                            <span>Block Size</span>
                            <strong>${escapeHtml(result.block_size)}</strong>
                        </div>

                        <div class="hash-result-row">
                            <span>Output Length</span>
                            <strong>${result.output_characters} hex characters / ${result.bits} bits</strong>
                        </div>

                        <div class="hash-result-row">
                            <span>Hash Result</span>
                            <code class="hash-code-output" id="hash-output-value">${escapeHtml(result.hash)}</code>
                        </div>
                    </div>

                    <p class="hash-note">${escapeHtml(result.note)}</p>

                    <button type="button" class="button-secondary" data-copy-value="#hash-output-value">
                        COPY HASH
                    </button>

                    <div class="hash-copy-feedback" data-copy-feedback></div>
                </div>
            `;

            requestAnimationFrame(() => {
                if (typeof initCyberCards === 'function') {
                    initCyberCards();
                }
            });
        }

        function renderVerifyResult(result) {
            if (!hashResultArea) {
                return;
            }

            const statusClass = result.matches ? 'is-match' : 'is-not-match';
            const statusText = result.matches ? 'MATCHED' : 'NOT MATCHED';

            hashResultArea.innerHTML = `
                <div class="hash-output-panel" style="margin-top: var(--space-xl);">
                    <p class="caption">VERIFY OUTPUT</p>
                    <h3>${escapeHtml(result.algorithm_label)} VERIFICATION</h3>

                    <div class="hash-result-list">
                        <div class="hash-result-row">
                            <span>Status</span>
                            <strong>
                                <span class="hash-status ${statusClass}">
                                    ${statusText}
                                </span>
                            </strong>
                        </div>

                        <div class="hash-result-row">
                            <span>Generated Hash</span>
                            <code class="hash-code-output" id="verify-generated-hash">${escapeHtml(result.hash)}</code>
                        </div>

                        <div class="hash-result-row">
                            <span>Expected Hash</span>
                            <code class="hash-code-output">${escapeHtml(result.expected_hash)}</code>
                        </div>

                        <div class="hash-result-row">
                            <span>Expected Length</span>
                            <strong>
                                ${result.expected_hash_length} / ${result.expected_hex_length} hex characters
                            </strong>
                        </div>
                    </div>

                    <p class="hash-note">
                        Verifikasi dilakukan dengan menghitung ulang hash dari plaintext lalu membandingkannya dengan hash pembanding. Ini bukan dekripsi.
                    </p>

                    <button type="button" class="button-secondary" data-copy-value="#verify-generated-hash">
                        COPY GENERATED HASH
                    </button>

                    <div class="hash-copy-feedback" data-copy-feedback></div>
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

                if (target) {
                    target.textContent = messages[0];
                }
            });
        }

        function clearFormErrors(form) {
            form.querySelectorAll('[data-form-error]').forEach((element) => {
                element.textContent = '';
            });
        }

        function clearAllFormErrors() {
            document.querySelectorAll('[data-form-error]').forEach((element) => {
                element.textContent = '';
            });
        }

        function clearAllFeedback() {
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

        const hashGame = document.querySelector('[data-hash-game]');

        if (hashGame && hashChallenges.length > 0) {
            initHashDetectiveGame();
        }

        function initHashDetectiveGame() {
            const title = hashGame.querySelector('[data-game-title]');
            const score = hashGame.querySelector('[data-game-score]');
            const round = hashGame.querySelector('[data-game-round]');
            const algorithmLabel = hashGame.querySelector('[data-game-algorithm-label]');
            const targetHash = hashGame.querySelector('[data-game-target-hash]');
            const hint = hashGame.querySelector('[data-game-hint]');
            const candidateContainer = hashGame.querySelector('[data-game-candidates]');
            const feedback = hashGame.querySelector('[data-game-feedback]');
            const nextButton = hashGame.querySelector('[data-next-game]');

            let currentChallenge = null;
            let currentRound = 1;
            let currentScore = 0;
            let locked = false;
            let lastChallengeId = null;
            let challengeQueue = shuffleArray(hashChallenges);

            function getNextChallenge() {
                if (challengeQueue.length === 0) {
                    challengeQueue = shuffleArray(hashChallenges);
                }

                let nextChallenge = challengeQueue.shift();

                if (
                    hashChallenges.length > 1 &&
                    lastChallengeId !== null &&
                    nextChallenge.id === lastChallengeId
                ) {
                    challengeQueue.push(nextChallenge);
                    nextChallenge = challengeQueue.shift();
                }

                lastChallengeId = nextChallenge.id;

                return nextChallenge;
            }

            function loadChallenge() {
                locked = false;
                currentChallenge = getNextChallenge();

                const shuffledCandidates = shuffleArray(currentChallenge.candidates);

                title.textContent = currentChallenge.title;
                score.textContent = currentScore;
                round.textContent = currentRound;
                algorithmLabel.textContent = currentChallenge.algorithm_label;
                targetHash.textContent = currentChallenge.target_hash;
                hint.textContent = currentChallenge.hint;
                feedback.textContent = '';

                candidateContainer.innerHTML = shuffledCandidates.map((candidate, index) => {
                    return `
                        <article class="game-candidate-card">
                            <span>Candidate ${String.fromCharCode(65 + index)}</span>
                            <strong>${escapeHtml(candidate)}</strong>

                            <div class="game-candidate-actions">
                                <button type="button" class="game-small-button" data-test-candidate="${escapeHtml(candidate)}">
                                    TEST IN GENERATOR
                                </button>

                                <button type="button" class="game-small-button is-danger" data-choose-candidate="${escapeHtml(candidate)}">
                                    CHOOSE
                                </button>
                            </div>
                        </article>
                    `;
                }).join('');

                requestAnimationFrame(() => {
                    if (typeof initCyberCards === 'function') {
                        initCyberCards();
                    }
                });
            }

            candidateContainer.addEventListener('click', (event) => {
                const testButton = event.target.closest('[data-test-candidate]');
                const chooseButton = event.target.closest('[data-choose-candidate]');

                if (testButton) {
                    const candidate = testButton.dataset.testCandidate;
                    fillGenerator(candidate, currentChallenge.algorithm);
                    feedback.textContent = 'CANDIDATE SENT TO GENERATOR. CLICK GENERATE HASH TO TEST.';
                    return;
                }

                if (chooseButton && !locked) {
                    const candidate = chooseButton.dataset.chooseCandidate;
                    locked = true;

                    if (candidate === currentChallenge.answer_plaintext) {
                        currentScore += 10;
                        feedback.textContent = 'CORRECT. NEW CHALLENGE LOADING...';
                    } else {
                        currentScore = Math.max(0, currentScore - 5);
                        feedback.textContent = 'WRONG. NEW CHALLENGE LOADING...';
                    }

                    score.textContent = currentScore;
                    currentRound += 1;

                    window.setTimeout(loadChallenge, 1200);
                }
            });

            if (nextButton) {
                nextButton.addEventListener('click', () => {
                    currentRound += 1;
                    feedback.textContent = 'CHALLENGE SKIPPED. NEW CHALLENGE LOADING...';
                    window.setTimeout(loadChallenge, 450);
                });
            }

            loadChallenge();
        }

        function fillGenerator(plainText, algorithm) {
            const plainTextarea = document.querySelector('#plain_text_generate');
            const algorithmSelect = document.querySelector('#algorithm_generate');

            if (!plainTextarea || !algorithmSelect) {
                return;
            }

            plainTextarea.value = plainText;
            algorithmSelect.value = algorithm;
            algorithmSelect.dispatchEvent(new Event('change', { bubbles: true }));

            document.querySelector('#hash-simulation')?.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    </script>
@endsection
