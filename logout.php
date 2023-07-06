<?php
session_start();

//destroy all login sessions
if(session_destroy()){

	//go back to index.php
	header("Location: index.php");
}
?>
