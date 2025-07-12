<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>KDA ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            font-size: 22px;
            letter-spacing: 0.5px;
        }
        .nav-link {
            font-size: 16px;
        }
        .nav-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">KDA ERP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">🏠 Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../modules/employees/employee_list.php">👥 Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../modules/branches/branch_list.php">🏢 Branches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="../../logout.php">🚪 Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
