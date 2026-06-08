# Crypto Lab

Crypto Lab adalah website pembelajaran Kriptografi berbasis Laravel yang dibuat untuk membantu pengguna memahami konsep, alur kerja, simulasi, dan perbedaan beberapa algoritma kriptografi, yaitu Hash, RSA, DES, dan GOST.

Website ini dikembangkan sebagai project UAS Mata Kuliah Kriptografi. Fokus utama website ini adalah pembelajaran, bukan implementasi keamanan untuk penggunaan produksi.

## Daftar Isi

* [Tentang Project](#tentang-project)
* [Fitur Utama](#fitur-utama)
* [Modul Algoritma](#modul-algoritma)
* [Tampilan dan Desain](#tampilan-dan-desain)
* [Teknologi yang Digunakan](#teknologi-yang-digunakan)
* [Kebutuhan Sistem](#kebutuhan-sistem)
* [Cara Instalasi Lokal](#cara-instalasi-lokal)
* [Konfigurasi Environment](#konfigurasi-environment)
* [Cara Menjalankan Website](#cara-menjalankan-website)
* [Daftar Halaman](#daftar-halaman)
* [Struktur Project](#struktur-project)
* [Catatan Input Simulasi](#catatan-input-simulasi)
* [Batasan Website](#batasan-website)
* [Troubleshooting](#troubleshooting)
* [Tim Pengembang](#tim-pengembang)
* [Dosen Pengampu](#dosen-pengampu)

## Tentang Project

Crypto Lab merupakan website edukasi yang menyajikan materi dan simulasi algoritma kriptografi secara interaktif. Website ini dirancang agar pengguna dapat memahami fungsi dasar setiap algoritma, mulai dari konsep umum, cara kerja, perhitungan inti, simulasi, output proses, sampai mini game pembelajaran.

Algoritma yang dibahas dalam website ini adalah:

* Hash
* RSA
* DES
* GOST

Setiap modul memiliki karakter berbeda. Hash digunakan untuk menghasilkan message digest dan verifikasi data. RSA digunakan untuk memahami konsep kriptografi asimetris. DES dan GOST digunakan untuk mempelajari kriptografi simetris berbasis block cipher.

## Fitur Utama

Website Crypto Lab memiliki beberapa fitur utama:

* Dashboard utama yang menjelaskan pengantar Kriptografi dan ringkasan seluruh modul.
* Modul Hash dengan fitur generate hash dan verify hash.
* Modul RSA dengan fitur generate key, encrypt, dan decrypt.
* Modul DES dengan fitur encrypt dan decrypt untuk satu blok data.
* Modul GOST dengan fitur encrypt dan decrypt untuk satu blok data.
* Mini game pada setiap halaman algoritma.
* Output simulasi yang menampilkan hasil dan ringkasan proses.
* Desain responsif untuk desktop, tablet, dan mobile.
* Navbar sticky dengan indikator halaman aktif.
* Tombol kembali ke atas halaman.
* Animasi fade-up halus pada konten.
* Card interaktif dengan hover perspective pada desktop.
* Tabel responsif yang aman pada layar kecil.
* Halaman About berisi identitas project, dosen pengampu, dan tim pengembang.

## Modul Algoritma

### 1. Hash

Modul Hash membahas fungsi hash sebagai fungsi satu arah. Pada halaman ini, pengguna dapat memahami perbedaan antara hash dan enkripsi.

Fitur pada modul Hash:

* Penjelasan konsep Hash.
* Sejarah singkat Hash.
* Perbandingan Hash dan Enkripsi.
* Daftar algoritma Hash.
* Generate Hash.
* Verify Hash.
* Output panjang input, panjang output, dan hasil hash.
* Mini game Hash Detective.

Algoritma Hash yang tersedia:

* MD5
* SHA-1
* SHA-256
* SHA-512

Catatan:

Hash tidak dapat didekripsi. Proses yang benar untuk memeriksa hash adalah melakukan verify, yaitu menghitung ulang hash dari plaintext dan membandingkannya dengan hash pembanding.

### 2. RSA

Modul RSA membahas kriptografi asimetris menggunakan public key dan private key.

Fitur pada modul RSA:

* Penjelasan konsep RSA.
* Sejarah singkat RSA.
* Perbandingan RSA dengan Hash.
* Cara kerja RSA.
* Rumus dasar RSA.
* Generate Key.
* Encrypt RSA.
* Decrypt RSA.
* Output public key, private key, ciphertext, dan plaintext.
* Mini game RSA Key Builder.

Konsep utama RSA:

```text
Public Key  = (e, n)
Private Key = (d, n)
```

Rumus dasar RSA:

```text
n = p × q
φ(n) = (p - 1) × (q - 1)
C = M^e mod n
M = C^d mod n
```

Catatan:

RSA pada website ini digunakan untuk simulasi pembelajaran dengan bilangan kecil. Implementasi RSA produksi membutuhkan ukuran key besar dan padding yang aman.

### 3. DES

Modul DES membahas Data Encryption Standard sebagai algoritma kriptografi simetris berbasis block cipher.

Fitur pada modul DES:

* Penjelasan konsep DES.
* Sejarah singkat DES.
* Perbandingan DES dengan Hash dan RSA.
* Cara kerja DES.
* Key Schedule DES.
* Rumus Feistel.
* Simulasi Encrypt DES.
* Simulasi Decrypt DES.
* Ringkasan 16 round DES.
* Mini game DES Flow Builder.

Konsep utama DES:

```text
Block Size        : 64-bit
Input Key         : 64-bit
Effective Key     : 56-bit
Round             : 16 Feistel Rounds
```

Rumus Feistel DES:

```text
Lᵢ = Rᵢ₋₁
Rᵢ = Lᵢ₋₁ XOR F(Rᵢ₋₁, Kᵢ)
```

Catatan:

DES pada website ini digunakan untuk pembelajaran. DES tidak direkomendasikan untuk keamanan modern karena ukuran key efektifnya relatif pendek.

### 4. GOST

Modul GOST membahas GOST 28147-89 atau Magma sebagai algoritma kriptografi simetris berbasis block cipher.

Fitur pada modul GOST:

* Penjelasan konsep GOST.
* Sejarah singkat GOST.
* Perbandingan GOST dengan Hash, RSA, dan DES.
* Cara kerja GOST.
* Key Schedule GOST.
* Rumus round function GOST.
* Simulasi Encrypt GOST.
* Simulasi Decrypt GOST.
* Ringkasan 8 subkey.
* Ringkasan 32 round GOST.
* Mini game GOST Round Builder.

Konsep utama GOST:

```text
Block Size : 64-bit
Key Size   : 256-bit
Round      : 32 Feistel Rounds
```

Rumus round function GOST:

```text
F(R, K) = ROTL11(S((R + K) mod 2³²))
```

Catatan:

GOST pada website ini memakai simulasi satu blok data untuk kebutuhan pembelajaran. Website ini tidak membahas mode operasi seperti CBC, CFB, OFB, atau CTR.

## Tampilan dan Desain

Crypto Lab memakai desain gelap dengan gaya modern, minimalis, glassmorphism, dan sentuhan Material You.

Standar desain yang digunakan:

* Canvas hitam.
* Tipografi uppercase.
* Border tipis.
* Card transparan tanpa fill color permanen.
* Efek glow halus.
* Hover perspective pada desktop.
* Hover berat dimatikan pada mobile.
* Animasi fade-up berurutan per section.
* Tidak memakai animasi scramble pada konten utama.
* Tabel tidak diberi animasi agar scroll mobile tetap aman.
* Tabel panjang menggunakan horizontal scroll.
* Tabel konsep pendek pada mobile diubah menjadi comparison card.

## Teknologi yang Digunakan

Website ini dibangun menggunakan:

| Teknologi  | Fungsi                                 |
| ---------- | -------------------------------------- |
| Laravel    | Framework utama aplikasi               |
| PHP        | Logika backend dan service algoritma   |
| Blade      | Template tampilan                      |
| HTML       | Struktur halaman                       |
| CSS Custom | Desain visual dan responsivitas        |
| JavaScript | AJAX, animasi, interaksi halaman, game |
| Composer   | Manajemen dependency Laravel           |
| Git        | Version control                        |
| GitHub     | Repository project                     |

## Kebutuhan Sistem

Untuk menjalankan project ini secara lokal, gunakan kebutuhan berikut:

* PHP 8.2 atau lebih baru
* Composer
* Git
* Web browser modern
* Laragon, XAMPP, atau server lokal sejenis

Ekstensi PHP yang disarankan aktif:

```text
mbstring
dom
xml
openssl
pdo
pdo_sqlite
fileinfo
ctype
json
tokenizer
```

## Cara Instalasi Lokal

Clone repository:

```bash
git clone https://github.com/USERNAME/crypto-lab.git
cd crypto-lab
```

Ganti `USERNAME` dengan username GitHub pemilik repository.

Install dependency Laravel:

```bash
composer install
```

Salin file environment:

```bash
cp .env.example .env
```

Pada Windows Git Bash, perintah di atas bisa digunakan. Pada Command Prompt, gunakan:

```bash
copy .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Bersihkan cache Laravel:

```bash
php artisan optimize:clear
```

Jalankan website:

```bash
php artisan serve
```

Buka website di browser:

```text
http://127.0.0.1:8000
```

## Konfigurasi Environment

Contoh konfigurasi `.env` untuk lokal:

```env
APP_NAME="Crypto Lab"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=sqlite

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Project ini tidak membutuhkan database untuk menyimpan data simulasi. Input dan output simulasi diproses saat request berjalan dan tidak disimpan sebagai data permanen.

Untuk hosting atau production, gunakan:

```env
APP_ENV=production
APP_DEBUG=false
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

## Cara Menjalankan Website

Jalankan perintah:

```bash
php artisan serve
```

Lalu buka:

```text
http://127.0.0.1:8000
```

Cek halaman berikut:

```text
http://127.0.0.1:8000/
http://127.0.0.1:8000/hash
http://127.0.0.1:8000/rsa
http://127.0.0.1:8000/des
http://127.0.0.1:8000/gost
http://127.0.0.1:8000/tentang
```

## Daftar Halaman

| Route      | Halaman   | Fungsi                                                |
| ---------- | --------- | ----------------------------------------------------- |
| `/`        | Dashboard | Pengantar Kriptografi dan ringkasan modul             |
| `/hash`    | Hash      | Generate dan verify hash                              |
| `/rsa`     | RSA       | Generate key, encrypt, dan decrypt RSA                |
| `/des`     | DES       | Encrypt dan decrypt DES                               |
| `/gost`    | GOST      | Encrypt dan decrypt GOST                              |
| `/tentang` | About     | Informasi project, dosen pengampu, dan tim pengembang |

## Struktur Project

Struktur utama project:

```text
crypto-lab/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── CryptoPageController.php
│   └── Services/
│       ├── HashService.php
│       ├── RsaService.php
│       ├── DesService.php
│       └── GostService.php
│
├── public/
│   └── assets/
│       ├── css/
│       │   ├── app.css
│       │   └── dashboard-animations.css
│       ├── js/
│       │   └── app.js
│       └── images/
│           └── team/
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       └── pages/
│           ├── home.blade.php
│           ├── hash.blade.php
│           ├── rsa.blade.php
│           ├── des.blade.php
│           ├── gost.blade.php
│           └── about.blade.php
│
├── routes/
│   └── web.php
│
├── storage/
├── composer.json
├── artisan
└── README.md
```

## Catatan Input Simulasi

### Hash

Input:

* Plaintext bebas.
* Pilih algoritma Hash.
* Untuk verify, masukkan plaintext dan hash pembanding.

Output:

* Hash result.
* Panjang input.
* Panjang output.
* Status cocok atau tidak cocok untuk verify.

### RSA

Input Generate Key:

* `p` harus bilangan prima.
* `q` harus bilangan prima.
* `p` dan `q` tidak boleh sama.
* `e` harus relatif prima terhadap `φ(n)`.

Input Encrypt:

* Plaintext.
* Public key `(e, n)`.

Input Decrypt:

* Ciphertext angka.
* Private key `(d, n)`.

### DES

Input Encrypt:

* Plaintext maksimal 8 karakter.
* Key tepat 8 karakter.

Input Decrypt:

* Ciphertext hex 16 karakter.
* Key tepat 8 karakter.

### GOST

Input Encrypt:

* Plaintext maksimal 8 karakter.
* Key tepat 32 karakter.

Input Decrypt:

* Ciphertext hex 16 karakter.
* Key tepat 32 karakter.

## Batasan Website

Website ini memiliki beberapa batasan:

1. Website digunakan untuk pembelajaran, bukan keamanan produksi.
2. Input simulasi tidak disimpan sebagai data permanen.
3. Beberapa proses algoritma dibuat dalam bentuk ringkasan agar mudah dipahami.
4. DES dan GOST hanya mensimulasikan satu blok data.
5. RSA menggunakan bilangan kecil agar proses perhitungan mudah ditampilkan.
6. Hash hanya menyediakan generate dan verify, bukan decrypt.
7. Website tidak membahas seluruh mode operasi block cipher.
8. Website tidak digunakan untuk melindungi data sensitif.

## Troubleshooting

### 1. Halaman error setelah clone

Jalankan:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan optimize:clear
php artisan serve
```

### 2. Error `No application encryption key has been specified`

Jalankan:

```bash
php artisan key:generate
```

### 3. CSS atau JavaScript tidak berubah

Jalankan:

```bash
php artisan optimize:clear
```

Lalu tekan:

```text
Ctrl + F5
```

### 4. Laravel error karena ekstensi PHP

Pastikan ekstensi berikut aktif:

```text
mbstring
dom
xml
openssl
pdo
pdo_sqlite
fileinfo
ctype
json
tokenizer
```

### 5. Error permission pada storage

Pada Linux atau hosting, jalankan:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 6. Form simulasi tidak berjalan

Pastikan JavaScript utama terbaca:

```text
public/assets/js/app.js
```

Pastikan juga browser tidak memblokir asset CSS atau JS.

## Deploy ke Hosting

Untuk hosting berbasis cPanel, struktur yang disarankan:

```text
/home/username/repositories/crypto-lab
/home/username/public_html/crypto-lab
```

Folder aplikasi Laravel utama sebaiknya berada di luar `public_html`. Folder yang diakses publik hanya isi dari folder `public`.

Contoh struktur:

```text
repositories/
└── crypto-lab/
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── vendor/
    └── artisan

public_html/
└── crypto-lab/
    ├── assets/
    ├── index.php
    ├── favicon.ico
    ├── robots.txt
    └── .htaccess
```

Pada file `public_html/crypto-lab/index.php`, path Laravel perlu disesuaikan ke folder repository utama.

Contoh:

```php
require __DIR__.'/../../repositories/crypto-lab/vendor/autoload.php';

$app = require_once __DIR__.'/../../repositories/crypto-lab/bootstrap/app.php';
```

## Tim Pengembang

Project ini dikembangkan oleh mahasiswa kelas Mata Kuliah Kriptografi.

### Algoritma Hash

| Nama                | NIM     |
| ------------------- | ------- |
| Sepiyana Nopitasari | 2313001 |
| Aji Prayogo         | 2313008 |
| Johannes            | 2313009 |
| Delon Setiawan      | 2313018 |

### Algoritma RSA

| Nama                       | NIM     |
| -------------------------- | ------- |
| Yulianus Febry Tri Nugroho | 2313002 |
| Heronimus Diego Prasetya   | 2313016 |
| Wirda Arta Meivia          | 2313015 |

### Algoritma DES

| Nama                               | NIM     |
| ---------------------------------- | ------- |
| Marselinus Dewadaru Bayu Adeodatus | 2313012 |
| I Komang Darmawan                  | 2313010 |
| Alifah Khoirunnisaa                | 2313011 |
| Jeremia Sandy Pratama              | 2313005 |

### Algoritma GOST

| Nama                   | NIM     |
| ---------------------- | ------- |
| Kevin Winardi          | 2313004 |
| William Liu            | 2313013 |
| Steven Chan            | 2313006 |
| Farrel Edric Sinambela | 2313017 |

## Dosen Pengampu

```text
Pak Hendrik Fery Herdiyatmoko, S.T., M.Eng.
```

## Catatan Akademik

Crypto Lab dibuat sebagai project UAS Mata Kuliah Kriptografi. Website ini berfokus pada pemahaman konsep dasar algoritma, bukan sebagai sistem keamanan produksi.

## Lisensi

Project ini dibuat untuk kebutuhan pembelajaran. Penggunaan ulang diperbolehkan untuk tujuan edukasi dengan tetap mencantumkan sumber atau kredit kepada tim pengembang.
