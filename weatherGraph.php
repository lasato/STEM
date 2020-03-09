<?php
	/* Database connection settings */
	$host = 'localhost';
	$user = 'root';
	$pass = 'kotarou';
	$db = 'weatherData';
	$conn = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

	$data1 = '';
	$data2 = '';
	$data3 = '';

	//query to get data from the table
	$sql = "SELECT * FROM `dataTable` ORDER BY time ASC"; // Lol What's a limit? JavaScript lag galore!
	// $sql = "SELECT * FROM `dataTable` ORDER BY temp DESC LIMIT 5"; 
    $result = $conn->query($sql, $mysqli);

	//loop through the returned data
	while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
		$data1 = $data1 . '"'. $row['humid'].'",';
		$data2 = $data2 . '"'. $row['temp'] .'",';
		$data3 = $data3 . '"'. $row['time'] .'",';
	}
?>

<!DOCTYPE html>
<html class="body">
	<head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
		<title>Weather Data</title>

		<style type="text/css">			

			.container {
				color: #E8E9EB;
				background: #222;
				border: #555652 1px solid;
				padding: 10px;
			}
			.body {
                font-family: 'Encode Sans Expanded', sans-serif;
                font-size:16px;
				background-image:url("https://landonasato.github.io/betterdiscord/images/yourname13.png");
				background-size: cover;
				text-align: center;
				overflow: visible;
            }
			#divleft {
  				float:left;
  				padding-top: 1.0em;
  				color: black;
  				background-color: white;
  				min-width: 45vw;
  				min-height: 10vh;
  				border-radius: 10px;
  				margin-top: 2vh;
 				margin-right: 2vw;
				margin-left: 3vw;
  				opacity: 0.9;
			}
			#divright {
  				float:left;
				padding-top: 1.0em;
  				color: black;
  				background-color: white;
  				min-width: 45vw;
  				min-height: 10vh;
  				border-radius: 10px;
  				margin-top: 2vh;
 				margin-right: 3vw;
  				opacity: 0.9;
			}
			#divindex {
  				padding: 1.0em;
  				width: auto;
  				height: auto;
  				border-radius: 10px;
  				margin-top: 2vh;
				background-color: white;
				opacity: 0.9;
            }
            .divbottom {
  				padding: 1.0em;
  				width: 20vw;
  				height: 10vh;
  				border-radius: 10px;
  				margin-top: 2vh;
				background-color: white;
				opacity: 0.9;
			}
            .divAlert {
                float:left;
                padding-left: 5vw;
                padding-right: 5vw;
				padding-top: 1.0em;
                padding-bottom: 1.0em;
  				color: black;
  				background-color: white;
                width: 82vw;
  				min-height: 10vh;
  				border-radius: 10px;
  				margin-top: 2vh;
                margin-left: 3vw;
                margin-right: 5vw;
                margin-bottom: 2vh;
  				opacity: 0.9;
            
            }
		</style>

	</head>

	<body>	   
			<div id="divindex">
	    <div class="container">	
	    <h1>Weather Data</h1>       
			<canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

			<script>
				var ctx = document.getElementById("chart").getContext('2d');
    			var myChart = new Chart(ctx, {
        		type: 'line',
		        data: {
		            labels: [<?php echo $data3; ?>],
		            datasets: 
		            [{
		                label: 'Humidity (%)',
		                data: [<?php echo $data1; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(222, 40, 222)',
		                borderWidth: 3
		            },

		            {
		            	label: 'Temperature (°C)',
		                data: [<?php echo $data2; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(0,255,255)',
		                borderWidth: 3	
		            }
					]
		        },
		     
		        options: {
		            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
		            tooltips:{mode: 'index'},
		            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
		        }
		    });
			</script>
	    </div>
		</div>
		<?php
		if ($result->num_rows > 0) {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
       			echo "temp: " . $row["temp"]. " - humidity: " . $row["humid"]. " - time: " . $row["time"]. "<br><br>";
    		}
		} else {
   			 echo "0 results";
			}
			?>
			<div id="divleft">
            <head><span class="divbold">Highest Temperature</span><style>.divbold{font-weight: bold; text-decoration: underline;}</style></head><br>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "kotarou";
                $dbname = "weatherData";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM dataTable ORDER BY temp DESC LIMIT 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $timeStamp = date("g:i A F j, Y ", strtotime($row["time"])) . "";
                        $c=intval($row["temp"]);
                        $f=$c*9/5+32;
                        echo "Temperature: " . $f. "°F // " . $c . "°C - Time: " . $timeStamp. "<br><br>";
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();
                ?>
			<head><span class="divbold">Lowest Temperature</span><style>.divbold{font-weight: bold; text-decoration: underline;}</style></head><br>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "kotarou";
                $dbname = "weatherData";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM dataTable ORDER BY temp ASC LIMIT 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $timeStamp = date("g:i A F j, Y ", strtotime($row["time"])) . "";
                        $c=intval($row["temp"]);
                        $f=$c*9/5+32;
                        echo "Temperature: " . $f. "°F // " . $c . "°C - Time: " . $timeStamp. "<br><br>";
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();
                ?>
			</div>
			<div id="divright">
            <head><span class="divbold">Highest Humidity</span><style>.divbold{font-weight: bold; text-decoration: underline;}</style></head><br>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "kotarou";
                $dbname = "weatherData";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM dataTable ORDER BY humid DESC LIMIT 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $timeStamp = date("g:i A F j, Y ", strtotime($row["time"])) . "";
                        echo "Humidity: " . $row["humid"]. "% - Time: " . $timeStamp. "<br><br>";
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();
                ?>
                <head><span class="divbold">Lowest Humidity</span><style>.divbold{font-weight: bold; text-decoration: underline;}</style></head><br>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "kotarou";
                    $dbname = "weatherData";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT * FROM dataTable ORDER BY humid ASC LIMIT 1";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $timeStamp = date("g:i A F j, Y ", strtotime($row["time"])) . "";
                            echo "Humidity: " . $row["humid"]. "% - Time: " . $timeStamp. "<br><br>";
                        }
                    } else {
                        echo "0 results";
                    }

                    $conn->close();
                    ?>
			</div>
            <div class="divAlert">
            <head><span class="divbold">Time since last push</span><style>.divbold{font-weight: bold; text-decoration: underline;} </style></head><br>
`
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "kotarou";
            $dbname = "weatherData";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM dataTable ORDER BY time DESC LIMIT 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $timeStamp = date("g:i A F j, Y ", strtotime($row["time"])) . "";
                    echo "Last Datapoint " . $timeStamp. "<br><br>";
                    $timeGrab = new DateTime($row["time"]);
                    $timediff = $timeGrab->diff(new DateTime());
                    echo $timediff->format('%y year %m month %d days %h hour %i minute %s seconds')."<br/>";
                    if ($timediff->i > 5) {
                        echo "No Data for 5+ Minutes. Is something wrong?";
                    }
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
            </div>

	</body>
</html>
