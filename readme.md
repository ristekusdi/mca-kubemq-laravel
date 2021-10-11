# MCA KubeMQ Laravel
laravel package untuk memudahkan penggunaan MCA dengan Telegram Bot USDI di aplikasi Universitas Udayana.

## Motivasi
Proyek ini berfungsi sebagai library untuk mengirim pesan MCA melalui KubeMQ dan secara teknis mengurangi developer untuk menuliskan sintaks curl di PHP ketika memenuhi kebutuhan intern aplikasi Universitas Udayana, di samping juga memudahkan untuk menambahkan fitur tambahan atau menyesuaikan fitur di package MCA.

## Persyaratan

- PHP versi >= 7.2
- Laravel versi 5.4 ke atas

## Instalasi

Via Composer

```bash
composer require ristekusdi/mca-kubemq-laravel
```

## publish config
```bash
php artisan vendor:publish --tag=config-mca-kubemq
```

## Setting environment file untuk package ini
untuk pengaturan di bagian ini, sesuaikan dengan setting KUBEMQ yang sudah di sediakan oleh admin.
```
MCAKUBEMQ_ADDRESS=
MCAKUBEMQ_PORT=
MCAKUBEMQ_CLIENTID=
MCAKUBEMQ_CHANNEL=
```

# Penggunaan Dasar

## pengiriman pesan
untuk contoh pengiriman pesan ke MCA telegram dibutuhkan oarameter idsso, pesan
```php

<?php

use Illuminate\Support\Facades\Route;
use Ristekusdi\McaKubemqLaravel\Facades\Messagemcakube;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-message', function () {

   Messagemcakube::sendMessage(32018000182, 'ristek usdi');
    return view('welcome');
});
```

## debug
untuk men-debug pesan yang di kirim pertu di tambahkan parameter ke-3 berupa boolean(true), default debug adalah false. berikut contohnya. 
```php

<?php

use Illuminate\Support\Facades\Route;
use Ristekusdi\McaKubemqLaravel\Facades\Messagemcakube;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-message', function () {

    $debug =  Messagemcakube::sendMessage(32018000182, 'ristek usdi', true);
    echo $debug;
    return view('welcome');
});
```

## format html
mengirim pesan dengan format HTML
```php
<?php

use Illuminate\Support\Facades\Route;
use Ristekusdi\McaKubemqLaravel\Facades\Messagemcakube;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-message', function () {

 $message = '[SIRAISA]
    Ada surat masuk dari Rektor
    DETAIL SURAT 
    <strong>Perihal:</strong> 
            BERITA ACARA SERAH TERIMA BARANG MILIK NEGARA KONOHA
    <strong>Sifat surat:</strong> Biasa
            
    <strong>Tgl. Surat:</strong> 09-11-2020
    <strong>LAMPIRAN FILE</strong> 
    <a href="https://siraisa.unud.ac.id/uploads/surat-keluar/BAST_FEB.pdf">B_UN14_PL_2020_1607569648</a>
    <a href="https://siraisa.unud.ac.id/mca/read_letter?code=IKQE5t2t4vW52F7ecGxQLbqAnJBYNwHFlFOh2ING&jabatan_penerima=59&detail_surat_id=317314" target="_blank">TANDAI SURAT INI SUDAH DIBACA!</a>';


    Messagemcakube::sendMessage(32018000182, $message);
    return view('welcome');
});
