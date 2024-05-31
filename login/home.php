<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>  
        
                
		<meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Home Page</title>
		<link href="../css/auth.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Admin</h1>
                <a href="../public/index.php"><i class="fas fa-newspaper-o"></i>Apskatīt nummurus</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Izrakstīties</a>
				
			</div>
		</nav>
		<div class="content">
			<h2></h2>
			<p>Sveiki, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>
