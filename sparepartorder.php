<!DOCTYPE html>
<html lang="en">
<head>
  <title>Spare Parts Order Input</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
 <script type="text/javascript" src="../js/jquery-3.5.0.min.js"></script>
</head>

<?php 
include '../misc/connect.php';
?>

<?php

if (isset($_GET['dietype'])){
$dietype = ($_GET['dietype']);
}

if (isset($_GET['die_name'])){
$die_name = ($_GET['die_name']);
}

if (isset($_GET['dwgno'])){
$dwgno = ($_GET['dwgno']);
}

?>

<SCRIPT language=JavaScript>

function reload(form)
{
var val0=form.dietype.options[form.dietype.options.selectedIndex].value;
self.location='sparepartorder.php?dietype='+val0 ;

}


function reload1(form)
{
var val0=form.dietype.options[form.dietype.options.selectedIndex].value;
var val=form.diename.options[form.diename.options.selectedIndex].value;
self.location='sparepartorder.php?dietype='+val0+'&die_name='+val ;

}

function reload2(form)
{
var val0=form.dietype.options[form.dietype.options.selectedIndex].value;
var val=form.diename.options[form.diename.options.selectedIndex].value;
var val1=form.dwgno.options[form.dwgno.options.selectedIndex].value;
self.location='sparepartorder.php?dietype='+val0+'&die_name='+val+'&dwgno='+val1 ;

}

</script>


<body>



<div align="center">
  <h1>SPARE PART ORDER</h1>
  <h1>🛒</h1>
  <br/>
<a button type="button" class="btn btn-primary" href="../index.php" >Back To Menu </button></a>
<br/>
  
