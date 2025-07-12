<?php
include '../../config/db_connect.php';
$permissions = $pdo->query("SELECT * FROM permissions ORDER BY permission_name ASC")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $status = $_POST['status'];
  $pdo->prepare("INSERT INTO designations (title, status) VALUES (?, ?)")->execute([$title, $status]);
  $designation_id = $pdo->lastInsertId();

  if (!empty($_POST['permissions'])) {
    foreach ($_POST['permissions'] as $pid) {
      $pdo->prepare("INSERT INTO designation_permissions (designation_id, permission_id) VALUES (?, ?)")->execute([$designation_id, $pid]);
    }
  }

  header("Location: designation_list.php");
  exit;
}
?>

<form method="POST">
<input type="text" name="title" required placeholder="Designation Title"><br>
<select name="status"><option value="1">Active</option><option value="0">Inactive</option></select><br>

<h5>Permissions:</h5>
<?php foreach($permissions as $p): ?>
<label><input type="checkbox" name="permissions[]" value="<?= $p['id'] ?>"> <?= $p['permission_name'] ?></label><br>
<?php endforeach ?>

<button type="submit">Save</button>
</form>
