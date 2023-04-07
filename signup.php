<?php 
//session_start();

?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

	<title>User Sign Up Page</title>

	<!-- <div style="text-align: center; margin-top: 2%; font-size: 40px; ">

		Sign Up Page

	</div> -->

</head>
<body >
	<!-- <img src="signup.jpg"> -->
<div class="container" >
<div class="row">
	<div class="col-md-3"></div>

	<div class="col-md-6" style="text-align: center; padding-top: 6%; font-size: 25px;  ">

		<h3>User Sign Up Page</h3>


<?php 
include 'database.php';

if(isset($_POST['btn'])){

	$name=$_POST['name'];
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	$pass2=$_POST['pass2'];
	$num = 8;

$uppercase = preg_match('@[A-Z]@', $pass);
$lowercase = preg_match('@[a-z]@', $pass);
$number    = preg_match('@[0-9]@', $pass);
$specialChars = preg_match('@[^\w]@', $pass);


	$_SESSION['username']=$name;


	//$conn = mysqli_connect('localhost','root','','todos');
	$sql = "SELECT * FROM user WHERE username='$name' ";
	$result=mysqli_query($conn,$sql);


	$sql2 = "SELECT * FROM user WHERE email='$email' ";
	$result2=mysqli_query($conn,$sql2);



if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
?> <h4 style="color: white; background-color: #dc3545;">
    Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character. </h4> <?php
}

		else if($pass != $pass2 ){

			?>
			<div class=" alert alert-danger" style="text-align: center; font-size: 15px; width:100%;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong> Password don't match </strong>

			</div> 
		<?php 
		}


		else if( mysqli_num_rows($result)>0 ){

			?>
			<div class=" alert alert-danger" style="text-align: center; font-size: 15px; width:100%;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong> Username exists! </strong>

			</div> 
		<?php 
		}

		else if( mysqli_num_rows($result2)>0 ){

			?>
			<div class=" alert alert-danger" style="text-align: center; font-size: 15px; width:100%;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong> Email already used! </strong>

			</div> 
		<?php 
		}

		

		else {
			$sql="INSERT INTO user(username,email,pass)VALUES('$name','$email','$pass')";
			//$sql= "INSERT INTO user SET username='$name', email='$email', password='$pass' ";
			$result = mysqli_query($conn,$sql);
		if($result){
			?>
			<div class=" alert alert-success" style="text-align: center; font-size: 15px; width:100%;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Sign Up Successful</strong>

			</div> 
		<?php }

			header( "refresh:2; URL = ./login.php" );
			//header("Location:./login.php");
		}
	}

?>


		<form action="" method="POST" style="text-align: center; margin-bottom: 60px; margin-top: 20px; display: inline; " >

			<input style="width:100%; height: 45px; font-size: 22px; margin-bottom: 20px; " type="text" name="name" required placeholder =" Enter your username"> <br>

			<input style="width:100%; height: 45px; font-size: 22px; margin-bottom: 20px; " type="text" name="email" required placeholder =" Enter your Email"> <br>

			<input style="width:100%; height: 45px; font-size: 22px; margin-bottom: 20px; " type="password" name="pass" required placeholder =" Enter a password"> <br>

			<input style="width:100%; height: 45px; font-size: 22px; margin-bottom: 20px; " type="password" name="pass2" required placeholder ="Confirm password"> <br>

			<button class="btn btn-success" type="submit" name="btn" style="width:49%; height: 45px; font-size: 22px; ">
				Sign UP
			</button>

		</form>

		<form action="login.php" method="POST" style="text-align: center; display: inline;">

				<button class="btn btn-warning" type="submit" name="signup" style="width:49%; height: 45px; font-size: 22px; ">
						Login
				</button>

		</form>



	</div>
	<div class="col-md-3"></div>
</div>
</div>

</body>
</html>

