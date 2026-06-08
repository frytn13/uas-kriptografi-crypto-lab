@extends('layouts.app')

@section('title', 'Crypto Lab | Tentang')

@section('content')
@php
    $lecturer = [
        'name' => 'Hendrik Fery Herdiyatmoko, S.T., M.Eng.',
        'role' => 'Dosen Pengampu',
        'module' => 'LECTURER',
        'division' => 'THE FINAL REVIEWER',
        'persona' => 'The Final Boss',
        'quote' => 'Are You Sure?',
        'image' => asset('assets/images/team/dosen-pengampu.webp'),
    ];

    $members = [
        [
            'name' => 'Sepiyana Nopitasari',
            'nim' => '2313001',
            'module' => 'HASH',
            'division' => 'CONTENT OFFICER',
            'persona' => 'Si Paling Tenang',
            'quote' => 'Senyumnya damai, pikirannya mau jajan.',
            'image' => asset('assets/images/team/sepiyana-nopitasari.webp'),
        ],
        [
            'name' => 'Aji Prayogo',
            'nim' => '2313008',
            'module' => 'HASH',
            'division' => 'QUALITY OFFICER',
            'persona' => 'Si Fokus Tipis',
            'quote' => 'Fokus boleh, lapar tetap nomor satu.',
            'image' => asset('assets/images/team/aji-prayogo.webp'),
        ],
        [
            'name' => 'Johannes',
            'nim' => '2313009',
            'module' => 'HASH',
            'division' => 'PROJECT ASSOCIATE',
            'persona' => 'Si Kalem Berbahaya',
            'quote' => 'Diam-diam tahu tempat makan enak.',
            'image' => asset('assets/images/team/johannes.webp'),
        ],
        [
            'name' => 'Delon Setiawan',
            'nim' => '2313018',
            'module' => 'HASH',
            'division' => 'OPERATION OFFICER',
            'persona' => 'Si Santai Elegan',
            'quote' => 'Santai bukan malas, hanya hemat tenaga.',
            'image' => asset('assets/images/team/delon-setiawan.webp'),
        ],
        [
            'name' => 'Yulianus Febry Tri Nugroho',
            'nim' => '2313002',
            'module' => 'RSA',
            'division' => 'PROJECT DIRECTOR',
            'persona' => 'Si Santai Berkelas',
            'quote' => 'Kalau hidup berat, duduk dulu.',
            'image' => asset('assets/images/team/yulianus-febry-tri-nugroho.webp'),
        ],
        [
            'name' => 'Heronimus Diego Prasetya',
            'nim' => '2313016',
            'module' => 'RSA',
            'division' => 'QUALITY OFFICER',
            'persona' => 'Si Tenang Natural',
            'quote' => 'Kalem itu bakat, ngantuk itu takdir.',
            'image' => asset('assets/images/team/heronimus-diego-prasetya.webp'),
        ],
        [
            'name' => 'Wirda Arta Meivia',
            'nim' => '2313015',
            'module' => 'RSA',
            'division' => 'CREATIVE OFFICER',
            'persona' => 'Si Ceria Maksimal',
            'quote' => 'Senyum dulu, masalah belakangan.',
            'image' => asset('assets/images/team/wirda-arta-meivia.webp'),
        ],
        [
            'name' => 'Marselinus Dewadaru Bayu Adeodatus',
            'nim' => '2313012',
            'module' => 'DES',
            'division' => 'DEPUTY DIRECTOR',
            'persona' => 'Si Penuh Strategi',
            'quote' => 'Kelihatan santai, padahal sedang mencari alasan.',
            'image' => asset('assets/images/team/marselinus-dewadaru-bayu-adeodatus.webp'),
        ],
        [
            'name' => 'I Komang Darmawan',
            'nim' => '2313010',
            'module' => 'DES',
            'division' => 'STRATEGIC OFFICER',
            'persona' => 'Si Paling Aman',
            'quote' => 'Hadir dulu, pahamnya menyusul.',
            'image' => asset('assets/images/team/i-komang-darmawan.webp'),
        ],
        [
            'name' => 'Alifah Khoirunnisaa',
            'nim' => '2313011',
            'module' => 'DES',
            'division' => 'CREATIVE OFFICER',
            'persona' => 'Si Rapi Estetik',
            'quote' => 'Kalau belum cantik, belum selesai.',
            'image' => asset('assets/images/team/alifah-khoirunnisaa.webp'),
        ],
        [
            'name' => 'Jeremia Sandy Pratama',
            'nim' => '2313005',
            'module' => 'DES',
            'division' => 'PROJECT ASSOCIATE',
            'persona' => 'Si Anti Ribut',
            'quote' => 'Kalau bingung, pura-pura paham dulu.',
            'image' => asset('assets/images/team/jeremia-sandy-pratama.webp'),
        ],
        [
            'name' => 'Kevin Winardi',
            'nim' => '2313004',
            'module' => 'GOST',
            'division' => 'CONTENT OFFICER',
            'persona' => 'Si Paling Siap',
            'quote' => 'Datang rapi, pulang misterius.',
            'image' => asset('assets/images/team/kevin-winardi.webp'),
        ],
        [
            'name' => 'William Liu',
            'nim' => '2313013',
            'module' => 'GOST',
            'division' => 'OPERATION OFFICER',
            'persona' => 'Si Gerak Cepat',
            'quote' => 'Muncul sebentar, efeknya panjang.',
            'image' => asset('assets/images/team/william-liu.webp'),
        ],
        [
            'name' => 'Steven Chan',
            'nim' => '2313006',
            'module' => 'GOST',
            'division' => 'PLANNING OFFICER',
            'persona' => 'Si Banyak Rencana',
            'quote' => 'Rencananya matang, eksekusinya nunggu mood.',
            'image' => asset('assets/images/team/steven-chan.webp'),
        ],
        [
            'name' => 'Farrel Edric Sinambela',
            'nim' => '2313017',
            'module' => 'GOST',
            'division' => 'FINALIZATION OFFICER',
            'persona' => 'Si Paling Gas',
            'quote' => 'Kalau bisa nanti, kenapa harus sekarang?',
            'image' => asset('assets/images/team/farrel-edric-sinambela.webp'),
        ],
    ];

    $technologies = [
        ['label' => 'Framework', 'value' => 'Laravel 12'],
        ['label' => 'Template Engine', 'value' => 'Blade'],
        ['label' => 'Visual System', 'value' => 'Custom CSS'],
        ['label' => 'Interaction', 'value' => 'JavaScript'],
    ];

    $features = [
        ['title' => 'Materi Edukasi', 'text' => 'Setiap modul menyajikan pengertian, sejarah, perbedaan, dan alur kerja algoritma secara bertahap agar mudah dipahami.'],
        ['title' => 'Simulasi Interaktif', 'text' => 'Pengguna dapat mencoba proses generate, verify, encrypt, dan decrypt langsung dari halaman website tanpa berpindah konteks.'],
        ['title' => 'Mini Game', 'text' => 'Setiap halaman algoritma memiliki game ringan untuk membuat proses belajar lebih menarik dan tidak terasa monoton.'],
    ];
