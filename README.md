
# SIKEP (Sistem Informasi Kependudukan)

Ini merupakan sebuah sistem informasi yang dibuat dengan tujuan melakukan digitalisasi pencatatan data Kependudukan warga pada tingkat **RW**.

Requirements
------------
 - PHP >= 8.2
 - Composer >=  2.7
 - Node.js >= 18.19
 - NPM >= 9.2

Installation
------------
1. Pertama lakukan clone repository ini dengan perintah berikut. `git clone https://github.com/Naufall1/SIKEP.git`
2. Masuk kedalam root direktori projek dengan perintah 
`cd SIKEP`
3. Jalankan perintah `composer install` untuk menginstall semua dependensi yang dibutuhkan.
4. Jalankan perintaj `npm install` untuk menginstall semua dependensi yang dibutuhkan pada npm.
5. Buat file .env dengan mengcopy file .env.example `cp .env.example .env`
6. Buat environment key dengan perintah `php artisan key:generate`
7. Buat `database` kosong dengan nama yang disesuaikan. 
8. Modifikasi file .env sesuai dengan database yang telah dibuat. Berikut adalah field yang harus diubah: 
``` 
DB_DATABASE=<NAMA DATABASE>
DB_USERNAME=<USERNAME DATABASE>
DB_PASSWORD=<PASSWORD DATABASE>
```
9. Eksekusi perintah `php artisan migrate:fresh --seed` untuk melakukan migrasi dan seeder.
10. Eksekusi perintah `php artisan storeage:link` untuk membuat symlink public storage.
11. Eksekusi perintah `npm run build`. Untuk development menggunakan perintah `npm run dev`
12. Setelah semua langkah berhasil, Jika tidak ingin membuat virtual host untuk proyek ini, eksekusi perintah `php artisan serve`
13. Kemudian akses pada browser dengan alamat `http://127.0.0.1:8000`
14. Selesai.

## Authors

- [@Naufall1](https://github.com/Naufall1)
- [@Mandesss](https://github.com/mandesss)
- [@Reysilvaa](https://github.com/reysilvaa)
- [@RizkyFitriAndini](https://github.com/RizkyFitriAndini)
- [@Topektopiq](https://github.com/topektopiq)

