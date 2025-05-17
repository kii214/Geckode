<?php include "inc/koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Materi Kursus - GECKODE</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <!-- Header / Navbar -->
  <header>
    <div class="nav-container">
      <div class="brand">GECKODE</div>
      <nav>
        <a href="index.php">Beranda</a>
        <a href="materi.php" class="active">Materi</a>
        <a href="kontak.html">Kontak</a>
      </nav>
    </div>
  </header>

  <!-- Fungsi untuk convert link YouTube jadi embed URL -->
  <?php
  function convertToEmbedUrl($url) {
    // Cek apakah ini link YouTube biasa (watch?v=)
    if (strpos($url, 'watch?v=') !== false) {
      parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);
      if (isset($queryParams['v'])) {
        return 'https://www.youtube.com/embed/' . $queryParams['v'];
      }
    }
    // Cek jika sudah link embed atau share short link youtu.be
    elseif (strpos($url, 'youtu.be') !== false) {
      $path = parse_url($url, PHP_URL_PATH);
      return 'https://www.youtube.com/embed' . $path;
    }
    // Jika link sudah embed atau bukan YouTube, kembalikan apa adanya
    return $url;
  }
  ?>

  <!-- Konten Utama -->
  <main class="container">
    <h2>Materi Pembelajaran</h2>
    <div class="materi-container">
      <?php
      $query = mysqli_query($conn, "
        SELECT materi.*, kursus.judul_kursus 
        FROM materi 
        JOIN kursus ON materi.id_kursus = kursus.id_kursus
      ");
      while ($row = mysqli_fetch_assoc($query)) :
        $embedUrl = !empty($row['video_link']) ? convertToEmbedUrl($row['video_link']) : '';
      ?>
        <div class="materi-card">
          <h3><?= htmlspecialchars($row['judul_materi']) ?> <span class="materi-kursus">(<?= htmlspecialchars($row['judul_kursus']) ?>)</span></h3>
          <p><?= nl2br(htmlspecialchars($row['konten'])) ?></p>
          <?php if ($embedUrl): ?>
            <div class="video-wrapper">
              <iframe src="<?= htmlspecialchars($embedUrl) ?>" frameborder="0" allowfullscreen></iframe>
            </div>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <p>&copy; <?= date('Y') ?> GECKODE - Platform Coding Terbuka</p>
  </footer>
</body>
</html>
