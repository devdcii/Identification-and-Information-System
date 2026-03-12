<?php
require_once "../config/dbcon.php";

header("Content-Type: text/plain"); 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Use prepared statement for security
    $stmt = $conn->prepare("DELETE FROM employee WHERE e_id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>