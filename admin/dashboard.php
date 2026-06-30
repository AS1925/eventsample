<?php 
session_start();
include('../includes/db.php');
if(!isset($_SESSION['user_id']))
    {
        header("Location:../login.php");
        exit();
    }
if($_SESSION['role']!='admin')
    {
        die("Access Denied");
    }
$total_users = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM users"));

$total_events = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM events")
);

$total_registrations = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM registrations")
);

$total_requests = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM service_requests")
);
?>
<!DOCTYPE html>
<html>
    <head>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        <title> Admin Dashboard - Event Ease </title>
    </head>
    <body>
        <h1> Admin Dashboard </h1>
        <h3> Welcome <?php echo $_SESSION['user_name'];?> </h3>
        <hr>
        <a href="add_event.php">Add Events</a><br><br>
        <a href="view_events.php">Manage Events</a><br><br>
        <a href="view_registrations.php">View Registrations</a><br><br>
        <a href="view_service_requests.php">Service Requests </a><br><br>
        <a href="reports.php">Reports</a><br><br>
        <a href="../logout.php" onclick="return confirm('are you sure want to logout?')">Logout</a>
        <table border="1" cellpadding="15">
            <tr>
                <th>Total Users</th>
                <th>Total Events</th>
                <th>Total Registartions</th>
                <th> Total service Requests</th>
            </tr>
            <tr>
                <td><?php echo $total_users['total']; ?></td>
                <td><?php echo $total_events['total']; ?></td>
                <td><?php echo $total_registrations['total']; ?></td>
                <td><?php echo $total_requests['total']; ?></td>
            </tr>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
</body>
</html>
