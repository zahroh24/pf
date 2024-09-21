<script src="../sweetalert/sweetalert2.all.min.js"></script>
<script src="../sweetalert/jquery-3.6.1.min.js"></script>
<?php 
// Include koneksi database
include '../misc/connect.php';

// Ambil parameter dari URL
$user = $_GET['user'];
$level = $_GET['level'];
$orderID = $_GET['orderID'];
$Qtyre = $_GET['Qtyre'];
// Set timezone
date_default_timezone_set('Asia/Bangkok');
// Ambil waktu saat ini
$receive_date = date('Y-m-d H:i:s');

// Cek apakah orderID ada di tabel sparepartorder
$checkQuery = "SELECT orderID FROM sparepartorder WHERE orderID = '$orderID'";
$result = mysqli_query($connect2, $checkQuery);
$receiveID0= mysqli_query($connect,"SELECT CONVERT(now(),signed) AS receiveID1");
$receiveIDfetch = mysqli_fetch_array($receiveID0);
$receiveID = 'DTST'.$receiveIDfetch['receiveID1'];

// Jika orderID ada, masukkan ke dalam tabel receiveorder dengan receive_date saat ini
if (mysqli_num_rows($result) > 0) {
    $insertQuery = "INSERT INTO receiveorder (orderID, receivedate, receiveID, Qtyre)
                    VALUES ('$orderID', NOW(), '$receiveID', '$Qtyre')";

    if (mysqli_query($connect2, $insertQuery)) {
        // Jika berhasil, arahkan kembali ke halaman lain
   //     header("Location: sppartorderre.php?user=$user&level=$level&orderID=$orderID&status=success");
        echo $Qtyre;
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . mysqli_error($connect2);
    }
} else {
    // Jika orderID tidak ditemukan di tabel sparepartorder
    echo "Order ID not found in sparepartorder table.";
} 


// Tutup koneksi
mysqli_close($connect2);
?>