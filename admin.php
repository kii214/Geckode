<?php
include "inc/koneksi.php";

// Hapus kursus
if (isset($_GET['hapus_kursus'])) {
  $id = (int)$_GET['hapus_kursus'];
  mysqli_query($conn, "DELETE FROM kursus WHERE id_kursus=$id");
  header("Location: admin.php");
  exit;
}

// Hapus materi
if (isset($_GET['hapus_materi'])) {
  $id = (int)$_GET['hapus_materi'];
  mysqli_query($conn, "DELETE FROM materi WHERE id_materi=$id");
  header("Location: admin.php");
  exit;
}

// Tambah kursus
if (isset($_POST['tambah_kursus'])) {
  $judul = mysqli_real_escape_string($conn, $_POST['judul_kursus']);
  $desc = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  $gambar = mysqli_real_escape_string($conn, $_POST['gambar']);
  mysqli_query($conn, "INSERT INTO kursus (judul_kursus, deskripsi, gambar) VALUES ('$judul', '$desc', '$gambar')");
  header("Location: admin.php");
  exit;
}

// Tambah materi
if (isset($_POST['tambah_materi'])) {
  $id_kursus = (int)$_POST['id_kursus'];
  $judul = mysqli_real_escape_string($conn, $_POST['judul_materi']);
  $konten = mysqli_real_escape_string($conn, $_POST['konten']);
  $video = mysqli_real_escape_string($conn, $_POST['video_link']);
  mysqli_query($conn, "INSERT INTO materi (id_kursus, judul_materi, konten, video_link) VALUES ($id_kursus, '$judul', '$konten', '$video')");
  header("Location: admin.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin - GECKODE</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    /* ===== Navbar Header ===== */
    header {
      background-color: #0e1726;
      color: #fff;
      padding: 15px 0;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    header .container {
      max-width: 900px;
      margin: auto;
      padding: 0 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 12px;
    }
    header h1 {
      font-size: 1.8rem;
      color: #00ffc3;
      font-weight: 700;
      margin: 0;
    }
    header nav a {
      color: #fff;
      text-decoration: none;
      margin-left: 20px;
      font-weight: 500;
      transition: color 0.3s ease;
    }
    header nav a.active,
    header nav a:hover {
      color: #00ffc3;
    }

    /* ===== Breadcrumb Nav ===== */
    nav.breadcrumb {
      max-width: 900px;
      margin: 25px auto 40px auto;
      padding: 0 15px;
    }
    nav.breadcrumb a {
      display: inline-block;
      padding: 10px 18px;
      background: #0e1726;
      color: #00ffc3;
      font-weight: 600;
      border-radius: 8px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }
    nav.breadcrumb a:hover {
      background-color: #00ffc3;
      color: #000;
    }

    /* ===== Main container ===== */
    main.container {
      max-width: 900px;
      margin: auto;
      padding: 0 15px 40px 15px;
    }

    /* ===== Form Styling ===== */
    form {
      background: #fff;
      padding: 25px 30px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
      margin-bottom: 40px;
    }
    form h2 {
      margin-bottom: 20px;
      font-weight: 700;
      color: #2c3e50;
    }
    form input[type="text"],
    form textarea,
    form select {
      width: 100%;
      padding: 14px 18px;
      margin-bottom: 20px;
      font-size: 1em;
      border-radius: 8px;
      border: 1.8px solid #ccc;
      transition: border-color 0.3s ease;
      font-family: inherit;
      resize: vertical;
    }
    form input[type="text"]:focus,
    form textarea:focus,
    form select:focus {
      border-color: #00ffc3;
      outline: none;
    }
    form textarea {
      min-height: 120px;
    }
    form button {
      background-color: #0e1726;
      color: #fff;
      padding: 15px;
      font-size: 1.1em;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-weight: 700;
      transition: background-color 0.3s ease;
      width: 100%;
    }
    form button:hover {
      background-color: #00ffc3;
      color: #000;
    }

    /* ===== List Styling ===== */
    ul.list-item {
      list-style-type: none;
      padding-left: 0;
      margin-bottom: 40px;
    }
    ul.list-item li {
      background: #fff;
      padding: 15px 20px;
      margin-bottom: 12px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
      font-weight: 600;
      color: #34495e;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: background-color 0.3s ease;
    }
    ul.list-item li:hover {
      background-color: #f0f6f9;
    }
    ul.list-item li a {
      color: #e74c3c;
      font-weight: 700;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    ul.list-item li a:hover {
      color: #c0392b;
    }

    /* ===== Footer ===== */
    footer {
      max-width: 900px;
      margin: 40px auto;
      padding: 15px;
      text-align: center;
      font-size: 0.9em;
      color: #777;
    }

    /* ===== Responsive ===== */
    @media (max-width: 600px) {
      form button {
        font-size: 1em;
        padding: 12px;
      }
      header .container {
        flex-direction: column;
        gap: 10px;
      }
      header nav a {
        margin-left: 0;
        font-size: 0.95em;
      }
      ul.list-item li {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
      }
    }
  </style>
</head>
<body>

<header>
  <div class="container">
    <h1>Admin GECKODE</h1>
    <nav>
      <a href="index.php">Beranda</a>
      <a href="admin.php" class="active">Admin</a>
    </nav>
  </div>
</header>

<main class="container">

  <nav class="breadcrumb">
    <a href="index.php">&larr; Kembali ke Beranda</a>
  </nav>

  <form method="post" autocomplete="off">
    <h2>Tambah Kursus</h2>
    <input type="text" name="judul_kursus" placeholder="Judul Kursus" required />
    <input type="text" name="deskripsi" placeholder="Deskripsi" required />
    <input type="text" name="gambar" placeholder="Nama File Gambar (di folder img/)" required />
    <button type="submit" name="tambah_kursus">Tambah Kursus</button>
  </form>

  <h2>Daftar Kursus</h2>
  <ul class="list-item">
    <?php
    $kursus = mysqli_query($conn, "SELECT * FROM kursus ORDER BY id_kursus DESC");
    while ($k = mysqli_fetch_assoc($kursus)) {
      echo "<li>{$k['judul_kursus']} <a href='?hapus_kursus={$k['id_kursus']}' onclick='return confirm(\"Hapus kursus?\")'>Hapus</a></li>";
    }
    ?>
  </ul>

  <form method="post" autocomplete="off">
    <h2>Tambah Materi</h2>
    <select name="id_kursus" required>
      <option value="">Pilih Kursus</option>
      <?php
      $k = mysqli_query($conn, "SELECT * FROM kursus ORDER BY judul_kursus ASC");
      while ($row = mysqli_fetch_assoc($k)) {
        echo "<option value='{$row['id_kursus']}'>{$row['judul_kursus']}</option>";
      }
      ?>
    </select>
    <input type="text" name="judul_materi" placeholder="Judul Materi" required />
    <textarea name="konten" placeholder="Konten Materi" required></textarea>
    <input type="text" name="video_link" placeholder="Link Video (opsional)" />
    <button type="submit" name="tambah_materi">Tambah Materi</button>
  </form>

  <h2>Daftar Materi</h2>
  <ul class="list-item">
    <?php
    $materi = mysqli_query($conn, "
      SELECT materi.*, kursus.judul_kursus 
      FROM materi 
      JOIN kursus ON kursus.id_kursus = materi.id_kursus
      ORDER BY materi.id_materi DESC
    ");
    while ($m = mysqli_fetch_assoc($materi)) {
      echo "<li>{$m['judul_materi']} ({$m['judul_kursus']}) <a href='?hapus_materi={$m['id_materi']}' onclick='return confirm(\"Hapus materi?\")'>Hapus</a></li>";
    }
    ?>
  </ul>

</main>

<footer>
  <p>&copy; 2025 GECKODE - Admin Panel</p>
</footer>

</body>
</html>
