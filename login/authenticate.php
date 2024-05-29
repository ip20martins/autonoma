<?php
session_start();
include '../config.php';

if (!isset($_POST['username'], $_POST['password'])) {
    $_SESSION['error'] = 'Lūdzu aizpildiet abus laukumus!';
    header('Location: login.php');
    exit();
}

if ($stmt = $conn->prepare('SELECT user_id, password FROM accounts WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['user_id'] = $id;
            header('Location: ../public/index.php');
            exit();
        } else {
            $_SESSION['error'] = 'Nepareiza parole vai lietotājvārds!';
        }
    } else {
        $_SESSION['error'] = 'Nepareiza parole vai lietotājvārds!';
    }

    $stmt->close();
    header('Location: login.php');
    exit();
}
?>
