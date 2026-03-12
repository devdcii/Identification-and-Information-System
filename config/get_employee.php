<?php
require_once "../config/dbcon.php";

header("Content-Type: application/json");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $stmt = $conn->prepare("SELECT * FROM employee WHERE e_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
        echo json_encode($employee);
    } else {
        echo json_encode(["error" => "Employee not found"]);
    }
    
    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid ID"]);
}

$conn->close();
?>