<?php
require_once "../config/dbcon.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['e_id'];

    $surname = $_POST['employee_surname'];
    $fname = $_POST['employee_fname'];
    $mi = $_POST['employee_mi'];
    $ext = $_POST['employee_ext'];
    $empID = $_POST['employee_id'];
    $position = $_POST['employee_position'];
    $department = $_POST['employee_department'];
    $address = $_POST['employee_address'];
    $emergency_name = $_POST['employee_emergency_name'];
    $relation = $_POST['employee_relation'];
    $contact = $_POST['employee_contact'];

    $stmt = $conn->prepare("UPDATE employee SET
        employee_surname = ?, 
        employee_fname = ?, 
        employee_mi = ?, 
        employee_ext = ?, 
        employee_id = ?, 
        employee_position = ?, 
        employee_department = ?, 
        employee_address = ?, 
        employee_emergency_name = ?, 
        employee_relation = ?, 
        employee_contact = ?
        WHERE e_id = ?");

    if (!$stmt) {
        echo "Statement prepare failed: " . $conn->error;
        exit;
    }

    $stmt->bind_param("sssssssssssi", 
        $surname, $fname, $mi, $ext, $empID,
        $position, $department, $address,
        $emergency_name, $relation, $contact, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request";
}

$conn->close();
?>
