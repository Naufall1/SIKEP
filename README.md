
# SIKEP (Sistem Informasi Kependudukan)

Ini merupakan sebuah sistem informasi yang dibuat dengan tujuan melakukan digitalisasi pencatatan data Kependudukan warga pada tingkat **RW**.

Requirements
------------
 - PHP >= 8.2.10
 - Laravel >= 10.10

Installation
------------
Pertama lakukan clone repository ini dengan perintah berikut.
```
git clone https://github.com/Naufall1/SIKEP.git
```
Masuk kedalam root direktori projek dengan perintah berikut.
```
cd SIKEP
```
Jalankan perintah berikut untuk menginstall semua dependensi yang dibutuhkan.
```
composer install
```
Buat file .env dengan mengcopy file .env.example
```
cp .env.example .env
```
Buat environment key dengan perintah berikut.
```
php artisan key:generate
```
Buat database dan kemudian modifikasi file .env sesuai dengan database yang telah dibuat. Berikut adalah field yang harus diubah:
```
DB_DATABASE=<NAMA DATABASE>
DB_USERNAME=<USERNAME DATABASE>
DB_PASSWORD=<PASSWORD DATABASE>
```
Eksekusi perintah berikut untuk melakukan migrasi dan seeder.
```
php artisan migrate:fresh --seed
```
Setelah semua langkah berhasil, Jika tidak ingin membuat virtual host untuk proyek ini, eksekusi perintah berikut.
```
php artisan serve
```
Kemudian akses pada browser dengan alamat berikut.
```
http://127.0.0.1:8000
```
Selesai.

## Authors

- [@Naufall1](https://github.com/Naufall1)
- [@Mandesss](https://github.com/mandesss)
- [@Reysilvaa](https://github.com/reysilvaa)
- [@RizkyFitriAndini](https://github.com/RizkyFitriAndini)
- [@Topektopiq](https://github.com/topektopiq)

