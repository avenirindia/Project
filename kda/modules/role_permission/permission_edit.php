<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM permissions WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['permission_name'];
    mysqli_query($conn, "UPDATE permissions SET permission_name='$name' WHERE id=$id");
    header("Location: permission_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Permission</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
  <h3>✏️ Edit Permission</h3>
  <form method="POST">
    <div class="mb-3">
      <label>Permission Name</label>
      <input type="text" name="permission_name" value="<?= $row['permission_name'] ?>" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">💾 Update</button>
    <a href="permission_list.php" class="btn btn-secondary">⬅️ Back</a>
  </form>
</div>

</body>
</html>
