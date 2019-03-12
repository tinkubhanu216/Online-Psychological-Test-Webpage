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

<?php
$msg="";
$noofquestions=$noofoptions=$noofcat=0;
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$noofquestions=test_input($_POST["noofquestions"]);
	$noofoptions=test_input($_POST["noofoptions"]);
	$noofcategories=test_input($_POST["noofcategories"]);

	if($noofquestions!=""){
		$k=1;
		$qcount=0;$qocount=0;
		while ($k<=$noofquestions) {
			$questioncat=test_input($_POST["qc$k"]);
			$questionname=test_input($_POST["q$k"]);
			$sql="insert into ".$testid."questions(testid,questioncat,questionno,questionname) values('$testid','$questioncat',$k,'$questionname')";
			if(mysqli_query($conn,$sql)){
				$qcount=$qcount+1;
			}else{
				$msg=$msg.mysqli_error($conn);
			}
			$k=$k+1;
		}
		$k=2;
		$que="insert into ".$testid."options values('$testid'";
		$opname=test_input($_POST["o1"]);
		$opval=test_input($_POST["ov1"]);
		$opt=",'".$opname."',".$opval;
		while ($k<=$noofoptions) {
			$opname=test_input($_POST["o$k"]);
			$opval=test_input($_POST["ov$k"]);
			$opt=$opt.",'".$opname."',".$opval;
			$k=$k+1;
		}
		$sql2=$que.$opt.")";
		if(mysqli_query($conn,$sql2)){
			$qocount=1;
		}else{
			$msg=$msg.mysqli_error($conn);
		}
		$k=1;
		$val="";
		while($k<=$noofcategories){
			$val=$val.",'".$_POST["c$k"]."'";
			$k=$k+1;
		}
		$quer="insert into ".$testid."category values('$testid'".$val.")";
		$ret4=mysqli_query($conn,$quer);
		$val="";
		$k=1;
		while($k<=$noofquestions){
			$val=$val." `QA$k` INT NOT NULL ,";
			$k=$k+1;
		}
//		$val2="";
//		$k=1;
//		while($k<=$noofcategories){
//			$ms=test_input($_POST["c$k"]);
//			$val2=$val2." `$ms` INT NOT NULL ,";
//			$k=$k+1;
//		}
//		$sql5="CREATE TABLE `".$testid."results` ( `testid` VARCHAR(255) NOT NULL , `studentid` VARCHAR(255) NOT NULL ,".$val."".$val2."PRIMARY KEY (`testid`, `studentid`))";
		$sql5="CREATE TABLE `".$testid."results` ( `testid` VARCHAR(255) NOT NULL , `studentid` VARCHAR(255) NOT NULL ,".$val."PRIMARY KEY (`testid`, `studentid`))";

		$ret3=mysqli_query($conn,$sql5);
		if($qcount==$noofquestions && $qocount && $ret3 && $ret4){
			header('location:reportinput.php');
		}else{
			echo $msg;
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
		<a class="hh" href="admin.php">Create Test</a>
		<a class="hh" href="report.php">Student Report</a>
		<a class="hh" href="totalreport.php">Total Report</a>
		<a class="hh" href="logout.php">Logout</a>

	</header>
	<br><br>
	<center>
	<div class="ui segment" style="width: 70%;background-color: rgba(255,255,255,0.1);">
		<h1  class="ui piled segment big header" style="text-align: center;">Add Questions</h1>
		<br>
		<form class="ui form" style="text-align: left" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
				<?php
					$sql="select *from tests where testid='$testid'";
					$result=mysqli_query($conn,$sql);
					if(mysqli_num_rows($result)>0){
						$row=mysqli_fetch_assoc($result);
						$noofcategories=$row["noofcategories"];
						$noofquestions=$row["noofquestions"];
						$noofoptions=$row["noofoptions"];
						$testtitle=$row["testtitle"];
						echo "<input type='hidden' name='noofcategories' value='$noofcategories'>";
						echo "<input type='hidden' name='noofquestions' value='$noofquestions'>";
						echo "<input type='hidden' name='noofoptions' value='$noofoptions'>";
						echo "<h3>Title: $testtitle </h3>";
						echo "<br>";
						$k=1;
						while($k<=$noofquestions){
							echo "<div class='fields'>";
							echo "<div class='eleven wide field'>
							<label>Question No :$k</label>
							<input type='text' name='q$k'>
							</div>";
							echo "<div class='four wide field'>
							<label>Question Category :</label>
							<input type='text' name='qc$k'>
							</div>";
							echo "</div>";
							$k=$k+1;
						}
						echo "<h3>Options</h3>";
						echo "<div class='inline fields'>";
						$k=1;
						while ($k<=$noofoptions) {
							echo "<div class='field'>
						<label>Option $k:</label>
						<input type='text' name='o$k'>
						</div>";
						$k=$k+1;
						}
						echo "</div><div class='inline fields'>";

						$k=1;
						while ($k<=$noofoptions) {
							echo "<div class='field'>
						<label>Option $k value:</label>
						<input type='text' name='ov$k'>
						</div>";
						$k=$k+1;
						}

						echo "</div>";
						echo "<h3>Categories:</h3>";
						echo "<div class='inline fields'>";
						$k=1;
						while ($k<=$noofcategories) {
							echo "<div class='field'>
						<label>Category $k:</label>
						<input type='text' name='c$k'>
						</div>";
						$k=$k+1;
						}
						echo "</div>";
						echo "<br><br>";
					}

				?>

			<center>	<div class="ui large buttons" style="width: 40%;">
			  <button class="ui button" type="reset">Reset</button>
			  <div class="or"></div>
			  <button class="ui button" type="submit">Proceed</button>
			</div></center>
		</form>
	</div></center>


</body>
</html>