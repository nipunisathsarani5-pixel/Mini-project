<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "hotel_db";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$name = $_POST['name'];
$email = $_POST['email'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$room_type = $_POST['room_type'];

$conn->query("INSERT INTO customers (name, email) VALUES ('$name', '$email')");
$customer_id = $conn->insert_id;

$result = $conn->query("SELECT room_id FROM rooms WHERE room_type='$room_type' AND status='Available' LIMIT 1");
if ($result->num_rows > 0) {
    $room = $result->fetch_assoc();
    $room_id = $room['room_id'];

    $conn->query("INSERT INTO bookings (customer_id, room_id, checkin, checkout) 
                  VALUES ($customer_id, $room_id, '$checkin', '$checkout')");
    $conn->query("UPDATE rooms SET status='Booked' WHERE room_id=$room_id");

    echo "<script>alert('Booking successful!');window.location='index.html';</script>";
} else {
    echo "<script>alert('No available room of this type.');window.location='booking.html';</script>";
}
?>
