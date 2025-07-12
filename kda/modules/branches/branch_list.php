<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');
?>

<?php include('../admin/admin_header.php'); ?>

<div class="container mt-4">
    <h4 class="mb-4">🏢 Branch List</h4>

    <!-- Success Alert -->
    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ Branch deleted successfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="branch_add.php" class="btn btn-primary">➕ Add New Branch</a>
    </div>

    <table class="table table-bordered table-hover">
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
            while ($branch = mysqli_fetch_assoc($result)) :
            ?>
            <tr>
                <td><?= $sl++; ?></td>
                <td><?= $branch['branch_code']; ?></td>
                <td><?= $branch['branch_name']; ?></td>
                <td><?= $branch['district']; ?></td>
                <td><?= $branch['state']; ?></td>
                <td>₹<?= number_format($branch['rent_amount']); ?></td>
                <td><?= $branch['rent_payment_date']; ?> তারিখ</td>
                <td>
                    <a href="branch_view.php?id=<?= $branch['id']; ?>" class="btn btn-sm btn-info">👁️ View</a>
                    <a href="branch_delete.php?id=<?= $branch['id']; ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Are you sure to delete this branch?');">❌ Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include('../admin/admin_footer.php'); ?>
