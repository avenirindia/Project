<?php
include '../../config/db.php'; // your DB config

// Fetch permissions
$query = "SELECT * FROM permissions ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Permission List</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Permission List</h2>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Permission</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['permission_name']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No permissions found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
