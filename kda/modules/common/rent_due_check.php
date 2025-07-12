<?php
$today = date('j');

// Check today’s rent due branches
$query = "SELECT * FROM branches WHERE rent_payment_date = $today";
$result = mysqli_query($conn, $query);

while ($branch = mysqli_fetch_assoc($result)) {
    $msg = "📢 Rent Payment Due Today for Branch: " . $branch['branch_name'];

    // Check if this message already inserted today for Accounts (11)
    $check1 = mysqli_query($conn, "SELECT id FROM notifications 
               WHERE message = '$msg' AND target_designation_id = 11 AND DATE(created_at) = CURDATE()");
    if (mysqli_num_rows($check1) == 0) {
        mysqli_query($conn, "INSERT INTO notifications (message, target_designation_id) 
              VALUES ('$msg', 11)");
    }

    // Check if this message already inserted today for Admin (1)
    $check2 = mysqli_query($conn, "SELECT id FROM notifications 
               WHERE message = '$msg' AND target_designation_id = 1 AND DATE(created_at) = CURDATE()");
    if (mysqli_num_rows($check2) == 0) {
        mysqli_query($conn, "INSERT INTO notifications (message, target_designation_id) 
              VALUES ('$msg', 1)");
    }
}
?>
