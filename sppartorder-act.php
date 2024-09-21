<script src="../sweetalert/sweetalert2.all.min.js"></script>
<script src="../sweetalert/jquery-3.6.1.min.js"></script>
<?php
error_reporting(0);
include '../misc/connect.php';

$dietype = $_GET['dietype'];
$die_name = $_GET['die_name'];
$dwgno = $_GET['dwgno'];
$spare_partname1 = $_POST['spare_partname1'];
$qty = $_POST['qty'];
$requestdate = $_POST['requestdate'];
$requestor = $_POST['requestor'];
$reasonrqst = $_POST['reasonrqst'];
$die_name1 = $_POST['die_name1'];
$dwgno1 = $_POST['dwgno1'];
$spare_partname2 = $_POST['spare_partname2'];



date_default_timezone_set('Asia/Bangkok');
$date = date('yy-m-d H:i:s', time());

$orderID0= mysqli_query($connect,"SELECT CONVERT(now(),signed) AS orderID1");
$orderIDfetch = mysqli_fetch_array($orderID0);
$orderID = $orderIDfetch['orderID1']."PF";

if ($dietype=="stamping"){
$sparque = mysqli_query($connect,"SELECT * FROM stampdiesparestock WHERE die_name='$die_name' and dwgno='$dwgno'");
$sparfet = mysqli_fetch_array($sparque);
$spare_partname= $sparfet['spare_partname'];
}
if($dietype=="molding"){
$sparque = mysqli_query($connect,"SELECT * FROM molddiesparestock WHERE die_name='$die_name' and dwgno='$dwgno'");
$sparfet = mysqli_fetch_array($sparque);
$spare_partname= $sparfet['spare_partname'];
}



if($spare_partname1<>"" and strlen($spare_partname1)>1){
$spare_partname= $spare_partname1;
}

if($dietype=="general"){
$spare_partname= $spare_partname2;
$die_name= $die_name1;
$dwgno= $dwgno1;
}

$reqdate = str_replace('/','-',$requestdate);



mysqli_query($connect2,"INSERT INTO sparepartorder VALUES('','$orderID','$dietype','$die_name','$spare_partname','$dwgno','$qty',now(),'$reqdate','$requestor','','','','order confirmation','','$reasonrqst' )");

// echo "<script> alert('Berikut Nomor Pemesanan Anda $orderID dengan Dies Name = $die_name Dan Jumlah = $qty');window.location='sparepartorder.php'</script>";


 	// echo "<script type='text/javascript'>
	//   setTimeout(function () {
	//   	Swal.fire({
	//   			title: 'Data Saved',
	//   			text: 'No Order = $orderID',
	//   			icon: 'success',
	//   			showConfirmButton: true
	//   		});
	//   },10);
	//   window.setTimeout(function(){
	//   	window.location.replace('sparepartorder.php');
	//   } ,4000);
	//   </script>";
?>
<body>
<script>
	  	Swal.fire({
	  			title: 'Data Saved',
	  			text: 'No Order = <?php echo $orderID; ?>',
	  			icon: 'success',
	  	}).then(function() {
         	window.location = 'sparepartorder.php';
         });
</script>
</body>