<?php 
session_start();
	require_once "mysqli.php";
	if(isset($_POST['lout']))
	{
		session_destroy();
		header("Location: index.php");
	}
	$id = $_SESSION['id'];
	if($stmt = $conn->query("SELECT date,SUM(total) FROM reports where ID='$id' group by date order by date;")){

		  //echo "No of records : ".$stmt->num_rows."<br>";
		$php_data_array = Array(); // create PHP array
		  
		while ($row = $stmt->fetch_row()) {
		   
		   $php_data_array[] = $row; 
		   }
		
		}else{
		echo $connection->error;
		}
		echo "<script>
				var my_2d = ".json_encode($php_data_array)."
		</script>";
?>
<html lang="en">
    <head>    
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
		<!-- Styles -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <title>Report | ABC Restaurant</title>
        
    </head>
	<style>
	body{
            background-color: antiquewhite;
            color: #30004f;
			font-family: 'Roboto Slab', serif;
        }
	</style>
    <body style=" background-color: #030320e8; background-size: cover; color: floralwhite; font-size: 25px;">
		<h2 style="font-weight:500;padding-top:1em;"><center><strong>ABC RESTAURANT</strong></center></h2>
        <form method="post" style="padding:1em;">
            <input value="Logout" class="btn btn-danger" style="color: aliceblue;float: right;" type="submit" name="lout">
			</form>
        <div class="container" style="padding-top: 1em;">
            <h1 style="color: antiquewhite; font-size: 1em;"><center>Reports</center></h1>
        </div>
		<div class="align-middle mx-auto mt-auto mb-auto" style="padding-top: 1em;">
			<center>
			<button type="button" class="btn btn-warning col-lg-3 col-md-4 col-sm-10" data-toggle="modal" data-target="#line_div">Line graph</button>
			<button type="button" class="btn btn-danger col-lg-3 col-md-4 col-sm-10" data-toggle="modal" data-target="#bar_div">Bar graph</button>
			<button type="button" class="btn btn-info col-lg-3 col-md-4 col-sm-10" data-toggle="modal" data-target="#pie_div">Pie chart</button>
			</center>
		</div>
		<br>
		<center><a href="home.php"><button type="button" class="btn btn-basic col-lg-3 col-md-4 col-sm-10" data-toggle="modal" data-target="#pie_div">Back</button></a></center>
			
		<div class="modal fade" id="line_div" tabindex="-1" role="dialog" aria-labelledby="line_div" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			  <div class="modal-header">
				<h2 class="modal-title" id="line_div_title" style="color: #00004f;">Line graph</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body line-body">
				<div id="line_body" class="container" style="width:400; height:300;color:navy;"></div>
				  	
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {packages: ['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', 'Total');
        for(i = 0; i < my_2d.length; i++)
    data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);
       var options = {
		   
          title: 'Comparison between total sales and dates',
		   'width':400,
		   hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
		   vAxis: {title: 'Total',  titleTextStyle: {color: '#333'}},
          'height':300,
          colors: ['navy']
		   
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_body'));
        chart.draw(data, options);
       }
		
		</script>
		
		
			<?php
		
				if($stmt = $conn->query("SELECT item,SUM(total) FROM reports,items where ID= 1 and items.no = reports.item_no group by item_no order by item_no;"))
				{
					$php_data_array = Array(); // create PHP array
					while ($row = $stmt->fetch_row()) 
					{
						$php_data_array[] = $row; // Adding to array
				   }

				}
				echo "<script>
						var my_1d = ".json_encode($php_data_array)."
				</script>";
			?>
		
    <div class="modal fade" id="bar_div" tabindex="-1" role="dialog" aria-labelledby="bar_div" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
        <h2 class="modal-title" id="line_div_title" style="color: #00004f;">Bar graph</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body line-body">
        <div id="bar" class="container" style="width:400; height:300;color:navy;"></div>
           
        </div>    
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
      </div>
    </div>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {packages: ['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', 'Total');
        for(i = 0; i < my_1d.length; i++)
    data.addRow([my_1d[i][0], parseInt(my_1d[i][1])]);
       var options = {
		   
          title: 'plus2net.com Sale Profit',
          hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
          vAxis: {title:'Total',minValue: 0},
		   colors: ['navy','black']
        };

        var chart =new google.visualization.BarChart(document.getElementById('bar'));
        chart.draw(data, options);
       }
		
</script>
		
		
			
		
		
		
		
		
		<?php 
				$id = $_SESSION['id'];
			if($st = $conn->query("SELECT item,SUM(qty) FROM reports,items where ID='$id' and items.no = reports.item_no group by item_no order by item_no;")){

				  //echo "No of records : ".$stmt->num_rows."<br>";

				while ($row = $st->fetch_row()) {

				   $php_data[] = $row; // Adding to array
				   }

				}
			echo "<script>
					var my_3d = ".json_encode($php_data)."
			</script>";
		?>

			<div class="modal fade" id="pie_div" tabindex="-1" role="dialog" aria-labelledby="pie_div" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
				  <div class="modal-header">
					<h2 class="modal-title" id="line_div_title" style="color: #00004f;">Pie chart</h2>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body line-body">
					<div id="pie_body" class="container" style="width:400; height:300;color:navy;"></div>

				  </div>

				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<script type="text/javascript">

		  // Load the Visualization API and the corechart package.
		  google.charts.load('current', {packages: ['corechart']});
		  google.charts.setOnLoadCallback(drawChart);

		  function drawChart() {

			// Create the data table.
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Item');
			data.addColumn('number', 'Quantity');
			for(i = 0; i < my_3d.length; i++)
		data.addRow([my_3d[i][0], parseInt(my_3d[i][1])]);
		   var options = {

			  title: 'Chart of items sold versus Quantity',
			   'width':400,
						   'height':300


			};

			var chart = new google.visualization.PieChart(document.getElementById('pie_body'));
			chart.draw(data, options);
		   }

			</script>

		
		
		
		

		


    </body>
</html>