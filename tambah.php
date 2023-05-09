<!DOCTYPE html>
<html>
<head>
  <title>Tambah Data Buku</title>
</head>
<body>

  <?php
    // jika tombol simpan ditekan
    if (isset($_POST['simpan'])) {
      $judul = $_POST['judul'];
      $pengarang = $_POST['pengarang'];
      $penerbit = $_POST['penerbit'];
      $harga = $_POST['harga'];

      // membuat koneksi ke database
      $conn = mysqli_connect("localhost", "root", "", "tkbuku");

      // query untuk menambah data buku
      $query = "INSERT INTO buku (judul, pengarang, penerbit, harga) VALUES ('$judul', '$pengarang', '$penerbit', '$harga')";
      $result = mysqli_query($conn, $query);

      // jika query berhasil dieksekusi
      if ($result) {
        echo "<script>alert('Data berhasil ditambahkan.');window.location='admin.php';</script>";
      }
      // jika query gagal dieksekusi
      else {
        echo "<script>alert('Data gagal ditambahkan.');</script>";
      }

      // mengakhiri koneksi database
      mysqli_close($conn);
    }
  ?>

  <h1>Tambah Data Buku</h1>

  <form method="POST">
    <label for="judul">Judul Buku:</label><br>
    <input type="text" id="judul" name="judul"><br>

    <label for="pengarang">Pengarang:</label><br>
    <input type="text" id="pengarang" name="pengarang"><br>

    <label for="penerbit">Penerbit:</label><br>
    <input type="text" id="penerbit" name="penerbit"><br>

    <label for="harga">Harga:</label><br>
    <input type="number" id="harga" name="harga"><br><br>

    <input type="submit" name="simpan" value="Simpan">
  </form>

</body>
</html>
