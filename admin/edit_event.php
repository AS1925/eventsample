<?php
session_start();
include("../includes/db.php");
if(!isset($_SESSION['user_id']) || $_SESSION['role']!="admin")
{
    header("Location: ../login.php");
    exit();
}
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM events WHERE id='$id'");
$row = mysqli_fetch_assoc($result);
?>
<?php

if(isset($_POST['update']))
{
    $event_name = $_POST['event_name'];
    $event_type = $_POST['event_type'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $venue = $_POST['venue'];
    $description = $_POST['description'];
    $max_participants = $_POST['max_participants'];

    $update = mysqli_query($conn,"
    UPDATE events SET
    event_name='$event_name',
    event_type='$event_type',
    event_date='$event_date',
    event_time='$event_time',
    venue='$venue',
    description='$description',
    max_participants='$max_participants'
    image='$image'
    WHERE id='$id'
    ");
    if($_FILES['image']['name']!="")
        {
            $image=$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],"../events/".$iimage);
            mysqli_query($conn,"UPDATE events SET image='$image' WHERE id='$id'");
        }
    else
        {
            $image=$row['image'];
        }

    if($update)
    {
        header("Location: view_events.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Edit Event</title>
</head>
<body>

<h2>Edit Event</h2>

<form method="POST">

Event Name <br>
<input type="text" name="event_name"
value="<?php echo $row['event_name']; ?>" required>
<br><br>

Event Type <br>

<select name="event_type">

<option value="Wedding"
<?php if($row['event_type']=="Wedding") echo "selected"; ?>>
Wedding
</option>

<option value="Birthday"
<?php if($row['event_type']=="Birthday") echo "selected"; ?>>
Birthday
</option>

<option value="Corporate"
<?php if($row['event_type']=="Corporate") echo "selected"; ?>>
Corporate
</option>

<option value="Conference"
<?php if($row['event_type']=="Conference") echo "selected"; ?>>
Conference
</option>

<option value="Reception"
<?php if($row['event_type']=="Reception") echo "selected"; ?>>
Reception
</option>

</select>

<br><br>

Date <br>
<input type="date"
name="event_date"
value="<?php echo $row['event_date']; ?>"
required>

<br><br>

Time <br>
<input type="time"
name="event_time"
value="<?php echo $row['event_time']; ?>"
required>

<br><br>

Venue <br>
<input type="text"
name="venue"
value="<?php echo $row['venue']; ?>"
required>

<br><br>

Description <br>

<textarea name="description"><?php echo $row['description']; ?></textarea>

<br><br>

Maximum Participants <br>

<input type="number"
name="max_participants"
min="1"
value="<?php echo $row['max_participants']; ?>"
required>

<br><br>
Current Image <br>
<img src="../events/<?php echo $rwo['image'];?>" width="150"><br><br>
Choose new imagev(option)<br>
<input type="file" name="image">

<input type="submit" name="update" value="Update Event">

</form>

<br><br>

<a href="view_events.php">Back</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
</body>
</html>