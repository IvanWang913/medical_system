<?php
session_start();

//connect to database
require_once('connection.php');

?>

<html>
<body>
<head>
    <title>Import</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div id="intro">
    <?php include('staff_header.php');?>
</div>

<div id="nav">
    <?php include('staff_menu.php');?>
</div>

<div id="main">
<center>
    <h1>Import Appointment Record</h1>

    <form id='appointment' enctype='multipart/form-data' action='' method='post'>
    <table>
        <tr>
        <td align='right'>File to import (*.csv) : </td>
        <td>
            <input type='file' name='filename' required>
        </td>
        </tr>

        <tr>
            <td colspan='2' align='center'>
            <input type='submit' name='submit' value='Import'>
            </td>
        </tr>
        </table>
    </form>
</center>
</div>

<footer>
    <?php include('footer.php');?>
</footer>


</body>
</html>

<?php    
//File Upload
  if (isset($_POST['submit'])) 
  {
             
  //Import the uploaded file to the database
    $handle = fopen($_FILES['filename']['tmp_name'], "r");

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    {
    $sql = mysqli_query($conn,"INSERT INTO 
    appointment (ICNo, Name, PhoneNo, Email, Date, Time, DoctorName) 
    VALUES('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]');");
            
    $result = mysqli_query($conn, $sql);
    }
    fclose($handle);

    echo "<script>alert('Record Imported Successfully');
          window.location='staff_view.php'</script>";
  }
  mysqli_close($conn);
?>


