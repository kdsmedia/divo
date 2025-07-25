<?php
// File: config.php
// Berfungsi untuk menyimpan konfigurasi dan membuat koneksi ke database.

// 1. Definisikan Kredensial Database Anda
$host = 'localhost';
$dbname = 'myid1250_dhan';
$user = 'myid1250_dhan';
$pass = 'Kdsmedia@123';
$charset = 'utf8mb4';

// 2. Siapkan DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// 3. Opsi Tambahan untuk PDO (Best Practice)
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Menampilkan error sebagai exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Mengambil data sebagai array asosiatif
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// 4. Buat Koneksi Database Menggunakan PDO dengan Blok try-catch
try {
    // Membuat objek PDO baru untuk koneksi
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Jika koneksi gagal, hentikan skrip dan tampilkan pesan error
    // (Dalam produksi, sebaiknya log error ini daripada menampilkannya ke pengguna)
    http_response_code(500); // Server Error
    die("Koneksi database gagal: " . $e->getMessage());
}

// Variabel $pdo sekarang siap digunakan di file-file lain yang meng-include file ini.
// Contoh: require_once 'config.php';
?>
