<?php
include '../../config/db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['permission_name'];
  $pdo->prepare("INSERT INTO permissions (permission_name) VALUES (?)")->execute([$name]);
  header("Location: permission_list.php");
  exit;
}
?>
<form method="POST">
  <input type="text" name="permission_name" required>
  <button type="submit">Add</button>
</form>
