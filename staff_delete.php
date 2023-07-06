<?php
session_start();

//connect to database
require_once('connection.php');

//query to delete a record
$ICNo = $_GET['ICNo'];
$sql = "DELETE FROM appointment WHERE ICNo='$ICNo'";
$result = mysqli_query($conn, $sql);

$sql1 = "DELETE FROM patient WHERE ICNo='$ICNo'";
$result = mysqli_query($conn, $sql1);


if(($result) === TRUE) {
	echo "<script>alert('Record deleted successfully!')</script>";
	header('Refresh: 0; url=staff_view.php');
}else{
	echo "<script>alert('Failed to delete record! Please try again!')</script>";
}


?>