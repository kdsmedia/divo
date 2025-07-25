<?php
/**
 * File: play.php
 * Lokasi: api/play.php
 * Deskripsi: Gerbang aman untuk memuat dan menginisialisasi game PHP.
 *           Memverifikasi login pengguna sebelum memberikan akses.
 */

// Langkah 1: Memulai atau melanjutkan sesi PHP untuk memeriksa status login.
session_start();

// ================================================================
// === LAPISAN KEAMANAN WAJIB: PEMERIKSAAN STATUS LOGIN (SESSION) ===
// ================================================================

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Jika tidak ada sesi login, tendang pengguna kembali ke halaman login.
    header('Location: ../index.html#halaman-masuk');
    exit();
}

// ======================================================
// ===          MEKANISME PEMUATAN GAME PHP           ===
// ======================================================

// 1. Ambil nama folder game dari parameter URL (?game=G1)
$game_folder_name = isset($_GET['game']) ? basename($_GET['game']) : '';

// 2. Tentukan file inisialisasi utama dari game tersebut
//    Berdasarkan gambar, 'init.php' adalah kandidat utama.
//    Jika ada game yang menggunakan nama file lain, Anda bisa menambahkan logika di sini.
$game_init_file = 'init.php';

// 3. Tentukan path (jalur) lengkap ke file inisialisasi game
$game_file_path = __DIR__ . '/games/' . $game_folder_name . '/' . $game_init_file;

// 4. Validasi: Periksa apakah parameter tidak kosong dan file inisialisasi benar-benar ada
if (!empty($game_folder_name) && file_exists($game_file_path)) {
    
    // JIKA VALID DAN DITEMUKAN:
    // Jalankan file inisialisasi game tersebut.
    // File 'init.php' sekarang bertanggung jawab untuk menampilkan
    // seluruh antarmuka dan logika game.
    require $game_file_path;

} else {
    
    // JIKA TIDAK VALID ATAU TIDAK DITEMUKAN:
    // Alihkan pengguna kembali ke halaman dashboard mereka untuk mencegah error.
    header('Location: ../index.html#halaman-dashboard');
    exit();
}

?>
