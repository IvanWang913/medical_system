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
    <?php include('staff_header.php'); ?>
</div>


<!-- navbar element -->
<div id="nav">
<?php include('staff_menu.php'); ?>
</div>

<div id="main">
<center>
<h1>Search Appointment Record</h1>
    <div id ="search">
    <form action="#" method="get">
        Enter Patient IC No. : <input type="text" name="ICNo">
        <input type="submit" value="Display" name="display">
</form>
<?php
  session_start();
  require_once('connection.php');
    
  if (isset($_GET['display'])) {
        $icno = $_GET['ICNo'];
        $query = "SELECT * FROM appointment WHERE ICNo='$icno'";

        $results = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($results);
        $count = mysqli_num_rows($results);
        if ($count == 1) {
        
    
  ?>
        <table border = 1>
            <tr>
                <td>IC No.</td>
                <td> <?php echo $row['ICNo']; ?> </td>
            </tr>
            <tr>
                <td>Name</td>
                <td> <?php echo $row['Name']; ?> </td>
            </tr>
            <tr>
                <td>Phone No.</td>
                <td> <?php echo $row['PhoneNo']; ?> </td>
            </tr>
            <tr>
                <td>Email</td>
                <td> <?php echo $row['Email']; ?> </td>
            </tr>
            <tr>
                <td>Date</td>
                <td> <?php echo $row['Date']; ?> </td>
            </tr>
            <tr>
                <td>Time</td>
                <td> <?php echo $row['Time']; ?> </td>
            </tr>
        </table>
        <?php
        } else{
            echo 'No record found!';
        }
    }
    mysqli_close($conn);
    ?>
    </center>
    </div>

</div>

<!-- footer element -->
<footer>
    <?php include('footer.php'); ?>
</footer>
  </body>
</html>
