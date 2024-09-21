<!DOCTYPE html>
<html lang="en">
<head>
  <title>Spare Part Order confirmation</title>
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
<h2>PMD Spare Part Order Confirmation</h2>
<br/>

           
<br/>
<br/>


  

<h5><?php 
  echo "login as   ". $user;
  ?></h5>
  <br/>

<a button type="button" style="width: 150px; margin-bottom: 1rem" class="btn btn-outline-danger" href="../core/PF.php?user=<?php echo $user;?>&level=<?php echo $level;?>">← Back to PF</button></a>
<br/>
<a button type="button" style="width: 150px; margin-bottom: 1rem" class="btn btn-secondary" href="../pf/sppartorderconXL.php?user=<?php echo $user;?>&level=<?php echo $level;?>&die_name=<?php echo $die_name;?>" > Export ke Excel</button></a>

<form action="../pf/condate.php?user=<?php echo $user;?>&level=<?php echo $level;?>" method="post">
    <select style="width: 175px" Name="condatesend" class="form-control" required>
    <option value="" disabled selected>Select the date</option>
    <?php
    $Datecon = mysqli_query($connect2,"SELECT Orderdate FROM sparepartorder GROUP BY month(Orderdate)");
    While ($dcon= mysqli_fetch_array($Datecon)){
    $dtcon = $dcon['Orderdate'];
    $explodate = explode("-",$dtcon);

    if ($explodate[1]=="01") {
          $datece = "Januari";
    }elseif ($explodate[1]=="02") {
          $datece = "Februari";
    }elseif ($explodate[1]=="03") {
          $datece = "Maret";
    }elseif ($explodate[1]=="04") {
          $datece = "April";
    }elseif ($explodate[1]=="05") {
          $datece = "Mei";
    }elseif ($explodate[1]=="06") {
          $datece = "Juni";
    }elseif ($explodate[1]=="07") {
          $datece = "Juli";
    }elseif ($explodate[1]=="08") {
          $datece = "Agustus";
    }elseif ($explodate[1]=="09") {
          $datece = "September";
    }elseif ($explodate[1]=="10") {
          $datece = "Oktober";
    }elseif ($explodate[1]=="11") {
          $datece = "November";
    }elseif ($explodate[1]=="12") {
          $datece = "Desember";
    }
    ?>  
    ?>
    <option value="<?php echo $explodate[1];?>"><?php echo $datece;?></option>
    <?php
    }
    ?>

    </select>
    <button type="submit" class="btn btn-primary w-15" style="margin-bottom: .8rem;width: 175px;margin-top: 0.5rem;">Cek</button>
</form>

<br/>
<br/>

<!-- Hak Akses Pada Admin -->
<td>
<?php
  $no = 1;
  if($level=="admin"){
  ?>

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
          <th>Order by</th>
          <th>Int/Ext</th> 
          <th>Status</th>           
          <th colspan="4"> Internal - External </th>  
          
        
          </tr>
        </thead>
        <tbody>
          <?php
          $spareque = mysqli_query($connect2,"SELECT * FROM sparepartorder ORDER BY ID DESC");
          while ($sparefetch = mysqli_fetch_array($spareque)){
          $dietype = $sparefetch['dietype'];
          $die_name = $sparefetch['die_name'];
          $spare_partname = $sparefetch['spare_partname'];
          $dwgno = $sparefetch['dwgno'];
          $Qty = $sparefetch['Qty'];
          $requestdate = $sparefetch['requestdate'];
          $requestor = $sparefetch['requestor'];
          $Orderdate = $sparefetch['Orderdate'];
          $intext = $sparefetch['intext'];  
          $orderID = $sparefetch['orderID'];
          $Status = $sparefetch['Status'];


          if ($dietype=="stamping"){
          $diecodeque = mysqli_query($connect,"SELECT * FROM stampingdies WHERE die_name='$die_name' ");
          $diecodefetch = mysqli_fetch_array($diecodeque);
          $diecode= isset ($diecodefetch['die_code']) ? $diecodefetch['die_code'] : '';  
          }elseif ($dietype=="molding"){
          $diecodeque = mysqli_query($connect,"SELECT * FROM moldingdies WHERE die_name='$die_name' ");
          $diecodefetch = mysqli_fetch_array($diecodeque);
          $diecode= isset ($diecodefetch['die_code']) ? $diecodefetch['die_code'] : '';  
          }elseif ($dietype=="general"){
          $diecodeque = mysqli_query($connect,"SELECT * FROM moldingdies WHERE die_name='$die_name' ");
          $diecodefetch = mysqli_fetch_array($diecodeque);
          $diecode= isset ($diecodefetch['die_code']) ? $diecodefetch['die_code'] : '';  
          }




          

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

          ?>
          
          <tr>
          <td><?php echo $no++;?></td>
          <td><?php echo $dietype;?></td>
          <td><?php echo $diecode;?></td>
          <td><?php echo $die_name;?></td>
          <td><?php echo $spare_partname;?></td>
          <td><?php echo $dwgno;?></td>
          <td><?php echo $Qty;?></td>
          <td><?php echo $Orderdate;?></td>
          <td><?php echo $requestdate;?></td>
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
                          
          }


         ?></td>  
          
          <td><?php echo $Status; echo "<br>"; 

          if ($intstatnum>0){
          echo "internal= "; echo $intstat; echo "<br>";}

          if ($extstatnum>0){
          echo "external= "; echo $extstat;}
          


                     ?></td>
          <td>
          <?php 
          if(strlen($intext)==0){

          ?>  
          <a button type="button" class="btn btn-secondary" href="../pf/order-act.php?user=<?php echo $user;?>&level=<?php echo $level;?>&orderID=<?php echo $orderID;?>&order=internal" >internal</button></a>
          <?php
          }
          ?>
          </td>
          
          <td>
          <?php
          if(strlen($intext)==0){

          ?>  
          <a button type="button" class="btn btn-secondary" href="../pf/order-act.php?user=<?php echo $user;?>&level=<?php echo $level;?>&orderID=<?php echo $orderID;?>&order=external" >external</button></a>
          <?php
          }?>
          </td>
          <td> 

          <a button type="button" class="btn btn-secondary" href="../pf/orderret-act.php?user=<?php echo $user;?>&level=<?php echo $level;?>&orderID=<?php echo $orderID;?>&order=external" >retrieve</button></a>

          </td>
          
          <td>

          <a button type="button" class="btn btn-secondary" href="../pf/orderdel-act.php?user=<?php echo $user;?>&level=<?php echo $level;?>&orderID=<?php echo $orderID;?>&order=external" >delete</button></a>

          </td>


          </tr>
          <?php
          }
          ?>



        </tbody>
      </div>



  <?php
  }?>
