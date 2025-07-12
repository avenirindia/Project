<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Debug check
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Microfinance ERP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar-brand {
      font-weight: bold;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/Project/kda/">Microfinance ERP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['user_id'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="/Project/kda/modules/admin/dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/Project/kda/logout.php">Logout</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="/Project/kda/login.php">Login</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
