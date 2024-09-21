<!DOCTYPE html>
<html lang="en">
<head>
  <title>Spare Part Order report</title>
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



<SCRIPT language=JavaScript>



</script>



</head>

<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=sparepartorderreport.xls");

?>
<body>

  
<?php
include "../misc/connect.php";
?>
<?php
 
  if(isset($_GET['die_name'])){
    $die_name= $_GET['die_name'];
  }  
    
  ?>


<div class="container">
<h2>PMD Spare Part Order Report</h2>
<br/>

           
<br/>
<br/>


  

<h5><?php 
  echo "Export By ". $user;
  ?></h5>


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
          <th>Close date</th>
          <th>Order by</th>
          <th>Status</th>            
          
        
          </tr>
        </thead>
        <tbody>
          <?php
          $spareque = mysqli_query($connect2,"SELECT * FROM sparepartstatus WHERE Status='close' and Judgement='OK' ORDER BY ID desc ");
          $nomor = 1;
          while ($sparefetch = mysqli_fetch_array($spareque)){
          $orderID = $sparefetch['orderID'];
          $dateclose = $sparefetch['dateclose'];  
          $sporderconque = mysqli_query($connect2,"SELECT * FROM sparepartorder WHERE orderID='$orderID' ");
          $sporderconfet = mysqli_fetch_array($sporderconque);
          $die_name = isset ($sporderconfet['die_name']) ? $sporderconfet['die_name'] : '';
          $dietype = isset ($sporderconfet['dietype']) ? $sporderconfet['dietype'] : '';


          if ($dietype=="stamping"){
          $diecodeque = mysqli_query($connect,"SELECT * FROM stampingdies WHERE die_name='$die_name' ");
          $diecodefetch = mysqli_fetch_array($diecodeque);
          $diecode= $diecodefetch['die_code'];
          }elseif ($dietype=="molding"){
          $diecodeque = mysqli_query($connect,"SELECT * FROM moldingdies WHERE die_name='$die_name' ");
          $diecodefetch = mysqli_fetch_array($diecodeque);
          $diecode= $diecodefetch['die_code'];  
          }

          $spare_partname = isset ($sporderconfet['spare_partname']) ? $sporderconfet['spare_partname'] : '';
          $dwgno = isset ($sporderconfet['dwgno']) ? $sporderconfet['dwgno'] : '';
          $Qty = isset ($sporderconfet['Qty']) ? $sporderconfet['Qty'] : '';
          $requestdate = isset ($sporderconfet['requestdate']) ? $sporderconfet['requestdate'] : '';
          $requestor = isset ($sporderconfet['requestor']) ? $sporderconfet['requestor'] : '';
          $Orderdate = isset ($sporderconfet['Orderdate']) ? $sporderconfet['Orderdate'] : '';
          $Status = isset ($sporderconfet['Status']) ? $sporderconfet['Status'] : '';

          $intIDque = mysqli_query($connect2,"SELECT MAX(ID) as maxID FROM sparepartstatus WHERE orderID='$orderID' ");
          $IntIDfet = mysqli_fetch_array($intIDque);
          $ID = $IntIDfet['maxID'];
          $intstatque = mysqli_query($connect2,"SELECT * FROM sparepartstatus WHERE ID='$ID'");
          $intstatfet = mysqli_fetch_array($intstatque);
          $intstatnum = mysqli_num_rows($intstatque);
           
          if ($intstatnum>0){
        
          $intstat = $intstatfet['Status']; 
          if ($intstat==""){
          $intstat ="close";  
          }
          }


          $extstatque = mysqli_query($connect2,"SELECT * FROM externalspare WHERE orderID='$orderID'");
          $extstatnum = mysqli_num_rows($extstatque);
          if ($extstatnum>0){
          $extstatfet = mysqli_fetch_array($extstatque);
          $extstat = $extstatfet['Status']; 
          if ($extstat==""){
          $extstat ="close";  
          }
          }

          ?>
          
          <tr>
          <td style="text-align: center;"><?php echo $nomor++; ?></td>
          <td><?php echo $dietype;?></td>
          <td style="text-align: center;"><?php echo $diecode;?></td>
          <td><?php echo $die_name;?></td>
          <td><?php echo $spare_partname;?></td>
          <td style="text-align: center;"><?php echo $dwgno;?></td>
          <td style="text-align: center;"><?php echo $Qty;?></td>
          <td><?php echo $Orderdate;?></td>
          <td><?php echo $requestdate;?></td>
          <td><?php echo $dateclose;?></td>
          <td style="text-align: center;"><?php echo $requestor;?></td>
          
          <td>
            <?php 

          if ($intstatnum>0){
          echo "INT : "; echo $intstat; echo "<br>";}

          if ($extstatnum>0){
          echo "EXT : "; echo $extstat;}
                     ?></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </div>
    </table>


          </form>
</body>
</html>