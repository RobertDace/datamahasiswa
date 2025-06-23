<?php
include 'db.php';

$userid = $_POST['userid'];
$email = $_POST['email'];
$new_pass = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);

// Pastikan user dan email cocok
$query = $conn->prepare("SELECT * FROM user WHERE userid = ? AND nama = ?");
$query->bind_param("ss", $userid, $email); // nama diasumsikan email, sesuaikan kalau field-nya beda
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    // Update password
    $update = $conn->prepare("UPDATE user SET passw = ? WHERE userid = ?");
    $update->bind_param("ss", $new_pass, $userid);
    $update->execute();
    echo "Password berhasil diubah. <a href='index.html'>Login Sekarang</a>";
} else {
    echo "User ID atau Email tidak cocok.";
}
?>
