<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'config/db_connect.php';

// Today Selling (Service)
$today = date('Y-m-d');
$stmt = $pdo->prepare("SELECT SUM(sale_amount) AS total FROM services WHERE sale_date=?");
$stmt->execute([$today]);
$selling = $stmt->fetch();
$total_selling = $selling['total'] ?? 0;

// Total Branch Running
$stmt = $pdo->query("SELECT COUNT(*) AS total FROM branches WHERE status=1");
$branch = $stmt->fetch();

// Today Leave Application (Amount)
$stmt = $pdo->prepare("SELECT SUM(leave_amount) AS total FROM leave_applications WHERE leave_date=? AND status='Approved'");
$stmt->execute([$today]);
$leave = $stmt->fetch();
$total_leave = $leave['total'] ?? 0;

// Today Loan Collection
$stmt = $pdo->prepare("SELECT SUM(amount_paid) AS total FROM loan_collections WHERE collection_date=?");
$stmt->execute([$today]);
$collection = $stmt->fetch();
$total_collection = $collection['total'] ?? 0;

// Over Due Loan Count
$stmt = $pdo->query("SELECT COUNT(*) AS total FROM loans WHERE status='Overdue'");
$overdue = $stmt->fetch();

// Loan Approval Pending
$stmt = $pdo->query("SELECT COUNT(*) AS total FROM loans WHERE status='Pending'");
$pending = $stmt->fetch();

// Approved Loan
$stmt = $pdo->query("SELECT COUNT(*) AS total FROM loans WHERE status='Approved'");
$approved = $stmt->fetch();

// Sanctioned Loan
$stmt = $pdo->query("SELECT COUNT(*) AS total FROM loans WHERE status='Sanctioned'");
$sanctioned = $stmt->fetch();

// Loan Disbursement
$stmt = $pdo->query("SELECT COUNT(*) AS total FROM loans WHERE status='Disbursed'");
$disbursed = $stmt->fetch();

// Best Loan Disbursement Branch
$stmt = $pdo->query("SELECT branch_id, COUNT(*) AS total FROM loans WHERE status='Disbursed' GROUP BY branch_id ORDER BY total DESC LIMIT 1");
$best_branch = $stmt->fetch();

// Lowest Loan Disbursement Branch
$stmt = $pdo->query("SELECT branch_id, COUNT(*) AS total FROM loans WHERE status='Disbursed' GROUP BY branch_id ORDER BY total ASC LIMIT 1");
$low_branch = $stmt->fetch();

// Notification New Branch (Today Added)
$stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM branches WHERE DATE(created_at)=?");
$stmt->execute([$today]);
$new_branch = $stmt->fetch();

// All Pending Approval List
$stmt = $pdo->query("SELECT COUNT(*) AS total FROM loans WHERE status='Pending'");
$all_pending = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>KDA Microfinance - Dashboard</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h3 class="mb-4">Welcome, <?php echo $_SESSION['username']; ?>!</h3>
    <a href="logout.php" class="btn btn-danger float-end mb-4">Logout</a>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5>Today Selling (₹)</h5>
                    <h3><?php echo number_format($total_selling, 2); ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5>Total Branch Running</h5>
                    <h3><?php echo $branch['total']; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <h5>Today Leave (₹)</h5>
                    <h3><?php echo number_format($total_leave, 2); ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger shadow">
                <div class="card-body">
                    <h5>Today Loan Collection (₹)</h5>
                    <h3><?php echo number_format($total_collection, 2); ?></h3>
                </div>
            </div>
        </div>

        <!-- 2nd Row -->
        <div class="col-md-3">
            <div class="card bg-secondary text-white shadow">
                <div class="card-body">
                    <h5>Overdue Loans</h5>
                    <h3><?php echo $overdue['total']; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <h5>Loan Approval Pending</h5>
                    <h3><?php echo $pending['total']; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5>Approved Loans</h5>
                    <h3><?php echo $approved['total']; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body">
                    <h5>Sanctioned Loans</h5>
                    <h3><?php echo $sanctioned['total']; ?></h3>
                </div>
            </div>
        </div>

        <!-- 3rd Row -->
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h5>Loan Disbursement</h5>
                    <h3><?php echo $disbursed['total']; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5>Best Disbursing Branch ID</h5>
                    <h3><?php echo $best_branch['branch_id'] ?? 'N/A'; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <h5>Lowest Disbursing Branch ID</h5>
                    <h3><?php echo $low_branch['branch_id'] ?? 'N/A'; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-dark text-white shadow">
                <div class="card-body">
                    <h5>New Branch Today</h5>
                    <h3><?php echo $new_branch['total']; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <h5>Pending Approvals</h5>
                    <h3><?php echo $all_pending['total']; ?></h3>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
