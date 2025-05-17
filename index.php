<?php include "inc/koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GECKODE - Kursus Coding</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <!-- Header / Navbar -->
  <header>
    <div class="nav-container">
      <div class="brand">GECKODE</div>
      <nav>
        <a href="index.php">Beranda</a>
        <a href="materi.php">Materi</a>
        <a href="kontak.html">Kontak</a>
      </nav>
    </div>
  </header>

  <!-- Konten Utama -->
  <main class="container">
    <h2>Daftar Kursus Coding</h2>
    <div class="card-grid">
      <?php
      $query = mysqli_query($conn, "SELECT * FROM kursus");
      while ($row = mysqli_fetch_assoc($query)) :
      ?>
        <div class="card">
          <img src="img/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['judul_kursus']) ?>">
          <div class="card-content">
            <h3><?= htmlspecialchars($row['judul_kursus']) ?></h3>
            <p><?= htmlspecialchars($row['deskripsi']) ?></p>
            <a href="materi.php?id=<?= $row['id_kursus'] ?>">Lihat Materi</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <p>&copy; <?= date('Y') ?> GECKODE - Belajar Coding Jadi Mudah</p>
  </footer>
</body>
</html>
