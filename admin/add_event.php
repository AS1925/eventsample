<?php 
session_start();
include('../includes/db.php');
if(!isset($_SESSION['user_id'])||$_SESSION['role']!='admin')
    {
        header("Location:../login.php");
        exit();
    }
$msg="";
if(isset($_POST['save']))
    {
        $event_name=$_POST['event_name'];
        $event_type=$_POST['event_type'];
        $event_date=$_POST['event_date'];
        $event_time=$_POST['event_time'];
        $venue=$_POST['venue'];
        $description=$_POST['description'];
        $max_participants=$_POST['max_participants'];
        $image=$_FILES['image']['name'];
        $tmp=$_FILES['image']['tmp_name'];
        $extension=strtolower(pathinfo($image,PATHINFO_EXTENSION));
        $allowed=array("jpg","jpeg","png","webp");
        $check=mysqli_query($conn,"SELECT * FROM events WHERE event_name='$event_name' AND event_date='$event_date'");
        if(mysqli_num_rows($check)>0)
            {
                $msg="Event already Exists.";
            }
        else if(!in_array($extension,$allowed))
            {
                $msg="only JPG,JPEG,PNG and WEBP images are allowed.";
            }  
            else {

                            
        move_uploaded_file($tmp,"../events/".$image);
        $query="INSERT INTO events(event_name,event_type,event_date,event_time,venue,description,max_participants,image) VALUES ('$event_name','$event_type','$event_date','$event_time','$venue','$description','$max_participants','$image')";
        if(mysqli_query($conn,$query))
            {
                $msg="Event added Successfully";
            }
        else{
            $msg="Failed to Add Event";
        }
            }
    }
?>
<html>
    <head>
        <title>Add Event</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    </head>
    <body>
        <h2> Add Event </h2>
        <form method="POST" enctype="multipart/form-data">
            Event Name <br>
            <input type="text" name="event_name" required><br><br>
            Event Type<br>
            <select name="event_type" required>
                <option value="">Select</option>
                <option>Wedding</option>
                <option>Birthday</option>
                <option>Corporate</option>
                <option>Conference</option>
                <option>Reception</option>
                <option>others</option>
            </select><br><br>
            Event Date<br>
            <input type="date" name="event_date" required>
            <br><br>
            Event Time<br>
            <input type="time" name="event_time" required><br><br>
            Venue<br>
            <input type="text" name="venue" required><br><br>
            Description<br>
            <textarea name="description"></textarea><br><br>
            Maximum Participants <br>
            <input type="number" name="max_participants" min="1" required><br><br>
            Event Image<br>
            <input type="file" name="image" accept="image/*" required> <br><br>
            <input type="submit" name="save" value="Add Event">
        </form>
        <br>
        <?php echo $msg;?>
        <br><br>
        <a href="dashboard.php">Back Dashboard</a>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
    </body>    
</html>
