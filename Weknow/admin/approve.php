<?php
include '../db/db_connect.php';

if (isset($_GET['studentID'])) {
    $studentID = intval($_GET['studentID']);

    $query = "UPDATE studentdetails SET status = 1 WHERE studentID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $studentID);

    if ($stmt->execute()) {
        $message = urlencode("Application approved successfully");
        header("Location: pendingapp.php?message=$message");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
} else {
    $message = urlencode("Invalid request: No student ID provided.");
        header("Location: pendingapp.php?message=$message");
        exit();
}

$conn->close();
?>