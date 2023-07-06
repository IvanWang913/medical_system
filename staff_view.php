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
<?php include('staff_menu.php'); ?>
    </div>
				
			<div id="main">
				<p align="right">
					<button onclick="resizeText(-1)">Zoom Out</button>
					<button onclick="resizeText(1)">Zoom In</button>
				</p>
				
				<center>
      <h1>Appointment Record</h1>
      <table border=1>
        <tr>
          <th width="10%">No</th>
          <th>IC No.</th>
          <th>Name</th>
          <th>Phone No</th>
          <th>Email</th>
          <th>Date</th>
          <th>Time</th>
          <th colspan="2">Action</th>
          
        </tr>
        
<?php
session_start();

//connect to database
require_once('connection.php');

$data = mysqli_query($conn, "SELECT * FROM appointment");


$no=1;
while($row=mysqli_fetch_array($data)){


?>
  <tr>
    <td align="center"><?php echo $no++; ?></td>
    <td><?php echo $row['ICNo']; ?></td>
    <td><?php echo $row['Name']; ?></td>
    <td><?php echo $row['PhoneNo']; ?></td>
    <td><?php echo $row['Email']; ?></td>
    <td><?php echo $row['Date']; ?></td>
    <td><?php echo $row['Time']; ?></td>
    <td align="center"><a href="staff_update.php?ICNo=<?php echo $row['ICNo'];?>">Update</a>
    <td align="center"><a href="staff_delete.php?ICNo=<?php echo $row['ICNo'];?>"onclick="return checkdelete()">Delete</a></td>
  </tr>
<?php 
}
?>


    </table>
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
    		return confirm('Are you sure you want to delete this record? (Record will also be deleted from patient list)');
  			}

	</script>
  </body>
</html>
