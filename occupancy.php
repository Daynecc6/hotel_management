<?php
$start_date = "";
$end_date = "";
$room_data = [];
$servername = "localhost";
$username = "root";
$password = "Dcord2001!";
$dbname = "hotel_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql = "
        SELECT 
            rooms.Type,
            SUM(DATEDIFF(LEAST(reservations.EndDate, '$end_date'), GREATEST(reservations.StartDate, '$start_date'))) AS NightsBooked
        FROM 
            reservations
        JOIN 
            rooms ON reservations.RoomID = rooms.RoomID
        WHERE 
            reservations.StartDate <= '$end_date' AND reservations.EndDate >= '$start_date'
        GROUP BY 
            rooms.Type
    ";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $room_type = $row["Type"];
        $nights_booked = $row["NightsBooked"];
        $total_rooms = 10;
        $percentage_booked = ($nights_booked / ($total_rooms * (strtotime($end_date) - strtotime($start_date)) / 86400)) * 100;

        $priceQuery = "SELECT Price FROM rooms WHERE Type = '$room_type'";
        $priceResult = $conn->query($priceQuery);
        $priceRow = $priceResult->fetch_assoc();
        $price = $priceRow["Price"];

        $revenue = $nights_booked * $price;

        $room_data[$room_type] = [
            "nights_booked" => $nights_booked,
            "total_rooms" => $total_rooms,
            "percentage_booked" => $percentage_booked,
            "revenue" => $revenue
        ];
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Occupancy Analysis</title>
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

        form {
            text-align: center;
            margin: 20px auto;
            /* Center the form horizontally */
            max-width: 400px;
            /* Set a maximum width for the form container */
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="date"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 30%;
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

        /* Style for room rows */
        .room-row {
            border-bottom: 2px solid #000;
            /* Add a dark line at the bottom of room rows */
        }

        /* Style for total row */
        .total-row {
            border: 2px solid #000;
            /* Add a dark line at the top of the total row */
        }
    </style>
</head>

<body>
    <header>
        <h2>Room Occupancy Analysis</h2>
    </header>

    <?php include("navbar.php"); ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="start_date">Start Date:</label>
        <div class="date-input-container">
            <input type="date" name="start_date" id="start_date" value="<?php echo $start_date; ?>" required>
        </div>
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" value="<?php echo $end_date; ?>" required><br>
        <input type="submit" value="Analyze Occupancy">
    </form>

    <?php if (!empty($room_data)): ?>
        <div style="text-align: center; margin-top: 50px;">
            <h3>
                <?php echo htmlspecialchars($start_date) . ' to ' . htmlspecialchars($end_date); ?>
            </h3>
        </div>
        <table>
            <tr>
                <th>Room Type</th>
                <th>Nights Booked</th>
                <th>Percentage Booked</th>
                <th>Revenue</th>
            </tr>
            <?php foreach ($room_data as $room_type => $data): ?>
                <tr class="room-row">
                    <td>
                        <?php echo htmlspecialchars($room_type); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($data["nights_booked"]); ?>
                    </td>
                    <td>
                        <?php echo number_format(htmlspecialchars($data["percentage_booked"]), 2) . '%'; ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($data["revenue"]); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td>Total</td>
                <td></td>
                <td></td>
                <td>
                    <?php echo htmlspecialchars(array_sum(array_column($room_data, 'revenue'))); ?>
                </td>
            </tr>
        </table>
    <?php endif; ?>

</body>

</html>