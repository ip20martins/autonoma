<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="../css/auth.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>
<div class="login">
    <h1>Pieslēdzies</h1>
    <form action="authenticate.php" method="post">
        <label for="username">
            <i class="fas fa-user"></i>
        </label>
        <input type="text" name="username" placeholder="Lietotājvārds" id="username" required>
        <label for="password">
            <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="password" placeholder="Parole" id="password" required>
        <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo '<div class="error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <input type="submit" value="Pieslēgties">
        <p class="link"><a href="reg.php">Reģistrējies</a></p>
    </form>
</div>
</body>
</html>
