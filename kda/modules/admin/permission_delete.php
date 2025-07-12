<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Check if ID passed
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger m-3'>Permission ID missing!</div>";
    exit();
}

$id = $_GET['id'];

// Check if permission exists
$result = mysqli_query($conn, "SELECT * FROM permissions WHERE id=$id");
$permission = mysqli_fetch_assoc($result);

if (!$permission) {
    echo "<div class='alert alert-danger m-3'>Permission not found!</div>";
    exit();
}

// If confirm delete received
if (isset($_POST['confirm_delete'])) {
    mysqli_query($conn, "DELETE FROM permissions WHERE id=$id");
    header("Location: permission_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Permission</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="alert alert-danger">
        <h5>⚠️ Confirm Delete</h5>
        <p>Are you sure you want to delete the permission: <strong><?php echo $permission['permission_name']; ?></strong> ?</p>

        <form method="POST">
            <button type="submit" name="confirm_delete" class="btn btn-danger">🗑️ Yes, Delete</button>
            <a href="permission_list.php" class="btn btn-secondary">❌ Cancel</a>
        </form>
    </div>
</div>

</body>
</html>
