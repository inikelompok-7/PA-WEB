<?php
  // melakukan koneksi ke database
  $conn = mysqli_connect("localhost", "root", "", "tkbuku");

  // mengecek apakah form telah di-submit
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // mengambil data dari form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $alamat = $_POST["alamat"];
    $nohp = $_POST["nohp"];

    // Mengecek apakah username sudah ada di database
  $query = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // Jika username sudah ada, tampilkan pesan error
    echo "Username sudah digunakan. Silakan coba dengan username lain.";
  } else {
    // Jika username belum ada, simpan data ke database
    $query = "INSERT INTO users (username, password, alamat, nohp, role) VALUES ('$username', '$password', '$alamat', '$nohp', 'user')";
    if (mysqli_query($conn, $query)) {
      // Jika berhasil disimpan, tampilkan pesan sukses
      echo "Registrasi berhasil!";
      header("Location: login.php");
    } else {
      // Jika gagal disimpan, tampilkan pesan error
      echo "Registrasi gagal. Silakan coba lagi.";
    }
  }

  // mengakhiri koneksi database
  mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registrasi User Baru</title>
  <link rel="stylesheet" href="regis.css">
</head>
<body>
  <div class="container">
    <h2>Registrasi User Baru</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="username">Nama:</label>
        <input type="text" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" required>
      </div>
      <div class="form-group">
        <label for="nohp">Nomor Hp:</label>
        <input type="text" name="nohp" required>
      </div>
      <div class="form-group">
      <a href="index.php"><input type="button" value="kembali"></a>
        <input type="submit" value="Register">
        
      </div>
    </form>
  </div>
</body>
</html>