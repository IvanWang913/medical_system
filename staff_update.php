<?php
session_start();

//connect to database
require_once('connection.php');

if(isset($_POST['update'])){
	$ICNo =$_POST['ICNo'];
	$Name =$_POST['Name'];
	$PhoneNo =$_POST['PhoneNo'];
	$Email =$_POST['Email'];
    $Date = date('Y-m-d', strtotime($_POST['Date']));
    $Time =$_POST['Time'];

    $query = "UPDATE appointment SET Name= '$Name', PhoneNo = '$PhoneNo', Email = '$Email', Date = '$Date', Time = '$Time' WHERE ICNo='$ICNo'";
    $result = mysqli_query($conn, $query);

        if($result){
            echo "<script>alert('Record updated successfully!')</script>";
            header('Refresh: 0; url=staff_view.php');
        }else{
            echo "<script>alert('Failed to update record! Please try again!')</script>";

        }

    //do update process

}else{
    //do show data to form
    $ICNo = $_GET['ICNo'];
}
    $sql = "SELECT * FROM appointment WHERE ICNo = '$ICNo'";
    $data = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($data);

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
	<div id="appointment">
	<center>
	<h1>Update Appointment Record</h1>
		<form action="staff_update.php" method="POST">
		<!--appointment record table-->
			<table width="90%" border ="0" cellpadding="10" cellspacing="20">
				<tr>
				<td>Patient's IC No. :</td>
				<td><input readonly type="text" name="ICNo" value="<?php echo $ICNo;?>"> </td>
				</tr>
				<tr>
					<td>Patient's Name :</td>
					<td><input type="text" name="Name" value="<?php echo $row['Name']; ?>"> </td>
				</tr>

				<tr>
					<td>Phone Number:</td>
					<td><input type="text" name="PhoneNo" value="<?php echo $row['PhoneNo']; ?>"> </td>
				</tr>

				<tr>
					<td>Email :</td>
					<td><input type="text" name="Email" value="<?php echo $row['Email']; ?>"> </td>
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
	<td colspan="2" align="center"><input type="submit" name="update" value="Update"></td>
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
<script>
			function resizeText(multiplier){
			if(document.body.style.fontSize == ""){
				document.body.style.fontSize = "1.0em";

			}
			document.body.style.fontSize = parseFloat(document.body.style.fontSize) + (multiplier * 0.1) + "em";

		}

			function checkdelete()
  			{
    		return confirm('Are you sure you want to clear this record?');
  			}

	</script>
  </body>
</html>