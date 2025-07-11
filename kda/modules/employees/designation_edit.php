<?php
include '../../config/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM designations WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $status = $_POST['status'];

  $update = $pdo->prepare("UPDATE designations SET title=?, status=? WHERE id=?");
  $update->execute([$title, $status, $id]);

  header("Location: designation_list.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Designation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow p-4">
    <h4 class="mb-3">✏️ Edit Designation</h4>

    <form method="POST">
      <div class="mb-3">
        <label>Designation Title</label>
        <input type="text" name="title" value="<?php echo $data['title']; ?>" required class="form-control">
      </div>

      <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
          <option value="1" <?php if($data['status']==1) echo "selected"; ?>>Active</option>
          <option value="0" <?php if($data['status']==0) echo "selected"; ?>>Inactive</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
      <a href="designation_list.php" class="btn btn-secondary">← Back</a>
    </form>
  </div>
</div>

</body>
</html>
