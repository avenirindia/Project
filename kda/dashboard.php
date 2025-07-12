<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Total Branches
$branch_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM branches");
$branch_data = mysqli_fetch_assoc($branch_result);
$total_branches = $branch_data['total'] ?? 0;

// Total Employees
$emp_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM employees");
$emp_data = mysqli_fetch_assoc($emp_result);
$total_employees = $emp_data['total'] ?? 0;

// Dummy Data (pending real tables)
$today_collection = 250000;
$today_leave = 3;
$overdue_loans = 14;
$loan_pending = 5;
$loan_approved = 18;
$loan_sanctioned = 16;
$loan_disbursed = 13;
$best_branch = "Kolkata Branch";
$lowest_branch = "Egra Branch";
$notifications = 7;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashb
