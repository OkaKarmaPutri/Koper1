<?php  
	session_start();

	session_unset('koper');
	header("location: ../index.php");
?>