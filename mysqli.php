<?php
	$conn = mysqli_connect("localhost", "root","","abcrest" );
	if(mysqli_connect_errno())
	{
		echo "Failed to connect" . mysqli_connect_error;
		exit();
		
	}
	if(!isset($_SESSION['name']))
	{
		session_destroy();
		header("Location: index.php");
	}
?>