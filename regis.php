<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "tkbuku");

//cek koneksi
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

//memeriksa apakah form sudah di-submit atau belum
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST["nama"];
  $password = $_POST["password"];
  $alamat = $_POST["alamat"];
  $nohp = $_POST["nohp"];
  

  //query untuk memasukkan data ke tabel user
  $sql = "INSERT INTO users (nama, password, role) VALUES ('$nama', '$password', '$alamat','$nohp','user')";

  //mengeksekusi query dan memeriksa apakah data berhasil ditambahkan atau tidak
  if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn);
    echo "Registrasi berhasil. ID user Anda adalah: " . $last_id;
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  //menutup koneksi
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Halaman Register</title>
</head>
<body>

  <h2>Registrasi User Baru</h2>

  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    <label for="nama">Nama:</label><br>
    <input type="text" name="nama" required><br>


    <label for="password">Password:</label><br>
    <input type="password" name="password" required><br>

    <label for="alamat">Alamat:</label><br>
    <input type="text" name="alamat" required><br>

    <label for="nohp">Nomor Hp:</label><br>
    <input type="text" name="nohp" required><br>

    <br>
    <input type="submit" value="Register">

  </form>

</body>
</html>
