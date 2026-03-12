<?php
require_once "../config/dbcon.php";

header("Content-Type: text/plain");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $s_id = $_POST['s_id'];
    $student_id = $_POST['student_id'];
    $student_fname = $_POST['student_fname'];
    $student_surname = $_POST['student_surname'];
    $student_mi = $_POST['student_mi'];
    $student_ext = $_POST['student_ext'];
    $student_year = $_POST['student_year'];
    $student_course = $_POST['student_course'];
    $student_address = $_POST['student_address'];
    $student_emergency_name = $_POST['student_emergency_name'];
    $student_relation = $_POST['student_relation'];
    $student_contact = $_POST['student_contact'];
    
    $stmt = $conn->prepare("UPDATE student SET 
        student_id = ?, 
        student_fname = ?, 
        student_surname = ?, 
        student_mi = ?, 
        student_ext = ?, 
        student_year = ?, 
        student_course = ?, 
        student_address = ?, 
        student_emergency_name = ?, 
        student_relation = ?, 
        student_contact = ? 
        WHERE s_id = ?");
    
    $stmt->bind_param("sssssssssssi", 
        $student_id, 
        $student_fname, 
        $student_surname, 
        $student_mi, 
        $student_ext, 
        $student_year, 
        $student_course, 
        $student_address, 
        $student_emergency_name, 
        $student_relation, 
        $student_contact, 
        $s_id
    );
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    $stmt->close();
} else {
    echo "Invalid request method";
}

$conn->close();
?>