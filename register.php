<?php
// Menampilkan error jika ada
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Koneksi ke database
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userid = $_POST['userid'];
    $nama = $_POST['nama'];
    $passw = password_hash($_POST['passw'], PASSWORD_DEFAULT);

    // Cek apakah user ID sudah ada
    $cek = $conn->prepare("SELECT * FROM user WHERE userid = ?");
    $cek->bind_param("s", $userid);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        echo "User ID sudah terdaftar. <a href='register.html'>Kembali</a>";
    } else {
        $insert = $conn->prepare("INSERT INTO user (userid, passw, nama) VALUES (?, ?, ?)");
        $insert->bind_param("sss", $userid, $passw, $nama);
        if ($insert->execute()) {
            echo "Registrasi berhasil. <a href='index.html'>Login Sekarang</a>";
        } else {
            echo "Gagal menyimpan data: " . $conn->error;
        }
    }
}
?>
