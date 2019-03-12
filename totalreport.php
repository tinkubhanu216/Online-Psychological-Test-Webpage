<?php
include './ss.php';
include('./dbconnect.php');
session_start();
if(!isset($_SESSION["userid"])){
	header('location:index.php');
}else{
	if($_SESSION["usertype"]=='student'){
		header('location:testaccept.php');
	}
}

?>
<?php
$studentid=$msg="";
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
		<?php
			if($_SESSION["usertype"]=='counsellor'){
				echo "<a class='hh' href='admin.php'>Create Test</a>";
			}
		?>
		<a class="hh" href="report.php">Student Report</a>
		<a class="hh" href="totalreport.php">Total Report</a>
		<a class="hh" href="logout.php">Logout</a>

	</header>
	<br><br><br>
	<center>
	<div class="ui segment" style="width: 70%;background-color: rgba(255,255,255,0.1);">
		<h1  class="ui piled segment big header" style="text-align: center;">Report</h1>
		<br>
		<form class="ui form" method="post" action="viewreport.php">
			<?php
				$sql="select testid,testtitle from tests";
				$res=mysqli_query($conn,$sql);
				while($row=mysqli_fetch_assoc($res)){
					$testid=$row["testid"];
					$testtitle=$row["testtitle"];
					echo "<button class='ui button' value='$testid' name='testid'>$testtitle</button>";
				}
			?>
			
		</form>

	</div></center>
	</div></center>


</body>
</html>