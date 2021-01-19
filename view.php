<!DOCTYPE html>
<html>
<head>
<title>View genres frequency</title>
    <?php
    require 'connect.php';
    ?>
    <button onclick="window.location.href = 'index.html'">Go back home</button>

    <br>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 
    <script type="text/javascript">
	
	google.charts.load('current', {'packages':['corechart']} );

	//Set a callback to run when the Google Visualization API is loaded.
	google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
		//Create the data table.
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Genres');
		data.addColumn('number', 'Amount');

        <?php
            $query  = "SELECT genre, COUNT(id) AS amount FROM Books GROUP BY genre ORDER BY amount DESC";
            $result = $conn->query($query);

            if (!$result) die ("Database access failed: " . $conn->error);

            echo "data.addRows([ ";

            if ($result -> num_rows > 0) {
                while ($row = $result -> fetch_assoc()) {
                    echo "['" . $row["genre"] . "', " . $row["amount"] . "], ";
                }
            }
            echo "])";
        ?>

        var options = {'title':' Genres', width:900, height:600 };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

</script>
</head>
<body>
<!--Div that will hold the pie chart-->
	<div id="chart_div" style = “width:800, height:600”></div?>

</body>
</html>
