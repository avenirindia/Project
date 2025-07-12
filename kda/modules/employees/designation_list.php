<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

$result = mysqli_query($conn, "SELECT * FROM designations ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Designation List</title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <div class="d-flex justify-content-between mb-4">
    <h4>📝 Designation List</h4>
    <a href="designation_add.php" class="btn btn-primary">➕ Add New Designation</a>
  </div>

  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Designation Name</th>
        <th style="width:180px;">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['designation_name']; ?></td>
        <td>
          <a href="designation_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
          <a href="designation_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
             onclick="return confirm('Are you sure you want to delete this?');">🗑️ Delete</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  <a href="../admin/dashboard.php" class="btn btn-secondary">← Back to Dashboard</a>
</div>

</body>
</html>
