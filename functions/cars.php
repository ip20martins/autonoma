<?php
include '../config.php';




$sql = "SELECT * FROM cars WHERE user_id != ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="car-box" data-car-id="' . $row['car_id'] . '">';

        echo '<div class="car-image-container">';
        if (!empty($row['image_1'])) {
            echo '<img class="car-image" src="' . $row['image_1'] . '" alt="Car Image">';
        }
        echo '</div>';

        echo '<div class="car-text-content">';
        echo '<div class="car-text-header">';
        echo '<h1>' . strtoupper($row['car_name']) . '</h1>';
        echo '</div>';
        echo '<div class="car-text-info">';
        echo '<p>Transmisija: ' . $row['transmission'] . '</p>';
        echo '<p>Cena par 24h: ' . $row['rental_rate'] . '&#8364;</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "0 results";
}

$stmt->close();
$conn->close();
?>
