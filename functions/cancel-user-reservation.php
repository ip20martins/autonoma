<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $carId = $_POST['carId'];
        $rentDate = $_POST['rentDate'];
        $sql = "DELETE FROM user_rented_cars WHERE user_id = '$user_id' AND car_id = '$carId' AND rent_date = '$rentDate'";
        if ($conn->query($sql) === TRUE) {
            echo "Reservation canceled successfully.";
        } else {
            echo "Error canceling reservation: " . $conn->error;
        }
    } else {
        echo "User session not found.";
    }
}
?>
