<?php
include '../../config/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$designations = ['Branch Manager', 'Loan Officer', 'Accountant', 'Field Executive', 'Peon', 'Driver'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_code = "EMP" . time();
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $aadhaar_no = $_POST['aadhaar_no'];
    $pan_no = $_POST['pan_no'];
    $branch_id = $_POST['branch_id'];
    $designation = $_POST['designation'];
    $joining_date = $_POST['joining_date'];

    // Upload Files
    $photo = 'uploads/photos/' . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], '../../' . $photo);

    $aadhaar_doc = 'uploads/documents/' . $_FILES['aadhaar_doc']['name'];
    move_uploaded_file($_FILES['aadhaar_doc']['tmp_name'], '../../' . $aadhaar_doc);

    $pan_doc = 'uploads/documents/' . $_FILES['pan_doc']['name'];
    move_uploaded_file($_FILES['pan_doc']['tmp_name'], '../../' . $pan_doc);

    $qualification_doc = 'uploads/documents/' . $_FILES['qualification_doc']['name'];
    move_uploaded_file($_FILES['qualification_doc']['tmp_name'], '../../' . $qualification_doc);

    // CTC Breakdown
    $basic = $_POST['basic'];
    $hra = $_POST['hra'];
    $da = $_POST['da'];
    $ta = $_POST['ta'];
    $esic = $_POST['esic'];
    $epfo = $_POST['epfo'];
    $ptax = $_POST['ptax'];
    $tds = $_POST['tds'];
    $dev_fee = $_POST['dev_fee'];

    $net_salary = ($basic + $hra + $da + $ta) - ($esic + $epfo + $ptax + $tds + $dev_fee);

    $stmt = $pdo->prepare("INSERT INTO employees 
        (employee_code, name, mobile, aadhaar_no, pan_no, branch_id, designation, joining_date, 
        photo, aadhaar_doc, pan_doc, qualification_doc, basic, hra, da, ta, esic, epfo, ptax, tds, dev_fee, net_salary) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([$emp_code, $name, $mobile, $aadhaar_no, $pan_no, $branch_id, $designation, $joining_date, 
        $photo, $aadhaar_doc, $pan_doc, $qualification_doc, $basic, $hra, $da, $ta, $esic, $epfo, $ptax, $tds, $dev_fee, $net_salary]);

    header("Location: employee_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h4 class="mb-4">📝 New Employee Application with CTC</h4>

        <form method="POST" enctype="multipart/form-data">

            <!-- Personal Details -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Employee Name</label>
                    <input type="text" name="name" required class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Mobile</label>
                    <input type="text" name="mobile" required class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Branch ID</label>
                    <input type="number" name="branch_id" required class="form-control">
                </div>
            </div>

            <!-- KYC Upload -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Aadhaar No</label>
                    <input type="text" name="aadhaar_no" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>PAN No</label>
                    <input type="text" name="pan_no" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Photo</label>
                    <input type="file" name="photo" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Qualification Certificate</label>
                    <input type="file" name="qualification_doc" class="form-control">
                </div>
            </div>

            <!-- Docs Upload -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Aadhaar Upload</label>
                    <input type="file" name="aadhaar_doc" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>PAN Upload</label>
                    <input type="file" name="pan_doc" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Designation</label>
                    <select name="designation" class="form-select">
                        <?php foreach($designations as $d) echo "<option>$d</option>"; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label>Joining Date</label>
                <input type="date" name="joining_date" class="form-control">
            </div>

            <!-- CTC Breakup -->
            <h5 class="mt-4">💰 CTC Breakup</h5>
            <div class="row mb-3">
                <?php 
                $fields = ['basic','hra','da','ta','esic','epfo','ptax','tds','dev_fee'];
                foreach ($fields as $f): ?>
                <div class="col-md-3">
                    <label><?php echo strtoupper($f); ?></label>
                    <input type="number" name="<?php echo $f; ?>" step="0.01" class="form-control">
                </div>
                <?php endforeach ?>
            </div>

            <button type="submit" class="btn btn-primary">➕ Add Employee</button>
            <a href="employee_list.php" class="btn btn-secondary">← Back</a>
        </form>
    </div>
</div>

</body>
</html>
