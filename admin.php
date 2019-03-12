<?php
include './ss.php';
include('./dbconnect.php');
session_start();
unset($_SESSION["testid"]);
if(!isset($_SESSION["userid"])){
	header('location:index.php');
}else{
	if($_SESSION["usertype"]=='student'){
		header('location:testaccept.php');
	}elseif($_SESSION["usertype"]=='admin'){
		header('location:report.php');
	}
}
?>
<?php
$testid=$testtitle=$msg="";
$noofquestions=$noofoptions=$noofcat=0;
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$testid=test_input($_POST["testid"]);
	$testtitle=test_input($_POST["testtitle"]);
	$noofquestions=test_input($_POST["noofquestions"]);
	$noofoptions=test_input($_POST["noofoptions"]);
	$noofcategories=test_input($_POST["noofcategories"]);
	$scale=test_input($_POST["scale"]);
}
function test_input($data){
	$data=trim($data);
	$data=stripcslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}
if($testid!=""){
	$sql="insert into tests(testid,testtitle,noofquestions,noofoptions,noofcategories,scale) values('$testid','$testtitle',$noofquestions,$noofoptions,$noofcategories,$scale)";

	$sql2="CREATE TABLE `".$testid."questions` ( `testid` VARCHAR(255) NOT NULL , `questioncat` VARCHAR(255) NOT NULL , `questionno` INT NOT NULL , `questionname` VARCHAR(255) NOT NULL , PRIMARY KEY (`testid`, `questionno`))";
	$k=1;
	$val="";
	while($k<=$noofoptions){
		$val=$val."`OP$k` VARCHAR(255) NOT NULL , `OPVAL$k` INT NOT NULL ,";
		$k=$k+1;
	}
	$sql3="CREATE TABLE `".$testid."options` ( `testid` VARCHAR(255) NOT NULL , ".$val." PRIMARY KEY (`testid`))";
	$k=1;
	$val="";
	while($k<=$noofcategories){
		$val=$val."`C$k` VARCHAR(255) NOT NULL ,";
		$k=$k+1;
	}
	$sql4="CREATE TABLE `".$testid."category` ( `testid` VARCHAR(255) NOT NULL , ".$val." PRIMARY KEY (`testid`))";

	if(mysqli_query($conn,$sql) && mysqli_query($conn,$sql2) && mysqli_query($conn,$sql3) && mysqli_query($conn,$sql4)){
		$_SESSION["testid"]=$testid;
		header("location:addquestions.php");
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
		<a class="hh" href="admin.php">Create Test</a>
		<a class="hh" href="report.php">Student Report</a>
		<a class="hh" href="totalreport.php">Total Report</a>
		<a class="hh" href="logout.php">Logout</a>

	</header>
	<br><br><br>
	<center>
	<div class="ui segment" style="width: 70%;background-color: rgba(255,255,255,0.1);">
		<h1  class="ui piled segment big header" style="text-align: center;">Create Test</h1>
		<br>
		<form class="ui form" style="text-align: left" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
			<div class="fields">
				<div class="field">
					<label>TestID:</label>
					<input type="text" name="testid">
				</div>
				<div class="four wide field">
					<label>Test Title</label>
					<input type="text" name="testtitle">
				</div>
				<div class="field">
					<label>Number of Questions</label>
					<input type="number" name="noofquestions">				
				</div>
				<div class="field">
					<label>Number of Options</label>
					<input type="number" name="noofoptions">				
				</div>
				<div class="field">
					<label>Number of Categories</label>
					<input type="number" name="noofcategories">				
				</div>
				<div class="field">
					<label>Scale</label>
					<input type="number" name="scale">				
				</div>
			</div>
			<center>	<div class="ui large buttons" style="width: 40%;">
			  <button class="ui button" type="reset">Reset</button>
			  <div class="or"></div>
			  <button class="ui button" type="submit">Create Test</button>
			</div></center>
		</form>
	</div></center>


</body>
</html>