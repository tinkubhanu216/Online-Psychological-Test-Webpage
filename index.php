<?php
include './ss.php';
include('./dbconnect.php');
session_start();
if(isset($_SESSION["userid"])){
	if($_SESSION["usertype"]=='student'){
		header('location:testaccept.php');
	}elseif($_SESSION["usertype"]=='counsellor'){
		header('location:admin.php');
	}elseif($_SESSION["usertype"]=='admin'){
		header('location:report.php');
	}
}
?>
<?php
$studentid=$studentname=$msg="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$userid=$_POST["userid"];
	$password=$_POST["password"];
	if($userid!=""){
		$sql="select *from student where studentid='$userid'";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0){
			$row=mysqli_fetch_assoc($res);
			if($row["password"]!=$password){
				$msg="wrong password";
			}else{
				$_SESSION["userid"]=$studentid;
				$_SESSION["usertype"]='student';
				header('location:testaccept.php');
			}
		}
		else{
			$sql="select *from admins where adminid='$userid'";
			$res=mysqli_query($conn,$sql);
			if(mysqli_num_rows($res)>0){
				$row=mysqli_fetch_assoc($res);
				if($row["password"]!=$password){
					$msg="wrong password";
				}else{
					$_SESSION["userid"]=$userid;
					$_SESSION["usertype"]=$row["usertype"];
					header('location:admin.php');
				}
			}

		}

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
		<form class="ui form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
		
		<h1>Login</h1><br>
		<input type="text" name="userid" placeholder="userid"><br><br>
		<input type="password" name="password"  placeholder="password"><br><br>
		<input type="submit" value="Login" class="ui blue button">
		<h4 style="color: red"><?php echo $msg;  ?></h4>
		</form>
	</div></center>

</body>
</html>