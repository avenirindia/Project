<?php
session_start();
include("../../config/db_connect.php");
include("employee_dao.php");

// সেশন চেক
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

// DAO অবজেক্ট
$empDAO = new EmployeeDAO($pdo);
$employees = $empDAO->getAllEmployees();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List | KDA Microfinance</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
        }
        .table th {
            background: #0066cc;
            color: #fff;
        }
        .btn-sm {
            padding: 4px 8px;
        }
    </style>
</head>
<body>

<div class="container py-4">
    <h4 class="mb-3">👥 এমপ্লয়ি তালিকা</h4>

    <table class="table table-bordered table-hover table-sm align-middle">
        <thead>
            <tr>
                <th>আইডি</th>
                <th>নাম</th>
                <th>মোবাইল</th>
                <th>ডিজিগনেশন</th>
                <th>ব্রাঞ্চ</th>
                <th>অ্যাকশন</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $emp) : ?>
                <tr>
                    <td><?= $emp['id'] ?></td>
                    <td><?= htmlspecialchars($emp['name']) ?></td>
                    <td><?= $emp['mobile'] ?></td>
                    <td><?= $emp['designation'] ?></td>
                    <td>
                        <?php
                        $branch = $pdo->query("SELECT branch_name FROM branches WHERE id={$emp['branch_id']}")->fetch();
                        echo $branch ? $branch['branch_name'] : 'N/A';
                        ?>
                    </td>
                    <td>
                        <a href="employee_view.php?id=<?= $emp['id'] ?>" class="btn btn-primary btn-sm">ভিউ</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="employee_add.php" class="btn btn-success mt-3">+ নতুন এমপ্লয়ি যোগ করুন</a>

</div>

<script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
