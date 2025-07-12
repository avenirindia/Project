<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/functions.php');
?>

<div class="list-group">
    <a href="dashboard.php" class="list-group-item">🏠 Dashboard</a>

    <?php if (hasPermission($_SESSION['designation_id'], 'Employee Add', $conn)) { ?>
        <a href="../employees/emp_add.php" class="list-group-item">👨‍💼 Add Employee</a>
    <?php } ?>

    <?php if (hasPermission($_SESSION['designation_id'], 'Branch Add', $conn)) { ?>
        <a href="../branches/branch_add.php" class="list-group-item">🏢 Add Branch</a>
    <?php } ?>

    <?php if (hasPermission($_SESSION['designation_id'], 'Accounts Access', $conn)) { ?>
        <a href="../accounts/index.php" class="list-group-item">💳 Accounts</a>
    <?php } ?>

    <a href="../../logout.php" class="list-group-item text-danger">🚪 Logout</a>
</div>
