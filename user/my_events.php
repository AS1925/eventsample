<?php session_start();
include("../includes/db.php");
if(!isset($_SESSION['user_id']))
    {
        header("Location:../login.php");
        exit();
    }
$user_id=$_SESSION['user_id'];
$query=mysqli_query($conn,"SELECT registrations.id AS reg_id, events.event_name,events.event_type,events.event_date,events.venue,registrations.status FROM registrations INNER JOIN events ON registrations.event_id=events.id WHERE registrations.user_id='$user_id'");
?>
<html>
    <head>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        <title>My Events</title>
    </head>
    <body>
        <h2> My Registered Events</h2>
        <table border="1" cellpadding="10">
            <tr>
                <th>S.No</th>
                <th>Event Name</th>
                <th>Type</th>
                <th>Date</th>
                <th>Venue</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php $count=1;
            while($row=mysqli_fetch_assoc($query))
                {
                    ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $row['event_name'];?></td>
                        <td><?php echo $row['event_type'];?></td>
                        <td><?php echo $row['event_date'];?></td>
                        <td><?php echo $row['venue'];?></td>
                        <td><?php echo $row['status'];?></td>
                        <td>
                            <a href="cancel_registration.php?id=<?php echo $row['reg_id']; ?>" onclick="return confirm('Cancel Registartion?')">Cancel </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table><br><br>
            <i class="fa-solid fa-circle-user"></i><a href="dashboard.php">Back Dashboard</a>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
    </body>
</html>