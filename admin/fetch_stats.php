<?php
require_once "../config/dbcon.php";
header("Content-Type: application/json");

$stats = [];

// Total students
$r = $conn->query("SELECT COUNT(*) AS total FROM student");
$stats['total_students'] = $r ? (int)$r->fetch_assoc()['total'] : 0;

// Total employees
$r = $conn->query("SELECT COUNT(*) AS total FROM employee");
$stats['total_employees'] = $r ? (int)$r->fetch_assoc()['total'] : 0;

// Students per year
$stats['per_year'] = [];
foreach (['1st Year','2nd Year','3rd Year','4th Year'] as $year) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM student WHERE student_year = ?");
    $stmt->bind_param("s", $year);
    $stmt->execute();
    $stats['per_year'][$year] = (int)$stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();
}

// Students per course
$stats['per_course'] = [];
$r = $conn->query("SELECT student_course, COUNT(*) AS total FROM student GROUP BY student_course ORDER BY total DESC");
if ($r) while ($row = $r->fetch_assoc())
    $stats['per_course'][$row['student_course']] = (int)$row['total'];

// Employees per department
$stats['per_dept'] = [];
$r = $conn->query("SELECT employee_department, COUNT(*) AS total FROM employee GROUP BY employee_department ORDER BY total DESC");
if ($r) while ($row = $r->fetch_assoc())
    $stats['per_dept'][$row['employee_department']] = (int)$row['total'];

echo json_encode($stats);
$conn->close();
?>