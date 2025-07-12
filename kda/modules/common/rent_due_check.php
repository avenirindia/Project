<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// আজকের তারিখ
$today = date('j');

// আজকে যেসব ব্রাঞ্চের ভাড়া দেওয়ার তারিখ সেই লিস্ট
$query = "SELECT * FROM branches WHERE rent_payment_date = $today";
$result = mysqli_query($conn, $query);

// যদি আজকের জন্য ডিউ থাকে
while ($branch = mysqli_fetch_assoc($result)) {
    $msg = "📢 Rent Payment Due Today for Branch: " . $branch['branch_name'];

    // Accounts Access = 11
    mysqli_query($conn, "INSERT INTO notifications (message, target_designation_id) 
              VALUES ('$msg', 11)");

    // Admin = 1
    mysqli_query($conn, "INSERT INTO notifications (message, target_designation_id) 
              VALUES ('$msg', 1)");
}
?>
