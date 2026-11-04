# Test Case Manual: Pertemuan 10 (Create + Read Course)

| Keterangan | Isi |
|---|---|
| Proyek | KursusKu |
| Fitur diuji | Daftar kursus (`/courses`) dan tambah kursus (`/courses/create`) |
| Nama | M. Rifald Aktoyosvian |
| NIM | 2523261 |
| Tanggal uji | 03/11/2026 |
| Browser | |

---

## A. Test case wajib (8 skenario)

| No | Skenario | Langkah singkat | Input | Hasil yang diharapkan | Hasil aktual | Status | Evidence |
|----|----------|-----------------|-------|------------------------|--------------|--------|----------|
| 1 | Simpan data valid | Isi semua field, klik Simpan Kursus | code `WEB-101`, name `Web Dasar`, fee `300000`, quota `25`, start_date tanggal setelah hari praktikum, status `open` | Redirect ke `/courses`, muncul alert hijau "Kursus berhasil ditambahkan.", data tampil di daftar dan ada di tabel `courses` | | | `04-index-8-data.png` |
| 2 | Kode kosong | Kosongkan Kode Kursus, isi field lain valid, klik Simpan | code = (kosong) | Validasi gagal, tetap di form, field kode merah dengan pesan error, tidak ada data baru di database | | | `05-validation-error.png` |
| 3 | Kode duplikat | Tambah kursus dengan kode yang sudah ada (data nomor 1 harus sudah tersimpan) | code `WEB-101` untuk kedua kali | Ditolak oleh aturan `unique:courses,code`, pesan error muncul, jumlah data tidak bertambah | | | |
| 4 | Nama kosong | Kosongkan Nama Kursus, field lain valid | name = (kosong) | Validasi gagal, pesan error pada field nama | | | |
| 5 | Biaya negatif | Isi biaya dengan angka negatif | fee `-1000` | Ditolak oleh aturan `min:0` | | | |
| 6 | Kuota nol | Isi kuota 0 | quota `0` | Ditolak oleh aturan `min:1` | | | |
| 7 | Status tidak valid | Ubah nilai radio status lewat Inspect Element, lalu simpan | status `active` | Ditolak oleh aturan `in:draft,open,closed` | | | |
| 8 | Daftar tampil ulang | Buka `/courses`, tekan reload (F5), buka juga tabel `courses` di phpMyAdmin | Tanpa input | Data tetap ada setelah reload karena dibaca dari MySQL, bukan dari memori | | | |

### Catatan teknis cara menguji

- **Test 2 sampai 6:** form memakai `novalidate`, jadi browser tidak menahan input. Cukup kosongkan atau isi nilai salah, lalu klik Simpan. Yang menampilkan error adalah **Laravel (server)**.
- **Test 7:** klik kanan kartu status (mis. Open), pilih **Inspect**, cari `<input type="radio" name="status" value="open">`, ubah `value="open"` menjadi `value="active"`, pilih kartu itu, lalu klik Simpan.
- **Test 3:** pastikan WEB-101 sudah tersimpan dari test 1.
- Setelah test gagal validasi, periksa juga isian lain **tidak hilang** (fungsi `old()`).

---

## B. Test case tambahan (opsional, nilai plus)

| No | Skenario | Input | Hasil yang diharapkan | Hasil aktual | Status |
|----|----------|-------|------------------------|--------------|--------|
| 9 | Deskripsi kosong | description dikosongkan, field lain valid | Tersimpan (deskripsi bersifat `nullable`) | | |
| 10 | Tanggal mulai kosong | start_date dikosongkan | Ditolak (`required`, `date`) | | |
| 11 | Kuota di atas batas | quota `501` | Ditolak oleh aturan `max:500` | | |
| 12 | Kode melebihi 20 karakter | code berisi 21 karakter atau lebih | Ditolak oleh aturan `max:20` | | |
| 13 | Biaya gratis | fee `0` | Tersimpan, daftar menampilkan `Rp 0` | | |
| 14 | Tombol Batal | Klik Batal di form | Kembali ke `/courses`, tidak ada data baru | | |
| 15 | Pencarian di daftar | Ketik `php` pada kolom cari | Hanya kursus berkode atau bernama mengandung "php" yang tampil | | |
| 16 | Filter status | Klik filter Open, Draft, Closed | Daftar hanya menampilkan status yang dipilih | | |

---

## C. Pemeriksaan database

Setelah test 1, buka phpMyAdmin > database `kursusku` > tabel `courses` > **Browse**.

| Pemeriksaan | Hasil yang diharapkan | Sesuai? |
|---|---|---|
| Baris WEB-101 ada | Ada tepat satu baris | |
| Kolom `fee` | Berisi angka tanpa titik/koma (mis. 300000) | |
| Kolom `start_date` | Berformat `YYYY-MM-DD` | |
| Kolom `created_at` / `updated_at` | Terisi otomatis | |
| Setelah test gagal (2 sampai 7) | Jumlah baris tidak bertambah | |

Cek cepat lewat Tinker:

```bash
php artisan tinker
>>> App\Models\Course::count();
>>> App\Models\Course::where('code', 'WEB-101')->count();   # harus 1
```

---

## D. Rekap hasil

| Ringkasan | Jumlah |
|---|---|
| Total test wajib | 8 |
| Lulus | |
| Gagal | |
| Test tambahan dikerjakan | |

### Bug / catatan temuan

| No | Temuan | Penyebab | Perbaikan |
|----|--------|----------|-----------|
| | | | |

---

## E. Daftar evidence yang disiapkan

```
evidence/week-10/
├── 01-database.png
├── 02-courses-structure.png
├── 03-create-form.png
├── 04-index-8-data.png
├── 05-validation-error.png
└── test-cases.md
```

## F. Pertanyaan lisan yang mungkin ditanyakan

1. Jelaskan alur data dari form sampai tampil di daftar kursus.
2. Apa beda tabel `courses` dan model `Course`?
3. Mengapa kolom `code` dibuat unique, dan di mana aturan itu dipasang?
4. Apa beda `Course::latest()->get()` dan `Course::create($data)`?
5. Jika validasi gagal, apakah perintah INSERT dijalankan? Mengapa?
6. Mengapa model memerlukan `$fillable`?
7. Mengapa form wajib memakai `@csrf`?
