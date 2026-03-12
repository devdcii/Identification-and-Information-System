<?php
session_start();
require_once "../config/dbcon.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form input
    $surname   = strtoupper($_POST['lname']);
    $fname     = ucwords(strtolower($_POST['fname']));
    $mi        = strtoupper($_POST['mi']);
    $ext       = strtoupper($_POST['ext']);
    $barangay  = ucwords(strtolower($_POST['barangay']));
    $town      = ucwords(strtolower($_POST['town']));
    $province  = ucwords(strtolower($_POST['province']));
    $address   = "$barangay, $town, $province";

    $student_id     = $_POST['student_id'];
    $year           = $_POST['year'];
    $course         = $_POST['course'];
    $emergency_name = ucwords(strtolower($_POST['emergency_name']));
    $relation       = ucwords(strtolower($_POST['relation']));
    $contact_number = $_POST['contact_number'];
    $date_now       = date("Y-m-d");

    // Prepare insert query
    $sql = "INSERT INTO student (
                student_surname,
                student_fname,
                student_mi,
                student_ext,
                student_address,
                student_id,
                student_year,
                student_course,
                student_emergency_name,
                student_relation,
                student_contact,
                student_date
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssssss",
        $surname,
        $fname,
        $mi,
        $ext,
        $address,
        $student_id,
        $year,
        $course,
        $emergency_name,
        $relation,
        $contact_number,
        $date_now
    );

    if ($stmt->execute()) {
        // ✅ Now safe to show modal only on success
        $_SESSION['show_success_modal'] = true;
    } else {
        $_SESSION['error'] = "Failed to register student: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../student/student_form.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
