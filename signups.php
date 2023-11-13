<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Loyalty Program Sign-Up</title>
</head>

<body>
    <header>
        <h2>Sign Up for Our Loyalty Program</h2>
    </header>
    <?php include("navbar.php"); ?>
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
        input[type="tel"] {
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
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            width: 90%;
            resize: vertical;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "Dcord2001!";
    $dbname = "hotel_management";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $check_stmt = $conn->prepare("SELECT LoyaltyMember FROM guests WHERE Name = ? AND Email = ?");
        $check_stmt->bind_param("ss", $name, $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $row = $check_result->fetch_assoc();
            $loyalty_member = $row['LoyaltyMember'];

            if ($loyalty_member == 1) {
                echo "You are already a loyalty member.";
            } else {
                $stmt = $conn->prepare("SELECT GuestID FROM guests WHERE Name = ? AND Email = ?");
                $stmt->bind_param("ss", $name, $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $guest_id = $row['GuestID'];

                    $update_stmt = $conn->prepare("UPDATE guests SET LoyaltyMember = 1 WHERE GuestID = ?");
                    $update_stmt->bind_param("i", $guest_id);
                    $update_stmt->execute();

                    $loyalty_stmt = $conn->prepare("INSERT INTO loyaltyprogram (GuestID, Points, RewardsRedeemed) VALUES (?, 0, '')");
                    $loyalty_stmt->bind_param("i", $guest_id);

                    if ($loyalty_stmt->execute()) {
                        echo "Sign-up successful!";
                    } else {
                        echo "Error signing up: " . $loyalty_stmt->error;
                    }

                    $loyalty_stmt->close();
                } else {
                    echo "Guest not found. Please check your name and email.";
                }

                $stmt->close();
            }
        } else {
            echo "Guest not found. Please check your name and email.";
        }

        $check_stmt->close();
    }

    $conn->close();
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Phone: <input type="tel" name="phone" required><br>
        <input type="submit" value="Sign Up">
    </form>
</body>

</html>