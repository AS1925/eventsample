<?php
session_start();
include("includes/db.php");
if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$event_id = $_GET['id'];
$check = mysqli_query($conn,"SELECT * FROM registrations WHERE user_id='$user_id' AND event_id='$event_id'");
if(mysqli_num_rows($check) > 0)
{
    echo "Already Registered!";
    exit();
}
$event_data=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM events where id='$event_id' "));
$max_participants=$event_data['max_participants'];
$current_count=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM registrations WHERE event_id='$event_id'"));
$registered_users=$current_count['total'];
if($registered_users>=$max_participants)
    {
        echo "<script> alert('Event Full. Registration Closed.'); window.location='events.php';</script>";
        exit();
    }
$insert = mysqli_query($conn,"INSERT INTO registrations (user_id,event_id) VALUES ('$user_id','$event_id')");
if($insert)
{
    echo "
    <script>
    alert('Registration Successful');
    window.location='events.php';
    </script>
    ";
}
else
{
    echo "Registration Failed";
}

?>