<?php
include './ss.php';
include('./dbconnect.php');
$msg="";
$j=0;
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$studentid=$_POST["studentid"];
	$testid=$_POST["testid"];
	$noofquestions=$_POST["noofquestions"];
	$noofoptions=$_POST["noofoptions"];
	$k=1;
	$val="";
	while ($k<=$noofquestions) {
		$val=$val.",".$_POST["q$k"];
		$k=$k+1;
	}

	$sql="insert into ".$testid."results values('$testid','$studentid'".$val.")";
	
	if(mysqli_query($conn,$sql)){
		$msg="success";
	}else{
		$msg=mysqli_error($conn);
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
		<center><p style="color: white;font-size: 1.5em;position: relative;top: 0.3em">A right way to succeed your life</p></center>
	</header><center>
	<div class="ui container stacked segment " style="position: relative;top: 100px;width: 35%;"><br>
		<?php
			
			echo $msg;
		?>
		<br><br><Br>
		<a href="testaccept.php"><button class="ui button">Goto Home</button></a>
	</div></center>

</body>
</html>