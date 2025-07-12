<?php
include '../../config/db_connect.php';

if (!isset($_GET['id'])) {
  die("Invalid Request! No ID passed.");
}

$id = $_GET['id'];

$designation = $pdo->prepare("SELECT * FROM designations WHERE id=?");
$designation->execute([$id]);
$data = $designation->fetch();

if (!$data) {
  die("Designation not found for this ID.");
}
?>
<?php
include '../../config/db_connect.php';
$id = $_GET['id'];

$designation = $pdo->prepare("SELECT * FROM designations WHERE id=?");
$designation->execute([$id]);
$data = $designation->fetch();

$permissions = $pdo->query("SELECT * FROM permissions ORDER BY permission_name ASC")->fetchAll();

$assigned = $pdo->prepare("SELECT permission_id FROM designation_permissions WHERE designation_id=?");
$assigned->execute([$id]);
$assigned_permissions = $assigned->fetchAll(PDO::FETCH_COLUMN);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $status = $_POST['status'];
  $pdo->prepare("UPDATE designations SET title=?, status=? WHERE id=?")->execute([$title, $status, $id]);

  $pdo->prepare("DELETE FROM designation_permissions WHERE designation_id=?")->execute([$id]);

  if (!empty($_POST['permissions'])) {
    foreach ($_POST['permissions'] as $pid) {
      $pdo->prepare("INSERT INTO designation_permissions (designation_id, permission_id) VALUES (?, ?)")->execute([$id, $pid]);
    }
  }

  header("Location: designation_list.php");
  exit;
}
?>

<form method="POST">
<input type="text" name="title" value="<?= $data['title'] ?>" required><br>
<select name="status">
  <option value="1" <?= $data['status'] ? 'selected' : '' ?>>Active</option>
  <option value="0" <?= !$data['status'] ? 'selected' : '' ?>>Inactive</option>
</select><br>

<h5>Permissions:</h5>
<?php foreach($permissions as $p): ?>
<label>
  <input type="checkbox" name="permissions[]" value="<?= $p['id'] ?>" 
  <?= in_array($p['id'], $assigned_permissions) ? 'checked' : '' ?>> <?= $p['permission_name'] ?>
</label><br>
<?php endforeach ?>

<button type="submit">Update</button>
</form>
