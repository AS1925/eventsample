<?php

session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="admin")
{
    header("Location: ../login.php");
    exit();
}

$query=mysqli_query($conn,"
SELECT
service_requests.id,
users.name,
service_requests.event_type,
service_requests.event_date,
service_requests.venue,
service_requests.guests,
service_requests.status

FROM service_requests

INNER JOIN users
ON service_requests.user_id = users.id

ORDER BY service_requests.id DESC
");
?>

<html>
<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<title>Service Requests</title>
</head>
<body>

<h2>Service Requests</h2>

<table border="1" cellpadding="10">

<tr>
<th>S.No</th>
<th>User</th>
<th>Event Type</th>
<th>Date</th>
<th>Venue</th>
<th>Guests</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php

$count=1;

while($row=mysqli_fetch_assoc($query))
{
?>

<tr>

<td><?php echo $count++; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['event_type']; ?></td>

<td><?php echo $row['event_date']; ?></td>

<td><?php echo $row['venue']; ?></td>

<td><?php echo $row['guests']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>
<a href="update_request_status.php?id=<?php echo $row['id']; ?>">
Update Status
</a>
</td>

</tr>

<?php
}
?>

</table>
<a href="dashboard.php">Back Dashboard</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
</body>
</html>