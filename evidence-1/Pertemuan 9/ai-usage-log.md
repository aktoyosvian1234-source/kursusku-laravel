# AI Usage Log - Pertemuan 9 (Milestone Week-09)

Dokumentasi konsultasi bersama AI Assistant (Claude).

> ✏️ = bagian yang hanya kamu yang tahu. Isi dengan yang benar-benar terjadi, lalu hapus tanda ✏️ dan catatan ini.

| Waktu | Masalah / Tujuan | Prompt Singkat | Apa yang Diterima / Ditolak |
| ----- | ---------------- | -------------- | --------------------------- |
| ✏️ WIB | Rencana pengerjaan Praktikum 9 (layout, navbar, form, Ajax) dan daftar screenshot | "Buatkan saya praktikum sembilan, pandu saya pembuatannya, ubah desainnya yang bagus tapi hasilnya tetap sama, dan tuntun saya bagian mana yang di-ss" | **Diterima:** Urutan kerja bertahap dengan semua route ditulis lebih dulu (supaya tidak error `Route [enrollments.create] not defined`), master layout `layouts/app.blade.php` dan `partials/navbar.blade.php` dengan `@extends`, `@yield`, `@include`, form Blade dengan `@csrf`, route JSON dummy, jQuery Ajax, serta daftar screenshot wajib dan tambahan.<br>**Ditolak:** ✏️ isi jika ada |
| ✏️ WIB | Error Vite `Failed to resolve import "./bootstrap"` pada `app.js` baris 1 | (mengirim foto layar error) "Failed to resolve import ./bootstrap from resources/js/app.js" | **Diterima:** Penyebabnya file `resources/js/bootstrap.js` tidak ada di project. Perbaikan: menghapus baris `import './bootstrap';` dan menyisakan `import 'bootstrap';` dari paket npm.<br>**Ditolak:** Memakai baris `import './bootstrap';` dari contoh awal, karena filenya tidak ada. |
| ✏️ WIB | Foto hero Pertemuan 7 hilang dari Beranda | "Kenapa foto pada tampilan di pertemuan 7 hilang" | **Diterima:** Penyebabnya `home.blade.php` versi Pertemuan 9 tidak memuat tag `<img>`. Foto dipasang kembali lewat `asset('images/hero-kursus.jpg')`, dan gayanya dipindah ke `resources/css/app.css` karena CSS lama di `public/css` tidak dipakai layout baru.<br>**Ditolak:** Versi awal kolom kanan hero yang hanya berisi kartu langkah tanpa foto. |
| ✏️ WIB | Mengembalikan kartu langkah 1-2-3 di bawah foto hero | "Yaa kembalikan" | **Diterima:** Kartu langkah ditaruh kembali di bawah foto (`.kk-steps`). Bagian ini kemudian digantikan pada perubahan berikutnya.<br>**Ditolak:** ✏️ isi jika ada |
| ✏️ WIB | Foto hero terlalu ter-zoom, menyesuaikan susunan dengan screenshot referensi | "Gambar yang anda berikan terlalu nge-zoom, buat seperti ini" (disertai screenshot referensi) | **Diterima:** Penyebab foto terpotong adalah `aspect-ratio` dan `object-fit: cover`. Diganti `width: 100%; height: auto;` supaya foto tampil utuh. Susunan navbar, hero putih dua kolom, dua tombol, foto di kanan, dan section Kursus Pilihan (kartu dari `$featured` di `HomeController`) mengikuti referensi.<br>**Ditolak:** Kartu langkah 1-2-3, serta `aspect-ratio` dan `object-fit` pada foto. |
| ✏️ WIB | Mempertahankan palet warna milik sendiri | "Untuk warna tampilan tetap memakai gaya saya sebelumnya, jangan ikuti yang ada pada contoh foto" | **Diterima:** Palet teal dan emas lewat variabel `:root` di `app.css`. Hanya file CSS yang berubah, file Blade tetap.<br>**Ditolak:** Palet merah-hitam dari versi yang mengikuti screenshot referensi (keputusan saya sendiri). |
| ✏️ WIB | Tombol Daftar Kursus lebih terlihat, font dan tampilan lebih bagus | "Pada tombol Daftar Kursus beri warna agar terlihat, dan untuk font-nya buat dengan bagus dan tampilannya juga" | **Diterima:** Tombol emas (`.btn-kk-accent`) dengan panah, font Plus Jakarta Sans lewat Google Fonts di layout, sorotan emas pada kata "KursusKu", baris tiga poin kecil, dan bingkai emas di belakang foto. Bootstrap, Popper, dan jQuery tetap lewat npm dan Vite; hanya font yang dari Google Fonts.<br>**Ditolak:** ✏️ isi jika ada |
| ✏️ WIB | Mendapatkan versi final seluruh file | "Kirim full code-nya" (diminta dua kali) | **Diterima:** Tujuh file final: `app.js`, `app.css`, `web.php`, `layouts/app.blade.php`, `partials/navbar.blade.php`, `home.blade.php`, `enrollments/create.blade.php`.<br>**Ditolak:** ✏️ isi jika ada |
| ✏️ WIB | Menyusun dokumen evidence `test-matrix.md` dan `ai-usage-log.md` | "Sekarang buatkan saya ai-usage-log dan test-matrix", lalu "buat ai usage log nya seperti ini" (disertai contoh format) | **Diterima:** Kerangka `test-matrix.md` (status PASS/FAIL diisi sendiri setelah diuji) dan `ai-usage-log.md` dalam format tabel empat kolom seperti contoh.<br>**Ditolak:** Format awal dengan bagian Tujuan, Saran diterima, Saran ditolak, dan Verifikasi per entri, diganti format tabel seperti contoh. |

## Catatan Penggunaan AI

AI saya pakai sebagai tutor dan penulis contoh kode (layout, navbar, form, CSS, route, dan jQuery Ajax) berdasarkan Panduan Praktikum Pertemuan 9. Keputusan tampilan (palet teal dan emas, foto hero utuh, tombol emas) berasal dari arahan saya sendiri.

✏️ *Tambahkan di sini bagian yang kamu tulis atau ubah sendiri, atau AI lain yang kamu pakai.*

## Verifikasi yang Saya Jalankan

Centang hanya yang benar-benar sudah kamu lakukan.

- [ ] `npm run dev` berjalan tanpa error
- [ ] Beranda tampil dengan navbar, hero, foto utuh, dan kartu kursus
- [ ] `/courses/1/availability` menampilkan JSON
- [ ] Memilih kursus mengubah sisa kursi tanpa reload (nama yang diketik tetap ada)
- [ ] Submit valid menampilkan pesan sukses, submit tidak valid menampilkan error
- [ ] DevTools Network menunjukkan `GET /courses/{id}/availability` berstatus 200 dengan response JSON
- [ ] Console: `typeof window.jQuery` menghasilkan `"function"`
- [ ] Tampilan mobile: hamburger menu bekerja
