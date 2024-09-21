<!DOCTYPE html>
<html lang="en">
<head>
  <title>PMD Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
 	<script type="text/javascript" src="js/jquery-3.5.0.min.js"></script>
</head>
<body>
<style>
	.buttonlogin {
		background-color: #008CBA; /* Blue */
		border: none;
		color: white;
		font-weight: bold;
		padding: 5px 1px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		border-radius: 3px;
		cursor: default;
	}
</style>
<div class="container">
	<h2 style="text-align: center; margin-top: 2rem;">PMD INFORMATION .TECH</h2>
	<!-- <h2 style="text-align: center; margin-top: 0,5rem;">LOGIN</h2> -->
	<center>
	<img src="omron.png" alt="omron" style="width:300px">
	</center>
	
	<?php 

include 'misc/connect.php';
// include '../thermodb/display/tasklistissue.php';
session_start();
?>
	<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "gagal"){
			echo "Login gagal! username dan password salah!";
		}else if($_GET['pesan'] == "level"){
			echo "akses tidak sesuai level";
		}else if($_GET['pesan'] == "noid"){
			echo "tolong login kembali";
		}	
	}
	?>
	<form method="post" action="misc/cek_login.php">


	<div class="form-group">
      <center><label>Nama</label><br/></center>
    <center>
      <SELECT name="Name" class="form-control" style="width: 350px;"> 
     <OPTION value=** Disable selected  class="form-control">--Pilih Nama--</OPTION>
     <?php 
     $nameteq= "SELECT * from user ORDER by Name Asc";
     $resteq= mysqli_query($connect,$nameteq);
     while ($rowteq=mysqli_fetch_array($resteq)){
     ?> 
      <OPTION> <?php echo $rowteq['Name'];?> </OPTION>
    <?php }?>
     </SELECT >
  </div>
    </center>
    <div class="form-group">
      <center><label>Password</label><br/></center>
      <center><input type="text" class="form-control" style="width: 350px" placeholder="Password" name="NIK"></center>
    </div>
  
				<td></td>
				<td></td>
				<td><center><input type="submit" class="buttonlogin" style="width: 350px;" value="LOGIN"></td></center>
			</tr>
		</table>			
	</form>
</br>

<?php 
$stampingpqisque = mysqli_query($connect,"SELECT DISTINCT PQISno FROM stampingpqis INNER JOIN stampingpart ON  stampingpqis.part_no = stampingpart.part_no");
$stampingpqisnum = mysqli_num_rows($stampingpqisque);

$stampingsarque = mysqli_query($connect,"SELECT DISTINCT SARNo FROM stampingsar INNER JOIN stampingpart ON stampingsar.part_no = stampingpart.part_no");
$stampingsarnum = mysqli_num_rows($stampingsarque);

$stamdiebrokenque = mysqli_query($connect,"SELECT * FROM stampingdies WHERE diecond ='Broken' ");
$stamdiebroken = mysqli_num_rows($stamdiebrokenque);

$stamdiemaintque = mysqli_query($connect,"SELECT * FROM stampingdies");
$outmain = 0;
While($stamdiemaintfetch = mysqli_fetch_array($stamdiemaintque)){
$die_name = $stamdiemaintfetch['die_name'];
$cavity = $stamdiemaintfetch['cavity'];
$shottomaint = $stamdiemaintfetch['shottomaint'];
	
$stampmatque = mysqli_query($connect,"SELECT * FROM stampdiematrix WHERE die_name='$die_name' ");
While($stampmatfetch = mysqli_fetch_array($stampmatque)){
	$part_name= $stampmatfetch['part_name'];
	
	

	$stampartque = mysqli_query($connect,"SELECT * FROM stampingpart WHERE part_name='$part_name'");
	While ($stampartfetch = mysqli_fetch_array($stampartque)){
	$SPM = $stampartfetch['SPM'];
	$safestroke = 3*$SPM*(525+460+455);

	if ($shottomaint<$safestroke){
	$outmain++;	
	}
	}}}



?>
<center>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="ppcstamp/stampsche.php?user=-&level=-"> Stamping Machine Schedule </button></a>

<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="stampro/stamproDRMdate.php?user=-&level=-" > DRM Stamping </button></a>

<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="stampro/stamproWRMdate.php?user=-&level=-" > Production Summary Stamping </button></a>

<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="quality/stampingpqis.php?user=-&level=-" > Stamping PQIS - PQIS open <?php echo $stampingpqisnum;?> </button></a>

<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="quality/stampingsar.php?user=-&level=-" > Stamping SAR - SAR open <?php echo $stampingsarnum;?> </button></a>

<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="diestamp/stamdielife.php?user=-&level=-" > Dies Life Summary </button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="quality/stampSPCreport.php?user=-&level=-" > SPC Graph </button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-danger" href="diestamp/stampdiebroke.php?user=-&level=-" > Broken dies : <?php echo $stamdiebroken;?> </button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="moldpro/moldproDRMdate.php?user=-&level=-" > DRM Molding</button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="stampro/stamwashDRMdate.php?user=-&level=-" > DRM </button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="stampro/stamwashWRMdate.php?user=-&level=-" > Washing Summary </button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="stampro/stamprotracedate.php?user=-&level=-" > Stamping Lot Tracing</button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-warning" href="diestamp/stampdiemtc.php?user=-&level=-" > Dies Maintenance : <?php echo $outmain;?> </button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-warning" href="display/PMDstatus.php">PMD status</button> </a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-warning" href="display/PMDSPCstatus.php">PMD SPC status</button> </a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-warning" href="display/PFdisplay.php?user=-&level=-">Spare Part Stock</button> </a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="PF/sparepartorder.php" > Spare Part Order</button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="PF/sppartordermon.php" > Spare Part Order Monitor</button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="PF/moldspareout.php?user=-&level=-" > Molding Spare part transaction</button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-success" href="PF/stamspareout.php?user=-&level=-" > Stamping Spare part transaction</button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-danger" href="mtc/maintenancelist.php?user=-&level=-" >Maintenance List</button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-info" href="pf/moldsparepartstockg2rtp.php?user=-&level=-" >G2R Type</button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-secondary" href="display/PMDstamping.php">Stamping Control</button></a>

                                   <!-- Thermoset -->
<legend style="text-align: center;"><b>Thermoset</b></legend>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-primary" href="thermopro/thermoproddrmdate.php?user=-&level=-" > Production DRM </button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-primary" href="thermopro/deflasherdrmdate.php?user=-&level=-" > Deflasher DRM </button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-primary" href="thermopro/selectiondrmdate.php?user=-&level=-" > Selection DRM </button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-primary" href="thermopro/thermopartdefectinfo.php" > Thermoset Part Defect Info </button></a>
<a button type="button" style="width: 255px; margin-bottom: 1rem" class="btn btn-primary" href="../thermodb/display/tasklistissue.php" > Task List Ongoing:
	<?php  $con = mysqli_connect("localhost","root","","thermodb");$c= mysqli_query($con, "SELECT * FROM tasklog WHERE dateacc='' "); $n = mysqli_num_rows($c); echo $n;  ?></button></a>
</center>
</div>
</body>
</html>