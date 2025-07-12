<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if(!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID missing!</div>";
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM designations WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(!$row) {
    echo "<div class='alert alert-danger'>Designation not found!</div>";
    exit();
}

if(isset($_POST['confirm_delete'])) {
    mysqli_query($conn, "DELETE FROM designations WHERE id=$id");
    header("Location: designation_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Delete Designation</title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <div class="alert alert-danger">
    <h5>⚠️ Confirm Delete</h5>
    <p>Are you sure you want to delete: <strong><?php echo $row['designation_name']; ?></strong> ?</p>
    <form method="POST">
      <button type="submit" name="confirm_delete" class="btn btn-danger">🗑️ Yes, Delete</button>
      <a href="designation_list.php" class="btn btn-secondary">❌ Cancel</a>
    </form>
  </div>
</div>

</body>
</html>
