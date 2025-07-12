<?php
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Fetch active departments
$dept_result = mysqli_query($conn, "SELECT * FROM departments WHERE status='Active' ORDER BY id ASC");
?>
<div class="bg-dark text-white p-3" style="min-height:100vh;">
    <h5 class="mb-4">📊 KDA ERP</h5>
    <a href="dashboard.php" class="text-white d-block mb-2">🏠 Dashboard</a>

    <h6 class="mt-4">📂 Departments</h6>
    <?php while($dept = mysqli_fetch_assoc($dept_result)) { ?>
        <a href="#" class="text-white d-block mb-2">➤ <?php echo $dept['department_name']; ?></a>
    <?php } ?>

    <hr class="bg-light">
    <a href="company_info_edit.php" class="text-white d-block mb-2">⚙️ Company Info</a>
    <a href="../../logout.php" class="text-white d-block mb-2">🚪 Logout</a>
</div>
