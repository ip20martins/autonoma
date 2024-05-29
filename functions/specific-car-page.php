<?php
include '../config.php';

if (isset($_GET['car_id'])) {
    $car_id = intval($_GET['car_id']);

    $sql = "SELECT * FROM cars WHERE car_id = $car_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Car not found.";
        exit();
    }
} else {
    echo "Invalid car ID.";
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/saveRentedCar.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <title><?php echo htmlspecialchars($row['car_name']); ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="car-details-container">
    <div class="car-images">
        <div class="main-image-specific">
            <?php
            if (!empty($row['image_1'])) {
                echo '<img class="car-image" src="' . $row['image_1'] . '" alt="Car Image" onclick="openModal();currentSlide(1);">';
            }
            ?>
        </div>
        <div class="small-images-specific">
            <?php
            for ($i = 2; $i <= 6; $i++) {
                $imageField = 'image_' . $i;
                if (!empty($row[$imageField])) {
                    echo '<img src="' . $row[$imageField] . '" alt="Car Image" style="width:80px;height:auto;" onclick="openModal();currentSlide('.$i.');">';
                }
            }
            ?>
        </div>
    </div>
    <div class="specific-car-info">
        <div class="specific-main-info">
            <h1><?php echo htmlspecialchars($row['car_name']); ?></h1>
            <h1> <?php echo htmlspecialchars($row['year']); ?></h1>
        </div>
        <p><strong>Transmission:</strong> <?php echo htmlspecialchars($row['transmission']); ?></p>
        <p><strong>Rental Rate:</strong> €<?php echo htmlspecialchars($row['rental_rate']); ?> per day</p>
        <p><?php echo htmlspecialchars($row['description']); ?></p>
        <?php
        echo '<button class="rent-button" data-car-id="' . htmlspecialchars($row['car_id']) . '">Iznomāt</button>';
        echo '<div class="date-picker" id="datepicker-' . htmlspecialchars($row['car_id']) . '" style="display: none;">';
        echo '</div>';
        ?>
    </div>
</div>

<div id="myModal" class="modal">
    <span class="close cursor" onclick="closeModal()">&times;</span>
    <div class="modal-content">
        <?php
        for ($i = 1; $i <= 6; $i++) {
            $imageField = 'image_' . $i;
            if (!empty($row[$imageField])) {
                echo '<div class="mySlides">';
                echo '<img src="' . $row[$imageField] . '" style="width:100%">';
                echo '</div>';
            }
        }
        ?>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndex-1].style.display = "block";
    }
</script>

</body>
</html>
