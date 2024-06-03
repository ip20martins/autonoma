<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST['car_id'];

    // Function to delete a car
    function deleteCar($conn, $car_id) {
        $sql = "DELETE FROM cars WHERE car_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $car_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return "Car deleted successfully.";
        } else {
            return "Car not found or already deleted.";
        }
    }

    // Execute the deleteCar function
    $delete_result = deleteCar($conn, $car_id);
    echo $delete_result;
}
?>
