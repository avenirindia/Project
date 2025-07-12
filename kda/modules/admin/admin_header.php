<?php
// session_start(); // যদি দরকার হয় সেশন
include '../../config/db.php'; // ডাটাবেস কানেকশন

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KDA Microfinance ERP Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional Custom CSS -->
    <link href="../../assets/css/style.css" rel="stylesheet">

    <!-- Font Awesome (icon চাইলে) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-3">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">KDA ERP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarAdmin">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="employee_list.php">Employees</a></li>
                    <li class="nav-item"><a class="nav-link" href="branch_list.php">Branches</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="container mt-4">
