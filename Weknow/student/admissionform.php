<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Registration Form</title>
    <link rel="stylesheet" href="../styles/form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body>
<input type="button" value="Back" onclick="window.location.href = '/Weknow/index.php';" style="padding: 10px 20px; background-color: #ff6600; color: white; border: none; cursor: pointer; border-radius: 5px;">
    <h1>Student Registration Form</h1>
    <form action="submit.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="fhname">Father's Name:</label>
        <input type="text" id="fhname" name="fhname" required><br><br>

        <label for="moname">Mother's Name:</label>
        <input type="text" id="moname" name="moname" required><br><br>

        <label for="phno">Phone Number:</label>
        <input type="text" id="phno" name="phno" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required><br><br>

        <label for="state">State:</label>
        <input type="text" id="state" name="state" required><br><br>

        <label for="pincode">Pin Code:</label>
        <input type="text" id="pincode" name="pincode" required><br><br>

        <label for="course">Course Applying For:</label>
        <input type="text" id="course" name="course" required><br><br>

        <label for="prequal">Previous Qualification:</label>
        <input type="text" id="prequal" name="prequal" required><br><br>

        <label for="passyear">Passing Year:</label>
        <input type="text" id="passyear" name="passyear" required><br><br>

        <label for="score">Score (Percentage/CGPA):</label>
        <input type="text" id="score" name="score" required><br><br>

        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <div class="passport-size"></div><br>

        <input type="submit" value="Submit">
    </form>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var input = document.querySelector('input[type=file]');
        input.addEventListener('change', function () {
            var preview = document.querySelector('.passport-size');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.style.backgroundImage = "url(" + reader.result + ")";
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.style.backgroundImage = null;
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');

        if (message) {
            let icon = message.toLowerCase().includes('success') ? 'success' : 'error';

            Swal.fire({
                icon: icon,
                title: icon === 'success' ? 'Registration Success' : 'Registration Error',
                text: message,
                confirmButtonText: 'OK'
            });
        }
    });
</script>


</html>