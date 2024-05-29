<?php
session_start();
include '../config.php';

if (isset($_GET['car_id'], $_GET['car_id'], $_GET['rent_date'])) {
    $user_id = $_SESSION['user_id'];
    $car_id = $_GET['car_id'];
    $rent_date = $_GET['rent_date'];

    $availability_check_sql = "SELECT * FROM user_rented_cars WHERE car_id = '$car_id' AND rent_date = '$rent_date'";
    $availability_check_result = $conn->query($availability_check_sql);

    if ($availability_check_result->num_rows === 0) {
        $insert_rented_car_sql = "INSERT INTO user_rented_cars (user_id, car_id, rent_date) VALUES ('$user_id', '$car_id', '$rent_date')";
        
        if ($conn->query($insert_rented_car_sql) === TRUE) {
            $update_availability_sql = "UPDATE cars SET availability_status = 0 WHERE car_id = '$car_id'";
            if ($conn->query($update_availability_sql) === TRUE) {
                echo "Jūs esat veiksmīgi iznomājuši automašīnu.";
            } else {
                echo "Error updating availability: " . $conn->error;
            }
        } else {
            echo "Error: " . $insert_rented_car_sql . "<br>" . $conn->error;
        }
    } else {
        echo "Automašīna šajā datumā nav pieejama.";
    }
} else {
    echo "Invalid request or missing data.";
}

$conn->close();
?>
