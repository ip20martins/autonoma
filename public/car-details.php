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
        <a href="user-rented-cars.php"><i class="fa fa-search"></i>Apskatīt nomātās automašīnas</a>
        <a href="#" id="openInsertModal"><i class="fa fa-plus-square-o"></i> Pievienot savu automašīnu</a>
        <a href="../login/logout.php"><i class="fas fa-sign-out-alt"></i>Izrakstīties</a>
    </div>
</nav>
    <!-- Your HTML content -->
<?php include "../functions/specific-car-page.php"; ?>
<!-- Your other HTML content -->
</body>
</html>
