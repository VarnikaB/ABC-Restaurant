<?php
session_start();
	require_once "mysqli.php";
	if(isset($_POST['lout']))
	{
		session_destroy();
		header("Location: index.php");
	}
	
?>

<html lang="en">
    <head>    
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
		<!-- Styles -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <title>Home | ABC Restaurant</title>
        
    </head>
	<style>
		body{
            background-color: antiquewhite;
            color: #30004f;
			font-family: 'Roboto Slab', serif;
        }
	</style>
    <body style="background-color: #030320e8; background-size: cover; color:ghostwhite;">
		
        <nav class="navbar-dark" style="padding:2em;">
			<form method="post">
            <input value="Logout" class="btn btn-danger" style="color: aliceblue;float: right;" type="submit" name="lout">
			</form>
        </nav>
        <div class="container" align="center" style="padding-top: 3em;">
            <h1 style="color:antiquewhite;font-size:4em;"><strong><center>ABC Restaurant</center></strong></h1>
            <h4><em>Welcome  <?php echo $_SESSION['name']?></em></h4>
            <div class="container" style="padding-top: 2em;">
				
				<a href="add.php"><button type="button" class="btn btn-warning col-lg-4 col-md-4 col-sm-10">ADD ORDER</button></a>
				<a href="report.php"><button type="button" class="btn btn-danger col-lg-4 col-md-4 col-sm-10">VIEW REPORT</button></a>
            </div>
        </div>
    </body>
</html>
