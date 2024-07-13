<?php
include '../db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    function generateStudentID($conn) {
        do {
            $studentID = mt_rand(10000000, 99999999);
        } while (isStudentIDExists($studentID, $conn));
        return $studentID;
    }

    function isStudentIDExists($studentID, $conn) {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM studentdetails WHERE studentID = ?");
        $stmt->bind_param('s', $studentID);
        $stmt->execute();
        $count = 0;
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }

    $studentID = generateStudentID($conn);

    $target_dir = "../uploads/";
    $filename = $studentID . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $filename;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    if ($_FILES["image"]["size"] > 5000000) {
        die("Sorry, your file is too large.");
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }

    // SQL to insert data into database
    $stmt1 = $conn->prepare("INSERT INTO studentdetails (studentID, name, FHname, MOname, Phno, img_path, status) 
                             VALUES (?, ?, ?, ?, ?, ?, 2)");
    $stmt1->bind_param("ssssss", $studentID, $name, $fhname, $moname, $phno, $target_file);

    $stmt2 = $conn->prepare("INSERT INTO studentaddress (studentID, address, city, state, pinCode) 
                             VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("sssss", $studentID, $address, $city, $state, $pincode);

    $stmt3 = $conn->prepare("INSERT INTO educationdetails (studentID, course, preQual, passYear, score) 
                             VALUES (?, ?, ?, ?, ?)");
    $stmt3->bind_param("sssss", $studentID, $course, $prequal, $passyear, $score);

    // Execute prepared statements and handle errors
    $conn->begin_transaction();
    $success = true;

    if (!$stmt1->execute()) {
        $success = false;
        echo "Error in stmt1: " . $stmt1->error . "<br>";
    }

    if ($success && !$stmt2->execute()) {
        $success = false;
        echo "Error in stmt2: " . $stmt2->error . "<br>";
    }

    if ($success && !$stmt3->execute()) {
        $success = false;
        echo "Error in stmt3: " . $stmt3->error . "<br>";
    }

    if ($success) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $conn->commit();
            $message = "Student registered successfully.";
            header("Location: admissionform.php?message=" . urlencode($message));
            exit();
        } else {
            $conn->rollback();
            $message = "Sorry, there was an error uploading your file.";
            echo $message;
        }
    } else {
        $conn->rollback();
        echo "Transaction failed. Rolled back.";
    }

    // Closing statements and connection
    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
    $conn->close();
}
?>
