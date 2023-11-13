<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Ratings and Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        h2 {
            margin-top: 20px;
            text-align: center;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 50%;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>

<body>
    <header>
        <h2>Service Ratings and Reviews</h2>
    </header>

    <?php include("navbar.php"); ?>

    <div class="content">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "Dcord2001!";
        $dbname = "hotel_management";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $servicesQuery = "SELECT S.ServiceID, S.Name, S.Description, AVG(F.Rating) AS AverageRating
                          FROM services S
                          LEFT JOIN feedback F ON S.ServiceID = F.ServiceID
                          GROUP BY S.ServiceID, S.Name, S.Description
                          ORDER BY S.ServiceID";
        $servicesResult = $conn->query($servicesQuery);

        if ($servicesResult->num_rows > 0) {
            while ($serviceRow = $servicesResult->fetch_assoc()) {
                $serviceID = $serviceRow["ServiceID"];
                $serviceName = $serviceRow["Name"];
                $serviceDescription = $serviceRow["Description"];
                $averageRating = number_format($serviceRow["AverageRating"], 2);

                echo '<div style="text-align:center;"><h3>' . htmlspecialchars($serviceName) . ' (Avg Rating: ' . htmlspecialchars($averageRating) . ')</h3></div>';
                echo '<table>';
                echo '<tr><th>Rating</th><th>Comment</th></tr>';

                $reviewsQuery = "SELECT Rating, Comments FROM feedback WHERE ServiceID = ?";
                $reviewsStmt = $conn->prepare($reviewsQuery);
                $reviewsStmt->bind_param("i", $serviceID);
                $reviewsStmt->execute();
                $reviewsResult = $reviewsStmt->get_result();

                while ($reviewRow = $reviewsResult->fetch_assoc()) {
                    $rating = $reviewRow["Rating"];
                    $comment = $reviewRow["Comments"];

                    echo '<tr><td>' . htmlspecialchars($rating) . '</td>';
                    echo '<td>' . htmlspecialchars($comment) . '</td></tr>';
                }

                echo '</table>';
                $reviewsStmt->close();
            }
        } else {
            echo "<p>No services available.</p>";
        }

        $conn->close();
        ?>
    </div>

</body>

</html>