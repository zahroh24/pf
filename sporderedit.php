<!DOCTYPE html>
<html lang="en">
<head>
  <title>Spare Parts Edit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 <script type="text/javascript" src="../js/jquery-3.5.0.min.js"></script>
</head>
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


<body>

	

<div class="container">
<h2>Spare Parts Edit</h2>
<?php
include '../misc/connect.php';
$cekst = $_GET['statcek'];
$inque = mysqli_query($connect2,"SELECT * FROM process");
$infet = mysqli_fetch_array($inque);
$statnow=$infet['Process'];
  if ($cekst=="active") {
    
   }else{
      ?>
    <center><button class="btn btn-danger" disabled><h2>Proses tidak dapat di ubah pada saat proses berlangsung, Harap selesaikan proses yang sedang berjalan sebelum melakukan perubahan.</h2></button></center></h1>
    <center><h2>⚠️</h2></center></h1>
    <?php
   }
?>
  <br/>
<?php
isset($_GET['user']);
$user = ($_GET['user']);
isset($_GET['level']);
$level = ($_GET['level']);
isset($_GET['orderID']);
$orderID = ($_GET['orderID']);
$intorderID = $_GET['intorderID'];
$seque = mysqli_query($connect2, "SELECT * FROM sparepartplan WHERE orderID='$orderID'");
$sefet = mysqli_fetch_array($seque);
$sepro = $sefet['seqpro'];

if ($user == ""){
header("location:../index.php?pesan=noid"); 
}
if (($level <> "admin")and($level <> "pmdpf")){
header("location:../index.php?pesan=level");  
}

