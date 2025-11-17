***

# 🎉 HR & Payroll Management System (Laravel + Filament)

> Sistem keren buat ngatur semua urusan HR dan payroll di perusahaan kamu, supaya gak ribet dan efisien!

***

## 🚀 Tentang Proyek Ini

Ini proyek web buat para HR dan finance buat nge-manage karyawan, cuti, absensi, dan penggajian lengkap.  
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
Login dengan akun default yang sudah kamu buat.

***

## 🙌 Support & Kontribusi

Proyek ini open source, kamu boleh ikut berkontribusi!  
Buka issue, buat pull request, atau saran fitur langsung yaa.

***

## 📄 Lisensi

MIT License — pakai, modifikasi, dan sebarkan dengan bebas

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
