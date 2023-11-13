<?php

$servername = "localhost";
$username = "root";
$password = "Dcord2001!";
$dbname = "hotel_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date("Y-m-d", strtotime("-1 week"));
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date("Y-m-d");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
}

$employee_sql = "SELECT * FROM employees";
$employee_result = $conn->query($employee_sql);

$employee_data = [];

if ($employee_result->num_rows > 0) {
    while ($employee_row = $employee_result->fetch_assoc()) {
        $employee_id = $employee_row["EmployeeID"];
        $employee_name = $employee_row["Name"];
        $employee_position = $employee_row["Position"];

        $shift_sql = "SELECT SUM(HoursWorked) AS TotalHoursWorked
                      FROM employeeshifts
                      WHERE EmployeeID = $employee_id
                      AND WorkDate BETWEEN '$start_date' AND '$end_date'";

        $shift_result = $conn->query($shift_sql);
        $total_hours_worked = 0;

        if ($shift_result->num_rows > 0) {
            $shift_row = $shift_result->fetch_assoc();
            $total_hours_worked = $shift_row["TotalHoursWorked"];
        }

        $wage_sql = "SELECT HourlyRate FROM wages WHERE WageID = (SELECT WageID FROM employees WHERE EmployeeID = $employee_id)";
        $wage_result = $conn->query($wage_sql);
        $hourly_rate = 0;

        if ($wage_result->num_rows > 0) {
            $wage_row = $wage_result->fetch_assoc();
            $hourly_rate = $wage_row["HourlyRate"];
        }

        $total_earnings = $total_hours_worked * $hourly_rate;

        $employee_data[] = [
            "EmployeeID" => $employee_id,
            "Name" => $employee_name,
            "Position" => $employee_position,
            "TotalHoursWorked" => $total_hours_worked,
            "TotalEarnings" => $total_earnings,
        ];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employee Work Hours and Pay</title>
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
            width: 80%;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>

<body>
    <header>
        <h2>Employee Work Hours and Pay</h2>
    </header>

    <?php include 'navbar.php'; ?>
    <form method="post">
        Start Date: <input type="date" name="start_date" value="<?php echo $start_date; ?>">
        End Date: <input type="date" name="end_date" value="<?php echo $end_date; ?>">
        <input type="submit" value="Apply">
    </form>

    <table>
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Total Hours Worked</th>
            <th>Total Earnings</th>
        </tr>
        <?php foreach ($employee_data as $employee): ?>
            <tr>
                <td>
                    <?php echo $employee["EmployeeID"]; ?>
                </td>
                <td>
                    <?php echo $employee["Name"]; ?>
                </td>
                <td>
                    <?php echo $employee["Position"]; ?>
                </td>
                <td>
                    <?php echo $employee["TotalHoursWorked"]; ?>
                </td>
                <td>
                    <?php echo $employee["TotalEarnings"]; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>