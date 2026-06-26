<div align="center">

# 🎓 SIAKAD

### Sistem Informasi Akademik — Universitas Suryakancana

_Tugas Besar Mata Kuliah Web II (IF53413)_

**[🔗 Lihat Demo Online](#)** 

</div>

---
**Akun Loginn:**

Role Admin username : admin@siakad.ac.id password : admin123

Role Mahasiswa username : yulia@siakad.ac.id password : yulia123

---

## Deskripsi Aplikasi

SIAKAD adalah aplikasi yang dibuat untuk mengelola data akademik seperti dosen, mahasiswa, mata kuliah, jadwal, dan KRS dalam satu sistem. Terdapat dua peran pengguna, yaitu Admin yang dapat mengelola seluruh data, dan Mahasiswa yang dapat mengambil KRS serta melihat jadwal kuliah.

Salah satu hal yang membedakan sistem KRS ini dengan sistem KRS pada umumnya adalah setiap mahasiswa telah memiliki kelas tertentu (A/B/C/D) yang ditentukan oleh admin saat menambahkan data mahasiswa. Sehingga, ketika mahasiswa membuka halaman Jadwal Kuliah, sistem hanya akan menampilkan jadwal dari mata kuliah yang telah diambil dan sesuai dengan kelas mahasiswa tersebut, bukan menampilkan seluruh pilihan kelas (A sampai D) untuk satu mata kuliah yang sama. Misalnya, mahasiswa yang berada di kelas B hanya akan melihat jadwal kelas B, meskipun mata kuliah yang sama juga dibuka untuk kelas A, C, dan D.

## Penjelasan Halaman

### 🔐 Login & Register

Halaman pertama yang muncul saat aplikasi dibuka. Pengguna memasukkan email dan password, kemudian sistem secara otomatis mengarahkan ke dashboard sesuai peran masing-masing — Admin ke halaman admin, Mahasiswa ke halaman mahasiswa. Bagi mahasiswa yang belum memiliki akun, dapat mendaftar melalui halaman Register, dengan syarat NPM yang diinput sudah terdaftar pada data mahasiswa yang sebelumnya ditambahkan oleh admin.

### 📊 Dashboard

Halaman utama setelah pengguna berhasil login. Admin dapat melihat statistik keseluruhan data, seperti jumlah dosen, mahasiswa, mata kuliah, dan jadwal yang terdaftar, beserta daftar aktivitas KRS terbaru. Mahasiswa dapat melihat ringkasan KRS yang sedang diambil pada semester berjalan, total SKS, serta jadwal kuliah pada hari tersebut.

### 👨‍🏫 Manajemen Dosen (Admin)

Halaman untuk mengelola data dosen yang terdaftar pada sistem. Admin dapat menambahkan dosen baru, mengubah data yang sudah ada, hingga menghapus data dosen. Setiap dosen memiliki NIDN dan nama yang berelasi dengan data mahasiswa (sebagai dosen wali) dan jadwal perkuliahan.

### 🎒 Manajemen Mahasiswa (Admin)

Halaman untuk mengelola data mahasiswa. Admin dapat menambahkan, mengubah, dan menghapus data mahasiswa — termasuk menentukan **kelas** (A/B/C/D) serta dosen wali masing-masing mahasiswa. Data mahasiswa ini berelasi langsung dengan tabel users untuk keperluan login serta dengan tabel KRS.

### 📘 Manajemen Mata Kuliah (Admin)

Halaman untuk mengelola daftar mata kuliah yang tersedia. Admin dapat menginput kode mata kuliah, nama mata kuliah, serta jumlah SKS-nya.

### 🗓️ Manajemen Jadwal (Admin)

Halaman untuk mengelola jadwal perkuliahan. Admin menentukan mata kuliah, dosen pengajar, kelas (A/B/C/D), hari, serta jam perkuliahan. Satu mata kuliah dapat memiliki beberapa jadwal kelas yang berbeda, masing-masing dengan dosen dan jam tersendiri.

### 📋 Data KRS (Admin)

Halaman untuk melihat seluruh data KRS yang telah diambil oleh mahasiswa, lengkap dengan nama mahasiswa dan mata kuliah yang bersangkutan. Admin dapat menghapus data KRS apabila terdapat kesalahan input, serta dapat mengekspor rekap data KRS ke dalam format PDF atau Excel.

### 🗓️ Jadwal Kuliah (Mahasiswa)

Halaman bagi mahasiswa untuk melihat jadwal kuliahnya sendiri. Jadwal yang ditampilkan hanya berasal dari mata kuliah yang telah diambil pada KRS, **dan** telah disesuaikan dengan kelas mahasiswa tersebut (yang ditentukan oleh admin pada data mahasiswa). Dengan demikian, mahasiswa tidak akan melihat banyak pilihan kelas untuk mata kuliah yang sama.

### 📝 KRS Saya (Mahasiswa)

Halaman bagi mahasiswa untuk mengambil dan membatalkan (drop) mata kuliah secara mandiri. Mahasiswa dapat melihat daftar mata kuliah yang telah diambil, total SKS, serta mengekspor KRS-nya ke dalam format PDF.

---

## Dokumentasi Screenshot

Tersedia pada folder [`screenshots/`](./screenshots).

## Identitas
Nama    : Yulia Farah Samrotul Fuadah <br>
NPM     : 5520124095 <br>
Kelas   : IF - C 2024
