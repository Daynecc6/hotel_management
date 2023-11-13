<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management - New Reservation</title>
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

        form {
            text-align: center;
            margin: 20px auto;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select,
        input[type="date"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 90%;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 15px 20px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 50%;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <header>
        <h2>Create a New Reservation</h2>
    </header>
    <?php include 'navbar.php'; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="first">First:</label>
        <input type="text" name="first" required><br>
        <label for="last">Last:</label>
        <input type="text" name="last" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="phone">Phone:</label>
        <input type="tel" name="phone" required><br>
        <label for="type_traveler">Traveler Type:</label>
        <select name="type_traveler" required>
            <option value="">Select Traveler Type</option>
            <option value="business">Business</option>
            <option value="leisure">Leisure</option>
        </select><br>
        <label for="room_type">Room Type:</label>
        <select name="room_type" id="room_type" required onchange="calculateCost()">
            <option value="">Select a Room Type</option>
            <option value="standard">Standard - $100/night</option>
            <option value="deluxe">Deluxe - $200/night</option>
            <option value="suite">Suite - $300/night</option>
        </select><br>
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" required><br>
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" required><br>

        <input type="submit" value="Create Reservation">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "Dcord2001!";
        $dbname = "hotel_management";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $first_name = $conn->real_escape_string($_POST['first']);
        $last_name = $conn->real_escape_string($_POST['last']);
        $name = $first_name . ' ' . $last_name;
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $type_traveler = $conn->real_escape_string($_POST['type_traveler']);

        if (!in_array($type_traveler, ['business', 'leisure'])) {
            die("Invalid traveler type.");
        }

        $room_type_to_id_mapping = [
            'standard' => 1,
            'deluxe' => 2,
            'suite' => 3
        ];

        $room_type = $conn->real_escape_string($_POST['room_type']);
        $room_id = $room_type_to_id_mapping[$room_type];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $stmt = $conn->prepare("
    SELECT rn.roomnumber
    FROM roomnumbers rn
    WHERE rn.RoomID = (SELECT RoomID FROM rooms WHERE Type = ? LIMIT 1)
    AND NOT EXISTS (
        SELECT 1
        FROM reservations r
        WHERE rn.roomnumber = r.roomnumber
        AND ? >= r.StartDate
        AND ? <= r.EndDate
    );
    
    ");

        $stmt->bind_param("sss", $room_type, $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $available_room = $result->fetch_assoc();
            $room_number = $available_room['RoomNumber'];

            $stmt = $conn->prepare("SELECT GuestID FROM guests WHERE Email = ? AND Phone = ?");
            $stmt->bind_param("ss", $email, $phone);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $guest = $result->fetch_assoc();
                $guest_id = $guest['GuestID'];
            } else {
                $insert_stmt = $conn->prepare("INSERT INTO guests (Name, Email, Phone, TypeTraveler) VALUES (?, ?, ?, ?)");
                $insert_stmt->bind_param("ssss", $name, $email, $phone, $type_traveler);
                $insert_stmt->execute();
                $guest_id = $conn->insert_id;
                $insert_stmt->close();
            }

            $res_stmt = $conn->prepare("INSERT INTO reservations (GuestID, RoomID, StartDate, EndDate, RoomNumber) VALUES (?, ?, ?, ?, ?)");
            $res_stmt->bind_param("iissi", $guest_id, $room_id, $start_date, $end_date, $room_number);
            if (!$res_stmt->execute()) {
                echo "Error: " . $res_stmt->error;
            } else {
                echo "Reservation created successfully!";
            }
            $res_stmt->close();
        } else {
            echo "No rooms of the selected type are available for the chosen dates.";
        }
        $stmt->close();
        $conn->close();
    }
    ?>

</body>

</html>