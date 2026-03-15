<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hotel_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Fetch bookings securely
$stmt = $conn->prepare("SELECT id, name, email, room, checkin, checkout FROM bookings");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Admin Dashboard</h1>
    <nav>
        <a href="admin_dashboard.php">View Bookings</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<main>
    <h2>All Bookings</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Room</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Actions</th>
        </tr>
        <?php
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['room']."</td>
                        <td>".$row['checkin']."</td>
                        <td>".$row['checkout']."</td>
                        <td>
                            <a href='edit_booking.php?id=".$row['id']."'>Edit</a> | 
                            <a href='delete_booking.php?id=".$row['id']."' onclick=\"return confirm('Are you sure?')\">Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No bookings found</td></tr>";
        }
        $stmt->close();
        $conn->close();
        ?>
    </table>
</main>
</body>
</html>

