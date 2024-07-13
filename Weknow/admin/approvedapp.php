<?php
include '../db/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Applications</title>
    <link rel="stylesheet" href="../styles/table.css">
</head>

<body>
    <h1>Approved Applications</h1>
    <input type="button" value="Back" onclick="window.location.href = 'adminpanel.php';"
        style="padding: 10px 20px; background-color: #ff6600; color: white; border: none; cursor: pointer; border-radius: 5px;">

    <?php
    $query = "SELECT * FROM studentdetails WHERE status = 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '
        <table border="1">
            <thead class="thead">
                <tr>
                    <th>S.No.</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Father\'s Name</th>
                    <th>Mother\'s Name</th>
                    <th>Phone No.</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tbody">';

        $counter = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <tr>
                <td>' . $counter . '</td>
                <td>' . $row['studentID'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['FHname'] . '</td>
                <td>' . $row['MOname'] . '</td>
                <td>' . $row['Phno'] . '</td>
                <td class="btnall">
                    <a href="viewPrint.php?studentID=' . $row['studentID'] . '">View&Print</a>
                </td>
            </tr>';
            $counter++;
        }

        echo '
            </tbody>
        </table>';
    } else {
        echo "<p>No records found</p>";
    }

    mysqli_close($conn);
    ?>
</body>

</html>