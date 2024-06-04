<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="css/auth.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>
<div class="login">
    <h1>Pieslēdzies</h1>
    <form action="login/authenticate.php" method="post">
        <input type="text" name="username" placeholder="Lietotājvārds" id="username" value="<?php echo isset($_SESSION['username_value']) ? $_SESSION['username_value'] : ''; ?>" >
        <?php
        if (isset($_SESSION['username_error'])) {
            echo '<div class="error">' . $_SESSION['username_error'] . '</div>';
            unset($_SESSION['username_error']);
        }
        ?>
        <input type="password" name="password" placeholder="Parole" id="password" value="<?php echo isset($_SESSION['password_value']) ? $_SESSION['password_value'] : ''; ?>" >
        <?php
        if (isset($_SESSION['password_error'])) {
            echo '<div class="error">' . $_SESSION['password_error'] . '</div>';
            unset($_SESSION['password_error']);
        }
        ?>
        <?php
        if (isset($_SESSION['empty_error'])) {
            echo '<div class="error">' . $_SESSION['empty_error'] . '</div>';
            unset($_SESSION['empty_error']);
        }
        ?>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <input type="submit" value="Pieslēgties">
        <p class="link"><a href="login/reg.php">Reģistrējies</a></p>
    </form>
</div>
</body>
</html>
