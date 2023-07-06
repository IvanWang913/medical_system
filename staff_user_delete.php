<?php
session_start();

//connect to database
require_once('connection.php');

//query to delete a record
$userid = $_GET['UserID'];
$status = $_GET['Status'];

$sql = "DELETE FROM user WHERE UserID='$userid'";
$result = mysqli_query($conn, $sql);



if(($result) === TRUE) {
	echo "<script>alert('Record deleted successfully!')</script>";
	header('Refresh: 0; url=staff_user_view.php');
}else{
	echo "<script>alert('Failed to delete record! Please try again!')</script>";
}


?>