<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Added Cars</title>
</head>
<body>

<?php
include '../config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
	echo "Error: User not logged in.";
	exit;
}

$user_id = $_SESSION['user_id'];

function cancelReservation($conn, $car_id, $rent_date) {
	$sql = "DELETE FROM user_rented_cars WHERE car_id = ? AND rent_date = ?";
	$stmt = $conn->prepare($sql);
	if (!$stmt) {
		die("Prepare failed: " . $conn->error);
	}
	$stmt->bind_param("is", $car_id, $rent_date);
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		return "Reservation cancelled successfully.";
	} else {
		return "Reservation not found or already cancelled.";
	}
}

function deleteCar($conn, $car_id) {
	$sql = "DELETE FROM cars WHERE car_id = ?";
	$stmt = $conn->prepare($sql);
	if (!$stmt) {
		die("Prepare failed: " . $conn->error);
	}
	$stmt->bind_param("i", $car_id);
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		return "Car deleted successfully.";
	} else {
		return "Car not found or already deleted.";
	}
}

$sql = "SELECT * FROM cars WHERE user_id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
	die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		echo '<div class="car-box" data-car-id="' . $row['car_id'] . '">';

		// Car Image Div
		echo '<div class="car-image-container">';
		if (!empty($row['image_1'])) {
			echo '<img class="car-image" src="' . $row['image_1'] . '" alt="Car Image">';
		}
		echo '</div>';

		echo '<div class="car-text-content">';
		echo '<div class="car-text-header">';
		echo '<h1>' . strtoupper($row['car_name']) . '</h1>';
		echo '</div>';
		echo '<div class="car-text-info">';
		echo '<p>Maksa: ' . $row['rental_rate'] . '&#8364;/24h</p>';

		$rented_sql = "SELECT rent_date FROM user_rented_cars WHERE car_id = ?";
		$rented_stmt = $conn->prepare($rented_sql);
		if (!$rented_stmt) {
			die("Prepare failed: " . $conn->error);
		}
		$rented_stmt->bind_param("i", $row['car_id']);
		$rented_stmt->execute();
		$rented_result = $rented_stmt->get_result();

		if ($rented_result->num_rows > 0) {
			echo '<p>Izīrētie datumi:</p>';
			while ($rented_row = $rented_result->fetch_assoc()) {
				echo '<div class="rental-date">';
				echo '<p>' . $rented_row['rent_date'] . '</p>';
				echo '<form method="post">';
				echo '<input type="hidden" name="car_id" value="' . $row['car_id'] . '">';
				echo '<input type="hidden" name="rent_date" value="' . $rented_row['rent_date'] . '">';
				echo '<button type="submit" name="cancel_reservation">Atcelt rezervāciju lietotājam</button>';
				echo '</form>';
				echo '</div>';
			}
		} else {
			echo '<p>Pašlaik Jūsu automašīna nav izīrēta nevienā datumā.</p>';
		}
		$rented_stmt->close();

		echo '<form method="post">';
		echo '<input type="hidden" name="car_id" value="' . $row['car_id'] . '">';
		echo '<button type="submit" name="delete_car">Dzēst automašīnu</button>';
		echo '</form>';

		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
} else {
	echo "Šobrīd nav pievienotas automašīnas.";
}

if (isset($_POST['cancel_reservation'])) {
	$car_id = $_POST['car_id'];
	$rent_date = $_POST['rent_date'];
	$cancel_result = cancelReservation($conn, $car_id, $rent_date);
	echo "<script>alert('$cancel_result');</script>";
}

if (isset($_POST['delete_car'])) {
	$car_id = $_POST['car_id'];
	$delete_result = deleteCar($conn, $car_id);
	echo "<script>alert('$delete_result'); window.location.href = 'your-cars.php';</script>";
}
?>

</body>
</html>
