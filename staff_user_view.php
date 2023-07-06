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
      <h1>User List</h1>
      <table border=1>
        <tr>
          <th width="10%">No</th>
          <th>IC No.</th>
          <th>Name</th>
          <th>Status</th>
          <th colspan="2">Action</th>
          
        </tr>
        
<?php
session_start();

//connect to database
require_once('connection.php');

$data = mysqli_query($conn, "SELECT * FROM user");


$no=1;
while($row=mysqli_fetch_array($data)){


?>
  <tr>
    <td align="center"><?php echo $no++; ?></td>
    <td><?php echo $row['UserID']; ?></td>
    <td><?php echo $row['Name']; ?></td>
    <td><?php echo $row['Status']; ?></td>

    <td align="center"><a href="staff_user_update.php?UserID=<?php echo $row['UserID'];?>">Update</a>
    <td align="center"><a href="staff_user_delete.php?UserID=<?php echo $row['UserID'];?>" onclick="return checkdelete()">Delete</a></td>
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
    		return confirm('Are you sure you want to delete this record? (Record will also be deleted from doctor/staff table)');
  			}

	</script>
  </body>
</html>
