<?php
include '../../config/db_connect.php';

// Designation Chart এর list
$designations = ['Branch Manager', 'Loan Officer', 'Accountant', 'Field Executive', 'Peon', 'Driver'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_code = "EMP" . time();
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $aadhaar_no = $_POST['aadhaar_no'];
    $pan_no = $_POST['pan_no'];
    $branch_id = $_POST['branch_id'];
    $designation = $_POST['designation'];
    $joining_date = $_POST['joining_date'];

    $stmt = $pdo->prepare("INSERT INTO employees (employee_code, name, mobile, email, aadhaar_no, pan_no, branch_id, designation, joining_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$emp_code, $name, $mobile, $email, $aadhaar_no, $pan_no, $branch_id, $designation, $joining_date]);

    header("Location: employee_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h3 class="mb-4">Employee Application Form</h3>

    <form method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Employee Name</label>
                <input type="text" name="name" required class="form-control">
            </div>
            <div class="col-md-6">
                <label>Father's Name</label>
                <input type="text" name="father_name" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label>Mobile</label>
                <input type="text" name="mobile" required class="form-control">
            </div>
            <div class="col-md-4">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Aadhaar No</label>
                <input type="text" name="aadhaar_no" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label>PAN No</label>
                <input type="text" name="pan_no" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Branch ID</label>
                <input type="number" name="branch_id" required class="form-control">
            </div>
            <div class="col-md-4">
                <label>Designation</label>
                <select name="designation" required class="form-control">
                    <option value="">--Select--</option>
                    <?php foreach($designations as $desig): ?>
                        <option value="<?php echo $desig; ?>"><?php echo $desig; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Joining Date</label>
            <input type="date" name="joining_date" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Add Employee</button>
        <a href="employee_list.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
