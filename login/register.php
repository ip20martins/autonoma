<?php
session_start();

include '../config.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$response = '';

if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    $response = 'Lūdzu aizpildiet visus ievadlaukus!';
} else {
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        $response = 'Lūdzu aizpildiet visus ievadlaukus!';
    } else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $response = 'E-pasts ir kļūdains, lūdzu mēģiniet vēlreiz!';
        } else if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
            $response = 'Lietotājvārds nav atbilstošs, var sastāvēt tikai no burtiem un cipariem!';
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $response = 'Parolei jabūt no 5 līdz 20 rakstzīmēm garai!';
        } else {
            if ($stmt = $conn->prepare('SELECT user_id, password FROM accounts WHERE username = ?')) {
                $stmt->bind_param('s', $_POST['username']);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $response = 'Lietotājvārds ir aizņemts, lūdzu izvēlieties citu!';
                } else {
                    if ($stmt = $conn->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
                        $stmt->execute();
                        $_SESSION['message'] = 'Jūs esiet reģistrējies, tagad vari pieslēgties!';
                        header('Location: reg.php'); 
                        exit();
                    } else {
                        $response = 'Could not prepare statement!';
                    }
                }
                $stmt->close();
            } else {
                $response = 'Could not prepare statement!';
            }
        }
    }
}
$conn->close();
$_SESSION['message'] = $response; 

header('Location: reg.php');
exit();
?>
