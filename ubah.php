<?php
  // mengambil data buku dari database berdasarkan ID buku
  $conn = mysqli_connect("localhost", "root", "", "tkbuku");
  $id_buku = $_GET['id'];
  $query = "SELECT * FROM buku WHERE id_buku=$id_buku";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  // memperbarui data buku setelah pengguna mengirimkan formulir
  if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $harga = $_POST['harga'];
    $query = "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', harga=$harga WHERE id_buku=$id_buku";
    mysqli_query($conn, $query);
    header("Location: admin.php");
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Ubah Data Buku</title>
</head>
<body>
  <h1>Ubah Data Buku</h1>
  <form method="post">
    <label for="judul">Judul:</label><br>
    <input type="text" id="judul" name="judul" value="<?php echo $row['judul']; ?>"><br>

    <label for="pengarang">Pengarang:</label><br>
    <input type="text" id="pengarang" name="pengarang" value="<?php echo $row['pengarang']; ?>"><br>

    <label for="penerbit">Penerbit:</label><br>
    <input type="text" id="penerbit" name="penerbit" value="<?php echo $row['penerbit']; ?>"><br>

    <label for="harga">Harga:</label><br>
    <input type="text" id="harga" name="harga" value="<?php echo $row['harga']; ?>"><br>

    <input type="submit" name="submit" value="Simpan Perubahan">
  </form>
</body>
</html>
