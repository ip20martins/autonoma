<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../config.php';

// Debug logging
file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);

// Initialize variables to hold input values
// Initialize variables to hold input values
$usernameValue = isset($_POST['username']) ? $_POST['username'] : '';
$emailValue = isset($_POST['email']) ? $_POST['email'] : '';
$passwordValue = isset($_POST['password']) ? $_POST['password'] : '';
$repeatPasswordValue = isset($_POST['repeat_password']) ? $_POST['repeat_password'] : '';


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    file_put_contents('debug.log', 'MySQL connection failed: ' . mysqli_connect_error() . PHP_EOL, FILE_APPEND);
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$hasError = false;

if (!isset($_POST['username'], $_POST['password'], $_POST['repeat_password'], $_POST['email'])) {
    $_SESSION['message'] = 'Lūdzu aizpildiet visus ievadlaukus!';
    $hasError = true;
    file_put_contents('debug.log', 'Missing fields: ' . print_r($_POST, true) . PHP_EOL, FILE_APPEND);
} else {
    if (empty($_POST['username'])) {
        $_SESSION['username_error'] = 'Lūdzu aizpildiet lietotājvārda lauku!';
        $hasError = true;
    }
    if (empty($_POST['password'])) {
        $_SESSION['password_error'] = 'Lūdzu aizpildiet paroles lauku!';
        $hasError = true;
    }
    if (empty($_POST['repeat_password'])) {
        $_SESSION['repeat_password_error'] = 'Lūdzu atkārtojiet paroli!';
        $hasError = true;
    }
    if (empty($_POST['email'])) {
        $_SESSION['email_error'] = 'Lūdzu aizpildiet e-pasta lauku!';
        $hasError = true;
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email_error'] = 'E-pasts ir kļūdains, lūdzu mēģiniet vēlreiz!';
        $hasError = true;
    } else if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
        $_SESSION['username_error'] = 'Lietotājvārds nav atbilstošs, var sastāvēt tikai no burtiem un cipariem!';
        $hasError = true;
    } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
        $_SESSION['password_error'] = 'Parolei jabūt no 5 līdz 20 rakstzīmēm garai!';
        $hasError = true;
    } else if ($_POST['password'] !== $_POST['repeat_password']) {
        $_SESSION['repeat_password_error'] = 'Paroles nesakrīt!';
        $hasError = true;
    }

    if (!$hasError) {
        file_put_contents('debug.log', 'No errors, proceeding to database operations' . PHP_EOL, FILE_APPEND);
        if ($stmt = $conn->prepare('SELECT user_id FROM accounts WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $_SESSION['username_error'] = 'Lietotājvārds ir aizņemts, lūdzu izvēlieties citu!';
            } else {
                if ($stmt = $conn->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
                    $stmt->execute();
                    if ($stmt->affected_rows === 1) {
                        $_SESSION['message'] = 'Jūs esiet reģistrējies, tagad varat pieslēgties!';
                    } else {
                        $_SESSION['message'] = 'Registration failed!';
                    }
                    file_put_contents('debug.log', 'Insert statement executed: ' . print_r($stmt, true) . PHP_EOL, FILE_APPEND);
                    header('Location: reg.php');
                    exit();
                } else {
                    $_SESSION['message'] = 'Could not prepare insert statement!';
                    file_put_contents('debug.log', 'Insert statement preparation failed: ' . print_r($stmt->error, true) . PHP_EOL, FILE_APPEND);
                }
            }
            $stmt->close();
        } else {
            $_SESSION['message'] = 'Could not prepare select statement!';
            file_put_contents('debug.log', 'Select statement preparation failed: ' . print_r($stmt->error, true) . PHP_EOL, FILE_APPEND);
        }
    }
}

$conn->close();

// Store valid inputs in session variables
$_SESSION['usernameValue'] = $usernameValue;
$_SESSION['emailValue'] = $emailValue;
$_SESSION['passwordValue'] = $passwordValue;
$_SESSION['repeatPasswordValue'] = $repeatPasswordValue;


header('Location: reg.php');
exit();
?>
