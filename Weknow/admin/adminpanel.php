<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/admin.css">
</head>

<body>

    <div class="admin-panel">
    <input type="button" value="Back" onclick="window.location.href = '/Weknow/index.php';" style="padding: 10px 20px; background-color: #ff6600; color: white; border: none; cursor: pointer; border-radius: 5px;">
        <h1>Admin Panel</h1>
        <a href="pendingapp.php" class="button pending-button">Pending Applications</a>
        <a href="approvedapp.php" class="button approved-button">Approved Applications</a>
    </div>

</body>

</html>