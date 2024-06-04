<?php
session_start();
include '../config.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT urc.car_id, urc.rent_date, c.car_name, c.image_1, c.rental_rate
            FROM user_rented_cars urc 
            JOIN cars c ON urc.car_id = c.car_id 
            WHERE urc.user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $unique_rental_id = $row['car_id'] . '_' . $row['rent_date'];

            echo '<div class="car-box" data-rental-id="' . $unique_rental_id . '">';

            // Car Image Div
            echo '<div class="car-image-container">';
            if (!empty($row['image_1'])) {
                echo '<img class="car-image" src="' . $row['image_1'] . '" alt="Car Image">';
            }
            echo '</div>';
            echo '<div class="car-text-content">';
            echo '<div class="car-text-header">';
            echo '<h1>' . strtoupper($row['car_name']) . '</h1>';
            echo '<p>Izvēlētais datums: ' . $row['rent_date'] . '</p>';
            echo '<p>Maksa: ' . $row['rental_rate'] . '&#8364;/24h</p>';

            echo '<button class="cancel-button" data-car-id="' . $row['car_id'] . '" data-rent-date="' . $row['rent_date'] . '" onclick="cancelReservation(' . $row['car_id'] . ', \'' . $row['rent_date'] . '\')">Atcelt nomu</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="no-car-box">';
        echo 'Jūs pašlaik nēesiet iznomājies automašīnu.';
        echo '</div>';
    }
}
?>
