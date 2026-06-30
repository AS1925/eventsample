<?php

session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="admin")
{
    header("Location: ../login.php");
    exit();
}

$users = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM users")
);

$events = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM events")
);

$registrations = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM registrations")
);

$requests = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM service_requests")
);

?>

<html>
<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<title>Reports</title>
</head>
<body>

<h2>System Reports</h2>

<table border="1" cellpadding="10">

<tr>
    <th>Report Name</th>
    <th>Total Count</th>
</tr>

<tr>
    <td>Total Users</td>
    <td><?php echo $users['total']; ?></td>
</tr>

<tr>
    <td>Total Events</td>
    <td><?php echo $events['total']; ?></td>
</tr>

<tr>
    <td>Total Registrations</td>
    <td><?php echo $registrations['total']; ?></td>
</tr>

<tr>
    <td>Total Service Requests</td>
    <td><?php echo $requests['total']; ?></td>
</tr>

</table>

<br><br>

<button onclick="window.print()">
Print Report
</button>

<br><br>

<a href="dashboard.php">
Back Dashboard
</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
</body>
</html>