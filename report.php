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
$noofquestions=$noofoptions=$noofcat=0;
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$studentid=test_input($_POST["studentid"]);
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
		<form class="ui form" style="text-align: left" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
			<div class="fields">
				<div class="five wide field">
					<label>Student ID:</label>
					<input type="text" name="studentid">
				</div>
			<div class="three wide field">
				<label><br></label>
				<button class="ui button" type="submit">View Report</button>				
			</div>
			</div>
			

		<?php
if($studentid!=""){
	$sql="select *from tests";
	$result=mysqli_query($conn,$sql);

	while($row=mysqli_fetch_assoc($result)){
		$testid=$row["testid"];
		$noofcat=$row["noofcategories"];
		$sql2="select *from ".$testid."results where studentid='$studentid'";
//		echo $sql2;
		echo "<h3>Test ID: $testid </h3>";
		$res=mysqli_query($conn,$sql2);
		if(mysqli_num_rows($res)>0){
			$row1=mysqli_fetch_assoc($res);
			$sql3="select *from ".$testid."category";
//			echo $sql3;
			$res3=mysqli_query($conn,$sql3);
			$n=1;
			$row=mysqli_fetch_assoc($res3);
			while($n<=$noofcat){
				$cat=$row["C$n"];
				echo "<div class='fields'>";
				echo "<div class='three wide field'>";
				echo "<label>$cat</label>";
				$sum=0;
				$sql4="select questionno from ".$testid."questions where questioncat='$cat'";
//				echo $sql4;
				$res4=mysqli_query($conn,$sql4);
				while($row4=mysqli_fetch_assoc($res4)){
					$no=$row4["questionno"];
					$sum=$sum+$row1["QA$no"];
				}
				echo "<div class='ui segment'>$sum</div></div>";

				echo "<div class='three wide field'>";
				echo "<label>$cat Scale</label>";
				$sql5="select scale from ".$testid."cutoff where ".$cat."min<=$sum and ".$cat."max>=$sum";
	//			echo $sql5;
				$res5=mysqli_query($conn,$sql5);
				$row5=mysqli_fetch_assoc($res5);
				$scale=$row5["scale"];
				echo "<div class='ui segment'>$scale</div></div>";
				echo "</div>";
				$n=$n+1;
			}
			echo "<br>";

		}else{
			echo "<h3>No Record Found</h3>";
		}
		
	}
	echo "</div>";
}



		?>
			</form>
				</div></center>
	</div></center>


</body>
</html>