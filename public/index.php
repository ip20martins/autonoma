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
    <style>
        .modal {
            display none:
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.9);
        }
        .modal-content {
            position: relative;
            margin: auto;
            padding: 0;
            width: 100%;
            max-width: 910px;
        }
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
        .modal-image {
            width: 100%;
        }
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }
        .prev {
            left: 0;
            border-radius: 3px 3px 0 0;
        }
        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }
    </style>
</head>
<body class="loggedin">
<nav class="navtop">
    <div>
        <h1>Auto noma</h1>
        <a href="user-rented-cars.php"><i class="fa fa-search"></i>Apskatīt nomātās automašīnas</a>
        <a href="#" id="openInsertModal"><i class="fa fa-plus-square-o"></i> Pievienot savu automašīnu</a>
        <a href="../login/logout.php"><i class="fas fa-sign-out-alt"></i>Izrakstīties</a>
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
                <script src="../js/insertCarModalValidations.js"></script>
                <div class="left">
                    <div class="form-input">
                        <input type="text" id="carSearch" name="carSearch" placeholder="Search Car Brand">
                        <script src="../js/fetchCarNames.js"></script>
                        <div id="carDropdown" class="dropdown-content"></div>
                        <div id="error" style="color: red;"></div>
                    </div>

                    <div class="form-input">
                        <select id="transmission" name="transmission">
                            <option value="" disabled selected>Select Transmission</option>
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                        </select>
                    </div>

                    <div class="form-input">
                        <input type="number" id="year" name="year" placeholder="Year" min="1960" max="2024">
                    </div>

                    <div class="form-input">
                        <input type="number" min="0" max="10000" step="1" id="rentalRate" name="rentalRate" placeholder="Maksa par 24h">
                    </div>

                    <div class="form-input">
                        <textarea id="description" name="description" placeholder="Description" maxlength="300"></textarea>
                        <div id="char-counter">0</div>
                        <script src="../js/insertModalCharCounter.js"></script>
                    </div>
                    <button type="submit">Submit</button>
                </div>

                <div class="right">
                    <div class="right-row1">
                        <label for="image1" class="photo-upload">Attēls</label>
                        <input id="image1" name="image1" type="file" onchange="previewImage(this, 'preview1')"/>
                        <div id="preview1" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>

                        <label for="image2" class="photo-upload">Attēls</label>
                        <input id="image2" name="image2" type="file" onchange="previewImage(this, 'preview2')"/>
                        <div id="preview2" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>

                        <label for="image3" class="photo-upload">Attēls</label>
                        <input id="image3" name="image3" type="file" onchange="previewImage(this, 'preview3')"/>
                        <div id="preview3" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>

                        <label for="image4" class="photo-upload">Attēls</label>
                        <input id="image4" name="image4" type="file" onchange="previewImage(this, 'preview4')"/>
                        <div id="preview4" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>
                    </div>
                    <div class="right-row2">
                        <label for="image5" class="photo-upload">Attēls</label>
                        <input id="image5" name="image5" type="file" onchange="previewImage(this, 'preview5')"/>
                        <div id="preview5" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>

                        <label for="image6" class="photo-upload">Attēls</label>
                        <input id="image6" name="image6" type="file" onchange="previewImage(this, 'preview6')"/>
                        <div id="preview6" class="image-preview"><i class="fa fa-image" style="font-size: 60px; color:lightgrey"></i></div>
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
