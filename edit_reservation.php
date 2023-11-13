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
    $reservation_id = $_POST['reservation_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql = "UPDATE reservations SET StartDate='$start_date', EndDate='$end_date' WHERE ReservationID=$reservation_id";
    if ($conn->query($sql) === TRUE) {
        echo "Reservation updated successfully!";
    } else {
        echo "Error updating reservation: " . $conn->error;
    }
} else {
    $reservation_id = $_GET['id'];
    $sql = "SELECT * FROM reservations WHERE ReservationID=$reservation_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        ?>
        <h2>Edit Reservation</h2>
        <?php include 'navbar.php'; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="reservation_id" value="<?php echo $row['ReservationID']; ?>">
            Start Date: <input type="date" name="start_date" value="<?php echo $row['StartDate']; ?>"><br>
            End Date: <input type="date" name="end_date" value="<?php echo $row['EndDate']; ?>"><br>
            <input type="submit" value="Update Reservation">
        </form>
        <?php
    } else {
        echo "Reservation not found.";
    }
}

$conn->close();
?>