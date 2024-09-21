<!DOCTYPE html>
<html lang="en">
<head>
  <title>Spare Part Order EDIT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 <script type="text/javascript" src="../js/jquery-3.5.0.min.js"></script>

<style>
.label {
  color: white;
  padding: 8px;
  font-family: Arial;
}
.success {background-color: #4CAF50;} /* Green */
.info {background-color: #2196F3;} /* Blue */
.warning {background-color: #ff9800;} /* Orange */
.danger {background-color: #f44336;} /* Red */ 
.other {background-color: #e7e7e7; color: black;} /* Gray */ 
</style>

<?php
include "../misc/connect.php";
?>
<?php
 
  if(isset($_GET['die_name'])){
    $die_name= $_GET['die_name'];
  }  
    
  ?>

<td>
<?php
isset($_GET['user']);
isset($_GET['level']);
$user = ($_GET['user']);
$level = ($_GET['level']);
$Machine_name="";
if ($user == ""){
header("location:../index.php?pesan=noid"); 
}
if (($level <> "pmdpf")and($level <> "admin")){
header("location:../index.php?pesan=level");  
}

$die_name="";
$intstat="";
$extstat="";
?>
</td>

<SCRIPT language=JavaScript>



</script>



</head>
<body>

<div style="padding-left: 2rem; padding-right: 2rem;">
<h2>PMD Spare Part Order EDIT 🖊️</h2>
<br/>

           
<br/>
<br/>


  

<h5><?php 
  echo "login as   ". $user;
  ?></h5>
  <br/>

<a button type="button" style="width: 150px; margin-bottom: 1rem" class="btn btn-outline-danger" href="../core/PF.php?user=<?php echo $user;?>&level=<?php echo $level;?>">← Back to PF</button></a>
<br/>
<a button type="button" style="width: 150px; margin-bottom: 1rem" class="btn btn-secondary" href="../pf/sppartorderconXL.php?user=<?php echo $user;?>&level=<?php echo $level;?>&die_name=<?php echo $die_name;?>"> Export ke Excel</button></a>

<br/>
<br/>

  <div class="form-group">
<form>
     
          
      <table class="table table-bordered">
        <div class="table-responsive">
        <thead>
          <tr>
          <th>No</th>
          <th>Die Type</th>          
          <th>Die Code</th>         
          <th>Die Name</th>
          <th>Spare Part Name </th>
          <th>Spare part No.</th>
          <th>Quantity</th>
          <th>Order Date</th>
          <th>Request date</th>
          <th>Confirm by</th> 
          <th>Status</th>
          <th>Upd</th>
          
        
        </tr>
        </thead>


        <tbody>
          <?php
          $statque = mysqli_query($connect2,"SELECT * FROM sparepartstatus WHERE Status <> 'close' and Status <> '-' ORDER BY ID DESC ");
          $no = 1;
          while ($statfetch = mysqli_fetch_array($statque)){
          $oid = $statfetch['orderID'];
          $stus = $statfetch['Status'];
          $inID = $statfetch['intorderID'];

          $actstat = mysqli_query($connect2,"SELECT * FROM sparepartplan WHERE orderID='$oid' ");
          $actgetstat = mysqli_fetch_array($actstat);
          $statact = $actgetstat['statpro'];

          $orderque = mysqli_query($connect2,"SELECT * FROM sparepartorder WHERE orderID='$oid' ");
          $orderfetch = mysqli_fetch_array($orderque);
          $dietp = isset ($orderfetch['dietype']) ? $orderfetch['dietype'] : '' ;
          $dienm = isset ($orderfetch['die_name']) ? $orderfetch['die_name'] : '' ; 
          $sprnm = isset ($orderfetch['spare_partname']) ? $orderfetch['spare_partname'] : '' ;
          $dwg = isset ($orderfetch['dwgno']) ? $orderfetch['dwgno'] : '' ;
          $qt = isset ($orderfetch['Qty']) ? $orderfetch['Qty'] : '' ;
          $odate = isset ($orderfetch['Orderdate']) ? $orderfetch['Orderdate'] : '' ;
          $rdate = isset ($orderfetch['requestdate']) ? $orderfetch['requestdate'] : '' ;
          $confir = isset ($orderfetch['conby']) ? $orderfetch['conby'] : '' ;

          if ($dietp=="stamping"){
          $diecodeque = mysqli_query($connect,"SELECT * FROM stampingdies WHERE die_name='$dienm' ");
          $diecodefetch = mysqli_fetch_array($diecodeque);
          $diecode= isset ($diecodefetch['die_code']) ? $diecodefetch['die_code'] : '';  
          }elseif ($dietp=="molding"){
          $diecodeque = mysqli_query($connect,"SELECT * FROM moldingdies WHERE die_name='$dienm' ");
          $diecodefetch = mysqli_fetch_array($diecodeque);
          $diecode= isset ($diecodefetch['die_code']) ? $diecodefetch['die_code'] : '';  
          }

          if ($stus=="") {
            $stus2 = 'pending';
          }else{
            $stus2 = $stus;
          }
          ?>
          
          <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $dietp ?></td>
          <td><?php echo $diecode ?></td>
          <td><?php echo $dienm ?></td>
          <td><?php echo $sprnm ?></td>
          <td style="text-align: center;"><?php echo $dwg ?></td>
          <td style="text-align: center;"><?php echo $qt ?></td>
          <td style="text-align: center;"><?php echo $odate ?></td>
          <td style="text-align: center;"><?php echo $rdate ?></td>
          <td style="text-align: center;"><?php echo $confir ?></td>
          <td style="text-align: center;"><?php echo $stus2 ?></td>
          <td style="text-align: center;">
              <a button type="button" class="btn btn-warning" href="../pf/sporderedit.php?user=<?php echo $user;?>&level=<?php echo $level;?>&orderID=<?php echo $oid;?>&intorderID=<?php echo $inID;?>&statcek=<?php echo $statact;?>">Edit</button></a>
          </td>
          </tr>
        <?php  }?>
      </tbody>
    </div>
  </table>
</form>
</body>
</html>