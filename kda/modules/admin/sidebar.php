<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['designation_id'])) {
    header("Location: ../../login.php");
    exit();
}

include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/modules/admin/admin_sidebar.php');
?>
