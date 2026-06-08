@extends('layouts.app')

@section('title', 'Crypto Lab | Dashboard')

@section('content')
    <section class="dashboard-hero">
        <div class="container">
            <div class="dashboard-hero-content">
                <p class="caption">UAS KRIPTOGRAFI</p>
                <h1>CRYPTOGRAPHY CLASS PROJECT</h1>
                <p class="dashboard-hero-text">
                    Crypto Lab adalah website pembelajaran Kriptografi berbasis Laravel yang dibuat untuk tugas UAS satu
                    kelas. Website ini mengenalkan konsep umum Kriptografi, istilah dasar, tujuan keamanan data, jenis
                    algoritma, serta simulasi Hash, RSA, DES, dan GOST.
                </p>

                <div class="hero-actions">
                    <a href="#crypto-introduction" class="button-primary">LEARN CRYPTOGRAPHY</a>
                    <a href="#modules" class="button-secondary">EXPLORE MODULES</a>
                </div>
            </div>

            <div class="dashboard-meta-grid">
                <div class="dashboard-meta-item">
                    <span>PROJECT</span>
                    <strong>CRYPTO LAB</strong>
                </div>

                <div class="dashboard-meta-item">
                    <span>COURSE</span>
                    <strong>KRIPTOGRAFI</strong>
                </div>

                <div class="dashboard-meta-item">
                    <span>LECTURER</span>
                    <strong>PAK HENDRIK FERY HERDIYATMOKO, S.T., M.ENG.</strong>
                </div>

                <div class="dashboard-meta-item">
                    <span>CLASS MEMBERS</span>
                    <strong>15 STUDENTS</strong>
                </div>
            </div>
        </div>
    </section>

    <section class="dashboard-section" id="crypto-introduction">
        <div class="container split-layout">
            <div>
                <p class="caption">CRYPTOGRAPHY INTRODUCTION</p>
                <h2>APA ITU KRIPTOGRAFI?</h2>
            </div>

            <div class="text-block">
                <p>
                    Kriptografi adalah ilmu dan teknik untuk mengamankan informasi agar pesan tidak mudah dibaca, diubah,
                    atau disalahgunakan oleh pihak yang tidak berhak. Dalam Kriptografi, pesan asli disebut plaintext. Pesan
                    yang sudah diubah menjadi bentuk tidak terbaca disebut ciphertext.
                </p>

                <p>
                    Proses mengubah plaintext menjadi ciphertext disebut enkripsi. Proses mengembalikan ciphertext menjadi
                    plaintext disebut dekripsi. Proses tersebut biasanya membutuhkan key atau kunci agar data dapat diproses
                    dengan benar.
                </p>

                <div class="data-list">
                    <div class="data-row">
                        <span>Plaintext</span>
                        <strong>Pesan Asli</strong>
                    </div>

                    <div class="data-row">
                        <span>Ciphertext</span>
                        <strong>Pesan Terenkripsi</strong>
                    </div>

                    <div class="data-row">
                        <span>Encryption</span>
                        <strong>Plaintext Menjadi Ciphertext</strong>
                    </div>

                    <div class="data-row">
                        <span>Decryption</span>
                        <strong>Ciphertext Menjadi Plaintext</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="dashboard-section dashboard-section-bordered">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">SECURITY GOALS</p>
                    <h2>TUJUAN UTAMA KRIPTOGRAFI</h2>
                </div>
            </div>

            <div class="principle-grid">
                <article class="principle-item">
                    <span>01</span>
                    <h3>KERAHASIAAN</h3>
                    <p>
                        Menjaga agar informasi hanya dapat dibaca oleh pihak yang memiliki hak akses.
                    </p>
                </article>

                <article class="principle-item">
                    <span>02</span>
                    <h3>INTEGRITAS</h3>
                    <p>
                        Membantu memastikan bahwa data tidak berubah tanpa diketahui oleh penerima.
                    </p>
                </article>

                <article class="principle-item">
                    <span>03</span>
                    <h3>AUTENTIKASI</h3>
                    <p>
                        Membantu memastikan identitas pengirim, penerima, atau sumber data.
                    </p>
                </article>

                <article class="principle-item">
                    <span>04</span>
                    <h3>NON REPUDIATION</h3>
                    <p>
                        Membantu mencegah pihak tertentu menyangkal pesan atau transaksi yang sudah dilakukan.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="dashboard-section">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">BASIC TERMS</p>
                    <h2>ISTILAH DASAR KRIPTOGRAFI</h2>
                </div>
            </div>

            <div class="glossary-wrap">
                <table class="glossary-table">
                    <thead>
                        <tr>
                            <th>Istilah</th>
                            <th>Arti</th>
                            <th>Peran dalam Website</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Plaintext</td>
                            <td>Pesan asli yang belum diproses.</td>
                            <td>Menjadi input awal pada modul Hash, RSA, DES, dan GOST.</td>
                        </tr>

                        <tr>
                            <td>Ciphertext</td>
                            <td>Pesan hasil enkripsi yang tidak mudah dibaca secara langsung.</td>
                            <td>Menjadi output pada modul RSA, DES, dan GOST.</td>
                        </tr>

                        <tr>
                            <td>Key</td>
                            <td>Kunci yang digunakan untuk memproses enkripsi atau dekripsi.</td>
                            <td>Digunakan pada RSA, DES, dan GOST.</td>
                        </tr>

                        <tr>
                            <td>Encryption</td>
                            <td>Proses mengubah plaintext menjadi ciphertext.</td>
                            <td>Menjadi proses utama pada RSA, DES, dan GOST.</td>
                        </tr>

                        <tr>
                            <td>Decryption</td>
                            <td>Proses mengembalikan ciphertext menjadi plaintext.</td>
                            <td>Menjadi proses pembuktian bahwa data dapat dikembalikan.</td>
                        </tr>

                        <tr>
                            <td>Hash</td>
                            <td>Nilai ringkas dari data yang diproses dengan fungsi satu arah.</td>
                            <td>Menjadi output utama pada modul Hash.</td>
                        </tr>

                        <tr>
                            <td>Block Cipher</td>
                            <td>Algoritma yang memproses data dalam ukuran blok tertentu.</td>
                            <td>Menjadi konsep utama pada DES dan GOST.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="dashboard-section dashboard-section-bordered">
        <div class="container split-layout">
            <div>
                <p class="caption">CRYPTOGRAPHY MAP</p>
                <h2>PETA JENIS KRIPTOGRAFI</h2>
            </div>

            <div class="taxonomy-panel">
                <div class="taxonomy-row">
                    <span>01</span>
                    <div>
                        <h3>HASH FUNCTION</h3>
                        <p>
                            Fungsi satu arah yang menghasilkan nilai hash dari data. Dalam website ini, kategori tersebut
                            diwakili oleh modul Hash.
                        </p>
                    </div>
                </div>

                <div class="taxonomy-row">
                    <span>02</span>
                    <div>
                        <h3>ASYMMETRIC CRYPTOGRAPHY</h3>
                        <p>
                            Kriptografi yang memakai pasangan public key dan private key. Dalam website ini, kategori
                            tersebut diwakili oleh RSA.
                        </p>
                    </div>
                </div>

                <div class="taxonomy-row">
                    <span>03</span>
                    <div>
                        <h3>SYMMETRIC BLOCK CIPHER</h3>
                        <p>
                            Kriptografi yang memakai satu kunci simetris dan memproses data per blok. Dalam website ini,
                            kategori tersebut diwakili oleh DES dan GOST.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="dashboard-section">
        <div class="container split-layout">
            <div>
                <p class="caption">PROJECT CONTEXT</p>
                <h2>KONTEKS TUGAS WEBSITE</h2>
            </div>

            <div class="text-block">
                <p>
                    Website ini dibuat sebagai media pembelajaran untuk mata kuliah Kriptografi. Isi website tidak hanya
                    menampilkan form enkripsi atau dekripsi, tetapi juga menjelaskan informasi dasar project, tujuan
                    pembuatan, daftar algoritma yang digunakan, alur penggunaan, dan data anggota kelas.
                </p>

                <p>
                    Setiap modul algoritma akan dibuat agar pengguna dapat memasukkan data, menjalankan proses, melihat
                    hasil keluaran, dan memahami fungsi dasar algoritma tersebut. Dengan begitu, website dapat digunakan
                    sebagai media belajar yang lebih jelas dan tidak hanya berisi tampilan statis.
                </p>

                <div class="data-list">
                    <div class="data-row">
                        <span>Jenis Project</span>
                        <strong>Website Pembelajaran dan Simulasi</strong>
                    </div>

                    <div class="data-row">
                        <span>Mata Kuliah</span>
                        <strong>Kriptografi</strong>
                    </div>

                    <div class="data-row">
                        <span>Framework</span>
                        <strong>Laravel</strong>
                    </div>

                    <div class="data-row">
                        <span>Penyimpanan Data</span>
                        <strong>Tanpa Database</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="dashboard-section dashboard-section-bordered">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">WHY THESE ALGORITHMS</p>
                    <h2>ALASAN PEMILIHAN ALGORITMA</h2>
                </div>
            </div>

            <div class="reason-grid">
                <article class="reason-item">
                    <span>01</span>
                    <h3>HASH</h3>
                    <p>
                        Hash dipilih karena menjadi dasar untuk memahami integritas data. Modul ini menunjukkan bahwa satu
                        perubahan kecil pada plaintext dapat menghasilkan nilai hash yang berbeda.
                    </p>
                </article>

                <article class="reason-item">
                    <span>02</span>
                    <h3>RSA</h3>
                    <p>
                        RSA dipilih karena mewakili kriptografi asimetris. Modul ini membantu pengguna memahami public key,
                        private key, dan proses enkripsi berbasis bilangan prima.
                    </p>
                </article>

                <article class="reason-item">
                    <span>03</span>
                    <h3>DES</h3>
                    <p>
                        DES dipilih karena menjadi contoh block cipher klasik. Modul ini membantu pengguna memahami konsep
                        kunci simetris, blok data, dan proses round.
                    </p>
                </article>

                <article class="reason-item">
                    <span>04</span>
                    <h3>GOST</h3>
                    <p>
                        GOST dipilih agar pengguna dapat membandingkan konsep block cipher lain dengan DES, terutama pada
                        penggunaan round dan struktur Feistel.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="dashboard-section">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">PROJECT OBJECTIVES</p>
                    <h2>TUJUAN PEMBUATAN WEBSITE</h2>
                </div>
            </div>

            <div class="objective-grid">
                <article class="objective-item">
                    <span>01</span>
                    <h3>MEDIA BELAJAR</h3>
                    <p>
                        Membantu pengguna memahami konsep dasar Kriptografi melalui tampilan web yang terstruktur.
                    </p>
                </article>

                <article class="objective-item">
                    <span>02</span>
                    <h3>SIMULASI PROSES</h3>
                    <p>
                        Menyediakan form sederhana untuk menjalankan proses Hash, RSA, DES, dan GOST secara langsung.
                    </p>
                </article>

                <article class="objective-item">
                    <span>03</span>
                    <h3>OUTPUT LANGSUNG</h3>
                    <p>
                        Menampilkan hasil proses algoritma agar pengguna dapat melihat perubahan dari plaintext menjadi hash
                        atau ciphertext.
                    </p>
                </article>

                <article class="objective-item">
                    <span>04</span>
                    <h3>DOKUMENTASI KELAS</h3>
                    <p>
                        Menampilkan identitas tugas, dosen pengampu, teknologi yang digunakan, dan daftar anggota kelas.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="dashboard-section dashboard-section-bordered">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">SYSTEM SUMMARY</p>
                    <h2>RINGKASAN WEBSITE</h2>
                </div>
            </div>

            <div class="stat-grid">
                <div class="stat-cell">
                    <span>01</span>
                    <strong>4</strong>
                    <p>Algoritma utama yang disediakan dalam website.</p>
                </div>

                <div class="stat-cell">
                    <span>02</span>
                    <strong>1</strong>
                    <p>Modul Hash sebagai fungsi satu arah.</p>
                </div>

                <div class="stat-cell">
                    <span>03</span>
                    <strong>1</strong>
                    <p>Modul RSA sebagai kriptografi kunci publik.</p>
                </div>

                <div class="stat-cell">
                    <span>04</span>
                    <strong>2</strong>
                    <p>Modul DES dan GOST sebagai block cipher simetris.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="dashboard-section">
        <div class="container split-layout">
            <div>
                <p class="caption">LEARNING PATH</p>
                <h2>URUTAN BELAJAR YANG DISARANKAN</h2>
            </div>

            <div class="learning-path">
                <div class="learning-row">
                    <span>01</span>
                    <div>
                        <h3>KONSEP UMUM</h3>
                        <p>
                            Mulai dari pengertian Kriptografi, tujuan keamanan data, dan istilah dasar seperti plaintext,
                            ciphertext, key, encryption, dan decryption.
                        </p>
                    </div>
                </div>

                <div class="learning-row">
                    <span>02</span>
                    <div>
                        <h3>HASH</h3>
                        <p>
                            Lanjut ke Hash karena konsepnya paling sederhana. Pengguna cukup memasukkan teks dan sistem
                            menghasilkan nilai hash.
                        </p>
                    </div>
                </div>

                <div class="learning-row">
                    <span>03</span>
                    <div>
                        <h3>RSA</h3>
                        <p>
                            Setelah Hash, pelajari RSA untuk memahami konsep public key, private key, bilangan prima,
                            enkripsi, dan dekripsi.
                        </p>
                    </div>
                </div>

                <div class="learning-row">
                    <span>04</span>
                    <div>
                        <h3>DES</h3>
                        <p>
                            Pelajari DES untuk memahami block cipher simetris, penggunaan satu key, dan proses round dalam
                            enkripsi data.
                        </p>
                    </div>
                </div>

                <div class="learning-row">
                    <span>05</span>
                    <div>
                        <h3>GOST</h3>
                        <p>
                            Terakhir, pelajari GOST sebagai pembanding block cipher lain yang juga memakai proses round dan
                            struktur Feistel.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="dashboard-section dashboard-section-bordered" id="modules">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">ALGORITHM MODULES</p>
                    <h2>PEMBAHASAN MODUL ALGORITMA</h2>
                </div>
            </div>

            <div class="dashboard-module-grid">
                <article class="dashboard-module-card">
                    <p class="module-index">01</p>
                    <h3>HASH</h3>
                    <p>
                        Hash mengubah plaintext menjadi nilai ringkas yang disebut message digest. Hash tidak memiliki
                        proses dekripsi karena sifatnya satu arah.
                    </p>

                    <div class="module-detail-list">
                        <div>
                            <span>Kategori</span>
                            <strong>Hash Function</strong>
                        </div>

                        <div>
                            <span>Kunci</span>
                            <strong>Tidak Memakai Key</strong>
                        </div>

                        <div>
                            <span>Arah Proses</span>
                            <strong>Satu Arah</strong>
                        </div>

                        <div>
                            <span>Fokus Belajar</span>
                            <strong>Integritas Data</strong>
                        </div>
                    </div>

                    <a href="{{ route('hash') }}">OPEN MODULE</a>
                </article>

                <article class="dashboard-module-card">
                    <p class="module-index">02</p>
                    <h3>RSA</h3>
                    <p>
                        RSA menggunakan pasangan public key dan private key. Algoritma ini memakai bilangan prima sebagai
                        dasar pembentukan kunci.
                    </p>

                    <div class="module-detail-list">
                        <div>
                            <span>Kategori</span>
                            <strong>Asymmetric Cryptography</strong>
                        </div>

                        <div>
                            <span>Kunci</span>
                            <strong>Public dan Private Key</strong>
                        </div>

                        <div>
                            <span>Arah Proses</span>
                            <strong>Dua Arah</strong>
                        </div>

                        <div>
                            <span>Parameter</span>
                            <strong>p, q, n, phi, e, d</strong>
                        </div>
                    </div>

                    <a href="{{ route('rsa') }}">OPEN MODULE</a>
                </article>

                <article class="dashboard-module-card">
                    <p class="module-index">03</p>
                    <h3>DES</h3>
                    <p>
                        DES memakai satu kunci yang sama untuk proses enkripsi dan dekripsi. Algoritma ini bekerja pada blok
                        data dengan proses round.
                    </p>

                    <div class="module-detail-list">
                        <div>
                            <span>Kategori</span>
                            <strong>Symmetric Block Cipher</strong>
                        </div>

                        <div>
                            <span>Kunci</span>
                            <strong>Satu Key Simetris</strong>
                        </div>

                        <div>
                            <span>Arah Proses</span>
                            <strong>Dua Arah</strong>
                        </div>

                        <div>
                            <span>Konsep</span>
                            <strong>Block, Round, Feistel</strong>
                        </div>
                    </div>

                    <a href="{{ route('des') }}">OPEN MODULE</a>
                </article>

                <article class="dashboard-module-card">
                    <p class="module-index">04</p>
                    <h3>GOST</h3>
                    <p>
                        GOST merupakan block cipher simetris yang menggunakan proses round berulang. Modul ini dipakai untuk
                        membandingkan konsepnya dengan DES.
                    </p>

                    <div class="module-detail-list">
                        <div>
                            <span>Kategori</span>
                            <strong>Symmetric Block Cipher</strong>
                        </div>

                        <div>
                            <span>Kunci</span>
                            <strong>Satu Key Simetris</strong>
                        </div>

                        <div>
                            <span>Arah Proses</span>
                            <strong>Dua Arah</strong>
                        </div>

                        <div>
                            <span>Konsep</span>
                            <strong>Round dan Feistel</strong>
                        </div>
                    </div>

                    <a href="{{ route('gost') }}">OPEN MODULE</a>
                </article>
            </div>
        </div>
    </section>

    <section class="dashboard-section">
        <div class="container split-layout">
            <div>
                <p class="caption">USER FLOW</p>
                <h2>ALUR PENGGUNAAN WEBSITE</h2>
            </div>

            <div class="process-list">
                <div class="process-row">
                    <span>01</span>
                    <p>Buka Dashboard untuk memahami pengertian Kriptografi, tujuan keamanan data, dan istilah dasar.</p>
                </div>

                <div class="process-row">
                    <span>02</span>
                    <p>Pilih modul algoritma yang ingin dipelajari melalui menu navigasi atau card modul.</p>
                </div>

                <div class="process-row">
                    <span>03</span>
                    <p>Baca penjelasan singkat algoritma sebelum menjalankan simulasi.</p>
                </div>

                <div class="process-row">
                    <span>04</span>
                    <p>Masukkan plaintext, key, atau parameter yang dibutuhkan oleh algoritma.</p>
                </div>

                <div class="process-row">
                    <span>05</span>
                    <p>Klik tombol proses untuk menjalankan generate hash, enkripsi, atau dekripsi.</p>
                </div>

                <div class="process-row">
                    <span>06</span>
                    <p>Lihat hasil output dan baca penjelasan proses yang ditampilkan pada halaman modul.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="dashboard-section dashboard-section-bordered">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">COMPARISON</p>
                    <h2>PERBANDINGAN ALGORITMA</h2>
                </div>
            </div>

            <div class="comparison-wrap">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Algoritma</th>
                            <th>Kategori</th>
                            <th>Memakai Key</th>
                            <th>Bisa Didekripsi</th>
                            <th>Fokus Pembelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hash</td>
                            <td>Hash Function</td>
                            <td>Tidak</td>
                            <td>Tidak</td>
                            <td>Integritas data dan message digest</td>
                        </tr>

                        <tr>
                            <td>RSA</td>
                            <td>Asymmetric Cryptography</td>
                            <td>Ya, public key dan private key</td>
                            <td>Ya</td>
                            <td>Kriptografi kunci publik dan privat</td>
                        </tr>

                        <tr>
                            <td>DES</td>
                            <td>Symmetric Block Cipher</td>
                            <td>Ya, satu key simetris</td>
                            <td>Ya</td>
                            <td>Block cipher, round, dan Feistel</td>
                        </tr>

                        <tr>
                            <td>GOST</td>
                            <td>Symmetric Block Cipher</td>
                            <td>Ya, satu key simetris</td>
                            <td>Ya</td>
                            <td>Perbandingan block cipher dengan DES</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="dashboard-section" id="class-members">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="caption">CLASS MEMBERS</p>
                    <h2>DAFTAR ANGGOTA KELAS</h2>
                </div>
            </div>

            <div class="class-summary">
                <div>
                    <span>Total Mahasiswa</span>
                    <strong>15 Orang</strong>
                </div>

                <div>
                    <span>Dosen Pengampu</span>
                    <strong>Pak Hendrik Fery Herdiyatmoko, S.T., M.Eng.</strong>
                </div>

                <div>
                    <span>Project</span>
                    <strong>UAS Kriptografi</strong>
                </div>
            </div>

            <div class="member-table-wrap">
                <table class="member-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01</td>
                            <td>Sepiyanna Nopitasari</td>
                            <td>2313001</td>
                        </tr>

                        <tr>
                            <td>02</td>
                            <td>Yulianus Febry Tri Nugroho</td>
                            <td>2313002</td>
                        </tr>

                        <tr>
                            <td>03</td>
                            <td>Kevin Winardi</td>
                            <td>2313004</td>
                        </tr>

                        <tr>
                            <td>04</td>
                            <td>Jeremia Sandy Pratama</td>
                            <td>2313005</td>
                        </tr>

                        <tr>
                            <td>05</td>
                            <td>Steven Chan</td>
                            <td>2313006</td>
                        </tr>

                        <tr>
                            <td>06</td>
                            <td>Aji Prayogo</td>
                            <td>2313008</td>
                        </tr>

                        <tr>
                            <td>07</td>
                            <td>Johannes</td>
                            <td>2313009</td>
                        </tr>

                        <tr>
                            <td>08</td>
                            <td>I Komang Darmawan</td>
                            <td>2313010</td>
                        </tr>

                        <tr>
                            <td>09</td>
                            <td>Alifah Khoirunnisaa</td>
                            <td>2313011</td>
                        </tr>

                        <tr>
                            <td>10</td>
                            <td>Marselinus Dewadaru Bayu A</td>
                            <td>2313012</td>
                        </tr>

                        <tr>
                            <td>11</td>
                            <td>William Liu</td>
                            <td>2313013</td>
                        </tr>

                        <tr>
                            <td>12</td>
                            <td>Wirda Arta Meivia</td>
                            <td>2313015</td>
                        </tr>

                        <tr>
                            <td>13</td>
                            <td>Heronimus Diego Prasetya</td>
                            <td>2313016</td>
                        </tr>

                        <tr>
                            <td>14</td>
                            <td>Farrel Edric Sinambela</td>
                            <td>2313017</td>
                        </tr>

                        <tr>
                            <td>15</td>
                            <td>Delon Setiawan</td>
                            <td>2313018</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="dashboard-section dashboard-section-bordered">
        <div class="container identity-grid">
            <div>
                <p class="caption">TECHNOLOGY STACK</p>
                <h2>STACK WEBSITE</h2>

                <div class="data-list data-list-spaced">
                    <div class="data-row">
                        <span>Framework</span>
                        <strong>Laravel</strong>
                    </div>

                    <div class="data-row">
                        <span>Template Engine</span>
                        <strong>Blade</strong>
                    </div>

                    <div class="data-row">
                        <span>Style</span>
                        <strong>Custom CSS</strong>
                    </div>

                    <div class="data-row">
                        <span>Script</span>
                        <strong>JavaScript Ringan</strong>
                    </div>
                </div>
            </div>

            <div>
                <p class="caption">SYSTEM SCOPE</p>
                <h2>BATASAN WEBSITE</h2>

                <div class="scope-list">
                    <div>
                        <span>01</span>
                        <p>Website ini dibuat untuk pembelajaran mata kuliah Kriptografi.</p>
                    </div>

                    <div>
                        <span>02</span>
                        <p>Implementasi algoritma diarahkan untuk simulasi dan pemahaman proses.</p>
                    </div>

                    <div>
                        <span>03</span>
                        <p>Website ini tidak digunakan sebagai sistem keamanan produksi.</p>
                    </div>

                    <div>
                        <span>04</span>
                        <p>Data hasil proses tidak disimpan ke database.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="dashboard-cta">
        <div class="container narrow">
            <p class="caption">START LEARNING</p>
            <h2>MULAI DARI KONSEP DASAR</h2>
            <p>
                Pahami dahulu konsep umum Kriptografi pada Dashboard, lalu lanjutkan ke modul Hash, RSA, DES, dan GOST untuk
                melihat prosesnya secara langsung.
            </p>

            <div class="hero-actions">
                <a href="{{ route('hash') }}" class="button-primary">START WITH HASH</a>
                <a href="#crypto-introduction" class="button-secondary">BACK TO CONCEPT</a>
            </div>
        </div>
    </section>
@endsection
