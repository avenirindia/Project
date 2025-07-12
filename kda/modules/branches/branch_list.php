<?php
session_start();
include('../config/db.php');
?>

<div class="container my-4">
  <h4 class="mb-3">🏢 Branch List</h4>

  <a href="branch_add.php" class="btn btn-success mb-3">➕ Add New Branch</a>

  <table class="table table-bordered table-hover align-middle shadow-sm">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Branch Code</th>
        <th>Branch Name</th>
        <th>District</th>
        <th>State</th>
        <th>Rent Amount (₹)</th>
        <th>Rent Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = mysqli_query($conn, "SELECT * FROM branches ORDER BY id DESC");
      $sl = 1;
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <td>{$sl}</td>
                  <td>{$row['branch_code']}</td>
                  <td>{$row['branch_name']}</td>
                  <td>{$row['district']}</td>
                  <td>{$row['state']}</td>
                  <td>{$row['rent_amount']}</td>
                  <td>{$row['rent_payment_date']}</td>
                  <td>
                    <a href='branch_view.php?id={$row['id']}' class='btn btn-info btn-sm'>View</a>
                    <a href='branch_edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='branch_delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this branch?');\">Delete</a>
                  </td>
                </tr>";
          $sl++;
      }
      ?>
    </tbody>
  </table>
</div>
