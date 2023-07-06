<?php
session_start();


//connect to database
require_once('connection.php');
//check ICNo
if(isset($_POST['ICNo'])){
	//declaring variables
	$icno =$_POST['ICNo'];
	$name =$_POST['Name'];
	$phoneno =$_POST['PhoneNo'];
	$email =$_POST['Email'];
    $date =$_POST['Date'];
    $time =$_POST['Time'];
	$doctor=$_POST['DoctorName'];

	//insert record to query
	$query= "INSERT INTO appointment (ICNo, Name, PhoneNo, Email, Date, Time, DoctorName) VALUES('$icno', '$name', '$email', '$phoneno', '$date', '$time', '$doctor')";
	$result= mysqli_query($conn, $query);

	$query2 = "INSERT INTO patient (ICNo, Name, Email, PhoneNo) VALUES ('$icno', '$name', '$email', '$phoneno')";
	$result = mysqli_query($conn, $query2);

	if($result){
		echo "<script>alert('Successfully added new record');
			window.location='doctor_view.php'</script>";
	}else{
		echo "<script>alert('Failed to add record! Please try again!);
			window.location='doctor_add.php'</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>The Elderly Home's Club</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="img/logo1.jpg">
  </head>

  <body>




<!-- Intro -->
<div id="intro">
    <?php include('doctor_header.php');?>
</div>


<!-- navbar element -->
<div id="nav">
    <?php include('doctor_menu.php');?>
</div>
				
<div id="main">
<center>
<h1>Add Appointment Record</h1>
	<div id="appointment">

		<form action="doctor_add.php" method="POST">
		<!--appointment record table-->
			<table width="90%" border ="0" cellpadding="10" cellspacing="20">
				<tr>
					<td>Patient's IC No. :</td>
					<td><input type="text" name="ICNo" pattern="[0-9]{12}" oninvalid="this.setCustomValidity('Please enter 12 digits only!')" oninput="this.setCustomValidity()" placeholder="e.g. 030109020409" size="25" required></td>
				</tr>

				<tr>
					<td>Patient's Name :</td>
					<td><input type="text" name="Name" placeholder="e.g. Ivan Wang" size="25" required></td>
				</tr>

				<tr>
					<td>Phone Number:</td>
					<td><input type="text" name="PhoneNo" placeholder="e.g. 0123456789" size="25" required></td>
				</tr>

				<tr>
					<td>Email :</td>
					<td><input type="text" name="Email" placeholder="e.g. ivanwang913@gmail.com" size="25" required></td>
				</tr>

	<tr>
					<td><label for="date">Date of Appointment:</label></td>
					<td><<input type="date" id="date" name="date"></td>
				</tr>

	<tr>
					<td><label for="time">Select a time:</label></td>
					<td><<input type="time" id="time" name="time"></td>
				</tr>

				<tr>
					<td>Preferred Doctor :</td>
					<td>
					<select name=DoctorName>
						<?php 
						$dataDoc=mysqli_query($conn, "SELECT * FROM doctor");
						while($infoDoc=mysqli_fetch_array($dataDoc))
						{
							echo "<option hidden selected>--Choose Doctor-- </option>";
							echo "<option value='$infoDoc[DoctorName]'>$infoDoc[DoctorName]</option>";
						}
						?>
					</select>
					</td>
				</tr>



				<tr>
	<td colspan="2" align="center"><input type="submit" name="add" value="Add"></td>
</tr>
			</table>
		</form>
		</center>
	</div>
</div>

<!-- footer element -->
<footer>
 <?php include('footer.php'); ?>
</footer>

  </body>
</html>
