<?php
include '../config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        echo "Error: User not logged in.";
        exit;
    }

    $user_id = $_SESSION['user_id'];
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

    $sql = "INSERT INTO cars (user_id, car_name, transmission, year, mileage, availability_status, rental_rate, description, image_1, image_2, image_3, image_4, image_5, image_6) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $availabilityStatus = 1;
    $stmt->bind_param("ississdssssssss", $user_id, $carName, $transmission, $year, $mileage, $availabilityStatus, $rentalRate, $description, $images[1], $images[2], $images[3], $images[4], $images[5], $images[6]);

    if ($stmt->execute()) {
        header("Location: index.php?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


