<?php
include "db.php";

if (isset($_POST['book'])) {
    $name = $_POST['customer_name'];
    $email = $_POST['email'];
    $room = $_POST['room_type'];
    $checkin = $_POST['check_in'];
    $checkout = $_POST['check_out'];

    $sql = "INSERT INTO bookings (customer_name, email, room_type, check_in, check_out)
            VALUES ('$name', '$email', '$room', '$checkin', '$checkout')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Booking successful!<br>";
        echo "<a href='view_bookings.php'>View All Bookings</a>";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
?>
