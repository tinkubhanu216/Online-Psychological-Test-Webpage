<?php
include './ss.php';
include('./dbconnect.php');
$studentid="";
session_start();
if(!isset($_SESSION["userid"])){
	header('location:index.php');
}else{
	if($_SESSION["usertype"]=='counsellor'){
		header('location:admin.php');
	}
	$studentid=$_SESSION["userid"];
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
		<center><p style="color: white;font-size: 1.5em;position: relative;top: 0.3em">A right way to succeed your life</p></center>
	</header><center>
	<div class="ui container stacked segment " style="position: relative;top: 100px;width: 55%;"><br>
		<form class="ui form" action="test.php" method="post">
		<h1 ></h1><br>
		<input type="text" name="testid"  placeholder="testid" style="width: 30%"><br><br>
		<div class="inline fields">
			<div class="field">
				<input type="radio" name="" required>
				<label>I <?php echo $studentid; ?> Willing to write this test </label>
			</div>
			
		</div>
		<br>
		<input type="submit" value="Goto Test" class="ui blue button">
		</form>
		<a href="logout.php"><label class="ui button">Logout</label></a>
	</div></center>

</body>
</html>