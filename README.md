# Contact Profile

## Deskripsi

Sebuah aplikasi RESTFul API untuk manajemen data kontak profil menggunakan Yii2 Framework. Data profil terdiri dari:

- Name
- E-mail Address
- Phone Number
- Address

## Cara Penggunaan

### Setup Environment

1. Download Laragon di [https://laragon.org/download/index.html](https://laragon.org/download/index.html), kemudian lakukan instalasi.
2. Download Git di [https://git-scm.com/downloads](https://git-scm.com/downloads), kemudian lakukan instalasi.
3. Buatlah basis data dengan nama _**yii2basic**_.
4. Terakhir jalankan/runningkan laragon dengan menekan tombol Run All.

### Clone/Download project

1. Bukalah terminal/cmd, kemudian arahkan ke directory instalasi Laragon. Sebagai contoh`cd C:\laragon\www`
2. Jalankan perintah berikut untuk mendownload project ini.

```
$ git clone https://github.com/memiljamel/coding-test-contact-profile-APN.git
$ cd coding-test-contact-profile-APN/
```

3. Jalankan perintah `composer install` untuk menginstall package-package yang dibutuhkan.

### Menggunakan Migration & Seeder

1. Masih didalam direktory yang sama.
2. Jalankan perintah `php yii2 migrate/fresh` untuk membuat tabel otomatis di basis data.
3. Jalankan perintah `php yii2 seeder [Tabel_name]` dalam hal ini namanya adalah ContactTableSeeder.

### Mengakses Aplikasi

1. Ketikan `http://localhost/contact-profile/basic/web/index.php` berikut di web browser.
2. Maka aplikasi dapat diakses.

