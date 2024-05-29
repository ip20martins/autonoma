<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
include '../config.php';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE user_id = ?');
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Tavs profils</title>
		<link href="../css/auth.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Blogs</h1>
                <a href="../blogs/newblog.php"><i class="fas fa-plus-circle"></i>Jauns ieraksts</a>
				<a href="../blogs/blog.php"><i class="fas fa-newspaper-o"></i>Ieraksti</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Izrakstīties</a>                
			</div>
		</nav>
		<div class="content">
			<h2>Profils</h2>
			<div>
				<p>Tava profila informācija :</p>
				<table>
					<tr>
						<td>Lietotājvārds:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					
					<tr>
						<td>E-pasts:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>