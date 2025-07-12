<?php
include('../../config/constants.php');
include(BASE_PATH . '/config/db_connect.php');

$designation_name = mysqli_real_escape_string($conn, $_POST['designation_name']);

mysqli_query($conn, "INSERT INTO designations (designation_name) VALUES ('$designation_name')");

header("Location: role_list.php?msg=Designation added successfully");
exit;
?>

<?php include('../../includes/footer.php'); ?>
