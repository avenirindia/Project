<?php
include('../../config/db.php');
include('../../includes/header.php');

$designation_id = $_GET['id'];

// get all permissions
$permissions = mysqli_query($conn, "SELECT * FROM permissions");

// get assigned permissions for this designation
$assigned_permissions = mysqli_query($conn, "SELECT permission_id FROM role_permissions WHERE designation_id='$designation_id'");

$assigned = [];
while($row = mysqli_fetch_assoc($assigned_permissions)) {
  $assigned[] = $row['permission_id'];
}
?>

<div class="container mt-4">
  <h4 class="mb-4">Manage Permissions for Designation ID: <?php echo $designation_id; ?></h4>

  <form method="post" action="permission_save.php">
    <input type="hidden" name="designation_id" value="<?php echo $designation_id; ?>">

    <div class="row">
      <?php while($p = mysqli_fetch_assoc($permissions)) { ?>
        <div class="col-md-4 mb-2">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permissions[]" value="<?php echo $p['id']; ?>"
            <?php if(in_array($p['id'], $assigned)) echo 'checked'; ?>>
            <label class="form-check-label"><?php echo $p['permission_name']; ?></label>
          </div>
        </div>
      <?php } ?>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Save Permissions</button>
    <a href="role_list.php" class="btn btn-secondary mt-3">Back</a>
  </form>
</div>

<?php include('../../includes/footer.php'); ?>
