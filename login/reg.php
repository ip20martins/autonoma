<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link href="../css/auth.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body>
<div class="register">
    <h1>Reģistrējies</h1>
    <form action="register.php" method="post" autocomplete="off" novalidate>
        <input type="text" name="username" placeholder="Lietotājvārds" id="username" value="<?php echo isset($_SESSION['usernameValue']) ? htmlspecialchars($_SESSION['usernameValue'], ENT_QUOTES) : ''; ?>">
        <?php
        if (isset($_SESSION['username_error'])) {
            echo '<div class="error">' . $_SESSION['username_error'] . '</div>';
            unset($_SESSION['username_error']);
        }
        ?>
        <input type="password" name="password" placeholder="Parole" id="password">
        <?php
        if (isset($_SESSION['password_error'])) {
            echo '<div class="error">' . $_SESSION['password_error'] . '</div>';
            unset($_SESSION['password_error']);
        }
        ?>
        <input type="password" name="repeat_password" placeholder="Atkārtojiet paroli" id="repeat_password">
        <?php
        if (isset($_SESSION['repeat_password_error'])) {
            echo '<div class="error">' . $_SESSION['repeat_password_error'] . '</div>';
            unset($_SESSION['repeat_password_error']);
        }
        ?>
        <input type="email" name="email" placeholder="E-pasts" id="email" value="<?php echo isset($_SESSION['emailValue']) ? htmlspecialchars($_SESSION['emailValue'], ENT_QUOTES) : ''; ?>">
        <?php
        if (isset($_SESSION['email_error'])) {
            echo '<div class="error">' . $_SESSION['email_error'] . '</div>';
            unset($_SESSION['email_error']);
        }
        ?>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="message">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <input type="submit" value="Reģistrējies">
        <p class="link"><a href="../index.php">Pieslēdzies</a></p>
    </form>
</div>
</body>
</html>
