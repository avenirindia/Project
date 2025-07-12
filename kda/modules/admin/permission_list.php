<?php
include("../../config/db.php");

// Fetch permissions
$query = "SELECT * FROM permissions ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>

$permissions = $pdo->query("SELECT * FROM permissions")->fetchAll();
?>
<table border="1">
<tr><th>ID</th><th>Permission</th></tr>
<?php foreach($permissions as $p): ?>
<tr><td><?= $p['id'] ?></td><td><?= $p['permission_name'] ?></td></tr>
<?php endforeach ?>
</table>

