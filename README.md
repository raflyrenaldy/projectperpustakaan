# projectperpustakaan

#Install
1. XAMPP (php 7+)
2. Composer
3. Laravel(5.x)

#Langkah Awal
1. Buka Command Prompt (Console) Anda,
2. Buka directory jalankan di console = (cd C:/xampp/htdocs) (default directory)
3. Jalankan di console = git clone https://github.com/raflyrenaldy/projectperpustakaan.git
4. Tunggu sampai selesai
5. Buka directory projectperpustakaan = cd C:/xampp/htdocs/projectperpustakaan
6. Jalankan di console = composer install
7. Tunggu sampai selesai
8. Buka projectperpustakaan pada Aplikasi Editor Anda (visualcode / notepad++ / sublime / dll)
9. Cari dan Buka file .env.example
10. Copas semua yang ada pada file tersebut dan create new file pastekan semuanya lalu namai file dengan .env saja tidak memakai .example
11. Setelah selesai
12. Jalankan aplikasi XAMPP Anda dan buat Database dengan nama perpustakaan
13. Kembali kepada file .env
14. Cari DB_DATABASE = homestead, ubah homestead tersebut dengan perpustakaan
15. Cari DB_USERNAME = homestead, ubah homestead tersebut dengan root (default username xampp)
16. Cari DB_PASSWORD = secret, hapus secret tersebut kosongkan (default password xampp)
17. Setelah selesai lalu save dan close file tersebut
18. Kembali ke console Anda setelah menjalankan composer install, jalankan php artisan key:generate
19. Setelah php artisan key:generate , jalankan php artisan migrate:fresh
20. Buka pada browser Anda jalankan link tsb http://127.0.0.1:8000
21. Selamat Mencoba
