<?php
session_start();
include("../../config/db_connect.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->execute([$id]);
$emp = $stmt->fetch();

if (!$emp) {
    echo "ডেটা পাওয়া যায়নি।";
    exit();
}

$branch = $pdo->query("SELECT branch_name FROM branches WHERE id={$emp['branch_id']}")->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Details | KDA Microfinance</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .card-header { background: #0066cc; color: #fff; }
        .label { font-weight: 500; }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="card">
        <div class="card-header">
            📋 এমপ্লয়ি ডিটেইলস: <?= htmlspecialchars($emp['name']) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <img src="../../uploads/employee_photos/<?= $emp['photo'] ?>" class="img-fluid rounded border" alt="Photo">
                </div>
                <div class="col-md-8">
                    <p><span class="label">মোবাইল:</span> <?= $emp['mobile'] ?></p>
                    <p><span class="label">ইমেইল:</span> <?= $emp['email'] ?></p>
                    <p><span class="label">ডিজিগনেশন:</span> <?= $emp['designation'] ?></p>
                    <p><span class="label">ব্রাঞ্চ:</span> <?= $branch ? $branch['branch_name'] : 'N/A' ?></p>
                    <p><span class="label">CTC:</span> ₹<?= $emp['ctc'] ?> / মাস</p>
                    <p><span class="label">Dev Fee %:</span> <?= $emp['company_dev_fee'] ?>%</p>
                    <p><span class="label">PTAX:</span> ₹<?= $emp['ptax'] ?></p>
                    <p><span class="label">TDS:</span> ₹<?= $emp['tds'] ?></p>
                    <hr>
                    <p><span class="label">আধার কার্ড:</span> 
                        <a href="../../uploads/documents/<?= $emp['aadhaar'] ?>" target="_blank">ডাউনলোড</a></p>
                    <p><span class="label">প্যান কার্ড:</span> 
                        <a href="../../uploads/documents/<?= $emp['pan'] ?>" target="_blank">ডাউনলোড</a></p>
                    <p><span class="label">যোগ্যতার সার্টিফিকেট:</span> 
                        <a href="../../uploads/documents/<?= $emp['qualification_certificate'] ?>" target="_blank">ডাউনলোড</a></p>
                </div>
            </div>
        </div>
    </div>

    <a href="employee_list.php" class="btn btn-secondary mt-3">🔙 তালিকা</a>
</div>

<script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
