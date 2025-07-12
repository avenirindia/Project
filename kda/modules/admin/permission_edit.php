<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Check if id passed
if(!isset($_GET['id'])){
    echo "Permission ID missing!";
    exit();
}

$id = $_GET['id'];

// Fetch permission details
$result = mysqli_query($conn, "SELECT * FROM permissions WHERE id=$id");
$permission = mysqli_fetch_assoc($result);

if(!$permission){
    echo "Permission not found!";
    exit();
}

// Handle form submit
if(isset($_POST['update'])){
    $permission_name = $_POST['permission_name'];

    mysqli_query($conn, "UPDATE permissions SET permission_name='$permission_name' WHERE id=$id");
    header("Location: permission_list.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Permission</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h4>Edit Permission</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Permission Name</label>
            <input type="text" name="permission_name" value="<?php echo $permission['permission_name']; ?>" class="form-control" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update Permission</button>
        <a href="permission_list.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
