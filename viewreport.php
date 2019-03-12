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
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$testid=test_input($_POST["testid"]);
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
		<table class="ui table">
			<th>
				<?php
				$sql9="select *from ".$testid."results";
				$res9=mysqli_query($conn,$sql9);
				$count=mysqli_num_rows($res9);
				echo "				<td>No of Students Written
				<td>$count</td>				";

				?>
			</th>
		</table>
		<br>
		<table class="ui definition table">
		  <thead>
		    <tr><th></th>
		<?php
		$sql8="select * from tests where testid='$testid'";
		$res8=mysqli_query($conn,$sql8);
		$row8=mysqli_fetch_assoc($res8);
		$noofcat=$row8["noofcategories"];

		$sql7="select *from ".$testid."category";
		$res7=mysqli_query($conn,$sql7);
		if($row7=mysqli_fetch_assoc($res7)){
			$cat=$row7["C1"];
		}
		$sql6="select *from ".$testid."cutoff order by ".$cat."min";
				$res6=mysqli_query($conn,$sql6);
				while($row6=mysqli_fetch_assoc($res6)){
					$val=$row6["scale"];
					echo "<th>$val</th>";
				}
				echo "</tr></thead><tbody>";

		$sql="select *from ".$testid."category";
		$res=mysqli_query($conn,$sql);
		$n=1;

		if(mysqli_num_rows($res)>0){
			if($row=mysqli_fetch_assoc($res)){
				while ($n <= $noofcat) {
					$cat=$row["C$n"];
					$sca=array();
					$sql2="select *from ".$testid."cutoff order by ".$cat."min";

					$res2=mysqli_query($conn,$sql2);
					while($row2=mysqli_fetch_assoc($res2)){
						$val=$row2["scale"];
						$new_array=array($val=>0);
						$sca=array_merge($sca, $new_array);
					}

					$questions=array();
					$sql3="select *from ".$testid."questions where questioncat='$cat'";
	//				echo $sql3;
					$res3=mysqli_query($conn,$sql3);
					while($row3=mysqli_fetch_assoc($res3)){
						$qno=$row3["questionno"];
						array_push($questions,$qno);
					}

					$sql4="select *from ".$testid."results";
					$res4=mysqli_query($conn,$sql4);
					while($row4=mysqli_fetch_assoc($res4)){
						$sum=0;
						foreach($questions as $qno){
							$sum=$sum+$row4["QA$qno"];
						}
						$sql5="select scale from ".$testid."cutoff where ".$cat."min<=$sum and ".$cat."max>=$sum";
	//					echo $sql5;
						$res5=mysqli_query($conn,$sql5);
						$row5=mysqli_fetch_assoc($res5);
						$scale=$row5["scale"];

						$sca["$scale"]=$sca["$scale"]+1;
					}
					echo "<tr>";
					echo "<td>$cat</td>";
					foreach ($sca as $key => $value) {
						echo "<td>$value</td>";
					}

					echo "</tr>";
					$n=$n+1;

				}

			}
		}	

		?>
		</tbody></table>
		<form class="ui form" method="get" action="report2.php">
			<button class="ui button" value="<?php echo($testid);  ?>" name="testid">View Report Department Wise</button>
		</form>

	</div></center>
	</div></center>


</body>

</html>