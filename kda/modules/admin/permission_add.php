<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Handle form submit
if (isset($_POST['add'])) {
    $permission_name = $_POST['permission_name'];

    mysqli_query($conn, "INSERT INTO permissions (permission_name) VALUES ('$permission_name')");
    header("Location: permission_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Permission</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h4>➕ Add New Permission</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Permission Name</label>
            <input type="text" name="permission_name" class="form-control" required>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Save Permission</button>
        <a href="permission_list.php" class="btn btn-secondary">← Back to List</a>
    </form>
</div>

</body>
</html>
