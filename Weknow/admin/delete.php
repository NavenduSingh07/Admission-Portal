<?php
include '../db/db_connect.php';

if (isset($_GET['studentID'])) {
    $studentID = intval($_GET['studentID']);
    
    $conn->begin_transaction();
    
    try {
        // Delete from studentdetails table
        $query = "DELETE FROM studentdetails WHERE studentID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $studentID);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting from studentdetails: " . $stmt->error);
        }
        $stmt->close();
        
        // Delete from educationdetails table
        $query = "DELETE FROM educationdetails WHERE studentID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $studentID);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting from educationdetails: " . $stmt->error);
        }
        $stmt->close();
        
        // Delete from studentaddress table
        $query = "DELETE FROM studentaddress WHERE studentID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $studentID);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting from studentaddress: " . $stmt->error);
        }
        $stmt->close();
        
        $conn->commit();
        
        $message = urlencode("Application Deleted successfully");
        header("Location: pendingapp.php?message=$message");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    $message = urlencode("Invalid request: No student ID provided.");
    header("Location: pendingapp.php?message=$message");
    exit();
}
$conn->close();
?>
