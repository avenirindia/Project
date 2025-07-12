<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// ID না থাকলে বের করে দাও
if(!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>Invalid Request!</div>";
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM branches WHERE id=$id");
$branch = mysqli_fetch_assoc($result);

if(!$branch){
    echo "<div class='alert alert-danger'>Branch not found!</div>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Branch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIV5ATUvb1UVaDw32lhTZqbn2v51qEMkU&libraries=places"></script>
    <script>
        function initMap() {
            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input);
        }
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
</head>
<body class="bg-light">

<div class="container py-4">
    <h4 class="mb-4">✏️ Edit Branch</h4>

    <form method="POST" action="branch_edit_save.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $branch['id'] ?>">

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Branch Name</label>
                <input type="text" name="branch_name" value="<?= $branch['branch_name'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Branch Code</label>
                <input type="text" value="<?= $branch['branch_code'] ?>" class="form-control" readonly>
            </div>
        </div>

        <h6 class="mt-3">📍 Address Details</h6>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Police Station (PS)</label>
                <input type="text" name="ps" value="<?= $branch['ps'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>District</label>
                <input type="text" name="district" value="<?= $branch['district'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6 mt-2">
                <label>State</label>
                <input type="text" name="state" value="<?= $branch['state'] ?>" class="form-control" required>
            </div>
            <div class="col-md-6 mt-2">
                <label>Pin Code</label>
                <input type="text" name="pin" value="<?= $branch['pin'] ?>" class="form-control" required>
            </div>
            <div class="col-md-12 mt-2">
                <label>Location (Geo Tag)</label>
                <input type="text" name="location" id="location" value="<?= $branch['location'] ?>" class="form-control">
            </div>
        </div>

        <h6 class="mt-3">📑 Branch & Landlord Details</h6>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Opening Date</label>
                <input type="date" name="opening_date" value="<?= $branch['opening_date'] ?>" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Landlord Name</label>
                <input type="text" name="landlord_name" value="<?= $branch['landlord_name'] ?>" class="form-control">
            </div>
            <div class="col-md-6 mt-2">
                <label>Father's Name</label>
                <input type="text" name="father_name" value="<?= $branch['father_name'] ?>" class="form-control">
            </div>
            <div class="col-md-6 mt-2">
                <label>Landlord Address</label>
                <input type="text" name="landlord_address" value="<?= $branch['landlord_address'] ?>" class="form-control">
            </div>
            <div class="col-md-6 mt-2">
                <label>Mobile No</label>
                <input type="text" name="landlord_mobile" value="<?= $branch['landlord_mobile'] ?>" class="form-control">
            </div>
            <div class="col-md-6 mt-2">
                <label>Land Details</label>
                <input type="text" name="land_details" value="<?= $branch['land_details'] ?>" class="form-control">
            </div>
        </div>

        <h6 class="mt-3">💰 Rent & Documents</h6>
        <div class="row mb-3">
            <div class="col-md-4">
                <label>Rent Amount (₹)</label>
                <input type="number" name="rent_amount" value="<?= $branch['rent_amount'] ?>" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Rent Advance (₹)</label>
                <input type="number" name="rent_advance" value="<?= $branch['rent_advance'] ?>" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Rent Payment Date (1-31)</label>
                <input type="number" name="rent_payment_date" value="<?= $branch['rent_payment_date'] ?>" class="form-control">
            </div>
            <div class="col-md-4 mt-2">
                <label>Electricity Unit Price (₹)</label>
                <input type="number" name="electricity_unit_price" value="<?= $branch['electricity_unit_price'] ?>" class="form-control">
            </div>
            <div class="col-md-4 mt-2">
                <label>Start Unit</label>
                <input type="number" name="start_unit" value="<?= $branch['start_unit'] ?>" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">💾 Update Branch</button>
        <a href="branch_list.php" class="btn btn-secondary">Back</a>
    </form>
</div>

</body>
</html>
