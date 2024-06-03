<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Added Cars</title>
    <style>
        /* The modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black with opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
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

// Function to update car details
function updateCarDetails($conn, $car_id, $car_name, $rental_rate, $year, $color, $mileage, $transmission, $description) {
    $sql = "UPDATE cars SET car_name = ?, rental_rate = ?, year = ?, color = ?, mileage = ?, transmission = ?, description = ? WHERE car_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssissi", $car_name, $rental_rate, $year, $color, $mileage, $transmission, $description, $car_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        return "Car details updated successfully.";
    } else {
        return "Failed to update car details.";
    }
}

$sql = "SELECT * FROM cars WHERE user_id = ?";
$stmt = $conn->prepare($sql);
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
        echo '<p>Rental Rate: ' . $row['rental_rate'] . ' &#8364;/24h</p>';

        // Fetch rented dates for this car
        $rented_sql = "SELECT rent_date FROM user_rented_cars WHERE car_id = ?";
        $rented_stmt = $conn->prepare($rented_sql);
        $rented_stmt->bind_param("i", $row['car_id']);
        $rented_stmt->execute();
        $rented_result = $rented_stmt->get_result();

        if ($rented_result->num_rows > 0) {
            echo '<p>Rental Dates:</p>';
            while ($rented_row = $rented_result->fetch_assoc()) {
                echo '<div class="rental-date">';
                echo '<p>' . $rented_row['rent_date'] . '</p>';
                echo '<form method="post">';
                echo '<input type="hidden" name="car_id" value="' . $row['car_id'] . '">';
                echo '<input type="hidden" name="rent_date" value="' . $rented_row['rent_date'] . '">';
                echo '<button type="submit" name="cancel_reservation">Cancel</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo '<p>No rental dates found.</p>';
        }
        $rented_stmt->close();

        // Edit and Delete buttons
        // Edit and Delete buttons
        echo '<button onclick="openModal(' . $row['car_id'] . ', \'' . $row['car_name'] . '\', \'' . $row['rental_rate'] . '\', \'' . $row['year'] . '\', \'' . $row['color'] . '\', \'' . $row['mileage'] . '\', \'' . $row['transmission'] . '\', \'' . $row['description'] . '\')">Edit</button>';
        echo '<form method="post">';
        echo '<input type="hidden" name="car_id" value="' . $row['car_id'] . '">';
        echo '<button type="submit" name="delete_car">Delete</button>';
        echo '</form>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No cars added.";
}

// Handle cancellation form submission
if (isset($_POST['cancel_reservation'])) {
    $car_id = $_POST['car_id'];
    $rent_date = $_POST['rent_date'];
    $cancel_result = cancelReservation($conn, $car_id, $rent_date);
}

// Handle delete car form submission
if (isset($_POST['delete_car'])) {
    $car_id = $_POST['car_id'];
    $delete_result = deleteCar($conn, $car_id);
    echo "<script>alert('$delete_result');</script>";
    echo "<script>window.location.href = 'user-added-cars.php';</script>";
}

// Handle updating car details form submission
if (isset($_POST['update_car_details'])) {
    $car_id = $_POST['car_id'];
    $car_name = $_POST['car_name'];
    $rental_rate = $_POST['rental_rate'];
    $year = !empty($_POST['year']) ? $_POST['year'] : null;
    $color = $_POST['color'];
    $mileage = $_POST['mileage'];
    $transmission = $_POST['transmission'];
    $description = $_POST['description'];

    $update_result = updateCarDetails($conn, $car_id, $car_name, $rental_rate, $year, $color, $mileage, $transmission, $description);
    echo "<script>window.location.href = 'your-cars.php';</script>";
}

?>

<!-- Modal -->
<div id="editModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Car Details</h2>
        <form method="post">
            <input type="hidden" id="edit_car_id" name="car_id">
            <p>Car Name: <input type="text" id="edit_car_name" name="car_name"></p>
            <p>Rental Rate: <input type="text" id="edit_rental_rate" name="rental_rate"></p>
            <p>Year: <input type="text" id="edit_year" name="year"></p>
            <p>Color: <input type="text" id="edit_color" name="color"></p>
            <p>Mileage: <input type="text" id="edit_mileage" name="mileage"></p>
            <p>Transmission: <input type="text" id="edit_transmission" name="transmission"></p>
            <p>Description: <textarea id="edit_description" name="description"></textarea></p>
            <button type="submit" name="update_car_details">Update Car Details</button>
        </form>
    </div>
</div>

<script>
    function openModal(carId, carName, rentalRate, year, color, mileage, transmission, description) {
        document.getElementById("edit_car_id").value = carId;
        document.getElementById("edit_car_name").value = carName;
        document.getElementById("edit_rental_rate").value = rentalRate;
        document.getElementById("edit_year").value = year;
        document.getElementById("edit_color").value = color;
        document.getElementById("edit_mileage").value = mileage;
        document.getElementById("edit_transmission").value = transmission;
        document.getElementById("edit_description").value = description;
        document.getElementById("editModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("editModal").style.display = "none";
    }

    function cancelReservation(event) {
        event.preventDefault();
        const form = event.target.closest('form');
        const formData = new FormData(form);

        fetch('cancel-user-reservation.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(result => {
                document.getElementById("message").innerText = result;
                // Assuming you have a div with class="rental-date" to remove after cancellation
                const rentalDateDiv = form.closest('.rental-date');
                rentalDateDiv.parentNode.removeChild(rentalDateDiv);
            })
            .catch(error => console.error('Error:', error));
    }

    function deleteCar(event) {
        event.preventDefault();
        const form = event.target.closest('form');
        const formData = new FormData(form);

        fetch('cancel-user-rented-date.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(result => {
                // Assuming you have a div with id="message" to display messages
                document.getElementById("message").innerText = result;
                // Assuming you have a div with class="car-box" to remove after deletion
                const carBox = form.closest('.car-box');
                carBox.parentNode.removeChild(carBox);
            })
            .catch(error => console.error('Error:', error));
    }

    // Handling the form submission for updating car details
    document.getElementById("update-car-form").addEventListener("submit", function(event) {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);

        fetch('delete-user-car.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(result => {
                document.getElementById("message").innerText = result;
                // Close the modal after updating car details
                closeModal();
            })
            .catch(error => console.error('Error:', error));
    });
</script>

</body>
</html>