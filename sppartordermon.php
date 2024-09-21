<!DOCTYPE html>
<html lang="en">
<head>
  <title>Spare Part Order Monitor</title>
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


<div class="container">
<h2>PMD Spare Part Order Monitor</h2>
<br/>

           
<br/>
<br/>


  

    

  </h5>
  <br/>

<br/>
<a button type="button" class="btn btn-secondary" href="../pf/sppartordermonXL.php" > Export ke Excel</button></a>

<br/>
<br/>

<div class="form-group">
<form>
     
          
        <table class="table table-bordered">
        <div class="table-responsive">
        <thead>
          <tr>
          <th>Die Type</th>         
          <th>Die Code</th>          
          <th>Die Name</th>
          <th>Spare Part Name </th>
          <th>Spare part No.</th>
          <th>Quantity</th>
          <th>Reason Request</th>
          <th>Order Date</th>
          
          <th>Order by</th>
          <th>Int/Ext</th> 
          <th>Status</th>
          <th>Receive Date</th>  
          <th>ReceiveID</th>
          <th>Qty Receive</th>

        
          </tr>
        </thead>
        <tbody>
          <?php
          $spareque = mysqli_query($connect2,"SELECT * FROM sparepartorder  ORDER BY ID asc");
          while ($sparefetch = mysqli_fetch_array($spareque)){
          $dietype = $sparefetch['dietype'];
          $die_name = $sparefetch['die_name'];

          if ($dietype=="stamping"){
          $diecodeque = mysqli_query($connect,"SELECT * FROM stampingdies WHERE die_name='$die_name' ");
          $diecodefetch = mysqli_fetch_array($diecodeque);
          $diecode= $diecodefetch['die_code'];  
          }elseif ($dietype=="molding"){
          $diecodeque = mysqli_query($connect,"SELECT * FROM moldingdies WHERE die_name='$die_name' ");
          $diecodefetch = mysqli_fetch_array($diecodeque);
          $diecode= $diecodefetch['die_code']; 
        }
          

          $spare_partname = $sparefetch['spare_partname'];
          $dwgno = $sparefetch['dwgno'];
          $Qty = $sparefetch['Qty'];
          //$requestdate = $sparefetch['requestdate'];
          $requestor = $sparefetch['requestor'];

          $reasonrqst = $sparefetch['reasonrqst'];
          $Orderdate = $sparefetch['Orderdate'];
          $intext = $sparefetch['intext'];  
          $orderID = $sparefetch['orderID'];
          $Status = $sparefetch['Status'];

          $intIDque = mysqli_query($connect2,"SELECT MAX(ID) as maxID FROM sparepartstatus WHERE orderID='$orderID' ");
          $IntIDfet = mysqli_fetch_array($intIDque);
          $ID = $IntIDfet['maxID'];
          $intstatque = mysqli_query($connect2,"SELECT * FROM sparepartstatus WHERE ID='$ID'");
          $intstatfet = mysqli_fetch_array($intstatque);
          $intstatnum = mysqli_num_rows($intstatque);
           
          if ($intstatnum>0){
        
          $intstat = $intstatfet['Status']; 
          if ($intstat==""){
          $intstat ="-";  
          }
          }


          $extstatque = mysqli_query($connect2,"SELECT * FROM externalspare WHERE orderID='$orderID'");
          $extstatnum = mysqli_num_rows($extstatque);
          if ($extstatnum>0){
          $extstatfet = mysqli_fetch_array($extstatque);
          $extstat = $extstatfet['Status']; 
          if ($extstat==""){
          $extstat ="-";  
          }
          }
          // Query untuk mengambil receive_date dari tabel receive_order
          $receiveque = mysqli_query($connect2, "SELECT receivedate FROM receiveorder WHERE orderID = '$orderID'");
          
          if($receiveque) {
            if(mysqli_num_rows($receiveque) > 0){
              $receivefetch = mysqli_fetch_array($receiveque);
              $receivedate = $receivefetch['receivedate'];
            } else {
              $receivedate = " ";
            }
          } else {
            echo "Error: " . mysqli_error($connect2);
            $receivedate = " ";
          }
          $receiveidque = mysqli_query($connect2, "SELECT receiveID FROM receiveorder WHERE orderID ='$orderID'");
          if($receiveidque){
            if (mysqli_num_rows($receiveidque) > 0) {
              $receiveidfetch = mysqli_fetch_array($receiveidque);
              $receiveID = $receiveidfetch['receiveID'];
            } else {
              $receiveID = " ";
            } 
          } else{
            echo "Error: " . mysqli_error($connect2);
            $receiveID = " ";
          }
           $qtyreque = mysqli_query($connect2, "SELECT Qtyre FROM receiveorder WHERE orderID ='$orderID'");
          if($qtyreque){
            if (mysqli_num_rows($qtyreque) > 0) {
              $qtyrefetch = mysqli_fetch_array($qtyreque);
              $Qtyre = $qtyrefetch['Qtyre'];
            } else {
              $Qtyre = " ";
            } 
          } else{
            echo "Error: " . mysqli_error($connect2);
            $Qtyre = " ";
          }

          ?>
          
          <tr>
          <td><?php echo $dietype;?></td>
          <td><?php echo $diecode;?></td>
          <td><?php echo $die_name;?></td>
          <td><?php echo $spare_partname;?></td>
          <td><?php echo $dwgno;?></td>
          <td><?php echo $Qty;?></td>
          <td><?php echo $reasonrqst;?></td>
          <td><?php echo $Orderdate;?></td>
          <td><?php echo $requestor;?></td>



          <td><?php

          if ($intext=='int - ext'){
          echo $intext;
          echo "<br>";

          $inque = mysqli_query($connect2,"SELECT * FROM sparepartstatus WHERE orderID='$orderID'");
          $infet = mysqli_fetch_array($inque);
          $Qtyallin = $infet['Qtyallin'];


          $extque = mysqli_query($connect2,"SELECT * FROM externalspare WHERE orderID='$orderID'");
          $extfet = mysqli_fetch_array($extque);
          $Qtyallext = $extfet['Qtyallext'];

          echo "internal =";echo "$Qtyallin"; echo "<br>";          
          echo "external =";echo "$Qtyallext"; echo "<br>";
          }else{
          echo $intext;
          if ($intext =="internal"){
            echo "<br>";
          $inque = mysqli_query($connect2,"SELECT * FROM sparepartstatus WHERE orderID='$orderID'");
          $rowinque = mysqli_num_rows($inque);
          if($rowinque>0){
          $infet = mysqli_fetch_array($inque);
          $Qtyallin = $infet['Qtyallin'];
          echo "internal =";echo "$Qtyallin"; echo "<br>";
          }}

          if ($intext =="external"){
              echo "<br>";
          $extque = mysqli_query($connect2,"SELECT * FROM externalspare WHERE orderID='$orderID'");
          $rowextque = mysqli_num_rows($extque);
          if($rowextque>0){
          $extfet = mysqli_fetch_array($extque);
          $Qtyallext = $extfet['Qtyallext'];
          echo "internal =";echo "$Qtyallin"; echo "<br>";
          }}
                    
                          
          }


         ?></td>  
          
          <td><?php echo $Status; echo "<br>"; 

          if ($intstatnum>0){
          echo "internal= "; echo $intstat; echo "<br>";}

          if ($extstatnum>0){
          echo "external= "; echo $extstat;}
          


                     ?></td>
          <td><?php echo $receivedate;?></td>
          <td><?php echo $receiveID;?></td>
          <td><?php echo $Qtyre;?></td>
        
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