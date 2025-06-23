<?php
// filepath: c:\xampp\htdocs\project-mahasiswa\jurusan.php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    exit;
}

include "db.php";

// Hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM akademik_jurusan WHERE id_jurusan='$id'");
    header("Location: jurusan.php");
    exit;
}

// Tambah/Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_jurusan'];
    if (isset($_POST['edit'])) {
        $id = $_POST['id_jurusan'];
        $stmt = $conn->prepare("UPDATE akademik_jurusan SET nama_jurusan=? WHERE id_jurusan=?");
        $stmt->bind_param("si", $nama, $id);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("INSERT INTO akademik_jurusan (nama_jurusan) VALUES (?)");
        $stmt->bind_param("s", $nama);
        $stmt->execute();
    }
    header("Location: jurusan.php");
    exit;
}

// Data edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM akademik_jurusan WHERE id_jurusan='$id'");
    $edit_data = $res->fetch_assoc();
}

// Ambil semua jurusan
$jurusan = $conn->query("SELECT * FROM akademik_jurusan");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Jurusan</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
<!-- Navbar Start -->
<nav class="navbar">
    <a href="index.php" class="navbar-logo">Data<span> Mahasiswa</span>.</a>
    <div class="navbar-nav">
        <a href="index.php#home">Home</a>
        <a href="index.php#about">Tentang</a>
        <a href="mahasiswa.php">Mahasiswa</a>
        <a href="prodi.php">Prodi</a>
        <a href="jurusan.php">Jurusan</a>
        <a href="index.php#contact">Kontak</a>
    </div>
    <div class="navbar-extra">
        <a href="#" id="Search"><i data-feather="search"></i></a>
        <?php if (isset($_SESSION['userid'])): ?>
            <span class="user-greeting">Halo, <?php echo htmlspecialchars($_SESSION['nama']); ?></span>
            <a href="logout.php" id="logout"><i data-feather="log-out"></i></a>
        <?php endif; ?>
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>
</nav>
<!-- Navbar End -->

<div class="container py-4">
    <h2 class="mb-4">Data Jurusan</h2>
    <div class="mb-3">
        <a href="jurusan.php" class="btn btn-primary btn-sm">Tambah Data</a>
    </div>
    <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Nama Jurusan</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $jurusan->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_jurusan'] ?></td>
                <td><?= htmlspecialchars($row['nama_jurusan']) ?></td>
                <td>
                    <a href="jurusan.php?edit=<?= $row['id_jurusan'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="jurusan.php?hapus=<?= $row['id_jurusan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <?= $edit_data ? "Edit" : "Tambah" ?> Jurusan
        </div>
        <div class="card-body">
            <form method="post" class="row g-3">
                <?php if ($edit_data): ?>
                    <input type="hidden" name="id_jurusan" value="<?= $edit_data['id_jurusan'] ?>">
                <?php endif; ?>
                <div class="col-md-8">
                    <label class="form-label">Nama Jurusan</label>
                    <input type="text" name="nama_jurusan" class="form-control" value="<?= $edit_data['nama_jurusan'] ?? '' ?>" required>
                </div>
                <div class="col-12">
                    <?php if ($edit_data): ?>
                        <button type="submit" name="edit" class="btn btn-success">Update</button>
                        <a href="jurusan.php" class="btn btn-secondary">Batal</a>
                    <?php else: ?>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer Start -->
<footer>
    <div class="socials">
        <a href="#"><i data-feather="instagram"></i></a>
        <a href="#"><i data-feather="linkedin"></i></a>
        <a href="#"><i data-feather="facebook"></i></a>
    </div>
    <div class="links">
        <a href="index.php#home">Home</a>
        <a href="index.php#about">Tentang Kami</a>
        <a href="index.php#menu">Menu</a>
        <a href="index.php#contact">Kontak</a>
    </div>
    <div class="credit">
        <p>Created by <a href="">Alfian Robit Nadifi Masyhudi</a>. | &copy; 2025.</p>
    </div>
</footer>
<!-- Footer End -->

<script>feather.replace();</script>
<script src="js/script.js"></script>
</body>
</html>