</td>

<!-- Hak Akses Pada pmdpf -->
<td>
<?php
  if($level=="pmdpf"){
  ?>

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
          <th>Order Date</th>
          <th>Request date</th>
          <th>Order by</th> 
          <th>Status</th>           
          <th colspan="4"> Internal - External </th>  
          
        
          </tr>
        </thead>
        <tbody>
          <?php
          $spareque = mysqli_query($connect2,"SELECT * FROM sparepartorder WHERE Status='order confirmation' ORDER BY ID DESC");
          while ($sparefetch = mysqli_fetch_array($spareque)){
          $dietype = $sparefetch['dietype'];
          $die_name = $sparefetch['die_name'];


          if ($dietype=="stamping"){
          $diecodeque = mysqli_query($connect,"SELECT * FROM stampingdies WHERE die_name='$die_name' ");
          $diecodefetch = mysqli_fetch_array($diecodeque);
          $diecode= isset ($diecodefetch['die_code']) ? $diecodefetch['die_code'] : '';  
          }elseif ($dietype=="molding"){
          $diecodeque = mysqli_query($connect,"SELECT * FROM moldingdies WHERE die_name='$die_name' ");
          $diecodefetch = mysqli_fetch_array($diecodeque);
          $diecode= $diecodefetch['die_code'];  
          }elseif ($dietype=="general"){
          $diecodeque = mysqli_query($connect,"SELECT * FROM moldingdies WHERE die_name='$die_name' ");
          $diecodefetch = mysqli_fetch_array($diecodeque);
          $diecode= isset ($diecodefetch['die_code']) ? $diecodefetch['die_code'] : '';  
          }




          $spare_partname = $sparefetch['spare_partname'];
          $dwgno = $sparefetch['dwgno'];
          $Qty = $sparefetch['Qty'];
          $requestdate = $sparefetch['requestdate'];
          $requestor = $sparefetch['requestor'];
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

          ?>
          
          <tr>
          <td><?php echo $dietype;?></td>
          <td><?php echo $diecode;?></td>
          <td><?php echo $die_name;?></td>
          <td><?php echo $spare_partname;?></td>
          <td><?php echo $dwgno;?></td>
          <td><?php echo $Qty;?></td>
          <td><?php echo $Orderdate;?></td>
          <td><?php echo $requestdate;?></td>
          <td><?php echo $requestor;?></td>     
          <td><?php echo $Status; echo "<br>"; 

          if ($intstatnum>0){
          echo "internal= "; echo $intstat; echo "<br>";}

          if ($extstatnum>0){
          echo "external= "; echo $extstat;}

                     ?></td>
          <td>
          <?php 
          if(strlen($intext)==0){

          ?>  
          <a button type="button" class="btn btn-secondary" href="../pf/order-act.php?user=<?php echo $user;?>&level=<?php echo $level;?>&orderID=<?php echo $orderID;?>&order=internal" >internal</button></a>
          <?php
          }
          ?>
          </td>
          
          <td>
          <?php
          if(strlen($intext)==0){

          ?>  
          <a button type="button" class="btn btn-secondary" href="../pf/order-act.php?user=<?php echo $user;?>&level=<?php echo $level;?>&orderID=<?php echo $orderID;?>&order=external" >external</button></a>
          <?php
          }?>
          </td>
          </tr>
          <?php
          }
          ?>



        </tbody>
      </div>



  <?php
  }?>
</td>


    </table>


          </form>
</body>
</html>