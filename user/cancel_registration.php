<?php

session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

mysqli_query($conn,"
DELETE FROM registrations
WHERE id='$id'
AND user_id='$user_id'
");
header("Location: my_events.php");
exit();

?>