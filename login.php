<?php
session_start();
//connect to database
require_once('connection.php');

      if(isset($_POST['login_btn'])) {

          $userid = $_POST['uname'];
          $password = $_POST['pwd'];
          $status = $_POST['status'];
//verify data from database
          $query = mysqli_query($conn, "SELECT * FROM user WHERE UserID='$userid' AND Password='$password'");
//username and password do not exist in database
            if(mysqli_num_rows($query) == 0) {
              echo "<script>alert('Wrong User ID or password! Please try again!')</script>";
//username and password exist in database
              }else{
                $row = mysqli_fetch_assoc($query);
                $_SESSION['uname'] = $row['UserID'];
                $_SESSION['status'] = $row['Status'];
                $_SESSION['name']= $row['Name'];
//popup
                if($row['Status'] == "User" AND $status =="User") {
                  echo "<script>alert('Welcome $userid! You have logged in as $status')</script>";
                  header('Refresh: 0; url=patient_home.php?username='. $userid);

                }else if($row['Status'] == "Doctor" AND $status =="Doctor") {
                  echo "<script>alert('Welcome $userid! You have logged in as $status')</script>";
                header('Refresh: 0; url=doctor_home.php?username='. $userid);                


                }else if($row['Status'] == "Staff" AND $status =="Staff") {
                    echo "<script>alert('Welcome $userid! You have logged in as $status')</script>";
                  header('Refresh: 0; url=staff_home.php?username='. $userid);
                  

           }else{
             echo "<script>alert('Failed to login! Please try again!')</script>";
           }
         }
      }
  ?>



<!DOCTYPE html>
<html>
<head>
	<title>Make Appointment</title>
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

  <div id="main">
    <center>
      <h1>Login</h1>
      <div id="login">
        <form action="login.php" method="POST">
          <table width="90%" border ="0" cellpadding="10" cellspacing="20">
      <tr>
				<td align="right">User ID (IC No): </td>
				<td><input type="text" name="uname" required></td>
			</tr>

			<tr>
				<td align="right">Password :</td>
				<td><input type="password" name="pwd" required></td>
			</tr>
			
			<tr>
				<td align="right">Status :</td>
				<td>
					<select name="status" style="width:100px; height:30px">
						<option hidden selected>--Please choose--</option>
						<option value="User" name="status">User</option>
            <option value="Doctor" name="status">Doctor</option>
						<option value="Staff" name="status">Staff</option>
					</select>
				</td>
			</tr>

			<tr>
				<td colspan="2" align="center"><input type="submit" name="login_btn" value="Login"></td>
			</tr>

      <tr>
        <td colspan="2" align="center"><a href="signup.php">Haven't got an account? Sign up here</a></td>
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