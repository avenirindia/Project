<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// সেশন চেক
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

// ডেটা লোড
$stmt = $pdo->query("SELECT * FROM company_info LIMIT 1");
$company = $stmt->fetch();

// ফর্ম সাবমিট হলে
if (isset($_POST['update'])) {
    $name     = $_POST['name'];
    $address  = $_POST['address'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];

    try {
        $sql = "UPDATE company_info SET name=:name, address=:address, email=:email, phone=:phone";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'    => $name,
            ':address' => $address,
            ':email'   => $email,
            ':phone'   => $phone
        ]);
        $success = "✅ কোম্পানির তথ্য আপডেট সফল হয়েছে।";
        // রিলোড করে আপডেট দেখানোর জন্য
        $company = ['name'=>$name, 'address'=>$address, 'email'=>$email, 'phone'=>$phone];
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Company Info | KDA Microfinance</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .card-header { background: #0066cc; color: #fff; }
        .form-label { font-weight: 500; }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="card mx-auto" style="max-width: 700px;">
        <div class="card-header">
            🏢 কোম্পানির তথ্য আপডেট
        </div>
        <div class="card-body">
            <?php if (isset($success)) : ?>
                <div class="alert alert-success"><?= $success; ?></div>
            <?php elseif (isset($error)) : ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">কোম্পানির নাম</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($company['name']) ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">ঠিকানা</label>
                    <textarea name="address" class="form-control" rows="3" required><?= htmlspecialchars($company['address']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">ইমেইল</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($company['email']) ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">মোবাইল নম্বর</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($company['phone']) ?>" class="form-control" required>
                </div>

                <button type="submit" name="update" class="btn btn-success">✅ আপডেট করুন</button>
                <a href="../../dashboard.php" class="btn btn-secondary">🔙 ড্যাশবোর্ড</a>
            </form>
        </div>
    </div>
</div>

<script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
