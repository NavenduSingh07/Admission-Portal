<?php
include '../db/db_connect.php';

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
<html>

<head>
    <title>Edit Student Details</title>
    <link rel="stylesheet" href="../styles/form.css">
</head>

<body>
    <h1>Edit Student Details</h1>

    <form action="update.php" method="post" enctype="multipart/form-data">

        <?php if (!empty($img_path)): ?>
            <img src="../uploads/<?php echo $img_path; ?>" class="passport-size" alt="Passport Size Photo">
        <?php endif; ?>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>

        <label for="fhname">Father's Name:</label>
        <input type="text" id="fhname" name="fhname" value="<?php echo htmlspecialchars($fhname); ?>" required><br><br>

        <label for="moname">Mother's Name:</label>
        <input type="text" id="moname" name="moname" value="<?php echo htmlspecialchars($moname); ?>" required><br><br>

        <label for="phno">Phone Number:</label>
        <input type="text" id="phno" name="phno" value="<?php echo htmlspecialchars($phno); ?>" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>"
            required><br><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($city); ?>" required><br><br>

        <label for="state">State:</label>
        <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($state); ?>" required><br><br>

        <label for="pincode">Pin Code:</label>
        <input type="text" id="pincode" name="pincode" value="<?php echo htmlspecialchars($pincode); ?>"
            required><br><br>

        <label for="course">Course Applying For:</label>
        <input type="text" id="course" name="course" value="<?php echo htmlspecialchars($course); ?>" required><br><br>

        <label for="prequal">Previous Qualification:</label>
        <input type="text" id="prequal" name="prequal" value="<?php echo htmlspecialchars($prequal); ?>"
            required><br><br>

        <label for="passyear">Passing Year:</label>
        <input type="text" id="passyear" name="passyear" value="<?php echo htmlspecialchars($passyear); ?>"
            required><br><br>

        <label for="score">Score (Percentage/CGPA):</label>
        <input type="text" id="score" name="score" value="<?php echo htmlspecialchars($score); ?>" required><br><br>

        <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">

        <input type="submit" value="Submit">
    </form>

</body>

</html>