@endphp

<div class="about-page">
<section class="algorithm-hero">
    <div class="container">
        <div class="algorithm-hero-content">
            <p class="caption">PROJECT INFORMATION</p>
            <h1>ABOUT CRYPTO LAB</h1>
            <p class="algorithm-hero-text">
                Crypto Lab merupakan website pembelajaran Kriptografi berbasis Laravel yang dikembangkan untuk membantu pengguna memahami konsep dan simulasi algoritma Hash, RSA, DES, dan GOST melalui pengalaman visual yang rapi, modern, dan interaktif.
            </p>

            <div class="hero-actions">
                <a href="{{ route('home') }}" class="button-primary">BACK HOME</a>
                <a href="#team-showcase" class="button-secondary">MEET THE TEAM</a>
            </div>
        </div>

        <div class="algorithm-meta-grid">
            <div class="algorithm-meta-item">
                <span>Project</span>
                <strong>Crypto Lab</strong>
            </div>
            <div class="algorithm-meta-item">
                <span>Framework</span>
                <strong>Laravel</strong>
            </div>
            <div class="algorithm-meta-item">
                <span>Modules</span>
                <strong>Hash · RSA · DES · GOST</strong>
            </div>
            <div class="algorithm-meta-item">
                <span>Purpose</span>
                <strong>Learning Media</strong>
            </div>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container algorithm-grid-2 about-overview-grid">
        <div>
            <p class="caption">PROJECT IDENTITY</p>
            <h2>IDENTITAS DAN TUJUAN</h2>
        </div>

        <div class="text-block">
            <p>
                Website ini dikembangkan sebagai proyek UAS Mata Kuliah Kriptografi. Setiap halaman dirancang untuk menjelaskan konsep algoritma secara umum, memperlihatkan perbedaan karakter setiap algoritma, dan memberikan simulasi sederhana yang dapat langsung dicoba oleh pengguna.
            </p>
            <p>
                Tampilan visualnya dibuat konsisten dengan pendekatan gelap, tipografi tegas, efek kaca tipis, dan interaksi halus agar seluruh halaman terasa satu sistem mulai dari Dashboard sampai About.
            </p>
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">WEBSITE SCOPE</p>
                <h2>RUANG LINGKUP MODUL</h2>
            </div>
        </div>

        <div class="algorithm-grid-4">
            <article class="concept-card">
                <span>01</span>
                <h3>HASH</h3>
                <p>Modul fungsi satu arah untuk memahami proses generate dan verify message digest.</p>
            </article>
            <article class="concept-card">
                <span>02</span>
                <h3>RSA</h3>
                <p>Modul algoritma asimetris untuk key generation, enkripsi, dan dekripsi sederhana.</p>
            </article>
            <article class="concept-card">
                <span>03</span>
                <h3>DES</h3>
                <p>Modul block cipher klasik untuk mempelajari struktur Feistel dan key schedule.</p>
            </article>
            <article class="concept-card">
                <span>04</span>
                <h3>GOST</h3>
                <p>Modul block cipher simetris dengan 32 round untuk memahami operasi modular, substitusi, dan rotasi.</p>
            </article>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">KEY FEATURES</p>
                <h2>FITUR UTAMA WEBSITE</h2>
            </div>
        </div>

        <div class="algorithm-grid-3">
            @foreach ($features as $index => $feature)
                <article class="application-card">
                    <span>{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $feature['title'] }}</h3>
                    <p>{{ $feature['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="team-showcase" class="algorithm-section algorithm-section-bordered about-team-section">
    <div class="container">
        <div class="section-heading team-heading">
            <div>
                <p class="caption">TEAM SHOWCASE</p>
                <h2>PENGEMBANG DAN DOSEN PENGAMPU</h2>
            </div>
            <p class="team-heading-text">
                Halaman ini memperkenalkan dosen pengampu dan mahasiswa pengembang yang terlibat dalam pembuatan Crypto Lab. Setiap peran disusun untuk memperjelas kontribusi pada materi, simulasi, tampilan, dan penyelesaian website.
            </p>
        </div>

        <div class="team-lecturer-grid">
            <div class="team-lecturer-copy algorithm-card">
                <span>Lead Reviewer</span>
                <h3>DOSEN PENGAMPU</h3>
                <p>
                    Dosen pengampu berperan sebagai pengarah akademik yang memberi arahan, penilaian, dan pemeriksaan akhir terhadap project Crypto Lab agar hasilnya tetap sesuai dengan tujuan pembelajaran mata kuliah Kriptografi.
                </p>
            </div>

            <article class="algorithm-card team-profile-card team-profile-card--lecturer" style="--profile-image: url('{{ $lecturer['image'] }}');">
                <div class="team-profile-photo-shell">
                    <div class="team-profile-photo-glow"></div>
                    <div class="team-profile-photo-backdrop"></div>
                    <img src="{{ $lecturer['image'] }}" alt="{{ $lecturer['name'] }}" class="team-profile-photo">
                </div>

                <div class="team-profile-content">
                    <div class="team-profile-chip-row">
                        <span class="team-chip team-chip--module">{{ $lecturer['module'] }}</span>
                        <span class="team-chip team-chip--division">{{ $lecturer['division'] }}</span>
                    </div>

                    <h3>{{ strtoupper($lecturer['name']) }}</h3>
                    <p class="team-profile-id">{{ strtoupper($lecturer['role']) }}</p>

                    <div class="team-profile-meta">
                        <div>
                            <span>Nama Panggung</span>
                            <strong>{{ strtoupper($lecturer['persona']) }}</strong>
                        </div>
                        <div>
                            <span>Kata Lucu</span>
                            <strong>“{{ $lecturer['quote'] }}”</strong>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        <div class="student-team-intro algorithm-card">
            <div>
                <span>Student Development Team</span>
                <h3>MAHASISWA PENGEMBANG</h3>
                <p>
                    Mahasiswa pengembang berperan dalam menyusun isi modul, menyiapkan alur simulasi, memeriksa tampilan, dan menyelesaikan website Crypto Lab berdasarkan pembagian algoritma Hash, RSA, DES, dan GOST.
                </p>
            </div>

            <div class="student-team-stats">
                <div>
                    <strong>15</strong>
                    <span>Mahasiswa</span>
                </div>
                <div>
                    <strong>4</strong>
                    <span>Modul</span>
                </div>
                <div>
                    <strong>1</strong>
                    <span>Project</span>
                </div>
            </div>
        </div>

        <div class="team-grid">
            @foreach ($members as $member)
                <article class="algorithm-card team-profile-card team-profile-card--student" style="--profile-image: url('{{ $member['image'] }}');">
                    <div class="team-profile-topbar">
                        <span class="team-profile-number">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="team-chip team-chip--module">{{ $member['module'] }}</span>
                    </div>

                    <div class="team-profile-photo-shell">
                        <div class="team-profile-photo-glow"></div>
                        <div class="team-profile-photo-backdrop"></div>
                        <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="team-profile-photo">
                    </div>

                    <div class="team-profile-content">
                        <div class="team-profile-chip-row">
                            <span class="team-chip team-chip--division">{{ $member['division'] }}</span>
                        </div>

                        <h3>{{ strtoupper($member['name']) }}</h3>
                        <p class="team-profile-id">{{ $member['nim'] }}</p>

                        <div class="team-profile-line"></div>

                        <div class="team-profile-meta">
                            <div>
                                <span>Nama Panggung</span>
                                <strong>{{ strtoupper($member['persona']) }}</strong>
                            </div>
                            <div>
                                <span>Kata Lucu</span>
                                <strong>“{{ $member['quote'] }}”</strong>
                            </div>
                        </div>
                    </div>

                    <div class="team-profile-hover-note" aria-hidden="true">
                        <span>Hover Detail</span>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="caption">TECH STACK</p>
                <h2>TEKNOLOGI YANG DIGUNAKAN</h2>
            </div>
        </div>

        <div class="algorithm-grid-4">
            @foreach ($technologies as $index => $technology)
                <article class="formula-card">
                    <span>{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $technology['label'] }}</h3>
                    <p>{{ $technology['value'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="algorithm-section algorithm-section-bordered">
    <div class="container algorithm-grid-2 about-overview-grid">
        <div>
            <p class="caption">BOUNDARY</p>
            <h2>BATASAN WEBSITE</h2>
        </div>

        <div class="text-block">
            <p>
                Crypto Lab berfokus sebagai media pembelajaran dan simulasi, bukan sebagai implementasi keamanan untuk penggunaan produksi. Beberapa proses dibuat dalam bentuk ringkasan agar lebih mudah dipelajari dan tetap nyaman dibaca pada seluruh ukuran layar.
            </p>
            <p>
                Input pada simulasi tertentu dibatasi agar sesuai dengan kebutuhan demonstrasi algoritma, sementara data yang dimasukkan pengguna tidak disimpan sebagai arsip permanen dalam sistem.
            </p>
        </div>
    </div>
</section>

<section class="algorithm-section">
    <div class="container">
        <div class="algorithm-card about-closing-card">
            <span>FINAL STATEMENT</span>
            <h3>CRYPTO LAB SEBAGAI MEDIA PEMBELAJARAN</h3>
            <p>
                Crypto Lab dikembangkan untuk mempertemukan penjelasan teori, simulasi algoritma, dan pendekatan visual yang kuat dalam satu website. Dengan struktur halaman yang konsisten dan interaksi yang rapi, website ini diharapkan dapat membantu pengguna memahami karakter dasar Hash, RSA, DES, dan GOST secara lebih terstruktur.
            </p>
        </div>
    </div>
</section>
</div>
@endsection
