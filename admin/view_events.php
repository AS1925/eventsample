<?php session_start();
include("../includes/db.php");
if(!isset($_SESSION['user_id']) || $_SESSION['role']!='admin')
    {
        header("Location:../login.php");
        exit();
    }
$query=mysqli_query($conn,"SELECT * FROM events ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>View Events</title>
</head>
<body>
    <h2>Manage Events</h2>
    <a href="add_event.php">Add New Event</a>
    <br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Event Name</th>
            <th>Type</th>
            <th>Date</th>
            <th>Time</th>
            <th>Venue</th>
            <th>Image</th>
            <th>Participants</th>
            <th>Actions</th>
        </tr>   
        <?php
            while($row = mysqli_fetch_assoc($query))
                {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['event_name']; ?></td>
            <td><?php echo $row['event_type']; ?></td>
            <td><?php echo $row['event_date']; ?></td>
            <td><?php echo $row['event_time']; ?></td>
            <td><?php echo $row['venue']; ?></td>
            <td><?php echo $row['max_participants']; ?></td>
            <td> <?php if($row['image']=="") 
                        {
                            echo "No Image";
                        }
                        else
                            {
                            ?> <img src="../events/<?php echo $row['image'];?>" width="120" heigth="80"> <?php } ?></td>
            <td><a href="edit_event.php?id=<?php echo $row['id']; ?>">Edit</a>|
            <a href="delete_event.php?id=<?php echo $row['id']; ?>"
                onclick="return confirm('Are you sure want to delete this event?')">Delete</a>
            </td>
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




