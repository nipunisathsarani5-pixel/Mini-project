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

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
    $stmt->close();
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $room = $_POST['room'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    $stmt = $conn->prepare("UPDATE bookings SET name=?, email=?, room=?, checkin=?, checkout=? WHERE id=?");
    $stmt->bind_param("sssssi", $name, $email, $room, $checkin, $checkout, $id);
    if($stmt->execute()){
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
    <h2>Edit Booking</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $booking['id'] ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?= $booking['name'] ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $booking['email'] ?>" required>

        <label>Room:</label>
        <select name="room" required>
            <option value="Standard" <?= $booking['room']=='Standard'?'selected':'' ?>>Standard</option>
            <option value="Deluxe" <?= $booking['room']=='Deluxe'?'selected':'' ?>>Deluxe</option>
            <option value="Suite" <?= $booking['room']=='Suite'?'selected':'' ?>>Suite</option>
        </select>

        <label>Check-in:</label>
        <input type="date" name="checkin" value="<?= $booking['checkin'] ?>" required>

        <label>Check-out:</label>
        <input type="date" name="checkout" value="<?= $booking['checkout'] ?>" required>

        <button type="submit" name="update">Update</button>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </form>
</main>
</body>
</html>
