<div style="color:ghostwhite">
<?php 
		session_start();
		require_once "mysqli.php";
		if(isset($_POST['lout']))
	{
		session_destroy();
		header("Location: index.php");
	}
	if(isset($_POST['cancel']))
	{
		header("Location: home.php");
	}
		if(isset($_POST['lout']))
			{
				session_destroy();
				header("Location: index.php");
			}
			if(isset($_POST['date']) && isset($_POST['item']) && isset($_POST['qty']))
			{
				$id = $_SESSION['id'];
				$date = $_POST['date'];
				$item = $_POST['item'];
				$qty = $_POST['qty'];
				$result = $conn->query("SELECT no FROM ITEMS WHERE ITEM='$item'");
				$item = $result->fetch_row()[0];
				$result = $conn->query("SELECT Rate FROM ITEMS WHERE no='$item'");
				$rate = $result->fetch_row()[0];
				$total = $qty * $rate;
				 $_SESSION['total'] = $total;
				$query = "INSERT INTO reports VALUES ('$id','$date','$item','$qty','$total')";
				$result = $conn->query($query);
				if($result == true)
					echo "<center>Order added successfully</center>";
			}
		
?>
</div>
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
        <title>Add | ABC Restaurant</title>
        
        <style>
			body{
            background-color: antiquewhite;
            color: #30004f;
			font-family: 'Roboto Slab', serif;
        }
        h1{
            color: #030320e8;
            font-size: 4em;
        }
        form{
           margin-top: 5vh;
        }
        </style>
    </head>
    <body style=" background-color: #030320e8; background-size: cover; color: #030320e8; font-size: 25px;">
		<h2 style="font-weight:500; color:antiquewhite;padding-top:1em;"><center><strong>ABC RESTAURANT</strong></center></h2>
        <nav class="navbar-dark" style="padding:1em;">
            <form method="post">
            <input value="Logout" class="btn btn-danger" style="color: aliceblue;float: right;" type="submit" name="lout">
			</form>
        </nav>
        <div class="container" align="center">
            <form method="post">
				<div class="shadow-lg p-3 mb-5 bg-white rounded" style="padding-top: 4em;">
					<h1><strong><center>Add Order</center></strong></h1>
					<div class="form-group" style="text-align: center;">
						<div class="row">
							<div class="col-lg-4">
								<strong class="" style="text-align: left;">Date:</strong><center>
								<input type="date" class="form-control col-lg-6" id="date" name="date" style="text-align: center;" value="<?php echo date("Y-m-d") ?>"></center> 
							</div>
							<div class="col-lg-4">
								<strong class="" style="text-align: left;">Item:</strong><center>
								<select class="form-control col-lg-6" name="item" id="item" style="text-align: center;">
									<option>Tea</option>
									<option>Coffee</option>
									<option>Samosa</option>
									<option>Cake</option>
								</select>   </center>
							</div> 
							<div class="col-lg-4">
								<strong style="text-align: left;">Quantity</strong>
								<center><input type="number" class="form-control col-lg-4" id="qty" name="qty" style="text-align: center;" ></center> 
							</div> 
						</div>
					</div>
					<h4><strong>Total Amount: <em>&#8377;<?php echo isset($_SESSION['total']) ? $_SESSION['total'] : 0;  ?></em></strong></h4>
					<a href="home.php"><strong><button type="submit" class="btn btn-danger text-white" name="cancel" value="Cancel">Cancel</button> </strong></a>
					<strong><input type="submit" class="btn btn-dark text-white" name="submit" value="Submit"> </strong>
				</div>
			</form>            
        </div>
    </body>
</html>