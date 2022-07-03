![alt text](https://banners.beyondco.de/Pajak%20Online.png?theme=light&packageManager=composer+require&packageName=hanzo-asashi%2Fpajak-online&pattern=floatingCogs&style=style_1&description=Sistem+Informasi+Pajak+Online&md=1&showWatermark=1&fontSize=100px&images=calculator)
# SISTEM INFORMASI PAJAK ONLINE - ESPPT PBB ONLINE

## Installation Quick Start

1. Download the latest theme source from the Marketplace.


2. Download and install `Node.js` from Nodejs. The suggested version to install is `14.16.x LTS`.


3. Start a command prompt window or terminal and change directory to [unpacked path]:


4. Install the latest `NPM`:
   
        npm install --global npm@latest


5. To install `Composer` globally, download the installer from https://getcomposer.org/download/ Verify that Composer in successfully installed, and version of installed Composer will appear:
   
        composer --version


6. Install `Composer` dependencies.
   
        composer install


7. Install `NPM` dependencies.
   
        npm install


8. The below command will compile all the assets(sass, js, media) to public folder:
   
        npm run dev


9. Copy `.env.example` file and create duplicate. Use `cp` command for Linux or Max user.

        cp .env.example .env

    If you are using `Windows`, use `copy` instead of `cp`.
   
        copy .env.example .env
   

10. Create a table in MySQL database and fill the database details `DB_DATABASE` in `.env` file.


12. The below command will create tables into database using Laravel migration and seeder.

        php artisan migrate:fresh --seed


13. Generate your application encryption key:

        php artisan key:generate


14. Start the localhost server:
    
        php artisan serve

## Troubleshooting
Setelah Menjalankan `php artisan migrate:fresh --seed`, lakukan hal berikut :
1. Import tabel wilayah_2020 pada ./database/wilayah_2020.sql.
2. Masuk menu pengaturan kemudian langsung saja klik tombol simpan. bisa juga mengecek terlebih dahulu dan mengisi beberapa field yang ingin diubah kemudian klik simpan 
   pengaturan. Untuk menampilkan logo aplikasi pada sidebar silahkan upload logo kabupaten atau logo apapun kemudian simpan.
3. selesai. Aplikasi siap digunakan.

Ini harus dilakukan untuk mengatasi beberapa masalah pada layout seperti logo aplikasi, title, footer, serta untuk menampilkan data kabupaten pada select box.


## Documentation
For setup, usage guidance, and all other docs - please consult the [Project Wiki](https://github.com/hanzo-asashi/pajak-online/wiki).

## License

This boilerplate, much like the Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).


