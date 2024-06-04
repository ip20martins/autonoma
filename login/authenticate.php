<?php
session_start();
include '../config.php';

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Check for empty fields and set appropriate error messages
if (empty($username) && empty($password)) {
    $_SESSION['error'] = 'Lūdzu aizpildiet abus laukumus!';
    $_SESSION['username_value'] = $username;
    $_SESSION['password_value'] = $password;
    header('Location: ../index.php');
    exit();
} elseif (empty($username)) {
    $_SESSION['username_error'] = 'Lūdzu aizpildiet lietotājvārda lauku!';
    $_SESSION['username_value'] = $username;
    header('Location: ../index.php');
    exit();
} elseif (empty($password)) {
    $_SESSION['password_error'] = 'Lūdzu aizpildiet paroles lauku!';
    $_SESSION['username_value'] = $username;
    header('Location: ../index.php');
    exit();
}

// Proceed with the database query if no fields are empty
if ($stmt = $conn->prepare('SELECT user_id, password FROM accounts WHERE username = ?')) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $username;
            $_SESSION['user_id'] = $id;
            header('Location: ../public/index.php');
            exit();
        } else {
            $_SESSION['error'] = 'Nepareiza parole vai lietotājvārds!';
            $_SESSION['username_value'] = $username;
            header('Location: ../index.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'Nepareiza parole vai lietotājvārds!';
        $_SESSION['username_value'] = $username;
        header('Location: ../index.php');
        exit();
    }
    $stmt->close();
}

header('Location: ../index.php');
exit();
?>
