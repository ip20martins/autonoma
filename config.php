<?php
$env = parse_ini_file('.env');
$servername = $env ["HOSTNAME"] ;
$username = $env ["USERNAME"] ;
$password = $env ["PASSWORD"] ;
$dbname = $env ["DATABASE"] ;

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {

}
?>
