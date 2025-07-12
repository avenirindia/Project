<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Session check
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

// Form submission check
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $designation_name = $_POST['designation_name'];

    // Duplicate check
    $check = mysqli_query($conn, "SELECT * FROM designations WHERE designation_name='$designation_name'");
    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger'>This designation already exists!</div>";
    } else {
        $query = "INSERT INTO designations (designation_name) VALUES ('$designation_name')";
        if (mysqli_query($conn, $query)) {
            $message = "<div class='alert alert-success'>Designation added successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Failed to add designation.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Designation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">➕ Add New Designation</h5>
        </div>
        <div class="card-body">
            <?php echo $message; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Designation Name</label>
                    <input type="text" name="designation_name" class="form-control" required autofocus>
                </div>
                <button type="submit" class="btn btn-success">➕ Add Designation</button>
                <a href="designation_list.php" class="btn btn-secondary">📄 View All</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
