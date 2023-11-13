<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations</title>
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
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-collapse: collapse;
            border: 1px solid #ccc;
            border-radius: 10px;
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

        form {
            text-align: center;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>

<body>
    <header>
        <h2>View Reservations</h2>
    </header>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "Dcord2001!";
    $dbname = "hotel_management";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['reservation_id'])) {
        $reservation_id = $_POST['reservation_id'];
        $sql = "DELETE FROM reservations WHERE ReservationID = $reservation_id";

        if ($conn->query($sql) === TRUE) {
            echo "Reservation deleted successfully!";
        } else {
            echo "Error deleting reservation: " . $conn->error;
        }
    }

    $sql = "SELECT R.ReservationID, G.Name AS GuestName, R.StartDate, R.EndDate, R.RoomNumber
            FROM reservations R
            INNER JOIN guests G ON R.GuestID = G.GuestID";
    $result = $conn->query($sql);

    include 'navbar.php';

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Reservation ID</th><th>Guest Name</th><th>Start Date</th><th>End Date</th><th>Actions</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ReservationID"] . "</td>";
            echo "<td>" . $row["GuestName"] . "</td>";
            echo "<td>" . $row["StartDate"] . "</td>";
            echo "<td>" . $row["EndDate"] . "</td>";

            echo "<td>";
            echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
            echo "<input type='hidden' name='reservation_id' value='" . $row['ReservationID'] . "'>";
            echo "<input type='submit' value='Delete' style='background-color: #333; color: #fff; padding: 5px 10px; margin-right: 5px;'>";
            echo "</form>";

            echo "<form action='edit_reservation.php' method='get'>";
            echo "<input type='hidden' name='id' value='" . $row['ReservationID'] . "'>";
            echo "<input type='submit' value='Edit' style='background-color: #333; color: #fff; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;'>";
            echo "</form>";

            echo "</td>";
            echo "</tr>";
        }




        echo "</table>";
    } else {
        echo "No reservations found.";
    }

    $conn->close();
    ?>
</body>

</html>