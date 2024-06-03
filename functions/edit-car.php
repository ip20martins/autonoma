<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['car_id'])) {
    $car_id = $_POST['car_id'];

    // Prepare and execute SQL query to fetch car details
    $stmt = $conn->prepare("SELECT * FROM cars WHERE car_id = ?");
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if car details were found
    if ($result->num_rows > 0) {
        $car_details = $result->fetch_assoc();
        // Return car details as JSON
        echo json_encode($car_details);
    } else {
        // Car details not found
        echo json_encode(array('error' => 'Car details not found'));
    }

    $stmt->close();
    $conn->close();
} else {
    // Invalid request
    echo json_encode(array('error' => 'Invalid request'));
}
?>
