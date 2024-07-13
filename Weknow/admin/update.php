<?php
include '../db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_POST['studentID'];
    $name = $_POST['name'];
    $fhname = $_POST['fhname'];
    $moname = $_POST['moname'];
    $phno = $_POST['phno'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $course = $_POST['course'];
    $prequal = $_POST['prequal'];
    $passyear = $_POST['passyear'];
    $score = $_POST['score'];

    // Update studentdetails table
    $stmt1 = $conn->prepare("UPDATE studentdetails SET name = ?, FHname = ?, MOname = ?, Phno = ? WHERE studentID = ?");
    $stmt1->bind_param("sssss", $name, $fhname, $moname, $phno, $studentID);
    $stmt1->execute();
    $stmt1->close();

    // Update studentaddress table
    $stmt2 = $conn->prepare("UPDATE studentaddress SET address = ?, city = ?, state = ?, pinCode = ? WHERE studentID = ?");
    $stmt2->bind_param("sssss", $address, $city, $state, $pincode, $studentID);
    $stmt2->execute();
    $stmt2->close();

    // Update educationdetails table
    $stmt3 = $conn->prepare("UPDATE educationdetails SET course = ?, preQual = ?, passYear = ?, score = ? WHERE studentID = ?");
    $stmt3->bind_param("sssss", $course, $prequal, $passyear, $score, $studentID);
    $stmt3->execute();
    $stmt3->close();

    header("Location: pendingapp.php?message=" . urlencode("Application Updated Successfully"));
    exit();
}
?>
