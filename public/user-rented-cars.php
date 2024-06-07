<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/auth.css" rel="stylesheet" type="text/css">
    <link href="../css/cars.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="../js/saveRentedCar.js"></script>
    <title>Nomātās mašīnas </title>
</head>
<body class="loggedin">
<nav class="navtop">
    <div>
        <h1>Auto noma</h1>
        <a href="index.php">Sākumlapa</a>
        <a href="your-cars.php">Apskatīt savas automašīnas</a>
        <a href="../login/logout.php">Izrakstīties</a>
    </div>
</nav>

<div class="cars-container">
    <?php include "../functions/selected-cars.php"; "../functions/cancel-user-reservation.php"; ?>
</div>
