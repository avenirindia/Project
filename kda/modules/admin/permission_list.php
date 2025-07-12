<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Fetch all permissions
$result = mysqli_query($conn, "SELECT * FROM permissions ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Permission List</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>🔐 Permission List</h4>
        <a href="permission_add.php" class="btn btn-primary">➕ Add New Permission</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Permission Name</th>
                <th style="width:180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['permission_name']; ?></td>
                <td>
                    <a href="permission_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                    <a href="permission_delete.php?id=<?php echo $row['id']; ?>" 
                       class="btn btn-danger btn-sm" 
                       onclick="return confirm('Are you sure you want to delete this permission?');">
                       🗑️ Delete
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">← Back to Dashboard</a>
</div>

</body>
</html>
