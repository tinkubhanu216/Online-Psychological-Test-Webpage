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
$testid="";
if($_SERVER["REQUEST_METHOD"]=="GET"){
	$testid=test_input($_GET["testid"]);
}
function test_input($data){
	$data=trim($data);
	$data=stripcslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}
if(isset($_POST["testid"])){
	$testid=test_input($_POST["testid"]);
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

		<form class="ui form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
			<select class="ui dropdown" name="year">
				<option value="">Year</option>
				<option value="PUC-1" >PUC-1</option>
				<option value="PUC-2" >PUC-2</option>
				<option value="E-1" >E-1</option>
				<option value="E-2" >E-2</option>
				<option value="E-3" >E-3</option>
				<option value="E-4" >E-4</option>

			</select>
			<select class="ui dropdown" name="department">
				<option value="">Department</option>
				<option value="CHEM" >CHEM</option>
				<option value="CIVIL" >CIVIL</option>
				<option value="CSE" >CSE</option>
				<option value="ECE" >ECE</option>
				<option value="EEE" >EEE</option>
				<option value="MECH" >MECH</option>
				<option value="MME">MME</option>
			</select>
			<select class="ui dropdown" name="class">
				<option value="">Class</option>
				<option value="AB1-101">AB1-101</option>
				<option value="AB1-102">AB1-102</option>
				<option value="AB1-103">AB1-103</option>
			</select>
			<input type="hidden" name="testid" value="<?php echo($testid);  ?>">
			<button type="submit" class="ui button">Get Details</button>
		</form>
		<br>
		<table class="ui definition table">
		  <thead>
		    <tr><th></th>
		    
		    	<?php
		    	if($_SERVER["REQUEST_METHOD"]=="POST"){
					$testid=test_input($_POST["testid"]);
					$year=test_input($_POST["year"]);
					$department=test_input($_POST["department"]);
					$class=test_input($_POST["class"]);
				

		    		$sql="select *from tests where testid='$testid'";
					$result=mysqli_query($conn,$sql);

					while($row=mysqli_fetch_assoc($result)){
						$testid=$row["testid"];
						$noofcat=$row["noofcategories"];

						$sql6="select *from ".$testid."category";
			//			echo $sql3;
						$res6=mysqli_query($conn,$sql6);
						$n=1;
						$row6=mysqli_fetch_assoc($res6);
						while($n<=$noofcat){
							$cat=$row6["C$n"];
							echo "<th>$cat</th>";
							echo "<th>$cat scale</th>";
							$n=$n+1;
						}
						echo "</tr>";
						echo "</thead><tbody>";
						


						if($class!=""){
							$sql2="select *from ".$testid."results where studentid in(select studentid from student s where s.class='$class' order by studentid)";
						}else if($class=="" and $department!="" and $year==""){
							$sql2="select *from ".$testid."results where studentid in(select studentid from student s where s.department='$department' order by studentid)";
						}else if($class=="" and $department!="" and $year!=""){
							$sql2="select *from ".$testid."results where studentid in(select studentid from student s where s.department='$department' and s.year='$year' order by studentid)";
						}else if($class=="" and $department=="" and $year!=""){
							$sql2="select *from ".$testid."results where studentid in(select studentid from student s where s.year='$year' order by studentid)";
						}
//						echo $sql2;

				//		echo $sql2;
						$res=mysqli_query($conn,$sql2);

						if(mysqli_num_rows($res)>0){
							while($row1=mysqli_fetch_assoc($res)){
								echo "<tr>";
								$studentid=$row1["studentid"];
								echo "<td>$studentid</td>";
								$sql3="select *from ".$testid."category";
					//			echo $sql3;
								$res3=mysqli_query($conn,$sql3);
								$n=1;
								$row=mysqli_fetch_assoc($res3);
								while($n<=$noofcat){
									$cat=$row["C$n"];
									
									$sum=0;
									$sql4="select questionno from ".$testid."questions where questioncat='$cat'";
					//				echo $sql4;
									$res4=mysqli_query($conn,$sql4);
									while($row4=mysqli_fetch_assoc($res4)){
										$no=$row4["questionno"];
										$sum=$sum+$row1["QA$no"];
									}
									echo "<td>$sum</td>";
									$sql5="select scale from ".$testid."cutoff where ".$cat."min<=$sum and ".$cat."max>=$sum";
				//					echo $sql5;
									$res5=mysqli_query($conn,$sql5);
									$row5=mysqli_fetch_assoc($res5);
									$scale=$row5["scale"];
									echo "<td>$scale</td>";
									$n=$n+1;
								}
								echo "</tr>";

							}
							echo "</tr>";
						}
					}
				}

		    	?>
			</tbody>
		</table>

	</div></center>
	</div></center>


</body>
<script type="text/javascript">
	$('.ui.dropdown').dropdown({placeholder:'--Choose--'});
</script>

</html>