<?php
require_once "../config/dbcon.php";
include "../config/dashboardplugin.php";

// Get filters from the URL
$year = isset($_GET['year']) ? $_GET['year'] : '';
$course = isset($_GET['course']) ? $_GET['course'] : '';
$sort = isset($_GET['sort']) && strtolower($_GET['sort']) === 'asc' ? 'ASC' : 'DESC';

// Base query
$sql = "SELECT * FROM student WHERE 1";

// Apply filters
if (!empty($year)) {
    $sql .= " AND student_year = '" . $conn->real_escape_string($year) . "'";
}
if (!empty($course)) {
    $sql .= " AND student_course = '" . $conn->real_escape_string($course) . "'";
}

$sql .= " ORDER BY student_date $sort";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo '<div style="overflow-x:auto;"><table class="table table-bordered table-striped">';
    echo '<thead class="table-primary"><tr>
            <th>Name</th>
            <th>Student ID</th>
            <th>Year</th>
            <th>Course</th>
            <th>Address</th>
            <th>Emergency Contact</th>
            <th>Date</th>
            <th>Actions</th>
          </tr></thead><tbody>';

    while ($row = $result->fetch_assoc()) {
        $id = $row['s_id']; // Make sure your table has an `s_id` column (PRIMARY KEY)
        $fullName = "{$row['student_surname']}, {$row['student_fname']} {$row['student_mi']} {$row['student_ext']}";
        $emergency = "{$row['student_emergency_name']} ({$row['student_relation']}) - {$row['student_contact']}";

        echo "<tr>
                <td>{$fullName}</td>
                <td>{$row['student_id']}</td>
                <td>{$row['student_year']}</td>
                <td>{$row['student_course']}</td>
                <td>{$row['student_address']}</td>
                <td>{$emergency}</td>
                <td>{$row['student_date']}</td>
                <td>
                <div class='action-buttons'>
                    <button class='btn btn-sm btn-primary edit-btn' data-id='$id'>
                    <i class='fas fa-edit'></i>
                    </button>
                    <button class='btn btn-sm btn-danger delete-btn' data-id='$id'>
                    <i class='fas fa-trash'></i>
                    </button>
                </div>
                </td>
              </tr>";
    }

    echo '</tbody></table></div>';
} else {
    echo "<p>No student records found.</p>";
}

$conn->close();
?>