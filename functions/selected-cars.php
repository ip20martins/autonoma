<?php
session_start();
include '../config.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT urc.car_id, urc.rent_date, c.car_name 
            FROM user_rented_cars urc 
            JOIN cars c ON urc.car_id = c.car_id 
            WHERE urc.user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="car-box">';
            echo '<p>Automašīna: ' . $row['car_name'] . '</p>';
            echo '<p>Izvēlētais datums: ' . $row['rent_date'] . '</p>';
            echo '<button class="cancel-button" data-car-id="' . $row['car_id'] . '" data-rent-date="' . $row['rent_date'] . '" onclick="cancelReservation(' . $row['car_id'] . ', \'' . $row['rent_date'] . '\')">Atcelt nomu</button>';
            echo '</div>';
        }
    } else {
        echo '<div class="no-car-box">';
        echo 'Jūs pašlaik nēesiet iznomājies automašīnu.';
        echo '</div>';
    }
}

?>

