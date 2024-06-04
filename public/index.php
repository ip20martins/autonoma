<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/auth.css" rel="stylesheet" type="text/css">
    <link href="../css/cars.css" rel="stylesheet" type="text/css">
    <link href="../css/insert-modal.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="../js/saveRentedCar.js"></script>
    <script src="../js/insertModal.js"></script>
    <title>Automašīnas</title>
</head>
<body class="loggedin">
<nav class="navtop">
    <div>
        <h1>Auto noma</h1>
        <a href="user-rented-cars.php">Apskatīt nomātās automašīnas</a>
        <a href="your-cars.php">Apskatīt savas automašīnas</a>
        <a href="#" id="openInsertModal">Pievienot savu automašīnu</a>
        <a href="../login/logout.php">Izrakstīties</a>
    </div>
</nav>

<div id="insertModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="carForm" action="../functions/insert-car.php" method="post" enctype="multipart/form-data">
            <div class="form-header">
                <h4>Automašīnas pievienošana</h4>
                <hr>
            </div>
            <div class="form-main">
                <script src="../js/insertCarModal.js"></script>
                <div class="left">
                    <div class="form-input">
                        <input type="text" id="carSearch" name="carSearch" placeholder="Meklējiet automašīnu">
                        <script src="../js/insertCarModal.js"></script>
                        <div id="carDropdown" class="dropdown-content"></div>
                        <div id="error" style="color: red;"></div>
                    </div>

                    <div class="form-input">
                        <select id="transmission" name="transmission">
                            <option value="" disabled selected>Transmisija</option>
                            <option value="Manual">Manuāls</option>
                            <option value="Automatic">Automāts</option>
                        </select>
                    </div>

                    <div class="form-input">
                        <input type="number" id="year" name="year" placeholder="Ražošanas gads" min="1960" max="2024">
                    </div>

                    <div class="form-input">
                        <input type="number" min="0" max="10000" step="1" id="rentalRate" name="rentalRate" placeholder="Maksa par 24h">
                    </div>

                    <div class="form-input">
                        <textarea id="description" name="description" placeholder="Automašinas apraksts" maxlength="300"></textarea>
                        <div id="char-counter">0</div>
                        <script src="../js/insertModalCharCounter.js"></script>
                    </div>
                    <button type="submit">Pievienot</button>
                </div>

                <div class="right">
                    <div class="right-row1">
                        <label for="image1" class="photo-upload">Attēls</label>
                        <input id="image1" name="image1" type="file" accept="image/*" onchange="previewImage(this, 'preview1')"/>
                        <div id="preview1" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>

                        <label for="image2" class="photo-upload">Attēls</label>
                        <input id="image2" name="image2" type="file" accept="image/*" onchange="previewImage(this, 'preview2')"/>
                        <div id="preview2" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>

                        <label for="image3" class="photo-upload">Attēls</label>
                        <input id="image3" name="image3" type="file" accept="image/*" onchange="previewImage(this, 'preview3')"/>
                        <div id="preview3" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>

                        <label for="image4" class="photo-upload">Attēls</label>
                        <input id="image4" name="image4" type="file" accept="image/*" onchange="previewImage(this, 'preview4')"/>
                        <div id="preview4" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>
                    </div>
                    <div class="right-row2">
                        <label for="image5" class="photo-upload">Attēls</label>
                        <input id="image5" name="image5" type="file" accept="image/*" onchange="previewImage(this, 'preview5')"/>
                        <div id="preview5" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>

                        <label for="image6" class="photo-upload">Attēls</label>
                        <input id="image6" name="image6" type="file" accept="image/*" onchange="previewImage(this, 'preview6')"/>
                        <div id="preview6" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>

                        <label for="image7" class="photo-upload">Attēls</label>
                        <input id="image7" name="image7" type="file" accept="image/*" onchange="previewImage(this, 'preview7')"/>
                        <div id="preview7" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>

                        <label for="image8" class="photo-upload">Attēls</label>
                        <input id="image8" name="image8" type="file" accept="image/*" onchange="previewImage(this, 'preview8')"/>
                        <div id="preview8" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="cars-container">
    <?php include "../functions/cars.php"; ?>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var carBoxes = document.querySelectorAll('.car-box');

        carBoxes.forEach(function(box) {
            box.addEventListener('click', function() {
                var carId = this.getAttribute('data-car-id');
                window.location.href = 'car-details.php?car_id=' + carId;
            });
        });
    });
</script>
<div id="imageModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
    <a class="prev">&#10094;</a>
    <a class="next">&#10095;</a>
</div>
<script src="../js/carImgModal.js"></script>
</body>
</html>
