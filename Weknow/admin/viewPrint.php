<?php
include '../db/db_connect.php';

$name = $fhname = $moname = $phno = $address = $city = $state = $pincode = $course = $prequal = $passyear = $score = $img_path = '';

if (isset($_GET['studentID'])) {
    $studentID = $_GET['studentID'];

    $stmt1 = $conn->prepare("SELECT name, FHname, MOname, Phno, img_path FROM studentdetails WHERE studentID = ?");
    $stmt1->bind_param("s", $studentID);
    $stmt1->execute();
    $stmt1->bind_result($name, $fhname, $moname, $phno, $img_path);
    $stmt1->fetch();
    $stmt1->close();

    $stmt2 = $conn->prepare("SELECT address, city, state, pinCode FROM studentaddress WHERE studentID = ?");
    $stmt2->bind_param("s", $studentID);
    $stmt2->execute();
    $stmt2->bind_result($address, $city, $state, $pincode);
    $stmt2->fetch();
    $stmt2->close();

    $stmt3 = $conn->prepare("SELECT course, preQual, passYear, score FROM educationdetails WHERE studentID = ?");
    $stmt3->bind_param("s", $studentID);
    $stmt3->execute();
    $stmt3->bind_result($course, $prequal, $passyear, $score);
    $stmt3->fetch();
    $stmt3->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Application</title>
    <link rel="stylesheet" href="../styles/print.css">
</head>
<body>

<div class="container">
    <div class="printable-area">
        <h1>Student Application</h1>
        
        <?php if (!empty($img_path)) : ?>
            <img src="<?php echo $img_path; ?>" alt="Student Image">
        <?php endif; ?>

        <p><strong>Student ID:</strong> <?php echo $studentID;?></p>
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>Father's Name:</strong> <?php echo $fhname; ?></p>
        <p><strong>Mother's Name:</strong> <?php echo $moname; ?></p>
        <p><strong>Phone Number:</strong> <?php echo $phno; ?></p>
        <p><strong>Address:</strong> <?php echo $address; ?></p>
        <p><strong>City:</strong> <?php echo $city; ?></p>
        <p><strong>State:</strong> <?php echo $state; ?></p>
        <p><strong>Pin Code:</strong> <?php echo $pincode; ?></p>
        <p><strong>Course:</strong> <?php echo $course; ?></p>
        <p><strong>Previous Qualification:</strong> <?php echo $prequal; ?></p>
        <p><strong>Year of Passing:</strong> <?php echo $passyear; ?></p>
        <p><strong>Score:</strong> <?php echo $score; ?></p>
          
    </div>

    <button class="print-button" onclick="window.print()">Print</button>
</div>

</body>
</html>
