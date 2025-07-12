<?php include('../../config/db.php'); ?>
<?php include('../../includes/header.php'); ?>
<div class="container mt-4">
  <h4 class="mb-4">Designation List</h4>
  <a href="role_add.php" class="btn btn-success mb-3">+ Add New Designation</a>
  <?php
  if(isset($_GET['msg'])) {
    echo "<div class='alert alert-info'>".$_GET['msg']."</div>";
  }
  ?>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Designation Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $res = mysqli_query($conn, "SELECT * FROM designations");
      $i = 1;
      while($row = mysqli_fetch_assoc($res)){
        echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>".$row['designation_name']."</td>";
        echo "<td>
          <a href='permission_manage.php?id=".$row['id']."' class='btn btn-primary btn-sm'>Manage Permissions</a>
        </td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>
<?php include('../../includes/footer.php'); ?>
