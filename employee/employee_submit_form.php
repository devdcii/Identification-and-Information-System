<?php
session_start();
require_once "../config/dbcon.php";
include "../config/pageplugin.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname   = strtoupper($_POST['lname']);
    $fname     = ucwords(strtolower($_POST['fname']));
    $mi        = strtoupper($_POST['mi']);
    $ext       = strtoupper($_POST['ext']);
    $barangay  = ucwords(strtolower($_POST['barangay']));
    $town      = ucwords(strtolower($_POST['town']));
    $province  = ucwords(strtolower($_POST['province']));
    $address   = "$barangay, $town, $province";

    $employee_id     = $_POST['employee_id'];
    $department      = ucwords(strtolower($_POST['department']));
    $position        = ucwords(strtolower($_POST['position']));
    $emergency_name  = ucwords(strtolower($_POST['emergency_name']));
    $relation        = ucwords(strtolower($_POST['relation']));
    $contact_number  = $_POST['contact_number'];
    $date_now        = date("Y-m-d");

    $sql = "INSERT INTO employee (
        employee_surname,
        employee_fname,
        employee_mi,
        employee_ext,
        employee_address,
        employee_id,
        employee_department,
        employee_position,
        employee_emergency_name,
        employee_relation,
        employee_contact,
        employee_date
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssssss",
        $surname,
        $fname,
        $mi,
        $ext,
        $address,
        $employee_id,
        $department,
        $position,
        $emergency_name,
        $relation,
        $contact_number,
        $date_now
    );

    if ($stmt->execute()) {
        $_SESSION['show_success_modal'] = true;
    } else {
        $_SESSION['error'] = "Failed to register employee: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: ../employee/employee_form.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
