<?php
require_once "../config/dbcon.php";
include "../config/dashboardplugin.php";

// Get sorting parameter
$sort = (isset($_GET['sort']) && strtolower($_GET['sort']) === 'asc') ? 'ASC' : 'DESC';

// You can add filters here if needed (like by department), similar to year/course in student
$sql = "SELECT * FROM employee ORDER BY employee_date $sort";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo '<div style="overflow-x:auto;"><table class="table table-bordered table-striped">';
    echo '<thead class="table-primary"><tr>
            <th>Name</th>
            <th>Employee ID</th>
            <th>Position</th>
            <th>Department</th>
            <th>Address</th>
            <th>Emergency Contact</th>
            <th>Date</th>
            <th>Actions</th>
          </tr></thead><tbody>';

    while ($row = $result->fetch_assoc()) {
        $id = $row['e_id']; // Ensure this is your primary key
        $fullName = "{$row['employee_surname']}, {$row['employee_fname']} {$row['employee_mi']} {$row['employee_ext']}";
        $emergency = "{$row['employee_emergency_name']} ({$row['employee_relation']}) - {$row['employee_contact']}";

        echo "<tr>
                <td>{$fullName}</td>
                <td>{$row['employee_id']}</td>
                <td>{$row['employee_position']}</td>
                <td>{$row['employee_department']}</td>
                <td>{$row['employee_address']}</td>
                <td>{$emergency}</td>
                <td>{$row['employee_date']}</td>
                <td>
                  <div class='action-buttons'>
                    <button class='btn btn-sm btn-primary emp-edit-btn' data-id='$id'>
                      <i class='fas fa-edit'></i>
                    </button>
                    <button class='btn btn-sm btn-danger emp-delete-btn' data-id='$id'>
                      <i class='fas fa-trash'></i>
                    </button>
                  </div>
                </td>
              </tr>";
    }

    echo '</tbody></table></div>';
} else {
    echo "<p>No employee records found.</p>";
}

$conn->close();
?>
