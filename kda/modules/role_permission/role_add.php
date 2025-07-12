<?php
include('../../config/constants.php');
include(BASE_PATH . '/config/db_connect.php');
?>
<div class="container mt-4">
  <h4 class="mb-4">Add New Designation</h4>
  <form method="post" action="role_add_save.php">
    <div class="mb-3">
      <label class="form-label">Designation Name</label>
      <input type="text" name="designation_name" class="form-control" placeholder="Enter Designation Name" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Designation</button>
    <a href="role_list.php" class="btn btn-secondary">Back to List</a>
  </form>
</div>
<?php include('../../includes/footer.php'); ?>
