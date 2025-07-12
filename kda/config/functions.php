<?php
function hasPermission($designation_id, $permission_name, $conn) {
    $query = "SELECT rp.id FROM role_permissions rp
              JOIN permissions p ON rp.permission_id = p.id
              WHERE rp.designation_id = $designation_id AND p.permission_name = '$permission_name'";
    $result = mysqli_query($conn, $query);
    return (mysqli_num_rows($result) > 0);
}
?>
