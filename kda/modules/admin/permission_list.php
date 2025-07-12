<?php
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Permission list fetch
$result = mysqli_query($conn, "SELECT * FROM permissions");
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Permission Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['permission_name']; ?></td>
            <td>
                <a href="permission_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="permission_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
