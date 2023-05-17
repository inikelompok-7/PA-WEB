
<?php
session_start();

// Autentikasi khusus untuk role admin
if (!isset($_SESSION["logged_in"]) || $_SESSION["user_role"] != "user") {
    header("Location: index.php");
    exit();
}
// Mengambil data buku dari database
$conn = mysqli_connect("localhost", "root", "", "tkbuku");

// Memastikan parameter id buku telah dikirim melalui URL
if (isset($_GET['id'])) {
    $id_buku = $_GET['id'];

    // Mengambil informasi buku berdasarkan id
    $query = "SELECT * FROM buku WHERE id_buku = $id_buku";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Memeriksa apakah buku ada di database
    if ($row) {
        $judul = $row['judul'];
        $pengarang = $row['pengarang'];
        $penerbit = $row['penerbit'];
        $harga = $row['harga'];
        
        // Memeriksa apakah form pembelian telah di-submit
        if (isset($_POST['beli'])) {
            // Memeriksa apakah session username telah ada
            if (isset($_SESSION["username"])) {
                $username = $_SESSION["username"];
                
                $jumlah = $_POST['jumlah'];
                $total_harga = $jumlah * $harga;

                // Memeriksa apakah jumlah buku yang dibeli tersedia di stok
                if ($jumlah <= $row['jumlah']) {
                    // Mengurangi jumlah jumlah buku di database
                    $query_update = "UPDATE buku SET jumlah = jumlah - $jumlah WHERE id_buku = $id_buku";
                    mysqli_query($conn, $query_update);

                    // Menyimpan data pembeli ke tabel pembelian_buku
                    $query_insert = "INSERT INTO penjualan (id_buku, username, jumlah, total_harga) VALUES ('$id_buku', '$username', '$jumlah', '$total_harga')";
                    mysqli_query($conn, $query_insert);


                    echo "<script>alert('Pembelian sukses!')</script>";
                    echo "<script>window.location.href = 'buku.php'</script>";
                } else {
                    echo "<script>alert('jumlah buku tidak mencukupi.')</script>";
                }
            } else {
                echo "<script>alert('Anda harus login untuk melakukan pembelian.')</script>";
                echo "<script>window.location.href = 'login.php'</script>";
            }
        }
    } else {
        echo "<script>alert('ID buku tidak valid.')</script>";
        echo "<script>window.location.href = 'buku.php'</script>";
    }
}   
    // Menutup koneksi database
    mysqli_close($conn);
?> 

<html>
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Beli</title>
    <link rel="stylesheet" href="buku.css">
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css" />
    <!-- <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css" /> -->
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/typicons/typicons.css" />
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css" />
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css" />
    <link rel="stylesheet" href="js/select.dataTables.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
     
</head>
<body>
    <!-- <div class="content-wrapper"> -->
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Detail Buku</h2>
              <form class="forms-sample" method="POST" onsubmit="return validateForm()">
              <div class="form-group">
                    <label for="judul">Judul Buku</label>
                    <input type="text" class="form-control p-input" required name="judul" id="judul" value="<?php echo $row['judul']; ?>" readonly>
        
                </div>
                <div class="form-group">
                    <label for="pengarang">Pengarang Buku</label>
                    <input type="text" class="form-control p-input" required name="pengarang" id="pengarang" value="<?php echo $row['pengarang']; ?>" readonly>
                </div> 
                <div class="form-group">
                    <label for="penerbit">Penerbit Buku</label>
                    <input type="text" class="form-control p-input" required name="penerbit" id="penerbit" value="<?php echo $row['penerbit']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="harga">Harga Buku</label>
                    <input type="number" class="form-control p-input" required name="harga" id="harga" value="<?php echo $row['harga']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="stok">Jumlah Buku saat ini</label>
                    <input type="text" class="form-control p-input" required name="stok" id="stok" value="<?php echo $row['jumlah']; ?>" readonly>
                    </div>
              <div class="form-group">
                    <label for="jumlah">Masukkan Jumlah Buku</label>
                    <input type="number" class="form-control p-input" required name="jumlah" id="jumlah" placeholder="Masukkan jumlah buku">
                    </div>
                    
                <div class="col-12">
                    <input type="submit" class="btn btn-primary" name="beli" value="beli"></input>
                    <a href="buku.php"><input type="button" class="btn btn-secondary" name="kembalii" value="kembali"></input></a>
                    </form>   
                    
                </div>
              </div>
            </div>
          </div>
            
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/jquery.cookie.js" type="text/javascript"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->

  <script>
  function validateForm() {
    var jumlah = document.getElementById('jumlah').value;
    if (jumlah === '') {
      alert('Harap masukkan jumlah buku.');
      return false;
    }
  }
</script>

</body>
</html>