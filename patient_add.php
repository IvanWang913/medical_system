<?php
session_start();


//connect to database
require_once('connection.php');
//check ICNo
if(isset($_POST['ICNo'])){
	//declare variables
	$ICNo =$_POST['ICNo'];
	$Name =$_POST['Name'];
	$PhoneNo =$_POST['PhoneNo'];
	$Email =$_POST['Email'];
    $Date = date('Y-m-d', strtotime($_POST['Date']));
    $Time =$_POST['Time'];
	$doctor=$_POST['DoctorName'];
	$username =$_SESSION['uname'];

	//add records to query
	$query= "INSERT INTO appointment (ICNo, Name, PhoneNo, Email, Date, Time, DoctorName, UserID) VALUES('$ICNo', '$Name', '$PhoneNo','$Email','$Date','$Time', '$doctor' '$username')";
	$result= mysqli_query($conn, $query);

	$query2 = "INSERT INTO patient (ICNo, Name, Email, PhoneNo) VALUES ('$icno', '$name', '$email', '$phoneno')";
	$result = mysqli_query($conn, $query2);

	if($result){
		echo "<script>alert('Appointment booked successfully');
			window.location='patient_home.php'</script>";
	}else{
		echo "<script>alert('Failed to book appointment! Please try again!);
			window.location='patient_add.php'</script>";
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
<?php include('patient_header.php') ?>
</div>


<!-- navbar element -->
<div id="nav">
<?php include('patient_menu.php') ?>
    </div>

		<div id="main">
		<center>
				<h1>Make An Appointment</h1>
				<div id="appointment">
					<form action="patient_add.php" method="POST">
						<table width="90%" border ="0" cellpadding="10" cellspacing="20">
							<tr>
								<td>IC Number :</td>
								<td><input type="text" name="ICNo" pattern="[0-9]{12}" oninvalid="this.setCustomValidity('Enter only 12 digits!')" oninput="this.setCustomValidity()" placeholder="e.g. 030109020409 (without -)" size="25" required></td>
							</tr>

							<tr>
								<td>Patient's Name :</td>
								<td><input type="text" name="Name" placeholder="e.g. Ivan Wang" size="25" required></td>
							</tr>

							<tr>
								<td>Phone Number :</td>
								<td><input type="text" name="PhoneNo" placeholder="e.g. 01172869409" size="25" required></td>
							</tr>
							
							<tr>
								<td>Email Address:</td>
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
				<td colspan="2" align="center"><input type="submit" name="Submit" value="Make An Appointment"></td>
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