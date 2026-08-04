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
                $msg="Only JPG, JPEG, PNG and WEBP images are allowed.";
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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Event</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="icon" href="../events/logo.png" type="image/png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    </head>
    <body>
        <?php include '../includes/navbar.php'; ?>
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-3">
                    <?php include '../includes/admin_sidebar.php'; ?>
                </div>
                <div class="col-lg-9">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                        <h3 class="fw-bold mb-3">Add New Event</h3>
                        <p class="text-muted mb-4">Create a polished event listing for attendees.</p>
                        <form method="POST" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-6"><label class="form-label">Event Name</label><input type="text" name="event_name" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Event Type</label><select name="event_type" class="form-select" required><option value="">Select</option><option>Wedding</option><option>Birthday</option><option>Corporate</option><option>Conference</option><option>Reception</option><option>others</option></select></div>
                            <div class="col-md-6"><label class="form-label">Event Date</label><input type="date" name="event_date" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Event Time</label><input type="time" name="event_time" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Venue</label><input type="text" name="venue" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Maximum Participants</label><input type="number" name="max_participants" min="1" class="form-control" required></div>
                            <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="4"></textarea></div>
                            <div class="col-12"><label class="form-label">Event Image</label><input type="file" name="image" accept="image/*" class="form-control" required></div>
                            <?php if($msg != ""): ?><div class="col-12"><div class="alert <?php echo strpos($msg,'Successfully') !== false ? 'alert-success' : 'alert-danger'; ?> rounded-4 mb-0" role="alert"><?php echo $msg; ?></div></div><?php endif; ?>
                            <div class="col-12"><button type="submit" name="save" class="btn btn-primary">Add Event</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../includes/footer.php'; ?>
    </body>    
</html>
