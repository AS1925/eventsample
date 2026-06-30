<?php

session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="admin")
{
    header("Location: ../login.php");
    exit();
}

$query = mysqli_query($conn,"
SELECT
registrations.id,
users.name,
users.email,
events.event_name,
events.event_date,
registrations.status

FROM registrations

INNER JOIN users
ON registrations.user_id = users.id

INNER JOIN events
ON registrations.event_id = events.id

ORDER BY registrations.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>View Registrations</title>
</head>
<body>

<h2>Event Registrations</h2>

<table border="1" cellpadding="10">

<tr>
    <th>S.No</th>
    <th>User Name</th>
    <th>Email</th>
    <th>Event Name</th>
    <th>Event Date</th>
    <th>Status</th>
</tr>

<?php

$count = 1;

while($row = mysqli_fetch_assoc($query))
{
?>

<tr>

<td><?php echo $count++; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['event_name']; ?></td>

<td><?php echo $row['event_date']; ?></td>

<td><?php echo $row['status']; ?></td>

</tr>

<?php
}
?>

</table>

<br><br>

<a href="dashboard.php">Back Dashboard</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
</body>
</html>