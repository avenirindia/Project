<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Fetch total branches
$branch_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM branches");
$branch_data = mysqli_fetch_assoc($branch_result);
$total_branches = $branch_data['total'];

// Fetch total employees
$employee_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM employees");
$employee_data = mysqli_fetch_assoc($employee_result);
$total_employees = $employee_data['total'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | KDA Microfinance ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
        }
        .nav-link {
            color: #fff;
        }
        .sidebar {
            background-color: #343a40;
            min-height: 100vh;
            padding: 20px;
        }
        .sidebar h4 {
            color: #fff;
            margin-bottom: 30px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h4>KDA ERP</h4>
            <a href="dashboard.php" class="nav-link">📊 Dashboard</a>
            <a href="../employees/employee_list.php" class="nav-link">👥 Employees</a>
            <a href="../branches/branch_list.php" class="nav-link">🏢 Branches</a>
            <a href="../../logout.php" class="nav-link">🚪 Logout</a>
        </div>

        <!-- Main content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">📊 Welcome to KDA Microfinance ERP Dashboard</h2>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card text-white bg-primary p-4">
                        <h5>Total Branches</h5>
                        <h2><?php echo $total_branches; ?></h2>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card text-white bg-success p-4">
                        <h5>Total Employees</h5>
                        <h2><?php echo $total_employees; ?></h2>
                    </div>
                </div>
            </div>

            <div class="footer mt-5">
                © 2025 KDA Microfinance ERP | Developed by Your Company
            </div>
        </div>
    </div>
</div>
</body>
</html>
