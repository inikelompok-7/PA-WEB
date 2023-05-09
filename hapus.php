<?php
  // Mengambil id_buku dari parameter
  $id_buku = $_GET['id'];

  // Membuat koneksi ke database
  $conn = mysqli_connect("localhost", "root", "", "tkbuku");

  // Menghapus data berdasarkan id_buku
  $query = "DELETE FROM buku WHERE id_buku=$id_buku";
  $result = mysqli_query($conn, $query);

  // Mengakhiri koneksi database
  mysqli_close($conn);

  // Redirect ke halaman awal
  header("Location: admin.php");
  exit();
?>
