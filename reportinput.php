<?php
include './ss.php';
include('./dbconnect.php');
session_start();
$testid="";
if(isset($_SESSION["testid"])){
	$testid=$_SESSION["testid"];
}else{
	header('location:admin.php');
}
if(!isset($_SESSION["userid"])){
	header('location:index.php');
}else{
	if($_SESSION["usertype"]=='student'){
		header('location:testaccept.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Psychological center</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body>
	<img src="rguktlogo.png" height="80em" style="margin-top: 0.7em;position: absolute;">
	<a href="index.php"><h1 class="heading" style="font-size: 2.2em">PSYCHOLOGICAl COUNSELLING<br>CENTER</h1></a>
	<header style="background-color: #144c52;position: relative;width: 97%;left: 0;height: 45px;border-radius: 0px 20px 20px 0px;margin-top: 1em;">
		<a class="hh" href="admin.php">Create Test</a>
		<a class="hh" href="report.php">Student Report</a>
		<a class="hh" href="totalreport.php">Total Report</a>
		<a class="hh" href="logout.php">Logout</a>


	</header>
	<br><br><br>
	<center>
	<div class="ui segment" style="width: 80%;background-color: rgba(255,255,255,0.1);">
		<h1  class="ui piled segment big header" style="text-align: center;">Report</h1>
		<form class="ui form" method="post" action="testfinal.php">
		<br>
		<table class="ui table" style="text-align: center;">
			<?php
				$sql="select *from tests t,".$testid."category c where t.testid=c.testid and t.testid='$testid'";
//				echo $sql;
				$res=mysqli_query($conn,$sql);
				if($row=mysqli_fetch_assoc($res)){
					$noofcat=$row["noofcategories"];
					$scale=$row["scale"];
//					echo $scale;
					$i=1;
					echo "<th>";
					echo "<td></td>";
					while($i<=$noofcat){
						$title=$row["C$i"];
						echo "<td colspan='2'><input type='hidden' name='t$i' value='$title'><b>$title</b></td>";
						$i=$i+1;
					}
					echo "</th>";
					$i=1;
					echo "<tr>";
					echo "<td><b>Scale</b></td>";
					while($i<=2*$noofcat){
						if($i%2==1){
							echo "<td>min</td>";
						}else{
							echo "<td>max</td>";
						}
						$i=$i+1;
					}
					echo "</tr>";
					$i=1;
					while($i<=$scale){
						$k=1;
						echo "<tr>";
						echo "<td><input type='text' name='s$i'></td>";
						while($k<=2*$noofcat){
							echo "<td><input type='text' name='c$i$k' ></td>";
							$k=$k+1;
						}
						echo "</tr>";
						$i=$i+1;
					}
					echo "</table>";
					echo "<input type='hidden' name='noofcat' value='$noofcat'>";
					echo "<input type='hidden' name='noofscale' value='$scale'>";
					echo "<button name='testid' value='$testid' class='ui button'>Confirm</button>";
				}
			?>
		
		
		</form>

	</div></center>
	</div></center>


</body>
</html>