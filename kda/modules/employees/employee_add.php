<?php
session_start();
include("../../config/db_connect.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

$branch_stmt = $pdo->query("SELECT id, branch_name FROM branches");
$branches = $branch_stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    // Process data here...
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Employee | KDA Microfinance</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
        }
        .card {
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.04);
        }
        .card-header {
            background: #0066cc;
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            border-radius: 12px 12px 0 0;
        }
        .form-label {
            font-weight: 500;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="card mx-auto" style="max-width: 950px;">
        <div class="card-header text-center">
            📑 নতুন এমপ্লয়ি যোগ করুন
        </div>
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <!-- Personal Information -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">নাম</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">মোবাইল</label>
                        <input type="text" name="mobile" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ইমেইল</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ব্রাঞ্চ</label>
                        <select name="branch_id" class="form-select" required>
                            <option value="">-- ব্রাঞ্চ সিলেক্ট করুন --</option>
                            <?php foreach ($branches as $branch) : ?>
                                <option value="<?= $branch['id'] ?>"><?= $branch['branch_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ডিজিগনেশন</label>
                        <input type="text" name="designation" class="form-control" required>
                    </div>

                    <!-- CTC Breakup -->
                    <h5 class="mt-4 mb-3">💰 CTC Breakup</h5>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">মাসিক CTC</label>
                        <input type="number" name="ctc" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Dev Fee %</label>
                        <input type="number" name="company_dev_fee" class="form-control" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">PTAX</label>
                        <input type="number" name="ptax" class="form-control" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">TDS</label>
                        <input type="number" name="tds" class="form-control" required>
                    </div>

                    <!-- Document Upload -->
                    <h5 class="mt-4 mb-3">📄 ডকুমেন্ট আপলোড</h5>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">পাসপোর্ট সাইজ ছবি</label>
                        <input type="file" name="photo" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">আধার কার্ড</label>
                        <input type="file" name="aadhaar" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">প্যান কার্ড</label>
                        <input type="file" name="pan" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">যোগ্যতার সার্টিফিকেট</label>
                        <input type="file" name="qualification" class="form-control" required>
                    </div>

                    <!-- Buttons -->
                    <div class="col-12 mt-3">
                        <button type="submit" name="submit" class="btn btn-success">✅ এমপ্লয়ি যোগ করুন</button>
                        <a href="employee_list.php" class="btn btn-secondary">🔙 তালিকা</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
