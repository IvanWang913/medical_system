<?php
session_start();
//connect to database
require_once('connection.php');

if(isset($_POST['signup_btn']))
{
	//Declare variables
	$userid = $_POST['uname'];
    $password = $_POST['pwd'];
	$cpassword = $_POST['cpwd'];
	$name = $_POST['name'];
	$status = $_POST['status'];

	//verify password and cpassword
	if($password == $cpassword)
	{
		$query = "select * from user WHERE UserID ='$userid'";
		$count = mysqli_query($conn, $query);

		if(mysqli_num_rows($count)>0)
		{
			echo "User ID already exists...Please choose another User ID";
		}

		else{
			$query = "insert into user VALUES('$userid','$password','$name','$status')";
			$result = mysqli_query($conn, $query);

			if($result){
				echo "<script>alert('Congrats $userid! You have successfully signed up!')</script>";
				header('Refresh: 0; url=login.php');
			}else{
				echo "<script>alert('Failed to sign up! Please try again!')</script>";
				header('Refresh: 0; url=signup.php');
			}
		}
	}

	else{
	echo "<script>alert('Confirm password is different than password')</script>";
}
}
mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<!-- Intro -->
<div id="intro">
<?php include('header.php') ?>
</div>

<!-- navbar element -->
<div id="nav">
<?php include('menu.php') ?>
</div>

<!-- main element -->
		<div id="main">
			<center>
				<h1>Sign Up</h1>
				<div id="signup">
					<form action="signup.php" method="POST">
						<table width="90%" border ="0" cellpadding="10" cellspacing="20">
			<tr>
				<td align="right">User ID :</td>
				<td><input type="text" name="uname" required></td>
			</tr>

			<tr>
				<td align="right">Password :</td>
				<td><input type="password" name="pwd" required></td>
			</tr>

            <tr>
				<td align="right">Confirm Password :</td>
				<td><input type="password" name="cpwd" required></td>
			</tr>

            <td align="right">Name :</td>
				<td><input type="text" name="name" required></td>
			</tr>
			
			<tr>
				<td align="right">Status :</td>
				<td>
					<select name="status" style="width:100px; height:30px">
						<option selected value="User" name="status">User</option>
					</select>
				</td>
			</tr>


			<tr>
				<td colspan="2" align="center"><input type="submit" name="signup_btn" value="Sign Up"></td>
			</tr>

      <tr>
        <td colspan="2" align="center"><a href="login.php">Already have an account? Login here</a></td>
      </tr>

						</table>
					</form>
					
				</div>
			</center>

		</div>

<!-- footer element -->
<footer>
<?php include('footer.php') ?>
</footer>

</body>
</html>