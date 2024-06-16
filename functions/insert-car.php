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
    $rentalRate = $_POST['rentalRate'] ?? 0.0;
    $description = $_POST['description'] ?? '';

    $images = [];
    for ($i = 1; $i <= 8; $i++) {
        $imageField = 'image' . $i;
        if (!empty($_FILES[$imageField]['name'])) {
            $targetDir = "../uploads/";
            $targetFile = $targetDir . basename($_FILES[$imageField]['name']);
            if (move_uploaded_file($_FILES[$imageField]['tmp_name'], $targetFile)) {
                $images[] = $targetFile;  // Add to the array
            } else {
                $images[] = NULL;  // Add null if upload fails
            }
        } else {
            $images[] = NULL;  // Add null if file not provided
        }
    }

    // Ensure the images array has exactly 8 elements
    $images = array_pad($images, 8, NULL);

    $sql = "INSERT INTO cars (user_id, car_name, transmission, year, availability_status, rental_rate, description, image_1, image_2, image_3, image_4, image_5, image_6, image_7, image_8) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $availabilityStatus = 1;

    // Create the type definition string
    $types = "isssdssssssssss";

    // Bind the parameters
    $stmt->bind_param(
            $types,
            $user_id, $carName, $transmission, $year, $availabilityStatus, $rentalRate, $description,
            $images[0], $images[1], $images[2], $images[3], $images[4], $images[5], $images[6], $images[7]
    );

    if ($stmt->execute()) {
        header("Location: ../public/your-cars.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
