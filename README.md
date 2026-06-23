<div align="center">

# 🎓 SIAKAD

### Sistem Informasi Akademik — Universitas Suryakancana

_Tugas Besar Mata Kuliah Web II (IF53413)_

**[🔗 Lihat Demo Online](#)** &nbsp;·&nbsp; **[📂 Source Code](#)**

</div>

---

### Tentang Aplikasi

SIAKAD adalah simulasi sistem akademik kampus berbasis Laravel. Dua peran pengguna berjalan di atas data yang sama - Dosen, Mahasiswa, Mata Kuliah, Jadwal, dan KRS - dengan hak akses yang dipisah secara ketat lewat middleware.
<br>

### 👥 Dua Sisi, Satu Sistem

<table>
<tr>
<td width="50%" valign="top">

**🛠️ Admin**
- Kelola data Dosen, Mahasiswa, Mata Kuliah & Jadwal
- Pantau seluruh KRS mahasiswa
- Export rekap KRS ke PDF & Excel
- Dashboard dengan statistik real-time

</td>
<td width="50%" valign="top">

**🎒 Mahasiswa**
- Daftar mandiri pakai NPM yang sudah terdaftar
- Lihat jadwal kuliah dari mata kuliah yang diambil
- Ambil & drop mata kuliah sendiri (KRS)
- Cetak KRS pribadi ke PDF

</td>
</tr>
</table>

### ⚙️ Di Balik Layar

| | |
|---|---|
| **Auth** | Laravel Auth manual — `Auth::attempt()`, role disimpan di kolom `users.role` |
| **Otorisasi** | Custom middleware `role:admin` / `role:mahasiswa` |
| **Database** | Migration + Seeder, mengikuti ERD yang ditentukan |
| **Relasi** | `hasMany`, `belongsTo`, `hasOne` antar 6 tabel |
| **Export** | `barryvdh/laravel-dompdf` & `maatwebsite/excel` |
| **Validasi** | `$request->validate()` di setiap form |


### 🚀 Menjalankan di Lokal

\`\`\`bash
composer install
cp .env.example .env
php artisan key:generate
\`\`\`

Atur koneksi database di `.env`, lalu:

\`\`\`bash
php artisan migrate:fresh --seed
php artisan serve
\`\`\`

Buka `http://127.0.0.1:8000/login` — gunakan akun berikut untuk mencoba:

| Peran | Email | Password |
|---|---|---|
| 🛠️ Admin | `admin@siakad.ac.id` | `admin123` |
| 🎒 Mahasiswa | `yulia@siakad.ac.id` | `yulia123` |

<br>

### 🖼️ Galeri

Tangkapan layar tiap halaman ada di [`/screenshots`](./screenshots).

<br>

---

<div align="center">

**Nama:** _Yulia Farah Samrotul Fuadah_ &nbsp;·&nbsp; **NPM:** _5520124095_ &nbsp;·&nbsp; **Kelas:** _IF-C24_

</div>