<ul class="nav nav-pills flex-column mb-auto">
  <li><a href="dashboard.php" class="nav-link">🏠 Dashboard</a></li>

  <?php if (hasPermission($_SESSION['designation_id'], 'Employee View', $conn)) { ?>
  <li><a href="../employees/employee_list.php" class="nav-link">👥 Employees</a></li>
  <?php } ?>

  <?php if (hasPermission($_SESSION['designation_id'], 'Branch View', $conn)) { ?>
  <li><a href="../branches/branch_list.php" class="nav-link">🏢 Branches</a></li>
  <?php } ?>

  <?php if (hasPermission($_SESSION['designation_id'], 'Accounts Access', $conn)) { ?>
  <li><a href="../accounts/accounts_dashboard.php" class="nav-link">💰 Accounts</a></li>
  <?php } ?>

  <li><a href="../../logout.php" class="nav-link text-danger">🚪 Logout</a></li>
</ul>
<li><a href="../role_permission/permission_list.php" class="nav-link">🔑 Manage Permissions</a></li>
