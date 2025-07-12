<?php include('../admin/admin_sidebar.php'); ?>
<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Permission check function
function hasPermission($designation_id, $permission_name, $conn) {
    $query = "SELECT rp.id FROM role_permissions rp
              JOIN permissions p ON rp.permission_id = p.id
              WHERE rp.designation_id = $designation_id AND p.permission_name = '$permission_name'";
    $result = mysqli_query($conn, $query);
    return (mysqli_num_rows($result) > 0);
}

// User designation ID from session
$user_designation_id = $_SESSION['designation_id'];
?>

<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; height:100vh; position: fixed;">
  <a href="../admin/dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
    <span class="fs-4">📊 KDA ERP</span>
  </a>
  <hr>

  <ul class="nav nav-pills flex-column mb-auto">

    <li><a href="../admin/dashboard.php" class="nav-link">🏠 Dashboard</a></li>

    <?php if (hasPermission($user_designation_id, 'Employee Add', $conn)) { ?>
      <li><a href="../employees/emp_add.php" class="nav-link">➕ Employee Add</a></li>
    <?php } ?>

    <?php if (hasPermission($user_designation_id, 'Employee View', $conn)) { ?>
      <li><a href="../employees/emp_list.php" class="nav-link">📋 Employee List</a></li>
    <?php } ?>

    <?php if (hasPermission($user_designation_id, 'Branch Add', $conn)) { ?>
      <li><a href="../branches/branch_add.php" class="nav-link">🏢 Branch Add</a></li>
    <?php } ?>

    <?php if (hasPermission($user_designation_id, 'Branch View', $conn)) { ?>
      <li><a href="../branches/branch_list.php" class="nav-link">📍 Branch List</a></li>
    <?php } ?>

    <?php if (hasPermission($user_designation_id, 'Loan Approve', $conn)) { ?>
      <li><a href="../loans/loan_approve.php" class="nav-link">✔️ Loan Approve</a></li>
    <?php } ?>

    <?php if (hasPermission($user_designation_id, 'Accounts Access', $conn)) { ?>
      <li><a href="../accounts/index.php" class="nav-link">💰 Accounts Module</a></li>
    <?php } ?>

    <li><a href="../admin/company_info_edit.php" class="nav-link">⚙️ Company Info</a></li>
    <li><a href="../admin/logout.php" class="nav-link text-danger">🚪 Logout</a></li>

  </ul>
  <hr>
  <div class="text-muted small">
    &copy; 2025 KDA Microfinance ERP
  </div>
</div>
