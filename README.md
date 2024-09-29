# KrediTrust - Sistem Penentuan Pemberian Kredit

**KrediTrust** adalah sebuah aplikasi berbasis web yang dirancang untuk membantu lembaga keuangan dalam menilai kelayakan pengajuan kredit dari calon debitur. Sistem ini menggunakan sejumlah parameter seperti usia, status pernikahan, pekerjaan, penghasilan, dan jaminan untuk membuat keputusan secara objektif apakah kredit layak diterima atau ditolak.

## Fitur Utama

- **Penilaian Kelayakan Kredit**: Sistem menggunakan aturan berbasis poin untuk menilai kelayakan kredit berdasarkan parameter-parameter yang telah diatur.
- **Keputusan Otomatis**: Menghitung skor kelayakan kredit secara otomatis dan memberikan hasil apakah kredit diterima atau ditolak.
- **Data Terstruktur**: Semua data calon debitur disimpan dalam basis data MySQL.

## Teknologi yang Digunakan

- **PHP**: Untuk pemrosesan data dan logika aplikasi.
- **HTML & CSS**: Untuk antarmuka pengguna.
- **MySQL**: Untuk penyimpanan data.
- **XAMPP**: Untuk server lokal yang menjalankan Apache dan MySQL.

## Persyaratan Sistem

- **XAMPP** (untuk server PHP dan MySQL)
- **Browser Web** (Chrome, Firefox, dll.)
- **Git** (untuk meng-clone repository)

## Langkah-langkah Menjalankan Proyek di Lokal

### 1. Clone Repository

Pertama, clone repository dari GitHub ke dalam direktori lokal Anda.

```bash
git clone https://github.com/khalidalghifarii/sistem-penentuan-pemberian-kredit.git
```

## 2. Pindahkan ke Direktori htdocs
Setelah meng-clone, pindahkan folder project ke dalam direktori htdocs XAMPP agar dapat diakses melalui server lokal.

```bash
mv sistem-penentuan-pemberian-kredit /Applications/XAMPP/xamppfiles/htdocs/KrediTrust
```

## 3. Nyalakan XAMPP
Buka aplikasi XAMPP dan nyalakan Apache dan MySQL.

Apache: Untuk menjalankan server web lokal.
MySQL: Untuk mengelola basis data yang digunakan dalam proyek ini.

## 4. Impor Database
- Buka phpMyAdmin dengan mengakses localhost/phpmyadmin di browser.
- Buat database baru (misalnya: kreditrust_db).
- Impor file SQL/.db yang tersedia di repository ke dalam database yang baru dibuat.

## 5. Akses Aplikasi
Setelah XAMPP aktif, akses aplikasi melalui browser dengan mengunjungi:

```bash 
http://localhost/KrediTrust
```

## 6. Penggunaan Aplikasi
- Masukkan informasi calon debitur pada formulir yang tersedia.
- Klik tombol "Submit" untuk mendapatkan hasil penilaian kelayakan kredit.
- Sistem akan menghitung skor berdasarkan parameter seperti usia, pekerjaan, penghasilan, dll., dan menampilkan apakah kredit diterima atau ditolak.
- 
### Penjelasan Sistem

Sistem ini menentukan kelayakan kredit berdasarkan sejumlah aturan berbasis poin. Setiap parameter memiliki nilai poin yang berbeda dan poin total dari calon debitur akan menentukan apakah kredit diterima atau ditolak.

- Usia: Semakin tua usia, semakin tinggi poin.
- Status Pernikahan: Pelamar yang sudah menikah mendapatkan poin lebih tinggi.
- Pekerjaan: Pekerjaan dengan pendapatan stabil mendapatkan poin lebih tinggi.
- Penghasilan: Semakin tinggi penghasilan, semakin besar poin.
- Jaminan: Pelamar yang menyediakan jaminan mendapatkan poin tambahan.
- Rasio Pinjaman terhadap Penghasilan: Rasio yang lebih rendah mendapatkan poin lebih tinggi.
Skor akhir akan dibandingkan dengan ambang batas, dan keputusan kredit akan diberikan berdasarkan perhitungan ini. Jika total skor ≥ 15, kredit diterima; jika < 15, kredit ditolak.

## Anggota Tim

Proyek ini dikembangkan oleh Kelompok 8:

- Zahra Zafira - 2208107010040
- Alfi Zamriza - 2208107010080
- Muhammad Khalid Al Ghifari - 2208107010044
- Muhammad Raza Adzani - 2208107010066

##Kesimpulan

KrediTrust menawarkan solusi cepat dan efisien untuk penilaian kredit yang konsisten dan objektif. Sistem ini sangat cocok digunakan oleh lembaga keuangan kecil hingga menengah yang memerlukan otomatisasi dalam proses penilaian kredit.

