<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Handle form submission
if(isset($_POST['add'])){
    $permission_name = $_POST['permission_name'];

    // Check for duplicate
    $check = mysqli_query($conn, "SELECT * FROM permissions WHERE permission_name='$permission_name'");
    if(mysqli_num_rows($check) > 0){
        $error = "Permission already exists!";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO permissions (permission_name) VALUES ('$permission_name')");
        if($insert){
            header("Location: permission_list.php");
            exit();
        } else {
            $error = "Failed to add permission.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Permission | KDA Microfinance ERP</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>➕ Add New Permission</h2>

    <?php if(!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Permission Name</label>
            <input type="text" name="permission_name" class="form-control" required>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Add Permission</button>
        <a href="permission_list.php" class="btn btn-secondary">Back to List</a>
    </form>
</div>
</body>
</html>
