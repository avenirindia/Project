<?php
include '../../config/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM designations WHERE id = ?");
$stmt->execute([$id]);

header("Location: designation_list.php");
exit;
?>
