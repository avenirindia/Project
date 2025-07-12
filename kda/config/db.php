<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// তারপর তোমার query
$today = date('j');
$query = "SELECT * FROM branches WHERE rent_payment_date = $today";
$result = mysqli_query($conn, $query);

// etc...
?>
<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "project";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
