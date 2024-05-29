<?php
include '../config.php';

$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="car-box" data-car-id="' . $row['car_id'] . '">';

        // Car Image Div
        echo '<div class="car-image-container">';
        if (!empty($row['main_image'])) {
            echo '<img class="car-image" src="' . $row['main_image'] . '" alt="Car Image">';
        }
        }
        echo '</div>';

        echo '<div class="car-text-content">';
        echo '<div class="car-text-header">';
        echo '<h1>' . strtoupper($row['car_name']) . '</h1>';
        echo '</div>';
        echo '<div class="car-text-info">';
        echo '<p>Ātr. karba: ' . $row['transmission'] . '</p>';
        echo '<p>Cena par 24h: ' . $row['rental_rate'] . '&#8364;</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "0 results";
}

$conn->close();
?>


<?php
for ($i = 1; $i <= 6; $i++) {
    $imageField = 'image_' . $i;
    if (!empty($row[$imageField])) {
        echo '<img src="' . $row[$imageField] . '" alt="Car Image" style="width:240px;height:auto;">';
    }
}
?>