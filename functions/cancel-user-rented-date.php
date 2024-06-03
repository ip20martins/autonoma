<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST['car_id'];
    $rent_date = $_POST['rent_date'];

    // Function to cancel a reservation
    function cancelReservation($conn, $car_id, $rent_date) {
        $sql = "DELETE FROM user_rented_cars WHERE car_id = ? AND rent_date = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $car_id, $rent_date);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return "Reservation cancelled successfully.";
        } else {
            return "Reservation not found or already cancelled.";
        }
    }

    // Execute the cancelReservation function
    $cancel_result = cancelReservation($conn, $car_id, $rent_date);
    echo $cancel_result;
}
?>
