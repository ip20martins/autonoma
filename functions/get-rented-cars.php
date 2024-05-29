<?php
include '../config.php';

if(isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];

    $sql = "SELECT rent_date FROM user_rented_cars WHERE car_id = '$car_id'";
    $result = $conn->query($sql);

    $rentedDates = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rentedDates[] = $row['rent_date'];
        }
    }

    echo json_encode($rentedDates);
} else {
    echo "Error: Car ID not provided.";
}

$conn->close();
?>
