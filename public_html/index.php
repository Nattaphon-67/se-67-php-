<?php
$servername = "db";
$username = "admin";
$password = "1234";
$dbname = "titanic";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$connected = $conn !== false;
$databaseStatus = $connected ? "Connected" : "Connection failed";
$databaseMessage = $connected ? "Database is ready." : mysqli_connect_error();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEMP Titanic Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .card {
            max-width: 700px;
            margin: 80px auto;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card p-4">
            <h2 class="mb-3">LEMP + MariaDB Project</h2>
            <div class="alert <?= $connected ? 'alert-success' : 'alert-danger' ?>" role="alert">
                <strong>Database:</strong> <?= htmlspecialchars($databaseStatus) ?>
            </div>
            <p class="mb-3"><?= htmlspecialchars($databaseMessage) ?></p>
            <p class="text-muted mb-4">Selected database: <strong><?= htmlspecialchars($dbname) ?></strong></p>
            <a class="btn btn-primary btn-lg" href="/show_data.php">View Titanic Data</a>
        </div>
    </div>
</body>
</html>
<?php
if ($conn) {
    mysqli_close($conn);
}
?>