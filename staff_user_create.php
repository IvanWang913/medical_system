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
	$phoneno =$_POST['phoneno'];
	$email =$_POST['email'];

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
			if($status=="Doctor"){
				$query = "insert into user VALUES('$userid','$password','$name','$status')";
				$result = mysqli_query($conn, $query);

				$query1 = "insert into doctor VALUES('$userid','$name','$phoneno','$email')";
				$result = mysqli_query($conn, $query1);

			}else if($status=="Staff"){
				$query = "insert into user VALUES('$userid','$password','$name','$status')";
				$result = mysqli_query($conn, $query);
				
				$query2 = "insert into staff VALUES('$userid','$name','$phoneno','$email')";
				$result = mysqli_query($conn, $query2);
			}else{
				$query = "insert into user VALUES('$userid','$password','$name','$status')";
				$result = mysqli_query($conn, $query);
			}
			

			if($result){
				echo "<script>alert('Congrats $userid! You have successfully signed up!')</script>";
				header('Refresh: 0; url=staff_user_view.php');
			}else{
				echo "<script>alert('Failed to sign up! Please try again!')</script>";
				header('Refresh: 0; url=staff_user_create.php');
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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>The Elderly Home's Club</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="img/logo1.jpg">
    <script>
			function printContent(el){
				var restorepage = document.body.innerHTML;
				var printContent = document.getElementById(el).innerHTML;
				document.body.innerHTML = printContent;
				window.print();
				document.body.innerHTML = restorepage;
			}
		</script>
  </head>

  <body>




<!-- Intro -->
<div id="intro">
    <?php include('staff_header.php');?>
</div>


<!-- navbar element -->
<div id="nav">
    <?php include('staff_menu.php');?>
</div>
				
<div id="main">
			<center>
				<h1>Create User</h1>
				<div id="signup">
					<form action="staff_user_create.php" method="POST">
						<table width="90%" border ="0" cellpadding="10" cellspacing="20">
			<tr>
				<td align="right">User ID (IC Number) :</td>
				<td><input type="text" name="uname" pattern="[0-9]{12}" oninvalid="this.setCustomValidity('Enter only 12 digits!')" oninput="this.setCustomValidity()" placeholder="e.g. 030109020409 (without -)" size="25" required></td>

			<tr>
				<td align="right">Password :</td>
				<td><input type="password" name="pwd" required></td>
			</tr>

            <tr>
				<td align="right">Confirm Password :</td>
				<td><input type="password" name="cpwd" required></td>
			</tr>

			<tr>
				<td align="right">Name :</td>
				<td><input type="text" name="name" placeholder="e.g. Ivan Wang" size="25" required></td>
			</tr>

			<tr>
				<td align="right">Phone Number :</td>
				<td><input type="text" name="phoneno" placeholder="e.g. 01172869409" size="25" required></td>
			</tr>
			
			<tr>
				<td align="right">Email Address:</td>
				<td><input type="text" name="email" placeholder="e.g. ivanwang913@gmail.com" size="25" required></td>
			</tr>
			
			
			<tr>
				<td align="right">Status :</td>
				<td>
					<select name="status" style="width:100px; height:30px">
                        <option hidden selected>--Select status--</option>
						<option value="User" name="user">User</option>
                        <option value="Doctor" name="doctor">Doctor</option>
                        <option value="Staff" name="staff">Staff</option>
					</select>
				</td>
			</tr>


			<tr>
				<td colspan="2" align="center"><input type="submit" name="signup_btn" value="Sign Up"></td>
			</tr>


						</table>
					</form>
					
				</div>
			</center>

		</div>

<!-- footer element -->
<footer>
 <?php include('footer.php'); ?>
</footer>
<script>
			function resizeText(multiplier){
			if(document.body.style.fontSize == ""){
				document.body.style.fontSize = "1.0em";

			}
			document.body.style.fontSize = parseFloat(document.body.style.fontSize) + (multiplier * 0.1) + "em";

		}

			function checkdelete()
  			{
    		return confirm('Are you sure you want to delete this record?');
  			}

	</script>
  </body>
</html>
