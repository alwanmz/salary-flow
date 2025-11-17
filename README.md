***

# 🎉 HR & Payroll Management System (Laravel + Filament)

> Sistem buat ngatur semua urusan HR dan payroll di perusahaan kamu, supaya gak ribet dan efisien!

***

## 🚀 Tentang Proyek Ini

Proyek web untuk-manage karyawan, cuti, absensi, dan penggajian lengkap.  
Dibangun pakai Laravel dan Filament sebagai admin panel, jadi tampilannya clean, modern, dan mudah dipakai.  
Semua hal yang biasa bikin pusing di urusan gaji dan absen, disatukan jadi satu dashboard yang praktis.

***

## 🛠️ Tech Stack

- Backend: Laravel 11.x (PHP framework nomor satu)
- Panel Admin: Filament 4.x (bikin GUI CRUD makin gampang)
- Database: MySQL (kuat dan skalabel)
- Frontend: Blade + Filament components (cepat dan responsif)
- File Upload, Livewire, Alpine.js & More for seamless UX
- CI/CD dan deployment bisa sesuaikan kebutuhan

***

## 📋 Fitur Keren yang Sudah Beres

- Manajemen master karyawan & struktur organisasi (cabang, departemen, posisi, jadwal kerja lengkap)  
- Penggajian: base salary, allowance, salary adjustment, slip gaji otomatis  
- Absensi & Izin/Cuti: ajukan, approve, upload surat sakit, kelola dengan mudah  
- BPJS Kesehatan & Ketenagakerjaan (integrasi lengkap)  
- Filter super canggih buat cari data karyawan, departemen, status, dll  
- Soft delete, bulk action, restore & edit inline modal super cepet  
- Upload dokumen & foto karyawan dengan kualitas maksimal  
- Role-based access ready siap dikembangin!

***

## 🔮 Fitur yang Bakal Datang

- Login multi-level (admin, staff, atasan, HRD, dll) plus permission lengkap  
- Dashboard analitik & grafis real-time buat HR  
- Export laporan absensi, payroll, cuti dalam format Excel / PDF  
- Modul slip gaji with payment status & approval workflow  
- Notifikasi email, WhatsApp atau aplikasi reminder  
- Integrasi API untuk absensi / payroll eksternal (HRIS partnership)

***

## 🛤️ Alur Sistem Singkat

1. Admin buat dan update data karyawan lengkap  
2. Karyawan bisa ajukan cuti/izin/sakit dengan upload surat  
3. Atasan & HR approve cuti/izin dan input hasil absensi  
4. Payroll otomatis dihitung tiap bulan, bisa lihat slip  
5. Semua data bisa difilter, dicari, dan diexport kapan aja

***

## ⚡ Cara Mulai

```bash
git clone [repo-url]
cd project-folder
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Akses panel admin di `http://localhost:8000/admin`  
Login dengan akun default
email        : superadmin@payroll.com
password     : password

***

## 🙌 Support & Kontribusi

Proyek ini open source, kamu boleh ikut berkontribusi!  
Buka issue, buat pull request, atau saran fitur langsung yaa.

***

## 📄 Lisensi

MIT License — pakai, modifikasi, dan sebarkan dengan bebas

sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
