<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hotel Feedback</title>
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
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select {
            appearance: none;
            background: transparent;
            background-image: url('arrow-down.png');
            background-repeat: no-repeat;
            background-position: 95% center;
        }

        textarea {
            resize: vertical;
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
    </style>
</head>

<body>
    <header>
        <h2>Leave Feedback</h2>
    </header>

    <?php
    include 'navbar.php';
    $servername = "localhost";
    $username = "root";
    $password = "Dcord2001!";
    $dbname = "hotel_management";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['service_id']) && isset($_POST['rating']) && isset($_POST['comments'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $name = $first_name . ' ' . $last_name;
            $email = $_POST['email'];
            $service_id = $_POST['service_id'];
            $rating = $_POST['rating'];
            $comments = $_POST['comments'];

            $stmt = $conn->prepare("SELECT GuestID FROM guests WHERE Name = ? AND Email = ?");
            $stmt->bind_param("ss", $name, $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $guest_id = $row['GuestID'];

                $sql = "INSERT INTO feedback (GuestID, ServiceID, Rating, Comments) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iiss", $guest_id, $service_id, $rating, $comments);

                if ($stmt->execute()) {
                    echo "Feedback submitted successfully!";
                } else {
                    echo "Error submitting feedback: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Guest not found. Please check your first name, last name, and email.";
            }
        } else {
            echo "Incomplete form data. Please fill out all fields.";
        }
    }

    $conn->close();
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        First Name: <input type="text" name="first_name" required><br>
        Last Name: <input type="text" name="last_name" required><br>
        Email: <input type="email" name="email" required><br>
        Service:
        <select name="service_id" required>
            <option value="">Select Service</option>
            <option value="1">Wi-Fi</option>
            <option value="2">Breakfast</option>
            <option value="3">Spa</option>
            <option value="4">Gym</option>
        </select><br>
        Rating:
        <select name="rating" required>
            <option value="">Select Rating</option>
            <option value="1">1 (Poor)</option>
            <option value="2">2 (Fair)</option>
            <option value="3">3 (Average)</option>
            <option value="4">4 (Good)</option>
            <option value="5">5 (Excellent)</option>
        </select><br>
        Comments: <textarea name="comments" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Submit Feedback">
    </form>

</body>

</html>