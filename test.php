
<html>
<head>
<title>plus2net.com : Pie chart using data from MySQL table</title>
</head>
<body style="color:black;">
<?php
		$conn = mysqli_connect("localhost", "root","","abcrest" );
if($stmt = $conn->query("SELECT item,SUM(total) FROM reports,items where ID= 1 and items.no = reports.item_no group by item_no order by item_no;")){

  
$php_data_array = Array(); // create PHP array
 
while ($row = $stmt->fetch_row()) {
  
   $php_data_array[] = $row; // Adding to array
   }

}else{
echo $connection->error;
}
//print_r( $php_data_array);
// You can display the json_encode output here. 

// Transfor PHP array to JavaScript two dimensional array 
echo "<script>
        var my_1d = ".json_encode($php_data_array)."
</script>";
?>


<div id="chart_div" class="container" style="width:400; height:300;color:navy;background-color:azure;"></div>
<br><br>

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
		   tooltip:{textStyle:{fontName:'"Arial"'}},
          title: 'Graph of Total versus Date',
          hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
          vAxis: {title:'Total',minValue: 0},
		   colors: ['navy','black']
        };

        var chart =new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
       }
		
</script>
	</body>
</html>