?>

	<form action="orderpro-upd.php?user=<?php echo $user;?>&level=<?php echo $level;?>&orderID=<?php echo $orderID;?>&sro=<?php echo $sepro;?>&intorderID=<?php echo $intorderID;?>" method="post">
    <div class="form-group">

     <?php
     $intspareque = mysqli_query($connect2, "SELECT * FROM sparepartorder WHERE orderID='$orderID'");
     $intsparefet = mysqli_fetch_array($intspareque);
     $dietype = $intsparefet['dietype'];
     $die_name = $intsparefet['die_name'];
     $spare_partname = $intsparefet['spare_partname'];
     $dwgno = $intsparefet['dwgno'];
     $Qty = $intsparefet['Qty'];
     $Orderdate = $intsparefet['Orderdate'];

     $intque = mysqli_query($connect2, "SELECT * FROM sparepartplan WHERE orderID='$orderID'");
     $intfet = mysqli_fetch_array($intque);
     $curpro = $intfet['Currentpro'];
     $sepro = $intfet['seqpro'];
     $pro1 = $intfet['Process1'];
     $pro2 = $intfet['Process2'];
     $pro3 = $intfet['Process3'];
     $pro4 = $intfet['Process4'];
     $pro5 = $intfet['Process5'];
     $pro6 = $intfet['Process6'];
     $pro7 = $intfet['Process7'];
     $es1 = $intfet['est1'];
     $es2 = $intfet['est2'];
     $es3 = $intfet['est3'];
     $es4 = $intfet['est4'];
     $es5 = $intfet['est5'];
     $es6 = $intfet['est6'];
     $es7 = $intfet['est7'];
     ?>
    <label>Current Process:</label><span class="label info"><?php echo"    "; echo $curpro;?></span><br>
    <label>Die Type:</label><span class="label info"><?php echo"    ";echo $dietype;?></span><br>
    <label>Die Name:</label><span class="label info"><?php echo"    ";echo $die_name;?></span><br>
    <label>Spare Part Name:</label><span class="label info"><?php echo"    ";echo $spare_partname;?></span><br>
    <label>Drawing No: </label><span class="label info"><?php echo"    ";echo $dwgno;?></span><br>
    <label>Quantity order: </label><span class="label info"><?php echo"    ";echo $Qty;?></span><br>
    <!-- <label>Quantity inhouse allocation: </label><input type="int" class="col-xs-6" name="Qtyallin"> <br> -->
    <label>order date: </label><span class="label info"><?php echo"    ";echo $Orderdate;?></span><br>
    <label>Sequence Proccess: <input type="number" class="form-control" name="sequence" value="<?php echo $sepro;?>" readonly>




    <div class="form-group">
      <label>Process 1</label>
    </br>
      <SELECT name="Process1" class="form-control">
     <option selected><?php echo "$pro1";?></option>
     <?php 
     $procq= "SELECT * from process ORDER by Process Asc";
     $resprocq= mysqli_query($connect2,$procq);
     while ($rowpro=mysqli_fetch_array($resprocq)){
     ?>
      <OPTION><?php echo $rowpro['Process'];?></OPTION>
    <?php }?>
     </SELECT >
    </div>
    <div class="form-group">
      <label class="label info">Process 1 LT </label>
      </br>
      <input type="int" class="form-control" name="est1" value="<?php echo "$es1";?>">
    </div>
    <div class="form-group">
      <label>Process 2</label>
    </br>
      <SELECT name="Process2" class="form-control"> 
     <option selected><?php echo "$pro2";?></option>
     <?php 
     $procq= "SELECT * from process ORDER by Process Asc";
     $resprocq= mysqli_query($connect2,$procq);
     while ($rowpro=mysqli_fetch_array($resprocq)){
     ?>
      <OPTION> <?php echo $rowpro['Process'];?> </OPTION>
    <?php }?>
     </SELECT >
    </div>
    <div class="form-group">
      <label class="label info">Process 2 LT </label>
      </br>
      <input type="int" class="form-control" name="est2" value="<?php echo "$es2";?>">
    </div>
    <div class="form-group">
      <label>Process 3</label>
    </br>
      <SELECT name="Process3" class="form-control"> 
     <option selected><?php echo "$pro3";?></option>
     <?php 
     $procq= "SELECT * from process ORDER by Process Asc";
     $resprocq= mysqli_query($connect2,$procq);
     while ($rowpro=mysqli_fetch_array($resprocq)){
     ?>
      <OPTION> <?php echo $rowpro['Process'];?> </OPTION>
    <?php }?>
     </SELECT >
    </div>
    <div class="form-group">
      <label class="label info">Process 3 LT </label>
      </br>
      <input type="int" class="form-control" name="est3" value="<?php echo "$es3";?>">
    </div>
    <div class="form-group">
      <label>Process 4</label>
    </br>
      <SELECT name="Process4" class="form-control"> 
     <option selected><?php echo "$pro4";?></option>
     <?php 
     $procq= "SELECT * from process ORDER by Process Asc";
     $resprocq= mysqli_query($connect2,$procq);
     while ($rowpro=mysqli_fetch_array($resprocq)){
     ?>
      <OPTION> <?php echo $rowpro['Process'];?> </OPTION>
    <?php }?>
     </SELECT >
    </div>
    <div class="form-group">
      <label class="label info">Process 4 LT </label>
      </br>
      <input type="int" class="form-control" name="est4" value="<?php echo "$es4";?>">
    </div>
    <div class="form-group">
      <label>Process 5</label>
    </br>
      <SELECT name="Process5" class="form-control"> 
     <option selected><?php echo "$pro5";?></option>
     <?php 
     $procq= "SELECT * from process ORDER by Process Asc";
     $resprocq= mysqli_query($connect2,$procq);
     while ($rowpro=mysqli_fetch_array($resprocq)){
     ?>
      <OPTION> <?php echo $rowpro['Process'];?> </OPTION>
    <?php }?>
     </SELECT >
    </div>
    <div class="form-group">
      <label class="label info">Process 5 LT </label>
      </br>
      <input type="int" class="form-control" name="est5" value="<?php echo "$es5";?>">
    </div>
    <div class="form-group">
      <label>Process 6</label>
    </br>
      <SELECT name="Process6" class="form-control"> 
     <option selected><?php echo "$pro6";?></option>
     <?php 
     $procq= "SELECT * from process ORDER by Process Asc";
     $resprocq= mysqli_query($connect2,$procq);
     while ($rowpro=mysqli_fetch_array($resprocq)){
     ?>
      <OPTION> <?php echo $rowpro['Process'];?> </OPTION>
    <?php }?>
     </SELECT >
    </div>
    <div class="form-group">
      <label class="label info">Process 6 LT </label>
      </br>
      <input type="int" class="form-control" name="est6" value="<?php echo "$es6";?>">
    </div>
    <div class="form-group">
      <label>Process 7</label>
      </br>
      <SELECT name="Process7" class="form-control" readonly> 
     <option selected><?php echo "$pro7";?></option>
     </SELECT >
    </div>
    <div class="form-group">
      <label class="label info">Process 7 LT </label>
      </br>
      <input type="int" class="form-control" name="est7" value="<?php echo "$es7";?>" readonly>
    </div>

    <?php
$cekst = $_GET['statcek'];
$inque = mysqli_query($connect2,"SELECT * FROM process");
$infet = mysqli_fetch_array($inque);
$statnow=$infet['Process'];
  if ($cekst=="active") {
      ?>
        <button type="submit" class="btn btn-primary">Save</button>
    <?php
   }else{
      
   }
?>
</div>
</form>
</body>
</html>



