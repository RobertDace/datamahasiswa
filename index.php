<?php
session_start();
if (!isset($_SESSION['userid'])) {
    // Jika belum login, tampilkan hanya form login
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login Dulu</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="login-modal" style="display:block;">
      <div class="login-content">
        <h2>Login</h2>
        <form action="login.php" method="post">
          <input type="text" name="userid" placeholder="User ID" required />
          <input type="password" name="passw" placeholder="Password" required />
          <button type="submit">Login</button>
          <p>Belum punya akun? <a href="register.html">Daftar Sekarang</a></p>
          <p><a href="reset_password.html">Lupa Password?</a></p>
        </form>
      </div>
    </div>
    </body>
    </html>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Mahasiswa</title>

<!-- Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

<!-- feather icons-->
<script src="https://unpkg.com/feather-icons"></script>

<!-- My Style--> 
<link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Navbar Start-->
<nav class="navbar">
<a href="#" class="navbar-logo">Data<span> Mahasiswa</span>.</a>

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
    <?php else: ?>
        <a href="#" id="user"><i data-feather="user"></i></a>
    <?php endif; ?>
    <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
</div>
</nav>
    <!-- Navbar End-->

     <!-- Login Modal -->
<div id="login-modal" class="login-modal">
  <div class="login-content">
    <span class="close-button" id="close-login">&times;</span>
    <h2>Login</h2>
    <form action="login.php" method="post">
      <input type="text" name="userid" placeholder="User ID" required />
      <input type="password" name="passw" placeholder="Password" required />
      <button type="submit">Login</button>
        <p>Belum punya akun? <a href="register.html">Daftar Sekarang</a></p>
        <p><a href="reset_password.html">Lupa Password?</a></p>
    </form>
  </div>
</div>

    <!-- hero section start-->
     <section class="hero" id="home">
        <main class="content">
            <h1>Sistem Data Mahasiswa</h1>
            <p>Halaman ini dirancang untuk mengelola data mahasiswa dengan tampilan responsive yang modern</p>
            <a href="#menu" class="cta">Lihat</a>
        </main>
     </section>
    <!-- hero section End-->

    <!-- About section start-->
<section class="about" id="about">
    <h2><span>Tentang</span> Kami</h2>
    <div class="row">
        <div class="about-img">
            <img src="img/tentang-kami.jpg" alt="Tentang Kami">
        </div>
        <div class="content">
            <h3>Desain dan Tujuan</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo quod aliquid reprehenderit eveniet vitae. Modi.</p>
            <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi dolores rerum ab nulla alias molestias delectus earum et voluptates illum.</P>
        </div>
    </div>
</section>
<!-- About section End-->

    <!-- Menu section start-->

    <section id="menu" class="menu">
        <h2><span>Menu</span> layanan</h2>
        <p>Silakan pilih menu berikut untuk mengelola data:</p>
        <div class="row">
            <div class="menu-card">
                <a href="mahasiswa.php">
                    <img src="img/menu/1.png" alt="Mahasiswa" class="menu-card-img">
                    <h3 class="menu-card-title">- Mahasiswa -</h3>
                </a>
                <p class="menu-card-price">Kelola data mahasiswa</p>
            </div>
            <div class="menu-card">
                <a href="jurusan.php">
                    <img src="img/menu/jurusan.png" alt="Jurusan" class="menu-card-img">
                    <h3 class="menu-card-title">- Jurusan -</h3>
                </a>
                <p class="menu-card-price">Kelola data jurusan</p>
            </div>
            <div class="menu-card">
                <a href="prodi.php">
                    <img src="img/menu/prodi.png" alt="Prodi" class="menu-card-img">
                    <h3 class="menu-card-title">- Prodi -</h3>
                </a>
                <p class="menu-card-price">Kelola data prodi</p>
            </div>
        </div>
    </section>
    
    <!-- menu section end-->
    
    <!-- contact section start-->
    <section id="contact" class="contact">
        <h2><span>Kontak</span> Kami</h2>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ea, sit.</p>

        <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63834.64896525983!2d117.0911324576925!3d-0.50138034075447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f9e3a5b4857%3A0xd9d9678dade6eae3!2sSamarinda%2C%20Kota%20Samarinda%2C%20Kalimantan%20Timur!5e0!3m2!1sid!2sid!4v1750197984104!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>
            <form action="">
                <div class="input-group">
                    <i data-feather="user"></i>
                    <input type="text" placeholder="nama">
                </div>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="text" placeholder="email">
                </div>
                <div class="input-group">
                    <i data-feather="phone"></i>
                    <input type="text" placeholder="nomor hp">
                </div>
                <button type="submit" class="btn">kirim pesan</button>
            </form>
        </div>
    </section>
    <!-- contact section end-->
    
    <!-- footer Start-->
    <footer>
        <div class="socials">
            <a href="#"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="linkedin"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
        </div>

        <div class="links">
            <a href="#home">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="#menu">Menu</a>
            <a href="#contact">Kontak</a>
        </div>

        <div class="credit">
            <p>Created by <a href="">Alfian Robit Nadifi Masyhudi</a>. | &copy; 2025.</p>
        </div>
    </footer>
    <!-- footer Start-->

<!-- feather icons-->
<script>
    feather.replace();
  </script>

<!-- My Javascript -->
 <script src="js/script.js"></script>
</body>

</html>