<form action="sppartorder-act.php?dietype=<?php echo $dietype;?>&die_name=<?php echo$die_name;?>&dwgno=<?php echo $dwgno;?>" method="post">
    <div class="form-group">
  

  <label><h2>Dies Stamping / Molding</h2></label>
  <br>
  <label>For General Part Please Select Stamping Dies And Select General Part</label>
      </br>
      <select name="dietype" class="form-control" style="width: 350px" onchange="reload(this.form)" required>; 
     
     <?php 
            if(isset($dietype) and strlen($dietype) > 0){
     ?>       
     <OPTION value="<?php echo $dietype?>" ><?php echo $dietype?></OPTION> 
   <?php }?>
     <OPTION value="">Type Die</OPTION> 
     <OPTION value="stamping">Stamping</OPTION>
     <OPTION value="molding">Molding</OPTION>
     <OPTION value="general">General</OPTION>
     </select>
      <?php 
            if(isset($dietype) and strlen($dietype) > 0){
     
            if($dietype=="stamping"){
      ?>
       <label>Dies name</label>
       <select name="diename" class="form-control" style="width: 350px" onchange="reload1(this.form)" required>; 
             
          <?php 
            if(isset($die_name) and strlen($die_name) > 0){
          ?>       
          <OPTION value="<?php echo $die_name;?>" ><?php echo $die_name;?></OPTION> 
          <?php }?>
          <option value="">Pilih Nama Die</option> 
        <?php

        $dienamestaque = mysqli_query($connect,"SELECT * FROM stampingdies order by die_name");
        while ($dienamestafet = mysqli_fetch_array($dienamestaque)){
        ?>  
        <option value="<?php echo $dienamestafet['die_name'];?>"><?php echo $dienamestafet['die_name'];?></option>
        <?php        
        }
        ?>
        </select>
        <?php 
        if(isset($die_name) and strlen($die_name) > 0){
        ?>      
        <label>Spare part Name</label>
        </br>
 
       <select name="dwgno" class="form-control" style="width: 350px" onchange="reload2(this.form)"  required>; 

        <?php 
            if(isset($dwgno) and strlen($dwgno) > 0){
             $dwgque = mysqli_query ($connect,"SELECT * FROM stampdiesparestock WHERE die_name='$die_name' and dwgno='$dwgno'");
            $dwgfetch = mysqli_fetch_array($dwgque);
            $die_name = $dwgfetch['die_name'];
            $dwgnostafet = $dwgfetch['spare_partname'];
          ?>       
          <OPTION value="<?php echo $dwgno?>" ><?php echo $dwgno;echo " - ";echo $dwgnostafet;?></OPTION> 
          <?php }?> 
           
       <option value="">Select Spare Part Name</option>
       <option value="-" >Spare Part Tidak Ada Dalam List</option>
        <?php
        $dwgnostaque = mysqli_query($connect,"SELECT * FROM stampdiesparestock WHERE die_name='$die_name'");
        while ($dwgnostafet = mysqli_fetch_array($dwgnostaque)){
        ?>  
                 
        <option value="<?php echo $dwgnostafet['dwgno'];?>"><?php echo $dwgnostafet['dwgno'];?> - <?php echo $dwgnostafet['spare_partname'];?></option>
        <?php        
        }
        ?>
        </select>

        <?php 
        } }

        ?>

         <?php 
     
            if($dietype=="molding"){

        ?>
         <label>Dies name</label>
         <select name="diename" class="form-control" style="width: 350px" onchange="reload1(this.form)" required>; 
                   
        <?php 
            if(isset($die_name) and strlen($die_name) > 0){
          ?>       
          <OPTION value="<?php echo $die_name?>" ><?php echo $die_name?></OPTION> 
          <?php }?>


          <option value="">Pilih Nama Die</option> 
  
        <?php

        $dienamemolque = mysqli_query($connect,"SELECT * FROM moldingdies order by die_name ");
        while ($dienamemolfet = mysqli_fetch_array($dienamemolque)){
        ?>  

        <option value="<?php echo $dienamemolfet['die_name'];?>"><?php echo $dienamemolfet['die_name'];?></option>

        <?php        
        }
        ?>
        </select>

         <?php 
        if(isset($die_name) and strlen($die_name) > 0){
        ?>      
        <label>Spare part Name</label>
       <select name="dwgno" class="form-control" style="width: 350px" onchange="reload2(this.form)" required>; 

          <?php 
            if(isset($dwgno) and strlen($dwgno) > 0){
            $dwgque = mysqli_query ($connect,"SELECT * FROM molddiesparestock WHERE die_name='$die_name' and dwgno='$dwgno'");
            $dwgfetch = mysqli_fetch_array($dwgque);
            $die_name = $dwgfetch['die_name'];
            $dwgnostafet = $dwgfetch['spare_partname'];
          ?>


          <OPTION value="<?php echo $dwgno?>" ><?php echo $dwgno;echo " - ";echo $dwgnostafet;?></OPTION> 
          <?php }?> 
           
           
        <option value="" restricted>Pilih Spare Part No</option>
        <option value="-" >Spare Part Tidak Ada Dalam List</option>
       
        <?php
        $dwgnostaque = mysqli_query($connect,"SELECT * FROM molddiesparestock WHERE die_name='$die_name' ");
        while ($dwgnostafet = mysqli_fetch_array($dwgnostaque)){
        ?>  
        <option value="<?php echo $dwgnostafet['dwgno'];?>"><?php echo $dwgnostafet['dwgno'];?> - <?php echo $dwgnostafet['spare_partname'];?> </option>

        <?php        
        }
        ?>
        </select>


        
        <?php
        }
        }
          
        ?>    


         <?php 
           if(isset($dwgno) and strlen($dwgno) > 0  and  ($dwgno=="-")){
         

          ?>
          <label>Bila Tidak Ada Dalam List Tolong Isi Kolom Berikut</label>
          </br>
          <input type="text" class="form-control" style="width: 350px" placeholder="Spare Part Name Manuals" name="spare_partname1" required>

        <?php }?>

         <?php 
     
            if($dietype=="general"){

        ?>
         
          <label>Dies Name</label>
          <input type="text" class="form-control" style="width: 350px" name="die_name1">

          <label>DWG No</label>
          <br>
          <input type="text" class="form-control" style="width: 350px" name="dwgno1">
          <label>Spare Part name</label>
          <br>
          <input type="text" class="form-control" style="width: 350px" name="spare_partname2">
          <?php
        }}?>
        <label>Qty</label>
        <br>
        <input type="number" class="form-control" style="width: 350px" name="qty" placeholder="Quantity" required>
        <label>Date Required</label>
        <br>
        <input type="date" class="form-control" style="width: 350px" name="requestdate" required>
        <label>Requested By</label>
        <br>
        <input type="text" class="form-control" style="width: 350px" placeholder="Req By" name="requestor" required>
        <label>Reason Request</label>
        <br>

     <select name="reasonrqst" class="form-control" style="width: 350px" required>; 
        <OPTION value="" restricted>Reason</OPTION> 
        <OPTION value="preventive">preventive</OPTION>
        <OPTION value="improvement">improvement</OPTION>
        <OPTION value="broken">broken</OPTION>
        <OPTION value="renewal">renewal</OPTION>
        <OPTION value="cavup">cavity up</OPTION>
     </SELECT >
     <br>
    <button type="submit" class="btn btn-primary">Order</button>
  </form>
</div>

</body>
</html>



