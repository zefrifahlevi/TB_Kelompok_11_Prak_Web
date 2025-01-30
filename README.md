# Kelompok 11 Manajemen Uang Kas
> [!NOTE]
Informatika B 2022 <br/>
Zefri Fahlevi Irdiansyah `(2206068)` <br/>
Lea Siti Saumi `(2206040)` <br/>
Ikbal Amiludin `(2206051)`
>

# Tahap Instalasi
1. Jangan lupa untuk menginstal Composer
2. Setelah dilakukan Cloning, lakukan `composer install`
3. Selanjutnya Settings database pada `.env`
4. Selanjutnya lakukan Migrate dengan mengetik `php artisan migrate`
5. Kita bisa melakukan running program dengan mengetik `php artisan serve`
6. Untuk Login Akun anda bisa melihat pada bagian `database -> seeders -> userSeeder.php`
7. Jangan lupa lakukan `php artisan db:seed --class=userSeeder` agar Akun tersimpan di Database
8. Setelah dilakukan Seeder, anda bisa login pada Aplikasi ini, dan melakukan Manajemen Uang Kas
