<?php session_start();
if(!isset($_SESSION['user_id']))
    {
        header("Location:../login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        <title>User Dashboard - Event Ease</title>
    </head>
    <body>
        <h2>Welcome <?php echo $_SESSION['user_name'];?> </h2>
        <h3> User Dashboard </h3>
        <i class="fa-solid fa-circle-user"></i><a href="profile.php">My Profile</a><br><br>
        <i class="fa-solid fa-calendar"></i><a href="my_events.php">My Events</a> <br><br>
        <i class="fa-solid fa-calendar-check"></i><a href="service_request.php">Request Service</a><br><br>
        <i class="fa-solid fa-right-from-bracket"></i><a href="../logout.php" onclick="return confirm('Are yousure want to logout?')"> Logout </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
    </body>
</html>