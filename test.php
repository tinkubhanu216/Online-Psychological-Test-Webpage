<?php
include './ss.php';
include('./dbconnect.php');
$studentid="";
$testid="";

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
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$testid=$_POST["testid"];
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
	<br><br>
	<center>

	<div class="ui container stacked segment " style="position: relative;width: 85%;"><br>

<?php
		if($studentid!=""){
			echo '<form class="ui form" action="submittest.php" method="post" style="text-align: left;width: 85%;">';
			$sql="select *from tests where testid='$testid'";
			$sql1="select *from ".$testid."questions q,".$testid."options o where q.testid=o.testid and  q.testid='$testid' order by q.questionno";
			$result=mysqli_query($conn,$sql);
			$row1=mysqli_fetch_assoc($result);
			$noofoptions=$row1["noofoptions"];
			$noofquestions=$row1["noofquestions"];
			$result1=mysqli_query($conn,$sql1);
			$title=$row1["testtitle"];
			echo "		<h1  class='ui piled segment big header' style='text-align: center;'> $title </h1>
		<div class='ui horizontal divider'>
			Student ID: $studentid 
		</div><br>
";
			if(mysqli_num_rows($result1)>0){
				while($row=mysqli_fetch_assoc($result1)){
					$questionno=$row["questionno"];
					$questionname=$row["questionname"];

					echo "		<div class='field'>
						<label>Question $questionno : $questionname </label>
						<br>
						<div class='inline fields' style='position:relative;left:3em;'>";
					$k=1;
					while ($k<=$noofoptions) {
						$opval=$row["OPVAL$k"];
						$opt=$row["OP$k"];
							echo "<div class='field'>
						      <div class='ui radio checkbox'>
						        <input type='radio' name='q$questionno' value='$opval' tabindex='0' required>
						        <label> $opt </label>
						      </div>
						    </div>	";
						    $k=$k+1;
					}
					echo "</div>
					</div>
					<br>";
				}

			}
			echo "<input type='hidden' name='noofquestions' value='$noofquestions'>";
			echo "<input type='hidden' name='noofoptions' value='$noofoptions'>";
			echo "<input type='hidden' name='studentid' value='$studentid'>";
			echo "<input type='hidden' name='testid' value='$testid'>";
			echo "<button class='ui button'>Submit</button>";
		}
?>

		<br>
		</form>
	</div></center>

</body>
</html>
