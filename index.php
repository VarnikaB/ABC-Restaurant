<?php
	$conn = mysqli_connect("localhost", "root","","abcrest" );
	if(mysqli_connect_errno())
	{
		echo "Failed to connect" . mysqli_connect_error;
		exit();
		
	}
?>
<center>
<div class="container" style="color: coral;padding:5px;margin: 20px; align-content:center;">
	<?php
	session_start();
	if(isset($_POST['submit']))
	{
		if(isset($_POST['name']) && isset($_POST['pwd']))
		{
			$n = $_POST['name'];
			$val = mysqli_query($conn, "SELECT * FROM logins");
			$id = "SELECT ID FROM LOGINS WHERE Name = '$n' ";
			$result = $conn->query($id);
			
			if(mysqli_num_rows($result) != 0)
			{
				$p = $_POST['pwd'];
				$pwd = "SELECT Password FROM LOGINS WHERE Name = '$n' ";
				$id = $result->fetch_row()[0];	
				$result = $conn->query($pwd);
				$pwd = $result->fetch_row()[0];				
				if($p == $pwd)
				{
					$_SESSION['name'] = $n;
					$_SESSION['id'] = $id;
					header("Location: home.php");
				}
				else
				{
					echo "Incorrect Password";
				}
			}
			else
			{
				echo "Incorrect Username";
			}
			
		}
	}
	?>
	
	
</div>
</center>

<!DOCTYPE html>
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
	   <title> Login | ABC Restaurant </title>
		
        <style>
        body{
            background-color: antiquewhite;
            color: #30004f;
			font-family: 'Roboto Slab', serif;
        }
        .shadow {
            -moz-box-shadow:    3px 3px 5px 6px #ccc;
            -webkit-box-shadow: 3px 3px 5px 6px #ccc;
            box-shadow:         3px 3px 5px 6px #ccc;
        }
        form{
           margin-top: 25vh;
        }
        input{
            text-align: center;
        }
        </style>
    </head>
    <body>
		<h2 style="font-weight:500;"><center><strong>ABC RESTAURANT</strong></center></h2>
        <div class="container" align="center">

            <form method="post" action="index.php">
            
				<div style="border: 1px solid whitesmoke;" class="shadow-lg p-3 mb-5 bg-white rounded">
					<h3><center><strong>Login</strong></center></h3>
					<div class="form-group"><center>
						<label for="logid">Login ID:</label>
						<input type="text" class="form-control col-lg-4" placeholder="Name" id="name" name="name">
						</center>

					</div>
					<div class="form-group"><center>
						<label for="pwd">Password:</label>
						<input type="password" class="form-control col-lg-4" placeholder="Password" id="pwd" name="pwd">
						</center>
					</div>
					<strong><input type="submit" class="btn btn-dark text-white" name="submit" value="Submit"> </strong>
					
				</div>
			</form>
			
		</div>
    </body>
</html>
