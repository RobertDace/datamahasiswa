<?php
// filepath: c:\xampp\htdocs\project-mahasiswa\mahasiswa.php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    exit;
}
include "db.php";

// Handle hapus
if (isset($_GET['hapus'])) {
    $nim = $_GET['hapus'];
    $conn->query("DELETE FROM akademik_mahasiswa WHERE nim='$nim'");
    header("Location: mahasiswa.php");
    exit;
}

// Handle tambah/edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $agama = $_POST['agama'];
    $kelamin = $_POST['kelamin'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $id_prodi = $_POST['id_prodi'];

    if (isset($_POST['edit'])) {
        $stmt = $conn->prepare("UPDATE akademik_mahasiswa SET nama=?, tgl_lahir=?, alamat=?, agama=?, kelamin=?, no_hp=?, email=?, id_prodi=? WHERE nim=?");
        $stmt->bind_param("sssssssis", $nama, $tgl_lahir, $alamat, $agama, $kelamin, $no_hp, $email, $id_prodi, $nim);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("INSERT INTO akademik_mahasiswa (nim, nama, tgl_lahir, alamat, agama, kelamin, no_hp, email, id_prodi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssi", $nim, $nama, $tgl_lahir, $alamat, $agama, $kelamin, $no_hp, $email, $id_prodi);
        $stmt->execute();
    }
    header("Location: mahasiswa.php");
    exit;
}

// Ambil data untuk form edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $nim = $_GET['edit'];
    $res = $conn->query("SELECT * FROM akademik_mahasiswa WHERE nim='$nim'");
    $edit_data = $res->fetch_assoc();
}

// Ambil data prodi untuk dropdown
$prodi = $conn->query("SELECT p.id_prodi, p.nama_prodi, j.nama_jurusan FROM akademik_prodi p JOIN akademik_jurusan j ON p.id_jurusan=j.id_jurusan");

// Ambil semua data mahasiswa
$sql = "SELECT m.*, p.nama_prodi, j.nama_jurusan FROM akademik_mahasiswa m
        JOIN akademik_prodi p ON m.id_prodi=p.id_prodi
        JOIN akademik_jurusan j ON p.id_jurusan=j.id_jurusan";
$mahasiswa = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
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
    <h2 class="mb-4">Data Mahasiswa</h2>
    <div class="mb-3">
        <a href="mahasiswa.php" class="btn btn-primary btn-sm">Tambah Data</a>
    </div>
    <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>NIM</th><th>Nama</th><th>Prodi</th><th>Jurusan</th><th>Alamat</th><th>Kelamin</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $mahasiswa->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nim']) ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['nama_prodi']) ?></td>
                <td><?= htmlspecialchars($row['nama_jurusan']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td><?= htmlspecialchars($row['kelamin']) ?></td>
                <td>
                    <a href="mahasiswa.php?edit=<?= $row['nim'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="mahasiswa.php?hapus=<?= $row['nim'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <?= $edit_data ? "Edit" : "Tambah" ?> Mahasiswa
        </div>
        <div class="card-body">
            <form method="post" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control" maxlength="9" value="<?= $edit_data['nim'] ?? '' ?>" <?= $edit_data ? 'readonly' : '' ?> required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $edit_data['nama'] ?? '' ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" value="<?= $edit_data['tgl_lahir'] ?? '' ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="<?= $edit_data['alamat'] ?? '' ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Agama</label>
                    <input type="text" name="agama" class="form-control" maxlength="1" value="<?= $edit_data['agama'] ?? '' ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Kelamin</label>
                    <select name="kelamin" class="form-select">
                        <option value="L" <?= (isset($edit_data['kelamin']) && $edit_data['kelamin']=='L') ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= (isset($edit_data['kelamin']) && $edit_data['kelamin']=='P') ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="<?= $edit_data['no_hp'] ?? '' ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $edit_data['email'] ?? '' ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Prodi</label>
                    <select name="id_prodi" class="form-select" required>
                        <option value="">Pilih Prodi</option>
                        <?php foreach ($prodi as $p): ?>
                            <option value="<?= $p['id_prodi'] ?>" <?= ($edit_data && $edit_data['id_prodi'] == $p['id_prodi']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['nama_prodi']) ?> (<?= htmlspecialchars($p['nama_jurusan']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <?php if ($edit_data): ?>
                        <button type="submit" name="edit" class="btn btn-success">Update</button>
                        <a href="mahasiswa.php" class="btn btn-secondary">Batal</a>
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