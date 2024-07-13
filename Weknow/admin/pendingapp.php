<?php
include '../db/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Applications</title>
    <link rel="stylesheet" href="../styles/table.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1>Pending Applications</h1>
    <input type="button" value="Back" onclick="window.location.href = 'adminpanel.php';"
        style="padding: 10px 20px; background-color: #ff6600; color: white; border: none; cursor: pointer; border-radius: 5px;">

    <?php
    $query = "SELECT * FROM studentdetails WHERE status = 2";
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
                    <a href="viewEdit.php?studentID=' . $row['studentID'] . '">View&Edit</a>
                    <a class="btndel" href="#" onclick="confirmDelete(' . $row['studentID'] . ')">Delete</a>
                    <a href="approve.php?studentID=' . $row['studentID'] . '">Approve</a>
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
    <script>
        function confirmDelete(studentID) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete.php?studentID=' + studentID;
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');

            if (message) {
                let icon = message.toLowerCase().includes('success') ? 'success' : 'error';

                Swal.fire({
                    icon: icon,
                    title: icon === 'success' ? 'Success' : 'Error',
                    text: message,
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
</body>

</html>