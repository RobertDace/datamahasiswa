<?php
session_start();
include "db.php"; // koneksi database

$userid = $_POST['userid'];
$passw = $_POST['passw'];

$query = $conn->prepare("SELECT * FROM user WHERE userid = ?");
$query->bind_param("s", $userid);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($passw, $user['passw'])) {
    $_SESSION['userid'] = $user['userid'];
    $_SESSION['nama'] = $user['nama'];
    header("Location: index.php");
} else {
    echo "Login gagal, periksa kembali user ID dan password.";
}
?>
