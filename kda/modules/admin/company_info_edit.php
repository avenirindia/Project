<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}
?>
<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Fetch company info
$result = mysqli_query($conn, "SELECT * FROM company_info LIMIT 1");
$company = mysqli_fetch_assoc($result);

// Handle form submit
if(isset($_POST['update'])){
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];

    mysqli_query($conn, "UPDATE company_info SET email='$email', phone='$phone', website='$website' WHERE id=".$company['id']);
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Company Info</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h4>Update Company Information</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $company['email']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Contact Number</label>
            <input type="text" name="phone" value="<?php echo $company['phone']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Website</label>
            <input type="text" name="website" value="<?php echo $company['website']; ?>" class="form-control" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update Info</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
