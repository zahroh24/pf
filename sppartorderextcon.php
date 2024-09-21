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
<a button type="button" style="width: 150px; margin-bottom: 1rem" class="btn btn-secondary" href="../pf/moldsparepartstockXL.php?user=<?php echo $user;?>&level=<?php echo $level;?>&die_name=<?php echo $die_name;?>" > Export ke Excel</button></a>

<br/>
<br/>

<div class="form-group">
<form>
     
          
        <table class="table table-bordered">
        <div class="table-responsive">
        <thead>
          <tr>
          <th>Die Type</th>          
          <th>Die Name</th>
          <th>Spare Part Name </th>
          <th>Spare part No.</th>
          <th>Quantity</th>
          <th>Order Date</th>
          <th>Request date</th>
          <th>Order by</th>
          <th>Dwg Plan</th>
          <th>Dwg actual</th>
          <th>RFQ Plan</th>
          <th>RFQ actual</th>
          <th>PO Plan</th>
          <th>PO actual</th>
          <th>ETD Plan</th>
          <th>ETD actual</th>
          <th>ETA Plan</th>
          <th>ETA actual</th>
          <th>Finish Plan</th>
          <th>Finish actual</th>

          
          
        
          </tr>
        </thead>
        <tbody>
          <?php

          $extque =mysqli_query($connect2,"SELECT * FROM externalspare WHERE Status <> 'finish' ORDER BY orderID asc ");
          While ($extfet = mysqli_fetch_array($extque)){
          $orderID = $extfet['orderID'];
          $Dwgplan= $extfet['Dwgplan'];
          $Dwgact= $extfet['Dwgact'];
          $RFQplan= $extfet['RFQplan'];
          $RFQact= $extfet['RFQact'];
          $POplan= $extfet['ETDplan'];
          $POact= $extfet['POact']; 
          $ETDplan= $extfet['ETDplan'];
          $ETDact= $extfet['ETDact'];
          $ETAplan= $extfet['ETAplan'];
          $ETAact= $extfet['ETAact'];
          $Finishplan= $extfet['Finishplan'];
          $Finishact= $extfet['Finishact']; 
          $extorderID= $extfet['extorderID']; 
            


          $spareque = mysqli_query($connect2,"SELECT * FROM sparepartorder WHERE orderID ='$orderID'");
          $sparefetch = mysqli_fetch_array($spareque);
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





          ?>

          <tr>
          <td><?php echo $dietype;?></td>
          <td><?php echo $die_name;?></td>
          <td><?php echo $spare_partname;?></td>
          <td><?php echo $dwgno;?></td>
          <td><?php echo $Qty;?></td>
          <td><?php echo $Orderdate;?></td>
          <td><?php echo $requestdate;?></td>
          <td><?php echo $requestor;?></td>
          <td><?php echo $Dwgplan;?></td>
          <td>
          <?php

          if ($Dwgact== '0000-00-00'){
          ?>
          <a button type="button" class="btn btn-secondary" href="../pf/orderext-act.php?user=<?php echo $user;?>&level=<?php echo $level;?>&extorderID=<?php echo $extorderID;?>&change=Dwgact" >Dwg done</button></a>
          <?php
          }else{
          echo $Dwgact;        
          }
          ?>  
          </td>

          <td><?php echo $RFQplan;?></td>
          <td>
          <?php

          if ($RFQact== '0000-00-00'){
          ?>
          <a button type="button" class="btn btn-secondary" href="../pf/orderext-act.php?user=<?php echo $user;?>&level=<?php echo $level;?>&extorderID=<?php echo $extorderID;?>&change=RFQact" >RFQ done</button></a>
          <?php
          }else{
          echo $RFQact;        
          }
          ?>  
          </td>
  
          <td><?php echo $POplan;?></td>
          <td>
          <?php

          if ($POact== '0000-00-00'){
          ?>
          <a button type="button" class="btn btn-secondary" href="../pf/orderext-act.php?user=<?php echo $user;?>&level=<?php echo $level;?>&extorderID=<?php echo $extorderID;?>&change=POact" >PO done</button></a>
          <?php
          }else{
          echo $POact;        
          }
          ?>  
          </td>
        
          <td><?php echo $ETDplan;?></td>
          <td>
          <?php

          if ($ETDact== '0000-00-00'){
          ?>
          <a button type="button" class="btn btn-secondary" href="../pf/orderext-act.php?user=<?php echo $user;?>&level=<?php echo $level;?>&extorderID=<?php echo $extorderID;?>&change=ETDact" >ETD done</button></a>
          <?php
          }else{
          echo $ETDact;        
          }
          ?>  
          </td>
           
          <td><?php echo $ETAplan;?></td>
          <td>
          <?php

          if ($ETAact== '0000-00-00'){
          ?>
          <a button type="button" class="btn btn-secondary" href="../pf/orderext-act.php?user=<?php echo $user;?>&level=<?php echo $level;?>&extorderID=<?php echo $extorderID;?>&change=ETAact" >Part Received</button></a>
          <?php
          }else{
          echo $ETAact;        
          }
          ?>  
          </td>
     
          <td><?php echo $Finishplan;?></td>
          <td>
          <?php

          if ($Finishact== '0000-00-00'){
          ?>
          <a button type="button" class="btn btn-secondary" href="../pf/orderext-act.php?user=<?php echo $user;?>&level=<?php echo $level;?>&extorderID=<?php echo $extorderID;?>&change=Finishact" >Finish order</button></a>
          <?php
          }else{
          echo $Finishact;        
          }
          ?>  
          </td>
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