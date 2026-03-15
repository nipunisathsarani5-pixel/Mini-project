<?php
include "db.php";

$result = $conn->query("SELECT * FROM bookings");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Bookings</title>
</head>
<body>
    <h1>Bookings List</h1>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Room</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Booked At</th>
        </tr>
        <?php while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['customer_name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['room_type'] ?></td>
            <td><?= $row['check_in'] ?></td>
            <td><?= $row['check_out'] ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
