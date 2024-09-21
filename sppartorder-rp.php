<!DOCTYPE html>
<html lang="en">
<head>
  <title>Spare Part Order Report</title>
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
<body>

	
<?php
include "../misc/connect.php";
?>
<?php
 
  if(isset($_GET['die_name'])){
    $die_name= $_GET['die_name'];
  }  
    
  ?>

<div style="padding-left: 5rem; padding-right: 5rem;" >
<h2>PMD Spare Part Order Report</h2>
<br/>

           
<br/>
<br/>


  

<h5><?php 
  echo "login as   ". $user;
  ?></h5>
  <br/>

<a button type="button" style="width: 150px" class="btn btn-outline-danger" href="../core/PF.php?user=<?php echo $user;?>&level=<?php echo $level;?>">Back to PF</button></a>
<br/>
<br>
<a button type="button" style="width: 150px" class="btn btn-secondary" href="../pf/sppartorder-rpXL.php?user=<?php echo $user;?>&level=<?php echo $level;?>&die_name=<?php echo $die_name;?>" > Export ke Excel</button></a>

<br/>
<br/>

<form>
        <table class="table table-bordered">
        <div class="table-responsive">
        <thead>
          <tr>
          <th style="text-align: center;">No</th>
          <th style="text-align: center;">Die Type</th>          
          <th width="100px" style="text-align: center;">Die Code</th>         
          <th style="text-align: center;">Die Name</th>
          <th style="text-align: center;">Spare Part Name </th>
          <th width="100px" style="text-align: center;">Spare part No.</th>
          <th style="text-align: center;">Quantity</th>
          <th width="125px" style="text-align: center;">Order Date</th>
          <th width="125px" style="text-align: center;">Request Date</th>
          <th width="125px" style="text-align: center;">Close Date</th>
          <th style="text-align: center;">Order by</th>
          <th width="100px" style="text-align: center;">Status</th>            
          
        
          </tr>
        </thead>
        <tbody>
          <?php
          $spareque = mysqli_query($connect2,"SELECT * FROM sparepartstatus WHERE Status='close' and Judgement='OK' ORDER BY ID DESC ");
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
          <td style="text-align: center;" ><?php echo $nomor++; ?></td>
          <td style="text-align: center;" ><?php echo $dietype;?></td>
          <td style="text-align: center;" ><?php echo $diecode;?></td>
          <td style="text-align: center;" ><?php echo $die_name;?></td>
          <td style="text-align: center;" ><?php echo $spare_partname;?></td>
          <td style="text-align: center;" ><?php echo $dwgno;?></td>
          <td style="text-align: center;" ><?php echo $Qty;?></td>
          <td style="text-align: center;" ><?php echo $Orderdate;?></td>
          <td style="text-align: center;" ><?php echo $requestdate;?></td>
          <td style="text-align: center;" ><?php echo $dateclose;?></td>
          <td style="text-align: center;" ><?php echo $requestor;?></td>
          
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
    </table>


          </form>
</body>
</html>