# AI Usage Log: Praktikum Pertemuan 7 (KursusKu)

| Keterangan | Isi |
|---|---|
| Mata kuliah | Bahasa Pemrograman III (PHP & MySQL) / Pemrograman Web III |
| Pertemuan | 7 - Framework Laravel, MVC, Route, Controller & View |
| Proyek | KursusKu (Laravel) - Milestone 7 |
| Alat AI | Claude (Anthropic), lewat chat |
| Nama / NIM | M. Rifald Aktoyosvian / 2523261 |
| Tanggal pengerjaan | 27 Oktober 2026 |

---

## 1. Pernyataan penggunaan AI

AI saya pakai untuk dua hal:

1. **Pemandu/tutor** yang menjelaskan tahap praktikum satu per satu (membuat project, route, controller, Blade, aset, Git, README), beserta checkpoint dan troubleshooting.
2. **Penulis contoh kode** untuk redesign tampilan landing page (`public/css/style.css` dan `resources/views/home.blade.php`), dan untuk draf dokumen evidence (diagram request lifecycle dan log ini).

Bagian inti Milestone 7 (`routes/web.php`, `HomeController.php`, `home.blade.php` dasar, aset CSS dan gambar) mengikuti kode contoh pada panduan praktikum. Kode itu saya ketik, jalankan, dan uji sendiri di Laragon.



---

## 2. Log penggunaan

| No | Waktu | Masalah / tujuan | Prompt singkat | Apa yang saya terima / tolak |
|---|---|---|---|---|
| 1 | 08.12 | Memahami urutan kerja praktikum | "Bayangkan Anda mahasiswa pemrograman, bantu dan pandu saya mengerjakan praktikum ini secara rinci." | **Diterima:** urutan tahap kerja, checkpoint, dan daftar evidence. |
| 2 | 08.50 | Membuat project Laravel (Tahap 1) | "Jelaskan lebih rinci dari tahap 1." | **Diterima:** langkah cek PHP/Composer, `laravel new` atau `composer create-project`, `php artisan serve`.  |
| 3 | 09.21 | Terminal tidak menampilkan bentuk prompt seperti pada penjelasan | "Kenapa prompt `C:\laragon\www>` tidak muncul padahal instalasi sudah selesai?" | **Diterima:** koreksi bahwa bentuk prompt bisa berbeda (Laragon Terminal, PowerShell), dan cara memastikan lewat `dir` dan `php artisan --version`. **Catatan:** penjelasan awal AI memberi contoh prompt yang terlalu spesifik, lalu dikoreksi. |
| 4 | 09.58 | Route pertama (Tahap 2) | "Lanjutkan." | **Diterima:** isi `routes/web.php` dan `php artisan route:list`.  |
| 5 | 10.16 | `PHP Fatal error` saat `php artisan route:list` | "Pada `php artisan route:list` hasilnya PHP Fatal error." | **Diterima:** langkah diagnosis (baca jenis error, nama file, nomor baris), bukan solusi penuh. **Penyebab sebenarnya di proyek saya:** Karna berbeda nya php yang ada pada visual code dengan php pada laravel |
| 6 | 10.53 | Membuat HomeController (Tahap 3) | "Lanjutkan." dan "Dimana isinya?" | **Diterima:** `php artisan make:controller`, lokasi file `app/Http/Controllers/HomeController.php`, isi method `index()`, dan route yang memakai controller. |
| 7 | 11.34 | Mengirim data dari controller (Tahap 4) | "Lanjutkan." | **Diterima:** array `$featured`, `$siteName`, dan `compact()`. Error `View [home] not found` pada tahap ini dijelaskan sebagai hal yang wajar. |
| 8 | 11.50 | Membuat Blade view (Tahap 5) | "Lanjutkan." | **Diterima:** `home.blade.php` dengan `{{ }}` dan `@foreach`. |
| 9 | 12.15 | Aset CSS dan gambar (Tahap 6) | "Lanjutkan." | **Diterima:** folder `public/css` dan `public/images`, helper `asset()`. |
| 10 | 12.35 | Landing page lengkap (Tahap 7) | "Lanjutkan." | **Diterima:** struktur navbar, hero, dan course grid sesuai panduan. |
| 11 | 12.45 | Pembuktian alur dan diagram (Tahap 8) | "Lanjutkan." | **Diterima:** tiga eksperimen (route, controller, view) dan bentuk diagram. |
| 12 | 12.55 | Redesign CSS dan daftar screenshot | "Buat praktikum akhirnya, desain ulang CSS-nya dan tunjukkan bagian mana yang di-screenshot." | **Diterima:** `style.css` baru, penyesuaian nama kelas di Blade, dan daftar screenshot. |
| 13 | 13.20 | Tampilan lebih menarik | "Buat tampilan dan warnanya yang sangat menarik." | **Diterima:** versi gradient teal dan emas, statistik kecil, kartu bernomor (`$loop->iteration`). |
| 14 | 13.53 | Dokumen evidence | "Sekarang buatkan saya `ai-usage-log` dan `request-lifecycle`." | **Diterima:** diagram `request-lifecycle.pdf`/`.png` dan draf log ini. |



---

## 3. Yang saya verifikasi sendiri

Centang hanya yang benar-benar sudah kamu lakukan.

- [✔] Menjalankan project dan melihat landing page tampil di browser
- [✔] Menjalankan `php artisan route:list` dan melihat route `home` menunjuk ke `HomeController@index`
- [✔] Mengubah nama kursus di controller, dan perubahan muncul tanpa mengubah Blade
- [✔] Menambah satu kursus di array, dan kartu bertambah otomatis
- [✔] Mengubah judul "Kursus Pilihan" hanya di Blade
- [✔] Menguji tampilan mobile (satu kolom di bawah 760px)
- [✔] Membuka URL tidak ada (misalnya `/abc`) dan melihat halaman 404
- [✔] Menjalankan ulang project dari README
- [✔] Menjelaskan alur Browser → Route → Controller → Blade → HTML tanpa melihat kode

---


## 4. Batasan yang saya patuhi

- Tidak meminta AI membuat seluruh aplikasi sekaligus; pekerjaan dikerjakan per tahap kecil.
- Tidak menambahkan database, login, CRUD, relasi tabel, atau Ajax pada Milestone 7.
- Tidak memasang package tambahan.
- Prototype PHP biasa (pertemuan 2-6) tetap disimpan sebagai evidence.
