<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama  = htmlspecialchars(trim($_POST["nama"]));
  $email = htmlspecialchars(trim($_POST["email"]));
  $pesan = htmlspecialchars(trim($_POST["pesan"]));
} else {
  header("Location: kontak.html");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Terima Kasih - GECKODE</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <div class="nav-container">
      <div class="brand">GECKODE</div>
      <nav>
        <a href="index.php">Beranda</a>
        <a href="materi.php">Materi</a>
        <a href="kontak.html" class="active">Kontak</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <div class="thankyou-message">
      <h2>Terima kasih, <?= $nama ?>!</h2>
      <p>Kami telah menerima pesan Anda:</p>
      <div class="message-detail">
        <strong>Email:</strong> <?= $email ?><br><br>
        <strong>Pesan:</strong><br><?= nl2br($pesan) ?>
      </div>
      <a href="kontak.html" class="btn-back">Kembali ke Kontak</a>
    </div>
  </main>

  <footer>
    <p>&copy; <?= date('Y') ?> GECKODE - Platform Coding Terbuka</p>
  </footer>
</body>
</html>
