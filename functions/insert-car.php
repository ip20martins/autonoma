<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carName = $_POST['carSearch'] ?? '';
    $transmission = $_POST['transmission'] ?? '';
    $year = $_POST['year'] ?? '';
    $color = $_POST['color'] ?? '';
    $mileage = $_POST['mileage'] ?? 0;
    $rentalRate = $_POST['rentalRate'] ?? 0.0;
    $description = $_POST['description'] ?? '';

    $images = [];
    for ($i = 1; $i <= 6; $i++) {
        $imageField = 'image' . $i;
        if (!empty($_FILES[$imageField]['name'])) {
            $targetDir = "../uploads/";
            $targetFile = $targetDir . basename($_FILES[$imageField]['name']);
            if (move_uploaded_file($_FILES[$imageField]['tmp_name'], $targetFile)) {
                $images[$i] = $targetFile;
            } else {
                $images[$i] = NULL;
            }
        } else {
            $images[$i] = NULL;
        }
    }

    $sql = "INSERT INTO cars (car_name, transmission, year, color, mileage, availability_status, rental_rate, description, image_1, image_2, image_3, image_4, image_5, image_6) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $availabilityStatus = 1;
    $stmt->bind_param("ssissdssssssss", $carName, $transmission, $year, $color, $mileage, $availabilityStatus, $rentalRate, $description, $images[1], $images[2], $images[3], $images[4], $images[5], $images[6]);

    if ($stmt->execute()) {
        header("Location: index.php?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
