<style>
    .navbar {
        background-color: #333;
        overflow: hidden;
    }

    .nav-list {
        list-style-type: none;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    .nav-item {
        display: inline-block;
        margin: 0;
    }

    .nav-item a {
        display: block;
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
        transition: background-color 0.3s;
    }

    .nav-item a:hover {
        background-color: #555;
    }

    .customer-nav {}

    .employee-nav {}
</style>

<nav class="navbar">
    <ul class="nav-list">
        <li class="nav-item customer-nav"><a href="/hotel/hotel.php">Home</a></li>
        <li class="nav-item customer-nav"><a href="/hotel/feedback.php">Feedback</a></li>
        <li class="nav-item customer-nav"><a href="/hotel/signups.php">Rewards Sign-Up</a></li>

        <li class="nav-item employee-nav"><a href="/hotel/employees.php">Employee Info</a></li>
        <li class="nav-item employee-nav"><a href="/hotel/occupancy.php">Occupancy</a></li>
        <li class="nav-item customer-nav"><a href="/hotel/view_reservations.php">View Reservations</a></li>
        <li class="nav-item customer-nav"><a href="/hotel/services.php">Services</a></li>


    </ul>
</nav>