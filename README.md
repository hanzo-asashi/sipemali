![alt text](https://banners.beyondco.de/SIPEMALI.png?theme=dark&packageManager=composer+require&packageName=hanzo-asashi%2Fsipemali&pattern=bubbles&style=style_2&description=Sistem+Pembayaran+Air+Online+PDAM&md=1&showWatermark=1&fontSize=100px&images=cash)

# SISTEM PEMBAYARAN AIR ONLINE PDAM - SIPEMALI PDAM

`SIPEMALI` merupakan aplikasi yang dapat digunakan untuk pembayaran air PDAM secara online dan OFFLINE.

## Getting Started

For setup, usage guidance, and all other docs - please consult the [Project Wiki](https://github.com/hanzo-asashi/sipemali/wiki).

### Prerequisites

1. Download and install `Node.js` from Nodejs. The suggested version to install is `14.16.x LTS`.


2. Install the latest `NPM`:

        npm install --global npm@latest

3. Install `Composer` skip if you already have. To install `Composer` globally, download the installer from composer [website](https://getcomposer.org/download/). Verify that Composer in successfully installed, and version of installed Composer will
   appear:

        composer --version
4. PHP 8.0+ is required.

### Installing

1. Download the latest theme source from the [Github]('https://github.com/hanzo-asashi/sipemali.git').


3. Start a command prompt window or terminal and change directory to `unzip source code`:


4. Install `Composer` dependencies.

        composer install


5. Install `NPM` dependencies.

        npm install


6. The below command will compile all the assets(sass, js, media) to public folder:

        npm run dev


7. Copy `.env.example` file and create duplicate. Use `cp` command for Linux or Max user.

        cp .env.example .env

   If you are using `Windows`, use `copy` instead of `cp`.

        copy .env.example .env

8. Create a table in MySQL database and fill the database details `DB_DATABASE` in `.env` file.


12. The below command will create tables into database using Laravel migration and seeder.

        php artisan migrate:fresh --seed


13. Generate your application encryption key:

        php artisan key:generate


14. Start the localhost server:

        php artisan serve

## Running the tests

Explain how to run the automated tests for this system

### Break down into end-to-end tests

Explain what these tests test and why

```
Give an example
```

### And coding style tests

Explain what these tests test and why

```
Give an example
```

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Laravel 9.x](https://laravel.com/docs/9.x/installation) - The web framework used.
* [Livewire 2.x](https://laravel-livewire.com/docs/2.x/quickstart) - Fullstack framework for laravel.
* [AlpineJs 3](https://alpinejs.dev/essentials/installation) - Think of it like jQuery for the modern web.
* [Minia](https://themeforest.net/item/minia-laravel-8-admin-dashboard-template/33030918) - Admin Template Used.
* [Vite](https://vitejs.dev/guide/) - Fullstack frontend tools for build asset.
* [PHPStorm](https://www.jetbrains.com/phpstorm/download/#section=windows) - Used as IDE Editor
* [Laragon](https://laragon.org/docs/index.html) - Used as Web Server
* [PEST Testing](https://pestphp.com/docs/installation) - Used for testing.
* [Larastan](https://github.com/nunomaduro/larastan) - Used for code analysis.
* [Laravel Pint](https://github.com/laravel/pint) - Used for PHP code style fixer.

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTE.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/hanzo-asashi/sipemali/tags).

## Authors

* **Hanzo Asashi** - *Initial work* - [Hanzo](https://github.com/hanzo-asashi)

See also the list of [contributors](https://github.com/hanzo-asashi/sipemali/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [MIT license](LICENSE.md) file for details

## Acknowledgments

Setelah Menjalankan `php artisan migrate:fresh --seed`, lakukan hal berikut :

1. Import tabel wilayah_2020 pada ./database/wilayah_2020.sql.
2. Masuk menu pengaturan kemudian langsung saja klik tombol simpan. bisa juga mengecek terlebih dahulu dan mengisi beberapa field yang ingin diubah kemudian klik simpan pengaturan. Untuk menampilkan logo aplikasi pada sidebar silahkan upload logo
   kabupaten atau logo apapun kemudian simpan.
3. selesai. Aplikasi siap digunakan.

Ini harus dilakukan untuk mengatasi beberapa masalah pada layout seperti logo aplikasi, title, footer, serta untuk menampilkan data kabupaten pada select box.
