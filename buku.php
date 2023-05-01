<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Daftar Buku</title>
  <link rel="stylesheet" href="sytle.css"/>
</head>

<body>
   <!-- Navbar -->
   <nav class="navbar">
       <a class="navbar-brand" href="#">Toko Buku</a>
       <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav">
           <li class="nav-item">
             <a class="nav-link" href="test1.php">Home</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="buku.php">Daftar Buku</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="kontak.php">Contact</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="index.php">Log Out</a>
           </li>
         </ul>
       </div>
     </nav>
  <h1>Daftar Buku</h1>
  
  <table>
    <thead>
      <tr>
        <th>Judul Buku</th>
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>Harga</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
      // mengambil data buku dari database
      $conn = mysqli_connect("localhost", "root", "", "tkbuku");
      $query = "SELECT * FROM buku";
      $result = mysqli_query($conn, $query);

      // menampilkan data buku dalam tabel
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_buku'] . "</td>";
        echo "<td>" . $row['judul'] . "</td>";
        echo "<td>" . $row['pengarang'] . "</td>";
        echo "<td>" . $row['penerbit'] . "</td>";
        echo "<td>" . $row['harga'] . "</td>";
        echo "<td><a href=\"beli.php?id=" . $row['id'] . "\">Beli</a></td>";
        echo "</tr>";
      }

      // mengakhiri koneksi database
      mysqli_close($conn);
      ?>
    </tbody>
  </table>
</body>

</html>
