## Catatan

1. Saya menggunakan PHP versi 8.2.12
2. Framework Laravel v10.x
3. Disarankan menggunakan XAMPP (Agar sejalan, saya menggunakan versi 3.3.0 )
4. Jika menggunakan XAMPP pastikan sudah menginstall Node.JS (saya menggunakan versi 21.6.1) karena beberapa command membutuhkannya untuk running
5. Pastikan sudah memiliki Database yang sudah disiapkan untuk melakukan migrate data

## Tata cara menjalankan project:

1. Buka Folder Project2 dengan aplikasi editor (Saya menggunakan Visual Studio Code)
2. Buka console pada VSC atau bisa dengan shortcut ctrl+j atau dapat menggunakan CMD dan arahakan kedalam folder
3. Jalankan command: npm install dan composer install
4. Lakukan penyesuain DB_DATABASE pada file .env (disini saya menggunakan XAMPP untuk local running servernya)
5. Jalankan command: php artisan migrate (untuk migrasi segala database kedalam database yang sudah disiapkan)
6. Jalankan command: php artisan serve (untuk memulai server pada laravel)
7. Jalankan command: npm run dev (untuk melakukan otomatisasi dengan bantuan vite)
8. Akses http://127.0.0.1:8000/ untuk memulai website

## Tampilan Website:

1. Pada tampilan awal akan dibawa ke beberapa pilihan dan pilih Register untuk melakukan daftar akun
2. Tampilan landing page akan langsung dibawa ke list pegawai bisa untuk melakukan CRUD (Add Employee untuk menambahkan dan action button untuk edit dan delete)
3. Pada tampilan presensi pun akan dapat melakukan CRUD (Add Presensi untuk menambahkan dan action button untuk edit dan delete)
4. Pada button Cek Absen < 3x pada Presensi akan menampilkan karyawan yang memiliki status absen melebihi 3x
5. Pada button Export Excel akan melakukan exporting data berupa excel
