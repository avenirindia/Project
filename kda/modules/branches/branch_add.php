<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Branch Code Generate
$ym = date('Ym');
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM branches WHERE DATE_FORMAT(opening_date, '%Y%m') = '$ym'");
$row = mysqli_fetch_assoc($result);
$nextNumber = 100 + $row['total'];
$newCode = "BR-$ym/$nextNumber";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Branch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #map {
            height: 250px;
            width: 100%;
        }
    </style>
</head>
<body class="bg-light">

<div class="container my-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>➕ Add New Branch</h4>
        </div>
        <div class="card-body">

            <form action="branch_add_save.php" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Branch Name</label>
                        <input type="text" name="branch_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Branch Code</label>
                        <input type="text" name="branch_code" value="<?= $newCode ?>" class="form-control" readonly>
                    </div>
                </div>

                <h5 class="mt-3">📍 Branch Address</h5>
                <div class="row mb-3">
                    <div class="col-md-6"><label>Police Station (PS)</label><input type="text" name="ps" class="form-control" required></div>
                    <div class="col-md-6"><label>District</label><input type="text" name="district" class="form-control" required></div>
                    <div class="col-md-6 mt-2"><label>State</label><input type="text" name="state" class="form-control" required></div>
                    <div class="col-md-6 mt-2"><label>Pin Code</label><input type="text" name="pincode" class="form-control" required></div>
                </div>

                <div class="mb-3">
                    <label>Opening Date</label>
                    <input type="date" name="opening_date" class="form-control" required>
                </div>

                <h5 class="mt-3">🏠 Landlord Details</h5>
                <div class="row mb-3">
                    <div class="col-md-6"><label>Name</label><input type="text" name="landlord_name" class="form-control" required></div>
                    <div class="col-md-6"><label>Father's Name</label><input type="text" name="father_name" class="form-control" required></div>
                </div>
                <div class="mb-3"><label>Address</label><textarea name="landlord_address" class="form-control" required></textarea></div>
                <div class="mb-3"><label>Mobile Number</label><input type="text" name="landlord_mobile" class="form-control" required></div>
                <div class="mb-3"><label>Land Details</label><textarea name="land_details" class="form-control" required></textarea></div>

                <h5 class="mt-3">📄 Documents</h5>
                <div class="row mb-3">
                    <div class="col-md-4"><label>Aadhaar Card</label><input type="file" name="aadhaar" class="form-control"></div>
                    <div class="col-md-4"><label>PAN Card</label><input type="file" name="pan" class="form-control"></div>
                    <div class="col-md-4"><label>Bank Passbook</label><input type="file" name="passbook" class="form-control"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><label>Tax Receipt</label><input type="file" name="tax_receipt" class="form-control"></div>
                    <div class="col-md-4"><label>Agreement Copy</label><input type="file" name="agreement_copy" class="form-control"></div>
                    <div class="col-md-4"><label>Police Intimation Letter</label><input type="file" name="police_letter" class="form-control"></div>
                </div>

                <h5 class="mt-3">💰 Rent & Utilities</h5>
                <div class="row mb-3">
                    <div class="col-md-4"><label>Rent Amount</label><input type="number" name="rent_amount" class="form-control" required></div>
                    <div class="col-md-4"><label>Rent Advance</label><input type="number" name="advance_amount" class="form-control" required></div>
                    <div class="col-md-4"><label>Rent Payment Date (1-31)</label><input type="number" name="rent_payment_date" min="1" max="31" class="form-control" required></div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6"><label>Electricity Unit Price</label><input type="number" step="0.01" name="electricity_price" class="form-control"></div>
                    <div class="col-md-6"><label>Start Unit</label><input type="number" name="start_unit" class="form-control"></div>
                </div>

                <h5 class="mt-3">🌐 Geo Location</h5>
                <div id="map"></div>
                <div class="row mt-3">
                    <div class="col-md-6"><label>Latitude</label><input type="text" name="latitude" id="latitude" class="form-control" readonly></div>
                    <div class="col-md-6"><label>Longitude</label><input type="text" name="longitude" id="longitude" class="form-control" readonly></div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">➕ Add Branch</button>
                    <a href="branch_list.php" class="btn btn-secondary">🔙 Back</a>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: {lat: 22.5726, lng: 88.3639}  // Kolkata Center Point
        });

        var marker = new google.maps.Marker({
            position: {lat: 22.5726, lng: 88.3639},
            map: map,
            draggable: true
        });

        document.getElementById('latitude').value = marker.getPosition().lat();
        document.getElementById('longitude').value = marker.getPosition().lng();

        google.maps.event.addListener(marker, 'dragend', function () {
            document.getElementById('latitude').value = marker.getPosition().lat();
            document.getElementById('longitude').value = marker.getPosition().lng();
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIV5ATUvb1UVaDw32lhTZqbn2v51qEMkU&callback=initMap" async defer></script>

</body>
</html>
