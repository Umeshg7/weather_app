<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="Umesh_2358479_week_data.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="header-wrapper">
        <header class="background-header">
            <b><h1><span> One </span>Week Forecast</h1><b>
        </header>
    </div>

    <div class="content-wrapper">
        <section class="main">
            <div class="container">
                <?php
            // Database connection settings
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "weatherapi";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $database);

            // Check connection
            if (!$conn) {
                die('Connection failed: ' . mysqli_connect_error());
            }

            // Get today's date
            $today = date('Y-m-d');

            // SQL query to fetch temperature history for the last 7 days
            $sql = "SELECT * FROM temperature_history WHERE date_on BETWEEN DATE_SUB('$today', INTERVAL 7 DAY) AND '$today' ORDER BY date_on ASC LIMIT 0,7";

            $result = $conn->query($sql);

            // Check if there are any rows returned from the query
            if ($result->num_rows > 0) {
                $index = 0;
                while ($row = $result->fetch_assoc()) {
                    $index = $index + 1;

                    // Display weather data for each day
                    echo "<div class='boxes'>";
                    echo "<div class='box$index'>";
                    echo "<div class='day'>";
                    echo "<h2 class='city date1'>" . $row['city'] . "</h2>";
                    echo "<h3 class='date1'>" . $row['date_on'] . "</h3>";
                    echo "</div>";

                    // Display temperature and different weather icons based on weather condition
                    echo "<div class='main-data'>";
                    // Icon URLs can be stored in an associative array for cleaner code
                    $weatherIcons = [
                        "Clouds" => "images/clouds.png",
                        "Rain" => "images/rain.png",
                        "Clear" => "images/rain.png",
                        "Drizzle" => "images/drizzle.png",
                        "Mist" => "images/mist.png"
                    ];
                    echo "<h3 class='temp1'>" .$row['temperature']. "°C</h3>";
                    echo "<p class='desc1'>".$row['description']."</p>";
                    echo "</div>";
                    echo "<div class='data'>";
                    echo "<div class='icondata1'>";
                    echo "<i class='fas fa-tachometer-alt'></i>";
                    echo "<p class='pressure1'>" .$row['pressure']."hpa</p>";
                    echo "</div>";
                    echo "<div class='icondata2'>";
                    echo "<i class='fas fa-tint'></i>";
                    echo "<p class='humidity1'>" . $row['humidity'] . "%</p>";
                    echo "</div>";
                    echo "<div class='icondata3'>";
                    echo "<i class='fas fa-wind'></i>";
                    echo "<p class='wind1'>" . $row['wind_speed'] . "km/h</p>";
                    echo "</div>";
                    echo "</div>";

                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No weather data available for the last 7 days.</p>";
            }
            ?>
            </div>
            <div class="button">
                <div class="btn">
                    <a class="view-more" href="Umesh_2358479.html" style="color: aliceblue;"> Back</a>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
