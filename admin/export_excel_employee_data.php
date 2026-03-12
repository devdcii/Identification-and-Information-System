<?php
require_once "../config/dbcon.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=employee_data.xls");
header("Pragma: no-cache");
header("Expires: 0");

$sort = isset($_GET['sort']) && strtolower($_GET['sort']) === 'asc' ? 'ASC' : 'DESC';

$sql = "SELECT * FROM employee ORDER BY employee_date $sort";

$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr>
        <th>Name</th>
        <th>Employee ID</th>
        <th>Position</th>
        <th>Department</th>
        <th>Address</th>
        <th>Emergency Contact</th>
        <th>Date</th>
      </tr>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No records found.</td></tr>";
}
echo "</table>";
$conn->close();
?>
