<?php
// Database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "user_systems";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch today's reservations
$sql = "SELECT facility_name, status, COUNT(*) as count FROM reservations WHERE reservation_date = CURDATE() GROUP BY facility_name, status";
$result = $conn->query($sql);
$reservations = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    display: flex;
    background-color: #f4f4f4;
}

.container {
    display: flex;
    width: 100%;
}

.sidebar {
    width: 250px;
    background-color: #2c3e50;
    color: #fff;
    padding-top: 20px;
}

.sidebar-header {
    text-align: center;
}

.sidebar-header h3 {
    margin-bottom: 20px;
}

.sidebar-menu {
    list-style-type: none;
}

.sidebar-menu li {
    padding: 15px;
}

.sidebar-menu li a {
    color: #fff;
    text-decoration: none;
    display: block;
}

.sidebar-menu li a:hover {
    background-color: #34495e;
}

.main-content {
    flex-grow: 1;
    padding: 20px;
    background-color: #fff;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

header h1 {
    font-size: 24px;
    color: #2c3e50;
}

.profile {
    display: flex;
    align-items: center;
}

.profile-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.dashboard-content {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.content-section {
    background-color: #ecf0f1;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

.content-section h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

.status {
    font-weight: bold;
}

.confirmed {
    color: green;
}

.pending {
    color: yellow;
}

.active {
    color: green;
}

.maintenance {
    color: red;
}

/* Calendar styles */
#calendar {
    height: 300px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}
</style>
    <div class="container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h3>Admin Dashboard</h3>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Reservations</a></li>
                <li><a href="#">Tasks</a></li>
                <li><a href="#">Facility Status</a></li>
                <li><a href="#">Calendar</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>Today's Overview</h1>
                <div class="profile">
                    <img src="profile.jpg" alt="Profile" class="profile-img">
                    <span>Admin Name</span>
                </div>
            </header>

            <section class="dashboard-content">
                <div class="content-section">
                    <h2>Today's Reservations</h2>
                    <ul>
                        <?php foreach ($reservations as $reservation): ?>
                            <li><?= $reservation['facility_name'] ?>: <span class="status <?= strtolower($reservation['status']) ?>"><?= $reservation['count'] ?> Reservations (<?= $reservation['status'] ?>)</span></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="content-section">
                    <h2>Pending Tasks</h2>
                    <ul>
                        <li>Approve reservation for Commonwealth Park on October 14, 2024</li>
                        <li>Respond to 2 User Inquiries</li>
                    </ul>
                </div>

                <div class="content-section">
                    <h2>Facility Status</h2>
                    <ul>
                        <li>Barangay Multi-Purpose Hall: <span class="status active">Active</span></li>
                        <li>Commonwealth Park: <span class="status maintenance">Maintenance Scheduled (Oct 20-22, 2024)</span></li>
                    </ul>
                </div>

                <div class="content-section">
                    <h2>Calendar Overview</h2>
                    <div id="calendar"></div>
                    <!-- Interactive calendar will be inserted here -->
                </div>
            </section>
        </div>
    </div>
    <script>
        // This can be used to initialize an interactive calendar in the future.
document.addEventListener("DOMContentLoaded", function () {
    const calendar = document.getElementById("calendar");

    // Placeholder content for calendar, you can add a calendar library like FullCalendar
    calendar.innerHTML = "<p>Calendar will be integrated here.</p>";
});
</script>
</body>
</html>
