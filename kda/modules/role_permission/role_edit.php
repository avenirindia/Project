<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Invalid Request");
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM designations WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Designation not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $designation_name = $_POST['designation_name'];
    mysqli_query($conn, "UPDATE designations SET designation_name='$designation_name' WHERE id=$id");
    header("Location: role_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Designation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-dark">
            <h5>✏️ Edit Designation</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Designation Name</label>
                    <input type="text" name="designation_name" value="<?php echo $data['designation_name']; ?>" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">💾 Update</button>
                <a href="role_list.php" class="btn btn-secondary">🔙 Back</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
