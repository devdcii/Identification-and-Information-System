<?php
require_once "../config/dbcon.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=students_data.xls");
header("Pragma: no-cache");
header("Expires: 0");

$year = isset($_GET['year']) ? $_GET['year'] : '';
$course = isset($_GET['course']) ? $_GET['course'] : '';
$sort = isset($_GET['sort']) && strtolower($_GET['sort']) === 'asc' ? 'ASC' : 'DESC';

$sql = "SELECT * FROM student WHERE 1";
if (!empty($year)) {
    $sql .= " AND student_year = '" . $conn->real_escape_string($year) . "'";
}
if (!empty($course)) {
    $sql .= " AND student_course = '" . $conn->real_escape_string($course) . "'";
}
$sql .= " ORDER BY student_date $sort";

$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr>
        <th>Name</th>
        <th>Student ID</th>
        <th>Year</th>
        <th>Course</th>
        <th>Address</th>
        <th>Emergency Contact</th>
        <th>Date</th>
      </tr>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No records found.</td></tr>";
}
echo "</table>";
$conn->close();
?>
