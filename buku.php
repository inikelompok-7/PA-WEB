<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Daftar Buku</title>
  <link rel="stylesheet" href="sytle.css"/>
  <link rel="stylesheet" href="buku.css">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
   <!-- Navbar -->
   <!-- <nav class="navbar">
       <a class="navbar-brand" href="#">Toko Buku</a>
       <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav">
           <li class="nav-item">
             <a class="nav-link" href="test1.php">Home</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="buku.php">Daftar Buku</a>
           </li
           <li class="nav-item">
             <a class="nav-link" href="kontak.php">Contact</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="index.php">Log Out</a>
           </li>
         </ul>
       </div>
     </nav> -->
     <!-- Navbar -->

    <header class="header">
        <a href="test1.php" class="logo">Toko Buku Ana</a>
        <nav class="navbar">
          <a href="test1.php">Home</a>
          <a href="buku.php">Daftar Buku</a>
          <a href="kontak.php">Kontak</a>
          <a href="index.php">Logout</a>
        </nav>
      </header>
  <h1>Daftar Buku</h1>
<form method="GET" class="cari">
  <input type="text" name="search" placeholder="Cari judul buku" class="kotak">
  <input type="submit" value="Cari" class="btn btn-primary btn-md">
  <button type="submit" name="show_all" class="btn btn-secondary btn-md">Tampilkan Semua</button>
</form>
<table> 
  <thead>
    <tr>
      <th>No</th>
      <th>Judul Buku</th>
      <th>Pengarang</th>
      <th>Penerbit</th>
      <th>Harga</th>
      <th>Jumlah</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php
    // mengambil data buku dari database
    $conn = mysqli_connect("localhost", "root", "", "tkbuku");
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $query = "SELECT * FROM buku";
    if (!empty($search)) {
      $query .= " WHERE judul LIKE '%$search%'";
    }
    if (isset($_GET['show_all'])) {
      $query = "SELECT * FROM buku";
    }
    $result = mysqli_query($conn, $query);
    $i = 1;

    // menampilkan data buku dalam tabel
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $i++ . "</td>";
      echo "<td>" . $row['judul'] . "</td>";
      echo "<td>" . $row['pengarang'] . "</td>";
      echo "<td>" . $row['penerbit'] . "</td>";
      echo "<td>" . $row['harga'] . "</td>";
      echo "<td>" . $row['jumlah'] . "</td>";
      echo "<td><a href=\"beli.php?id=" . $row['id_buku'] . "\">Beli</a></td>";
      echo "</tr>";
    }

    // mengakhiri koneksi database
    mysqli_close($conn);
  ?>
  </tbody>
</table>
  <footer class="text-white text-center text-lg-start" style="background-color: #23242a;">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row mt-4">
      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">About company</h5>

        <p>
          At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
          voluptatum deleniti atque corrupti.
        </p>

        <p>
          Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas
          molestias.
        </p>

      <div class="mt-4">
                    </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
  
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase">Opening hours</h5>

        <table class="table text-center text-white">
          <tbody class="font-weight-normal">
            <tr>
              <td>Mon - Thu:</td>
              <td>8am - 9pm</td>
            </tr>
            <tr>
              <td>Fri - Sat:</td>
              <td>8am - 1am</td>
            </tr>
            <tr>
              <td>Sunday:</td>
              <td>9am - 10pm</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--Grid column-->
      
    </div>
    <!--Grid row-->
    
  </div>
  <!-- Grid container -->
  <div class="text-center p-3">
      © 2020 Toko Buku Ana:
  </div>
</footer>

</div>
<!-- End of .container -->
</body>

</html>
