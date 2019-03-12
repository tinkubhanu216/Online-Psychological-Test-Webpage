<?php
include './ss.php';
include('./dbconnect.php');
session_start();
$testid=$msg="";
$m=0;$noofscale=0;
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
	$userid=$_SESSION["userid"];
}
?>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$testid=test_input($_POST["testid"]);
	$noofcat=test_input($_POST["noofcat"]);
	$noofscale=test_input($_POST["noofscale"]);
	$val="";
	$i=1;
	while($i<=$noofcat){
		$cat=$_POST["t$i"];
		$val=$val."`".$cat."min` INT NOT NULL ,"."`".$cat."max` INT NOT NULL ,";
		$i=$i+1;
	}
	$sql="CREATE TABLE `".$testid."cutoff` ( `testid` VARCHAR(255) NOT NULL ,`scale` VARCHAR(255) NOT NULL , ".$val." PRIMARY KEY (`scale`))";
	$ret=mysqli_query($conn,$sql);
	if($ret){
		$i=1;
		$m=0;

		while($i<=$noofscale){
			$k=1;
			$sca=$_POST["s$i"];
			$val="";
			while($k<=2*$noofcat){
				$val=$val.",".$_POST["c$i$k"];
				$k=$k+1;
			}
			$sql2="INSERT INTO `".$testid."cutoff` VALUES ('$testid', '$sca' ".$val.")";
			$ret2=mysqli_query($conn,$sql2);
			if($ret2){
				$m=$m+1;
			}else {
				$msg=$msg.mysqli_error($conn);
			}
			$i=$i+1;
		}
	}


}
function test_input($data){
	$data=trim($data);
	$data=stripcslashes($data);
	$data=htmlspecialchars($data);
	return $data;
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
	</header>
	<br><br><br>
	<center>
	<div class="ui segment" style="width: 80%;background-color: rgba(255,255,255,0.1);">
		<h1  class="ui piled segment big header" style="text-align: center;">Report</h1>
		<div class="ui message">
			<h3><?php if($m==$noofscale){
				echo "success";
				header('Refresh: 5; admin.php');
			}else{
				echo $msg;
			} ?></h3>
		</div>
	</div></center>
	</div></center>


</body>
</html>